<?php

/**
 * Portada del sitio (specs/home.md). WordPress la usa sola para la página fijada como inicio
 * (no tiene Template Name ni se elige en el admin).
 */

defined('ABSPATH') || exit;

get_header();
?>

<?php // Preloader: una vez por sesión (src/js/modules/home.js → preloader). Sin JS queda oculto (hidden). ?>
<div class="lm-preloader" hidden aria-hidden="true" data-lm-preloader>
    <?= lumenti_theme_image('assets/img/logo.svg', ['class' => 'lm-preloader__logo', 'alt' => '', 'width' => 260, 'height' => 42, 'loading' => 'eager']) ?>
    <span class="lm-preloader__dot"></span>
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
