<?php
defined('ABSPATH') || exit;

/*
 * Contenido inicial de Psiquiatría (specs/psiquiatria.md): el texto, las imágenes y los enlaces que salieron de
 * template-parts/pages/psiquiatria/*.php.
 */
return [
    'page'   => 'psiquiatria',
    'fields' => [
        'psiquiatria_hero' => [
            'titulo'   => "*PSIQUIATRÍA QUE*\nCOMPRENDE TU HISTORIA",
            'nota'     => 'Atención presencial y virtual para diferentes etapas de la vida.',
            'etiqueta' => 'NUESTRO ENFOQUE',
            'bajada'   => 'Brindamos una evaluación clínica integral para comprender no solo tus síntomas, sino también tu historia, tu contexto y cómo lo que estás viviendo impacta en tu día a día. A partir de ello, construimos contigo un plan de tratamiento personalizado y basado en evidencia.',
        ],
        'psiquiatria_intro' => [
            'titulo'             => '¿QUÉ ES LA *PSIQUIATRÍA* Y CUÁNDO CONSULTAR?',
            'texto'              => 'La psiquiatría es la especialidad médica dedicada a evaluar y abordar la salud mental desde una mirada integral. Considera factores emocionales, biológicos, conductuales y del entorno, además de posibles causas médicas que puedan estar influyendo.',
            'texto_destacado'    => 'Es recomendable consultar cuando lo que sientes comienza a afectar tu bienestar, tus relaciones, tus estudios, tu trabajo o tu funcionamiento cotidiano. Acudir a un psiquiatra no significa necesariamente iniciar medicación: el tratamiento se define de manera individual después de una evaluación clínica.',
            'imagen_principal'   => ['_file' => 'assets/img/psiq-sombrero.webp', 'alt' => 'Mujer con sombrero sentada frente al mar al atardecer'],
            'imagen_secundaria'  => ['_file' => 'assets/img/psiq-silueta.webp', 'alt' => 'Silueta de una persona de perfil frente al cielo'],
        ],
        'psiquiatria_cita' => [
            'titulo' => '¿CÓMO ES UNA CITA POR PSIQUIATRÍA EN LUMENTI?',
            'texto'  => 'Desde la primera consulta realizamos una evaluación clínica integral para comprender qué está ocurriendo, cómo ha evolucionado y de qué manera está impactando en tu vida. Cada atención se adapta al motivo de consulta y a la situación de la persona.',
            'globos' => [
                ['texto' => 'Mirada integral'],
                ['texto' => 'Atención personalizada'],
                ['texto' => 'Espacio confidencial'],
                ['texto' => 'Acompañamiento cercano'],
            ],
        ],
        'psiquiatria_especialistas' => [
            'titulo' => 'CONOCE A LOS *ESPECIALISTAS*',
            'bajada' => 'Médicos psiquiatras con enfoque humano y basado en evidencia.',
        ],
        'psiquiatria_cta' => [
            'titulo'           => 'DAR EL PRIMER PASO TAMBIÉN ES UNA FORMA DE CUIDARTE',
            'texto'            => 'Encuentra en Lumenti una atención profesional, cercana y pensada para ti.',
            'boton_texto'      => 'Agendar una cita',
            'mensaje_whatsapp' => 'Hola, quisiera agendar una consulta de psiquiatría.',
        ],
    ],
];
