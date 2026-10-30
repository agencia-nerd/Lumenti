<?php
defined('ABSPATH') || exit;

/*
 * Menús y logo del sitio (skill wp-acf). Datos del proyecto: se escriben desde la tabla "Menús" de
 * specs/_shared.md y el diseño. wp-acf registra las ubicaciones y, la primera vez, crea los menús.
 *
 * Especialistas, blog, condiciones y legales todavía no son páginas de wp-acf: van como URL relativa
 * (las crea inc/carga-extra.php o se conectan después).
 * En `servicios`, la bajada de cada card del mega menú es la "Descripción" del elemento de menú y la
 * imagen es la imagen destacada de la página (las carga inc/carga-extra.php).
 */
return [
    'menus' => [
        'principal' => [
            'nombre' => 'Menú principal',
            'items'  => [
                ['titulo' => 'Inicio', 'pagina' => 'home'],
                // Servicios y Qué tratamos abren los mega menús (menús `servicios` y `tratamos`).
                ['titulo' => 'Servicios', 'url' => '#', 'clases' => 'lm-mega-servicios'],
                ['titulo' => 'Qué tratamos', 'url' => '#', 'clases' => 'lm-mega-tratamos'],
                ['titulo' => 'Especialistas', 'url' => '/especialistas/'],
                ['titulo' => 'Empresas', 'pagina' => 'empresas'],
                ['titulo' => 'Blog', 'url' => '/blog/'],
            ],
        ],
        'servicios' => [
            'nombre' => 'Servicios',
            'items'  => [
                ['titulo' => 'Psiquiatría', 'pagina' => 'psiquiatria'],
                ['titulo' => 'Psicología', 'pagina' => 'psicologia'],
                ['titulo' => 'Empresas', 'pagina' => 'empresas'],
                ['titulo' => 'Informes y certificados', 'pagina' => 'informes'],
            ],
        ],
        'tratamos' => [
            'nombre' => 'Qué tratamos',
            'items'  => [
                ['titulo' => 'ESTADO DEL ÁNIMO', 'url' => '#', 'hijos' => [
                    ['titulo' => 'Depresión', 'url' => '/condicion/depresion/'],
                    ['titulo' => 'Trastorno bipolar', 'url' => '/condicion/bipolar/'],
                    ['titulo' => 'Trastornos de la personalidad', 'url' => '/condicion/personalidad/'],
                    ['titulo' => 'Trastorno dismórfico corporal', 'url' => '/condicion/tdc/'],
                    ['titulo' => 'Trastorno disfórico premenstrual', 'url' => '/condicion/tdpm/'],
                ]],
                ['titulo' => 'ANSIEDAD Y TRAUMA', 'url' => '#', 'hijos' => [
                    ['titulo' => 'Trastornos de ansiedad', 'url' => '/condicion/ansiedad/'],
                    ['titulo' => 'Trauma y estrés postraumático (TEPT)', 'url' => '/condicion/trauma/'],
                    ['titulo' => 'Trastorno obsesivo compulsivo (TOC)', 'url' => '/condicion/toc/'],
                    ['titulo' => 'Adicciones', 'url' => '/condicion/adicciones/'],
                ]],
                ['titulo' => 'OTRAS CONDICIONES', 'url' => '#', 'hijos' => [
                    ['titulo' => 'Trastornos de la conducta alimentaria (TCA)', 'url' => '/condicion/tca/'],
                    ['titulo' => 'Alteraciones del sueño', 'url' => '/condicion/sueno/'],
                    ['titulo' => 'Psicosis y esquizofrenia', 'url' => '/condicion/psicosis/'],
                    ['titulo' => 'Salud mental perinatal', 'url' => '/condicion/perinatal/'],
                    ['titulo' => 'TDAH: evaluación y tratamiento', 'url' => '/condicion/tdah/'],
                    ['titulo' => 'Autismo (TEA): acompañamiento clínico', 'url' => '/condicion/autismo/'],
                    ['titulo' => 'Trastorno límite de la personalidad (TLP)', 'url' => '/condicion/tlp/'],
                ]],
            ],
        ],
        'pie_servicios' => [
            'nombre' => 'Pie: servicios',
            'items'  => [
                ['titulo' => 'Psiquiatría', 'pagina' => 'psiquiatria'],
                ['titulo' => 'Psicología', 'pagina' => 'psicologia'],
                ['titulo' => 'Informes y certificados', 'pagina' => 'informes'],
                ['titulo' => 'Empresas', 'pagina' => 'empresas'],
                ['titulo' => 'Evaluaciones psicológicas', 'url' => '/psicologia/#evaluaciones'],
            ],
        ],
        'pie_explora' => [
            'nombre' => 'Pie: explora',
            'items'  => [
                ['titulo' => 'Especialistas', 'url' => '/especialistas/'],
                ['titulo' => 'Qué tratamos', 'url' => '/#que-tratamos'],
                ['titulo' => 'Blog', 'url' => '/blog/'],
                ['titulo' => 'Preguntas frecuentes', 'pagina' => 'faq'],
            ],
        ],
        'legal' => [
            'nombre' => 'Legal',
            'items'  => [
                ['titulo' => 'Política de privacidad', 'url' => '/politica-de-privacidad/'],
                ['titulo' => 'Términos y condiciones', 'url' => '/terminos-y-condiciones/'],
                ['titulo' => 'Libro de reclamaciones', 'url' => 'https://reclamovirtual.pe/reclamar/lumenti/libro'],
            ],
        ],
    ],
    'logo' => 'assets/img/logo.svg',
];
