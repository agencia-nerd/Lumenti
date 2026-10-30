<?php
defined('ABSPATH') || exit;

/*
 * Artículo → relacionados (specs/articulo.md). Sin grupo ACF (textos fijos de la plantilla).
 * 3 artículos de ejemplo del diseño con el componente blog-card (listing); wp-query los cambia por
 * 3 entradas de la misma categoría (completando con otras), sin repetir la actual.
 */

$lumenti_relacionados = [
    'titulo' => 'ARTÍCULOS RELACIONADOS',
    'boton' => 'Ver todos los artículos',
    'items' => [
        [
            'slug' => 'tdah-y-medicacion',
            'titulo' => 'TDAH y medicación: ¿realmente todos la necesitan?',
            'categoria' => 'Neurodivergencias',
            'lectura' => 3,
            'bajada' => 'Recibir un diagnóstico de trastorno por déficit de atención e hiperactividad (TDAH) suele generar muchas preguntas. Una de las más frecuentes es si la medicación será necesaria o si existen otras alternativas para manejar los síntomas.',
        ],
        [
            'slug' => 'fluoxetina-pastilla-de-la-felicidad',
            'titulo' => 'Fluoxetina: ¿realmente es la “pastilla de la felicidad”?',
            'categoria' => 'Tratamientos y evaluaciones',
            'lectura' => 3,
            'bajada' => 'Pocas medicaciones en psiquiatría han sido tan conocidas como la fluoxetina. Desde su lanzamiento a finales de los años 80 bajo el nombre comercial Prozac®, este medicamento se convirtió rápidamente en uno de los antidepresivos más prescritos del mundo y en un fenómeno cultural que trascendió la medicina.',
        ],
        [
            'slug' => 'tratamiento-trastorno-limite-de-la-personalidad',
            'titulo' => '¿Existe un tratamiento efectivo para el trastorno límite de la personalidad?',
            'categoria' => 'Tratamientos y evaluaciones',
            'lectura' => 3,
            'bajada' => 'Durante muchos años existió la idea de que el trastorno límite de la personalidad (TLP) era una condición difícil de tratar. Sin embargo, hoy contamos con evidencia científica sólida que demuestra que existen tratamientos capaces de generar cambios significativos y duraderos.',
        ],
    ],
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
                'url' => home_url('/blog/'),
                'variante' => 'secondary',
                'icono' => 'flecha',
                'clase' => 'lm-article-related__all',
            ]); ?>
        </div>
        <ul class="lm-article-related__grid">
            <?php foreach ($lumenti_relacionados['items'] as $lumenti_e) : ?>
                <li class="lm-blog__item">
                    <?php get_template_part('template-parts/components/blog-card', null, [
                        'titulo' => $lumenti_e['titulo'],
                        'url' => home_url('/' . $lumenti_e['slug'] . '/'),
                        'imagen' => 'assets/img/blog/' . $lumenti_e['slug'] . '.webp',
                        'categoria' => $lumenti_e['categoria'],
                        'lectura' => $lumenti_e['lectura'],
                        'bajada' => $lumenti_e['bajada'],
                        'variante' => 'listing',
                    ]); ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>
