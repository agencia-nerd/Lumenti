<?php
defined('ABSPATH') || exit;

/*
 * Blog → paginacion (specs/blog.md). Sin grupo ACF.
 * wp-query: páginas reales de la consulta principal (6 por página). Enlaces /blog/page/2/ que conservan los filtros
 * (get_pagenum_link mantiene ?categoria= y ?q=); con JS, src/js/modules/query.js cambia las zonas sin recargar y
 * baja a los resultados. En un extremo la flecha es un <button disabled> (sin enlace), como en el diseño.
 * La zona data-query="paginacion" siempre existe (vacía con una sola página) para que el JS la actualice.
 */

global $wp_query;
$lumenti_paginas = (int) $wp_query->max_num_pages;
$lumenti_actual = min(max(1, (int) get_query_var('paged')), max(1, $lumenti_paginas));

$lumenti_flechas = [
    'prev' => [__('Página anterior', 'lumenti'), $lumenti_actual - 1, '<path d="M165.66,202.34a8,8,0,0,1-11.32,11.32l-80-80a8,8,0,0,1,0-11.32l80-80a8,8,0,0,1,11.32,11.32L91.31,128Z"/>'],
    'next' => [__('Página siguiente', 'lumenti'), $lumenti_actual + 1, '<path d="M181.66,133.66l-80,80a8,8,0,0,1-11.32-11.32L164.69,128,90.34,53.66a8,8,0,0,1,11.32-11.32l80,80A8,8,0,0,1,181.66,133.66Z"/>'],
];
$lumenti_flecha = static function (string $clave) use ($lumenti_flechas, $lumenti_paginas): void {
    [$lumenti_label, $lumenti_n, $lumenti_path] = $lumenti_flechas[$clave];
    $lumenti_svg = '<svg aria-hidden="true" width="18" height="18" viewBox="0 0 256 256" fill="currentColor">' . $lumenti_path . '</svg>';
    if ($lumenti_n >= 1 && $lumenti_n <= $lumenti_paginas) {
        printf('<a class="lm-blog__page-arrow" href="%s" aria-label="%s" rel="%s">%s</a>', esc_url(get_pagenum_link($lumenti_n)), esc_attr($lumenti_label), $clave === 'prev' ? 'prev' : 'next', $lumenti_svg); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- SVG fijo.
    } else {
        printf('<button class="lm-blog__page-arrow" type="button" aria-label="%s" disabled>%s</button>', esc_attr($lumenti_label), $lumenti_svg); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- SVG fijo.
    }
};
?>
<div data-query="paginacion">
    <?php if ($lumenti_paginas > 1) : ?>
        <nav class="lm-blog__pager" aria-label="<?= esc_attr__('Paginación', 'lumenti') ?>">
            <?php $lumenti_flecha('prev'); ?>
            <span class="lm-pills">
                <?php for ($lumenti_n = 1; $lumenti_n <= $lumenti_paginas; $lumenti_n++) : ?>
                    <a class="lm-blog__page" href="<?= esc_url(get_pagenum_link($lumenti_n)) ?>" aria-label="<?= esc_attr(sprintf(__('Página %d', 'lumenti'), $lumenti_n)) ?>"<?= $lumenti_n === $lumenti_actual ? ' aria-current="page"' : '' ?>><?= esc_html((string) $lumenti_n) ?></a>
                <?php endfor; ?>
            </span>
            <?php $lumenti_flecha('next'); ?>
        </nav>
    <?php endif; ?>
</div>
