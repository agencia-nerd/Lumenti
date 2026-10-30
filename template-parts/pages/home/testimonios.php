<?php
defined('ABSPATH') || exit;

/*
 * Inicio · testimonios (specs/home.md → testimonios, grupo ACF home_testimonios). Carrusel en abanico:
 * src/js/modules/carousel.js (data-lm-carousel="testimonials", ganchos data-lm-carousel-*). Un punto por testimonio.
 * Estrellas decorativas con su número como texto oculto. Contenido: get_field('home_testimonios'); cada renglón
 * del título es una línea.
 */

$lumenti_testimonios = get_field('home_testimonios') ?: [];
$lumenti_titulo = (string) ($lumenti_testimonios['titulo'] ?? '');
$lumenti_bajada = (string) ($lumenti_testimonios['bajada'] ?? '');
$lumenti_items = array_values(array_filter((array) ($lumenti_testimonios['items'] ?? []), static fn ($t) => (string) ($t['texto'] ?? '') !== ''));
if (!$lumenti_items) {
    return;
}
$lumenti_estrella = '<svg class="lm-home-testimonios__star" aria-hidden="true" width="18" height="18" viewBox="0 0 256 256" fill="#c6a36c"><path d="M234.29,114.85l-45,38.83L203,211.75a16.07,16.07,0,0,1-24,17.42L128,198.49,77,229.17a16.07,16.07,0,0,1-24-17.42l13.76-58.07-45-38.83A16,16,0,0,1,31.08,86.73l59-4.76,22.76-55.08a16,16,0,0,1,29.44,0l22.76,55.08,59,4.76a16,16,0,0,1,9.11,28.12Z"/></svg>';
?>
<section class="lm-home-testimonios"<?php if ($lumenti_titulo !== '') : ?> aria-labelledby="lm-testi"<?php endif; ?> data-lm-carousel="testimonials" data-lm-section="testimonios">
    <?php if ($lumenti_titulo !== '' || $lumenti_bajada !== '') : ?>
        <div class="lm-home-testimonios__header" data-lm-reveal="up">
            <?php if ($lumenti_titulo !== '') : ?>
                <h2 class="lm-h2 lm-home-testimonios__title" id="lm-testi"><?php foreach (array_filter(array_map('trim', preg_split('/\R/', $lumenti_titulo))) as $lumenti_linea) : ?><span class="lm-h2__line"><?= esc_html($lumenti_linea) ?></span><?php endforeach; ?></h2>
            <?php endif; ?>
            <?php if ($lumenti_bajada !== '') : ?>
                <p class="lm-home-testimonios__lead"><?= esc_html($lumenti_bajada) ?></p>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    <div class="lm-home-testimonios__stage" role="region" aria-roledescription="carrusel" aria-label="<?= esc_attr__('Testimonios', 'lumenti') ?>" tabindex="0" data-lm-reveal="up" data-lm-carousel-stage>
        <?php foreach ($lumenti_items as $lumenti_i => $lumenti_t) :
            $lumenti_estrellas = max(0, min(5, (int) ($lumenti_t['estrellas'] ?? 0)));
            $lumenti_nombre = (string) ($lumenti_t['nombre'] ?? '');
            $lumenti_fuente = (string) ($lumenti_t['fuente'] ?? '');
        ?>
            <figure class="lm-home-testimonios__card" aria-hidden="<?= $lumenti_i === 0 ? 'false' : 'true' ?>" data-lm-carousel-item="<?= (int) $lumenti_i ?>">
                <blockquote class="lm-home-testimonios__quote">"<?= esc_html((string) $lumenti_t['texto']) ?>"</blockquote>
                <figcaption class="lm-home-testimonios__footer">
                    <span class="lm-home-testimonios__author">
                        <?php if ($lumenti_estrellas > 0) : ?>
                            <span class="lm-home-testimonios__stars"><?= str_repeat($lumenti_estrella, $lumenti_estrellas) // SVG fijo del tema. ?><span class="sr-only" lang="es"><?= esc_html(sprintf(__('%d de 5 estrellas', 'lumenti'), $lumenti_estrellas)) ?></span></span>
                        <?php endif; ?>
                        <?php if ($lumenti_nombre !== '') : ?>
                            <span class="lm-home-testimonios__name"><?= esc_html($lumenti_nombre) ?></span>
                        <?php endif; ?>
                        <?php if ($lumenti_fuente !== '') : ?>
                            <span class="lm-home-testimonios__source" lang="es"><?= esc_html($lumenti_fuente) ?></span>
                        <?php endif; ?>
                    </span>
                    <span class="lm-home-testimonios__rule" aria-hidden="true"><span class="lm-home-testimonios__rule-line"></span><span class="lm-home-testimonios__rule-line"></span><span class="lm-home-testimonios__rule-line lm-home-testimonios__rule-line--short"></span></span>
                </figcaption>
            </figure>
        <?php endforeach; ?>
    </div>
    <div class="lm-home-testimonios__arrows">
        <button class="lm-home-testimonios__arrow" type="button" aria-label="<?= esc_attr__('Anterior', 'lumenti') ?>" data-lm-carousel-prev><span class="lm-home-testimonios__arrow-fill" aria-hidden="true"></span><svg class="lm-home-testimonios__star" aria-hidden="true" width="20" height="20" viewBox="0 0 256 256" fill="currentColor"><path d="M224,128a8,8,0,0,1-8,8H59.31l58.35,58.34a8,8,0,0,1-11.32,11.32l-72-72a8,8,0,0,1,0-11.32l72-72a8,8,0,0,1,11.32,11.32L59.31,120H216A8,8,0,0,1,224,128Z"/></svg></button>
        <button class="lm-home-testimonios__arrow" type="button" aria-label="<?= esc_attr__('Siguiente', 'lumenti') ?>" data-lm-carousel-next><span class="lm-home-testimonios__arrow-fill" aria-hidden="true"></span><svg class="lm-home-testimonios__star" aria-hidden="true" width="20" height="20" viewBox="0 0 256 256" fill="currentColor"><path d="M221.66,133.66l-72,72a8,8,0,0,1-11.32-11.32L196.69,136H40a8,8,0,0,1,0-16H196.69L138.34,61.66a8,8,0,0,1,11.32-11.32l72,72A8,8,0,0,1,221.66,133.66Z"/></svg></button>
    </div>
    <div class="lm-home-testimonios__dots">
        <?php foreach ($lumenti_items as $lumenti_i => $lumenti_t) : ?>
            <button class="lm-home-testimonios__dot" type="button" aria-label="<?= esc_attr(sprintf(__('Testimonio %d', 'lumenti'), $lumenti_i + 1)) ?>"<?= $lumenti_i === 0 ? ' aria-current="true"' : '' ?> data-lm-carousel-dot="<?= (int) $lumenti_i ?>"><span class="lm-home-testimonios__dot-bar"></span></button>
        <?php endforeach; ?>
    </div>
</section>
