<?php
/*
 * Página no encontrada (404). WordPress la usa sola cuando una dirección no existe y responde con el código 404.
 * Hero de página interna (variante service) y accesos a las secciones principales con el buscador de especialistas.
 * El texto es fijo del tema (no tiene grupo ACF).
 */
defined('ABSPATH') || exit;

get_header();
?>
<main id="main-content" class="lm-404-page">
    <?php
    get_template_part('template-parts/pages/404/hero');
    get_template_part('template-parts/pages/404/enlaces');
    ?>
</main>
<?php
get_footer();
