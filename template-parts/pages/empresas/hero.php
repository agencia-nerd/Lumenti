<?php
defined('ABSPATH') || exit;

/*
 * Empresas → hero (specs/empresas.md). Grupo ACF: Empresas → empresas_hero.
 * Componente page-hero (service). Las acciones son fijas: llevan a anclas de la misma página
 * y el JS (empresas.js, data-lm-goto) hace el scroll compensado.
 */

$lumenti_hero = [
    'titulo' => '*SALUD MENTAL*
PARA ORGANIZACIONES.',
    'nota' => 'Soluciones adaptadas a la realidad y los objetivos de cada organización.',
    'etiqueta' => 'EMPRESAS',
    'bajada' => 'Ayudamos a las organizaciones a promover el bienestar, prevenir riesgos y responder de manera responsable ante los desafíos de salud mental de sus equipos, mediante talleres, programas y atención especializada.',
];

get_template_part('template-parts/components/page-hero', null, $lumenti_hero + [
    'variante' => 'service',
    'breadcrumb' => [['texto' => __('Empresas', 'lumenti')]],
    'acciones' => [
        [
            'tipo' => 'boton',
            'texto' => __('Solicitar propuesta', 'lumenti'),
            'url' => '#propuesta',
            'tamano' => 'md',
            'icono' => 'flecha',
            'atributos' => ['data-lm-goto' => 'formulario'],
        ],
        [
            'tipo' => 'enlace',
            'texto' => __('Ver soluciones', 'lumenti'),
            'url' => '#soluciones',
            'icono' => 'abajo',
            'atributos' => ['data-lm-goto' => 'soluciones'],
        ],
    ],
]);
?>
