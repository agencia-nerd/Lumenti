<?php
defined('ABSPATH') || exit;

/*
 * Cards de muestra hasta conectar Blog (specs/home.md → blog). $args de template-parts/components/blog-card.php.
 */

return [
    [
        'titulo' => '¿VOY A TOMAR EL ANTIDEPRESIVO PARA TODA LA VIDA?',
        'url' => home_url('/antidepresivo-para-toda-la-vida/'),
        'imagen' => 'assets/img/blog/antidepresivo-para-toda-la-vida.webp',
        'imagen_alt' => 'Médica revisando una tablet junto a su paciente',
        'categoria' => 'TRATAMIENTOS Y EVALUACIONES',
    ],
    [
        'titulo' => '¿CÓMO SE DIAGNOSTICA EL TDAH?',
        'url' => home_url('/como-se-diagnostica-el-tdah/'),
        'imagen' => 'assets/img/blog/como-se-diagnostica-el-tdah.webp',
        'imagen_alt' => 'Médico conversando con un adolescente en consulta',
        'categoria' => 'NEURODIVERGENCIAS',
    ],
    [
        'titulo' => '¿EXISTE UN TRATAMIENTO EFECTIVO PARA EL TRASTORNO LÍMITE DE LA PERSONALIDAD?',
        'url' => home_url('/tratamiento-trastorno-limite-de-la-personalidad/'),
        'imagen' => 'assets/img/blog/tratamiento-trastorno-limite-de-la-personalidad.webp',
        'imagen_alt' => 'Mujer sonriendo con una taza junto a la ventana',
        'categoria' => 'TRATAMIENTOS Y EVALUACIONES',
    ],
    [
        'titulo' => 'LA ANSIEDAD EN NIÑOS NO SIEMPRE SE VE COMO ANSIEDAD',
        'url' => home_url('/ansiedad-en-ninos/'),
        'imagen' => 'assets/img/blog/ansiedad-en-ninos.webp',
        'imagen_alt' => 'Niño con su madre conversando junto a la ventana',
        'categoria' => 'SALUD MENTAL',
    ],
];
