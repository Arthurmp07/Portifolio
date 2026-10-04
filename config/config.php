<?php
/**
 * Configurações gerais do portfólio.
 * Edite aqui os dados pessoais, redes sociais e opções do formulário de contato.
 */
$config = [
    'name'         => 'Arthur Mello Pimentel',
    'location'     => 'Porto Alegre, RS — Brasil',
    'email'        => 'Arthurmellopimentel76@gmail.com',
    'phone_label'  => '+55 51 99251-7054',
    'whatsapp'     => '5551992517054',

    // Início da carreira em TI (usado para calcular os "anos de experiência" automaticamente).
    'career_start' => '2023-12-01',

    'social' => [
        'linkedin'  => 'https://www.linkedin.com/in/arthur-mello-pimentel-92282823b/',
        'github'    => 'https://github.com/Arthurmp07',
        'instagram' => 'https://www.instagram.com/arthurmello334/',
        'x'         => 'https://x.com/Arthurmp0716',
    ],

    // Usuário do GitHub para o painel "ao vivo" (deixe vazio para desativar).
    'github_user'      => 'Arthurmp07',
    'github_cache_ttl' => 3600, // segundos

    // Formulário de contato (api/contact.php)
    'contact' => [
        'save_to_file'  => true,                       // cópia de segurança em storage/messages/*.jsonl
        'send_mail'     => true,                       // envia a mensagem para o seu e-mail
        'mail_to'       => 'Arthurmellopimentel76@gmail.com',
        'mail_from'     => 'Arthurmellopimentel76@gmail.com', // usado só se o SMTP estiver desligado (mail())
        'rate_limit'    => 3,                          // mensagens por janela, por IP
        'rate_window'   => 600,                        // janela em segundos
        'min_fill_time' => 3,                          // segundos mínimos para preencher (anti-bot)
    ],

    // SMTP (recomendado): envia pelo Gmail com uma "Senha de app".
    // NÃO coloque a senha aqui: crie config/mail.local.php (veja mail.local.example.php)
    // ou defina a variável de ambiente SMTP_PASSWORD.
    'smtp' => [
        'host'     => 'smtp.gmail.com',
        'port'     => 587,
        'secure'   => 'tls',                           // 'tls' (587) ou 'ssl' (465)
        'username' => 'Arthurmellopimentel76@gmail.com',
        'password' => '',
    ],

    'default_lang' => 'pt',
];

// Credenciais reais ficam fora do código versionado.
$local = __DIR__ . '/mail.local.php';
if (is_file($local)) {
    $config['smtp'] = array_merge($config['smtp'], (array) require $local);
}
if (($env = getenv('SMTP_PASSWORD')) !== false && $env !== '') {
    $config['smtp']['password'] = $env;
}

return $config;
