<?php
defined('ABSPATH') || exit;

/*
 * Inicio · cifras (specs/home.md → cifras, grupo ACF home_cifras). Conteo animado: src/js/modules/home.js (countUp,
 * gancho data-lm-count con el mismo valor). Sin JS se ve el valor final. Contenido: get_field('home_cifras').
 */

$lumenti_grupo = get_field('home_cifras') ?: [];
$lumenti_cifras = array_values((array) ($lumenti_grupo['items'] ?? []));
if (!$lumenti_cifras) {
    return;
}
?>
<section class="lm-home-cifras" aria-label="<?= esc_attr__('Lumenti en cifras', 'lumenti') ?>" data-lm-section="metricas">
    <div class="lm-home-cifras__list">
        <?php foreach ($lumenti_cifras as $lumenti_i => $lumenti_cifra) :
            $lumenti_valor = (string) ($lumenti_cifra['valor'] ?? '');
            $lumenti_etiqueta = (string) ($lumenti_cifra['etiqueta'] ?? '');
            $lumenti_nota = (string) ($lumenti_cifra['nota'] ?? '');
        ?>
            <?php if ($lumenti_i > 0) : ?>
                <span class="lm-home-cifras__divider" aria-hidden="true"></span>
            <?php endif; ?>
            <div class="lm-home-cifras__item" data-lm-reveal="up">
                <?php if ($lumenti_valor !== '') : ?>
                    <span class="lm-home-cifras__value" data-lm-count="<?= esc_attr($lumenti_valor) ?>"><?= esc_html($lumenti_valor) ?></span>
                <?php endif; ?>
                <?php if ($lumenti_etiqueta !== '') : ?>
                    <span class="lm-home-cifras__label"><?= esc_html($lumenti_etiqueta) ?></span>
                <?php endif; ?>
                <?php if ($lumenti_nota !== '') : ?>
                    <span class="lm-home-cifras__note"><?= esc_html($lumenti_nota) ?></span>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</section>
