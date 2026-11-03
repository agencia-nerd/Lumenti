<?php
defined('ABSPATH') || exit;

/*
 * Campos ACF que wp-acf todavía no genera (tipo relationship). Código propio del proyecto: no toca la skill ni
 * el JSON generado. Cada campo se suma como subcampo local al grupo de la sección que ya viene de acf-json/
 * (ACF carga ese JSON como campos locales en acf/include_fields, prioridad 10; este archivo corre después).
 * Si una versión futura de wp-acf genera relationship, el campo pasa al spec, se genera y se borra de aquí
 * (mismo nombre: los valores guardados se conservan). Anotado en specs/psiquiatria.md y specs/psicologia.md.
 *
 * - psiquiatria_especialistas_seleccion / psicologia_especialistas_seleccion: especialistas del carrusel,
 *   elegidos y ordenados a mano. Vacío: todos los del tipo de la página, por su orden (lumenti_especialistas_cards).
 * - condicion_especialistas_que_trata (taxonomy): el término de que_trata de cada condición (specs/condicion.md).
 */

const LUMENTI_CAMPOS_SELECCION = [
    'psiquiatria_especialistas' => ['tipo' => 'psiquiatras', 'texto' => 'psiquiatras'],
    'psicologia_especialistas'  => ['tipo' => 'psicologos', 'texto' => 'psicólogos'],
];

add_action('acf/include_fields', function () {
    if (!function_exists('acf_add_local_field') || !function_exists('acf_get_local_store')) {
        return;
    }
    // El campo grupo se lee del almacén local (el JSON), no con acf_get_field(): esa función lo guarda en caché
    // con los subcampos de ese momento y el campo nuevo no aparecería.
    $locales = acf_get_local_store('fields');
    foreach (LUMENTI_CAMPOS_SELECCION as $grupo => $datos) {
        $padre = $locales->get($grupo);
        if (!$padre || ($padre['type'] ?? '') !== 'group') {
            continue;
        }
        acf_add_local_field([
            'key'           => 'field_lumenti_' . $grupo . '_seleccion',
            'label'         => 'Especialistas a mostrar',
            'name'          => 'seleccion',
            'type'          => 'relationship',
            'instructions'  => sprintf('Elige y ordena los especialistas del carrusel (arrastra para ordenar). Vacío: salen todos los %s, por su orden.', $datos['texto']),
            'required'      => 0,
            'post_type'     => ['especialista'],
            'taxonomy'      => ['tipo_especialista:' . $datos['tipo']],
            'filters'       => ['search'],
            'return_format' => 'id',
            'parent'        => $padre['key'],
            'menu_order'    => 100,
        ]);
    }

    // Condición: el término de que_trata que le corresponde (specs/condicion.md → especialistas). El grupo
    // condicion_especialistas viene vacío del JSON; el campo se guarda como condicion_especialistas_que_trata.
    $padre = $locales->get('condicion_especialistas');
    if ($padre && ($padre['type'] ?? '') === 'group') {
        acf_add_local_field([
            'key'           => 'field_lumenti_condicion_especialistas_que_trata',
            'label'         => 'Qué trata',
            'name'          => 'que_trata',
            'type'          => 'taxonomy',
            'instructions'  => 'Condición de esta página. Salen los especialistas que la tienen marcada en su perfil.',
            'required'      => 1,
            'taxonomy'      => 'que_trata',
            'field_type'    => 'select',
            'allow_null'    => 0,
            'add_term'      => 0,
            'save_terms'    => 0,
            'load_terms'    => 0,
            'return_format' => 'id',
            'multiple'      => 0,
            'parent'        => $padre['key'],
            'menu_order'    => 0,
        ]);
    }
}, 20);
