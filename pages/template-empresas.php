<?php

/**
 * Template Name: Empresas
 *
 * Soluciones de salud mental para organizaciones. Spec: specs/empresas.md.
 * WhatsApp corporativo en toda la página (header.php pone data-lm-wa-context en <body>).
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="main-content" class="lm-emp">
    <?php
    get_template_part('template-parts/pages/empresas/hero');
    get_template_part('template-parts/pages/empresas/desafios');
    get_template_part('template-parts/pages/empresas/soluciones');
    get_template_part('template-parts/pages/empresas/como-trabajamos');
    get_template_part('template-parts/pages/empresas/por-que');
    get_template_part('template-parts/pages/empresas/talleres');
    get_template_part('template-parts/pages/empresas/propuesta');

    // Empresas → cta (grupo ACF empresas_cta): WhatsApp corporativo.
    get_template_part('template-parts/components/cta', null, [
        'titulo' => 'CUIDAR A TU EQUIPO TAMBIÉN ES CUIDAR TU ORGANIZACIÓN.',
        'texto' => 'Diseñamos soluciones de salud mental adaptadas a las necesidades y objetivos de cada empresa.',
        'boton' => [
            'texto' => 'Conversemos por WhatsApp',
            'whatsapp' => 'corporativo',
            'mensaje' => 'Hola, quisiera conversar sobre salud mental para mi organización.',
        ],
    ]);
    ?>
</main>

<?php
get_footer();
