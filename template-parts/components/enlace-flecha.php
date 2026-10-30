<?php
defined('ABSPATH') || exit;

/*
 * Enlace con flecha (.lm-link-arrow). Diseño: css/components.css §1.
 *
 * $args:
 *   texto     (string)  texto visible; si falta, el `title` del link ACF.
 *   url       (string | link ACF ['url','title','target'], sí)
 *   externo   (bool)  fuerza pestaña nueva (rel y aviso los pone lumenti_link_attrs); null = lo que diga el link.
 *   icono     (derecha | abajo)  flecha a la derecha (por defecto) o hacia abajo (anclas de la misma página).
 *   clase     (string)  clases extra.
 *   atributos (array)  data-* / aria-* extra, ej. ['data-lm-goto' => 'soluciones'].
 */

$lumenti_url = $args['url'] ?? '';
$lumenti_link = is_array($lumenti_url) ? $lumenti_url : ['url' => (string) $lumenti_url];
$lumenti_texto = (string) ($args['texto'] ?? ($lumenti_link['title'] ?? ''));
$lumenti_icono = ($args['icono'] ?? '') === 'abajo' ? 'abajo' : 'derecha';
$lumenti_atributos = (array) ($args['atributos'] ?? []);

if (isset($args['externo'])) {
    $lumenti_link['target'] = $args['externo'] ? '_blank' : '';
}

$lumenti_attrs = lumenti_link_attrs($lumenti_link, ['class' => trim('lm-link-arrow ' . (string) ($args['clase'] ?? ''))]);
if ($lumenti_texto === '' || $lumenti_attrs === '') {
    return;
}
$lumenti_blank = strpos($lumenti_attrs, 'target="_blank"') !== false;
?>
<a<?= $lumenti_attrs ?><?php foreach ($lumenti_atributos as $lumenti_k => $lumenti_v) : if (preg_match('/^(data|aria)-[a-z0-9-]+$/', (string) $lumenti_k)) : ?> <?= esc_attr($lumenti_k) ?>="<?= esc_attr((string) $lumenti_v) ?>"<?php endif; endforeach; ?>><?= esc_html($lumenti_texto) ?><?php if ($lumenti_blank) : ?><span class="sr-only"> (<?= esc_html__('se abre en una pestaña nueva', 'lumenti') ?>)</span><?php endif; ?><?php if ($lumenti_icono === 'abajo') : ?><svg aria-hidden="true" width="16" height="16" viewBox="0 0 256 256" fill="currentColor"><path d="M205.66,149.66l-72,72a8,8,0,0,1-11.32,0l-72-72a8,8,0,0,1,11.32-11.32L120,196.69V40a8,8,0,0,1,16,0V196.69l58.34-58.35a8,8,0,0,1,11.32,11.32Z"/></svg><?php else : ?><svg aria-hidden="true" width="16" height="16" viewBox="0 0 256 256" fill="currentColor"><path d="M221.66,133.66l-72,72a8,8,0,0,1-11.32-11.32L196.69,136H40a8,8,0,0,1,0-16H196.69L138.34,61.66a8,8,0,0,1,11.32-11.32l72,72A8,8,0,0,1,221.66,133.66Z"/></svg><?php endif; ?></a>
