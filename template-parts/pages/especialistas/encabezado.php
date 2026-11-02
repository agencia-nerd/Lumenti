<?php
defined('ABSPATH') || exit;

/*
 * Especialistas · encabezado (specs/especialistas.md → encabezado). Grupo ACF: especialistas_encabezado.
 * Contenido: get_field('especialistas_encabezado', 'option') (página de opciones Archivo de especialista).
 * Breadcrumb y encabezado propio (no es page-hero): título en líneas con máscara animada; la parte entre
 * *asteriscos* va en verde con lumenti_highlight.
 */

$lumenti_encabezado = get_field('especialistas_encabezado', 'option') ?: [];
$lumenti_etiqueta = (string) ($lumenti_encabezado['etiqueta'] ?? '');
$lumenti_bajada = (string) ($lumenti_encabezado['bajada'] ?? '');
// titulo es un textarea: una línea animada por renglón (Enter en el admin).
$lumenti_lineas = array_values(array_filter(array_map('trim', preg_split('/\R/', (string) ($lumenti_encabezado['titulo'] ?? '')))));

get_template_part('template-parts/components/breadcrumb', null, [
    'items' => [['texto' => post_type_archive_title('', false)]],
]);
?>
<header class="lm-specialists__header">
    <?php if ($lumenti_etiqueta !== '') : ?>
        <p class="lm-eyebrow lm-eyebrow--dot lm-specialists__eyebrow"><span class="lm-specialists__rise"><?= esc_html($lumenti_etiqueta) ?></span></p>
    <?php endif; ?>
    <h1 class="lm-specialists__title">
        <?php foreach ($lumenti_lineas as $lumenti_i => $lumenti_linea) : ?>
            <span class="lm-specialists__title-mask"><span class="lm-specialists__title-line<?= $lumenti_i > 0 ? ' lm-specialists__title-line--late' : '' ?>"><?= lumenti_highlight($lumenti_linea) ?></span></span>
        <?php endforeach; ?>
    </h1>
    <?php if ($lumenti_bajada !== '') : ?>
        <p class="lm-lead lm-specialists__lead"><span class="lm-specialists__rise lm-specialists__rise--late"><?= lumenti_highlight($lumenti_bajada) ?></span></p>
    <?php endif; ?>
</header>
