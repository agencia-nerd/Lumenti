<?php
defined('ABSPATH') || exit;

/*
 * Inicio · sobre (specs/home.md → sobre, grupo ACF home_sobre). La parte entre *asteriscos* va en color
 * (lumenti_highlight). Abanico: src/js/modules/home.js (fan, ganchos data-lm-fan*). Datos fijos hasta el paso ACF.
 */

$lumenti_sobre = [
    'etiqueta' => 'UN EQUIPO CON ENFOQUE INTEGRAL',
    'texto' => 'En Lumenti creemos que cada historia merece ser *escuchada y comprendida*. Por eso, te acompañamos con una atención cercana, personalizada y basada en evidencia, respetando tu proceso y avanzando contigo hacia un mayor bienestar.',
    'imagen_principal' => ['ruta' => 'assets/img/sobre-equipo.webp', 'ancho' => 960, 'alto' => 900, 'alt' => 'Especialista de Lumenti revisando una tablet en recepción'],
    'imagen_secundaria' => ['ruta' => 'assets/img/sobre-consulta.webp', 'ancho' => 600, 'alto' => 570, 'alt' => 'Especialista conversando con una paciente en consulta'],
    // opciones_cabecera_logo_alternativo (Ajustes del sitio).
    'logo' => 'assets/img/logo-white.svg',
];
$lumenti_principal = $lumenti_sobre['imagen_principal'];
$lumenti_secundaria = $lumenti_sobre['imagen_secundaria'];
?>
<section class="lm-home-sobre" data-lm-fan data-lm-section="sobre-lumenti">
    <div class="lm-home-sobre__intro" data-lm-reveal="up">
        <?php if ($lumenti_sobre['etiqueta'] !== '') : ?>
            <p class="lm-eyebrow lm-eyebrow--dot lm-home-sobre__eyebrow"><?= esc_html($lumenti_sobre['etiqueta']) ?></p>
        <?php endif; ?>
        <p class="lm-home-sobre__statement"><?= lumenti_highlight($lumenti_sobre['texto']) ?></p>
    </div>
    <div class="lm-home-sobre__fan">
        <img class="lm-home-sobre__photo" src="<?= esc_url(get_theme_file_uri($lumenti_principal['ruta'])) ?>" alt="<?= esc_attr($lumenti_principal['alt']) ?>" width="<?= (int) $lumenti_principal['ancho'] ?>" height="<?= (int) $lumenti_principal['alto'] ?>" loading="lazy" decoding="async" data-lm-fan-main>
        <img class="lm-home-sobre__photo-back" src="<?= esc_url(get_theme_file_uri($lumenti_secundaria['ruta'])) ?>" alt="<?= esc_attr($lumenti_secundaria['alt']) ?>" width="<?= (int) $lumenti_secundaria['ancho'] ?>" height="<?= (int) $lumenti_secundaria['alto'] ?>" loading="lazy" decoding="async" data-lm-fan-card="-1">
        <div class="lm-home-sobre__brand-card" data-lm-fan-card="1">
            <?= lumenti_theme_image($lumenti_sobre['logo'], ['class' => 'lm-home-sobre__brand-logo', 'alt' => 'Lumenti', 'width' => 864, 'height' => 139]) ?>
        </div>
    </div>
</section>
