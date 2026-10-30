<?php

/**
 * Template Name: Preguntas frecuentes
 *
 * Preguntas frecuentes (specs/faq.md): hero, preguntas (wp-accordion) y CTA.
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="main-content" class="lm-service">
    <?php
    get_template_part('template-parts/pages/faq/hero');
    get_template_part('template-parts/pages/faq/preguntas');
    get_template_part('template-parts/pages/faq/cta');
    ?>
</main>

<?php
get_footer();
