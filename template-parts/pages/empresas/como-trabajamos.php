<?php
defined('ABSPATH') || exit;

/*
 * Empresas → como-trabajamos (specs/empresas.md). Grupo ACF: Empresas → empresas_como_trabajamos.
 * data-lm-steps: empresas.js (empresasSteps) cambia el paso activo y su número según el scroll; bajo 768 px
 * se ven los 4. El número sale de la posición (01, 02…).
 */

$lumenti_como = [
    'titulo' => 'CONOCE *CÓMO TRABAJAMOS*',
    'bajada' => 'Un proceso claro y personalizado desde el primer contacto hasta el seguimiento de resultados en tu organización.',
    'pasos' => [
        ['titulo' => 'CONOCEMOS LA NECESIDAD', 'texto' => 'Conversamos con el equipo responsable para comprender el contexto, los objetivos, el perfil de los participantes y los principales desafíos de la organización.'],
        ['titulo' => 'DISEÑAMOS LA PROPUESTA', 'texto' => 'Definimos los contenidos, la metodología, los profesionales y el alcance más adecuados para los objetivos planteados.'],
        ['titulo' => 'IMPLEMENTAMOS LA SOLUCIÓN', 'texto' => 'Desarrollamos la intervención con profesionales especializados, procurando una experiencia clara, participativa y adaptada a la cultura de la organización.'],
        ['titulo' => 'RECOGEMOS RESULTADOS', 'texto' => 'Recopilamos la valoración de los participantes y compartimos información relevante sobre el desarrollo de la intervención, según el alcance acordado.'],
    ],
    'cierre' => '¿Empezamos?',
    'enlace_texto' => 'Solicitar propuesta',
];

if (!$lumenti_como['pasos']) {
    return;
}
?>
<section class="lm-emp-steps" aria-labelledby="lm-emp-how" data-lm-steps>
    <div class="lm-emp-steps__sticky">
        <span class="lm-emp-steps__ring lm-emp-steps__ring--outer" aria-hidden="true"></span><span class="lm-emp-steps__ring lm-emp-steps__ring--inner" aria-hidden="true"></span>
        <div class="lm-emp-steps__header">
            <h2 class="lm-emp-steps__title" id="lm-emp-how"><?= lumenti_highlight($lumenti_como['titulo']) ?></h2>
            <?php if ($lumenti_como['bajada'] !== '') : ?>
                <p class="lm-emp-steps__lead"><?= esc_html($lumenti_como['bajada']) ?></p>
            <?php endif; ?>
        </div>
        <div class="lm-emp-steps__body">
            <div>
                <ol class="lm-emp-steps__list">
                    <?php foreach ($lumenti_como['pasos'] as $lumenti_i => $lumenti_paso) : $lumenti_num = sprintf('%02d', $lumenti_i + 1); ?>
                        <li class="lm-emp-steps__item<?= $lumenti_i === 0 ? ' is-active' : '' ?>" data-lm-step><h3 class="lm-emp-steps__step-title"><span class="lm-visually-hidden"><?= esc_html(sprintf(__('Paso %s: ', 'lumenti'), $lumenti_num)) ?></span><?= esc_html($lumenti_paso['titulo']) ?></h3><p class="lm-emp-steps__step-text"><?= esc_html($lumenti_paso['texto']) ?></p></li>
                    <?php endforeach; ?>
                </ol>
                <p class="lm-emp-steps__close"><?php if ($lumenti_como['cierre'] !== '') : ?><?= esc_html($lumenti_como['cierre']) ?> <?php endif; ?><?php get_template_part('template-parts/components/enlace-flecha', null, [
                    'texto' => $lumenti_como['enlace_texto'],
                    'url' => '#propuesta',
                    'atributos' => ['data-lm-goto' => 'formulario'],
                ]); ?></p>
            </div>
            <div class="lm-emp-steps__numbers" aria-hidden="true"><?php foreach (array_keys($lumenti_como['pasos']) as $lumenti_i) : ?><span class="lm-emp-steps__number<?= $lumenti_i === 0 ? ' is-active' : '' ?>" data-lm-step-num><?= esc_html(sprintf('%02d', $lumenti_i + 1)) ?></span><?php endforeach; ?></div>
        </div>
    </div>
</section>
