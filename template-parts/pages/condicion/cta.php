<?php
defined('ABSPATH') || exit;

/*
 * Condición · cta (specs/condicion.md → cta). Grupo ACF: condicion_cta.
 * Componente cta con la variante condicion (fondo partido arena/verde). Botón de WhatsApp de la central de citas con
 * el mensaje del campo; si está vacío, la Acción de _shared.md: "Hola, quisiera orientación sobre {condición}.".
 */

$lumenti_cta = get_field('condicion_cta') ?: [];

$lumenti_mensaje = trim((string) ($lumenti_cta['mensaje'] ?? ''));
if ($lumenti_mensaje === '') {
    $lumenti_mensaje = sprintf(__('Hola, quisiera orientación sobre %s.', 'lumenti'), get_the_title());
}

get_template_part('template-parts/components/cta', null, [
    'titulo' => (string) ($lumenti_cta['titulo'] ?? ''),
    'texto' => (string) ($lumenti_cta['texto'] ?? ''),
    'boton' => [
        'texto' => (string) ($lumenti_cta['boton'] ?? ''),
        'whatsapp' => 'citas',
        'mensaje' => $lumenti_mensaje,
    ],
    'variante' => 'condicion',
]);
