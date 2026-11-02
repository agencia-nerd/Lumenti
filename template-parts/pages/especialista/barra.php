<?php
defined('ABSPATH') || exit;

/*
 * Especialista · barra (specs/especialista.md → barra). Sin grupo propio: reutiliza especialista_perfil
 * y la imagen destacada. Barra fija de agenda (data-lm-profile-bar): la muestra src/js/modules/especialista.js
 * cuando el botón del perfil sale por arriba. Oculta: aria-hidden="true" y el botón con tabindex="-1".
 */

$lumenti_perfil = get_field('especialista_perfil') ?: [];
$lumenti_nombre = trim((string) ($lumenti_perfil['nombre_corto'] ?? ''));
$lumenti_cargo = (string) ($lumenti_perfil['cargo'] ?? '');

$lumenti_wa = lumenti_link_attrs(
    ['url' => lumenti_especialista_whatsapp($lumenti_nombre), 'target' => '_blank'],
    ['class' => 'lm-btn lm-btn--primary lm-profile-bar__btn']
);
if ($lumenti_wa === '') {
    return;
}
$lumenti_foto = has_post_thumbnail() ? lumenti_image(get_post_thumbnail_id(), ['class' => 'lm-profile-bar__photo', 'alt' => '', 'size' => 'thumbnail']) : '';
?>
<div class="lm-profile-bar" data-lm-profile-bar aria-hidden="true">
    <div class="lm-profile-bar__inner">
        <div class="lm-profile-bar__info"><?= $lumenti_foto ?><span class="lm-profile-bar__text"><span class="lm-profile-bar__name"><?= esc_html($lumenti_nombre) ?></span><?php if ($lumenti_cargo !== '') : ?><span class="lm-profile-bar__role"><?= esc_html($lumenti_cargo) ?></span><?php endif; ?></span></div>
        <a<?= $lumenti_wa ?> tabindex="-1"><?= esc_html__('Agendar por WhatsApp', 'lumenti') ?><span class="sr-only"> (<?= esc_html__('se abre en una pestaña nueva', 'lumenti') ?>)</span><span class="lm-btn__icon lm-icon--whatsapp" aria-hidden="true"></span></a>
    </div>
</div>
