<?php
defined('ABSPATH') || exit;

/*
 * Psiquiatría · intro (specs/psiquiatria.md → intro). Grupo ACF: psiquiatria_intro.
 * Prepara los datos y llama al componente intro-split (título con *marcador* vía lumenti_highlight).
 */

$lumenti_intro = [
    'titulo' => '¿QUÉ ES LA *PSIQUIATRÍA* Y CUÁNDO CONSULTAR?',
    'id' => 'lm-que-es',
    'texto' => 'La psiquiatría es la especialidad médica dedicada a evaluar y abordar la salud mental desde una mirada integral. Considera factores emocionales, biológicos, conductuales y del entorno, además de posibles causas médicas que puedan estar influyendo.',
    'texto_destacado' => 'Es recomendable consultar cuando lo que sientes comienza a afectar tu bienestar, tus relaciones, tus estudios, tu trabajo o tu funcionamiento cotidiano. Acudir a un psiquiatra no significa necesariamente iniciar medicación: el tratamiento se define de manera individual después de una evaluación clínica.',
    'imagenes' => [
        ['ruta' => 'assets/img/psiq-sombrero.webp', 'ancho' => 503, 'alto' => 832, 'alt' => 'Mujer con sombrero sentada frente al mar al atardecer'],
        ['ruta' => 'assets/img/psiq-silueta.webp', 'ancho' => 578, 'alto' => 757, 'alt' => 'Silueta de una persona de perfil frente al cielo'],
    ],
];

get_template_part('template-parts/components/intro-split', null, $lumenti_intro);
