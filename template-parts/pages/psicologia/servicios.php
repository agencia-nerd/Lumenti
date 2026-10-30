<?php
defined('ABSPATH') || exit;

/*
 * Psicología · servicios (specs/psicologia.md → servicios). Grupo ACF: psicologia_servicios.
 * Título centrado y dos tarjetas con botón de WhatsApp (número de paciente). Prepara los datos; el marcado está en
 * servicios-tarjetas.php. La tarjeta con `ancla` imprime ese id: "evaluaciones" lo enlazan el pie y el Home
 * (/psicologia/#evaluaciones), no lo cambies.
 */

$lumenti_servicios = [
    'titulo' => 'SERVICIOS DE *PSICOLOGÍA*',
    'items' => [
        [
            'titulo' => 'PSICOTERAPIA',
            'texto' => 'Contamos con psicólogos especializados en distintos enfoques psicoterapéuticos basados en evidencia. Esta diversidad nos permite orientar cada caso hacia el profesional y el tipo de terapia más adecuados, considerando el motivo de consulta, la etapa de vida y los objetivos de cada persona.',
            'texto_destacado' => 'Durante el proceso se trabajan herramientas para comprender y regular las emociones, afrontar dificultades, modificar patrones que generan malestar y construir cambios significativos en la vida cotidiana.',
            'lista' => '',
            'boton_texto' => 'Agendar psicoterapia',
            'mensaje_whatsapp' => 'Hola, quisiera agendar una cita de psicoterapia.',
            'ancla' => '',
        ],
        [
            'titulo' => 'EVALUACIONES PSICOLÓGICAS',
            'texto' => 'Procesos especializados que permiten conocer diferentes aspectos emocionales, cognitivos, conductuales o vocacionales mediante una valoración profesional y el uso de instrumentos psicológicos seleccionados según cada caso.',
            'texto_destacado' => '',
            'lista' => "Evaluación emocional\nEvaluación de atención y conducta\nEvaluación de inteligencia\nOrientación vocacional\nEvaluación de aprendizaje",
            'boton_texto' => 'Quiero mi evaluación',
            'mensaje_whatsapp' => 'Hola, quisiera agendar una evaluación psicológica.',
            'ancla' => 'evaluaciones',
        ],
    ],
];

get_template_part('template-parts/pages/psicologia/servicios-tarjetas', null, $lumenti_servicios);
