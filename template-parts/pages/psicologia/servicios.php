<?php
defined('ABSPATH') || exit;

/*
 * Psicología · servicios (specs/psicologia.md → servicios). Grupo ACF: psicologia_servicios.
 * Título centrado y tarjetas con botón de WhatsApp (central de citas). Prepara los datos; el marcado está en
 * servicios-tarjetas.php. La tarjeta de evaluaciones lleva el id fijo "evaluaciones" (lo enlazan el pie y el Home,
 * /psicologia/#evaluaciones).
 */

$lumenti_servicios = get_field('psicologia_servicios') ?: [];

get_template_part('template-parts/pages/psicologia/servicios-tarjetas', null, [
    'titulo' => (string) ($lumenti_servicios['titulo'] ?? ''),
    'items' => (array) ($lumenti_servicios['items'] ?? []),
]);
