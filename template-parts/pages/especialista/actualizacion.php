<?php
defined('ABSPATH') || exit;

/*
 * Especialista · actualizacion (specs/especialista.md → actualizacion). Sin grupo ACF: igual en todos los perfiles.
 * Banner dorado con imagen decorativa (assets/img/esp/formacion-banner.webp).
 */

$lumenti_actualizacion = [
    'titulo' => 'FORMACIÓN EN CONSTANTE ACTUALIZACIÓN',
    'texto' => 'Los especialistas actualizan su formación de forma continua. Esta sección resume los hitos más relevantes.',
];
?>
<div class="lm-profile__banner">
    <?= lumenti_theme_image('assets/img/esp/formacion-banner.webp', ['class' => 'lm-profile__banner-img', 'alt' => '', 'width' => 1145, 'height' => 577]) ?>
    <div class="lm-profile__banner-body">
        <h2 class="lm-profile__h2 lm-profile__banner-title"><?= esc_html($lumenti_actualizacion['titulo']) ?></h2>
        <p class="lm-profile__banner-text"><?= esc_html($lumenti_actualizacion['texto']) ?></p>
    </div>
</div>
