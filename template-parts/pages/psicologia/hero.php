<?php
defined('ABSPATH') || exit;

/*
 * Psicología · hero (specs/psicologia.md → hero). Grupo ACF: psicologia_hero.
 * Componente page-hero (variante service). titulo es un textarea: una línea del h1 por renglón (Enter); sin
 * *asteriscos*, la primera línea va en verde. Breadcrumb: "Servicios" (fijo, sin enlace) y el título de la página.
 */

$lumenti_hero = get_field('psicologia_hero') ?: [];

get_template_part('template-parts/components/page-hero', null, [
    'titulo' => (string) ($lumenti_hero['titulo'] ?? ''),
    'nota' => (string) ($lumenti_hero['nota'] ?? ''),
    'etiqueta' => (string) ($lumenti_hero['etiqueta'] ?? ''),
    'bajada' => (string) ($lumenti_hero['bajada'] ?? ''),
    'variante' => 'service',
    'breadcrumb' => [
        ['texto' => __('Servicios', 'lumenti')],
        ['texto' => get_the_title()],
    ],
]);
