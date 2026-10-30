<?php
defined('ABSPATH') || exit;

/*
 * Blog → encabezado (specs/blog.md). Grupo ACF: Blog → blog_encabezado.
 * Breadcrumb y título del blog. En category.php el título es el nombre de la categoría y la bajada su descripción.
 * Título: una línea del h1 por renglón; una línea entera entre *asteriscos* va en color de acento.
 */

$lumenti_encabezado = [
    'etiqueta' => 'BLOG',
    'titulo' => 'RECURSOS Y CONTENIDO
*EDUCATIVO*',
    'bajada' => 'Artículos, guías y recursos sobre salud mental escritos por nuestro equipo de especialistas. Contenido basado en evidencia, claro y accesible para todos.',
];

$lumenti_breadcrumb = [['texto' => __('Blog', 'lumenti')]];

if (is_category()) {
    $lumenti_term = get_queried_object();
    $lumenti_encabezado['titulo'] = mb_strtoupper(single_cat_title('', false), 'UTF-8');
    $lumenti_encabezado['bajada'] = wp_strip_all_tags((string) term_description());
    $lumenti_breadcrumb = [
        ['texto' => __('Blog', 'lumenti'), 'url' => home_url('/blog/')],
        ['texto' => $lumenti_term instanceof WP_Term ? $lumenti_term->name : ''],
    ];
}

// Líneas del h1: [texto, en color de acento].
$lumenti_lineas = [];
foreach (preg_split('/\R/', trim($lumenti_encabezado['titulo'])) as $lumenti_linea) {
    $lumenti_linea = trim($lumenti_linea);
    if ($lumenti_linea === '') {
        continue;
    }
    $lumenti_acento = (bool) preg_match('/^\*(.+)\*$/u', $lumenti_linea, $lumenti_m);
    $lumenti_lineas[] = [$lumenti_acento ? trim($lumenti_m[1]) : $lumenti_linea, $lumenti_acento];
}
?>
<?php get_template_part('template-parts/components/breadcrumb', null, ['items' => $lumenti_breadcrumb]); ?>
<header class="lm-blog__header">
    <?php if ($lumenti_encabezado['etiqueta'] !== '') : ?>
        <p class="lm-eyebrow lm-eyebrow--dot lm-blog__eyebrow"><?= esc_html($lumenti_encabezado['etiqueta']) ?></p>
    <?php endif; ?>
    <h1 class="lm-blog__title"><?php foreach ($lumenti_lineas as [$lumenti_texto, $lumenti_verde]) : ?><span class="lm-blog__title-mask"><span class="lm-blog__title-line<?= $lumenti_verde ? ' lm-blog__title-line--accent' : '' ?>"><?= lumenti_highlight($lumenti_texto) ?></span></span><?php endforeach; ?></h1>
    <?php if ($lumenti_encabezado['bajada'] !== '') : ?>
        <p class="lm-lead lm-blog__lead"><?= esc_html($lumenti_encabezado['bajada']) ?></p>
    <?php endif; ?>
</header>
