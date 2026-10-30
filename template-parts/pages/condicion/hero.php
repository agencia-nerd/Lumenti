<?php
defined('ABSPATH') || exit;

/*
 * Condición · hero (specs/condicion.md → hero). Grupo ACF: condicion_hero.
 * Componente page-hero (sin variante) con breadcrumb Inicio › Qué tratamos › título de la condición
 * (título de WordPress; si no hay, el del ejemplo). Una línea del h1 por renglón, la primera en verde;
 * ajustar => data-lm-fit-title (src/js/modules/condition-filter.js → fitTitle).
 */

$lumenti_hero = [
    'etiqueta' => 'DEPRESIÓN',
    'titulo' => 'LA DEPRESIÓN
TIENE TRATAMIENTO',
    'nota' => 'Atención presencial y virtual para cada etapa de la vida.',
    'bajada' => 'La depresión puede afectar el ánimo, la energía, el sueño, la concentración y la capacidad de disfrutar las actividades cotidianas. No es falta de voluntad ni una tristeza pasajera: con una evaluación adecuada y un tratamiento personalizado, es posible reducir los síntomas y recuperar el bienestar.',
];

$lumenti_condicion = get_the_title();
if ($lumenti_condicion === '') {
    $lumenti_condicion = 'Depresión';
}

get_template_part('template-parts/components/page-hero', null, $lumenti_hero + [
    'id' => 'lm-cond-title',
    'ajustar' => true,
    'breadcrumb' => [
        ['texto' => 'Qué tratamos', 'url' => home_url('/#que-tratamos')],
        ['texto' => $lumenti_condicion],
    ],
]);
