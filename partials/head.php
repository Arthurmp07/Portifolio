<?php
/** @var array $content @var array $config @var string $lang @var array $page */
$title = $page['title'] ?? $content['meta']['title'];
$desc  = $page['description'] ?? $content['meta']['description'];
$ld = [
    '@context'    => 'https://schema.org',
    '@type'       => 'Person',
    'name'        => $config['name'],
    'jobTitle'    => $lang === 'pt' ? 'Engenheiro de Dados' : 'Data Engineer',
    'url'         => $page['canonical'] ?? '',
    'image'       => $page['og_image'] ?? '',
    'email'       => 'mailto:' . $config['email'],
    'address'     => ['@type' => 'PostalAddress', 'addressLocality' => 'Porto Alegre', 'addressRegion' => 'RS', 'addressCountry' => 'BR'],
    'worksFor'    => ['@type' => 'Organization', 'name' => 'Sicredi'],
    'alumniOf'    => ['@type' => 'CollegeOrUniversity', 'name' => 'PUCRS'],
    'knowsAbout'  => ['Data Engineering', 'ETL', 'SQL', 'Python', 'Power BI', 'PHP'],
    'sameAs'      => array_values(array_filter([$config['social']['linkedin'], $config['social']['github'], $config['social']['instagram'], $config['social']['x']])),
];
?>
<!DOCTYPE html>
<html lang="<?= $lang === 'pt' ? 'pt-BR' : 'en' ?>" data-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($title) ?></title>
    <meta name="description" content="<?= e($desc) ?>">
    <meta name="author" content="<?= e($config['name']) ?>">
    <meta name="theme-color" content="#070b14">
    <?php if (!empty($page['noindex'])): ?><meta name="robots" content="noindex"><?php endif; ?>
    <?php if (!empty($page['canonical'])): ?><link rel="canonical" href="<?= e($page['canonical']) ?>"><?php endif; ?>

    <meta property="og:type" content="website">
    <meta property="og:title" content="<?= e($title) ?>">
    <meta property="og:description" content="<?= e($desc) ?>">
    <meta property="og:locale" content="<?= e($content['locale']) ?>">
    <?php if (!empty($page['og_image'])): ?><meta property="og:image" content="<?= e($page['og_image']) ?>"><?php endif; ?>
    <meta name="twitter:card" content="summary_large_image">

    <link rel="icon" type="image/svg+xml" href="<?= e(url('assets/img/favicon.svg')) ?>">

    <!-- Tema aplicado antes da renderização para evitar "flash" -->
    <script>
        (function () {
            document.documentElement.classList.add('js');
            try {
                var saved = localStorage.getItem('theme');
                var theme = saved || (window.matchMedia('(prefers-color-scheme: light)').matches ? 'light' : 'dark');
                document.documentElement.setAttribute('data-theme', theme);
            } catch (e) {}
        })();
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="<?= e(url('assets/css/style.css')) ?>">

    <script type="application/ld+json"><?= json_encode($ld, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
</head>
