<?php
defined('ABSPATH') || exit;

/*
 * Informes y certificados · hero (specs/informes-y-certificados.md → hero). Grupo ACF: informes_y_certificados_hero.
 * Componente page-hero (variante service). titulo es un textarea: una línea del h1 por renglón (Enter); la línea
 * entre *asteriscos* va en verde. Breadcrumb: "Servicios" (fijo, sin enlace) y el título de la página.
 */

$lumenti_hero = get_field('informes_y_certificados_hero') ?: [];

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
