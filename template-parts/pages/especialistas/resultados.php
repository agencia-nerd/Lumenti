<?php
defined('ABSPATH') || exit;

/*
 * Especialistas · resultados (specs/especialistas.md → resultados). Sin grupo ACF.
 * wp-query: loop de la consulta principal del archivo `especialista`, ya filtrada (inc/query/especialista.php)
 * y ordenada (psiquiatras primero, luego especialista_perfil_orden: inc/especialistas.php).
 * De a 20: "Ver más" (data-query="paginacion") suma los 20 siguientes a la grilla (data-query-items) sin recargar;
 * sin JS abre /especialistas/page/2/. Con 20 o menos no aparece.
 * Cada card es el componente especialista-card (nombre en h2) con los datos del especialista.
 * data-query="resultados" envuelve la lista y el estado vacío para que wp-query los cambie juntos.
 */
$lumenti_hay = have_posts();
?>
<div data-query="resultados">
    <?php if ($lumenti_hay) : ?>
        <ul class="lm-specialists__grid" data-query-items>
            <?php while (have_posts()) : the_post(); ?>
                <li class="lm-specialists__item">
                    <?php get_template_part('template-parts/components/especialista-card', null, lumenti_especialista_card_args() + ['nivel' => 'h2']); ?>
                </li>
            <?php endwhile; ?>
        </ul>
    <?php endif; ?>
    <?php get_template_part('template-parts/pages/especialistas/vacio', null, ['oculto' => $lumenti_hay]); ?>
</div>
<div class="lm-specialists__more" data-query="paginacion">
    <?php
    ob_start();
    lumenti_query_pagination(['more_text' => __('Ver más', 'lumenti'), 'class' => 'lm-specialists__more-nav']);
    // El motor imprime el enlace sin clases: se le suman las del botón del diseño.
    echo str_replace('<a href=', '<a class="lm-btn lm-btn--secondary lm-btn--md" href=', (string) ob_get_clean()); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- HTML ya escapado por el motor.
    ?>
</div>
