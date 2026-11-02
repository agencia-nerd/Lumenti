<?php
defined('ABSPATH') || exit;

/*
 * Especialistas · filtros (specs/especialistas.md → filtros). Sin grupo ACF: textos de la interfaz fijos.
 * wp-query: <form method="get" data-query="filtros"> con las opciones de lumenti_query_filters() (términos de
 * tipo_especialista, poblacion, que_trata e idioma, en el orden en que se crearon). Al cambiar un control,
 * src/js/modules/query.js recarga las zonas sin recargar la página; sin JS, "Aplicar" envía el form.
 * Zonas: filtros, activos (chips que quitan un filtro y "Limpiar filtros") y total.
 * El buscador ?q= busca por nombre o por condición con sinónimos (inc/especialistas.php).
 */

$lumenti_filtros = lumenti_query_filters('especialista');
if (!$lumenti_filtros) {
    return;
}

// Opciones de un filtro de taxonomía para el componente filtros: [valor, texto], con la opción vacía primero.
$lumenti_opciones = static function (string $clave, string $taxonomy, string $todos) use ($lumenti_filtros): array {
    $out = [['valor' => '', 'texto' => $todos]];
    foreach (lumenti_especialistas_opciones($lumenti_filtros[$clave] ?? null, $taxonomy) as $lumenti_o) {
        $out[] = ['valor' => (string) $lumenti_o['valor'], 'texto' => (string) $lumenti_o['etiqueta']];
    }
    return $out;
};
$lumenti_activo = static fn(string $clave): string => (string) (((array) ($lumenti_filtros[$clave]['valor'] ?? []))[0] ?? '');

$lumenti_q = (string) ($lumenti_filtros['q']['valor'] ?? '');
$lumenti_chips = lumenti_query_active();
$lumenti_total = (int) lumenti_query_total()['numero'];
?>
<section class="lm-specialists__filters" aria-label="<?= esc_attr__('Filtros', 'lumenti') ?>">
    <form method="get" action="<?= esc_url(lumenti_query_reset_url()) ?>" data-query="filtros">
        <?php get_template_part('template-parts/components/filtros', null, [
            'nombre' => 'tipo',
            'tipo' => 'segmentado',
            'opciones' => $lumenti_opciones('tipo', 'tipo_especialista', __('Todos', 'lumenti')),
            'activo' => $lumenti_activo('tipo'),
            'etiqueta' => __('Tipo de especialista', 'lumenti'),
        ]); ?>
        <div class="lm-specialists__fields">
            <label class="lm-field lm-specialists__search"><span class="lm-field__label"><?= esc_html__('Buscar', 'lumenti') ?></span><span class="lm-field__control"><svg class="lm-field__icon lm-field__icon--start" aria-hidden="true" width="18" height="18" viewBox="0 0 256 256" fill="currentColor"><path d="M229.66,218.34l-50.07-50.06a88.11,88.11,0,1,0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.32ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z"/></svg><input class="lm-field__input lm-field__input--search" type="search" name="q" value="<?= esc_attr($lumenti_q) ?>" placeholder="<?= esc_attr__('Buscar por nombre o condición…', 'lumenti') ?>" autocomplete="off" data-lm-filter="q"></span></label>
            <?php
            get_template_part('template-parts/components/filtros', null, [
                'nombre' => 'edad',
                'tipo' => 'select',
                'opciones' => $lumenti_opciones('edad', 'poblacion', __('Todas las edades', 'lumenti')),
                'activo' => $lumenti_activo('edad'),
                'etiqueta' => __('Población', 'lumenti'),
            ]);
            get_template_part('template-parts/components/filtros', null, [
                'nombre' => 'atiende',
                'tipo' => 'select',
                'opciones' => $lumenti_opciones('atiende', 'que_trata', __('Todas las áreas', 'lumenti')),
                'activo' => $lumenti_activo('atiende'),
                'etiqueta' => __('Qué atiende', 'lumenti'),
            ]);
            get_template_part('template-parts/components/filtros', null, [
                'nombre' => 'idiomas',
                'tipo' => 'select',
                'opciones' => $lumenti_opciones('idiomas', 'idioma', __('Cualquier idioma', 'lumenti')),
                'activo' => $lumenti_activo('idiomas'),
                'etiqueta' => __('Idioma', 'lumenti'),
            ]);
            ?>
        </div>
        <noscript><button class="lm-btn lm-btn--primary lm-btn--md" type="submit"><?= esc_html__('Aplicar', 'lumenti') ?></button></noscript>
    </form>
    <div class="lm-specialists__status">
        <div data-query="activos">
            <?php if ($lumenti_chips) : ?>
                <div class="lm-specialists__active">
                    <span class="lm-specialists__active-label"><?= esc_html__('Filtros activos:', 'lumenti') ?></span>
                    <span class="lm-specialists__active-list">
                        <?php foreach ($lumenti_chips as $lumenti_chip) : ?>
                            <a class="lm-filter-chip" href="<?= esc_url($lumenti_chip['url']) ?>" aria-label="<?= esc_attr(sprintf(__('Quitar filtro %s', 'lumenti'), $lumenti_chip['etiqueta'])) ?>"><span><?= esc_html($lumenti_chip['etiqueta']) ?></span><svg aria-hidden="true" width="14" height="14" viewBox="0 0 256 256" fill="currentColor"><path d="M205.66,194.34a8,8,0,0,1-11.32,11.32L128,139.31,61.66,205.66a8,8,0,0,1-11.32-11.32L116.69,128,50.34,61.66A8,8,0,0,1,61.66,50.34L128,116.69l66.34-66.35a8,8,0,0,1,11.32,11.32L139.31,128Z"/></svg></a>
                        <?php endforeach; ?>
                    </span>
                    <a class="lm-link-button" href="<?= esc_url(lumenti_query_reset_url()) ?>"><?= esc_html__('Limpiar filtros', 'lumenti') ?></a>
                </div>
            <?php endif; ?>
        </div>
        <p class="lm-specialists__count" aria-live="polite" data-query="total"><?= esc_html(sprintf(_n('%d especialista', '%d especialistas', $lumenti_total, 'lumenti'), $lumenti_total)) ?></p>
    </div>
</section>
