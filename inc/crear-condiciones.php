<?php
defined('ABSPATH') || exit;

/**
 * Datos de arranque de "Qué tratamos": las áreas y las 16 condiciones del prototipo (vacías, solo
 * título, slug, área y orden), el orden de la portada (solo si su campo está vacío) y el paso del
 * menú "Qué tratamos" cargado a mano al ítem automático.
 * Corre al activar el tema y una vez en el admin (opción lumenti_condiciones_creadas).
 * Nunca pisa un área o una condición que ya exista con ese slug, aunque esté en la papelera.
 */
function lumenti_crear_condiciones()
{
    // Áreas [nombre, orden] y condiciones [slug, título, área] en el orden del navbar (menu_order).
    $areas = [
        'estado-del-animo'  => [__('Estado del ánimo', 'lumenti'), 1],
        'ansiedad-y-trauma' => [__('Ansiedad y trauma', 'lumenti'), 2],
        'otras-condiciones' => [__('Otras condiciones', 'lumenti'), 3],
    ];
    $condiciones = [
        ['depresion', __('Depresión', 'lumenti'), 'estado-del-animo'],
        ['bipolar', __('Trastorno bipolar', 'lumenti'), 'estado-del-animo'],
        ['personalidad', __('Otros trastornos de la personalidad', 'lumenti'), 'estado-del-animo'],
        ['tdc', __('Trastorno dismórfico corporal', 'lumenti'), 'estado-del-animo'],
        ['tdpm', __('Trastorno disfórico premenstrual', 'lumenti'), 'estado-del-animo'],
        ['ansiedad', __('Trastornos de ansiedad', 'lumenti'), 'ansiedad-y-trauma'],
        ['trauma', __('Trauma y estrés postraumático (TEPT)', 'lumenti'), 'ansiedad-y-trauma'],
        ['toc', __('Trastorno obsesivo compulsivo (TOC)', 'lumenti'), 'ansiedad-y-trauma'],
        ['adicciones', __('Adicciones', 'lumenti'), 'ansiedad-y-trauma'],
        ['tca', __('Trastornos de la conducta alimentaria', 'lumenti'), 'otras-condiciones'],
        ['sueno', __('Alteraciones del sueño', 'lumenti'), 'otras-condiciones'],
        ['psicosis', __('Psicosis y esquizofrenia', 'lumenti'), 'otras-condiciones'],
        ['perinatal', __('Salud mental perinatal', 'lumenti'), 'otras-condiciones'],
        ['tdah', __('TDAH: evaluación y tratamiento', 'lumenti'), 'otras-condiciones'],
        ['autismo', __('Autismo: evaluación y acompañamiento', 'lumenti'), 'otras-condiciones'],
        ['tlp', __('Trastorno límite de la personalidad', 'lumenti'), 'otras-condiciones'],
    ];
    // Orden de las tarjetas en la portada (campo "Condiciones" de "Inicio · Cómo podemos ayudarte").
    $orden_portada = ['depresion', 'ansiedad', 'tdah', 'tlp', 'tca', 'toc', 'psicosis', 'trauma', 'sueno', 'perinatal', 'bipolar', 'adicciones', 'autismo', 'personalidad', 'tdc', 'tdpm'];

    $ids = [];
    $term_ids = [];
    foreach ($areas as $slug => [$nombre, $orden]) {
        $term = get_term_by('slug', $slug, 'area');
        if (!$term) {
            $nuevo = wp_insert_term($nombre, 'area', ['slug' => $slug]);
            if (is_wp_error($nuevo)) {
                continue;
            }
            update_term_meta($nuevo['term_id'], 'orden', $orden);
            $term_ids[$slug] = (int) $nuevo['term_id'];
        } else {
            $term_ids[$slug] = (int) $term->term_id;
        }
    }

    foreach ($condiciones as $i => [$slug, $titulo, $area]) {
        $existe = get_posts([
            'post_type'      => 'condicion',
            'name'           => $slug,
            'post_status'    => 'any',
            'posts_per_page' => 1,
            'fields'         => 'ids',
        ]);
        if ($existe) {
            $ids[$slug] = (int) $existe[0];
            continue;
        }

        $id = wp_insert_post([
            'post_type'   => 'condicion',
            'post_status' => 'publish',
            'post_title'  => $titulo,
            'post_name'   => $slug,
            'menu_order'  => $i + 1,
        ]);
        if (!$id || is_wp_error($id)) {
            continue;
        }
        $ids[$slug] = (int) $id;
        if (isset($term_ids[$area])) {
            wp_set_object_terms($id, $term_ids[$area], 'area');
        }
    }

    $portada = (int) get_option('page_on_front');
    if ($portada && function_exists('update_field') && !get_field('ayuda_condiciones', $portada, false)) {
        $elegidas = array_values(array_filter(array_map(static fn(string $s): int => $ids[$s] ?? 0, $orden_portada)));
        update_field('field_lumenti_ayuda_condiciones', $elegidas, $portada);
    }

    lumenti_menu_que_tratamos_automatico();
    update_option('lumenti_condiciones_creadas', 1);
}
add_action('after_switch_theme', 'lumenti_crear_condiciones', 20);

/**
 * En el menú principal, el "Qué tratamos" de enlaces personalizados (columnas y condiciones
 * cargadas a mano) pasa a ser el ítem del archivo de Condiciones: se borran sus hijos y el ítem
 * conserva su nombre y su lugar. Si ya es automático, no hace nada.
 */
function lumenti_menu_que_tratamos_automatico()
{
    $locations = get_nav_menu_locations();
    if (empty($locations['primary'])) {
        return;
    }
    $menu_id = (int) $locations['primary'];
    $items = wp_get_nav_menu_items($menu_id, ['post_status' => 'any']);
    if (!$items) {
        return;
    }

    foreach ($items as $item) {
        if ((int) $item->menu_item_parent !== 0 || $item->type !== 'custom' || sanitize_title($item->title) !== 'que-tratamos') {
            continue;
        }

        // Descendientes (columnas y enlaces) del ítem manual.
        $borrar = [(int) $item->ID];
        do {
            $antes = count($borrar);
            foreach ($items as $hijo) {
                if (in_array((int) $hijo->menu_item_parent, $borrar, true) && !in_array((int) $hijo->ID, $borrar, true)) {
                    $borrar[] = (int) $hijo->ID;
                }
            }
        } while (count($borrar) > $antes);
        array_shift($borrar);
        foreach ($borrar as $hijo_id) {
            wp_delete_post($hijo_id, true);
        }

        wp_update_nav_menu_item($menu_id, (int) $item->ID, [
            'menu-item-title'    => $item->title,
            'menu-item-type'     => 'post_type_archive',
            'menu-item-object'   => 'condicion',
            'menu-item-position' => (int) $item->menu_order,
            'menu-item-status'   => 'publish',
        ]);
    }
}

function lumenti_crear_condiciones_una_vez()
{
    if (!get_option('lumenti_condiciones_creadas') && current_user_can('edit_theme_options') && current_user_can('publish_posts')) {
        lumenti_crear_condiciones();
    }
}
add_action('admin_init', 'lumenti_crear_condiciones_una_vez');
