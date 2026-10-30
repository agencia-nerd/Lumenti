<?php
defined('ABSPATH') || exit;

/*
 * Inicio · evaluaciones (specs/home.md → evaluaciones, grupo ACF home_evaluaciones). Franja dentro de la sección
 * diario (la incluye diario.php). La capa es un degradado decorativo, no un modal. Botón a WhatsApp de paciente.
 * Datos fijos del diseño hasta el paso ACF.
 */

$lumenti_evaluaciones = [
    'titulo' => 'EVALUACIONES PSICOLÓGICAS CON RESPALDO PROFESIONAL',
    'texto' => 'Procesos especializados para conocer aspectos emocionales, cognitivos, conductuales o vocacionales, mediante una valoración profesional e instrumentos psicológicos seleccionados según cada caso.',
    'boton_texto' => 'Quiero mi evaluación',
    'boton_mensaje' => 'Hola, quisiera información sobre una evaluación psicológica.',
    'imagen' => ['ruta' => 'assets/img/psico-evaluacion.webp', 'ancho' => 1920, 'alto' => 1280, 'alt' => 'Psicólogo conversando con una paciente durante una evaluación'],
];
?>
<div class="lm-home-diario__evaluaciones">
    <?= lumenti_theme_image($lumenti_evaluaciones['imagen'], ['class' => 'lm-home-diario__evaluaciones-img', 'size' => 'large']) ?>
    <span class="lm-home-diario__evaluaciones-overlay" aria-hidden="true"></span>
    <div class="lm-home-diario__evaluaciones-inner">
        <div class="lm-home-diario__evaluaciones-content" data-lm-reveal="up">
            <h3 class="lm-home-diario__evaluaciones-title"><?= esc_html($lumenti_evaluaciones['titulo']) ?></h3>
            <?php if ($lumenti_evaluaciones['texto'] !== '') : ?>
                <p class="lm-home-diario__evaluaciones-text"><?= esc_html($lumenti_evaluaciones['texto']) ?></p>
            <?php endif; ?>
            <?php get_template_part('template-parts/components/boton', null, [
                'texto' => $lumenti_evaluaciones['boton_texto'],
                'whatsapp' => 'paciente',
                'mensaje' => $lumenti_evaluaciones['boton_mensaje'],
                'icono' => 'flecha',
                'clase' => 'lm-home-diario__evaluaciones-cta',
            ]); ?>
        </div>
    </div>
</div>
