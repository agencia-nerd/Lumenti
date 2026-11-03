<?php

/**
 * Portada del sitio (specs/home.md). WordPress la usa sola para la página fijada como inicio
 * (no tiene Template Name ni se elige en el admin).
 */

defined('ABSPATH') || exit;

get_header();
?>

<?php // Preloader: una vez por sesión (src/js/modules/home.js → preloader). Sin JS queda oculto (hidden). Todo decorativo. ?>
<div class="lm-preloader" hidden aria-hidden="true" data-lm-preloader>
    <span class="lm-preloader__fill" data-lm-pre-fill></span>
    <div class="lm-preloader__logo" data-lm-pre-row>
        <span class="lm-preloader__brain" data-lm-pre-brain></span>
        <span class="lm-preloader__word" data-lm-pre-word></span>
    </div>
    <span class="lm-preloader__ring" data-lm-pre-ring></span>
</div>

<main id="main-content" class="lm-home">
    <?php
    get_template_part('template-parts/pages/home/hero');
    get_template_part('template-parts/pages/home/cifras');
    get_template_part('template-parts/pages/home/sobre');
    get_template_part('template-parts/pages/home/servicios');
    get_template_part('template-parts/pages/home/ayuda');
    get_template_part('template-parts/pages/home/diario');
    get_template_part('template-parts/pages/home/testimonios');
    get_template_part('template-parts/pages/home/blog');
    get_template_part('template-parts/pages/home/cta');
    ?>
</main>

<?php
get_footer();
