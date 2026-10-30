<?php
defined('ABSPATH') || exit;

/*
 * Blog → filtros (specs/blog.md). Grupo ACF: Blog → blog_filtros.
 * Form GET (no es wp-form): pills de categoría (?categoria=<slug>) y buscador (?q=). Sin JS se envía y recarga;
 * con JS (src/js/modules/blog-filter.js) filtra en el navegador: pills [data-lm-blog-cat], buscador [data-lm-blog-search].
 * Las pills se escriben aquí (mismo marcado que el componente filtros, tipo pills) porque el JS necesita
 * data-lm-blog-cat en cada botón y el componente no recibe atributos por opción.
 */

$lumenti_filtros = [
    'etiqueta' => 'Filtrar por tema',
    'buscador' => 'Buscar artículos…',
    'buscador_label' => 'Buscar artículos',
    'todos' => 'Todos',
    // Términos de `category` (valor = slug).
    'categorias' => [
        'salud-mental' => 'Salud mental',
        'neurodivergencias' => 'Neurodivergencias',
        'tratamientos-y-evaluaciones' => 'Tratamientos y evaluaciones',
        'bienestar-relaciones-y-trabajo' => 'Bienestar, relaciones y trabajo',
    ],
];

// phpcs:disable WordPress.Security.NonceVerification.Recommended -- filtros GET públicos.
$lumenti_activo = isset($_GET['categoria']) && is_string($_GET['categoria']) ? sanitize_title(wp_unslash($_GET['categoria'])) : '';
$lumenti_q = isset($_GET['q']) && is_string($_GET['q']) ? sanitize_text_field(wp_unslash($_GET['q'])) : '';
// phpcs:enable
if (is_category()) {
    $lumenti_term = get_queried_object();
    $lumenti_activo = $lumenti_term instanceof WP_Term ? $lumenti_term->slug : $lumenti_activo;
}

$lumenti_opciones = ['' => $lumenti_filtros['todos']] + $lumenti_filtros['categorias'];
?>
<form class="lm-blog__toolbar" method="get" action="<?= esc_url(home_url('/blog/')) ?>" role="search" data-query="filtros">
    <div class="lm-blog__filters">
        <p class="lm-blog__filters-label" id="lm-blog-cats"><?= esc_html($lumenti_filtros['etiqueta']) ?></p>
        <div class="lm-pills" role="group" aria-labelledby="lm-blog-cats" data-lm-filter="categoria">
            <?php foreach ($lumenti_opciones as $lumenti_valor => $lumenti_texto) : $lumenti_valor = (string) $lumenti_valor; ?>
                <button class="lm-pills__btn" type="submit" name="categoria" value="<?= esc_attr($lumenti_valor) ?>" aria-pressed="<?= $lumenti_valor === $lumenti_activo ? 'true' : 'false' ?>" data-lm-blog-cat="<?= esc_attr($lumenti_valor) ?>"><?= esc_html($lumenti_texto) ?></button>
            <?php endforeach; ?>
        </div>
    </div>
    <label class="lm-field lm-blog__search"><span class="lm-visually-hidden"><?= esc_html($lumenti_filtros['buscador_label']) ?></span><span class="lm-field__control"><svg class="lm-field__icon lm-field__icon--start" aria-hidden="true" width="18" height="18" viewBox="0 0 256 256" fill="currentColor"><path d="M229.66,218.34l-50.07-50.06a88.11,88.11,0,1,0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.32ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z"/></svg><input class="lm-field__input lm-field__input--search" type="search" name="q" value="<?= esc_attr($lumenti_q) ?>" placeholder="<?= esc_attr($lumenti_filtros['buscador']) ?>" autocomplete="off" data-lm-blog-search></span></label>
</form>
