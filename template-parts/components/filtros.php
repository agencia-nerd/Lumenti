<?php
defined('ABSPATH') || exit;

/*
 * Controles de filtro (solo marcado, sin lógica). Diseño: css/components.css §7, §8, §9 y §19.
 * Va dentro del <form method="get" data-query="filtros"> de la sección; el JS / wp-query leen name y value.
 *
 * $args:
 *   nombre       (string, sí)  name en la URL (tipo, categoria, edad, atiende, idiomas…).
 *   opciones     (array, sí)  [['valor' => '', 'texto' => 'Todos'], ['valor' => 'psiquiatras', 'texto' => 'Médicos psiquiatras']].
 *   tipo         (segmentado | pills | chips | select)
 *                  segmentado: radios con el aspecto de .lm-segmented (Especialistas).
 *                  pills:      botones submit con aria-pressed (.lm-pills, Blog); sin JS envían el form.
 *                  chips:      filtros activos (.lm-filter-chip) que se quitan; botones type="button".
 *                  select:     campo .lm-field con <label> visible y <select>.
 *   activo       (string)  valor elegido. Por defecto el de la URL (?nombre=) o ''.
 *   etiqueta     (string)  nombre accesible del grupo (aria-label) o texto del <label> del select.
 *   etiqueta_id  (string)  id de un texto visible que nombra el grupo (aria-labelledby), ej. "Filtrar por tema".
 *   clase        (string)  clases extra del contenedor (select: del <label>).
 */

$lumenti_nombre = sanitize_key((string) ($args['nombre'] ?? ''));
$lumenti_opciones = array_values(array_filter((array) ($args['opciones'] ?? []), static fn($o) => is_array($o) && (string) ($o['texto'] ?? '') !== ''));
if ($lumenti_nombre === '' || !$lumenti_opciones) {
    return;
}
$lumenti_tipo = in_array($args['tipo'] ?? '', ['segmentado', 'pills', 'chips', 'select'], true) ? $args['tipo'] : 'pills';
$lumenti_get = $_GET[$lumenti_nombre] ?? ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- filtro GET público.
$lumenti_activo = (string) ($args['activo'] ?? (is_string($lumenti_get) ? sanitize_text_field(wp_unslash($lumenti_get)) : ''));
$lumenti_etiqueta = (string) ($args['etiqueta'] ?? '');
$lumenti_etiqueta_id = (string) ($args['etiqueta_id'] ?? '');
$lumenti_extra = !empty($args['clase']) ? ' ' . $args['clase'] : '';
$lumenti_nombre_grupo = $lumenti_etiqueta_id !== ''
    ? ' aria-labelledby="' . esc_attr($lumenti_etiqueta_id) . '"'
    : ($lumenti_etiqueta !== '' ? ' aria-label="' . esc_attr($lumenti_etiqueta) . '"' : '');
?>
<?php if ($lumenti_tipo === 'segmentado') : ?>
    <div class="lm-segmented<?= esc_attr($lumenti_extra) ?>" role="radiogroup"<?= $lumenti_nombre_grupo ?> data-lm-filter="<?= esc_attr($lumenti_nombre) ?>">
        <?php foreach ($lumenti_opciones as $lumenti_o) : $lumenti_valor = (string) ($lumenti_o['valor'] ?? ''); ?>
            <label class="lm-segmented__btn"><input class="lm-visually-hidden" type="radio" name="<?= esc_attr($lumenti_nombre) ?>" value="<?= esc_attr($lumenti_valor) ?>"<?php checked($lumenti_valor, $lumenti_activo); ?>><?= esc_html($lumenti_o['texto']) ?></label>
        <?php endforeach; ?>
    </div>
<?php elseif ($lumenti_tipo === 'pills') : ?>
    <div class="lm-pills<?= esc_attr($lumenti_extra) ?>" role="group"<?= $lumenti_nombre_grupo ?> data-lm-filter="<?= esc_attr($lumenti_nombre) ?>">
        <?php foreach ($lumenti_opciones as $lumenti_o) : $lumenti_valor = (string) ($lumenti_o['valor'] ?? ''); ?>
            <button class="lm-pills__btn" type="submit" name="<?= esc_attr($lumenti_nombre) ?>" value="<?= esc_attr($lumenti_valor) ?>" aria-pressed="<?= $lumenti_valor === $lumenti_activo ? 'true' : 'false' ?>"><?= esc_html($lumenti_o['texto']) ?></button>
        <?php endforeach; ?>
    </div>
<?php elseif ($lumenti_tipo === 'chips') : ?>
    <?php foreach ($lumenti_opciones as $lumenti_o) : ?>
        <button class="lm-filter-chip<?= esc_attr($lumenti_extra) ?>" type="button" aria-label="<?= esc_attr(sprintf(__('Quitar filtro %s', 'lumenti'), $lumenti_o['texto'])) ?>" data-lm-filter-remove="<?= esc_attr($lumenti_nombre) ?>" value="<?= esc_attr((string) ($lumenti_o['valor'] ?? '')) ?>"><span><?= esc_html($lumenti_o['texto']) ?></span><svg aria-hidden="true" width="14" height="14" viewBox="0 0 256 256" fill="currentColor"><path d="M205.66,194.34a8,8,0,0,1-11.32,11.32L128,139.31,61.66,205.66a8,8,0,0,1-11.32-11.32L116.69,128,50.34,61.66A8,8,0,0,1,61.66,50.34L128,116.69l66.34-66.35a8,8,0,0,1,11.32,11.32L139.31,128Z"/></svg></button>
    <?php endforeach; ?>
<?php else : ?>
    <label class="lm-field<?= esc_attr($lumenti_extra) ?>"><span class="lm-field__label"><?= esc_html($lumenti_etiqueta) ?></span><span class="lm-field__control"><select class="lm-field__select<?= $lumenti_activo !== '' ? ' is-filled' : '' ?>" name="<?= esc_attr($lumenti_nombre) ?>" data-lm-filter="<?= esc_attr($lumenti_nombre) ?>"><?php foreach ($lumenti_opciones as $lumenti_o) : $lumenti_valor = (string) ($lumenti_o['valor'] ?? ''); ?><option value="<?= esc_attr($lumenti_valor) ?>"<?php selected($lumenti_valor, $lumenti_activo); ?>><?= esc_html($lumenti_o['texto']) ?></option><?php endforeach; ?></select><svg class="lm-field__icon lm-field__icon--end" aria-hidden="true" width="18" height="18" viewBox="0 0 256 256" fill="currentColor"><path d="M213.66,101.66l-80,80a8,8,0,0,1-11.32,0l-80-80A8,8,0,0,1,53.66,90.34L128,164.69l74.34-74.35a8,8,0,0,1,11.32,11.32Z"/></svg></span></label>
<?php endif; ?>
