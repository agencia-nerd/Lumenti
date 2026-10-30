<?php
defined('ABSPATH') || exit;

/*
 * Inicio · cifras (specs/home.md → cifras, grupo ACF home_cifras). Conteo animado: src/js/modules/home.js (countUp,
 * gancho data-lm-count con el mismo valor). Sin JS se ve el valor final. Datos fijos del diseño hasta el paso ACF.
 */

$lumenti_cifras = [
    ['valor' => '+3,000', 'etiqueta' => 'Pacientes atendidos', 'nota' => 'En atención presencial y online'],
    ['valor' => '13', 'etiqueta' => 'Especialistas', 'nota' => 'Psiquiatras y psicólogos'],
    ['valor' => '3', 'etiqueta' => 'Idiomas de atención', 'nota' => 'Atención presencial y virtual para cada etapa de la vida.'],
];
?>
<section class="lm-home-cifras" aria-label="<?= esc_attr__('Lumenti en cifras', 'lumenti') ?>" data-lm-section="metricas">
    <div class="lm-home-cifras__list">
        <?php foreach ($lumenti_cifras as $lumenti_i => $lumenti_cifra) : ?>
            <?php if ($lumenti_i > 0) : ?>
                <span class="lm-home-cifras__divider" aria-hidden="true"></span>
            <?php endif; ?>
            <div class="lm-home-cifras__item" data-lm-reveal="up">
                <span class="lm-home-cifras__value" data-lm-count="<?= esc_attr($lumenti_cifra['valor']) ?>"><?= esc_html($lumenti_cifra['valor']) ?></span>
                <span class="lm-home-cifras__label"><?= esc_html($lumenti_cifra['etiqueta']) ?></span>
                <?php if ($lumenti_cifra['nota'] !== '') : ?>
                    <span class="lm-home-cifras__note"><?= esc_html($lumenti_cifra['nota']) ?></span>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</section>
