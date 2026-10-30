<?php
defined('ABSPATH') || exit;

/*
 * Artículo → cabecera (specs/articulo.md). Grupo ACF: Artículo → articulo_cabecera (bajada, tiempo_lectura).
 * Abre <article class="lm-article"> (lo cierra contenido.php). Imprime la entrada de ejemplo del diseño
 * ("¿Cómo se diagnostica el TDAH?") hasta que wp-acf / wp-query conecten la entrada real
 * (título, primera categoría, extracto si la bajada está vacía, imagen destacada con su alt).
 */

$lumenti_cabecera = [
    'titulo' => '¿Cómo se diagnostica el TDAH?',
    'categoria' => 'Neurodivergencias',
    'bajada' => 'Una de las dudas más frecuentes sobre el trastorno por déficit de atención e hiperactividad (TDAH) es si existe algún examen que permita confirmarlo de manera objetiva.',
    'tiempo_lectura' => 4,
    'imagen' => ['ruta' => 'assets/img/blog/como-se-diagnostica-el-tdah.webp', 'ancho' => 1600, 'alto' => 667, 'alt' => ''],
];

$lumenti_lectura = (int) $lumenti_cabecera['tiempo_lectura'] > 0 ? sprintf(__('%d min de lectura', 'lumenti'), (int) $lumenti_cabecera['tiempo_lectura']) : '';
$lumenti_img = lumenti_theme_image($lumenti_cabecera['imagen'], ['class' => 'lm-article__img', 'loading' => 'eager', 'fetchpriority' => 'high', 'size' => 'full']);
?>
<article class="lm-article" aria-labelledby="lm-art-title">
    <?php get_template_part('template-parts/components/breadcrumb', null, ['items' => [
        ['texto' => __('Blog', 'lumenti'), 'url' => home_url('/blog/')],
        ['texto' => $lumenti_cabecera['titulo']],
    ]]); ?>
    <header class="lm-article__header">
        <?php if ($lumenti_cabecera['categoria'] !== '') : ?>
            <p class="lm-eyebrow lm-eyebrow--dot lm-blog__eyebrow"><?= esc_html(mb_strtoupper($lumenti_cabecera['categoria'], 'UTF-8')) ?></p>
        <?php endif; ?>
        <h1 class="lm-article__title" id="lm-art-title"><?= esc_html(mb_strtoupper($lumenti_cabecera['titulo'], 'UTF-8')) ?></h1>
        <?php if ($lumenti_cabecera['bajada'] !== '') : ?>
            <p class="lm-lead lm-article__excerpt"><?= esc_html($lumenti_cabecera['bajada']) ?></p>
        <?php endif; ?>
        <?php if ($lumenti_lectura !== '') : ?>
            <p class="lm-article__meta"><svg aria-hidden="true" width="14" height="14" viewBox="0 0 256 256" fill="currentColor"><path d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm0,192a88,88,0,1,1,88-88A88.1,88.1,0,0,1,128,216Zm64-88a8,8,0,0,1-8,8H128a8,8,0,0,1-8-8V72a8,8,0,0,1,16,0v48h48A8,8,0,0,1,192,128Z"/></svg><?= esc_html($lumenti_lectura) ?></p>
        <?php endif; ?>
    </header>
    <?php if ($lumenti_img !== '') : ?>
        <figure class="lm-article__media"><?= $lumenti_img ?></figure>
    <?php endif; ?>
