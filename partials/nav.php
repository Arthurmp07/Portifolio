<?php
/** @var array $content @var string $lang @var array $config */
$links = ['home' => '#home', 'about' => '#about', 'stack' => '#stack', 'pipeline' => '#pipeline', 'projects' => '#projects', 'experience' => '#experience', 'contact' => '#contact'];
?>
<header class="nav" id="nav">
    <div class="container nav__inner">
        <a href="#home" class="nav__brand" aria-label="<?= e($config['name']) ?>">
            <span class="nav__logo"><span>&lt;</span>AMP<span>/&gt;</span></span>
        </a>

        <nav class="nav__links" id="nav-links" aria-label="Menu">
            <?php foreach ($links as $key => $href): ?>
                <a href="<?= $href ?>" data-nav="<?= substr($href, 1) ?>"><?= e($content['nav'][$key]) ?></a>
            <?php endforeach; ?>
        </nav>

        <div class="nav__actions">
            <div class="lang-switch" role="group" aria-label="<?= e($content['ui']['lang_label']) ?>">
                <?php foreach (['pt' => 'Português', 'en' => 'English'] as $code => $label): ?>
                    <a href="<?= e(lang_url($code)) ?>" hreflang="<?= $code ?>" lang="<?= $code ?>" title="<?= e($label) ?>"
                       data-lang-link class="<?= $code === $lang ? 'is-active' : '' ?>"<?= $code === $lang ? ' aria-current="true"' : '' ?>><?= strtoupper($code) ?></a>
                <?php endforeach; ?>
            </div>
            <button class="chip-btn" id="theme-toggle" type="button" aria-label="<?= e($content['ui']['theme']) ?>">
                <span class="icon-moon"><?= icon('moon') ?></span>
                <span class="icon-sun"><?= icon('sun') ?></span>
            </button>
            <button class="chip-btn nav__burger" id="nav-burger" type="button" aria-expanded="false" aria-controls="nav-links" aria-label="<?= e($content['ui']['menu']) ?>">
                <?= icon('bars') ?>
            </button>
        </div>
    </div>
</header>
