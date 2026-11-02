<?php
defined('ABSPATH') || exit;

/*
 * Psiquiatría · especialistas (specs/psiquiatria.md → especialistas). Grupo ACF: psiquiatria_especialistas.
 * Prepara los datos y llama al componente specialists-carousel sin pills (filtro false).
 * Cards: los especialistas de tipo psiquiatras, en orden (lumenti_especialistas_cards, inc/especialistas.php).
 */

$lumenti_especialistas = [
    'titulo' => 'CONOCE A LOS *ESPECIALISTAS*',
    'texto' => 'Médicos psiquiatras con enfoque humano y basado en evidencia.',
    'enlace' => [
        'url' => add_query_arg('tipo', 'psiquiatras', home_url('/especialistas/')),
        'title' => 'Ver todos',
        'target' => '',
    ],
    'filtro' => false,
    'variante' => 'servicio',
    'id' => 'lm-esp',
    'items' => lumenti_especialistas_cards('psiquiatras'),
];

get_template_part('template-parts/components/specialists-carousel', null, $lumenti_especialistas);
