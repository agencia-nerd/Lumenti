<?php
defined('ABSPATH') || exit;

/*
 * Inicio · diario (specs/home.md → diario, grupo ACF home_diario). Sección oscura (data-lm-nav-tone="dark").
 * Hover/foco en un ítem cambia la imagen del marco: src/js/modules/home.js (daily, ganchos data-lm-daily-*); solo la
 * imagen activa tiene alt. En móvil 5 + "Ver más" (ver-mas.js; ítems extra con --extra). Incluye la parte
 * `evaluaciones` dentro de su <section>. Contenido: get_field('home_diario'); cada renglón del título es una línea.
 */

$lumenti_diario = get_field('home_diario') ?: [];
$lumenti_etiqueta = (string) ($lumenti_diario['etiqueta'] ?? '');
$lumenti_titulo = (string) ($lumenti_diario['titulo'] ?? '');
$lumenti_bajada = (string) ($lumenti_diario['bajada'] ?? '');
$lumenti_enlace = $lumenti_diario['enlace'] ?? null;
$lumenti_items = array_values((array) ($lumenti_diario['items'] ?? []));
$lumenti_visibles = 5;
$lumenti_ultimo = count($lumenti_items) - 1;
$lumenti_flecha = '<svg class="lm-home-diario__option-svg" width="18" height="18" viewBox="0 0 256 256" fill="currentColor"><path d="M200,64V168a8,8,0,0,1-16,0V83.31L69.66,197.66a8,8,0,0,1-11.32-11.32L172.69,72H88a8,8,0,0,1,0-16H192A8,8,0,0,1,200,64Z"/></svg>';
?>
<section class="lm-home-diario"<?php if ($lumenti_titulo !== '') : ?> aria-labelledby="lm-psico"<?php endif; ?> data-lm-daily data-lm-nav-tone="dark" data-lm-section="psicologia-para-el-dia-a-dia">
    <div class="lm-home-diario__layout">
        <div class="lm-home-diario__media" data-lm-reveal="img">
            <div class="lm-home-diario__frame">
                <?php foreach ($lumenti_items as $lumenti_i => $lumenti_item) :
                    $lumenti_img = lumenti_image_data($lumenti_item['imagen'] ?? null, 'large');
                    if (!$lumenti_img) {
                        continue;
                    }
                    $lumenti_activa = $lumenti_i === 0;
                ?>
                    <img class="lm-home-diario__img <?= $lumenti_activa ? 'is-active' : 'is-hidden' ?>" src="<?= esc_url($lumenti_img['url']) ?>" alt="<?= $lumenti_activa ? esc_attr($lumenti_img['alt']) : '' ?>" aria-hidden="<?= $lumenti_activa ? 'false' : 'true' ?>"<?php if ($lumenti_img['width'] && $lumenti_img['height']) : ?> width="<?= (int) $lumenti_img['width'] ?>" height="<?= (int) $lumenti_img['height'] ?>"<?php endif; ?> loading="lazy" decoding="async" data-lm-daily-img="<?= (int) $lumenti_i ?>">
                <?php endforeach; ?>
            </div>
        </div>
        <div class="lm-home-diario__content">
            <?php if ($lumenti_etiqueta !== '') : ?>
                <p class="lm-eyebrow lm-eyebrow--dot lm-home-diario__eyebrow" data-lm-reveal="up"><?= esc_html($lumenti_etiqueta) ?></p>
            <?php endif; ?>
            <?php if ($lumenti_titulo !== '') : ?>
                <h2 class="lm-h2 lm-home-diario__title" id="lm-psico" data-lm-reveal="up"><?php foreach (array_filter(array_map('trim', preg_split('/\R/', $lumenti_titulo))) as $lumenti_linea) : ?><span class="lm-h2__line"><?= esc_html($lumenti_linea) ?></span><?php endforeach; ?></h2>
            <?php endif; ?>
            <?php if ($lumenti_bajada !== '') : ?>
                <p class="lm-home-diario__lead"><?= esc_html($lumenti_bajada) ?></p>
            <?php endif; ?>
            <?php if ($lumenti_items) : ?>
                <ul class="lm-home-diario__list" id="lm-more-daily" data-lm-more="<?= (int) $lumenti_visibles ?>">
                    <?php foreach ($lumenti_items as $lumenti_i => $lumenti_item) :
                        $lumenti_clase = 'lm-home-diario__option' . ($lumenti_i === $lumenti_ultimo ? ' lm-home-diario__option--last' : '');
                        // Sin enlace en el campo, el ítem queda como <span> (mismo aspecto, sin enlace roto).
                        $lumenti_attrs = lumenti_link_attrs($lumenti_enlace, ['class' => $lumenti_clase]);
                        $lumenti_tag = $lumenti_attrs !== '' ? 'a' : 'span';
                        if ($lumenti_attrs === '') {
                            $lumenti_attrs = ' class="' . esc_attr($lumenti_clase) . '"';
                        }
                    ?>
                        <li class="lm-home-diario__item<?= $lumenti_i >= $lumenti_visibles ? ' lm-home-diario__item--extra' : '' ?>" data-lm-reveal="up" data-lm-reveal-group>
                            <<?= $lumenti_tag ?><?= $lumenti_attrs ?> data-lm-daily-opt="<?= (int) $lumenti_i ?>">
                                <span class="lm-home-diario__option-fill" aria-hidden="true"></span>
                                <span class="lm-home-diario__option-title"><?= esc_html((string) ($lumenti_item['titulo'] ?? '')) ?></span>
                                <?php if ((string) ($lumenti_item['descripcion'] ?? '') !== '') : ?>
                                    <span class="lm-home-diario__option-desc"><?= esc_html((string) $lumenti_item['descripcion']) ?></span>
                                <?php endif; ?>
                                <span class="lm-home-diario__option-icon" aria-hidden="true"><span class="lm-home-diario__option-icon-fill"></span><?= $lumenti_flecha // SVG fijo del tema. ?></span>
                            </<?= $lumenti_tag ?>>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            <?php if (count($lumenti_items) > $lumenti_visibles) : ?>
                <div class="lm-home-diario__more">
                    <button class="lm-btn lm-btn--primary lm-home-diario__more-btn" type="button" aria-controls="lm-more-daily" aria-expanded="false" data-lm-more-btn data-lm-more-less="<?= esc_attr__('Ver menos', 'lumenti') ?>"><?= esc_html__('Ver más', 'lumenti') ?><svg class="lm-btn__arrow" aria-hidden="true" width="18" height="18" viewBox="0 0 256 256" fill="currentColor"><path class="lm-home-diario__icon-minus" d="M213.66,101.66l-80,80a8,8,0,0,1-11.32,0l-80-80A8,8,0,0,1,53.66,90.34L128,164.69l74.34-74.35a8,8,0,0,1,11.32,11.32Z"/></svg></button>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <?php get_template_part('template-parts/pages/home/evaluaciones'); ?>
</section>
