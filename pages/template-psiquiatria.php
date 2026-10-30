<?php
/*
 * Template Name: Psiquiatría
 *
 * Servicio de psiquiatría (specs/psiquiatria.md). Grupo ACF: Psiquiatría.
 * Cada sección prepara sus datos en template-parts/pages/psiquiatria/ y llama a su componente.
 */
defined('ABSPATH') || exit;

get_header();
?>
<main id="main-content" class="lm-service">
    <?php
    get_template_part('template-parts/pages/psiquiatria/hero');
    get_template_part('template-parts/pages/psiquiatria/intro');
    get_template_part('template-parts/pages/psiquiatria/cita');
    get_template_part('template-parts/pages/psiquiatria/especialistas');
    get_template_part('template-parts/pages/psiquiatria/cta');
    ?>
</main>
<?php
get_footer();
