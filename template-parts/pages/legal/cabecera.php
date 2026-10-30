<?php
defined('ABSPATH') || exit;

/*
 * Legal · cabecera (specs/legal.md → cabecera, grupo ACF legal_cabecera). Breadcrumb, h1 con el título de la página
 * de WordPress y la fecha de actualización. $args['documento'] = privacidad | terminos (lo elige la plantilla).
 * Fechas fijas de cada documento (data/legal-*.json) hasta el paso ACF; la misma se repite al pie del documento.
 */

$lumenti_actualizado = [
    'privacidad' => '01 de junio de 2026',
    'terminos' => '21 de febrero de 2026',
];
$lumenti_titulos = [
    'privacidad' => __('Política de privacidad', 'lumenti'),
    'terminos' => __('Términos y condiciones', 'lumenti'),
];

$lumenti_clave = isset($lumenti_actualizado[$args['documento'] ?? '']) ? $args['documento'] : 'privacidad';
$lumenti_titulo = get_the_title() ?: $lumenti_titulos[$lumenti_clave];
$lumenti_fecha = $lumenti_actualizado[$lumenti_clave];
?>
<section class="lm-legal-head" aria-labelledby="lm-legal-title">
    <?php get_template_part('template-parts/components/breadcrumb', null, ['items' => [['texto' => $lumenti_titulo]]]); ?>
    <div class="lm-legal-head__inner">
        <h1 class="lm-legal-head__title uppercase" id="lm-legal-title"><span class="lm-legal-head__title-line"><?= esc_html($lumenti_titulo) ?></span></h1>
        <?php if ($lumenti_fecha !== '') : ?>
            <p class="lm-legal-head__updated"><?= esc_html__('Última actualización:', 'lumenti') ?> <?= esc_html($lumenti_fecha) ?></p>
        <?php endif; ?>
    </div>
</section>
