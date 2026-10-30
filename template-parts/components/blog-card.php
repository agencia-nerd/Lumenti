<?php
defined('ABSPATH') || exit;

/*
 * Card de blog (.lm-card-blog). Diseño: css/components.css §18 (home.html compacta, blog.html --listing).
 * Imprime solo la card: el <li> que la envuelve es de la sección.
 *
 * $args:
 *   titulo     (string, sí)  se muestra en mayúsculas (como en el diseño).
 *   url        (string, sí)  enlace al artículo.
 *   imagen     ('assets/img/blog/x.webp' | imagen ACF | ID)  compacta 1600×1067 con alt; listing 800×500 decorativa.
 *   imagen_alt (string)  alt de la imagen en la variante compacta (si falta, el de la imagen).
 *   categoria  (string)  compacta: sobre el título; listing: insignia sobre la imagen.
 *   lectura    (int | string)  minutos (8 → "8 min de lectura") o texto. Solo listing.
 *   bajada     (string)  extracto. Solo listing.
 *   variante   ('' | listing)  '' = compacta (Home); listing = Blog y relacionados.
 *   nivel      (h2 | h3)  por defecto h3.
 *   boton      (string)  texto de la acción: "Leer más" (compacta) / "Ver artículo" (listing) por defecto.
 */

$lumenti_titulo = (string) ($args['titulo'] ?? '');
$lumenti_url = (string) ($args['url'] ?? '');
if ($lumenti_titulo === '' || $lumenti_url === '') {
    return;
}
$lumenti_listing = ($args['variante'] ?? '') === 'listing';
$lumenti_nivel = ($args['nivel'] ?? '') === 'h2' ? 'h2' : 'h3';
$lumenti_categoria = (string) ($args['categoria'] ?? '');
$lumenti_bajada = (string) ($args['bajada'] ?? '');
$lumenti_lectura = $args['lectura'] ?? '';
if (is_int($lumenti_lectura) || ctype_digit((string) $lumenti_lectura)) {
    $lumenti_lectura = (int) $lumenti_lectura > 0 ? sprintf(__('%d min de lectura', 'lumenti'), (int) $lumenti_lectura) : '';
}
$lumenti_lectura = (string) $lumenti_lectura;
$lumenti_flecha = '<svg aria-hidden="true" width="18" height="18" viewBox="0 0 256 256" fill="currentColor" class="lm-card-blog__arrow"><path d="M221.66,133.66l-72,72a8,8,0,0,1-11.32-11.32L196.69,136H40a8,8,0,0,1,0-16H196.69L138.34,61.66a8,8,0,0,1,11.32-11.32l72,72A8,8,0,0,1,221.66,133.66Z"></path></svg>';
?>
<?php if ($lumenti_listing) : ?>
    <?php $lumenti_img = lumenti_theme_image($args['imagen'] ?? '', ['class' => 'lm-card-blog__img', 'alt' => '', 'width' => 800, 'height' => 500, 'size' => 'medium_large']); ?>
    <article class="lm-card-blog lm-card-blog--listing">
        <a class="lm-card-blog__media" href="<?= esc_url($lumenti_url) ?>" tabindex="-1" aria-hidden="true"><?= $lumenti_img ?><?php if ($lumenti_categoria !== '') : ?><span class="lm-card-blog__badge"><?= esc_html($lumenti_categoria) ?></span><?php endif; ?></a>
        <div class="lm-card-blog__body">
            <?php if ($lumenti_lectura !== '') : ?>
                <p class="lm-card-blog__meta"><svg aria-hidden="true" width="14" height="14" viewBox="0 0 256 256" fill="currentColor"><path d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm0,192a88,88,0,1,1,88-88A88.1,88.1,0,0,1,128,216Zm64-88a8,8,0,0,1-8,8H128a8,8,0,0,1-8-8V72a8,8,0,0,1,16,0v48h48A8,8,0,0,1,192,128Z"/></svg><?= esc_html($lumenti_lectura) ?></p>
            <?php endif; ?>
            <<?= $lumenti_nivel ?> class="lm-card-blog__title"><a class="lm-card-blog__title-link" href="<?= esc_url($lumenti_url) ?>"><?= esc_html(mb_strtoupper($lumenti_titulo, 'UTF-8')) ?></a></<?= $lumenti_nivel ?>>
            <?php if ($lumenti_bajada !== '') : ?>
                <p class="lm-card-blog__excerpt"><?= esc_html($lumenti_bajada) ?></p>
            <?php endif; ?>
            <div class="lm-card-blog__action">
                <?php get_template_part('template-parts/components/boton', null, [
                    'texto' => $args['boton'] ?? __('Ver artículo', 'lumenti'),
                    'url' => $lumenti_url,
                    'icono' => 'flecha',
                ]); ?>
            </div>
        </div>
    </article>
<?php else : ?>
    <a href="<?= esc_url($lumenti_url) ?>" class="lm-card-blog">
        <span class="lm-card-blog__media"><?= lumenti_theme_image($args['imagen'] ?? '', ['class' => 'lm-card-blog__img', 'alt' => $args['imagen_alt'] ?? null, 'width' => 1600, 'height' => 1067, 'size' => 'large']) ?></span>
        <?php if ($lumenti_categoria !== '') : ?>
            <span class="lm-card-blog__cat"><?= esc_html(mb_strtoupper($lumenti_categoria, 'UTF-8')) ?></span>
        <?php endif; ?>
        <<?= $lumenti_nivel ?> class="lm-card-blog__title"><?= esc_html(mb_strtoupper($lumenti_titulo, 'UTF-8')) ?></<?= $lumenti_nivel ?>>
        <span class="lm-card-blog__more"><?= esc_html($args['boton'] ?? __('Leer más', 'lumenti')) ?><?= $lumenti_flecha ?></span>
    </a>
<?php endif; ?>
