<?php
defined('ABSPATH') || exit;

/*
 * Contenido inicial de Blog (specs/blog.md), página de opciones "Archivo de post": el texto que salió de
 * template-parts/pages/blog/ (encabezado y destacado) y del cta de home.php. La etiqueta del encabezado, los
 * filtros y el estado vacío son texto fijo de la plantilla.
 * El artículo destacado (blog_destacado_articulo, campo de inc/campos-extra.php) lo pone inc/carga-extra.php.
 */
return [
    'option' => true,
    'fields' => [
        'blog_encabezado' => [
            'titulo'   => "RECURSOS Y CONTENIDO\n*EDUCATIVO*",
            'bajada'   => 'Artículos, guías y recursos sobre salud mental escritos por nuestro equipo de especialistas. Contenido basado en evidencia, claro y accesible para todos.',
        ],
        'blog_destacado' => [
            'etiqueta'    => 'Destacado',
            'boton_texto' => 'Leer artículo destacado',
        ],
        'blog_cta' => [
            'titulo'      => 'MANTENTE AL DÍA CON NUESTRO CONTENIDO.',
            'texto'       => 'Artículos sobre salud mental escritos por nuestros especialistas. Novedades, recursos y contenido educativo, directo a tu correo y sin spam.',
            'boton_texto' => 'Suscribirme',
            'exito'       => '¡Listo! Te suscribiste. Pronto recibirás nuestros artículos en tu correo.',
        ],
    ],
];
