<?php
defined('ABSPATH') || exit;

/*
 * Preguntas frecuentes · cta (specs/faq.md → cta, grupo ACF faq_cta). Solo pasa sus $args a
 * template-parts/components/cta.php. Datos fijos del diseño hasta el paso ACF (video: el del componente).
 */

$lumenti_cta = [
    'titulo' => '¿TIENES MÁS PREGUNTAS? ESCRÍBENOS.',
    'texto' => 'Escríbenos por WhatsApp y te orientamos en el momento.',
    'boton_texto' => 'Escríbenos por WhatsApp',
    'boton_mensaje' => 'Hola, tengo una consulta sobre la atención en Lumenti.',
];

get_template_part('template-parts/components/cta', null, [
    'titulo' => $lumenti_cta['titulo'],
    'texto' => $lumenti_cta['texto'],
    'boton' => [
        'texto' => $lumenti_cta['boton_texto'],
        'whatsapp' => 'paciente',
        'mensaje' => $lumenti_cta['boton_mensaje'],
    ],
    'id' => 'lm-cta-faq',
]);
