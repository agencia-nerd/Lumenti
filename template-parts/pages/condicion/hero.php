<?php
defined('ABSPATH') || exit;

/*
 * Condición · hero (specs/condicion.md → hero). Grupo ACF: condicion_hero.
 * Componente page-hero (sin variante) con breadcrumb Inicio › Qué tratamos › título de la condición (de WordPress).
 * titulo es un textarea: una línea del h1 por renglón (Enter); la línea entre *asteriscos* va en verde.
 * ajustar => data-lm-fit-title (src/js/modules/condition-filter.js → fitTitle).
 */

$lumenti_hero = get_field('condicion_hero') ?: [];

get_template_part('template-parts/components/page-hero', null, [
    // La etiqueta con punto es el título de la condición en mayúsculas (no es campo).
    'etiqueta' => mb_strtoupper(get_the_title(), 'UTF-8'),
    'titulo' => (string) ($lumenti_hero['titulo'] ?? ''),
    'nota' => (string) ($lumenti_hero['nota'] ?? ''),
    'bajada' => (string) ($lumenti_hero['bajada'] ?? ''),
    'id' => 'lm-cond-title',
    'ajustar' => true,
    'breadcrumb' => [
        ['texto' => __('Qué tratamos', 'lumenti'), 'url' => home_url('/#que-tratamos')],
        ['texto' => get_the_title()],
    ],
]);
