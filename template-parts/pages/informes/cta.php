<?php
defined('ABSPATH') || exit;

/*
 * Informes y certificados · cta (specs/informes.md → cta). Grupo ACF: informes_cta.
 * Prepara los datos y llama al componente cta: botón de WhatsApp (número de paciente) con el mensaje de la página.
 */

$lumenti_cta = [
    'titulo' => '¿NECESITAS UN CERTIFICADO O INFORME CLÍNICO?',
    'texto' => 'Cuéntanos para qué entidad o finalidad lo necesitas y te orientaremos sobre el documento, la evaluación y los requisitos correspondientes.',
    'boton' => [
        'texto' => 'Escríbenos por WhatsApp',
        'whatsapp' => 'paciente',
        'mensaje' => 'Hola, quisiera información sobre informes y certificados.',
    ],
];

get_template_part('template-parts/components/cta', null, $lumenti_cta);
