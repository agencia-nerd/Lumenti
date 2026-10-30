<?php
defined('ABSPATH') || exit;

/*
 * Inicio · servicios (specs/home.md → servicios, grupo ACF home_servicios). 4 cards enlazadas; la descripción se
 * despliega con hover o foco (CSS). Títulos h2 (en el diseño h3 sin h2 previo). `sin_degradado` quita la capa oscura.
 * Cuerpo y descripción van en <div> (en el diseño <span> con <h3>/<p> dentro: HTML inválido; ya son bloques por CSS).
 * Datos fijos del diseño hasta el paso ACF.
 */

$lumenti_servicios = [
    [
        'titulo' => 'PSIQUIATRÍA',
        'descripcion' => 'Evaluación, diagnóstico y tratamiento integral.',
        'enlace' => home_url('/psiquiatria/'),
        'imagen' => ['ruta' => 'assets/img/servicio-psiquiatria.webp', 'ancho' => 1920, 'alto' => 1280],
        'encuadre' => '',
        'sin_degradado' => false,
    ],
    [
        'titulo' => 'PSICOLOGÍA',
        'descripcion' => 'Psicoterapia y evaluaciones psicológicas basadas en evidencia.',
        'enlace' => home_url('/psicologia/'),
        'imagen' => ['ruta' => 'assets/img/servicio-psicologia.webp', 'ancho' => 1920, 'alto' => 1280],
        'encuadre' => 'lm-home-servicios__img--alt',
        'sin_degradado' => false,
    ],
    [
        'titulo' => 'INFORMES Y CERTIFICADOS',
        'descripcion' => 'Documentos clínicos elaborados previa evaluación profesional.',
        'enlace' => home_url('/informes/'),
        'imagen' => ['ruta' => 'assets/img/servicio-informes.webp', 'ancho' => 960, 'alto' => 580],
        'encuadre' => '',
        'sin_degradado' => true,
    ],
    [
        'titulo' => 'EMPRESAS',
        'descripcion' => 'Talleres y programas de salud mental para organizaciones',
        'enlace' => home_url('/empresas/'),
        'imagen' => ['ruta' => 'assets/img/servicio-empresas.webp', 'ancho' => 960, 'alto' => 580],
        'encuadre' => '',
        'sin_degradado' => true,
    ],
];
$lumenti_icono = '<svg class="lm-home-servicios__icon" width="20" height="20" viewBox="0 0 256 256" fill="currentColor"><path d="M200,64V168a8,8,0,0,1-16,0V83.31L69.66,197.66a8,8,0,0,1-11.32-11.32L172.69,72H88a8,8,0,0,1,0-16H192A8,8,0,0,1,200,64Z"/></svg>';
?>
<section class="lm-home-servicios" aria-label="<?= esc_attr__('Servicios', 'lumenti') ?>" data-lm-section="servicios">
    <?php foreach ($lumenti_servicios as $lumenti_s) :
        $lumenti_clase_img = trim('lm-home-servicios__img ' . $lumenti_s['encuadre'] . ($lumenti_s['sin_degradado'] ? ' lm-home-servicios__img--wide' : ''));
    ?>
        <a class="lm-home-servicios__card" href="<?= esc_url($lumenti_s['enlace']) ?>">
            <?= lumenti_theme_image($lumenti_s['imagen'], ['class' => $lumenti_clase_img, 'alt' => '', 'size' => 'large']) ?>
            <?php if (!$lumenti_s['sin_degradado']) : ?>
                <span class="lm-home-servicios__overlay" aria-hidden="true"></span>
            <?php endif; ?>
            <span class="lm-home-servicios__icon-tile" aria-hidden="true"><?= $lumenti_icono // SVG fijo del tema. ?></span>
            <div class="lm-home-servicios__body">
                <h2 class="lm-home-servicios__title"><?= esc_html($lumenti_s['titulo']) ?></h2>
                <?php if ($lumenti_s['descripcion'] !== '') : ?>
                    <div class="lm-home-servicios__desc-wrap"><p class="lm-home-servicios__desc"><?= esc_html($lumenti_s['descripcion']) ?></p></div>
                <?php endif; ?>
            </div>
        </a>
    <?php endforeach; ?>
</section>
