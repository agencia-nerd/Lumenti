<?php
defined('ABSPATH') || exit;

/*
 * Empresas → hero (specs/empresas.md). Grupo ACF: Empresas → empresas_hero.
 * Componente page-hero (service). Las acciones son fijas: llevan a anclas de la misma página
 * y el JS (empresas.js, data-lm-goto) hace el scroll compensado.
 */

$lumenti_hero = get_field('empresas_hero') ?: [];

// titulo es un textarea: page-hero arma una línea del h1 por renglón (Enter) y pinta en verde lo que va entre *asteriscos*.
// La etiqueta y los textos de las acciones son fijos (no son campos).
get_template_part('template-parts/components/page-hero', null, [
    'titulo' => (string) ($lumenti_hero['titulo'] ?? ''),
    'nota' => (string) ($lumenti_hero['nota'] ?? ''),
    'etiqueta' => __('EMPRESAS', 'lumenti'),
    'bajada' => (string) ($lumenti_hero['bajada'] ?? ''),
    'variante' => 'service',
    'breadcrumb' => [['texto' => get_the_title()]],
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
