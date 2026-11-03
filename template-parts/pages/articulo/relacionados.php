<?php
defined('ABSPATH') || exit;

/*
 * Artículo → relacionados (specs/articulo.md). Sin grupo ACF (textos fijos de la plantilla).
 * wp-query: 3 entradas de la misma categoría, sin repetir la actual, completando con las más recientes si faltan
 * (lumenti_blog_relacionados, inc/blog.php). Cada una con el componente blog-card (listing). Sin entradas no se imprime.
 */

$lumenti_relacionados = [
    'titulo' => 'ARTÍCULOS RELACIONADOS',
    'boton' => 'Ver todos los artículos',
    'items' => lumenti_blog_relacionados(),
];
if (!$lumenti_relacionados['items']) {
    return;
}
?>
<section class="lm-article-related" aria-labelledby="lm-rel-title">
    <div class="lm-article-related__inner">
        <div class="lm-article-related__head">
            <h2 class="lm-section-title" id="lm-rel-title"><?= esc_html($lumenti_relacionados['titulo']) ?></h2>
            <?php get_template_part('template-parts/components/boton', null, [
                'texto' => $lumenti_relacionados['boton'],
                'url' => (string) get_permalink((int) get_option('page_for_posts')),
                'variante' => 'secondary',
                'icono' => 'flecha',
                'clase' => 'lm-article-related__all',
            ]); ?>
        </div>
        <ul class="lm-article-related__grid">
            <?php foreach ($lumenti_relacionados['items'] as $lumenti_e) : ?>
                <li class="lm-blog__item">
                    <?php get_template_part('template-parts/components/blog-card', null, $lumenti_e); ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>
