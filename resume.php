<?php
declare(strict_types=1);

require __DIR__ . '/includes/bootstrap.php';

$r = $content['resume'];
$hero = $content['hero'];
$page = ['title' => $r['title'] . ' — ' . $config['name'], 'description' => $content['meta']['description'], 'canonical' => $siteUrl . 'resume.php'];
require __DIR__ . '/partials/head.php';
?>
<body class="resume-page">
<div class="resume-toolbar no-print">
    <a class="btn btn--ghost" href="<?= e($basePath) ?>"><?= icon('arrow-left') ?> <?= e($r['back']) ?></a>
    <button class="btn btn--primary" type="button" onclick="window.print()"><?= icon('print') ?> <?= e($r['print']) ?></button>
</div>

<article class="resume">
    <header class="resume__header">
        <div>
            <h1><?= e($config['name']) ?></h1>
            <p class="resume__role"><?= e($hero['roles'][0]) ?></p>
        </div>
        <ul class="resume__contact">
            <li><?= icon('envelope') ?> <?= e($config['email']) ?></li>
            <li><?= icon('phone') ?> <?= e($config['phone_label']) ?></li>
            <li><?= icon('location-dot') ?> <?= e($config['location']) ?></li>
            <li><?= icon('linkedin-in') ?> linkedin.com/in/arthur-mello-pimentel-92282823b</li>
            <li><?= icon('github') ?> github.com/Arthurmp07</li>
        </ul>
    </header>

    <section>
        <h2><?= e($r['profile']) ?></h2>
        <p><?= e($content['about']['paragraphs'][0]) ?></p>
        <p><?= e($content['about']['paragraphs'][1]) ?></p>
    </section>

    <section>
        <h2><?= e($r['experience']) ?></h2>
        <?php foreach ($content['experience']['items'] as $item): ?>
            <div class="resume__item">
                <div class="resume__item-head">
                    <strong><?= e($item['role']) ?></strong>
                    <span class="mono"><?= e($item['date']) ?></span>
                </div>
                <em><?= e($item['org']) ?></em>
                <p><?= e($item['text']) ?></p>
            </div>
        <?php endforeach; ?>
    </section>

    <section>
        <h2><?= e($r['skills']) ?></h2>
        <?php foreach ($content['shared']['stack'] as $key => $group): ?>
            <p><strong><?= e($content['stack']['groups'][$key]['title']) ?>:</strong> <?= e(implode(' · ', $group['items'])) ?></p>
        <?php endforeach; ?>
    </section>

    <section>
        <h2><?= e($r['projects']) ?></h2>
        <?php foreach ($content['shared']['projects'] as $proj): $t = $content['projects']['items'][$proj['id']]; ?>
            <div class="resume__item">
                <div class="resume__item-head">
                    <strong><?= e($t['title']) ?></strong>
                    <span class="mono"><?= e(implode(', ', $proj['tags'])) ?></span>
                </div>
                <p><?= e($t['desc']) ?></p>
            </div>
        <?php endforeach; ?>
    </section>
</article>
</body>
</html>
