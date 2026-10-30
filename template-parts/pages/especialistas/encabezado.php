<?php
defined('ABSPATH') || exit;

/*
 * Especialistas · encabezado (specs/especialistas.md → encabezado). Grupo ACF: especialistas_encabezado.
 * Breadcrumb y encabezado propio (no es page-hero): título en líneas con máscara animada; la parte entre
 * *asteriscos* va en verde con lumenti_highlight.
 */

$lumenti_encabezado = [
    'etiqueta' => 'NUESTROS ESPECIALISTAS',
    'titulo' => 'UN GRAN EQUIPO HUMANO
PARA *CUIDAR TU BIENESTAR*',
    'bajada' => 'Conoce a los especialistas en Lumenti: médicos psiquiatras y psicólogos que trabajan de forma coordinada para acompañarte en cada etapa de la vida.',
];

$lumenti_lineas = array_values(array_filter(array_map('trim', preg_split('/\R/', $lumenti_encabezado['titulo']))));

get_template_part('template-parts/components/breadcrumb', null, [
    'items' => [['texto' => 'Especialistas']],
]);
?>
<header class="lm-specialists__header">
    <?php if ($lumenti_encabezado['etiqueta'] !== '') : ?>
        <p class="lm-eyebrow lm-eyebrow--dot lm-specialists__eyebrow"><span class="lm-specialists__rise"><?= esc_html($lumenti_encabezado['etiqueta']) ?></span></p>
    <?php endif; ?>
    <h1 class="lm-specialists__title">
        <?php foreach ($lumenti_lineas as $lumenti_i => $lumenti_linea) : ?>
            <span class="lm-specialists__title-mask"><span class="lm-specialists__title-line<?= $lumenti_i > 0 ? ' lm-specialists__title-line--late' : '' ?>"><?= lumenti_highlight($lumenti_linea) ?></span></span>
        <?php endforeach; ?>
    </h1>
    <?php if ($lumenti_encabezado['bajada'] !== '') : ?>
        <p class="lm-lead lm-specialists__lead"><span class="lm-specialists__rise lm-specialists__rise--late"><?= esc_html($lumenti_encabezado['bajada']) ?></span></p>
    <?php endif; ?>
</header>
