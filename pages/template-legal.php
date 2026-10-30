<?php

/**
 * Template Name: Legal
 *
 * Textos legales (specs/legal.md): una plantilla para "Política de privacidad" y "Términos y condiciones".
 * Hasta el paso ACF el documento se elige por el slug de la página.
 */

defined('ABSPATH') || exit;

$lumenti_documento = get_post_field('post_name', get_queried_object_id()) === 'terminos-y-condiciones' ? 'terminos' : 'privacidad';

get_header();
?>

<main id="main-content" class="lm-legal-page">
    <?php
    get_template_part('template-parts/pages/legal/cabecera', null, ['documento' => $lumenti_documento]);
    get_template_part('template-parts/pages/legal/documento', null, ['documento' => $lumenti_documento]);
    ?>
</main>

<?php
get_footer();
