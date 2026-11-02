<?php
defined('ABSPATH') || exit;

/*
 * Preguntas frecuentes · hero (specs/preguntas-frecuentes.md → hero). Grupo ACF: preguntas_frecuentes_hero.
 * Componente page-hero (variante service). titulo es un textarea: una línea del h1 por renglón (Enter); la línea
 * entre *asteriscos* va en verde. Breadcrumb: Inicio › título de la página.
 */

$lumenti_hero = get_field('preguntas_frecuentes_hero') ?: [];

get_template_part('template-parts/components/page-hero', null, [
    'titulo' => (string) ($lumenti_hero['titulo'] ?? ''),
    'nota' => (string) ($lumenti_hero['nota'] ?? ''),
    'etiqueta' => (string) ($lumenti_hero['etiqueta'] ?? ''),
    'bajada' => (string) ($lumenti_hero['bajada'] ?? ''),
    'breadcrumb' => [['texto' => get_the_title()]],
    'variante' => 'service',
]);
