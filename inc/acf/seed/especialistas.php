<?php
defined('ABSPATH') || exit;

/*
 * Contenido inicial de Especialistas (specs/especialistas.md), página de opciones "Archivo de especialista":
 * el texto que salió de template-parts/pages/especialistas/encabezado.php y vacio.php.
 */
return [
    'option' => true,
    'fields' => [
        'especialistas_encabezado' => [
            'etiqueta' => 'NUESTROS ESPECIALISTAS',
            'titulo'   => "UN GRAN EQUIPO HUMANO\nPARA *CUIDAR TU BIENESTAR*",
            'bajada'   => 'Conoce a los especialistas en Lumenti: médicos psiquiatras y psicólogos que trabajan de forma coordinada para acompañarte en cada etapa de la vida.',
        ],
        'especialistas_vacio' => [
            'mensaje' =>'Hola, necesito ayuda para elegir un especialista.',
        ],
    ],
];
