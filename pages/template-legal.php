<?php

/**
 * Template Name: Legal
 *
 * Textos legales (specs/politica-de-privacidad.md): una plantilla para "Política de privacidad" y "Términos y condiciones".
 * Grupo ACF: Legal; cada página guarda su propio documento.
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="main-content" class="lm-legal-page">
    <?php
    get_template_part('template-parts/pages/legal/cabecera');
    get_template_part('template-parts/pages/legal/documento');
    ?>
</main>

<?php
get_footer();
