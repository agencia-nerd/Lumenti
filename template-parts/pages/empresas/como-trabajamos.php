<?php
defined('ABSPATH') || exit;

/*
 * Empresas → como-trabajamos (specs/empresas.md). Grupo ACF: Empresas → empresas_como_trabajamos.
 * data-lm-steps: empresas.js (empresasSteps) cambia el paso activo y su número según el scroll; bajo 768 px
 * se ven los 4. El número sale de la posición (01, 02…).
 */

$lumenti_como = get_field('empresas_como_trabajamos') ?: [];
$lumenti_pasos = array_values((array) ($lumenti_como['pasos'] ?? []));
$lumenti_bajada = (string) ($lumenti_como['bajada'] ?? '');
$lumenti_cierre = (string) ($lumenti_como['cierre'] ?? '');
$lumenti_enlace = (string) ($lumenti_como['enlace_texto'] ?? '');

if (!$lumenti_pasos) {
    return;
}
?>
<section class="lm-emp-steps" aria-labelledby="lm-emp-how" data-lm-steps>
    <div class="lm-emp-steps__sticky">
        <span class="lm-emp-steps__ring lm-emp-steps__ring--outer" aria-hidden="true"></span><span class="lm-emp-steps__ring lm-emp-steps__ring--inner" aria-hidden="true"></span>
        <div class="lm-emp-steps__header">
            <h2 class="lm-emp-steps__title" id="lm-emp-how"><?= lumenti_highlight((string) ($lumenti_como['titulo'] ?? '')) ?></h2>
            <?php if ($lumenti_bajada !== '') : ?>
                <p class="lm-emp-steps__lead"><?= lumenti_highlight($lumenti_bajada) ?></p>
            <?php endif; ?>
        </div>
        <div class="lm-emp-steps__body">
            <div>
                <ol class="lm-emp-steps__list">
                    <?php foreach ($lumenti_pasos as $lumenti_i => $lumenti_paso) : $lumenti_num = sprintf('%02d', $lumenti_i + 1); ?>
                        <li class="lm-emp-steps__item<?= $lumenti_i === 0 ? ' is-active' : '' ?>" data-lm-step><h3 class="lm-emp-steps__step-title"><span class="lm-visually-hidden"><?= esc_html(sprintf(__('Paso %s: ', 'lumenti'), $lumenti_num)) ?></span><?= esc_html((string) ($lumenti_paso['titulo'] ?? '')) ?></h3><p class="lm-emp-steps__step-text"><?= lumenti_highlight((string) ($lumenti_paso['texto'] ?? '')) ?></p></li>
                    <?php endforeach; ?>
                </ol>
                <p class="lm-emp-steps__close"><?php if ($lumenti_cierre !== '') : ?><?= esc_html($lumenti_cierre) ?> <?php endif; ?><?php get_template_part('template-parts/components/enlace-flecha', null, [
                    'texto' => $lumenti_enlace,
                    'url' => '#propuesta',
                    'atributos' => ['data-lm-goto' => 'formulario'],
                ]); ?></p>
            </div>
            <div class="lm-emp-steps__numbers" aria-hidden="true"><?php foreach (array_keys($lumenti_pasos) as $lumenti_i) : ?><span class="lm-emp-steps__number<?= $lumenti_i === 0 ? ' is-active' : '' ?>" data-lm-step-num><?= esc_html(sprintf('%02d', $lumenti_i + 1)) ?></span><?php endforeach; ?></div>
        </div>
    </div>
</section>
