<?php
defined('ABSPATH') || exit;

/**
 * Condiciones ("Qué tratamos"): tipo de contenido `condicion` (/condiciones/<slug>/) agrupado por
 * la taxonomía `area` (Estado del ánimo, Ansiedad y trauma…).
 * - Orden de las condiciones: Atributos → Orden (menu_order). Orden de las áreas: campo "Orden"
 *   (acf-json/group_lumenti_area.json).
 * - El mega menú "Qué tratamos" se arma solo desde aquí: en Apariencia → Menús basta un ítem
 *   "Condiciones" (archivo del tipo de contenido); sus columnas y enlaces no se cargan a mano.
 */
function lumenti_condiciones_registrar()
{
    register_post_type('condicion', [
        'labels' => [
            'name'               => __('Condiciones', 'lumenti'),
            'singular_name'      => __('Condición', 'lumenti'),
            'menu_name'          => __('Condiciones', 'lumenti'),
            'add_new'            => __('Agregar condición', 'lumenti'),
            'add_new_item'       => __('Agregar condición', 'lumenti'),
            'edit_item'          => __('Editar condición', 'lumenti'),
            'new_item'           => __('Nueva condición', 'lumenti'),
            'view_item'          => __('Ver condición', 'lumenti'),
            'search_items'       => __('Buscar condiciones', 'lumenti'),
            'not_found'          => __('No hay condiciones.', 'lumenti'),
            'not_found_in_trash' => __('No hay condiciones en la papelera.', 'lumenti'),
            'all_items'          => __('Todas las condiciones', 'lumenti'),
            'archives'           => __('Condiciones', 'lumenti'),
        ],
        'public'            => true,
        'has_archive'       => 'condiciones', // solo para el ítem del menú; redirige a la sección de la portada
        'rewrite'           => ['slug' => 'condiciones', 'with_front' => false],
        'menu_icon'         => 'dashicons-heart',
        'menu_position'     => 21,
        'supports'          => ['title', 'thumbnail', 'page-attributes'],
        'show_in_nav_menus' => true,
        'show_in_rest'      => false,
    ]);

    register_taxonomy('area', ['condicion'], [
        'labels' => [
            'name'          => __('Áreas', 'lumenti'),
            'singular_name' => __('Área', 'lumenti'),
            'menu_name'     => __('Áreas', 'lumenti'),
            'all_items'     => __('Todas las áreas', 'lumenti'),
            'edit_item'     => __('Editar área', 'lumenti'),
            'add_new_item'  => __('Agregar área', 'lumenti'),
            'search_items'  => __('Buscar áreas', 'lumenti'),
            'not_found'     => __('No hay áreas.', 'lumenti'),
        ],
        'public'            => false,
        'show_ui'           => true,
        'show_admin_column' => true,
        'hierarchical'      => true, // casillas en el editor, en vez de escribir etiquetas
        'show_in_nav_menus' => false,
        'show_in_rest'      => false,
        'rewrite'           => false,
    ]);
}
add_action('init', 'lumenti_condiciones_registrar');

// Las URLs /condiciones/… necesitan reglas nuevas: se regeneran una vez tras registrar el tipo.
function lumenti_condiciones_rewrite_una_vez()
{
    if (get_option('lumenti_condiciones_rewrite') !== '1') {
        flush_rewrite_rules(false);
        update_option('lumenti_condiciones_rewrite', '1');
    }
}
add_action('init', 'lumenti_condiciones_rewrite_una_vez', 20);

// /condiciones/ no tiene diseño propio: lleva a la sección "Cómo podemos ayudarte" de la portada.
function lumenti_condiciones_archivo_redirigir()
{
    if (is_post_type_archive('condicion')) {
        wp_safe_redirect(home_url('/#que-tratamos'));
        exit;
    }
}
add_action('template_redirect', 'lumenti_condiciones_archivo_redirigir');

// Áreas en su orden, cada una con sus condiciones publicadas: [['term' => WP_Term, 'condiciones' => WP_Post[]], …].
// Las condiciones sin área van al final, en un grupo "Otras condiciones".
function lumenti_condiciones_por_area(): array
{
    static $grupos = null;
    if ($grupos !== null) {
        return $grupos;
    }

    $condiciones = get_posts([
        'post_type'      => 'condicion',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'orderby'        => ['menu_order' => 'ASC', 'title' => 'ASC'],
    ]);

    $areas = get_terms(['taxonomy' => 'area', 'hide_empty' => true]);
    $areas = is_wp_error($areas) ? [] : $areas;
    usort($areas, static fn(WP_Term $a, WP_Term $b): int => [(int) get_term_meta($a->term_id, 'orden', true), $a->name] <=> [(int) get_term_meta($b->term_id, 'orden', true), $b->name]);

    $grupos = [];
    foreach ($areas as $area) {
        $grupos[$area->term_id] = ['titulo' => $area->name, 'condiciones' => []];
    }
    $sin_area = [];

    foreach ($condiciones as $condicion) {
        $terminos = get_the_terms($condicion, 'area');
        $id = ($terminos && !is_wp_error($terminos)) ? $terminos[0]->term_id : 0;
        if ($id && isset($grupos[$id])) {
            $grupos[$id]['condiciones'][] = $condicion;
        } else {
            $sin_area[] = $condicion;
        }
    }
    if ($sin_area) {
        $grupos[0] = ['titulo' => __('Otras condiciones', 'lumenti'), 'condiciones' => $sin_area];
    }

    $grupos = array_values(array_filter($grupos, static fn(array $g): bool => (bool) $g['condiciones']));

    return $grupos;
}

// Hijos del ítem "Condiciones" del menú: una columna por área con sus condiciones, con la misma
// forma que los ítems de wp_get_nav_menu_items() para que mega-columnas.php y menu-movil.php no cambien.
function lumenti_menu_condiciones(): array
{
    $actual = is_singular('condicion') ? get_queried_object_id() : 0;
    $columnas = [];

    foreach (lumenti_condiciones_por_area() as $i => $grupo) {
        $enlaces = [];
        foreach ($grupo['condiciones'] as $condicion) {
            $es_actual = $condicion->ID === $actual;
            $enlaces[] = new WP_Post((object) [
                'ID'         => -$condicion->ID,
                'title'      => get_the_title($condicion),
                'url'        => get_permalink($condicion),
                'target'     => '',
                'classes'    => $es_actual ? ['current-menu-item'] : [],
                'is_current' => $es_actual,
                'children'   => [],
            ]);
        }

        $columnas[] = new WP_Post((object) [
            'ID'         => -1000 - $i,
            'title'      => $grupo['titulo'],
            'url'        => '#',
            'target'     => '',
            'classes'    => [],
            'is_current' => (bool) array_filter($enlaces, static fn(WP_Post $e): bool => $e->is_current),
            'children'   => $enlaces,
        ]);
    }

    return $columnas;
}

// ¿Es el ítem del menú que lleva las condiciones? (Apariencia → Menús → Condiciones → Archivo).
function lumenti_menu_es_condiciones(WP_Post $item): bool
{
    return $item->type === 'post_type_archive' && $item->object === 'condicion';
}
