<?php
defined('ABSPATH') || exit;

/*
 * Artículo → cabecera (specs/articulo.md). Grupo ACF: Artículo → articulo_cabecera (bajada). Los minutos de lectura
 * se calculan del contenido (lumenti_reading_time, inc/helpers/lectura.php).
 * Abre <article class="lm-article"> (lo cierra contenido.php). Título de la entrada, primera categoría, bajada
 * (el extracto si el campo está vacío), minutos de lectura e imagen destacada (eager; alt del adjunto o, si falta,
 * el título). Sin imagen destacada no se imprime el figure.
 */

$lumenti_grupo = get_field('articulo_cabecera') ?: [];
$lumenti_categoria = lumenti_blog_categoria();
$lumenti_bajada = trim((string) ($lumenti_grupo['bajada'] ?? ''));
$lumenti_cabecera = [
    'titulo' => get_the_title(),
    'categoria' => $lumenti_categoria ? $lumenti_categoria->name : '',
    'bajada' => $lumenti_bajada !== '' ? $lumenti_bajada : trim((string) get_the_excerpt()),
];
$lumenti_minutos = lumenti_reading_time();
$lumenti_lectura = $lumenti_minutos > 0 ? sprintf(__('%d min de lectura', 'lumenti'), $lumenti_minutos) : '';
$lumenti_img = lumenti_image(get_post_thumbnail_id() ?: null, ['class' => 'lm-article__img', 'loading' => 'eager', 'fetchpriority' => 'high', 'alt_fallback' => $lumenti_cabecera['titulo']]);
?>
<article class="lm-article" aria-labelledby="lm-art-title">
    <?php get_template_part('template-parts/components/breadcrumb', null, ['items' => [
        ['texto' => __('Blog', 'lumenti'), 'url' => (string) get_permalink((int) get_option('page_for_posts'))],
        ['texto' => $lumenti_cabecera['titulo']],
    ]]); ?>
    <header class="lm-article__header">
        <?php if ($lumenti_cabecera['categoria'] !== '') : ?>
            <p class="lm-eyebrow lm-eyebrow--dot lm-blog__eyebrow"><?= esc_html(mb_strtoupper($lumenti_cabecera['categoria'], 'UTF-8')) ?></p>
        <?php endif; ?>
        <h1 class="lm-article__title" id="lm-art-title"><?= esc_html(mb_strtoupper($lumenti_cabecera['titulo'], 'UTF-8')) ?></h1>
        <?php if ($lumenti_cabecera['bajada'] !== '') : ?>
            <p class="lm-lead lm-article__excerpt"><?= lumenti_highlight($lumenti_cabecera['bajada']) ?></p>
        <?php endif; ?>
        <?php if ($lumenti_lectura !== '') : ?>
            <p class="lm-article__meta"><svg aria-hidden="true" width="14" height="14" viewBox="0 0 256 256" fill="currentColor"><path d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm0,192a88,88,0,1,1,88-88A88.1,88.1,0,0,1,128,216Zm64-88a8,8,0,0,1-8,8H128a8,8,0,0,1-8-8V72a8,8,0,0,1,16,0v48h48A8,8,0,0,1,192,128Z"/></svg><?= esc_html($lumenti_lectura) ?></p>
        <?php endif; ?>
    </header>
    <?php if ($lumenti_img !== '') : ?>
        <figure class="lm-article__media"><?= $lumenti_img ?></figure>
    <?php endif; ?>
