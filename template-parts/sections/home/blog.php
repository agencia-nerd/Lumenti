<?php
/**
 * Blog (portada): título, botón al blog y tarjetas de artículos (entradas nativas de WordPress).
 * Campos: grupo "Inicio · Blog" (acf-json/group_lumenti_inicio_blog.json). Sin artículos elegidos,
 * salen los 4 más recientes. Foto = imagen destacada; categoría = la primera del post.
 * Hover: src/css/sections/home/blog.css.
 */

if (!function_exists('get_field')) {
    return;
}

$lumenti_elegidos = array_filter(array_map('intval', (array) get_field('blog_articulos', false, false)));
$lumenti_articulos = get_posts([
    'post_type'           => 'post',
    'post_status'         => 'publish',
    'posts_per_page'      => $lumenti_elegidos ? -1 : 4,
    'post__in'            => $lumenti_elegidos,
    'orderby'             => $lumenti_elegidos ? 'post__in' : 'date',
    'ignore_sticky_posts' => true,
]);
if (!$lumenti_articulos) {
    return;
}

$lumenti_titulo = trim((string) get_field('blog_titulo'));
$lumenti_texto = trim((string) get_field('blog_texto'));

// Botón: sin enlace válido → página del blog; sin texto → "Explora nuestro blog".
$lumenti_boton = is_array(get_field('blog_boton')) ? get_field('blog_boton') : [];
if (trim((string) ($lumenti_boton['title'] ?? '')) === '') {
    $lumenti_boton['title'] = __('Explora nuestro blog', 'lumenti');
}
$lumenti_pagina_blog = (int) get_option('page_for_posts');
if (!lumenti_link_data($lumenti_boton) && $lumenti_pagina_blog && get_post_status($lumenti_pagina_blog) === 'publish') {
    $lumenti_boton['url'] = get_permalink($lumenti_pagina_blog);
    $lumenti_boton['target'] = '';
}
$lumenti_boton_data = lumenti_link_data($lumenti_boton);

// Primera categoría con nombre real (no la de por defecto "Sin categoría").
$lumenti_categoria = static function (WP_Post $post): string {
    $defecto = (int) get_option('default_category');
    foreach ((array) get_the_category($post->ID) as $cat) {
        if ((int) $cat->term_id !== $defecto) {
            return $cat->name;
        }
    }
    return '';
};
?>
<section class="px-gutter pt-seccion pb-seccion-lg" <?php echo $lumenti_titulo !== '' ? 'aria-labelledby="lumenti-blog-titulo"' : 'aria-label="' . esc_attr__('Blog', 'lumenti') . '"'; ?>>
    <?php if ($lumenti_titulo !== '' || $lumenti_texto !== '' || $lumenti_boton_data) : ?>
        <div class="mx-auto flex max-w-site flex-wrap items-center justify-center gap-8 text-center md:items-end md:justify-between md:text-left">
            <?php if ($lumenti_titulo !== '' || $lumenti_texto !== '') : ?>
                <div class="max-w-[880px] min-w-0 flex-[1_1_560px]" data-reveal>
                    <?php if ($lumenti_titulo !== '') : ?>
                        <h2 id="lumenti-blog-titulo" class="text-h2 text-balance break-words uppercase"><?php echo esc_html($lumenti_titulo); ?></h2>
                    <?php endif; ?>
                    <?php if ($lumenti_texto !== '') : ?>
                        <p class="mx-auto mt-1 max-w-[600px] leading-[1.7] text-pretty break-words text-cuerpo md:mx-0"><?php echo esc_html($lumenti_texto); ?></p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            <?php if ($lumenti_boton_data && $lumenti_boton_data['title'] !== '') : ?>
                <a<?php echo lumenti_link_attrs($lumenti_boton, ['class' => 'btn btn-tonal flex-none']); ?>>
                    <?php echo esc_html($lumenti_boton_data['title']); ?>
                    <?php echo lumenti_icon('flecha', 'size-4 flex-none'); ?>
                    <?php if ($lumenti_boton_data['blank']) : ?>
                        <span class="sr-only"><?php esc_html_e('(se abre en una pestaña nueva)', 'lumenti'); ?></span>
                    <?php endif; ?>
                </a>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <ul class="mx-auto mt-12 grid max-w-site grid-cols-1 gap-10 md:grid-cols-2 md:gap-x-6 lg:mt-[clamp(48px,3.75vw,72px)] lg:gap-[clamp(24px,1.6667vw,32px)] xl:grid-cols-4">
        <?php foreach ($lumenti_articulos as $lumenti_i => $lumenti_post) : ?>
            <?php $lumenti_cat = $lumenti_categoria($lumenti_post); ?>
            <li class="flex" style="--reveal-i: <?php echo (int) ($lumenti_i % 4); ?>" data-reveal>
                <a href="<?php echo esc_url(get_permalink($lumenti_post)); ?>" class="blog-tarjeta flex min-w-0 flex-1 flex-col text-titulo hover:text-titulo">
                    <span class="block aspect-[560/401] overflow-hidden rounded-sm bg-fondo-alt">
                        <?php
                        // Decorativa: la tarjeta se lee por su título.
                        echo lumenti_image(get_post_thumbnail_id($lumenti_post), [
                            'size'  => 'medium_large',
                            'alt'   => '',
                            'sizes' => '(min-width: 1200px) 25vw, (min-width: 768px) 50vw, 100vw',
                            'class' => 'blog-foto block size-full object-cover',
                        ]);
                        ?>
                    </span>
                    <?php if ($lumenti_cat !== '') : ?>
                        <span class="mt-6 text-caption leading-5 tracking-[0.12em] break-words text-primario uppercase"><?php echo esc_html($lumenti_cat); ?></span>
                    <?php endif; ?>
                    <h3 class="<?php echo $lumenti_cat !== '' ? 'mt-3' : 'mt-6'; ?> line-clamp-2 min-h-[3em] text-titulo-sm leading-[1.5] break-words text-titulo uppercase"><?php echo esc_html(get_the_title($lumenti_post)); ?></h3>
                    <span class="mt-3 inline-flex items-center gap-2.5 leading-6" aria-hidden="true">
                        <?php esc_html_e('Leer más', 'lumenti'); ?>
                        <?php echo lumenti_icon('flecha', 'blog-flecha size-4.5 flex-none'); ?>
                    </span>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</section>
