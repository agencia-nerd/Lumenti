<?php
defined('ABSPATH') || exit;

/*
 * Inicio · testimonios (specs/home.md → testimonios, grupo ACF home_testimonios). Carrusel en abanico:
 * src/js/modules/carousel.js (data-lm-carousel="testimonials", ganchos data-lm-carousel-*). Un punto por testimonio.
 * Estrellas decorativas con su número como texto oculto. Datos fijos (html/home.html, data/testimonios.json).
 */

$lumenti_testimonios = [
    // Cada renglón del título es una línea (.lm-h2__line).
    'titulo' => 'LO QUE DICEN
NUESTROS CLIENTES',
    'bajada' => 'Experiencias de personas que confiaron en nosotros para cuidar su salud mental.',
];
$lumenti_items = [
    ['texto' => 'En Lumenti he encontrado profesionales muy capacitados y principalmente humanos. Me gusta que toda la coordinación es muy eficiente.', 'nombre' => 'Luz del Pilar S.', 'fuente' => 'Google Reviews', 'estrellas' => 5],
    ['texto' => 'Cuenta con médicos súper atentos y agradables. El consultorio es moderno y cómodo. Te hacen sentir muy tranquila y en confianza desde el primer día!', 'nombre' => 'Mariale V.', 'fuente' => 'Google Reviews', 'estrellas' => 5],
    ['texto' => 'Lo que más resalto del centro es que los psiquiatras y psicoterapeutas trabajan en coordinación y eso ahorra tiempo y ayuda mucho al tratamiento. Recomendados! Me están ayudando mucho.', 'nombre' => 'Gladys M.', 'fuente' => 'Google Reviews', 'estrellas' => 5],
    ['texto' => 'I highly recommend this great team at Lumenti Salud Mental Integral. I truly appreciated the closeness of the professionals and the excellent coordination between the psychotherapy and psychiatry appointments. This integrated care made my treatment incredibly effective.', 'nombre' => 'Bernardo D.', 'fuente' => 'Google Reviews', 'estrellas' => 5, 'idioma' => 'en'],
    ['texto' => 'El mejor servicio! Si necesitan ayuda, no duden en contactarlos, equipo profesional!', 'nombre' => 'Alejandra G.', 'fuente' => 'Google Reviews', 'estrellas' => 5],
    ['texto' => 'Súper agradecida con el trato de los doctores. El espacio es lindo. Los felicito!', 'nombre' => 'Mariana D.', 'fuente' => 'Google Reviews', 'estrellas' => 5],
    ['texto' => 'I highly recommend this practice. Excellent care and professional, kind practitioners.', 'nombre' => 'Elizabeth S.', 'fuente' => 'Google Reviews', 'estrellas' => 5, 'idioma' => 'en'],
    ['texto' => 'Un centro especializado, de primer nivel y enfocado en el bienestar de sus pacientes. Muchas gracias por su contribución a la salud mental del país.', 'nombre' => 'Samuel C.', 'fuente' => 'Google Reviews', 'estrellas' => 5],
    ['texto' => 'Muy buen proveedor de Servicios, excelente comunicación, facilidad para agendar las citas, facilidad en relación a métodos de pago, buen seguimiento y profesionalismo.', 'nombre' => 'Laura U.', 'fuente' => 'Google Reviews', 'estrellas' => 5],
];
$lumenti_estrella = '<svg class="lm-home-testimonios__star" aria-hidden="true" width="18" height="18" viewBox="0 0 256 256" fill="#c6a36c"><path d="M234.29,114.85l-45,38.83L203,211.75a16.07,16.07,0,0,1-24,17.42L128,198.49,77,229.17a16.07,16.07,0,0,1-24-17.42l13.76-58.07-45-38.83A16,16,0,0,1,31.08,86.73l59-4.76,22.76-55.08a16,16,0,0,1,29.44,0l22.76,55.08,59,4.76a16,16,0,0,1,9.11,28.12Z"/></svg>';
?>
<section class="lm-home-testimonios" aria-labelledby="lm-testi" data-lm-carousel="testimonials" data-lm-section="testimonios">
    <div class="lm-home-testimonios__header" data-lm-reveal="up">
        <h2 class="lm-h2 lm-home-testimonios__title" id="lm-testi"><?php foreach (array_filter(array_map('trim', preg_split('/\R/', $lumenti_testimonios['titulo']))) as $lumenti_linea) : ?><span class="lm-h2__line"><?= esc_html($lumenti_linea) ?></span><?php endforeach; ?></h2>
        <?php if ($lumenti_testimonios['bajada'] !== '') : ?>
            <p class="lm-home-testimonios__lead"><?= esc_html($lumenti_testimonios['bajada']) ?></p>
        <?php endif; ?>
    </div>
    <div class="lm-home-testimonios__stage" role="region" aria-roledescription="carrusel" aria-label="<?= esc_attr__('Testimonios', 'lumenti') ?>" tabindex="0" data-lm-reveal="up" data-lm-carousel-stage>
        <?php foreach ($lumenti_items as $lumenti_i => $lumenti_t) :
            $lumenti_estrellas = max(0, min(5, (int) $lumenti_t['estrellas']));
        ?>
            <figure class="lm-home-testimonios__card" aria-hidden="<?= $lumenti_i === 0 ? 'false' : 'true' ?>" data-lm-carousel-item="<?= (int) $lumenti_i ?>"<?php if (!empty($lumenti_t['idioma'])) : ?> lang="<?= esc_attr($lumenti_t['idioma']) ?>"<?php endif; ?>>
                <blockquote class="lm-home-testimonios__quote">"<?= esc_html($lumenti_t['texto']) ?>"</blockquote>
                <figcaption class="lm-home-testimonios__footer">
                    <span class="lm-home-testimonios__author">
                        <?php if ($lumenti_estrellas > 0) : ?>
                            <span class="lm-home-testimonios__stars"><?= str_repeat($lumenti_estrella, $lumenti_estrellas) // SVG fijo del tema. ?><span class="sr-only" lang="es"><?= esc_html(sprintf(__('%d de 5 estrellas', 'lumenti'), $lumenti_estrellas)) ?></span></span>
                        <?php endif; ?>
                        <span class="lm-home-testimonios__name"><?= esc_html($lumenti_t['nombre']) ?></span>
                        <?php if ($lumenti_t['fuente'] !== '') : ?>
                            <span class="lm-home-testimonios__source" lang="es"><?= esc_html($lumenti_t['fuente']) ?></span>
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
