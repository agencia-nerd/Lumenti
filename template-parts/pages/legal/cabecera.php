<?php
defined('ABSPATH') || exit;

/*
 * Legal · cabecera (specs/politica-de-privacidad.md → cabecera). Grupo ACF: politica_de_privacidad_cabecera (cada página guarda el suyo).
 * Breadcrumb, h1 con el título de la página de WordPress y la fecha de actualización (se repite al pie del documento).
 */

$lumenti_cabecera = get_field('politica_de_privacidad_cabecera') ?: [];
$lumenti_fecha = (string) ($lumenti_cabecera['actualizado'] ?? '');
$lumenti_titulo = get_the_title();
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
