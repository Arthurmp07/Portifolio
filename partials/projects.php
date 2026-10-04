<?php
/** @var array $content @var ?array $github */
$p = $content['projects'];
$items = $content['shared']['projects'];
$ui = $content['ui'];
?>
<section class="section section--alt" id="projects">
    <div class="container">
        <header class="section-head">
            <span class="eyebrow reveal"><?= e($p['eyebrow']) ?></span>
            <h2 class="section-title reveal"><?= e($p['title']) ?></h2>
            <p class="section-text reveal"><?= e($p['text']) ?></p>
        </header>

        <div class="filters reveal" role="group" aria-label="Filtros">
            <?php foreach ($p['filters'] as $key => $label): ?>
                <button type="button" class="filter<?= $key === 'all' ? ' is-active' : '' ?>" data-filter="<?= e($key) ?>" aria-pressed="<?= $key === 'all' ? 'true' : 'false' ?>"><?= e($label) ?></button>
            <?php endforeach; ?>
        </div>

        <div class="projects" id="projects-grid">
            <?php foreach ($items as $i => $item): $t = $p['items'][$item['id']]; ?>
                <article class="project reveal spot" data-cat="<?= e($item['cat']) ?>" style="--d: <?= $i * 70 ?>ms"
                         data-title="<?= e($t['title']) ?>" data-desc="<?= e($t['desc']) ?>"
                         data-tags="<?= e(implode('|', $item['tags'])) ?>"
                         data-link="<?= e((string) $item['link']) ?>" data-status="<?= e($item['status']) ?>"
                         data-images="<?= e(implode('|', array_map('url', $item['images'] ?? ($item['image'] ? [$item['image']] : [])))) ?>">
                    <div class="project__media">
                        <?php if ($item['image']): ?>
                            <img src="<?= e(url($item['image'])) ?>" alt="<?= e($t['title']) ?>" loading="lazy">
                        <?php else: ?>
                            <div class="project__art project__art--<?= e($item['art'] ?? 'bars') ?>" aria-hidden="true">
                                <?php if (($item['art'] ?? 'bars') === 'bars'): ?><span></span><span></span><span></span><span></span><span></span><?php endif; ?>
                                <?= icon($item['icon']) ?>
                            </div>
                        <?php endif; ?>
                        <span class="status status--<?= e($item['status']) ?>"><?= e($item['status'] === 'wip' ? $ui['in_progress'] : $ui['done']) ?></span>
                    </div>
                    <div class="project__body">
                        <h3><?= e($t['title']) ?></h3>
                        <p><?= e($t['desc']) ?></p>
                        <ul class="tags tags--sm">
                            <?php foreach ($item['tags'] as $tag): ?><li><?= e($tag) ?></li><?php endforeach; ?>
                        </ul>
                        <div class="project__actions">
                            <button type="button" class="link-btn" data-open-project><?= e($ui['details']) ?> <?= icon('arrow-up-right-from-square') ?></button>
                            <?php if ($item['link']): ?>
                                <a class="link-btn" href="<?= e($item['link']) ?>" target="_blank" rel="noopener">
                                    <?= str_contains($item['link'], 'github.com') ? icon('github') . ' ' . e($ui['view_code']) : icon('globe') . ' ' . e($ui['visit_site']) ?>
                                </a>
                            <?php else: ?>
                                <span class="link-btn is-disabled"><?= e($ui['no_link']) ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>

        <?php if ($github): ?>
            <div class="github reveal spot">
                <div class="github__head">
                    <span class="github__icon"><?= icon('github') ?></span>
                    <div>
                        <h3><?= e($p['github_title']) ?></h3>
                        <a href="<?= e($github['url']) ?>" target="_blank" rel="noopener">@<?= e($config['github_user']) ?></a>
                    </div>
                </div>
                <div class="github__nums">
                    <div><strong data-count="<?= (int) $github['repos'] ?>">0</strong><span><?= e($p['github_repos']) ?></span></div>
                    <div><strong data-count="<?= (int) $github['followers'] ?>">0</strong><span><?= e($p['github_followers']) ?></span></div>
                </div>
                <?php if ($github['langs']): ?>
                    <div class="github__langs">
                        <span class="github__langs-title"><?= e($p['github_langs']) ?></span>
                        <div class="langbar" role="img" aria-label="<?= e($p['github_langs']) ?>">
                            <?php foreach ($github['langs'] as $i => $l): ?>
                                <span style="--w: <?= (int) $l['percent'] ?>%; --i: <?= $i ?>"></span>
                            <?php endforeach; ?>
                        </div>
                        <ul class="langlist">
                            <?php foreach ($github['langs'] as $i => $l): ?>
                                <li style="--i: <?= $i ?>"><i></i><?= e($l['name']) ?> <small><?= (int) $l['percent'] ?>%</small></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>

    <dialog class="modal" id="project-modal" aria-labelledby="modal-title">
        <div class="modal__inner">
            <button type="button" class="modal__close" data-close aria-label="<?= e($ui['close']) ?>"><?= icon('xmark') ?></button>
            <div class="modal__media" id="modal-media"></div>
            <div class="modal__body">
                <span class="status" id="modal-status"></span>
                <h3 id="modal-title"></h3>
                <p id="modal-desc"></p>
                <ul class="tags" id="modal-tags"></ul>
                <div class="modal__actions" id="modal-actions"></div>
            </div>
        </div>
    </dialog>
</section>
