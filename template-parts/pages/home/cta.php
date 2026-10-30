<?php
defined('ABSPATH') || exit;

/*
 * Inicio · cta (specs/home.md → cta, grupo ACF home_cta). Solo pasa sus $args a template-parts/components/cta.php.
 * Datos fijos del diseño hasta el paso ACF (video y póster: los del componente).
 */

$lumenti_cta = [
    'titulo' => 'DAR EL PRIMER PASO TAMBIÉN ES UNA FORMA DE CUIDARTE',
    'texto' => 'Encuentra en Lumenti una atención profesional, cercana y pensada para ti.',
    'boton_texto' => 'Escríbenos por WhatsApp',
    'boton_mensaje' => '',
];

get_template_part('template-parts/components/cta', null, [
    'titulo' => $lumenti_cta['titulo'],
    'texto' => $lumenti_cta['texto'],
    'boton' => [
        'texto' => $lumenti_cta['boton_texto'],
        'whatsapp' => 'paciente',
        'mensaje' => $lumenti_cta['boton_mensaje'],
    ],
    'id' => 'lm-cta-title',
]);
