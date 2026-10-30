<?php
defined('ABSPATH') || exit;

/*
 * Especialistas · filtros (specs/especialistas.md → filtros). Sin grupo ACF: textos de la interfaz fijos.
 * <form method="get" data-query="filtros"> con los name de la tabla "Filtros" (tipo, edad, atiende, idiomas, q).
 * Con JS filtra en el navegador (src/js/modules/specialists-filter.js); sin JS, "Aplicar" envía el form.
 * Opciones fijas del diseño hasta wp-query (términos de poblacion, que_trata e idioma):
 *   - edad e idiomas: el valor es el texto, igual que data-poblacion / data-idiomas de las cards.
 *   - atiende: el valor es el código de assets/data/sinonimos.json (dep, ans…), igual que data-atiende;
 *     data-slug es el slug de la condición para los enlaces ?atiende=<slug> de otras páginas.
 * Sinónimos del buscador: assets/data/sinonimos.json en data-lm-sinonimos (sin <script> inline).
 */

$lumenti_tipos = [
    ['valor' => '', 'texto' => 'Todos'],
    ['valor' => 'psiquiatras', 'texto' => 'Médicos psiquiatras'],
    ['valor' => 'psicologos', 'texto' => 'Psicólogos'],
];

$lumenti_edades = [
    ['valor' => '', 'texto' => 'Todas las edades'],
    ['valor' => 'Niños', 'texto' => 'Niños'],
    ['valor' => 'Pre adolescentes', 'texto' => 'Pre adolescentes'],
    ['valor' => 'Adolescentes', 'texto' => 'Adolescentes'],
    ['valor' => 'Adultos', 'texto' => 'Adultos'],
    ['valor' => 'Adulto mayor', 'texto' => 'Adulto mayor'],
];

$lumenti_atiende = [
    ['valor' => '', 'texto' => 'Todas las áreas'],
    ['valor' => 'dep', 'slug' => 'depresion', 'texto' => 'Depresión'],
    ['valor' => 'ans', 'slug' => 'ansiedad', 'texto' => 'Trastornos de ansiedad'],
    ['valor' => 'tept', 'slug' => 'trauma', 'texto' => 'Trauma y estrés postraumático (TEPT)'],
    ['valor' => 'tdah', 'texto' => 'TDAH'],
    ['valor' => 'autismo', 'texto' => 'Autismo (TEA)'],
    ['valor' => 'toc', 'texto' => 'Trastorno obsesivo compulsivo (TOC)'],
    ['valor' => 'tdc', 'texto' => 'Trastorno dismórfico corporal'],
    ['valor' => 'tca', 'texto' => 'Trastornos de la conducta alimentaria (TCA)'],
    ['valor' => 'tlp', 'texto' => 'Trastorno límite de la personalidad'],
    ['valor' => 'otp', 'slug' => 'personalidad', 'texto' => 'Otros trastornos de la personalidad'],
    ['valor' => 'psi', 'slug' => 'psicosis', 'texto' => 'Psicosis y esquizofrenia'],
    ['valor' => 'sue', 'slug' => 'sueno', 'texto' => 'Alteraciones del sueño'],
    ['valor' => 'peri', 'slug' => 'perinatal', 'texto' => 'Salud mental perinatal'],
    ['valor' => 'tdpm', 'texto' => 'Trastorno disfórico premenstrual'],
    ['valor' => 'bip', 'slug' => 'bipolar', 'texto' => 'Trastorno bipolar'],
    ['valor' => 'diso', 'texto' => 'Trastorno disociativo'],
    ['valor' => 'adic', 'slug' => 'adicciones', 'texto' => 'Adicciones'],
    ['valor' => 'det', 'texto' => 'Deterioro cognitivo mayor'],
    ['valor' => 'rel', 'texto' => 'Relaciones interpersonales'],
    ['valor' => 'auto', 'texto' => 'Procesos de autoconocimiento'],
    ['valor' => 'cri', 'texto' => 'Crisis vitales'],
    ['valor' => 'due', 'texto' => 'Duelo'],
    ['valor' => 'apr', 'texto' => 'Dificultades de aprendizaje'],
    ['valor' => 'voc', 'texto' => 'Orientación vocacional'],
];

$lumenti_idiomas = [
    ['valor' => '', 'texto' => 'Cualquier idioma'],
    ['valor' => 'Español', 'texto' => 'Español'],
    ['valor' => 'Inglés', 'texto' => 'Inglés'],
    ['valor' => 'Portugués', 'texto' => 'Portugués'],
];

$lumenti_total = (int) ($args['total'] ?? 13);

// Valores de la URL (filtro GET público, sin nonce).
// phpcs:disable WordPress.Security.NonceVerification.Recommended
$lumenti_q = isset($_GET['q']) && is_string($_GET['q']) ? sanitize_text_field(wp_unslash($_GET['q'])) : '';
$lumenti_atiende_get = isset($_GET['atiende']) && is_string($_GET['atiende']) ? sanitize_text_field(wp_unslash($_GET['atiende'])) : '';
// phpcs:enable

// ?atiende= acepta el código o el slug de la condición.
$lumenti_atiende_activo = '';
foreach ($lumenti_atiende as $lumenti_o) {
    if ($lumenti_atiende_get !== '' && ($lumenti_o['valor'] === $lumenti_atiende_get || ($lumenti_o['slug'] ?? '') === $lumenti_atiende_get)) {
        $lumenti_atiende_activo = $lumenti_o['valor'];
        break;
    }
}

$lumenti_sinonimos = wp_json_file_decode(get_theme_file_path('/assets/data/sinonimos.json'), ['associative' => true]);
$lumenti_sinonimos = ['grupos' => is_array($lumenti_sinonimos) ? (array) ($lumenti_sinonimos['grupos'] ?? []) : []];

$lumenti_chevron = '<svg class="lm-field__icon lm-field__icon--end" aria-hidden="true" width="18" height="18" viewBox="0 0 256 256" fill="currentColor"><path d="M213.66,101.66l-80,80a8,8,0,0,1-11.32,0l-80-80A8,8,0,0,1,53.66,90.34L128,164.69l74.34-74.35a8,8,0,0,1,11.32,11.32Z"/></svg>';
?>
<section class="lm-specialists__filters" aria-label="Filtros">
    <form method="get" action="<?= esc_url(home_url('/especialistas/')) ?>" data-query="filtros" data-lm-sinonimos="<?= esc_attr(wp_json_encode($lumenti_sinonimos)) ?>">
        <?php get_template_part('template-parts/components/filtros', null, [
            'nombre' => 'tipo',
            'tipo' => 'segmentado',
            'opciones' => $lumenti_tipos,
            'etiqueta' => 'Tipo de especialista',
        ]); ?>
        <div class="lm-specialists__fields">
            <label class="lm-field lm-specialists__search"><span class="lm-field__label">Buscar</span><span class="lm-field__control"><svg class="lm-field__icon lm-field__icon--start" aria-hidden="true" width="18" height="18" viewBox="0 0 256 256" fill="currentColor"><path d="M229.66,218.34l-50.07-50.06a88.11,88.11,0,1,0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.32ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z"/></svg><input class="lm-field__input lm-field__input--search" type="search" name="q" value="<?= esc_attr($lumenti_q) ?>" placeholder="Buscar por nombre o condición…" autocomplete="off" data-lm-filter="q"></span></label>
            <?php get_template_part('template-parts/components/filtros', null, [
                'nombre' => 'edad',
                'tipo' => 'select',
                'opciones' => $lumenti_edades,
                'etiqueta' => 'Población',
            ]); ?>
            <label class="lm-field"><span class="lm-field__label">Qué atiende</span><span class="lm-field__control"><select class="lm-field__select<?= $lumenti_atiende_activo !== '' ? ' is-filled' : '' ?>" name="atiende" data-lm-filter="atiende"><?php foreach ($lumenti_atiende as $lumenti_o) : ?><option value="<?= esc_attr($lumenti_o['valor']) ?>"<?php if (!empty($lumenti_o['slug'])) : ?> data-slug="<?= esc_attr($lumenti_o['slug']) ?>"<?php endif; ?><?php selected($lumenti_o['valor'], $lumenti_atiende_activo); ?>><?= esc_html($lumenti_o['texto']) ?></option><?php endforeach; ?></select><?= $lumenti_chevron ?></span></label>
            <?php get_template_part('template-parts/components/filtros', null, [
                'nombre' => 'idiomas',
                'tipo' => 'select',
                'opciones' => $lumenti_idiomas,
                'etiqueta' => 'Idioma',
            ]); ?>
        </div>
        <noscript><button class="lm-btn lm-btn--primary lm-btn--md" type="submit">Aplicar</button></noscript>
    </form>
    <div class="lm-specialists__status">
        <div class="lm-specialists__active" data-lm-active-wrap hidden>
            <span class="lm-specialists__active-label">Filtros activos:</span>
            <span class="lm-specialists__active-list" data-lm-active-filters></span>
            <button class="lm-link-button" type="button" data-lm-clear-filters>Limpiar filtros</button>
        </div>
        <p class="lm-specialists__count" aria-live="polite" data-query="total" data-lm-count-results><?= esc_html(sprintf(_n('%d especialista', '%d especialistas', $lumenti_total, 'lumenti'), $lumenti_total)) ?></p>
        <template data-lm-chip-template><button class="lm-filter-chip" type="button"><span data-lm-chip-label></span><svg aria-hidden="true" width="14" height="14" viewBox="0 0 256 256" fill="currentColor"><path d="M205.66,194.34a8,8,0,0,1-11.32,11.32L128,139.31,61.66,205.66a8,8,0,0,1-11.32-11.32L116.69,128,50.34,61.66A8,8,0,0,1,61.66,50.34L128,116.69l66.34-66.35a8,8,0,0,1,11.32,11.32L139.31,128Z"/></svg></button></template>
    </div>
</section>
