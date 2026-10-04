<?php
/** @var array $content */
$x = $content['experience'];
?>
<section class="section" id="experience">
    <div class="container container--narrow">
        <header class="section-head">
            <span class="eyebrow reveal"><?= e($x['eyebrow']) ?></span>
            <h2 class="section-title reveal"><?= e($x['title']) ?></h2>
        </header>

        <ol class="timeline">
            <?php foreach ($x['items'] as $i => $item): ?>
                <li class="timeline__item timeline__item--<?= e($item['type']) ?> reveal" style="--d: <?= $i * 90 ?>ms">
                    <span class="timeline__marker"><?= icon($item['icon']) ?></span>
                    <div class="timeline__card spot">
                        <div class="timeline__meta">
                            <time class="mono"><?= e($item['date']) ?></time>
                            <?php if ($item['current']): ?><span class="badge badge--live"><span class="pulse-dot"></span><?= e($content['ui']['current']) ?></span><?php endif; ?>
                        </div>
                        <h3><?= e($item['role']) ?></h3>
                        <h4><?= e($item['org']) ?></h4>
                        <p><?= e($item['text']) ?></p>
                    </div>
                </li>
            <?php endforeach; ?>
        </ol>
    </div>
</section>
