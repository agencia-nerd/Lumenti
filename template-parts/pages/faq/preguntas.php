<?php
defined('ABSPATH') || exit;

/*
 * Preguntas frecuentes · preguntas (specs/faq.md → preguntas, grupo ACF faq_preguntas; Skill: wp-accordion).
 * Esta sección imprime el contenedor y el título h2 de cada tema; la lista de preguntas la arma
 * template-parts/accordions/faq.php (wp-accordion, sobre <details>/<summary> con las clases lm-faq__*).
 *
 * $args que recibe el acordeón (uno por tema):
 *   items        [['pregunta' => '…', 'respuesta' => '…'], …]
 *   titulo_id    id del h2 del tema (aria-labelledby de la lista).
 *   grupo        nombre común a toda la página (una sola pregunta abierta a la vez en toda la página).
 *   abierta      índice de la pregunta abierta al cargar dentro de este tema (0 en el primero; null en los demás).
 *   inicio       número de la primera pregunta del tema (ids únicos en la página: lm-faq-q{n} / lm-faq-a{n}).
 *   nivel        nivel del encabezado de cada pregunta (h3, bajo el h2 del tema).
 *   mantener     true = como el diseño, no se puede cerrar la última abierta (data-lm-acc-keep); la skill decide.
 * Datos fijos del diseño (html/faq.html, data/faq.json) hasta el paso ACF.
 */

$lumenti_grupos = [
    [
        'titulo' => 'CONSULTAS Y CITAS',
        'preguntas' => [
            ['pregunta' => '¿CÓMO AGENDO MI PRIMERA CITA?', 'respuesta' => 'Escríbenos por WhatsApp. Te pediremos algunos datos para orientarte y ayudarte a encontrar al profesional más adecuado.'],
            ['pregunta' => '¿CÓMO SÉ SI DEBO EMPEZAR POR PSIQUIATRÍA O PSICOLOGÍA?', 'respuesta' => 'Si necesitas una evaluación integral de lo que estás sintiendo, recomendamos comenzar por psiquiatría. Si buscas iniciar un proceso psicoterapéutico o trabajar un aspecto específico, puedes empezar por psicología. También podemos ayudarte a encontrar la mejor opción por nuestro canal de WhatsApp.'],
            ['pregunta' => '¿ATIENDEN DE MANERA PRESENCIAL Y ONLINE?', 'respuesta' => 'Sí. Contamos con atención presencial en Santiago de Surco y consultas online, según la disponibilidad de cada especialista.'],
            ['pregunta' => '¿CUÁNTO DURA UNA CONSULTA?', 'respuesta' => 'Las consultas de psiquiatría duran aproximadamente 45 minutos y las sesiones de psicoterapia, 55 minutos. Algunas evaluaciones pueden requerir más tiempo o más de una sesión.'],
            ['pregunta' => '¿PUEDO REPROGRAMAR O CANCELAR MI CITA?', 'respuesta' => 'Sí. Puedes solicitar una reprogramación con al menos 24 horas de anticipación, de acuerdo con nuestras políticas de atención.'],
        ],
    ],
    [
        'titulo' => 'EVALUACIÓN Y TRATAMIENTO',
        'preguntas' => [
            ['pregunta' => '¿QUÉ PUEDO ESPERAR DE LA PRIMERA CONSULTA?', 'respuesta' => 'Se realizará una evaluación integral para comprender lo que estás viviendo, tu historia, tu contexto y cómo está afectando tu vida cotidiana. A partir de ello, se construirá contigo un plan de tratamiento adaptado a tus necesidades.'],
            ['pregunta' => '¿TODO TRATAMIENTO PSIQUIÁTRICO INCLUYE MEDICACIÓN?', 'respuesta' => 'No. El tratamiento se define después de la evaluación y puede incluir distintas herramientas. Si el psiquiatra recomienda medicación, te explicará sus beneficios, alternativas y seguimiento.'],
            ['pregunta' => '¿LA INFORMACIÓN QUE COMPARTO ES CONFIDENCIAL?', 'respuesta' => 'Sí. La información de las consultas se maneja de forma confidencial y solo puede compartirse con tu autorización, salvo las excepciones establecidas por ley.'],
            ['pregunta' => '¿QUÉ HAGO SI TENGO UNA DUDA DESPUÉS DE MI CONSULTA?', 'respuesta' => 'Después de tu consulta, cuentas con acompañamiento por WhatsApp para resolver dudas sobre las indicaciones, tu tratamiento y/o temas administrativos.'],
            ['pregunta' => '¿CUÁNTAS SESIONES VOY A NECESITAR?', 'respuesta' => 'Dependerá de tu motivo de consulta, tus objetivos y tu evolución. El profesional conversará contigo sobre el plan y realizará los ajustes necesarios durante el proceso.'],
            ['pregunta' => '¿CÓMO SOLICITO UN INFORME, CERTIFICADO O REPORTE PSICOLÓGICO?', 'respuesta' => 'Estos documentos se elaboran previa evaluación profesional. El plazo y el costo dependen del documento solicitado; la entrega puede tomar hasta cinco días hábiles.'],
        ],
    ],
];
$lumenti_acordeon = locate_template('template-parts/accordions/faq.php') !== '';
$lumenti_inicio = 0;
?>
<section class="lm-faq" aria-label="<?= esc_attr__('Preguntas frecuentes', 'lumenti') ?>">
    <div class="lm-faq__inner">
        <?php foreach ($lumenti_grupos as $lumenti_g => $lumenti_grupo) :
            if (empty($lumenti_grupo['preguntas'])) {
                continue;
            }
            $lumenti_titulo_id = 'lm-faq-g' . $lumenti_g;
        ?>
            <div class="lm-faq__group">
                <h2 class="lm-faq__group-title" id="<?= esc_attr($lumenti_titulo_id) ?>"><?= esc_html($lumenti_grupo['titulo']) ?></h2>
                <?php
                if ($lumenti_acordeon) {
                    get_template_part('template-parts/accordions/faq', null, [
                        'items' => $lumenti_grupo['preguntas'],
                        'titulo_id' => $lumenti_titulo_id,
                        'grupo' => 'lm-faq',
                        'abierta' => $lumenti_g === 0 ? 0 : null,
                        'inicio' => $lumenti_inicio,
                        'nivel' => 'h3',
                        'mantener' => true,
                    ]);
                }
                $lumenti_inicio += count($lumenti_grupo['preguntas']);
                ?>
            </div>
        <?php endforeach; ?>
    </div>
</section>
