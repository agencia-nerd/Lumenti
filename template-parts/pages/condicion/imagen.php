<?php
defined('ABSPATH') || exit;

/*
 * Condición · imagen (specs/condicion.md → imagen). Grupo ACF: condicion_imagen.
 * Foto principal (2392:999, 4:3 en móvil por CSS), primera pantalla: eager + fetchpriority high. El alt es el de la
 * biblioteca de medios; si falta, el título de la condición. Leyenda opcional sobre la foto, solo si tiene texto.
 */

$lumenti_imagen = get_field('condicion_imagen') ?: [];

$lumenti_img = lumenti_image($lumenti_imagen['foto'] ?? null, [
    'class' => 'lm-cond-media__img',
    'loading' => 'eager',
    'fetchpriority' => 'high',
    'alt_fallback' => get_the_title(),
]);
if ($lumenti_img === '') {
    return;
}
$lumenti_ley_titulo = trim((string) ($lumenti_imagen['leyenda_titulo'] ?? ''));
$lumenti_ley_texto = trim((string) ($lumenti_imagen['leyenda_texto'] ?? ''));
?>
<section class="lm-cond-media" aria-label="<?= esc_attr__('Imagen', 'lumenti') ?>">
    <figure class="lm-cond-media__frame"><?= $lumenti_img ?>
        <?php if ($lumenti_ley_titulo !== '' || $lumenti_ley_texto !== '') : ?>
            <figcaption class="lm-cond-media__caption"><?php if ($lumenti_ley_titulo !== '') : ?><p class="lm-cond-media__caption-title"><?= esc_html($lumenti_ley_titulo) ?></p><?php endif; ?><?php if ($lumenti_ley_texto !== '') : ?><p class="lm-cond-media__caption-text"><?= lumenti_highlight($lumenti_ley_texto) ?></p><?php endif; ?></figcaption>
        <?php endif; ?>
    </figure>
</section>
