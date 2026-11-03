<?php
defined('ABSPATH') || exit;

/*
 * Listado "blog" (contenido post). Lo genera wp-query (generate.mjs) desde
 * specs/blog.md, su spec de detalle y _shared.md: no se edita a mano. Cambia el spec y vuelve a generar.
 */
return [
    'contenido' => 'post',
    'listado' => 'blog',
    'post_type' => 'post',
    'taxonomias' => [
        'category',
        'post_tag',
    ],
    'por_pagina' => 6,
    'paginacion' => 'numeros',
    'al_filtrar' => 'auto',
    'movil' => 'igual',
    'relacionadas' => 'category',
    'filtros' => [
        'categoria' => [
            'tipo' => 'taxonomia',
            'vista' => 'pills',
            'fuente' => 'category',
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
