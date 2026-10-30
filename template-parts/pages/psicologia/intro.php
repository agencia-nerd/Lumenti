<?php
defined('ABSPATH') || exit;

/*
 * Psicología · intro (specs/psicologia.md → intro). Grupo ACF: psicologia_intro.
 * Prepara los datos y llama al componente intro-split (título con *marcador* vía lumenti_highlight).
 */

$lumenti_intro = [
    'titulo' => '¿QUÉ ES LA *PSICOLOGÍA* Y CUÁNDO BUSCARLA?',
    'id' => 'lm-que-es',
    'texto' => 'La psicología ayuda a comprender cómo pensamos, sentimos, nos relacionamos y actuamos ante las distintas experiencias de la vida. A través de la psicoterapia y la evaluación psicológica, permite identificar dificultades, desarrollar recursos y promover cambios que favorezcan el bienestar.',
    'texto_destacado' => 'Puedes consultar cuando una situación afecta tu vida cotidiana, tus emociones o tus relaciones, pero también cuando deseas conocerte mejor, afrontar una etapa de cambio o fortalecer herramientas personales. No necesitas tener un diagnóstico para pedir apoyo.',
    'imagenes' => [
        ['ruta' => 'assets/img/psico-hombre.webp', 'ancho' => 641, 'alto' => 832, 'alt' => 'Hombre de perfil con luz cálida filtrada sobre el rostro'],
        ['ruta' => 'assets/img/psico-escalera.webp', 'ancho' => 578, 'alto' => 754, 'alt' => 'Silueta de una cabeza con una persona subiendo una escalera en su interior'],
    ],
];

get_template_part('template-parts/components/intro-split', null, $lumenti_intro);
