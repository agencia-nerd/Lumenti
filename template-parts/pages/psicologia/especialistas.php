<?php
defined('ABSPATH') || exit;

/*
 * Psicología · especialistas (specs/psicologia.md → especialistas). Grupo ACF: psicologia_especialistas.
 * Prepara los datos y llama al componente specialists-carousel sin pills (filtro false).
 * Cards: los especialistas de tipo psicologos, en orden (lumenti_especialistas_cards, inc/especialistas.php).
 */

$lumenti_especialistas = [
    'titulo' => 'CONOCE A LOS *ESPECIALISTAS*',
    'texto' => 'Psicólogos clínicos con enfoque humano y basado en evidencia.',
    'enlace' => [
        'url' => add_query_arg('tipo', 'psicologos', home_url('/especialistas/')),
        'title' => 'Ver todos',
        'target' => '',
    ],
    'filtro' => false,
    'variante' => 'servicio',
    'id' => 'lm-esp',
    'items' => lumenti_especialistas_cards('psicologos'),
];

get_template_part('template-parts/components/specialists-carousel', null, $lumenti_especialistas);
