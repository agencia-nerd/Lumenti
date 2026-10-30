<?php
/*
 * Ícono en recuadro con círculo de hover (pie, menú móvil, home).
 * $args: icono (slug de src/img/icons, con clase lm-icon--<icono>), url (opcional: si falta es un <span>),
 *        etiqueta (aria-label del enlace), variante (array o string: 'light', 'sm').
 */
defined('ABSPATH') || exit;

$icono    = $args['icono'] ?? '';
$url      = $args['url'] ?? '';
$etiqueta = $args['etiqueta'] ?? '';
$variante = (array) ($args['variante'] ?? []);

$clases = 'lm-icon-tile';
foreach ($variante as $v) {
    $clases .= ' lm-icon-tile--' . $v;
}
$glifo = '<span class="lm-icon-tile__glyph lm-icon--' . esc_attr($icono) . '" aria-hidden="true"></span>';

if ($url !== '') : ?>
    <a class="<?= esc_attr($clases) ?>" href="<?= esc_url($url) ?>" aria-label="<?= esc_attr($etiqueta) ?>"><?= $glifo // phpcs:ignore -- ya escapado ?></a>
<?php else : ?>
    <span class="<?= esc_attr($clases) ?>" aria-hidden="true"><?= $glifo // phpcs:ignore -- ya escapado ?></span>
<?php endif;
