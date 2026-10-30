<?php
defined('ABSPATH') || exit;

/*
 * Botón (.lm-btn). Diseño: css/components.css §1 y §5.
 *
 * $args:
 *   texto     (string, sí)  texto visible.
 *   url       (string | link ACF ['url','title','target'])  destino; con `whatsapp` se ignora.
 *   variante  (primary | secondary | soft)  por defecto primary.
 *   tamano    ('' | md)  md = 52 px de alto.
 *   icono     ('' | flecha | whatsapp)  ícono decorativo al final.
 *   externo   (bool)  abre en pestaña nueva (rel y aviso los pone lumenti_link_attrs). Con whatsapp, true por defecto.
 *   whatsapp  ('' | paciente | corporativo | true)  arma la URL wa.me; true = contexto de la página.
 *   mensaje   (string)  texto prellenado de WhatsApp.
 *   clase     (string)  clases extra (ej. lm-cta__btn).
 *   atributos (array)  data-* / aria-* extra, ej. ['data-lm-goto' => 'formulario'].
 */

$lumenti_texto = (string) ($args['texto'] ?? '');
$lumenti_url = $args['url'] ?? '';
$lumenti_variante = in_array($args['variante'] ?? '', ['primary', 'secondary', 'soft'], true) ? $args['variante'] : 'primary';
$lumenti_tamano = ($args['tamano'] ?? '') === 'md' ? 'md' : '';
$lumenti_icono = (string) ($args['icono'] ?? '');
$lumenti_wa = $args['whatsapp'] ?? '';
$lumenti_externo = $args['externo'] ?? null;
$lumenti_atributos = (array) ($args['atributos'] ?? []);

if ($lumenti_wa) {
    $lumenti_ctx = $lumenti_wa === true ? lumenti_whatsapp_context() : (string) $lumenti_wa;
    $lumenti_url = lumenti_whatsapp_url($lumenti_ctx, (string) ($args['mensaje'] ?? ''));
    $lumenti_externo = $lumenti_externo ?? true;
}

if ($lumenti_texto === '') {
    return;
}

$lumenti_link = is_array($lumenti_url) ? $lumenti_url : ['url' => (string) $lumenti_url];
if ($lumenti_externo !== null) {
    $lumenti_link['target'] = $lumenti_externo ? '_blank' : '';
}

$lumenti_clases = trim('lm-btn lm-btn--' . $lumenti_variante . ($lumenti_tamano ? ' lm-btn--md' : '') . ' ' . (string) ($args['clase'] ?? ''));
$lumenti_attrs = lumenti_link_attrs($lumenti_link, ['class' => $lumenti_clases]);
if ($lumenti_attrs === '') {
    return;
}
$lumenti_blank = strpos($lumenti_attrs, 'target="_blank"') !== false;
?>
<a<?= $lumenti_attrs ?><?php foreach ($lumenti_atributos as $lumenti_k => $lumenti_v) : if (preg_match('/^(data|aria)-[a-z0-9-]+$/', (string) $lumenti_k)) : ?> <?= esc_attr($lumenti_k) ?>="<?= esc_attr((string) $lumenti_v) ?>"<?php endif; endforeach; ?>><?= esc_html($lumenti_texto) ?><?php if ($lumenti_blank) : ?><span class="sr-only"> (<?= esc_html__('se abre en una pestaña nueva', 'lumenti') ?>)</span><?php endif; ?><?php if ($lumenti_icono === 'flecha') : ?><svg class="lm-btn__arrow" aria-hidden="true" width="18" height="18" viewBox="0 0 256 256" fill="currentColor"><path d="M181.66,133.66l-80,80a8,8,0,0,1-11.32-11.32L164.69,128,90.34,53.66a8,8,0,0,1,11.32-11.32l80,80A8,8,0,0,1,181.66,133.66Z"/></svg><?php elseif ($lumenti_icono === 'whatsapp') : ?><svg class="lm-btn__arrow" aria-hidden="true" width="20" height="20" viewBox="0 0 16 16" fill="currentColor"><path d="M13.6683 2.32804C12.9311 1.58732 12.0531 1.00001 11.0854 0.600331C10.1178 0.200649 9.07987 -0.00341053 8.03216 4.3116e-05C3.64221 4.3116e-05 0.0643217 3.56003 0.0643217 7.92802C0.0643217 9.32802 0.434171 10.688 1.12563 11.888L0 16L4.22111 14.896C5.38693 15.528 6.69749 15.864 8.03216 15.864C12.4221 15.864 16 12.304 16 7.93602C16 5.81603 15.1719 3.82403 13.6683 2.32804ZM8.03216 14.52C6.84221 14.52 5.67638 14.2 4.65528 13.6L4.41407 13.456L1.90553 14.112L2.57286 11.68L2.41206 11.432C1.75079 10.3817 1.39974 9.16744 1.39899 7.92802C1.39899 4.29603 4.37387 1.33604 8.02412 1.33604C9.79296 1.33604 11.4573 2.02404 12.7035 3.27203C13.3207 3.88312 13.8098 4.61007 14.1424 5.41069C14.475 6.21132 14.6446 7.06969 14.6412 7.93602C14.6573 11.568 11.6824 14.52 8.03216 14.52ZM11.6663 9.59202C11.4653 9.49602 10.4844 9.01602 10.3075 8.94402C10.1226 8.88002 9.99397 8.84802 9.85729 9.04002C9.7206 9.24002 9.34271 9.68802 9.23015 9.81602C9.11759 9.95202 8.99698 9.96802 8.79598 9.86402C8.59497 9.76802 7.95176 9.55202 7.19598 8.88002C6.601 8.35202 6.20703 7.70402 6.08643 7.50402C5.97387 7.30402 6.07035 7.20002 6.17487 7.09602C6.26332 7.00802 6.37588 6.86402 6.47236 6.75203C6.56884 6.64003 6.60904 6.55203 6.67337 6.42403C6.73769 6.28803 6.70553 6.17603 6.65729 6.08003C6.60904 5.98403 6.20703 5.00803 6.04623 4.60803C5.88543 4.22403 5.71658 4.27203 5.59598 4.26403H5.21005C5.07337 4.26403 4.86432 4.31203 4.6794 4.51203C4.50251 4.71203 3.98794 5.19203 3.98794 6.16803C3.98794 7.14402 4.70352 8.08802 4.8 8.21602C4.89648 8.35202 6.20703 10.352 8.201 11.208C8.67538 11.416 9.04523 11.536 9.33467 11.624C9.80904 11.776 10.2432 11.752 10.5889 11.704C10.9749 11.648 11.7709 11.224 11.9317 10.76C12.1005 10.296 12.1005 9.90402 12.0442 9.81602C11.9879 9.72802 11.8673 9.68802 11.6663 9.59202Z"/></svg><?php endif; ?></a>
