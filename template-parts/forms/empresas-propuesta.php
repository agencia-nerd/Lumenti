<?php
defined('ABSPATH') || exit;

/*
 * Vista del form "Solicitar propuesta" de Empresas (definición: inc/forms/empresas.php).
 * Marcado y clases del diseño (.lm-form, .lm-field, .lm-choice, .lm-checkbox, .lm-form-success);
 * atributos de campos, errores, honeypot y estado: helpers de wp-form.
 * $args (desde template-parts/pages/empresas/propuesta.php): fieldsets, campos, boton, exito_titulo,
 * exito_texto, exito_boton.
 * El diseño marca el único campo opcional con "(opcional)" en lugar de un * en los obligatorios.
 */

$lumenti_id = 'empresas';
$lumenti_fieldsets = $args['fieldsets'] ?? [];
$lumenti_campos = $args['campos'] ?? [];
$lumenti_privacidad = $lumenti_campos['privacidad'] ?? [];
$lumenti_privacidad_url = get_privacy_policy_url() ?: ($lumenti_privacidad['url'] ?? '');

$lumenti_icono_error = '<svg aria-hidden="true" width="14" height="14" viewBox="0 0 256 256" fill="currentColor"><path d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm-8,56a8,8,0,0,1,16,0v56a8,8,0,0,1-16,0Zm8,104a12,12,0,1,1,12-12A12,12,0,0,1,128,184Z"/></svg>';
$lumenti_check = '<svg class="lm-choice__check" aria-hidden="true" width="14" height="14" viewBox="0 0 256 256" fill="currentColor"><path d="M229.66,77.66l-128,128a8,8,0,0,1-11.32,0l-56-56a8,8,0,0,1,11.32-11.32L96,188.69,218.34,66.34a8,8,0,0,1,11.32,11.32Z"/></svg>';

// Caja de error del diseño: el ícono queda fijo y el motor escribe el texto en el <span> interior.
$lumenti_error = static function (string $key) use ($lumenti_id, $lumenti_icono_error) {
    echo '<span class="lm-field__error">' . $lumenti_icono_error . '<span ';
    lumenti_error_attrs($lumenti_id, $key);
    echo '></span></span>';
};

// Campo de texto del diseño: label + control + ayuda opcional + error.
$lumenti_input = static function (string $key, string $tag = 'input') use ($lumenti_id, $lumenti_campos, $lumenti_error) {
    $campo = $lumenti_campos[$key] ?? [];
    $prefijo = $campo['prefijo'] ?? '';
    ?>
    <div class="lm-field lm-field--form">
        <label class="lm-field__label" for="<?= esc_attr(lumenti_field_id($lumenti_id, $key)) ?>"><?= esc_html($campo['label'] ?? '') ?></label>
        <span class="lm-field__control">
            <?php if ($prefijo !== '') : ?><span class="lm-field__prefix" aria-hidden="true"><?= esc_html($prefijo) ?></span><?php endif; ?>
            <input class="lm-field__input<?= $prefijo !== '' ? ' lm-field__input--prefixed' : '' ?>" <?php lumenti_field_attrs($lumenti_id, $key); ?>>
        </span>
        <?php if (!empty($campo['ayuda'])) : ?>
            <span class="lm-field__hint"><?= esc_html($campo['ayuda']) ?></span>
        <?php endif; ?>
        <?php $lumenti_error($key); ?>
    </div>
    <?php
};
?>
<form class="lm-form" <?php lumenti_form_attrs($lumenti_id); ?><?php lumenti_form_extras_attrs($lumenti_id); ?> data-lm-proposal-form data-lm-success-panel="lm-emp-success">
    <noscript>
        <p class="lm-emp-proposal__help">Para enviar este formulario necesitas activar JavaScript. También puedes escribirnos a <a href="mailto:<?= esc_attr(antispambot('contacto@lumentisaludmental.com')) ?>"><?= esc_html(antispambot('contacto@lumentisaludmental.com')) ?></a> o por WhatsApp al +51 942 901 535.</p>
    </noscript>

    <fieldset class="lm-form__fieldset">
        <legend class="lm-form__legend"><?= esc_html($lumenti_fieldsets['datos'] ?? '') ?></legend>
        <div class="lm-form__grid">
            <?php
            $lumenti_input('nombre');
            $lumenti_input('empresa');
            $lumenti_input('cargo');
            $lumenti_input('whatsapp');
            ?>
        </div>
        <?php $lumenti_input('correo'); ?>
    </fieldset>

    <fieldset class="lm-form__fieldset">
        <legend class="lm-form__legend"><?= esc_html($lumenti_fieldsets['necesidad'] ?? '') ?></legend>

        <?php $lumenti_busca = $lumenti_campos['busca'] ?? []; ?>
        <fieldset class="lm-choice" aria-describedby="<?= esc_attr(lumenti_field_id($lumenti_id, 'busca') . '-error') ?>">
            <legend class="lm-choice__label"><?= esc_html($lumenti_busca['label'] ?? '') ?> <span class="lm-field__label-note"><?= esc_html($lumenti_busca['nota'] ?? '') ?></span></legend>
            <?php // Campo del motor que lleva las opciones marcadas (lo llena form-extras.js). ?>
            <input hidden <?php lumenti_field_attrs($lumenti_id, 'busca'); ?>>
            <div class="lm-choice__list">
                <?php foreach (lumenti_form_group_options($lumenti_id, 'busca') as $lumenti_valor => $lumenti_texto) : ?>
                    <label class="lm-choice__option"><input class="lm-choice__input" type="checkbox" name="busca[]" value="<?= esc_attr($lumenti_valor) ?>" data-label="<?= esc_attr($lumenti_texto) ?>"><span class="lm-choice__chip"><?= $lumenti_check // phpcs:ignore -- SVG fijo ?><?= esc_html($lumenti_texto) ?></span></label>
                <?php endforeach; ?>
            </div>
            <?php $lumenti_error('busca'); ?>
        </fieldset>

        <?php $lumenti_colab = $lumenti_campos['colaboradores'] ?? []; ?>
        <div class="lm-field lm-field--form">
            <label class="lm-field__label" for="<?= esc_attr(lumenti_field_id($lumenti_id, 'colaboradores')) ?>"><?= esc_html($lumenti_colab['label'] ?? '') ?></label>
            <span class="lm-field__control">
                <select class="lm-field__select" <?php lumenti_field_attrs($lumenti_id, 'colaboradores'); ?>>
                    <option value=""><?= esc_html($lumenti_colab['placeholder'] ?? '') ?></option>
                    <?php foreach (lumenti_field_options($lumenti_id, 'colaboradores') as $lumenti_valor => $lumenti_texto) : ?>
                        <option value="<?= esc_attr($lumenti_valor) ?>"><?= esc_html($lumenti_texto) ?></option>
                    <?php endforeach; ?>
                </select>
                <svg class="lm-field__icon lm-field__icon--end" aria-hidden="true" width="16" height="16" viewBox="0 0 256 256" fill="currentColor"><path d="M213.66,101.66l-80,80a8,8,0,0,1-11.32,0l-80-80A8,8,0,0,1,53.66,90.34L128,164.69l74.34-74.35a8,8,0,0,1,11.32,11.32Z"/></svg>
            </span>
            <?php $lumenti_error('colaboradores'); ?>
        </div>
    </fieldset>

    <fieldset class="lm-form__fieldset">
        <legend class="lm-form__legend"><?= esc_html($lumenti_fieldsets['mas'] ?? '') ?></legend>
        <?php $lumenti_mensaje = $lumenti_campos['mensaje'] ?? []; ?>
        <div class="lm-field lm-field--form">
            <label class="lm-field__label" for="<?= esc_attr(lumenti_field_id($lumenti_id, 'mensaje')) ?>"><?= esc_html($lumenti_mensaje['label'] ?? '') ?> <span class="lm-field__label-note"><?= esc_html($lumenti_mensaje['nota'] ?? '') ?></span></label>
            <textarea class="lm-field__textarea" rows="5" <?php lumenti_field_attrs($lumenti_id, 'mensaje'); ?>></textarea>
            <?php if (!empty($lumenti_mensaje['ayuda'])) : ?>
                <span class="lm-emp-proposal__help"><?= esc_html($lumenti_mensaje['ayuda']) ?></span>
            <?php endif; ?>
            <?php $lumenti_error('mensaje'); ?>
        </div>
    </fieldset>

    <?php lumenti_form_honeypot(); ?>

    <div class="lm-form__actions">
        <div class="lm-checkbox-field">
            <label class="lm-checkbox">
                <input class="lm-checkbox__input" <?php lumenti_field_attrs($lumenti_id, 'privacidad'); ?>>
                <span>
                    <?php
                    $lumenti_texto = (string) ($lumenti_privacidad['texto'] ?? '');
                    $lumenti_enlace = (string) ($lumenti_privacidad['enlace_texto'] ?? '');
                    $lumenti_partes = $lumenti_enlace !== '' ? explode($lumenti_enlace, $lumenti_texto, 2) : [$lumenti_texto];
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
            <?php $lumenti_error('privacidad'); ?>
        </div>
        <div>
            <button class="lm-btn lm-btn--primary lm-form__submit" type="submit" data-loading-label="Enviando...">
                <span data-submit-label><?= esc_html($args['boton'] ?? '') ?></span>
                <svg class="lm-btn__arrow" aria-hidden="true" width="18" height="18" viewBox="0 0 256 256" fill="currentColor"><path d="M181.66,133.66l-80,80a8,8,0,0,1-11.32-11.32L164.69,128,90.34,53.66a8,8,0,0,1,11.32-11.32l80,80A8,8,0,0,1,181.66,133.66Z"/></svg>
                <span class="lm-form__spinner" aria-hidden="true"></span>
            </button>
        </div>
        <p class="lm-form__status" data-form-status role="status" aria-live="polite"></p>
    </div>
</form>

<div class="lm-form-success" id="lm-emp-success" role="status" hidden>
    <span class="lm-form-success__icon" aria-hidden="true"><svg aria-hidden="true" width="26" height="26" viewBox="0 0 256 256" fill="currentColor"><path d="M229.66,77.66l-128,128a8,8,0,0,1-11.32,0l-56-56a8,8,0,0,1,11.32-11.32L96,188.69,218.34,66.34a8,8,0,0,1,11.32-11.32Z"/></svg></span>
    <h3 class="lm-form-success__title" tabindex="-1"><?= esc_html($args['exito_titulo'] ?? '') ?></h3>
    <p class="lm-form-success__text"><?= esc_html($args['exito_texto'] ?? '') ?></p>
    <button class="lm-btn lm-btn--secondary lm-btn--md" type="button" data-lm-form-reset="empresas"><?= esc_html($args['exito_boton'] ?? '') ?></button>
</div>
