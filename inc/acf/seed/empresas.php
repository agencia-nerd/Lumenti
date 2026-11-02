<?php
defined('ABSPATH') || exit;

/*
 * Contenido inicial de Empresas (specs/empresas.md): el texto, las imágenes y los enlaces que salieron de
 * template-parts/pages/empresas/*.php y del CTA de pages/template-empresas.php.
 */
return [
    'page'   => 'empresas',
    'fields' => [
        'empresas_hero' => [
            'titulo'   => "*SALUD MENTAL*\nPARA ORGANIZACIONES.",
            'nota'     => 'Soluciones adaptadas a la realidad y los objetivos de cada organización.',
            'bajada'   => 'Ayudamos a las organizaciones a promover el bienestar, prevenir riesgos y responder de manera responsable ante los desafíos de salud mental de sus equipos, mediante talleres, programas y atención especializada.',
        ],
        'empresas_desafios' => [
            'titulo' => "DESAFÍOS QUE IMPACTAN EN EL\n*BIENESTAR DE LOS EQUIPOS*",
            'bajada' => 'Reconocer estos desafíos permite construir respuestas preventivas y entornos de trabajo más saludables.',
            'items'  => [
                ['icono' => ['_file' => 'assets/img/emp-ic-estres.webp', 'alt' => ''], 'titulo' => 'ESTRÉS LABORAL', 'texto' => 'La presión constante afecta el rendimiento, la concentración y el bienestar general del equipo.'],
                ['icono' => ['_file' => 'assets/img/emp-ic-conflictos.webp', 'alt' => ''], 'titulo' => 'CONFLICTOS INTERPERSONALES', 'texto' => 'La tensión entre personas o equipos impacta directamente en los resultados y el clima de trabajo.'],
                ['icono' => ['_file' => 'assets/img/emp-ic-ausentismo.webp', 'alt' => ''], 'titulo' => 'AUSENTISMO Y PRESENTISMO', 'texto' => 'Los problemas de salud mental generan ausencias o presencia sin productividad real.'],
                ['icono' => ['_file' => 'assets/img/emp-ic-burnout.webp', 'alt' => ''], 'titulo' => 'BURNOUT Y AGOTAMIENTO', 'texto' => 'El agotamiento crónico reduce la motivación y aumenta el riesgo de baja y rotación del talento.'],
                ['icono' => ['_file' => 'assets/img/emp-ic-comunicacion.webp', 'alt' => ''], 'titulo' => 'COMUNICACIÓN Y EQUIPOS', 'texto' => 'Las dificultades interpersonales y la falta de comunicación deterioran el clima laboral.'],
            ],
        ],
        'empresas_soluciones' => [
            'titulo' => 'SOLUCIONES PARA *TU ORGANIZACIÓN*',
            'bajada' => 'Acompañamos a las organizaciones desde la formación y la prevención hasta la atención clínica de sus colaboradores.',
            'items'  => [
                [
                    'imagen'       => ['_file' => 'assets/img/emp-talleres.webp', 'alt' => 'Profesional tomando notas durante una sesión'],
                    'titulo'       => 'TALLERES Y CAPACITACIONES',
                    'texto'        => 'Sesiones prácticas dirigidas a colaboradores y líderes para fortalecer conocimientos y herramientas relacionadas con la salud mental y el bienestar laboral.',
                    'boton_texto'  => 'Ver talleres',
                    'destino'      => 'talleres',
                    'preseleccion' => 'ninguna',
                ],
                [
                    'imagen'       => ['_file' => 'assets/img/emp-programas.webp', 'alt' => 'Equipo de trabajo celebrando un logro'],
                    'titulo'       => 'PROGRAMAS DE PREVENCIÓN Y BIENESTAR',
                    'texto'        => 'Intervenciones desarrolladas en varias etapas para abordar objetivos específicos, fortalecer factores protectores y promover una cultura organizacional más saludable.',
                    'boton_texto'  => 'Solicitar propuesta',
                    'destino'      => 'formulario',
                    'preseleccion' => 'prevencion',
                ],
                [
                    'imagen'       => ['_file' => 'assets/img/emp-atencion.webp', 'alt' => 'Médico redactando una receta en consulta'],
                    'titulo'       => 'ATENCIÓN CLÍNICA PARA COLABORADORES',
                    'texto'        => 'Facilitamos el acceso a consultas de psiquiatría y psicología para colaboradores que requieran atención profesional, de manera presencial o virtual.',
                    'boton_texto'  => 'Solicitar propuesta',
                    'destino'      => 'formulario',
                    'preseleccion' => 'atencion',
                ],
            ],
        ],
        'empresas_como_trabajamos' => [
            'titulo' => 'CONOCE *CÓMO TRABAJAMOS*',
            'bajada' => 'Un proceso claro y personalizado desde el primer contacto hasta el seguimiento de resultados en tu organización.',
            'pasos'  => [
                ['titulo' => 'CONOCEMOS LA NECESIDAD', 'texto' => 'Conversamos con el equipo responsable para comprender el contexto, los objetivos, el perfil de los participantes y los principales desafíos de la organización.'],
                ['titulo' => 'DISEÑAMOS LA PROPUESTA', 'texto' => 'Definimos los contenidos, la metodología, los profesionales y el alcance más adecuados para los objetivos planteados.'],
                ['titulo' => 'IMPLEMENTAMOS LA SOLUCIÓN', 'texto' => 'Desarrollamos la intervención con profesionales especializados, procurando una experiencia clara, participativa y adaptada a la cultura de la organización.'],
                ['titulo' => 'RECOGEMOS RESULTADOS', 'texto' => 'Recopilamos la valoración de los participantes y compartimos información relevante sobre el desarrollo de la intervención, según el alcance acordado.'],
            ],
            'cierre'       => '¿Empezamos?',
            'enlace_texto' => 'Solicitar propuesta',
        ],
        'empresas_por_que' => [
            'titulo'          => '¿POR QUÉ TRABAJAR CON LUMENTI?',
            'texto'           => 'Contamos con un equipo de psiquiatras y psicólogos con experiencia clínica y formación en diferentes áreas de la salud mental. Diseñamos intervenciones basadas en evidencia y adaptadas al contexto, los objetivos y las características de cada organización.',
            'texto_destacado' => 'Nuestro enfoque combina prevención, formación y acceso a atención especializada, permitiendo desarrollar soluciones que van desde un taller puntual hasta un programa más amplio de bienestar.',
            'imagen_fondo'    => ['_file' => 'assets/img/emp-manos.webp', 'alt' => 'Equipo de trabajo uniendo sus manos al centro'],
            'imagen_frente'   => ['_file' => 'assets/img/emp-medico.webp', 'alt' => 'Especialista de Lumenti sentado en su consultorio'],
        ],
        'empresas_talleres' => [
            'titulo'         => "EXPLORA NUESTROS\nTALLERES *Y CAPACITACIONES*",
            'bajada'         => 'Formamos a colaboradores, líderes y organizaciones con herramientas prácticas y actualizadas para cuidar la salud mental en el entorno laboral. Cada taller se adapta a la realidad y objetivos de tu equipo.',
            'temas_etiqueta' => 'Temas sugeridos:',
            'items'          => [
                [
                    'nombre'      => 'SALUD MENTAL Y BIENESTAR EMOCIONAL',
                    'descripcion' => '',
                    'temas'       => "Estrés laboral y manejo de la ansiedad\nBurnout: prevención, señales de alerta y recuperación\nRegulación emocional en contextos de alta exigencia\nAutocuidado y bienestar mental en el trabajo\nSueño, descanso y hábitos saludables\nCómo pedir ayuda y acompañar a otros sin estigma",
                ],
                [
                    'nombre'      => 'LIDERAZGO Y EQUIPOS SALUDABLES',
                    'descripcion' => '',
                    'temas'       => "Liderazgo saludable y gestión emocional\nCómo acompañar a un colaborador en dificultad\nComunicación empática y conversaciones difíciles\nClima laboral y relaciones saludables\nPrevención del desgaste en líderes\nHerramientas para equipos en contextos de presión o cambio",
                ],
                [
                    'nombre'      => 'PREVENCIÓN Y RESPUESTA TEMPRANA',
                    'descripcion' => '',
                    'temas'       => "Señales de alerta en salud mental\nPrimeros auxilios psicológicos en el entorno laboral\nPrevención del burnout y desgaste emocional\nManejo inicial de crisis emocionales\nPrevención del suicidio desde una mirada responsable\nRutas de derivación y acompañamiento interno",
                ],
            ],
        ],
        'empresas_propuesta' => [
            'titulo'           => 'CUÉNTANOS QUÉ NECESITA *TU ORGANIZACIÓN*',
            'bajada'           => 'Comparte con nosotros el contexto de tu empresa y te contactaremos a la brevedad con una propuesta a medida.',
            'mensaje_whatsapp' => 'Hola, quisiera información sobre las soluciones de salud mental para empresas.',
            'imagen'           => ['_file' => 'assets/img/emp-equipo.webp', 'alt' => 'Colaboradoras conversando y sonriendo al aire libre'],
            'exito_titulo'     => '¡GRACIAS! RECIBIMOS TU SOLICITUD',
            'exito_texto'      => 'Nuestro equipo corporativo revisará la información y te contactará a la brevedad con una propuesta a medida.',
        ],
        'empresas_cta' => [
            'titulo'           => 'CUIDAR A TU EQUIPO TAMBIÉN ES CUIDAR TU ORGANIZACIÓN.',
            'texto'            => 'Diseñamos soluciones de salud mental adaptadas a las necesidades y objetivos de cada empresa.',
            'boton_texto'      => 'Conversemos por WhatsApp',
            'mensaje_whatsapp' => 'Hola, quisiera conversar sobre salud mental para mi organización.',
        ],
    ],
];
