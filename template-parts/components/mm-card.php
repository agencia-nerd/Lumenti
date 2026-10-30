<?php
/*
 * Card con imagen de los mega menús.
 * $args: titulo, texto (bajada; opcional), imagen (ID o campo de imagen, o ruta en el tema), ancho, alto,
 *        url, externo (bool: abre WhatsApp en pestaña nueva), cta (texto del enlace; solo en la card alta),
 *        alta (bool: card alta de "Qué tratamos").
 */
defined('ABSPATH') || exit;

$titulo  = $args['titulo'] ?? '';
$texto   = $args['texto'] ?? '';
$imagen  = $args['imagen'] ?? '';
$ancho   = (int) ($args['ancho'] ?? 587);
$alto_px = (int) ($args['alto'] ?? 334);
$url     = $args['url'] ?? '';
$externo = !empty($args['externo']);
$cta     = $args['cta'] ?? '';
$alta    = !empty($args['alta']);

$flecha = '<svg aria-hidden="true" width="%1$d" height="%1$d" viewBox="0 0 256 256" fill="currentColor"><path d="M221.66,133.66l-72,72a8,8,0,0,1-11.32-11.32L196.69,136H40a8,8,0,0,1,0-16H196.69L138.34,61.66a8,8,0,0,1,11.32-11.32l72,72A8,8,0,0,1,221.66,133.66Z"/></svg>';
$enlace = ['url' => $url, 'title' => $titulo, 'target' => $externo ? '_blank' : ''];
$clases = 'lm-mm-card' . ($alta ? ' lm-mm-card--tall lm-megamenu__stagger' : '');
?>
<a<?= lumenti_link_attrs($enlace, ['class' => $clases]) ?>>
    <?= lumenti_theme_image($imagen, ['class' => 'lm-mm-card__img', 'alt' => '', 'width' => $ancho, 'height' => $alto_px, 'size' => 'large']) ?>
    <span class="lm-mm-card__body">
        <?php if ($alta) : ?>
            <span class="lm-mm-card__title"><?= esc_html($titulo) ?></span>
            <span class="lm-mm-card__cta"><?= esc_html($cta) ?><?php printf($flecha, 16); ?></span>
        <?php else : ?>
            <span class="lm-mm-card__title"><?= esc_html($titulo) ?><?php printf($flecha, 18); ?></span>
            <span class="lm-mm-card__text"><?= esc_html($texto) ?></span>
        <?php endif; ?>
    </span>
</a>
