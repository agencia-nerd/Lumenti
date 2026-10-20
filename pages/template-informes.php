<?php
/**
 * Template Name: Informes y certificados
 *
 * Página de servicio: Informes y certificados. Sus secciones se suman en template-parts/sections/informes/.
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="main-content">
    <?php
    // Secciones de la página: una por archivo en template-parts/sections/informes/.
    get_template_part('template-parts/sections/components/cta');
    ?>
</main>

<?php
get_footer();
