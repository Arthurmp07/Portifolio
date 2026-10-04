<?php
declare(strict_types=1);

require __DIR__ . '/includes/bootstrap.php';
http_response_code(404);

$nf = $content['notfound'];
$page = ['title' => $nf['title'] . ' — ' . $config['name'], 'noindex' => true];
require __DIR__ . '/partials/head.php';
?>
<body class="page-404">
<canvas class="hero__canvas" id="flow-canvas" aria-hidden="true"></canvas>
<main class="nf">
    <p class="nf__code mono">HTTP 404</p>
    <h1><span class="grad">NULL</span></h1>
    <h2><?= e($nf['title']) ?></h2>
    <p><?= e($nf['text']) ?></p>
    <a class="btn btn--primary" href="<?= e($basePath) ?>"><?= icon('arrow-left') ?> <?= e($nf['cta']) ?></a>
</main>
<script src="<?= e(url('assets/js/main.js')) ?>" defer></script>
</body>
</html>
