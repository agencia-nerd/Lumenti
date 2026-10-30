<?php
defined('ABSPATH') || exit;

/*
 * Inicio · hero (specs/home.md → hero, grupo ACF home_hero). Slider con pestañas: src/js/modules/home.js (heroSlider,
 * ganchos data-lm-hero-*). Solo el primer slide lleva h1; los demás h2. Contenido: get_field('home_hero').
 */

$lumenti_hero = get_field('home_hero') ?: [];
$lumenti_slides = array_values((array) ($lumenti_hero['slides'] ?? []));
$lumenti_sello = [
    (string) ($lumenti_hero['sello_palabra_1'] ?? ''),
    (string) ($lumenti_hero['sello_palabra_2'] ?? ''),
    (string) ($lumenti_hero['sello_palabra_3'] ?? ''),
];
// Posición de cada palabra sobre el círculo del sello (diseño).
$lumenti_sello_offsets = ['61.78', '185.35', '308.92'];
?>
<section class="lm-home-hero" aria-roledescription="carrusel" aria-label="<?= esc_attr__('Destacados', 'lumenti') ?>" data-lm-hero data-lm-section="hero">
    <?php foreach ($lumenti_slides as $lumenti_i => $lumenti_slide) : ?>
        <span aria-hidden="true" class="lm-home-hero__number <?= $lumenti_i === 0 ? 'is-active' : 'is-hidden' ?>" data-lm-hero-num="<?= (int) $lumenti_i ?>"><?= esc_html(sprintf('%02d', $lumenti_i + 1)) ?></span>
    <?php endforeach; ?>
    <div class="lm-home-hero__content">
        <?php foreach ($lumenti_slides as $lumenti_i => $lumenti_slide) :
            $lumenti_tag = $lumenti_i === 0 ? 'h1' : 'h2';
            $lumenti_lineas = [
                [$lumenti_slide['titulo_linea_1'] ?? '', ''],
                [$lumenti_slide['titulo_linea_2'] ?? '', ' lm-home-hero__title-line--middle'],
                [$lumenti_slide['titulo_linea_3'] ?? '', ' lm-home-hero__title-line--accent'],
            ];
            $lumenti_bajada = (string) ($lumenti_slide['bajada'] ?? '');
            $lumenti_boton_texto = (string) ($lumenti_slide['boton_texto'] ?? '');
        ?>
            <div class="lm-home-hero__slide <?= $lumenti_i === 0 ? 'is-active' : 'is-hidden' ?>" id="lm-hero-slide-<?= (int) $lumenti_i ?>" role="tabpanel" aria-labelledby="lm-hero-tab-<?= (int) $lumenti_i ?>" aria-hidden="<?= $lumenti_i === 0 ? 'false' : 'true' ?>" data-lm-hero-text="<?= (int) $lumenti_i ?>">
                <<?= $lumenti_tag ?> class="lm-home-hero__title">
                    <?php foreach ($lumenti_lineas as [$lumenti_texto, $lumenti_mod]) : if ((string) $lumenti_texto === '') { continue; } ?>
                        <span class="lm-home-hero__title-mask"><span class="lm-home-hero__title-line<?= esc_attr($lumenti_mod) ?>"><?= esc_html($lumenti_texto) ?></span></span>
                    <?php endforeach; ?>
                </<?= $lumenti_tag ?>>
                <?php if ($lumenti_bajada !== '') : ?>
                    <div class="lm-home-hero__lead-mask"><p class="lm-home-hero__lead"><?= esc_html($lumenti_bajada) ?></p></div>
                <?php endif; ?>
                <?php if ($lumenti_boton_texto !== '') : ?>
                    <div class="lm-home-hero__actions">
                        <?php get_template_part('template-parts/components/boton', null, [
                            'texto' => $lumenti_boton_texto,
                            'whatsapp' => 'paciente',
                            'mensaje' => (string) ($lumenti_slide['boton_mensaje'] ?? ''),
                            'icono' => 'flecha',
                            'clase' => 'lm-home-hero__cta',
                            'atributos' => ['data-lm-hero-pause' => ''],
                        ]); ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="lm-home-hero__media">
        <div class="lm-home-hero__media-stack">
            <?php foreach ($lumenti_slides as $lumenti_i => $lumenti_slide) : ?>
                <div class="lm-home-hero__media-item <?= $lumenti_i === 0 ? 'is-active' : 'is-hidden' ?>" data-lm-hero-img="<?= (int) $lumenti_i ?>">
                    <?= lumenti_image($lumenti_slide['imagen'] ?? null, [
                        'class' => 'lm-home-hero__img',
                        'loading' => 'eager',
                        'fetchpriority' => $lumenti_i === 0 ? 'high' : '',
                        'size' => 'large',
                    ]) ?>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="lm-home-hero__badge" aria-hidden="true">
            <div class="lm-home-hero__badge-ring"><svg class="lm-home-hero__badge-text" viewBox="0 0 160 160" width="100%" height="100%"><defs><path id="lmRing" d="M80,80 m-59,0 a59,59 0 1,1 118,0 a59,59 0 1,1 -118,0"></path></defs><text fill="#826d4b" font-family="'Abenda', serif" font-size="14" letter-spacing="0.3"><?php foreach ($lumenti_sello as $lumenti_i => $lumenti_palabra) : if ($lumenti_palabra === '') { continue; } ?><textPath href="#lmRing" startOffset="<?= esc_attr($lumenti_sello_offsets[$lumenti_i]) ?>"><?= esc_html($lumenti_palabra) ?></textPath><?php endforeach; ?></text></svg></div>
            <?= lumenti_theme_image('assets/img/badge-icon.svg', ['class' => 'lm-home-hero__badge-logo', 'alt' => '', 'width' => 64, 'height' => 75, 'loading' => 'eager']) ?>
        </div>
    </div>
    <div class="lm-home-hero__tabs" role="tablist" aria-label="<?= esc_attr__('Áreas', 'lumenti') ?>">
        <?php foreach ($lumenti_slides as $lumenti_i => $lumenti_slide) : ?>
            <button class="lm-home-hero__tab" type="button" role="tab" id="lm-hero-tab-<?= (int) $lumenti_i ?>" aria-selected="<?= $lumenti_i === 0 ? 'true' : 'false' ?>" aria-controls="lm-hero-slide-<?= (int) $lumenti_i ?>" tabindex="<?= $lumenti_i === 0 ? '0' : '-1' ?>" data-lm-hero-tab="<?= (int) $lumenti_i ?>">
                <span><?= esc_html(sprintf('%02d. %s', $lumenti_i + 1, (string) ($lumenti_slide['pestana'] ?? ''))) ?></span>
                <span class="lm-home-hero__tab-track"><span class="lm-home-hero__tab-fill" data-lm-hero-fill></span></span>
            </button>
        <?php endforeach; ?>
    </div>
</section>
