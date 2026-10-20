<?php
/**
 * Template Name: Psicología
 *
 * Página de servicio: Psicología. Sus secciones se suman en template-parts/sections/psicologia/.
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="main-content">
    <?php
    // Secciones de la página: una por archivo en template-parts/sections/psicologia/.
    get_template_part('template-parts/sections/components/cta');
    ?>
</main>

<?php
get_footer();
