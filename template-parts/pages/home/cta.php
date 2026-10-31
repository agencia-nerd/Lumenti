<?php
defined('ABSPATH') || exit;

/*
 * Inicio · cta (specs/home.md → cta, grupo ACF home_cta). Solo pasa sus $args a template-parts/components/cta.php.
 * Contenido: get_field('home_cta'); el fondo es un campo file que acepta video o imagen (vacío: sin fondo).
 */

$lumenti_cta = get_field('home_cta') ?: [];
$lumenti_boton_texto = (string) ($lumenti_cta['boton_texto'] ?? '');

get_template_part('template-parts/components/cta', null, [
    'titulo' => (string) ($lumenti_cta['titulo'] ?? ''),
    'texto' => (string) ($lumenti_cta['texto'] ?? ''),
    'boton' => $lumenti_boton_texto !== '' ? [
        'texto' => $lumenti_boton_texto,
        'whatsapp' => 'paciente',
        'mensaje' => (string) ($lumenti_cta['boton_mensaje'] ?? ''),
    ] : [],
    'video' => $lumenti_cta['video_o_imagen'] ?? '',
    'id' => 'lm-cta-title',
]);
