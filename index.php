<?php
declare(strict_types=1);

require __DIR__ . '/includes/bootstrap.php';
require __DIR__ . '/includes/github.php';

$github = github_stats($config['github_user'], (int) $config['github_cache_ttl']);

$page = ['canonical' => $siteUrl, 'og_image' => $siteUrl . 'img/arthur_sicredi_atualizado.png'];

require __DIR__ . '/partials/head.php';
?>
<body>
<a class="skip-link" href="#main"><?= e($content['ui']['skip']) ?></a>
<div class="scroll-progress" aria-hidden="true"></div>

<?php require __DIR__ . '/partials/nav.php'; ?>

<main id="main">
    <?php
    require __DIR__ . '/partials/hero.php';
    require __DIR__ . '/partials/about.php';
    require __DIR__ . '/partials/stack.php';
    require __DIR__ . '/partials/pipeline.php';
    require __DIR__ . '/partials/projects.php';
    require __DIR__ . '/partials/experience.php';
    require __DIR__ . '/partials/contact.php';
    ?>
</main>

<?php require __DIR__ . '/partials/footer.php'; ?>

<script src="<?= e(url('assets/js/main.js')) ?>" defer></script>
</body>
</html>
