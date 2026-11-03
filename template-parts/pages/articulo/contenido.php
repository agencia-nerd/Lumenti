<?php
defined('ABSPATH') || exit;

/*
 * Artículo → contenido (specs/articulo.md). Grupo ACF: Artículo → articulo_contenido (referencias).
 * the_content() en .lm-article__body: párrafos, títulos (h2) y listas del editor se ven como el diseño por el CSS
 * por descendiente (src/css/pages/blog.css). Después, las referencias (una por línea, en letra chica) bajo
 * "REFERENCIAS" y las etiquetas (post_tag) como texto plano; cada bloque solo si tiene algo.
 * Cierra el <article> que abre cabecera.php.
 */

$lumenti_contenido = get_field('articulo_contenido') ?: [];
$lumenti_referencias = array_values(array_filter(array_map('trim', preg_split('/\R/', (string) ($lumenti_contenido['referencias'] ?? '')))));
$lumenti_etiquetas = get_the_tags() ?: [];
?>
    <div class="lm-article__body">
        <?php the_content(); ?>
        <?php if ($lumenti_referencias) : ?>
            <div class="lm-article__refs"><p class="lm-article__tags-label"><?= esc_html__('REFERENCIAS', 'lumenti') ?></p><ol class="lm-article__ref-list"><?php foreach ($lumenti_referencias as $lumenti_ref) : ?><li class="lm-article__ref"><?= lumenti_highlight($lumenti_ref) ?></li><?php endforeach; ?></ol></div>
        <?php endif; ?>
        <?php if ($lumenti_etiquetas) : ?>
            <div class="lm-article__tags"><p class="lm-article__tags-label"><?= esc_html__('ETIQUETAS', 'lumenti') ?></p><ul class="lm-article__tag-list"><?php foreach ($lumenti_etiquetas as $lumenti_tag) : ?><li class="lm-article__tag"><?= esc_html($lumenti_tag->name) ?></li><?php endforeach; ?></ul></div>
        <?php endif; ?>
    </div>
</article>
