<?php
defined('ABSPATH') || exit;

/**
 * Al activar el tema, crea los menús del prototipo en las ubicaciones que aún no tienen menú.
 * Nunca toca una ubicación ya asignada. Los enlaces son provisionales (URL con el slug
 * previsto): al crear cada página, cambia el ítem por la página real en Apariencia → Menús.
 */
function lumenti_crear_menus()
{
    $url = static fn(string $path): string => home_url('/' . ltrim($path, '/'));

    $menus = [
        'primary' => [
            'name'  => __('Menú principal', 'lumenti'),
            'items' => [
                ['title' => 'Inicio', 'url' => $url('/')],
                ['title' => 'Servicios', 'url' => '#', 'children' => [
                    ['title' => 'Psiquiatría', 'url' => $url('psiquiatria/'), 'description' => 'Evaluación, diagnóstico y tratamiento integral.'],
                    ['title' => 'Psicología', 'url' => $url('psicologia/'), 'description' => 'Psicoterapia y evaluaciones psicológicas basadas en evidencia.'],
                    ['title' => 'Empresas', 'url' => $url('empresas/'), 'description' => 'Talleres y programas de salud mental para organizaciones.'],
                    ['title' => 'Informes y certificados', 'url' => $url('informes-y-certificados/'), 'description' => 'Documentos clínicos elaborados previa evaluación profesional.'],
                ]],
                // Sus columnas y enlaces salen solos de Condiciones → Áreas (inc/condiciones.php).
                ['title' => 'Qué tratamos', 'type' => 'post_type_archive', 'object' => 'condicion'],
                ['title' => 'Especialistas', 'url' => $url('especialistas/')],
                ['title' => 'Empresas', 'url' => $url('empresas/')],
                ['title' => 'Blog', 'url' => $url('blog/')],
            ],
        ],
        'footer-servicios' => [
            'name'  => __('Servicios', 'lumenti'),
            'items' => [
                ['title' => 'Psiquiatría', 'url' => $url('psiquiatria/')],
                ['title' => 'Psicología', 'url' => $url('psicologia/')],
                ['title' => 'Informes y certificados', 'url' => $url('informes-y-certificados/')],
                ['title' => 'Empresas', 'url' => $url('empresas/')],
                ['title' => 'Evaluaciones psicológicas', 'url' => $url('psicologia/#evaluaciones')],
            ],
        ],
        'footer-explora' => [
            'name'  => __('Explora', 'lumenti'),
            'items' => [
                ['title' => 'Especialistas', 'url' => $url('especialistas/')],
                ['title' => 'Qué tratamos', 'url' => $url('/#que-tratamos')],
                ['title' => 'Blog', 'url' => $url('blog/')],
                ['title' => 'Preguntas frecuentes', 'url' => $url('preguntas-frecuentes/')],
            ],
        ],
        'legal' => [
            'name'  => __('Legal', 'lumenti'),
            'items' => [
                ['title' => 'Política de privacidad', 'url' => $url('politica-de-privacidad/')],
                ['title' => 'Términos y condiciones', 'url' => $url('terminos-y-condiciones/')],
                ['title' => 'Libro de reclamaciones', 'url' => 'https://reclamovirtual.pe/reclamar/lumenti/libro', 'target' => '_blank'],
            ],
        ],
    ];

    $locations = get_nav_menu_locations();

    foreach ($menus as $location => $menu) {
        if (!empty($locations[$location]) && wp_get_nav_menu_object($locations[$location])) {
            continue;
        }

        // Si ya existe un menú con ese nombre (activación anterior), se reutiliza sin duplicar ítems.
        $existing = wp_get_nav_menu_object($menu['name']);
        if ($existing) {
            $menu_id = $existing->term_id;
        } else {
            $menu_id = wp_create_nav_menu($menu['name']);
            if (is_wp_error($menu_id)) {
                continue;
            }
            lumenti_crear_menu_items($menu_id, $menu['items']);
        }

        $locations[$location] = $menu_id;
    }

    set_theme_mod('nav_menu_locations', $locations);
}
add_action('after_switch_theme', 'lumenti_crear_menus');

function lumenti_crear_menu_items(int $menu_id, array $items, int $parent = 0)
{
    foreach ($items as $item) {
        $item_id = wp_update_nav_menu_item($menu_id, 0, [
            'menu-item-title'       => $item['title'],
            'menu-item-url'         => $item['url'] ?? '',
            'menu-item-description' => $item['description'] ?? '',
            'menu-item-target'      => $item['target'] ?? '',
            'menu-item-type'        => $item['type'] ?? 'custom',
            'menu-item-object'      => $item['object'] ?? '',
            'menu-item-status'      => 'publish',
            'menu-item-parent-id'   => $parent,
        ]);

        if (!is_wp_error($item_id) && !empty($item['children'])) {
            lumenti_crear_menu_items($menu_id, $item['children'], (int) $item_id);
        }
    }
}
