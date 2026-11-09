<?php
defined('ABSPATH') || exit;

/*
 * Psiquiatría · cta (specs/psiquiatria.md → cta). Grupo ACF: psiquiatria_cta.
 * Componente cta (el video, la insignia y la capa son del componente): botón de WhatsApp (central de citas)
 * con el mensaje del campo.
 */

$lumenti_cta = get_field('psiquiatria_cta') ?: [];
$lumenti_boton_texto = (string) ($lumenti_cta['boton_texto'] ?? '');

get_template_part('template-parts/components/cta', null, [
    'titulo' => (string) ($lumenti_cta['titulo'] ?? ''),
    'texto' => (string) ($lumenti_cta['texto'] ?? ''),
    'boton' => $lumenti_boton_texto !== '' ? [
        'texto' => $lumenti_boton_texto,
        'whatsapp' => 'citas',
        'mensaje' => (string) ($lumenti_cta['mensaje_whatsapp'] ?? ''),
    ] : [],
]);
