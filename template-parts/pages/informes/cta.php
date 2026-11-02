<?php
defined('ABSPATH') || exit;

/*
 * Informes y certificados · cta (specs/informes-y-certificados.md → cta). Grupo ACF: informes_y_certificados_cta.
 * Componente cta (el video, la insignia y la capa son del componente): botón de WhatsApp (número de paciente)
 * con el mensaje del campo.
 */

$lumenti_cta = get_field('informes_y_certificados_cta') ?: [];
$lumenti_boton_texto = (string) ($lumenti_cta['boton_texto'] ?? '');

get_template_part('template-parts/components/cta', null, [
    'titulo' => (string) ($lumenti_cta['titulo'] ?? ''),
    'texto' => (string) ($lumenti_cta['texto'] ?? ''),
    'boton' => $lumenti_boton_texto !== '' ? [
        'texto' => $lumenti_boton_texto,
        'whatsapp' => 'paciente',
        'mensaje' => (string) ($lumenti_cta['mensaje_whatsapp'] ?? ''),
    ] : [],
]);
