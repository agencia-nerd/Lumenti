<?php
/*
 * Ícono en recuadro con círculo de hover (pie, menú móvil, home).
 * $args: icono (slug de src/img/icons, con clase lm-icon--<icono>), url (opcional: si falta es un <span>),
 *        etiqueta (aria-label del enlace), variante (array o string: 'light', 'sm'),
 *        nueva (bool: abre en pestaña nueva; el aviso va dentro del aria-label).
 * El enlace pasa por lumenti_link_attrs (rel, URL segura); sin URL válida queda como <span>.
 */
defined('ABSPATH') || exit;

$icono    = $args['icono'] ?? '';
$url      = $args['url'] ?? '';
$etiqueta = (string) ($args['etiqueta'] ?? '');
$variante = (array) ($args['variante'] ?? []);
$nueva    = !empty($args['nueva']);

$clases = 'lm-icon-tile';
foreach ($variante as $v) {
    $clases .= ' lm-icon-tile--' . $v;
}
$glifo = '<span class="lm-icon-tile__glyph lm-icon--' . esc_attr($icono) . '" aria-hidden="true"></span>';

// El aria-label reemplaza el contenido del enlace: el aviso de pestaña nueva tiene que ir en él.
if ($nueva && $etiqueta !== '') {
    $etiqueta .= ' (' . __('se abre en una pestaña nueva', 'lumenti') . ')';
}
$attrs = $url !== '' ? lumenti_link_attrs(['url' => $url, 'target' => $nueva ? '_blank' : ''], ['class' => $clases, 'label' => $etiqueta]) : '';

if ($attrs !== '') : ?>
    <a<?= $attrs // phpcs:ignore -- ya escapado ?>><?= $glifo // phpcs:ignore -- ya escapado ?></a>
<?php else : ?>
    <span class="<?= esc_attr($clases) ?>" aria-hidden="true"><?= $glifo // phpcs:ignore -- ya escapado ?></span>
<?php endif;
