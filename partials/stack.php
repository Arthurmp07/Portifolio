<?php
/** @var array $content */
$s = $content['stack'];
$groups = $content['shared']['stack'];
?>
<section class="section section--alt" id="stack">
    <div class="container">
        <header class="section-head">
            <span class="eyebrow reveal"><?= e($s['eyebrow']) ?></span>
            <h2 class="section-title reveal"><?= e($s['title']) ?></h2>
            <p class="section-text reveal"><?= e($s['text']) ?></p>
        </header>

        <div class="bento">
            <?php $i = 0; foreach ($groups as $key => $g): $meta = $s['groups'][$key]; ?>
                <article class="bento__card bento__card--<?= e($key) ?> reveal spot" style="--d: <?= $i++ * 70 ?>ms">
                    <div class="bento__head">
                        <span class="bento__icon"><?= icon($g['icon']) ?></span>
                        <h3><?= e($meta['title']) ?></h3>
                        <?php if ($meta['badge']): ?><span class="badge"><?= e($meta['badge']) ?></span><?php endif; ?>
                    </div>
                    <ul class="tags">
                        <?php foreach ($g['items'] as $item): ?>
                            <li><?= e($item) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
