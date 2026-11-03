<?php
defined('ABSPATH') || exit;

/*
 * Blog → destacado (specs/blog.md). Grupo ACF: Blog → blog_destacado (página de opciones Archivo de post); el
 * artículo es blog_destacado_articulo (post_object, inc/campos-extra.php). Sin artículo elegido no se imprime.
 * No se imprime en category.php; con filtro o búsqueda empieza oculto. Va dentro de la zona data-query="destacado"
 * para que src/js/modules/query.js lo muestre u oculte al filtrar; sus enlaces llevan data-query-ignorar (son
 * páginas normales). En el blog sin filtros no se repite en la grilla (inc/blog.php).
 */

$lumenti_id = is_category() ? 0 : lumenti_blog_destacado_id();
$lumenti_destacado = $lumenti_id ? (get_field('blog_destacado', 'option') ?: []) : [];
$lumenti_categoria = $lumenti_id ? lumenti_blog_categoria($lumenti_id) : null;
$lumenti_url = $lumenti_id ? (string) get_permalink($lumenti_id) : '';
$lumenti_etiqueta = trim((string) ($lumenti_destacado['etiqueta'] ?? ''));
$lumenti_minutos = $lumenti_id ? lumenti_blog_lectura($lumenti_id) : 0;
$lumenti_lectura = $lumenti_minutos > 0 ? sprintf(__('%d min de lectura', 'lumenti'), $lumenti_minutos) : '';
$lumenti_bajada = $lumenti_id ? lumenti_blog_bajada($lumenti_id) : '';
?>
<div data-query="destacado">
    <?php if ($lumenti_id) : ?>
        <article class="lm-blog-featured" data-lm-blog-featured<?= lumenti_blog_filtrado() ? ' hidden' : '' ?>>
            <a class="lm-blog-featured__media" href="<?= esc_url($lumenti_url) ?>" tabindex="-1" aria-hidden="true" data-query-ignorar><?= lumenti_image(get_post_thumbnail_id($lumenti_id) ?: null, ['class' => 'lm-blog-featured__img', 'alt' => '', 'size' => 'large']) ?><?php if ($lumenti_etiqueta !== '') : ?><span class="lm-card-blog__badge"><?= esc_html($lumenti_etiqueta) ?></span><?php endif; ?></a>
            <div class="lm-blog-featured__body">
                <p class="lm-card-blog__meta"><?php if ($lumenti_categoria) : ?><span><?= esc_html($lumenti_categoria->name) ?></span><?php endif; ?><?php if ($lumenti_lectura !== '') : ?><?= $lumenti_categoria ? ' · ' : '' ?><svg aria-hidden="true" width="14" height="14" viewBox="0 0 256 256" fill="currentColor"><path d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm0,192a88,88,0,1,1,88-88A88.1,88.1,0,0,1,128,216Zm64-88a8,8,0,0,1-8,8H128a8,8,0,0,1-8-8V72a8,8,0,0,1,16,0v48h48A8,8,0,0,1,192,128Z"/></svg><?= esc_html($lumenti_lectura) ?><?php endif; ?></p>
                <h2 class="lm-blog-featured__title"><a class="lm-card-blog__title-link" href="<?= esc_url($lumenti_url) ?>" data-query-ignorar><?= esc_html(mb_strtoupper(get_the_title($lumenti_id), 'UTF-8')) ?></a></h2>
                <?php if ($lumenti_bajada !== '') : ?>
                    <p class="lm-blog-featured__excerpt"><?= lumenti_highlight($lumenti_bajada) ?></p>
                <?php endif; ?>
                <?php if (trim((string) ($lumenti_destacado['boton_texto'] ?? '')) !== '') : ?>
                    <div class="lm-blog-featured__action">
                        <?php get_template_part('template-parts/components/boton', null, [
                            'texto' => (string) $lumenti_destacado['boton_texto'],
                            'url' => $lumenti_url,
                            'tamano' => 'md',
                            'icono' => 'flecha',
                            'atributos' => ['data-query-ignorar' => ''],
                        ]); ?>
                    </div>
                <?php endif; ?>
            </div>
        </article>
    <?php endif; ?>
</div>
