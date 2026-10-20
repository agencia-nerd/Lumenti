<?php
defined('ABSPATH') || exit;

/**
 * Ítems de un menú como árbol: cada ítem trae `children` y `is_current`
 * (él o un descendiente es la página actual). Ubicación sin menú → [].
 */
function lumenti_menu_arbol(string $location): array
{
    $locations = get_nav_menu_locations();
    if (empty($locations[$location])) {
        return [];
    }

    $items = wp_get_nav_menu_items($locations[$location], ['update_post_term_cache' => false]);
    if (!$items) {
        return [];
    }

    // Lo mismo que hace wp_nav_menu(): marca current-menu-item / current-menu-ancestor.
    _wp_menu_item_classes_by_context($items);

    $by_id = [];
    foreach ($items as $item) {
        $item->children = [];
        $classes = (array) $item->classes;
        $item->is_current = (bool) array_intersect($classes, ['current-menu-item', 'current-menu-ancestor', 'current-menu-parent']);
        $by_id[$item->ID] = $item;
    }

    $tree = [];
    foreach ($by_id as $item) {
        $parent = (int) $item->menu_item_parent;
        if ($parent && isset($by_id[$parent])) {
            $by_id[$parent]->children[] = $item;
        } else {
            $tree[] = $item;
        }
    }

    return $tree;
}

// Nombre del menú asignado a una ubicación (se usa como título de columna del footer).
function lumenti_menu_nombre(string $location): string
{
    $locations = get_nav_menu_locations();
    $menu = empty($locations[$location]) ? null : wp_get_nav_menu_object($locations[$location]);

    return $menu ? $menu->name : '';
}

// Un ítem es "real" si su URL lleva a algún lado (los títulos de columna usan '#').
function lumenti_menu_url(WP_Post $item): string
{
    $url = trim((string) $item->url);

    return ($url === '' || $url === '#') ? '' : $url;
}

// Mega menú de tarjetas (hijos sin hijos) o de columnas (hijos con hijos).
function lumenti_menu_tipo(WP_Post $item): string
{
    foreach ($item->children as $child) {
        if ($child->children) {
            return 'columnas';
        }
    }

    return 'tarjetas';
}

// El ítem en el formato de un campo Link, para lumenti_link() / lumenti_link_attrs().
// Respeta "Abrir enlace en una pestaña nueva" del admin.
function lumenti_menu_link(WP_Post $item): array
{
    return [
        'url'    => lumenti_menu_url($item),
        'title'  => $item->title,
        'target' => $item->target === '_blank' ? '_blank' : '',
    ];
}

// ¿Es la página actual? (para aria-current).
function lumenti_menu_es_actual(WP_Post $item): bool
{
    return in_array('current-menu-item', (array) $item->classes, true);
}
