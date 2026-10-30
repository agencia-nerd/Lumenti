<?php
defined('ABSPATH') || exit;

/*
 * Condición · abordaje (specs/condicion.md → abordaje). Grupo ACF: condicion_abordaje.
 * Sección oscura (data-lm-nav-tone="dark": el header cambia de tono encima) con título, intro y la lista
 * ordenada de pasos, siempre visible (el diseño la plegaba en acordeón solo bajo 768 px).
 * En el texto, una línea en blanco separa párrafos.
 */

$lumenti_abordaje = [
    'titulo' => '¿CÓMO ABORDAMOS LA DEPRESIÓN?',
    'intro' => 'Un enfoque integral, personalizado y con acompañamiento en cada etapa, respaldado por evidencia clínica.',
    'items' => [
        ['titulo' => 'EVALUACIÓN INTEGRAL', 'texto' => 'Como punto de partida, en Lumenti solemos recomendar una evaluación por Psiquiatría, especialmente cuando los síntomas son persistentes, intensos o afectan el funcionamiento cotidiano. Durante esta valoración buscamos comprender los síntomas, su evolución y el impacto que están teniendo en tu vida. También revisamos antecedentes, tratamientos previos y otros factores médicos, emocionales o del entorno que puedan estar influyendo, con el objetivo de descartar posibles causas médicas y orientar el plan de tratamiento más adecuado.'],
        ['titulo' => 'PLAN DE TRATAMIENTO PERSONALIZADO', 'texto' => 'El tratamiento se define según las características y necesidades de cada persona. Puede integrar psicoterapia, psicoeducación, herramientas para manejar los síntomas, fortalecimiento de la red de apoyo y cambios en hábitos como el sueño y la actividad física. Cuando la evaluación médica indica que puede ser beneficioso, también puede incluir tratamiento farmacológico.'],
        ['titulo' => 'SEGUIMIENTO, EVOLUCIÓN Y ALTA', 'texto' => 'A lo largo del tratamiento se evalúan los cambios en los síntomas, el bienestar y el funcionamiento cotidiano. Según la evolución, el profesional puede ajustar las intervenciones o espaciar progresivamente las consultas. Cuando se alcanzan los objetivos terapéuticos y existe una estabilidad sostenida, se planifica el alta de manera conjunta, incorporando herramientas para mantener los avances, reconocer señales de alerta y reducir el riesgo de recaídas.'],
    ],
];

$lumenti_items = array_values(array_filter($lumenti_abordaje['items'], static fn($i) => trim((string) ($i['titulo'] ?? '')) !== ''));
if (!$lumenti_items) {
    return;
}
?>
<section class="lm-cond-approach" data-lm-nav-tone="dark" aria-labelledby="lm-approach-title">
    <div class="lm-cond-approach__header"><h2 class="lm-section-title lm-section-title--light" id="lm-approach-title"><?= esc_html($lumenti_abordaje['titulo']) ?></h2><?php if ($lumenti_abordaje['intro'] !== '') : ?><p class="lm-cond-approach__intro"><?= esc_html($lumenti_abordaje['intro']) ?></p><?php endif; ?></div>
    <ol class="lm-cond-approach__list">
        <?php foreach ($lumenti_items as $lumenti_item) : ?>
            <li class="lm-cond-approach__item">
                <h3 class="lm-cond-approach__title"><?= esc_html($lumenti_item['titulo']) ?></h3>
                <div class="lm-cond-approach__body">
                    <?php foreach (preg_split('/\n\s*\n/', trim((string) $lumenti_item['texto'])) as $lumenti_parrafo) : ?>
                        <p class="lm-cond-approach__text"><?= esc_html($lumenti_parrafo) ?></p>
                    <?php endforeach; ?>
                </div>
            </li>
        <?php endforeach; ?>
    </ol>
</section>
