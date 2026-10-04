<?php
/** @var array $content */
$p = $content['pipeline'];
$count = count($p['steps']);
?>
<section class="section" id="pipeline">
    <div class="container">
        <header class="section-head">
            <span class="eyebrow reveal"><?= e($p['eyebrow']) ?></span>
            <h2 class="section-title reveal"><?= e($p['title']) ?></h2>
            <p class="section-text reveal"><?= e($p['text']) ?></p>
        </header>

        <div class="pipeline reveal" id="pipeline-widget" data-steps="<?= $count ?>">
            <div class="pipeline__track" role="tablist" aria-label="<?= e($p['title']) ?>">
                <div class="pipeline__line" aria-hidden="true"><span class="pipeline__fill"></span><span class="pipeline__packet"></span></div>
                <?php foreach ($p['steps'] as $i => $step): ?>
                    <button class="pipeline__node<?= $i === 0 ? ' is-active' : '' ?>" role="tab" type="button"
                            id="tab-<?= e($step['key']) ?>" aria-controls="panel-<?= e($step['key']) ?>"
                            aria-selected="<?= $i === 0 ? 'true' : 'false' ?>" data-index="<?= $i ?>">
                        <span class="pipeline__dot"><?= icon($step['icon']) ?></span>
                        <span class="pipeline__label"><?= e($step['label']) ?></span>
                    </button>
                <?php endforeach; ?>
            </div>

            <div class="pipeline__panels">
                <?php foreach ($p['steps'] as $i => $step): ?>
                    <div class="pipeline__panel<?= $i === 0 ? ' is-active' : '' ?>" role="tabpanel"
                         id="panel-<?= e($step['key']) ?>" aria-labelledby="tab-<?= e($step['key']) ?>" <?= $i === 0 ? '' : 'hidden' ?>>
                        <div class="pipeline__info">
                            <span class="step-count mono">0<?= $i + 1 ?> / 0<?= $count ?></span>
                            <h3><?= e($step['title']) ?></h3>
                            <p><?= e($step['text']) ?></p>
                            <ul class="tags">
                                <?php foreach ($step['tools'] as $tool): ?><li><?= e($tool) ?></li><?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="codebox">
                            <div class="codebox__bar"><span class="dot dot--r"></span><span class="dot dot--y"></span><span class="dot dot--g"></span>
                                <span class="codebox__lang mono"><?= e($step['lang']) ?></span>
                            </div>
                            <pre><code><?= e($step['code']) ?></code></pre>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
