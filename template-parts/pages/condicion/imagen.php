<?php
defined('ABSPATH') || exit;

/*
 * Condición · imagen (specs/condicion.md → imagen). Grupo ACF: condicion_imagen.
 * Foto principal (2392:999, 4:3 en móvil por CSS), primera pantalla: eager + fetchpriority high.
 * Leyenda opcional sobre la foto, solo si tiene texto (ej. Personalidad).
 */

$lumenti_imagen = [
    'foto' => ['ruta' => 'assets/img/cond-depresion.webp', 'ancho' => 2392, 'alto' => 1000, 'alt' => 'Dos personas tomadas de la mano en señal de apoyo'],
    'leyenda_titulo' => '',
    'leyenda_texto' => '',
];

$lumenti_img = lumenti_theme_image($lumenti_imagen['foto'], ['class' => 'lm-cond-media__img', 'loading' => 'eager', 'fetchpriority' => 'high']);
if ($lumenti_img === '') {
    return;
}
$lumenti_leyenda = trim($lumenti_imagen['leyenda_titulo']) !== '' || trim($lumenti_imagen['leyenda_texto']) !== '';
?>
<section class="lm-cond-media" aria-label="Imagen">
    <figure class="lm-cond-media__frame"><?= $lumenti_img ?>
        <?php if ($lumenti_leyenda) : ?>
            <figcaption class="lm-cond-media__caption"><?php if ($lumenti_imagen['leyenda_titulo'] !== '') : ?><p class="lm-cond-media__caption-title"><?= esc_html($lumenti_imagen['leyenda_titulo']) ?></p><?php endif; ?><?php if ($lumenti_imagen['leyenda_texto'] !== '') : ?><p class="lm-cond-media__caption-text"><?= esc_html($lumenti_imagen['leyenda_texto']) ?></p><?php endif; ?></figcaption>
        <?php endif; ?>
    </figure>
</section>
