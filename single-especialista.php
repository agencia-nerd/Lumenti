<?php
/*
 * Perfil de un especialista (specs/especialista.md). Grupo ACF: Especialista (tipo de contenido = especialista).
 * Título e imagen destacada son de WordPress; mientras no hay datos cada sección imprime el ejemplo del diseño.
 * JS: src/js/modules/especialista.js ([data-lm-profile], carrusel de formación y barra fija).
 */
defined('ABSPATH') || exit;

get_header();
?>
<main id="main-content" class="lm-profile" data-lm-profile>
    <span class="lm-profile__deco" aria-hidden="true"></span>
    <?php get_template_part('template-parts/pages/especialista/perfil'); ?>
    <div class="lm-profile__body">
        <?php get_template_part('template-parts/pages/especialista/resumen'); ?>
        <div class="lm-profile__main">
            <?php
            get_template_part('template-parts/pages/especialista/sobre');
            get_template_part('template-parts/pages/especialista/frase');
            get_template_part('template-parts/pages/especialista/formacion');
            get_template_part('template-parts/pages/especialista/actualizacion');
            ?>
        </div>
    </div>
    <?php get_template_part('template-parts/pages/especialista/barra'); ?>
</main>
<?php
get_footer();
