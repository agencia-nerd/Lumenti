<?php
defined('ABSPATH') || exit;

/*
 * Navegación: menús de WordPress como árbol de datos (el header y el pie pintan su propio marcado del diseño,
 * con mega menús y submenús móviles, así que no se usa wp_nav_menu) y la sección activa del menú principal.
 */

// Ruta sin barra final, para comparar enlaces con la página actual.
function lumenti_nav_path(string $url): string
{
    return untrailingslashit((string) wp_parse_url($url, PHP_URL_PATH));
}

/*
 * Elementos de la ubicación de menú `$location` como árbol:
 * [['titulo', 'url', 'clases' => [], 'descripcion', 'pagina' (ID de la página destino o 0), 'actual' (bool),
 *   'externo' (bool), 'hijos' => [...]], ...]. Una ubicación sin menú devuelve [].
 */
function lumenti_menu_tree(string $location): array
{
    static $cache = [];
    if (isset($cache[$location])) {
        return $cache[$location];
    }

    $locations = get_nav_menu_locations();
    $items = !empty($locations[$location]) ? (wp_get_nav_menu_items((int) $locations[$location]) ?: []) : [];

    $now = lumenti_nav_path((string) ($_SERVER['REQUEST_URI'] ?? '/'));
    $home_host = (string) wp_parse_url(home_url(), PHP_URL_HOST);
    $nodes = [];
    foreach ($items as $item) {
        $url = (string) $item->url;
        $host = (string) wp_parse_url($url, PHP_URL_HOST);
        $nodes[(int) $item->ID] = [
            'titulo'      => (string) $item->title,
            'url'         => $url,
            'clases'      => array_values(array_filter((array) $item->classes)),
            'descripcion' => (string) $item->description,
            'pagina'      => $item->object === 'page' ? (int) $item->object_id : 0,
            'actual'      => $url !== '#' && $url !== '' && !str_contains($url, '#') && lumenti_nav_path($url) === $now,
            'externo'     => $host !== '' && $host !== $home_host,
            'padre'       => (int) $item->menu_item_parent,
            'hijos'       => [],
        ];
    }

    // Arma el árbol (los elementos ya vienen ordenados por menu_order).
    $tree = [];
    foreach (array_reverse(array_keys($nodes)) as $id) {
        $padre = $nodes[$id]['padre'];
        if ($padre && isset($nodes[$padre])) {
            array_unshift($nodes[$padre]['hijos'], $nodes[$id]);
        }
    }
    foreach ($nodes as $node) {
        if (!$node['padre'] || !isset($nodes[$node['padre']])) {
            $tree[] = $node;
        }
    }

    return $cache[$location] = $tree;
}

// El enlace de un elemento de menú como array de enlace (para lumenti_link / lumenti_link_attrs).
function lumenti_menu_link(array $item): array
{
    return ['url' => $item['url'], 'title' => $item['titulo'], 'target' => $item['externo'] ? '_blank' : ''];
}

/*
 * Sección activa del menú principal para los botones de mega menú (servicios y tratamos), que no tienen
 * enlace propio con el que comparar.
 */
function lumenti_nav_key(): string
{
    if (is_singular('condicion')) {
        return 'tratamos';
    }
    if (is_page_template(['pages/template-psiquiatria.php', 'pages/template-psicologia.php', 'pages/template-informes.php'])) {
        return 'servicios';
    }

    return '';
}
