<?php

/**
 * Portada del sitio. WordPress la usa sola para la página fijada como inicio
 * (no tiene Template Name ni se elige en el admin).
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="main-content">
    <?php
    // Secciones de la portada: una por archivo en template-parts/sections/home/.
    get_template_part('template-parts/sections/home/hero');
    get_template_part('template-parts/sections/home/metricas');
    get_template_part('template-parts/sections/home/sobre');
    get_template_part('template-parts/sections/home/servicios');
    get_template_part('template-parts/sections/home/ayuda');
    get_template_part('template-parts/sections/home/psicologia');
    get_template_part('template-parts/sections/home/testimonios');
    get_template_part('template-parts/sections/home/blog');
    get_template_part('template-parts/sections/components/cta');
    ?>
</main>

<?php
get_footer();
