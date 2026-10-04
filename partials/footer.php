<?php
/** @var array $content @var array $config */
?>
<footer class="footer">
    <div class="container footer__inner">
        <div>
            <strong class="footer__name"><?= e($config['name']) ?></strong>
            <p><?= e($config['location']) ?></p>
        </div>
        <div class="hero__social">
            <a href="<?= e($config['social']['github']) ?>" target="_blank" rel="noopener" aria-label="GitHub"><?= icon('github') ?></a>
            <a href="<?= e($config['social']['linkedin']) ?>" target="_blank" rel="noopener" aria-label="LinkedIn"><?= icon('linkedin-in') ?></a>
            <a href="<?= e($config['social']['instagram']) ?>" target="_blank" rel="noopener" aria-label="Instagram"><?= icon('instagram') ?></a>
            <a href="<?= e($config['social']['x']) ?>" target="_blank" rel="noopener" aria-label="X"><?= icon('x-twitter') ?></a>
        </div>
    </div>
    <div class="container footer__bottom">
        <span>© <?= date('Y') ?> <?= e($config['name']) ?>. <?= e($content['footer']['rights']) ?></span>
        <span><?= e($content['footer']['built']) ?></span>
    </div>
</footer>

<a href="#home" class="to-top" id="to-top" aria-label="<?= e($content['ui']['back_top']) ?>"><?= icon('arrow-up') ?></a>
