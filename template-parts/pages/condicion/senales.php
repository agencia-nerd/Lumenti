<?php
defined('ABSPATH') || exit;

/*
 * Condición · senales (specs/condicion.md → senales). Grupo ACF: condicion_senales.
 * Título, intro, destacado, grupos de señales, pie y la nota dorada al final. Las señales están siempre
 * visibles (decisión del proyecto: el diseño las plegaba en acordeón solo bajo 768 px).
 * Encabezados: sin títulos de grupo, cada señal es h3; con grupos, el grupo es h3 y la señal h4.
 */

$lumenti_senales = get_field('condicion_senales') ?: [];
$lumenti_titulo = (string) ($lumenti_senales['titulo'] ?? '');
$lumenti_intro = trim((string) ($lumenti_senales['intro'] ?? ''));
$lumenti_destacado = trim((string) ($lumenti_senales['destacado'] ?? ''));
$lumenti_pie = trim((string) ($lumenti_senales['pie'] ?? ''));

$lumenti_grupos = array_values(array_filter((array) ($lumenti_senales['grupos'] ?? []), static fn($g) => !empty($g['items'])));
if ($lumenti_titulo === '' && !$lumenti_grupos) {
    return;
}
$lumenti_con_grupos = (bool) array_filter(array_column($lumenti_grupos, 'titulo'));
?>
<section class="lm-cond-signs" aria-labelledby="lm-signs-title">
    <div class="lm-cond-signs__header"><h2 class="lm-section-title" id="lm-signs-title"><?= esc_html($lumenti_titulo) ?></h2><?php if ($lumenti_intro !== '') : ?><p class="lm-lead lm-cond-signs__intro"><?= lumenti_highlight($lumenti_intro) ?></p><?php endif; ?></div>
    <?php if ($lumenti_destacado !== '') : ?>
        <p class="lm-cond-signs__highlight"><?= lumenti_highlight($lumenti_destacado) ?></p>
    <?php endif; ?>
    <?php foreach ($lumenti_grupos as $lumenti_g => $lumenti_grupo) : ?>
        <?php if (!empty($lumenti_grupo['titulo'])) : ?>
            <h3 class="lm-cond-signs__group-title"><?= esc_html($lumenti_grupo['titulo']) ?></h3>
        <?php endif; ?>
        <?php $lumenti_nivel = $lumenti_con_grupos ? 'h4' : 'h3'; ?>
        <ul class="lm-cond-signs__list">
            <?php foreach ((array) $lumenti_grupo['items'] as $lumenti_item) : ?>
                <li class="lm-cond-signs__item">
                    <span class="lm-cond-signs__dot" aria-hidden="true"></span>
                    <<?= $lumenti_nivel ?> class="lm-cond-signs__title"><?= esc_html((string) ($lumenti_item['titulo'] ?? '')) ?></<?= $lumenti_nivel ?>>
                    <p class="lm-cond-signs__text"><?= lumenti_highlight((string) ($lumenti_item['texto'] ?? '')) ?></p>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endforeach; ?>
    <?php if ($lumenti_pie !== '') : ?>
        <p class="lm-cond-signs__foot"><?= lumenti_highlight($lumenti_pie) ?></p>
    <?php endif; ?>
    <?php get_template_part('template-parts/pages/condicion/nota'); ?>
</section>
