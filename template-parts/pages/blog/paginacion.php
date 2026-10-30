<?php
defined('ABSPATH') || exit;

/*
 * Blog → paginacion (specs/blog.md). Sin grupo ACF.
 * Enlaces reales (/blog/page/2/) con las 3 páginas fijas del diseño hasta que wp-query la conecte.
 * Con JS, blog-filter.js reemplaza los números de [data-lm-blog-pages] y maneja las flechas.
 * En un extremo la flecha es un <button disabled> (sin enlace), como en el diseño.
 */

$lumenti_paginas = is_category() ? 1 : 3;
$lumenti_actual = min(max(1, (int) get_query_var('paged')), $lumenti_paginas);

if ($lumenti_paginas < 2) {
    return;
}

$lumenti_flechas = [
    'prev' => [__('Página anterior', 'lumenti'), $lumenti_actual - 1, '<path d="M165.66,202.34a8,8,0,0,1-11.32,11.32l-80-80a8,8,0,0,1,0-11.32l80-80a8,8,0,0,1,11.32,11.32L91.31,128Z"/>'],
    'next' => [__('Página siguiente', 'lumenti'), $lumenti_actual + 1, '<path d="M181.66,133.66l-80,80a8,8,0,0,1-11.32-11.32L164.69,128,90.34,53.66a8,8,0,0,1,11.32-11.32l80,80A8,8,0,0,1,181.66,133.66Z"/>'],
];
$lumenti_flecha = static function (string $clave) use ($lumenti_flechas, $lumenti_paginas): void {
    [$lumenti_label, $lumenti_n, $lumenti_path] = $lumenti_flechas[$clave];
    $lumenti_svg = '<svg aria-hidden="true" width="18" height="18" viewBox="0 0 256 256" fill="currentColor">' . $lumenti_path . '</svg>';
    if ($lumenti_n >= 1 && $lumenti_n <= $lumenti_paginas) {
        printf('<a class="lm-blog__page-arrow" href="%s" aria-label="%s" data-lm-blog-%s>%s</a>', esc_url(get_pagenum_link($lumenti_n)), esc_attr($lumenti_label), esc_attr($clave), $lumenti_svg);
    } else {
        printf('<button class="lm-blog__page-arrow" type="button" aria-label="%s" data-lm-blog-%s disabled>%s</button>', esc_attr($lumenti_label), esc_attr($clave), $lumenti_svg);
    }
};
?>
<nav class="lm-blog__pager" aria-label="<?= esc_attr__('Paginación', 'lumenti') ?>" data-lm-blog-pager data-query="paginacion">
    <?php $lumenti_flecha('prev'); ?>
    <span class="lm-pills" data-lm-blog-pages>
        <?php for ($lumenti_n = 1; $lumenti_n <= $lumenti_paginas; $lumenti_n++) : ?>
            <a class="lm-blog__page" href="<?= esc_url(get_pagenum_link($lumenti_n)) ?>" aria-label="<?= esc_attr(sprintf(__('Página %d', 'lumenti'), $lumenti_n)) ?>"<?= $lumenti_n === $lumenti_actual ? ' aria-current="page"' : '' ?>><?= esc_html((string) $lumenti_n) ?></a>
        <?php endfor; ?>
    </span>
    <?php $lumenti_flecha('next'); ?>
</nav>
