<?php
/** @var array $content */
$a = $content['about'];
?>
<section class="section" id="about">
    <div class="container about">
        <div class="about__photo reveal" data-tilt>
            <div class="about__frame">
                <img src="<?= e(url('img/arthur_sicredi_atualizado.png')) ?>" alt="<?= e($a['photo_alt']) ?>" width="390" height="585" loading="lazy">
            </div>
            <span class="about__badge"><?= icon('database') ?> Data Engineering</span>
        </div>

        <div class="about__content">
            <span class="eyebrow reveal"><?= e($a['eyebrow']) ?></span>
            <h2 class="section-title reveal"><?= e($a['title']) ?></h2>
            <?php foreach ($a['paragraphs'] as $p): ?>
                <p class="lead reveal"><?= e($p) ?></p>
            <?php endforeach; ?>

            <div class="info-grid">
                <?php foreach ($a['cards'] as $i => $c): ?>
                    <div class="info-card reveal spot" style="--d: <?= $i * 70 ?>ms">
                        <span class="info-card__icon"><?= icon($c['icon']) ?></span>
                        <div>
                            <strong><?= e($c['title']) ?></strong>
                            <span><?= e($c['text']) ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
