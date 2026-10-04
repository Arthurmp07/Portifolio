<?php
declare(strict_types=1);

use PHPMailer\PHPMailer\Exception as MailException;
use PHPMailer\PHPMailer\PHPMailer;

/**
 * Envia a mensagem do formulário de contato para o e-mail do dono do site.
 * Usa SMTP (PHPMailer) quando há senha configurada; caso contrário tenta mail().
 *
 * @return array{0: bool, 1: string} [enviado?, motivo da falha]
 */
function send_contact_mail(array $config, string $name, string $email, string $message, string $ip, string $lang): array
{
    $contact = $config['contact'];
    $smtp    = $config['smtp'];
    $subject = 'Portfólio — nova mensagem de ' . $name;
    $body    = "Você recebeu uma nova mensagem pelo formulário do portfólio.\n\n"
             . "Nome:    {$name}\n"
             . "E-mail:  {$email}\n"
             . 'Data:    ' . date('d/m/Y H:i:s') . "\n"
             . "Idioma:  {$lang}\n"
             . "IP:      {$ip}\n\n"
             . "Mensagem:\n{$message}\n\n"
             . "— Responda este e-mail para falar direto com {$name}.\n";

    // 1) SMTP via PHPMailer
    if (!empty($smtp['password'])) {
        require_once __DIR__ . '/phpmailer/Exception.php';
        require_once __DIR__ . '/phpmailer/PHPMailer.php';
        require_once __DIR__ . '/phpmailer/SMTP.php';

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host       = $smtp['host'];
            $mail->Port       = (int) $smtp['port'];
            $mail->SMTPAuth   = true;
            $mail->Username   = $smtp['username'];
            $mail->Password   = $smtp['password'];
            if ($smtp['secure'] === 'ssl') {
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            } elseif ($smtp['secure'] === 'tls') {
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            } else {                      // sem criptografia (apenas para testes locais)
                $mail->SMTPSecure  = '';
                $mail->SMTPAutoTLS = false;
            }
            $mail->Timeout    = 10;
            $mail->CharSet    = 'UTF-8';

            // O Gmail só aceita enviar "em nome" da própria conta autenticada.
            $mail->setFrom($smtp['username'], 'Portfólio — Contato');
            $mail->addAddress($contact['mail_to']);
            $mail->addReplyTo($email, $name);
            $mail->Subject = $subject;
            $mail->Body    = $body;
            $mail->send();
            return [true, ''];
        } catch (MailException $e) {
            return [false, 'smtp: ' . $mail->ErrorInfo];
        }
    }

    // 2) Fallback: mail() nativo (funciona só em servidores com e-mail configurado)
    if (function_exists('mail')) {
        $headers = [
            'From'         => $contact['mail_from'],
            'Reply-To'     => $email,
            'MIME-Version' => '1.0',
            'Content-Type' => 'text/plain; charset=UTF-8',
        ];
        $ok = @mail($contact['mail_to'], '=?UTF-8?B?' . base64_encode($subject) . '?=', $body, $headers);
        return [$ok, $ok ? '' : 'mail(): servidor sem e-mail configurado e SMTP sem senha'];
    }

    return [false, 'nenhum método de envio disponível'];
}

function log_mail_error(string $reason): void
{
    @file_put_contents(__DIR__ . '/../storage/mail-errors.log', '[' . date('c') . '] ' . $reason . PHP_EOL, FILE_APPEND | LOCK_EX);
}
