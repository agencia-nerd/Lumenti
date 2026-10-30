<?php

/**
 * Artículo del blog (detalle de una entrada). Spec: specs/articulo.md.
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="main-content">
    <?php
    get_template_part('template-parts/pages/articulo/cabecera');
    get_template_part('template-parts/pages/articulo/contenido');
    get_template_part('template-parts/pages/articulo/relacionados');

    // Artículo → cta: textos fijos de la plantilla; WhatsApp de paciente (opciones_contacto_telefono_paciente).
    get_template_part('template-parts/components/cta', null, [
        'id' => 'lm-cta-art',
        'titulo' => 'COMPRENDER LO QUE TE OCURRE PUEDE SER EL PRIMER PASO',
        'texto' => 'Encuentra información clara y responsable sobre salud mental. Y si necesitas acompañamiento, te ayudamos a encontrar al especialista adecuado.',
        'boton' => [
            'texto' => 'Escríbenos por WhatsApp',
            'whatsapp' => 'paciente',
            'mensaje' => 'Hola, leí un artículo del blog y quisiera orientación.',
        ],
    ]);
    ?>
</main>

<?php
get_footer();
