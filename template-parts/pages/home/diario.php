<?php
defined('ABSPATH') || exit;

/*
 * Inicio · diario (specs/home.md → diario, grupo ACF home_diario). Sección oscura (data-lm-nav-tone="dark").
 * Hover/foco en un ítem cambia la imagen del marco: src/js/modules/home.js (daily, ganchos data-lm-daily-*); solo la
 * imagen activa tiene alt. En móvil 5 + "Ver más" (ver-mas.js; ítems extra con --extra). Incluye la parte
 * `evaluaciones` dentro de su <section>. Datos fijos del diseño hasta el paso ACF.
 */

$lumenti_diario = [
    'etiqueta' => 'ACOMPAÑAMIENTO PSICOLÓGICO',
    // Cada renglón del título es una línea (.lm-h2__line).
    'titulo' => 'PSICOLOGÍA PARA EL
DÍA A DÍA',
    'bajada' => 'No necesitas un diagnóstico para pedir apoyo. Nuestros psicólogos te acompañan en los desafíos cotidianos que afectan tu bienestar emocional.',
    'enlace' => home_url('/psicologia/'),
    'visibles' => 5,
];
$lumenti_items = [
    ['titulo' => 'Regulación emocional', 'descripcion' => 'Aprende a reconocer y manejar lo que sientes para vivir tu día con más calma.', 'imagen' => 'assets/img/psico-regulacion.webp', 'alt' => 'Mujer con los ojos cerrados y las manos en el pecho'],
    ['titulo' => 'Autoestima y autoconocimiento', 'descripcion' => 'Descubre tus fortalezas y construye una relación más amable contigo mismo.', 'imagen' => 'assets/img/psico-autoestima.webp', 'alt' => ''],
    ['titulo' => 'Duelo y crisis vitales', 'descripcion' => 'Acompañamiento para atravesar pérdidas y cambios difíciles sin cargarlo solo.', 'imagen' => 'assets/img/psico-duelo.webp', 'alt' => ''],
    ['titulo' => 'Estrés y adaptación a cambios', 'descripcion' => 'Herramientas para afrontar la presión y adaptarte a nuevas etapas con equilibrio.', 'imagen' => 'assets/img/psico-estres.webp', 'alt' => ''],
    ['titulo' => 'Dificultades en vínculos y relaciones', 'descripcion' => 'Mejora cómo te relacionas y aprende a resolver conflictos de forma sana.', 'imagen' => 'assets/img/psico-vinculos.webp', 'alt' => ''],
    ['titulo' => 'Habilidades sociales', 'descripcion' => 'Gana seguridad para comunicarte y conectar con los demás de forma auténtica.', 'imagen' => 'assets/img/psico-habilidades.webp', 'alt' => ''],
    ['titulo' => 'Organización, hábitos y manejo del tiempo', 'descripcion' => 'Crea rutinas y hábitos que te ayuden a sentirte más en control de tu día.', 'imagen' => 'assets/img/psico-organizacion.webp', 'alt' => ''],
    ['titulo' => 'Orientación vocacional', 'descripcion' => 'Explora tus intereses y toma decisiones sobre tu futuro con más claridad.', 'imagen' => 'assets/img/psico-vocacional.webp', 'alt' => ''],
    ['titulo' => 'Dificultades emocionales y conductuales', 'descripcion' => 'Apoyo para comprender y encauzar emociones y conductas del día a día.', 'imagen' => 'assets/img/psico-conductuales.webp', 'alt' => ''],
];
$lumenti_ultimo = count($lumenti_items) - 1;
$lumenti_flecha = '<svg class="lm-home-diario__option-svg" width="18" height="18" viewBox="0 0 256 256" fill="currentColor"><path d="M200,64V168a8,8,0,0,1-16,0V83.31L69.66,197.66a8,8,0,0,1-11.32-11.32L172.69,72H88a8,8,0,0,1,0-16H192A8,8,0,0,1,200,64Z"/></svg>';
?>
<section class="lm-home-diario" aria-labelledby="lm-psico" data-lm-daily data-lm-nav-tone="dark" data-lm-section="psicologia-para-el-dia-a-dia">
    <div class="lm-home-diario__layout">
        <div class="lm-home-diario__media" data-lm-reveal="img">
            <div class="lm-home-diario__frame">
                <?php foreach ($lumenti_items as $lumenti_i => $lumenti_item) : $lumenti_activa = $lumenti_i === 0; ?>
                    <img class="lm-home-diario__img <?= $lumenti_activa ? 'is-active' : 'is-hidden' ?>" src="<?= esc_url(get_theme_file_uri($lumenti_item['imagen'])) ?>" alt="<?= $lumenti_activa ? esc_attr($lumenti_item['alt']) : '' ?>" aria-hidden="<?= $lumenti_activa ? 'false' : 'true' ?>" width="532" height="462" loading="lazy" decoding="async" data-lm-daily-img="<?= (int) $lumenti_i ?>">
                <?php endforeach; ?>
            </div>
        </div>
        <div class="lm-home-diario__content">
            <?php if ($lumenti_diario['etiqueta'] !== '') : ?>
                <p class="lm-eyebrow lm-eyebrow--dot lm-home-diario__eyebrow" data-lm-reveal="up"><?= esc_html($lumenti_diario['etiqueta']) ?></p>
            <?php endif; ?>
            <h2 class="lm-h2 lm-home-diario__title" id="lm-psico" data-lm-reveal="up"><?php foreach (array_filter(array_map('trim', preg_split('/\R/', $lumenti_diario['titulo']))) as $lumenti_linea) : ?><span class="lm-h2__line"><?= esc_html($lumenti_linea) ?></span><?php endforeach; ?></h2>
            <?php if ($lumenti_diario['bajada'] !== '') : ?>
                <p class="lm-home-diario__lead"><?= esc_html($lumenti_diario['bajada']) ?></p>
            <?php endif; ?>
            <ul class="lm-home-diario__list" id="lm-more-daily" data-lm-more="<?= (int) $lumenti_diario['visibles'] ?>">
                <?php foreach ($lumenti_items as $lumenti_i => $lumenti_item) : ?>
                    <li class="lm-home-diario__item<?= $lumenti_i >= $lumenti_diario['visibles'] ? ' lm-home-diario__item--extra' : '' ?>" data-lm-reveal="up" data-lm-reveal-group>
                        <a class="lm-home-diario__option<?= $lumenti_i === $lumenti_ultimo ? ' lm-home-diario__option--last' : '' ?>" href="<?= esc_url($lumenti_diario['enlace']) ?>" data-lm-daily-opt="<?= (int) $lumenti_i ?>">
                            <span class="lm-home-diario__option-fill" aria-hidden="true"></span>
                            <span class="lm-home-diario__option-title"><?= esc_html($lumenti_item['titulo']) ?></span>
                            <span class="lm-home-diario__option-desc"><?= esc_html($lumenti_item['descripcion']) ?></span>
                            <span class="lm-home-diario__option-icon" aria-hidden="true"><span class="lm-home-diario__option-icon-fill"></span><?= $lumenti_flecha // SVG fijo del tema. ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
            <?php if (count($lumenti_items) > $lumenti_diario['visibles']) : ?>
                <div class="lm-home-diario__more">
                    <button class="lm-btn lm-btn--primary lm-home-diario__more-btn" type="button" aria-controls="lm-more-daily" aria-expanded="false" data-lm-more-btn data-lm-more-less="<?= esc_attr__('Ver menos', 'lumenti') ?>"><?= esc_html__('Ver más', 'lumenti') ?><svg class="lm-btn__arrow" aria-hidden="true" width="18" height="18" viewBox="0 0 256 256" fill="currentColor"><path class="lm-home-diario__icon-minus" d="M213.66,101.66l-80,80a8,8,0,0,1-11.32,0l-80-80A8,8,0,0,1,53.66,90.34L128,164.69l74.34-74.35a8,8,0,0,1,11.32,11.32Z"/></svg></button>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <?php get_template_part('template-parts/pages/home/evaluaciones'); ?>
</section>
