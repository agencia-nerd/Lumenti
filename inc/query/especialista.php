<?php
defined('ABSPATH') || exit;

/*
 * Listado "especialistas" (contenido especialista). Lo genera wp-query (generate.mjs) desde
 * specs/especialistas.md, su spec de detalle y _shared.md: no se edita a mano. Cambia el spec y vuelve a generar.
 */
return [
    'contenido' => 'especialista',
    'listado' => 'especialistas',
    'post_type' => 'especialista',
    'taxonomias' => [
        'tipo_especialista',
        'poblacion',
        'que_trata',
        'idioma',
        'modalidad',
    ],
    'por_pagina' => 20,
    'paginacion' => 'cargar_mas',
    'al_filtrar' => 'auto',
    'movil' => 'igual',
    'relacionadas' => 'tipo_especialista',
    'filtros' => [
        'tipo' => [
            'tipo' => 'taxonomia',
            'vista' => 'segmentado (radios: Todos, Médicos psiquiatras, Psicólogos)',
            'fuente' => 'tipo_especialista',
            'etiqueta' => '',
            'varios' => 'no',
            'conteo' => 'ninguno',
        ],
        'edad' => [
            'tipo' => 'taxonomia',
            'vista' => 'select',
            'fuente' => 'poblacion',
            'etiqueta' => '',
            'varios' => 'no',
            'conteo' => 'ninguno',
        ],
        'atiende' => [
            'tipo' => 'taxonomia',
            'vista' => 'select',
            'fuente' => 'que_trata',
            'etiqueta' => '',
            'varios' => 'no',
            'conteo' => 'ninguno',
        ],
        'idiomas' => [
            'tipo' => 'taxonomia',
            'vista' => 'select',
            'fuente' => 'idioma',
            'etiqueta' => '',
            'varios' => 'no',
            'conteo' => 'ninguno',
        ],
        'q' => [
            'tipo' => 'busqueda',
            'vista' => 'campo',
            'etiqueta' => '',
        ],
    ],
];
