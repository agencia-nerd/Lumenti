<?php
defined('ABSPATH') || exit;

/*
 * Inicio · sobre (specs/home.md → sobre, grupo ACF home_sobre). La parte entre *asteriscos* va en color
 * (lumenti_highlight). Abanico: src/js/modules/home.js (fan, ganchos data-lm-fan*). Contenido: get_field('home_sobre');
 * el logo blanco de la card es opciones_cabecera_logo_alternativo (Ajustes del sitio).
 */

$lumenti_sobre = get_field('home_sobre') ?: [];
$lumenti_etiqueta = (string) ($lumenti_sobre['etiqueta'] ?? '');
$lumenti_texto = (string) ($lumenti_sobre['texto'] ?? '');
$lumenti_principal = lumenti_image_data($lumenti_sobre['imagen_principal'] ?? null);
$lumenti_secundaria = lumenti_image_data($lumenti_sobre['imagen_secundaria'] ?? null);
// Alt de respaldo (solo si la imagen no trae el suyo): la etiqueta de la sección y la posición de la foto.
$lumenti_alt_foto = static fn (int $n): string => $lumenti_etiqueta !== '' ? $lumenti_etiqueta . ', ' . sprintf(__('foto %d de %d', 'lumenti'), $n, 2) : '';
$lumenti_logo = (get_field('opciones_cabecera', 'option') ?: [])['logo_alternativo'] ?? null;
?>
<section class="lm-home-sobre" data-lm-fan data-lm-section="sobre-lumenti">
    <div class="lm-home-sobre__intro" data-lm-reveal="up">
        <?php if ($lumenti_etiqueta !== '') : ?>
            <p class="lm-eyebrow lm-eyebrow--dot lm-home-sobre__eyebrow"><?= esc_html($lumenti_etiqueta) ?></p>
        <?php endif; ?>
        <?php if ($lumenti_texto !== '') : ?>
            <p class="lm-home-sobre__statement"><?= lumenti_highlight($lumenti_texto) ?></p>
        <?php endif; ?>
    </div>
    <div class="lm-home-sobre__fan">
        <?php if ($lumenti_secundaria) : ?>
            <img class="lm-home-sobre__photo-back" src="<?= esc_url($lumenti_secundaria['url']) ?>" alt="<?= esc_attr($lumenti_secundaria['alt'] ?: $lumenti_alt_foto(1)) ?>"<?php if ($lumenti_secundaria['width'] && $lumenti_secundaria['height']) : ?> width="<?= (int) $lumenti_secundaria['width'] ?>" height="<?= (int) $lumenti_secundaria['height'] ?>"<?php endif; ?> loading="lazy" decoding="async" data-lm-fan-card="-1">
        <?php endif; ?>
        <?php if ($lumenti_principal) : ?>
            <img class="lm-home-sobre__photo" src="<?= esc_url($lumenti_principal['url']) ?>" alt="<?= esc_attr($lumenti_principal['alt'] ?: $lumenti_alt_foto(2)) ?>"<?php if ($lumenti_principal['width'] && $lumenti_principal['height']) : ?> width="<?= (int) $lumenti_principal['width'] ?>" height="<?= (int) $lumenti_principal['height'] ?>"<?php endif; ?> loading="lazy" decoding="async" data-lm-fan-card="1">
        <?php endif; ?>
        <div class="lm-home-sobre__brand-card" data-lm-fan-main>
            <?= lumenti_theme_image($lumenti_logo, ['class' => 'lm-home-sobre__brand-logo']) ?>
        </div>
    </div>
</section>
