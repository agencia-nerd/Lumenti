<?php
/*
 * Template Name: Informes y certificados
 *
 * Informes y certificados clínicos (specs/informes.md). Grupo ACF: Informes y certificados.
 * Cada sección prepara sus datos en template-parts/pages/informes/ y llama a su componente.
 */
defined('ABSPATH') || exit;

get_header();
?>
<main id="main-content" class="lm-service">
    <?php
    get_template_part('template-parts/pages/informes/hero');
    get_template_part('template-parts/pages/informes/intro');
    get_template_part('template-parts/pages/informes/tipos');
    get_template_part('template-parts/pages/informes/cta');
    ?>
</main>
<?php
get_footer();
