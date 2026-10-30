<?php
defined('ABSPATH') || exit;

/*
 * Psicología · cta (specs/psicologia.md → cta). Grupo ACF: psicologia_cta.
 * Prepara los datos y llama al componente cta: botón de WhatsApp (número de paciente) con el mensaje de la página.
 */

$lumenti_cta = [
    'titulo' => 'DAR EL PRIMER PASO TAMBIÉN ES UNA FORMA DE CUIDARTE',
    'texto' => 'Encuentra en Lumenti una atención profesional, cercana y pensada para ti.',
    'boton' => [
        'texto' => 'Agendar una cita',
        'whatsapp' => 'paciente',
        'mensaje' => 'Hola, quisiera agendar una consulta de psicología.',
    ],
];

get_template_part('template-parts/components/cta', null, $lumenti_cta);
