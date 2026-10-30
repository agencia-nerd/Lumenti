<?php
defined('ABSPATH') || exit;

/*
 * Carga inicial propia de Lumenti, lo que el motor de wp-acf (inc/acf/runner.php) no cubre:
 * - Las dos páginas legales (una plantilla, dos páginas) y la página de entradas del blog.
 * - Mega menú Servicios: la "Descripción" de cada elemento del menú `servicios` (bajada de la card) y la
 *   imagen destacada de cada página de servicio (imagen de la card).
 * Corre una vez por paso (marcador en opciones), después de la carga de wp-acf: nunca pisa lo editado.
 */

const LUMENTI_CARGA_EXTRA_MARCADOR = 'lumenti_carga_extra';

const LUMENTI_SERVICIOS_MEGA = [
    'psiquiatria' => ['descripcion' => 'Evaluación, diagnóstico y tratamiento integral.', 'imagen' => 'assets/img/mm-psiquiatria.webp'],
    'psicologia'  => ['descripcion' => 'Psicoterapia y evaluaciones psicológicas basadas en evidencia.', 'imagen' => 'assets/img/mm-psicologia.webp'],
    'empresas'    => ['descripcion' => 'Talleres y programas de salud mental para organizaciones.', 'imagen' => 'assets/img/mm-empresas.webp'],
    'informes'    => ['descripcion' => 'Documentos clínicos elaborados previa evaluación profesional.', 'imagen' => 'assets/img/mm-informes.webp'],
];

// Crea una página si no existe (por slug) y devuelve su ID.
function lumenti_carga_pagina(string $slug, string $titulo, string $plantilla = ''): int
{
    $page = get_page_by_path($slug);
    if ($page) {
        return (int) $page->ID;
    }
    $id = wp_insert_post(['post_type' => 'page', 'post_status' => 'publish', 'post_title' => $titulo, 'post_name' => $slug], true);
    if (is_wp_error($id)) {
        return 0;
    }
    if ($plantilla !== '') {
        update_post_meta($id, '_wp_page_template', $plantilla);
    }

    return (int) $id;
}

function lumenti_carga_extra(): void
{
    $hecho = (array) get_option(LUMENTI_CARGA_EXTRA_MARCADOR, []);

    if (empty($hecho['paginas'])) {
        lumenti_carga_pagina('politica-de-privacidad', 'Política de privacidad', 'pages/template-legal.php');
        lumenti_carga_pagina('terminos-y-condiciones', 'Términos y condiciones', 'pages/template-legal.php');
        $blog = lumenti_carga_pagina('blog', 'Blog');
        if ($blog && !get_option('page_for_posts')) {
            update_option('page_for_posts', $blog);
        }
        $hecho['paginas'] = 1;
    }

    // Necesita las páginas y el menú que crea wp-acf: si aún no están, se reintenta en la próxima visita al admin.
    $ubicaciones = get_nav_menu_locations();
    if (empty($hecho['servicios']) && !empty($ubicaciones['servicios']) && function_exists('lumenti_acf_attachment')) {
        $items = wp_get_nav_menu_items((int) $ubicaciones['servicios']) ?: [];
        foreach (LUMENTI_SERVICIOS_MEGA as $slug => $datos) {
            $page = get_page_by_path($slug);
            if (!$page) {
                continue;
            }
            if (!has_post_thumbnail($page)) {
                $imagen = lumenti_acf_attachment($datos['imagen']);
                if ($imagen) {
                    set_post_thumbnail($page, $imagen);
                }
            }
            foreach ($items as $item) {
                if ((int) $item->object_id === (int) $page->ID && trim((string) $item->description) === '') {
                    wp_update_post(['ID' => $item->ID, 'post_content' => $datos['descripcion']]);
                }
            }
        }
        $hecho['servicios'] = 1;
    }

    update_option(LUMENTI_CARGA_EXTRA_MARCADOR, $hecho, false);
}
// Después de la carga de wp-acf al activar el tema (prioridad 10) y, si quedó algo pendiente, en el admin.
add_action('after_switch_theme', 'lumenti_carga_extra', 20);
add_action('admin_init', function () {
    $hecho = (array) get_option(LUMENTI_CARGA_EXTRA_MARCADOR, []);
    if (empty($hecho['paginas']) || empty($hecho['servicios'])) {
        lumenti_carga_extra();
    }
});
