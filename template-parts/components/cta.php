<?php
defined('ABSPATH') || exit;

/*
 * CTA final (.lm-cta). Diseño: html/partials/cta.html, css/components.css §11 y §20.
 * Video del mar, capa oscura e insignia del cerebro son del componente (archivos del tema), no campos.
 *
 * $args:
 *   titulo      (string, sí)
 *   texto       (string)  se oculta si está vacío.
 *   boton       (array)  $args de boton: ['texto' => 'Agendar una cita', 'whatsapp' => 'paciente', 'mensaje' => '…']
 *               o ['texto', 'url']. Por defecto primary, ícono de WhatsApp y clase lm-cta__btn.
 *   newsletter  (bool)  en lugar del botón, el form de template-parts/forms/newsletter.php (wp-form).
 *   form        (array)  $args del form del newsletter.
 *   video       (campo file de ACF | ID | ruta del tema)  video MP4 o una imagen (jpg, png, webp…); por defecto assets/video/cta-mar-v4.mp4 (las páginas aún no conectadas).
 *   variante    ('' | condicion)  condicion = fondo partido arena/verde (lm-cta--condicion).
 *   id          (string)  id del título. Por defecto lm-cta-title.
 *   nivel       (h2 | h3)  por defecto h2.
 */

$lumenti_titulo = (string) ($args['titulo'] ?? '');
if ($lumenti_titulo === '') {
    return;
}
$lumenti_texto = (string) ($args['texto'] ?? '');
$lumenti_id = (string) ($args['id'] ?? 'lm-cta-title');
$lumenti_nivel = ($args['nivel'] ?? '') === 'h3' ? 'h3' : 'h2';
$lumenti_clase = 'lm-cta' . (($args['variante'] ?? '') === 'condicion' ? ' lm-cta--condicion' : '');
$lumenti_video = $args['video'] ?? 'assets/video/cta-mar-v4.mp4';
// Archivo de ACF (array o ID) → su URL; ruta del tema → URL del tema.
if (is_array($lumenti_video)) {
    $lumenti_video = (string) ($lumenti_video['url'] ?? '');
} elseif (is_int($lumenti_video) || ctype_digit((string) $lumenti_video)) {
    $lumenti_video = (string) wp_get_attachment_url((int) $lumenti_video);
} elseif ((string) $lumenti_video !== '' && !preg_match('#^(https?:)?//#i', (string) $lumenti_video)) {
    $lumenti_video = get_theme_file_uri('/' . ltrim((string) $lumenti_video, '/'));
}
$lumenti_video = (string) $lumenti_video;
$lumenti_es_imagen = (bool) preg_match('/\.(jpe?g|png|webp|avif|gif)(\?.*)?$/i', $lumenti_video);
$lumenti_form = locate_template('template-parts/forms/newsletter.php') !== '';
?>
<section aria-labelledby="<?= esc_attr($lumenti_id) ?>" class="<?= esc_attr($lumenti_clase) ?>" data-lm-cta data-lm-section="cta-final">
    <div class="lm-cta__box">
        <?php if ($lumenti_video !== '' && $lumenti_es_imagen) : ?>
            <img src="<?= esc_url($lumenti_video) ?>" alt="" aria-hidden="true" loading="lazy" decoding="async" class="lm-cta__video">
        <?php elseif ($lumenti_video !== '') : ?>
            <video src="<?= esc_url($lumenti_video) ?>" loop preload="metadata" aria-hidden="true" muted playsinline class="lm-cta__video"></video>
        <?php endif; ?>
        <span aria-hidden="true" class="lm-cta__overlay"></span>
        <span aria-hidden="true" class="lm-cta__badge">
            <?= lumenti_theme_image('assets/img/icon-cerebro.svg', ['class' => 'lm-cta__badge-img', 'alt' => '', 'width' => 49, 'height' => 35]) ?>
        </span>
        <<?= $lumenti_nivel ?> id="<?= esc_attr($lumenti_id) ?>" class="lm-cta__title" data-lm-reveal="up"><?= esc_html($lumenti_titulo) ?></<?= $lumenti_nivel ?>>
        <?php if ($lumenti_texto !== '') : ?>
            <p class="lm-cta__text"><?= esc_html($lumenti_texto) ?></p>
        <?php endif; ?>
        <?php
        if (!empty($args['newsletter'])) {
            if ($lumenti_form) {
                get_template_part('template-parts/forms/newsletter', null, (array) ($args['form'] ?? []));
            }
        } elseif (!empty($args['boton']) && is_array($args['boton'])) {
            $lumenti_boton = $args['boton'];
            $lumenti_boton['clase'] = trim('lm-cta__btn ' . (string) ($lumenti_boton['clase'] ?? ''));
            get_template_part('template-parts/components/boton', null, $lumenti_boton + ['variante' => 'primary', 'icono' => 'whatsapp']);
        }
        ?>
    </div>
</section>
