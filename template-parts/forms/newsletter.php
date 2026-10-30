<?php
defined('ABSPATH') || exit;

/*
 * Vista del newsletter del blog, dentro del CTA (definición: inc/forms/newsletter.php).
 * Marcado del diseño (.lm-cta__form, .lm-cta__consent, .lm-cta__done); atributos de wp-form.
 * $args (desde la plantilla del blog, vía template-parts/components/cta.php): email_label,
 * email_placeholder, privacidad_texto, privacidad_enlace_texto, privacidad_url, boton, exito.
 */

$lumenti_id = 'newsletter';
$lumenti_privacidad_url = get_privacy_policy_url() ?: ($args['privacidad_url'] ?? '');
$lumenti_texto = (string) ($args['privacidad_texto'] ?? '');
$lumenti_enlace = (string) ($args['privacidad_enlace_texto'] ?? '');
$lumenti_partes = $lumenti_enlace !== '' ? explode($lumenti_enlace, $lumenti_texto, 2) : [$lumenti_texto];
?>
<form class="lm-cta__form" <?php lumenti_form_attrs($lumenti_id); ?> data-lm-success-panel="lm-nl-done">
    <noscript>
        <p class="lm-cta__done">Para suscribirte necesitas activar JavaScript. También puedes escribirnos a <a href="mailto:<?= esc_attr(antispambot('contacto@lumentisaludmental.com')) ?>"><?= esc_html(antispambot('contacto@lumentisaludmental.com')) ?></a>.</p>
    </noscript>
    <div class="lm-cta__form-field">
        <label class="lm-visually-hidden" for="<?= esc_attr(lumenti_field_id($lumenti_id, 'email')) ?>"><?= esc_html($args['email_label'] ?? '') ?></label>
        <input class="lm-cta__input" placeholder="<?= esc_attr($args['email_placeholder'] ?? '') ?>" <?php lumenti_field_attrs($lumenti_id, 'email'); ?>>
    </div>
    <button class="lm-btn lm-btn--primary lm-form__submit" type="submit" data-loading-label="Enviando...">
        <span data-submit-label><?= esc_html($args['boton'] ?? '') ?></span>
        <svg class="lm-btn__arrow" aria-hidden="true" width="18" height="18" viewBox="0 0 256 256" fill="currentColor"><path d="M181.66,133.66l-80,80a8,8,0,0,1-11.32-11.32L164.69,128,90.34,53.66a8,8,0,0,1,11.32-11.32l80,80A8,8,0,0,1,181.66,133.66Z"/></svg>
        <span class="lm-form__spinner" aria-hidden="true"></span>
    </button>
    <span class="lm-field__error lm-cta__error-email" <?php lumenti_error_attrs($lumenti_id, 'email'); ?>></span>
    <label class="lm-cta__consent">
        <input <?php lumenti_field_attrs($lumenti_id, 'privacidad'); ?>>
        <span>
            <?php
            echo esc_html($lumenti_partes[0]);
            if (count($lumenti_partes) === 2) {
                echo $lumenti_privacidad_url !== ''
                    ? lumenti_link(['url' => $lumenti_privacidad_url, 'title' => $lumenti_enlace, 'target' => '_blank']) // phpcs:ignore -- ya escapado
                    : esc_html($lumenti_enlace);
                echo esc_html($lumenti_partes[1]);
            }
            ?>
        </span>
    </label>
    <span class="lm-field__error lm-cta__error-consent" <?php lumenti_error_attrs($lumenti_id, 'privacidad'); ?>></span>
    <?php lumenti_form_honeypot(); ?>
    <p class="lm-cta__status" data-form-status role="status" aria-live="polite"></p>
</form>
<p class="lm-cta__done" id="lm-nl-done" tabindex="-1" role="status" hidden><?= esc_html($args['exito'] ?? '') ?></p>
