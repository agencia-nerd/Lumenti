<?php
/*
 * Template Name: Psicología
 *
 * Servicio de psicología (specs/psicologia.md). Grupo ACF: Psicología.
 * Cada sección prepara sus datos en template-parts/pages/psicologia/ y llama a su componente.
 */
defined('ABSPATH') || exit;

get_header();
?>
<main id="main-content" class="lm-service">
    <?php
    get_template_part('template-parts/pages/psicologia/hero');
    get_template_part('template-parts/pages/psicologia/intro');
    get_template_part('template-parts/pages/psicologia/servicios');
    get_template_part('template-parts/pages/psicologia/especialistas');
    get_template_part('template-parts/pages/psicologia/cta');
    ?>
</main>
<?php
get_footer();
