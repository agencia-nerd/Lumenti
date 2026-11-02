<?php
defined('ABSPATH') || exit;

/*
 * Contenido inicial de Psicología (specs/psicologia.md): el texto, las imágenes y los enlaces que salieron de
 * template-parts/pages/psicologia/*.php.
 */
return [
    'page'   => 'psicologia',
    'fields' => [
        'psicologia_hero' => [
            'titulo'   => "*PSICOLOGÍA PARA*\nCOMPRENDERTE Y AVANZAR.",
            'nota'     => 'Atención psicológica para diferentes etapas de la vida.',
            'etiqueta' => 'NUESTRO ENFOQUE',
            'bajada'   => 'Brindamos psicoterapia y evaluaciones psicológicas desde una mirada cercana, personalizada y basada en evidencia. Buscamos comprender tu historia, tu contexto y aquello que hoy está afectando tu bienestar, para brindarte herramientas que te ayuden a afrontar las dificultades, generar cambios y avanzar.',
        ],
        'psicologia_intro' => [
            'titulo'            => '¿QUÉ ES LA *PSICOLOGÍA* Y CUÁNDO BUSCARLA?',
            'texto'             => 'La psicología ayuda a comprender cómo pensamos, sentimos, nos relacionamos y actuamos ante las distintas experiencias de la vida. A través de la psicoterapia y la evaluación psicológica, permite identificar dificultades, desarrollar recursos y promover cambios que favorezcan el bienestar.',
            'texto_destacado'   => 'Puedes consultar cuando una situación afecta tu vida cotidiana, tus emociones o tus relaciones, pero también cuando deseas conocerte mejor, afrontar una etapa de cambio o fortalecer herramientas personales. No necesitas tener un diagnóstico para pedir apoyo.',
            'imagen_principal'  => ['_file' => 'assets/img/psico-hombre.webp', 'alt' => 'Hombre de perfil con luz cálida filtrada sobre el rostro'],
            'imagen_secundaria' => ['_file' => 'assets/img/psico-escalera.webp', 'alt' => 'Silueta de una cabeza con una persona subiendo una escalera en su interior'],
        ],
        'psicologia_servicios' => [
            'titulo' => 'SERVICIOS DE *PSICOLOGÍA*',
            'items'  => [
                [
                    'titulo'           => 'PSICOTERAPIA',
                    'texto'            => 'Contamos con psicólogos especializados en distintos enfoques psicoterapéuticos basados en evidencia. Esta diversidad nos permite orientar cada caso hacia el profesional y el tipo de terapia más adecuados, considerando el motivo de consulta, la etapa de vida y los objetivos de cada persona.',
                    'texto_destacado'  => 'Durante el proceso se trabajan herramientas para comprender y regular las emociones, afrontar dificultades, modificar patrones que generan malestar y construir cambios significativos en la vida cotidiana.',
                    'lista'            => '',
                    'boton_texto'      => 'Agendar psicoterapia',
                    'mensaje_whatsapp' => 'Hola, quisiera agendar una cita de psicoterapia.',
                ],
                [
                    'titulo'           => 'EVALUACIONES PSICOLÓGICAS',
                    'texto'            => 'Procesos especializados que permiten conocer diferentes aspectos emocionales, cognitivos, conductuales o vocacionales mediante una valoración profesional y el uso de instrumentos psicológicos seleccionados según cada caso.',
                    'texto_destacado'  => '',
                    'lista'            => "Evaluación emocional\nEvaluación de atención y conducta\nEvaluación de inteligencia\nOrientación vocacional\nEvaluación de aprendizaje",
                    'boton_texto'      => 'Quiero mi evaluación',
                    'mensaje_whatsapp' => 'Hola, quisiera agendar una evaluación psicológica.',
                ],
            ],
        ],
        'psicologia_especialistas' => [
            'titulo' => 'CONOCE A LOS *ESPECIALISTAS*',
            'bajada' => 'Psicólogos clínicos con enfoque humano y basado en evidencia.',
        ],
        'psicologia_cta' => [
            'titulo'           => 'DAR EL PRIMER PASO TAMBIÉN ES UNA FORMA DE CUIDARTE',
            'texto'            => 'Encuentra en Lumenti una atención profesional, cercana y pensada para ti.',
            'boton_texto'      => 'Agendar una cita',
            'mensaje_whatsapp' => 'Hola, quisiera agendar una consulta de psicología.',
        ],
    ],
];
