<?php
/** @var array $content @var array $config */
$c = $content['contact'];
$wa = 'https://wa.me/' . $config['whatsapp'];
?>
<section class="section section--alt" id="contact">
    <div class="container">
        <header class="section-head">
            <span class="eyebrow reveal"><?= e($c['eyebrow']) ?></span>
            <h2 class="section-title reveal"><?= e($c['title']) ?></h2>
            <p class="section-text reveal"><?= e($c['text']) ?></p>
        </header>

        <div class="contact">
            <div class="contact__channels">
                <a class="channel reveal spot" href="mailto:<?= e($config['email']) ?>">
                    <span class="channel__icon"><?= icon('envelope') ?></span>
                    <div><small><?= e($c['channels']['email']) ?></small><strong><?= e($config['email']) ?></strong></div>
                </a>
                <a class="channel reveal spot" href="<?= e($wa) ?>" target="_blank" rel="noopener" style="--d: 70ms">
                    <span class="channel__icon"><?= icon('whatsapp') ?></span>
                    <div><small><?= e($c['channels']['whatsapp']) ?></small><strong><?= e($config['phone_label']) ?></strong></div>
                </a>
                <a class="channel reveal spot" href="<?= e($config['social']['linkedin']) ?>" target="_blank" rel="noopener" style="--d: 140ms">
                    <span class="channel__icon"><?= icon('linkedin-in') ?></span>
                    <div><small><?= e($c['channels']['linkedin']) ?></small><strong>arthur-mello-pimentel</strong></div>
                </a>
                <div class="channel reveal spot" style="--d: 210ms">
                    <span class="channel__icon"><?= icon('location-dot') ?></span>
                    <div><small><?= e($c['channels']['location']) ?></small><strong><?= e($config['location']) ?></strong></div>
                </div>
            </div>

            <form class="form reveal" id="contact-form" action="api/contact.php" method="post" novalidate
                  data-msg-success="<?= e($c['success']) ?>" data-msg-error="<?= e($c['error']) ?>"
                  data-msg-invalid="<?= e($c['invalid']) ?>" data-msg-rate="<?= e($c['rate']) ?>"
                  data-label-send="<?= e($c['send']) ?>" data-label-sending="<?= e($c['sending']) ?>">
                <input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">
                <input type="hidden" name="ts" value="<?= time() ?>">
                <input type="hidden" name="lang" value="<?= e($GLOBALS['lang']) ?>">
                <!-- Honeypot: invisível para humanos -->
                <div class="hp" aria-hidden="true"><label>Website <input type="text" name="website" tabindex="-1" autocomplete="off"></label></div>

                <div class="field">
                    <input type="text" id="f-name" name="name" placeholder=" " maxlength="100" required autocomplete="name">
                    <label for="f-name"><?= e($c['name']) ?></label>
                </div>
                <div class="field">
                    <input type="email" id="f-email" name="email" placeholder=" " maxlength="150" required autocomplete="email">
                    <label for="f-email"><?= e($c['email']) ?></label>
                </div>
                <div class="field">
                    <textarea id="f-message" name="message" placeholder=" " rows="5" maxlength="2000" minlength="10" required></textarea>
                    <label for="f-message"><?= e($c['message']) ?></label>
                    <small class="field__count"><span id="char-count">0</span>/2000 <?= e($c['chars']) ?></small>
                </div>

                <button class="btn btn--primary btn--block" type="submit" id="form-submit"><span><?= e($c['send']) ?></span> <?= icon('paper-plane') ?></button>
                <p class="form__status" id="form-status" role="status" aria-live="polite"></p>
            </form>
        </div>
    </div>
</section>
