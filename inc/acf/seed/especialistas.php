<?php
defined('ABSPATH') || exit;

/*
 * Contenido inicial de Especialistas (specs/especialistas.md), página de opciones "Archivo de especialista":
 * el texto que salió de template-parts/pages/especialistas/encabezado.php y vacio.php, y el banner de los perfiles
 * (template-parts/pages/especialista/actualizacion.php).
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
            'mensaje' => 'Hola, necesito ayuda para elegir un especialista.',
        ],
        'especialistas_actualizacion' => [
            'titulo' => 'FORMACIÓN EN CONSTANTE ACTUALIZACIÓN',
            'texto'  => 'Los especialistas actualizan su formación de forma continua. Esta sección resume los hitos más relevantes.',
            'imagen' => ['_file' => 'assets/img/esp/formacion-banner.webp', 'alt' => ''],
        ],
    ],
];
