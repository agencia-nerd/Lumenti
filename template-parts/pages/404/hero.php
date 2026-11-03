<?php
defined('ABSPATH') || exit;

/*
 * 404 · hero. Componente page-hero (variante service), como Psiquiatría o Preguntas frecuentes.
 * Acciones: volver al inicio y WhatsApp de pacientes.
 */

get_template_part('template-parts/components/page-hero', null, [
    'titulo' => "*" . __('NO ENCONTRAMOS', 'lumenti') . "*\n" . __('ESTA PÁGINA', 'lumenti'),
    'nota' => __('Puede que el enlace haya cambiado o que la página ya no esté disponible.', 'lumenti'),
    'etiqueta' => __('Error 404', 'lumenti'),
    'bajada' => __('Te ayudamos a encontrar lo que buscabas: vuelve al inicio, busca a un especialista o escríbenos y te orientamos.', 'lumenti'),
    'variante' => 'service',
    'breadcrumb' => [
        ['texto' => __('Página no encontrada', 'lumenti')],
    ],
    'acciones' => [
        [
            'tipo' => 'boton',
            'texto' => __('Volver al inicio', 'lumenti'),
            'url' => home_url('/'),
            'icono' => 'flecha',
        ],
        [
            'tipo' => 'boton',
            'texto' => __('Escríbenos por WhatsApp', 'lumenti'),
            'variante' => 'secondary',
            'icono' => 'whatsapp',
            'whatsapp' => 'paciente',
        ],
    ],
]);
