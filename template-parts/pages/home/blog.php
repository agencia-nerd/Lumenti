<?php
defined('ABSPATH') || exit;

/*
 * Inicio · blog (specs/home.md → blog, grupo ACF home_blog). 4 artículos con template-parts/components/blog-card.php
 * (variante compacta). Artículos fijos del diseño; en el paso ACF salen de la relación con entradas.
 */

$lumenti_blog = [
    'titulo' => 'NUESTROS ARTÍCULOS PARA EL BIENESTAR',
    'bajada' => 'Artículos escritos por nuestros especialistas sobre salud mental, tratamientos y bienestar. Contenido claro, basado en evidencia y pensado para ti.',
    'boton' => ['url' => home_url('/blog/'), 'title' => 'Explora nuestro blog', 'target' => ''],
];
$lumenti_articulos = [
    [
        'titulo' => '¿VOY A TOMAR EL ANTIDEPRESIVO PARA TODA LA VIDA?',
        'url' => home_url('/antidepresivo-para-toda-la-vida/'),
        'imagen' => 'assets/img/blog/antidepresivo-para-toda-la-vida.webp',
        'imagen_alt' => 'Médica revisando una tablet junto a su paciente',
        'categoria' => 'TRATAMIENTOS Y EVALUACIONES',
    ],
    [
        'titulo' => '¿CÓMO SE DIAGNOSTICA EL TDAH?',
        'url' => home_url('/como-se-diagnostica-el-tdah/'),
        'imagen' => 'assets/img/blog/como-se-diagnostica-el-tdah.webp',
        'imagen_alt' => 'Médico conversando con un adolescente en consulta',
        'categoria' => 'NEURODIVERGENCIAS',
    ],
    [
        'titulo' => '¿EXISTE UN TRATAMIENTO EFECTIVO PARA EL TRASTORNO LÍMITE DE LA PERSONALIDAD?',
        'url' => home_url('/tratamiento-trastorno-limite-de-la-personalidad/'),
        'imagen' => 'assets/img/blog/tratamiento-trastorno-limite-de-la-personalidad.webp',
        'imagen_alt' => 'Mujer sonriendo con una taza junto a la ventana',
        'categoria' => 'TRATAMIENTOS Y EVALUACIONES',
    ],
    [
        'titulo' => 'LA ANSIEDAD EN NIÑOS NO SIEMPRE SE VE COMO ANSIEDAD',
        'url' => home_url('/ansiedad-en-ninos/'),
        'imagen' => 'assets/img/blog/ansiedad-en-ninos.webp',
        'imagen_alt' => 'Niño con su madre conversando junto a la ventana',
        'categoria' => 'SALUD MENTAL',
    ],
];
$lumenti_boton_attrs = lumenti_link_attrs($lumenti_blog['boton'], ['class' => 'lm-btn lm-btn--secondary lm-home-blog__all']);
?>
<section class="lm-home-blog" aria-labelledby="lm-blog" data-lm-section="blog">
    <div class="lm-home-blog__header">
        <div class="lm-home-blog__intro" data-lm-reveal="up">
            <h2 class="lm-h2 lm-home-blog__title" id="lm-blog"><?= esc_html($lumenti_blog['titulo']) ?></h2>
            <?php if ($lumenti_blog['bajada'] !== '') : ?>
                <p class="lm-home-blog__lead"><?= esc_html($lumenti_blog['bajada']) ?></p>
            <?php endif; ?>
        </div>
        <?php if ($lumenti_boton_attrs !== '') : ?>
            <a<?= $lumenti_boton_attrs ?>><?= esc_html($lumenti_blog['boton']['title']) ?><svg class="lm-btn__arrow" aria-hidden="true" width="16" height="16" viewBox="0 0 256 256" fill="currentColor"><path d="M221.66,133.66l-72,72a8,8,0,0,1-11.32-11.32L196.69,136H40a8,8,0,0,1,0-16H196.69L138.34,61.66a8,8,0,0,1,11.32-11.32l72,72A8,8,0,0,1,221.66,133.66Z"/></svg></a>
        <?php endif; ?>
    </div>
    <ul class="lm-home-blog__grid">
        <?php foreach ($lumenti_articulos as $lumenti_articulo) : ?>
            <li class="lm-home-blog__item" data-lm-reveal="up">
                <?php get_template_part('template-parts/components/blog-card', null, $lumenti_articulo); ?>
            </li>
        <?php endforeach; ?>
    </ul>
</section>
