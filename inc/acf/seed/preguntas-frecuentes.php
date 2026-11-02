<?php
defined('ABSPATH') || exit;

/*
 * Contenido inicial de Preguntas frecuentes (specs/preguntas-frecuentes.md): el texto que salió de
 * template-parts/pages/faq/*.php. El fondo del CTA queda vacío: usa el video del componente.
 */
return [
    'page'   => 'preguntas-frecuentes',
    'fields' => [
        'preguntas_frecuentes_hero' => [
            'titulo'   => "*PREGUNTAS*\nFRECUENTES.",
            'nota'     => 'Atención presencial y virtual para cada etapa de la vida.',
            'etiqueta' => 'AYUDA',
            'bajada'   => 'Resolvemos las dudas más comunes sobre nuestros servicios, el proceso de atención y cómo empezar. Si no encuentras lo que buscas, escríbenos.',
        ],
        'preguntas_frecuentes_preguntas' => [
            'grupos' => [
                [
                    'titulo'    => 'CONSULTAS Y CITAS',
                    'preguntas' => [
                        ['pregunta' => '¿CÓMO AGENDO MI PRIMERA CITA?', 'respuesta' => 'Escríbenos por WhatsApp. Te pediremos algunos datos para orientarte y ayudarte a encontrar al profesional más adecuado.'],
                        ['pregunta' => '¿CÓMO SÉ SI DEBO EMPEZAR POR PSIQUIATRÍA O PSICOLOGÍA?', 'respuesta' => 'Si necesitas una evaluación integral de lo que estás sintiendo, recomendamos comenzar por psiquiatría. Si buscas iniciar un proceso psicoterapéutico o trabajar un aspecto específico, puedes empezar por psicología. También podemos ayudarte a encontrar la mejor opción por nuestro canal de WhatsApp.'],
                        ['pregunta' => '¿ATIENDEN DE MANERA PRESENCIAL Y ONLINE?', 'respuesta' => 'Sí. Contamos con atención presencial en Santiago de Surco y consultas online, según la disponibilidad de cada especialista.'],
                        ['pregunta' => '¿CUÁNTO DURA UNA CONSULTA?', 'respuesta' => 'Las consultas de psiquiatría duran aproximadamente 45 minutos y las sesiones de psicoterapia, 55 minutos. Algunas evaluaciones pueden requerir más tiempo o más de una sesión.'],
                        ['pregunta' => '¿PUEDO REPROGRAMAR O CANCELAR MI CITA?', 'respuesta' => 'Sí. Puedes solicitar una reprogramación con al menos 24 horas de anticipación, de acuerdo con nuestras políticas de atención.'],
                    ],
                ],
                [
                    'titulo'    => 'EVALUACIÓN Y TRATAMIENTO',
                    'preguntas' => [
                        ['pregunta' => '¿QUÉ PUEDO ESPERAR DE LA PRIMERA CONSULTA?', 'respuesta' => 'Se realizará una evaluación integral para comprender lo que estás viviendo, tu historia, tu contexto y cómo está afectando tu vida cotidiana. A partir de ello, se construirá contigo un plan de tratamiento adaptado a tus necesidades.'],
                        ['pregunta' => '¿TODO TRATAMIENTO PSIQUIÁTRICO INCLUYE MEDICACIÓN?', 'respuesta' => 'No. El tratamiento se define después de la evaluación y puede incluir distintas herramientas. Si el psiquiatra recomienda medicación, te explicará sus beneficios, alternativas y seguimiento.'],
                        ['pregunta' => '¿LA INFORMACIÓN QUE COMPARTO ES CONFIDENCIAL?', 'respuesta' => 'Sí. La información de las consultas se maneja de forma confidencial y solo puede compartirse con tu autorización, salvo las excepciones establecidas por ley.'],
                        ['pregunta' => '¿QUÉ HAGO SI TENGO UNA DUDA DESPUÉS DE MI CONSULTA?', 'respuesta' => 'Después de tu consulta, cuentas con acompañamiento por WhatsApp para resolver dudas sobre las indicaciones, tu tratamiento y/o temas administrativos.'],
                        ['pregunta' => '¿CUÁNTAS SESIONES VOY A NECESITAR?', 'respuesta' => 'Dependerá de tu motivo de consulta, tus objetivos y tu evolución. El profesional conversará contigo sobre el plan y realizará los ajustes necesarios durante el proceso.'],
                        ['pregunta' => '¿CÓMO SOLICITO UN INFORME, CERTIFICADO O REPORTE PSICOLÓGICO?', 'respuesta' => 'Estos documentos se elaboran previa evaluación profesional. El plazo y el costo dependen del documento solicitado; la entrega puede tomar hasta cinco días hábiles.'],
                    ],
                ],
            ],
        ],
        'preguntas_frecuentes_cta' => [
            'titulo'        => '¿TIENES MÁS PREGUNTAS? ESCRÍBENOS.',
            'texto'         => 'Escríbenos por WhatsApp y te orientamos en el momento.',
            'boton_texto'   => 'Escríbenos por WhatsApp',
            'boton_mensaje' => 'Hola, tengo una consulta sobre la atención en Lumenti.',
        ],
    ],
];
