<?php
/** @var array $content @var array $config */
$h = $content['hero'];
$years = years_since($config['career_start']);
?>
<section class="hero" id="home">
    <canvas class="hero__canvas" id="flow-canvas" aria-hidden="true"></canvas>
    <div class="hero__glow hero__glow--a" aria-hidden="true"></div>
    <div class="hero__glow hero__glow--b" aria-hidden="true"></div>

    <div class="container hero__grid">
        <div class="hero__content">
            <span class="eyebrow eyebrow--live"><span class="pulse-dot"></span><?= e($h['eyebrow']) ?></span>
            <p class="hero__hello"><?= e($h['hello']) ?></p>
            <h1 class="hero__name"><?= e($config['name']) ?></h1>
            <p class="hero__role" aria-live="polite">
                <span class="mono">&gt;</span>
                <span id="typed" data-words='<?= e(json_encode($h['roles'], JSON_UNESCAPED_UNICODE)) ?>'><?= e($h['roles'][0]) ?></span><span class="caret"></span>
            </p>
            <h2 class="hero__headline"><?= e($h['headline_pre']) ?><span class="grad"><?= e($h['headline_hl']) ?></span><?= e($h['headline_post']) ?></h2>
            <p class="hero__text"><?= e($h['text']) ?></p>

            <div class="hero__cta">
                <a class="btn btn--primary" href="#projects"><?= e($h['cta_primary']) ?> <?= icon('arrow-right') ?></a>
                <a class="btn btn--ghost" href="#contact"><?= e($h['cta_secondary']) ?></a>
                <a class="btn btn--text" href="resume.php" target="_blank" rel="noopener"><?= icon('file-lines') ?> <?= e($h['cta_resume']) ?></a>
            </div>

            <div class="hero__social">
                <a href="<?= e($config['social']['github']) ?>" target="_blank" rel="noopener" aria-label="GitHub"><?= icon('github') ?></a>
                <a href="<?= e($config['social']['linkedin']) ?>" target="_blank" rel="noopener" aria-label="LinkedIn"><?= icon('linkedin-in') ?></a>
                <a href="<?= e($config['social']['instagram']) ?>" target="_blank" rel="noopener" aria-label="Instagram"><?= icon('instagram') ?></a>
                <a href="<?= e($config['social']['x']) ?>" target="_blank" rel="noopener" aria-label="X"><?= icon('x-twitter') ?></a>
            </div>
        </div>

        <div class="hero__visual">
            <div class="terminal" data-tilt>
                <div class="terminal__bar">
                    <span class="dot dot--r"></span><span class="dot dot--y"></span><span class="dot dot--g"></span>
                    <span class="terminal__title">pipeline.py</span>
                </div>
                <pre class="terminal__body" id="terminal" aria-label="Exemplo de pipeline em Python"><code></code></pre>
            </div>

            <div class="float-card float-card--a">
                <span class="float-card__icon"><?= icon('circle-check') ?></span>
                <div><strong>ETL success</strong><small id="rows-counter" data-target="12480">0</small> <small>rows loaded</small></div>
            </div>
            <div class="float-card float-card--b">
                <span class="float-card__icon float-card__icon--b"><?= icon('database') ?></span>
                <div><strong>gold.fact_sales</strong><small>updated just now</small></div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="stats">
            <?php foreach ($content['stats'] as $i => $s): ?>
                <?php
                $value = match ($s['value']) {
                    null       => $years,
                    'projects' => count($content['shared']['projects']),
                    'tech'     => array_sum(array_map(fn($g) => count($g['items']), $content['shared']['stack'])),
                    default    => $s['value'],
                };
                ?>
                <div class="stat reveal" style="--d: <?= $i * 80 ?>ms">
                    <div class="stat__num"><span data-count="<?= (int) $value ?>" <?= $value > 1900 ? 'data-plain="1"' : '' ?>>0</span><?= e($s['suffix']) ?></div>
                    <div class="stat__label"><?= e($s['label']) ?></div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <a class="scroll-hint" href="#about" aria-label="<?= e($h['scroll']) ?>"><span></span></a>
</section>

<div class="marquee" aria-hidden="true">
    <div class="marquee__track">
        <?php for ($r = 0; $r < 2; $r++): foreach ($content['shared']['marquee'] as $tech): ?>
            <span><?= e($tech) ?></span>
        <?php endforeach; endfor; ?>
    </div>
</div>
