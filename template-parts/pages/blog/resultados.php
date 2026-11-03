<?php
defined('ABSPATH') || exit;

/*
 * Blog → resultados (specs/blog.md). Sin grupo ACF: el estado vacío es texto fijo.
 * wp-query: loop de la consulta principal del blog (o de la categoría), ya filtrada por ?categoria= y ?q=
 * (inc/query/post.php), de a 6. Sin filtros, el destacado no se repite aquí (inc/blog.php) pero cuenta en el total.
 * Zonas: total ("Mostrando N de M entradas") y resultados (la grilla y el mensaje vacío, juntos).
 * Cada card es el componente blog-card (variante listing). Al cambiar de página o de filtro las cards entran
 * escalonadas (is-entering, src/js/modules/blog-filter.js).
 */

global $wp_query;
$lumenti_hay = have_posts();
// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- búsqueda GET pública.
$lumenti_q = isset($_GET['q']) && is_string($_GET['q']) ? sanitize_text_field(wp_unslash($_GET['q'])) : '';

// El destacado está arriba (no en la grilla): se suma a lo que se ve y al total, como en el diseño.
$lumenti_destacado = !is_category() && !lumenti_blog_filtrado() && lumenti_blog_destacado_id() ? 1 : 0;
$lumenti_visibles = (int) $wp_query->post_count + $lumenti_destacado;
$lumenti_total = (int) $wp_query->found_posts + $lumenti_destacado;
?>
<p class="lm-blog__count" aria-live="polite" data-query="total"><?= esc_html(sprintf(__('Mostrando %1$d de %2$d entradas', 'lumenti'), $lumenti_visibles, $lumenti_total)) ?></p>
<div data-query="resultados">
    <?php if ($lumenti_hay) : ?>
        <ul class="lm-blog__grid" data-lm-blog-grid>
            <?php while (have_posts()) : the_post(); ?>
                <li class="lm-blog__item">
                    <?php get_template_part('template-parts/components/blog-card', null, lumenti_blog_card_args()); ?>
                </li>
            <?php endwhile; ?>
        </ul>
    <?php endif; ?>
    <?php if (!$lumenti_hay) : ?>
        <div class="lm-blog__empty" role="status">
            <span class="lm-blog__empty-icon" aria-hidden="true"><svg width="28" height="28" viewBox="0 0 256 256" fill="currentColor"><path d="M229.66,218.34l-50.07-50.06a88.11,88.11,0,1,0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.32ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z"/></svg></span>
            <p class="lm-blog__empty-title"><?= esc_html__('NO ENCONTRAMOS ARTÍCULOS', 'lumenti') ?></p>
            <p class="lm-blog__empty-text">
                <?php if ($lumenti_q !== '') : ?>
                    <?= esc_html(sprintf(__('No hay artículos que coincidan con «%s».', 'lumenti'), $lumenti_q)) ?><br>
                <?php endif; ?>
                <?= esc_html__('Prueba con otra categoría o palabra.', 'lumenti') ?>
            </p>
            <?php get_template_part('template-parts/components/boton', null, [
                'texto' => __('Ver todos los artículos', 'lumenti'),
                'url' => (string) get_permalink((int) get_option('page_for_posts')),
                'variante' => 'secondary',
                'icono' => 'flecha',
                'clase' => 'lm-blog__empty-btn',
            ]); ?>
        </div>
    <?php endif; ?>
</div>
