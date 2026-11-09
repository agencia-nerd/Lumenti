<?php
defined('ABSPATH') || exit;

/*
 * Preguntas frecuentes · cta (specs/preguntas-frecuentes.md → cta). Grupo ACF: preguntas_frecuentes_cta.
 * Componente cta: botón de WhatsApp (central de citas) con el mensaje del campo. El fondo es un campo file
 * (video o imagen); vacío, el video del componente.
 */

$lumenti_cta = get_field('preguntas_frecuentes_cta') ?: [];
$lumenti_boton_texto = (string) ($lumenti_cta['boton_texto'] ?? '');

get_template_part('template-parts/components/cta', null, [
    'titulo' => (string) ($lumenti_cta['titulo'] ?? ''),
    'texto' => (string) ($lumenti_cta['texto'] ?? ''),
    'boton' => $lumenti_boton_texto !== '' ? [
        'texto' => $lumenti_boton_texto,
        'whatsapp' => 'citas',
        'mensaje' => (string) ($lumenti_cta['boton_mensaje'] ?? ''),
    ] : [],
    'video' => ($lumenti_cta['video_o_imagen'] ?? null) ?: null,
    'id' => 'lm-cta-faq',
]);
