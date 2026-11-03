<?php
defined('ABSPATH') || exit;

/*
 * Blog → filtros (specs/blog.md). Sin grupo ACF: "Filtrar por tema", "Todos" y el placeholder del buscador son fijos.
 * wp-query: <form method="get" data-query="filtros"> con las categorías de lumenti_query_filters('post') y el
 * buscador ?q=. Las pills son enlaces (?categoria=<slug>, "Todos" la quita y conserva la búsqueda): con JS
 * src/js/modules/query.js cambia las zonas sin recargar; sin JS, recargan. La categoría elegida va también en un
 * campo oculto para que buscar no la pierda. En una categoría (/blog/categoria/<tema>/) su pill queda activa y
 * las otras llevan al blog filtrado, recargando (data-query-ignorar: el encabezado cambia).
 * No muestra la categoría por defecto de WordPress ("Sin categoría").
 */

$lumenti_etiqueta = __('Filtrar por tema', 'lumenti');
$lumenti_placeholder = __('Buscar artículos…', 'lumenti');

$lumenti_filtros = function_exists('lumenti_query_filters') ? lumenti_query_filters('post') : [];
$lumenti_categoria = $lumenti_filtros['categoria'] ?? null;
$lumenti_q = (string) ($lumenti_filtros['q']['valor'] ?? '');
$lumenti_activo = (string) (((array) ($lumenti_categoria['valor'] ?? []))[0] ?? '');
$lumenti_en_categoria = is_category();
if ($lumenti_en_categoria) {
    $lumenti_term = get_queried_object();
    $lumenti_activo = $lumenti_term instanceof WP_Term ? $lumenti_term->slug : '';
}

// URL de una pill: el blog con la categoría (o sin ella) y la búsqueda actual.
$lumenti_blog = (string) get_permalink((int) get_option('page_for_posts'));
$lumenti_url = static function (string $valor) use ($lumenti_blog, $lumenti_q, $lumenti_en_categoria): string {
    $args = array_filter(['categoria' => $valor, 'q' => $lumenti_en_categoria ? '' : $lumenti_q], 'strlen');
    return add_query_arg(array_map('rawurlencode', $args), $lumenti_blog);
};

$lumenti_sin_categoria = get_term((int) get_option('default_category'), 'category');
$lumenti_excluir = $lumenti_sin_categoria instanceof WP_Term ? $lumenti_sin_categoria->slug : '';
// En el orden en que se crearon las categorías (el del diseño), no alfabético.
$lumenti_lista = (array) ($lumenti_categoria['opciones'] ?? []);
$lumenti_ids = [];
foreach ($lumenti_lista as $lumenti_o) {
    $lumenti_t = get_term_by('slug', (string) $lumenti_o['valor'], 'category');
    $lumenti_ids[(string) $lumenti_o['valor']] = $lumenti_t ? (int) $lumenti_t->term_id : PHP_INT_MAX;
}
usort($lumenti_lista, static fn($a, $b) => $lumenti_ids[(string) $a['valor']] <=> $lumenti_ids[(string) $b['valor']]);
$lumenti_opciones = [['valor' => '', 'texto' => __('Todos', 'lumenti')]];
foreach ($lumenti_lista as $lumenti_o) {
    if ((string) $lumenti_o['valor'] !== $lumenti_excluir) {
        $lumenti_opciones[] = ['valor' => (string) $lumenti_o['valor'], 'texto' => (string) $lumenti_o['etiqueta']];
    }
}
$lumenti_accion = function_exists('lumenti_query_reset_url') ? lumenti_query_reset_url() : $lumenti_blog;
?>
<form class="lm-blog__toolbar" method="get" action="<?= esc_url($lumenti_accion) ?>" role="search" data-query="filtros">
    <div class="lm-blog__filters">
        <?php if ($lumenti_etiqueta !== '') : ?>
            <p class="lm-blog__filters-label" id="lm-blog-cats"><?= esc_html($lumenti_etiqueta) ?></p>
        <?php endif; ?>
        <div class="lm-pills" role="group" <?= $lumenti_etiqueta !== '' ? 'aria-labelledby="lm-blog-cats"' : 'aria-label="' . esc_attr__('Categorías', 'lumenti') . '"' ?>>
            <?php foreach ($lumenti_opciones as $lumenti_o) : $lumenti_actual = $lumenti_o['valor'] === $lumenti_activo; ?>
                <a class="lm-pills__btn" href="<?= esc_url($lumenti_url($lumenti_o['valor'])) ?>"<?= $lumenti_actual ? ' aria-current="true"' : '' ?><?= $lumenti_en_categoria ? ' data-query-ignorar' : '' ?>><?= esc_html($lumenti_o['texto']) ?></a>
            <?php endforeach; ?>
        </div>
    </div>
    <?php if (!$lumenti_en_categoria && $lumenti_activo !== '') : ?>
        <input type="hidden" name="categoria" value="<?= esc_attr($lumenti_activo) ?>">
    <?php endif; ?>
    <label class="lm-field lm-blog__search"><span class="lm-visually-hidden"><?= esc_html__('Buscar artículos', 'lumenti') ?></span><span class="lm-field__control"><svg class="lm-field__icon lm-field__icon--start" aria-hidden="true" width="18" height="18" viewBox="0 0 256 256" fill="currentColor"><path d="M229.66,218.34l-50.07-50.06a88.11,88.11,0,1,0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.32ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z"/></svg><input class="lm-field__input lm-field__input--search" type="search" name="q" value="<?= esc_attr($lumenti_q) ?>" placeholder="<?= esc_attr($lumenti_placeholder) ?>" autocomplete="off"></span></label>
</form>
