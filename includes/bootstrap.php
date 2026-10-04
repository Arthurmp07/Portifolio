<?php
declare(strict_types=1);

if (session_status() === PHP_SESSION_NONE) {
    session_start([
        'cookie_httponly' => true,
        'cookie_samesite' => 'Lax',
        'use_strict_mode' => true,
    ]);
}

$config = require __DIR__ . '/../config/config.php';

/* ---------- Idioma ---------- */
$supportedLangs = ['pt', 'en'];
$lang = $config['default_lang'];

if (isset($_GET['lang']) && in_array($_GET['lang'], $supportedLangs, true)) {
    $lang = $_GET['lang'];
    setcookie('lang', $lang, ['expires' => time() + 31536000, 'path' => '/', 'samesite' => 'Lax']);
} elseif (isset($_COOKIE['lang']) && in_array($_COOKIE['lang'], $supportedLangs, true)) {
    $lang = $_COOKIE['lang'];
}

$content = (require __DIR__ . '/../data/content.php')[$lang];

/* ---------- URLs ---------- */
$basePath = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/')), '/') . '/';
if (str_ends_with($basePath, '/api/')) {
    $basePath = substr($basePath, 0, -4);
}
$scheme  = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$siteUrl = $scheme . '://' . ($_SERVER['HTTP_HOST'] ?? 'localhost') . $basePath;

/* ---------- Helpers ---------- */
function e(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/** URL de um recurso do projeto, com cache-busting por data de modificação. */
function url(string $path): string
{
    global $basePath;
    $file = __DIR__ . '/../' . $path;
    $v = is_file($file) ? '?v=' . filemtime($file) : '';
    return $basePath . $path . $v;
}

function icon(string $name, string $extra = ''): string
{
    $brands = ['github', 'linkedin', 'linkedin-in', 'instagram', 'x-twitter', 'whatsapp', 'discord', 'python', 'php', 'js', 'android', 'html5', 'css3-alt', 'git-alt'];
    $style  = in_array($name, $brands, true) ? 'fa-brands' : 'fa-solid';
    return '<i class="' . $style . ' fa-' . e($name) . ($extra ? ' ' . e($extra) : '') . '" aria-hidden="true"></i>';
}

function years_since(string $date): int
{
    return max(1, (int) (new DateTimeImmutable($date))->diff(new DateTimeImmutable('now'))->y);
}

function csrf_token(): string
{
    if (empty($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf'];
}

function lang_url(string $target): string
{
    return '?lang=' . $target;
}
