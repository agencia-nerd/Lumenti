<?php
defined('ABSPATH') || exit;

/*
 * Condición · cta (specs/condicion.md → cta). Grupo ACF: condicion_cta.
 * Componente cta con la variante condicion (fondo partido arena/verde). Botón de WhatsApp de paciente con
 * el mensaje del campo; si está vacío, "Hola, quisiera orientación sobre {condición}.".
 */

$lumenti_cta = [
    'titulo' => 'NO TIENES QUE ATRAVESAR LA DEPRESIÓN SIN APOYO.',
    'texto' => 'Escríbenos y te orientaremos para encontrar la atención más adecuada para ti.',
    'boton' => 'Solicitar orientación por WhatsApp',
    'mensaje' => 'Hola, quisiera información sobre el tratamiento de la depresión.',
];

$lumenti_mensaje = $lumenti_cta['mensaje'];
if ($lumenti_mensaje === '') {
    $lumenti_mensaje = sprintf('Hola, quisiera orientación sobre %s.', get_the_title());
}

get_template_part('template-parts/components/cta', null, [
    'titulo' => $lumenti_cta['titulo'],
    'texto' => $lumenti_cta['texto'],
    'boton' => [
        'texto' => $lumenti_cta['boton'],
        'whatsapp' => 'paciente',
        'mensaje' => $lumenti_mensaje,
    ],
    'variante' => 'condicion',
]);
