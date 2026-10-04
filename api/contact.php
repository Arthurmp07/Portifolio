<?php
declare(strict_types=1);

/**
 * Endpoint do formulário de contato.
 * Proteções: método POST, CSRF, honeypot, tempo mínimo de preenchimento,
 * rate limit por IP, validação e sanitização (inclui proteção contra header injection).
 */

session_start(['cookie_httponly' => true, 'cookie_samesite' => 'Lax', 'use_strict_mode' => true]);

header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store');

$mainConfig = require __DIR__ . '/../config/config.php';
$config = $mainConfig['contact'];
require __DIR__ . '/../includes/mailer.php';

function respond(int $status, string $code): never
{
    http_response_code($status);
    echo json_encode(['ok' => $status === 200, 'code' => $code]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Allow: POST');
    respond(405, 'method');
}

/* CSRF */
$token = (string) ($_POST['csrf'] ?? '');
if (empty($_SESSION['csrf']) || !hash_equals($_SESSION['csrf'], $token)) {
    respond(403, 'csrf');
}

/* Honeypot e tempo mínimo (bots) — responde "sucesso" silenciosamente */
$ts = (int) ($_POST['ts'] ?? 0);
if (!empty($_POST['website']) || $ts <= 0 || (time() - $ts) < (int) $config['min_fill_time']) {
    respond(200, 'ok');
}

/* Rate limit por IP */
$ip       = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
$rateFile = __DIR__ . '/../storage/ratelimit/' . hash('sha256', $ip) . '.json';
$now      = time();
$window   = (int) $config['rate_window'];
$hits     = [];
if (is_file($rateFile)) {
    $hits = array_values(array_filter((array) json_decode((string) file_get_contents($rateFile), true), fn($t) => is_int($t) && $t > $now - $window));
}
if (count($hits) >= (int) $config['rate_limit']) {
    respond(429, 'rate');
}

/* Validação */
$clean = static fn(string $v): string => trim(preg_replace('/[\r\n\t]+/', ' ', strip_tags($v)));
$name    = $clean((string) ($_POST['name'] ?? ''));
$email   = trim((string) ($_POST['email'] ?? ''));
$message = trim(strip_tags((string) ($_POST['message'] ?? '')));

$valid = $name !== '' && mb_strlen($name) <= 100
    && filter_var($email, FILTER_VALIDATE_EMAIL) && mb_strlen($email) <= 150
    && mb_strlen($message) >= 10 && mb_strlen($message) <= 2000;

if (!$valid) {
    respond(422, 'invalid');
}

/* Registra a tentativa e persiste a mensagem */
$hits[] = $now;
@file_put_contents($rateFile, json_encode($hits), LOCK_EX);

$saved = false;
if ($config['save_to_file']) {
    $line = json_encode([
        'date' => date('c'), 'ip' => $ip, 'name' => $name, 'email' => $email, 'message' => $message,
    ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . PHP_EOL;
    $saved = @file_put_contents(__DIR__ . '/../storage/messages/' . date('Y-m') . '.jsonl', $line, FILE_APPEND | LOCK_EX) !== false;
}

$mailed = false;
if ($config['send_mail']) {
    [$mailed, $mailError] = send_contact_mail($mainConfig, $name, $email, $message, $ip, (string) ($_POST['lang'] ?? 'pt'));
    if (!$mailed) {
        log_mail_error($mailError);
    }
}

// Sucesso se pelo menos um canal (arquivo ou e-mail) recebeu a mensagem.
respond(($saved || $mailed) ? 200 : 500, ($saved || $mailed) ? 'ok' : 'error');
