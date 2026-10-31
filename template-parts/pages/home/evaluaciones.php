<?php
defined('ABSPATH') || exit;

/*
 * Inicio · evaluaciones (specs/home.md → evaluaciones, grupo ACF home_evaluaciones). Franja dentro de la sección
 * diario (la incluye diario.php). La capa es un degradado decorativo, no un modal. Botón a WhatsApp de paciente.
 * Contenido: get_field('home_evaluaciones').
 */

$lumenti_evaluaciones = get_field('home_evaluaciones') ?: [];
$lumenti_titulo = (string) ($lumenti_evaluaciones['titulo'] ?? '');
$lumenti_texto = (string) ($lumenti_evaluaciones['texto'] ?? '');
$lumenti_boton_texto = (string) ($lumenti_evaluaciones['boton_texto'] ?? '');
if ($lumenti_titulo === '' && $lumenti_texto === '' && $lumenti_boton_texto === '') {
    return;
}
?>
<div class="lm-home-diario__evaluaciones">
    <?= lumenti_image($lumenti_evaluaciones['imagen'] ?? null, ['class' => 'lm-home-diario__evaluaciones-img', 'size' => 'large', 'alt_fallback' => $lumenti_titulo]) ?>
    <span class="lm-home-diario__evaluaciones-overlay" aria-hidden="true"></span>
    <div class="lm-home-diario__evaluaciones-inner">
        <div class="lm-home-diario__evaluaciones-content" data-lm-reveal="up">
            <?php if ($lumenti_titulo !== '') : ?>
                <h3 class="lm-home-diario__evaluaciones-title"><?= esc_html($lumenti_titulo) ?></h3>
            <?php endif; ?>
            <?php if ($lumenti_texto !== '') : ?>
                <p class="lm-home-diario__evaluaciones-text"><?= esc_html($lumenti_texto) ?></p>
            <?php endif; ?>
            <?php if ($lumenti_boton_texto !== '') : ?>
                <?php get_template_part('template-parts/components/boton', null, [
                    'texto' => $lumenti_boton_texto,
                    'whatsapp' => 'paciente',
                    'mensaje' => (string) ($lumenti_evaluaciones['boton_mensaje'] ?? ''),
                    'icono' => 'flecha',
                    'clase' => 'lm-home-diario__evaluaciones-cta',
                ]); ?>
            <?php endif; ?>
        </div>
    </div>
</div>
