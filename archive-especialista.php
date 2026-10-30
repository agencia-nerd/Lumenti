<?php
/*
 * Listado de especialistas (specs/especialistas.md). Archivo del tipo de contenido `especialista` (/especialistas/).
 * Grupo ACF: Especialistas (página de opciones: archivo de especialista).
 * Filtros en el navegador: src/js/modules/specialists-filter.js ([data-lm-specialists]).
 */
defined('ABSPATH') || exit;

get_header();
?>
<main id="main-content" class="lm-specialists" data-lm-specialists>
    <?php
    get_template_part('template-parts/pages/especialistas/encabezado');
    get_template_part('template-parts/pages/especialistas/filtros');
    get_template_part('template-parts/pages/especialistas/resultados');
    ?>
</main>
<?php
get_footer();
