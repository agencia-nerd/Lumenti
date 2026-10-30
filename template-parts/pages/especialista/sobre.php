<?php
defined('ABSPATH') || exit;

/*
 * Especialista · sobre (specs/especialista.md → sobre). Grupo ACF: especialista_sobre.
 * "SOBRE MÍ" (fijo) y la biografía en párrafos lm-lead. Hoy, los párrafos del ejemplo del diseño;
 * con ACF el campo wysiwyg especialista_sobre_biografia se imprime con wp_kses_post.
 */

$lumenti_sobre = [
    'biografia' => [
        'Mariela es médica psiquiatra y miembro de la Asociación de Psiquiatría Peruana. Su trayectoria integra la práctica clínica, la docencia y la divulgación científica aplicada, participando como conferencista, capacitadora e invitada en medios para acercar la psiquiatría a distintas audiencias con claridad, empatía y sensibilidad humana.',
        'En su práctica clínica, Mariela le da especial importancia a la historia personal de cada paciente. Considera que comprender el contexto, las experiencias y la forma en que cada persona ha construido su mundo interno es fundamental para entender el origen de muchos malestares actuales y diseñar un tratamiento realmente personalizado.',
        'Se formó como médico en la Universidad Peruana de Ciencias Aplicadas (UPC) y especialista en Psiquiatría en la Universidad Nacional Mayor de San Marcos y el Hospital Hermilio Valdizán, una de las instituciones referentes en salud mental del país. Además, cuenta con formación complementaria en Terapia Dialéctico Conductual, terapia de pareja, psiquiatría perinatal y trastornos del sueño, lo que le permite abordar la salud mental desde una perspectiva integral y actualizada.',
        'Como Directora Médica de Lumenti, lidera un modelo de atención centrado en la evidencia científica, la calidez humana y el acompañamiento personalizado. Su enfoque busca que cada paciente pueda comprender mejor lo que está viviendo, recibir una evaluación cuidadosa y acceder a un tratamiento diseñado según sus necesidades clínicas, emocionales y contextuales.',
        'Además de su labor asistencial, Mariela es conferencista y speaker en salud mental. Ha participado en talleres corporativos, capacitaciones para profesionales y estudiantes de la salud, paneles, entrevistas y medios de comunicación, traduciendo información científica compleja en mensajes claros, útiles y cercanos para distintas audiencias.',
    ],
];

$lumenti_parrafos = array_filter(array_map('trim', $lumenti_sobre['biografia']));
if (!$lumenti_parrafos) {
    return;
}
?>
<section class="lm-profile__section" aria-labelledby="lm-sobre">
    <h2 class="lm-profile__h2" id="lm-sobre">SOBRE MÍ</h2>
    <div class="lm-profile__bio"><?php foreach ($lumenti_parrafos as $lumenti_p) : ?><p class="lm-lead"><?= wp_kses_post($lumenti_p) ?></p><?php endforeach; ?></div>
</section>
