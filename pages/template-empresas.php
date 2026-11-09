<?php

/**
 * Template Name: Empresas
 *
 * Soluciones de salud mental para organizaciones. Spec: specs/empresas.md.
 * Los botones de WhatsApp de la página usan el número corporativo; la cabecera y el botón flotante, la central de
 * citas como en todo el sitio.
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
    $lumenti_cta = get_field('empresas_cta') ?: [];
    $lumenti_boton_texto = (string) ($lumenti_cta['boton_texto'] ?? '');
    get_template_part('template-parts/components/cta', null, [
        'titulo' => (string) ($lumenti_cta['titulo'] ?? ''),
        'texto' => (string) ($lumenti_cta['texto'] ?? ''),
        'boton' => $lumenti_boton_texto !== '' ? [
            'texto' => $lumenti_boton_texto,
            'whatsapp' => 'corporativo',
            'mensaje' => (string) ($lumenti_cta['mensaje_whatsapp'] ?? ''),
        ] : [],
    ]);
    ?>
</main>

<?php
get_footer();
