<?php
defined('ABSPATH') || exit;

/*
 * Blog → destacado (specs/blog.md). Grupo ACF: Blog → blog_destacado (articulo = post_object).
 * Artículo de ejemplo del diseño hasta que wp-acf conecte la relación. No se imprime en category.php;
 * el JS (data-lm-blog-featured) lo oculta al filtrar o buscar.
 */

if (is_category()) {
    return;
}

$lumenti_destacado = [
    'etiqueta' => 'Destacado',
    'boton_texto' => 'Leer artículo destacado',
    'articulo' => [
        'titulo' => '¿EXISTE UN TRATAMIENTO EFECTIVO PARA EL TRASTORNO LÍMITE DE LA PERSONALIDAD?',
        'url' => home_url('/tratamiento-trastorno-limite-de-la-personalidad/'),
        'imagen' => 'assets/img/blog/tratamiento-trastorno-limite-de-la-personalidad.webp',
        'categoria' => 'Tratamientos y evaluaciones',
        'lectura' => 3,
        'bajada' => 'Durante muchos años existió la idea de que el trastorno límite de la personalidad (TLP) era una condición difícil de tratar. Sin embargo, hoy contamos con evidencia científica sólida que demuestra que existen tratamientos capaces de generar cambios significativos y duraderos.',
    ],
];

$lumenti_art = $lumenti_destacado['articulo'];
if (empty($lumenti_art['titulo']) || empty($lumenti_art['url'])) {
    return;
}

// Con filtro o búsqueda en la URL, el destacado empieza oculto (como lo deja el JS).
// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- filtros GET públicos.
$lumenti_oculto = !empty($_GET['categoria']) || !empty($_GET['q']);
$lumenti_lectura = (int) $lumenti_art['lectura'] > 0 ? sprintf(__('%d min de lectura', 'lumenti'), (int) $lumenti_art['lectura']) : '';
?>
<article class="lm-blog-featured" data-lm-blog-featured<?= $lumenti_oculto ? ' hidden' : '' ?>>
    <a class="lm-blog-featured__media" href="<?= esc_url($lumenti_art['url']) ?>" tabindex="-1" aria-hidden="true"><?= lumenti_theme_image($lumenti_art['imagen'], ['class' => 'lm-blog-featured__img', 'alt' => '', 'width' => 1200, 'height' => 900, 'size' => 'large']) ?><?php if ($lumenti_destacado['etiqueta'] !== '') : ?><span class="lm-card-blog__badge"><?= esc_html($lumenti_destacado['etiqueta']) ?></span><?php endif; ?></a>
    <div class="lm-blog-featured__body">
        <p class="lm-card-blog__meta"><span><?= esc_html($lumenti_art['categoria']) ?></span><?php if ($lumenti_lectura !== '') : ?> · <svg aria-hidden="true" width="14" height="14" viewBox="0 0 256 256" fill="currentColor"><path d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm0,192a88,88,0,1,1,88-88A88.1,88.1,0,0,1,128,216Zm64-88a8,8,0,0,1-8,8H128a8,8,0,0,1-8-8V72a8,8,0,0,1,16,0v48h48A8,8,0,0,1,192,128Z"/></svg><?= esc_html($lumenti_lectura) ?><?php endif; ?></p>
        <h2 class="lm-blog-featured__title"><a class="lm-card-blog__title-link" href="<?= esc_url($lumenti_art['url']) ?>"><?= esc_html(mb_strtoupper($lumenti_art['titulo'], 'UTF-8')) ?></a></h2>
        <?php if ($lumenti_art['bajada'] !== '') : ?>
            <p class="lm-blog-featured__excerpt"><?= esc_html($lumenti_art['bajada']) ?></p>
        <?php endif; ?>
        <div class="lm-blog-featured__action">
            <?php get_template_part('template-parts/components/boton', null, [
                'texto' => $lumenti_destacado['boton_texto'],
                'url' => $lumenti_art['url'],
                'tamano' => 'md',
                'icono' => 'flecha',
            ]); ?>
        </div>
    </div>
</article>
