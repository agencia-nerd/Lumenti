<?php
/**
 * Template Name: Empresas
 *
 * Página de servicio: Empresas. Sus secciones se suman en template-parts/sections/empresas/.
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="main-content">
    <?php
    // Secciones de la página: una por archivo en template-parts/sections/empresas/.
    get_template_part('template-parts/sections/components/cta');
    ?>
</main>

<?php
get_footer();
