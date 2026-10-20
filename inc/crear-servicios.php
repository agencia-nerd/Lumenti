<?php
defined('ABSPATH') || exit;

/**
 * Crea las páginas de servicios (vacías, con su plantilla asignada) para elegirlas en la portada.
 * Corre al activar el tema y una vez en el admin para sitios con el tema ya activo.
 * Nunca pisa una página que ya exista con ese slug, aunque esté en borrador o en la papelera.
 */
function lumenti_crear_paginas_servicios()
{
    $paginas = [
        'psiquiatria' => [__('Psiquiatría', 'lumenti'), 'pages/template-psiquiatria.php'],
        'psicologia'  => [__('Psicología', 'lumenti'), 'pages/template-psicologia.php'],
        'informes'    => [__('Informes y certificados', 'lumenti'), 'pages/template-informes.php'],
        'empresas'    => [__('Empresas', 'lumenti'), 'pages/template-empresas.php'],
    ];

    foreach ($paginas as $slug => [$titulo, $plantilla]) {
        $existe = get_posts([
            'post_type'      => 'page',
            'name'           => $slug,
            'post_status'    => 'any',
            'posts_per_page' => 1,
            'fields'         => 'ids',
        ]);
        if ($existe || get_page_by_path($slug)) {
            continue;
        }

        wp_insert_post([
            'post_type'     => 'page',
            'post_status'   => 'publish',
            'post_title'    => $titulo,
            'post_name'     => $slug,
            'page_template' => $plantilla,
        ]);
    }

    update_option('lumenti_paginas_servicios', 1);
}
add_action('after_switch_theme', 'lumenti_crear_paginas_servicios');

function lumenti_crear_paginas_servicios_una_vez()
{
    if (!get_option('lumenti_paginas_servicios') && current_user_can('publish_pages')) {
        lumenti_crear_paginas_servicios();
    }
}
add_action('admin_init', 'lumenti_crear_paginas_servicios_una_vez');
