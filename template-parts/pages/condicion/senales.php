<?php
defined('ABSPATH') || exit;

/*
 * Condición · senales (specs/condicion.md → senales). Grupo ACF: condicion_senales.
 * Título, intro, destacado, grupos de señales, pie y la nota dorada al final. Las señales están siempre
 * visibles (decisión del proyecto: el diseño las plegaba en acordeón solo bajo 768 px).
 * Encabezados: sin títulos de grupo, cada señal es h3; con grupos, el grupo es h3 y la señal h4.
 */

$lumenti_senales = [
    'titulo' => 'SEÑALES Y SÍNTOMAS FRECUENTES',
    'intro' => 'La depresión puede manifestarse de distintas maneras. Presentar uno o varios de estos signos no confirma por sí solo un diagnóstico, pero puede indicar que es momento de buscar orientación profesional.',
    'destacado' => '',
    'grupos' => [
        [
            'titulo' => '',
            'items' => [
                ['titulo' => 'ÁNIMO BAJO PERSISTENTE', 'texto' => 'Un estado de tristeza, vacío o desesperanza que se mantiene la mayor parte del día y durante casi todos los días.'],
                ['titulo' => 'PÉRDIDA DE INTERÉS', 'texto' => 'Dejas de disfrutar actividades, personas o pasatiempos que antes te resultaban placenteros o importantes en tu día a día.'],
                ['titulo' => 'FATIGA Y FALTA DE ENERGÍA', 'texto' => 'Sensación de cansancio y agotamiento constante, incluso al realizar tareas pequeñas o después de haber descansado.'],
                ['titulo' => 'CAMBIOS EN SUEÑO O APETITO', 'texto' => 'Dormir o comer mucho más —o mucho menos— de lo habitual, sin una causa física aparente que lo explique.'],
                ['titulo' => 'DIFICULTAD PARA CONCENTRARTE', 'texto' => 'Cuesta pensar con claridad, mantener la atención, recordar cosas o tomar decisiones cotidianas.'],
                ['titulo' => 'CULPA O INUTILIDAD', 'texto' => 'Sentimientos de inutilidad o culpa excesiva, incluso por situaciones que antes no te afectaban.'],
                ['titulo' => 'IRRITABILIDAD O INQUIETUD', 'texto' => 'Mayor sensibilidad, enojo frecuente o sensación de no poder estar en calma.'],
                ['titulo' => 'DESESPERANZA O PENSAMIENTOS RELACIONADOS CON LA MUERTE', 'texto' => 'Sentir que nada va a mejorar, perder el sentido de las cosas o tener pensamientos sobre no querer continuar son señales que necesitan atención profesional oportuna.'],
            ],
        ],
    ],
    'pie' => '',
];

$lumenti_grupos = array_values(array_filter($lumenti_senales['grupos'], static fn($g) => !empty($g['items'])));
if ($lumenti_senales['titulo'] === '' && !$lumenti_grupos) {
    return;
}
$lumenti_con_grupos = (bool) array_filter(array_column($lumenti_grupos, 'titulo'));
?>
<section class="lm-cond-signs" aria-labelledby="lm-signs-title">
    <div class="lm-cond-signs__header"><h2 class="lm-section-title" id="lm-signs-title"><?= esc_html($lumenti_senales['titulo']) ?></h2><?php if ($lumenti_senales['intro'] !== '') : ?><p class="lm-lead lm-cond-signs__intro"><?= esc_html($lumenti_senales['intro']) ?></p><?php endif; ?></div>
    <?php if ($lumenti_senales['destacado'] !== '') : ?>
        <p class="lm-cond-signs__highlight"><?= esc_html($lumenti_senales['destacado']) ?></p>
    <?php endif; ?>
    <?php foreach ($lumenti_grupos as $lumenti_g => $lumenti_grupo) : ?>
        <?php if (!empty($lumenti_grupo['titulo'])) : ?>
            <h3 class="lm-cond-signs__group-title"><?= esc_html($lumenti_grupo['titulo']) ?></h3>
        <?php endif; ?>
        <?php $lumenti_nivel = $lumenti_con_grupos ? 'h4' : 'h3'; ?>
        <ul class="lm-cond-signs__list">
            <?php foreach ($lumenti_grupo['items'] as $lumenti_item) : ?>
                <li class="lm-cond-signs__item">
                    <span class="lm-cond-signs__dot" aria-hidden="true"></span>
                    <<?= $lumenti_nivel ?> class="lm-cond-signs__title"><?= esc_html($lumenti_item['titulo']) ?></<?= $lumenti_nivel ?>>
                    <p class="lm-cond-signs__text"><?= esc_html($lumenti_item['texto']) ?></p>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endforeach; ?>
    <?php if ($lumenti_senales['pie'] !== '') : ?>
        <p class="lm-cond-signs__foot"><?= esc_html($lumenti_senales['pie']) ?></p>
    <?php endif; ?>
    <?php get_template_part('template-parts/pages/condicion/nota'); ?>
</section>
