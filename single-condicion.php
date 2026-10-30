<?php
/*
 * Página de una condición (specs/condicion.md). Grupo ACF: Condición (tipo de contenido = condicion).
 * El título es de WordPress; mientras no hay datos cada sección imprime el ejemplo del diseño (Depresión).
 * Bloque "tipos": la variante comparativa va antes de las señales; tabla y tarjetas, después de la nota.
 * JS: src/js/modules/condition-filter.js (ajuste del h1 y pills del carrusel) y el acordeón de wp-accordion.
 */
defined('ABSPATH') || exit;

$lumenti_slug = (string) get_post_field('post_name');

get_header();
?>
<main id="main-content" class="lm-cond" data-lm-condition="<?= esc_attr($lumenti_slug !== '' ? $lumenti_slug : 'depresion') ?>">
    <?php
    get_template_part('template-parts/pages/condicion/hero');
    get_template_part('template-parts/pages/condicion/imagen');
    get_template_part('template-parts/pages/condicion/tipos', null, ['posicion' => 'antes']);
    get_template_part('template-parts/pages/condicion/senales'); // incluye la nota dorada al final
    get_template_part('template-parts/pages/condicion/tipos', null, ['posicion' => 'despues']);
    get_template_part('template-parts/pages/condicion/abordaje');
    get_template_part('template-parts/pages/condicion/especialistas');
    get_template_part('template-parts/pages/condicion/cta');
    ?>
</main>
<?php
get_footer();
