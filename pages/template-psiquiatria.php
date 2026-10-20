<?php
/**
 * Template Name: Psiquiatría
 *
 * Página de servicio: Psiquiatría. Sus secciones se suman en template-parts/sections/psiquiatria/.
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="main-content">
    <?php
    // Secciones de la página: una por archivo en template-parts/sections/psiquiatria/.
    get_template_part('template-parts/sections/components/cta');
    ?>
</main>

<?php
get_footer();
