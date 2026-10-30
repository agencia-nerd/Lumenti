<?php
defined('ABSPATH') || exit;

/*
 * Hero de página interna (.lm-page-hero). Diseño: css/components.css §12 (servicio-psiquiatria.html, condicion.html).
 * Lleva el h1 de la página y el fondo decorativo de 5 capas SVG (archivos fijos del tema, assets/img/psiq-bg-1…5.svg).
 *
 * $args:
 *   titulo            (string, sí)  una línea del h1 por renglón ("\n"). Una línea entera entre asteriscos
 *                                   ('*SALUD MENTAL*') va en verde; si ninguna lo está y no hay titulo_destacado, la primera.
 *   titulo_destacado  (string)  primera línea, en verde (Psiquiatría, Psicología, Informes); `titulo` son las siguientes.
 *   nota              (string)  texto corto a la derecha del título.
 *   etiqueta          (string)  eyebrow con punto debajo.
 *   bajada            (string)  párrafo grande debajo.
 *   acciones          (array)   [['tipo' => 'boton', …args de boton], ['tipo' => 'enlace', …args de enlace-flecha]].
 *   acciones_clase    (string)  clase del contenedor de acciones. Por defecto lm-emp-hero__actions (Empresas).
 *   breadcrumb        (array | false)  ítems del componente breadcrumb (sin "Inicio": lo agrega él) o sus $args con 'items'.
 *   variante          ('' | service)  service = Psiquiatría, Psicología, Informes, FAQ, Empresas; '' = Condición.
 *   id                (string)  id del h1. Por defecto lm-page-title.
 *   ajustar           (bool)  data-lm-fit-title: el JS achica el título si una línea no cabe (Condición).
 */

$lumenti_titulo = trim((string) ($args['titulo'] ?? ''));
$lumenti_destacado = trim((string) ($args['titulo_destacado'] ?? ''));
if ($lumenti_titulo === '' && $lumenti_destacado === '') {
    return;
}

// Líneas del h1: [texto, en verde].
$lumenti_lineas = [];
if ($lumenti_destacado !== '') {
    $lumenti_lineas[] = [$lumenti_destacado, true];
}
foreach (preg_split('/\R/', $lumenti_titulo) as $lumenti_linea) {
    $lumenti_linea = trim($lumenti_linea);
    if ($lumenti_linea === '') {
        continue;
    }
    $lumenti_acento = (bool) preg_match('/^\*(.+)\*$/u', $lumenti_linea, $lumenti_m);
    $lumenti_lineas[] = [$lumenti_acento ? trim($lumenti_m[1]) : $lumenti_linea, $lumenti_acento];
}
if ($lumenti_lineas && !in_array(true, array_column($lumenti_lineas, 1), true)) {
    $lumenti_lineas[0][1] = true;
}

$lumenti_nota = (string) ($args['nota'] ?? '');
$lumenti_etiqueta = (string) ($args['etiqueta'] ?? '');
$lumenti_bajada = (string) ($args['bajada'] ?? '');
$lumenti_acciones = array_filter((array) ($args['acciones'] ?? []), 'is_array');
$lumenti_id = (string) ($args['id'] ?? 'lm-page-title');
$lumenti_variante = ($args['variante'] ?? '') === 'service' ? ' lm-page-hero--service' : '';

$lumenti_breadcrumb = $args['breadcrumb'] ?? false;
if ($lumenti_breadcrumb && !isset($lumenti_breadcrumb['items'])) {
    $lumenti_breadcrumb = ['items' => $lumenti_breadcrumb];
}
?>
<section class="lm-page-hero<?= esc_attr($lumenti_variante) ?>" aria-labelledby="<?= esc_attr($lumenti_id) ?>">
    <div class="lm-page-hero__bg" aria-hidden="true"><?php for ($lumenti_n = 1; $lumenti_n <= 5; $lumenti_n++) : ?><span class="lm-page-hero__bg-layer"><?= lumenti_theme_image('assets/img/psiq-bg-' . $lumenti_n . '.svg', ['class' => 'lm-page-hero__bg-img', 'alt' => '', 'width' => 1440, 'height' => 900, 'loading' => 'eager']) ?></span><?php endfor; ?></div>
    <?php if ($lumenti_breadcrumb) {
        get_template_part('template-parts/components/breadcrumb', null, $lumenti_breadcrumb);
    } ?>
    <div class="lm-page-hero__top">
        <h1 class="lm-page-hero__title" id="<?= esc_attr($lumenti_id) ?>"<?= !empty($args['ajustar']) ? ' data-lm-fit-title' : '' ?>>
            <?php foreach ($lumenti_lineas as [$lumenti_texto, $lumenti_verde]) : ?>
                <span class="lm-page-hero__title-mask"><span class="lm-page-hero__title-line<?= $lumenti_verde ? ' lm-page-hero__title-line--accent' : '' ?>"><?= esc_html($lumenti_texto) ?></span></span>
            <?php endforeach; ?>
        </h1>
        <?php if ($lumenti_nota !== '') : ?>
            <p class="lm-page-hero__note"><span class="lm-page-hero__note-text"><?= esc_html($lumenti_nota) ?></span></p>
        <?php endif; ?>
    </div>
    <?php if ($lumenti_etiqueta !== '' || $lumenti_bajada !== '' || $lumenti_acciones) : ?>
        <div class="lm-page-hero__intro">
            <?php if ($lumenti_etiqueta !== '') : ?>
                <p class="lm-eyebrow lm-eyebrow--dot lm-page-hero__eyebrow"><?= esc_html($lumenti_etiqueta) ?></p>
            <?php endif; ?>
            <?php if ($lumenti_bajada !== '') : ?>
                <p class="lm-page-hero__lead"><span class="lm-page-hero__lead-text"><?= esc_html($lumenti_bajada) ?></span></p>
            <?php endif; ?>
            <?php if ($lumenti_acciones) : ?>
                <div class="<?= esc_attr((string) ($args['acciones_clase'] ?? 'lm-emp-hero__actions')) ?>">
                    <?php foreach ($lumenti_acciones as $lumenti_accion) {
                        $lumenti_parte = ($lumenti_accion['tipo'] ?? 'boton') === 'enlace' ? 'enlace-flecha' : 'boton';
                        get_template_part('template-parts/components/' . $lumenti_parte, null, $lumenti_accion);
                    } ?>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</section>
