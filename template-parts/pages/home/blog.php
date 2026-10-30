<?php
defined('ABSPATH') || exit;

/*
 * Inicio · blog (specs/home.md → blog, grupo ACF home_blog). 4 artículos con template-parts/components/blog-card.php
 * (variante compacta). Textos: get_field('home_blog'). Cards de muestra en inc/muestras/home-blog.php hasta conectar Blog.
 */

$lumenti_blog = get_field('home_blog') ?: [];
$lumenti_titulo = (string) ($lumenti_blog['titulo'] ?? '');
$lumenti_bajada = (string) ($lumenti_blog['bajada'] ?? '');
$lumenti_boton = lumenti_link_data($lumenti_blog['boton'] ?? null);
$lumenti_boton_attrs = $lumenti_boton && $lumenti_boton['title'] !== '' ? lumenti_link_attrs($lumenti_blog['boton'], ['class' => 'lm-btn lm-btn--secondary lm-home-blog__all']) : '';
$lumenti_articulos = require get_theme_file_path('inc/muestras/home-blog.php');
?>
<section class="lm-home-blog"<?php if ($lumenti_titulo !== '') : ?> aria-labelledby="lm-blog"<?php endif; ?> data-lm-section="blog">
    <div class="lm-home-blog__header">
        <div class="lm-home-blog__intro" data-lm-reveal="up">
            <?php if ($lumenti_titulo !== '') : ?>
                <h2 class="lm-h2 lm-home-blog__title" id="lm-blog"><?= esc_html($lumenti_titulo) ?></h2>
            <?php endif; ?>
            <?php if ($lumenti_bajada !== '') : ?>
                <p class="lm-home-blog__lead"><?= esc_html($lumenti_bajada) ?></p>
            <?php endif; ?>
        </div>
        <?php if ($lumenti_boton_attrs !== '') : ?>
            <a<?= $lumenti_boton_attrs ?>><?= esc_html($lumenti_boton['title']) ?><svg class="lm-btn__arrow" aria-hidden="true" width="16" height="16" viewBox="0 0 256 256" fill="currentColor"><path d="M221.66,133.66l-72,72a8,8,0,0,1-11.32-11.32L196.69,136H40a8,8,0,0,1,0-16H196.69L138.34,61.66a8,8,0,0,1,11.32-11.32l72,72A8,8,0,0,1,221.66,133.66Z"/></svg></a>
        <?php endif; ?>
    </div>
    <ul class="lm-home-blog__grid">
        <?php foreach ($lumenti_articulos as $lumenti_articulo) : ?>
            <li class="lm-home-blog__item" data-lm-reveal="up">
                <?php get_template_part('template-parts/components/blog-card', null, $lumenti_articulo); ?>
            </li>
        <?php endforeach; ?>
    </ul>
</section>
