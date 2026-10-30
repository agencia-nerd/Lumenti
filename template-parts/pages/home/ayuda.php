<?php
defined('ABSPATH') || exit;

/*
 * Inicio · ayuda (specs/home.md → ayuda, grupo ACF home_ayuda). id="que-tratamos" es el ancla del menú.
 * En móvil muestra 6 y "Ver más" despliega el resto: src/js/modules/ver-mas.js (data-lm-more / data-lm-more-btn);
 * los ítems desde el 7.º llevan --extra. Textos: get_field('home_ayuda'). Cards de muestra en inc/muestras/home-ayuda.php
 * hasta conectar Condición.
 */

$lumenti_ayuda = get_field('home_ayuda') ?: [];
$lumenti_titulo = (string) ($lumenti_ayuda['titulo'] ?? '');
$lumenti_bajada = (string) ($lumenti_ayuda['bajada'] ?? '');
$lumenti_visibles = 6;
// slug de la condición => nombre de la card.
$lumenti_condiciones = require get_theme_file_path('inc/muestras/home-ayuda.php');
$lumenti_flecha = '<svg class="lm-home-ayuda__card-arrow" aria-hidden="true" width="18" height="18" viewBox="0 0 256 256" fill="currentColor"><path d="M221.66,133.66l-72,72a8,8,0,0,1-11.32-11.32L196.69,136H40a8,8,0,0,1,0-16H196.69L138.34,61.66a8,8,0,0,1,11.32-11.32l72,72A8,8,0,0,1,221.66,133.66Z"/></svg>';
$lumenti_hay_extra = count($lumenti_condiciones) > $lumenti_visibles;
?>
<section class="lm-home-ayuda" id="que-tratamos"<?php if ($lumenti_titulo !== '') : ?> aria-labelledby="lm-ayuda"<?php endif; ?> data-lm-section="como-podemos-ayudarte">
    <?php if ($lumenti_titulo !== '' || $lumenti_bajada !== '') : ?>
        <div class="lm-home-ayuda__header" data-lm-reveal="up">
            <?php if ($lumenti_titulo !== '') : ?>
                <h2 class="lm-h2 lm-home-ayuda__title" id="lm-ayuda"><?= esc_html($lumenti_titulo) ?></h2>
            <?php endif; ?>
            <?php if ($lumenti_bajada !== '') : ?>
                <p class="lm-home-ayuda__lead"><?= esc_html($lumenti_bajada) ?></p>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    <ul class="lm-home-ayuda__grid" id="lm-more-help" data-lm-more="<?= (int) $lumenti_visibles ?>">
        <?php $lumenti_n = 0; foreach ($lumenti_condiciones as $lumenti_slug => $lumenti_nombre) : ?>
            <li class="lm-home-ayuda__item<?= $lumenti_n++ >= $lumenti_visibles ? ' lm-home-ayuda__item--extra' : '' ?>" data-lm-reveal="up" data-lm-reveal-group>
                <a class="lm-home-ayuda__card" href="<?= esc_url(home_url('/condicion/' . $lumenti_slug . '/')) ?>">
                    <span class="lm-home-ayuda__card-fill" aria-hidden="true"></span>
                    <span class="lm-home-ayuda__card-body">
                        <span class="lm-home-ayuda__card-title"><?= esc_html($lumenti_nombre) ?></span>
                        <span class="lm-home-ayuda__card-more"><span class="lm-home-ayuda__card-more-label"><?= esc_html__('Saber más', 'lumenti') ?><?= $lumenti_flecha // SVG fijo del tema. ?></span></span>
                    </span>
                    <span class="lm-home-ayuda__card-icon" aria-hidden="true"></span>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
    <?php if ($lumenti_hay_extra) : ?>
        <div class="lm-home-ayuda__more">
            <button class="lm-btn lm-btn--secondary lm-home-ayuda__more-btn" type="button" aria-controls="lm-more-help" aria-expanded="false" data-lm-more-btn data-lm-more-less="<?= esc_attr__('Ver menos', 'lumenti') ?>"><?= esc_html__('Ver más', 'lumenti') ?><svg class="lm-btn__arrow" aria-hidden="true" width="18" height="18" viewBox="0 0 256 256" fill="currentColor"><path class="lm-home-ayuda__icon-minus" d="M213.66,101.66l-80,80a8,8,0,0,1-11.32,0l-80-80A8,8,0,0,1,53.66,90.34L128,164.69l74.34-74.35a8,8,0,0,1,11.32,11.32Z"/></svg></button>
        </div>
    <?php endif; ?>
</section>
