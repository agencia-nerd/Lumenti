<?php
defined('ABSPATH') || exit;

/*
 * Especialista · barra (specs/especialista.md → barra). Sin grupo propio: reutiliza los campos de perfil.
 * Barra fija de agenda (data-lm-profile-bar): la muestra src/js/modules/especialista.js cuando el botón
 * del perfil sale por arriba. Oculta: aria-hidden="true" y el botón con tabindex="-1".
 */

$lumenti_barra = [
    'nombre_corto' => 'Dra. Mariela Linares',
    'cargo' => 'Médica psiquiatra',
    'foto' => 'assets/img/esp/mariela-linares.webp',
];

$lumenti_foto = has_post_thumbnail() ? get_post_thumbnail_id() : $lumenti_barra['foto'];
$lumenti_nombre = $lumenti_barra['nombre_corto'];
$lumenti_articulo = preg_match('/^Dra\.?\s/i', $lumenti_nombre) ? 'la ' : (preg_match('/^Dr\.?\s/i', $lumenti_nombre) ? 'el ' : '');
$lumenti_wa = lumenti_link_attrs(
    ['url' => lumenti_whatsapp_url('paciente', sprintf('Hola, quisiera agendar una cita con %s.', $lumenti_articulo . $lumenti_nombre)), 'target' => '_blank'],
    ['class' => 'lm-btn lm-btn--primary lm-profile-bar__btn']
);
if ($lumenti_wa === '') {
    return;
}
?>
<div class="lm-profile-bar" data-lm-profile-bar aria-hidden="true">
    <div class="lm-profile-bar__inner">
        <div class="lm-profile-bar__info"><?= lumenti_theme_image($lumenti_foto, ['class' => 'lm-profile-bar__photo', 'alt' => '', 'width' => 48, 'height' => 48, 'size' => 'thumbnail']) ?><span class="lm-profile-bar__text"><span class="lm-profile-bar__name"><?= esc_html($lumenti_nombre) ?></span><?php if ($lumenti_barra['cargo'] !== '') : ?><span class="lm-profile-bar__role"><?= esc_html($lumenti_barra['cargo']) ?></span><?php endif; ?></span></div>
        <a<?= $lumenti_wa ?> tabindex="-1">Agendar por WhatsApp<span class="sr-only"> (<?= esc_html__('se abre en una pestaña nueva', 'lumenti') ?>)</span><span class="lm-btn__icon lm-icon--whatsapp" aria-hidden="true"></span></a>
    </div>
</div>
