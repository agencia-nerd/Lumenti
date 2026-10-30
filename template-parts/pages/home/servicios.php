<?php
defined('ABSPATH') || exit;

/*
 * Inicio · servicios (specs/home.md → servicios, grupo ACF home_servicios). 4 cards enlazadas; la descripción se
 * despliega con hover o foco (CSS). Títulos h2 (en el diseño h3 sin h2 previo). `sin_degradado` quita la capa oscura.
 * Cuerpo y descripción van en <div> (en el diseño <span> con <h3>/<p> dentro: HTML inválido; ya son bloques por CSS).
 * Contenido: get_field('home_servicios'). Sin `icono` el recuadro lleva la flecha del tema.
 */

$lumenti_grupo = get_field('home_servicios') ?: [];
$lumenti_servicios = array_values((array) ($lumenti_grupo['items'] ?? []));
if (!$lumenti_servicios) {
    return;
}
// Encuadre de la foto por posición (diseño): la 2.ª card centra distinto.
$lumenti_encuadres = [1 => 'lm-home-servicios__img--alt'];
$lumenti_icono = '<svg class="lm-home-servicios__icon" width="20" height="20" viewBox="0 0 256 256" fill="currentColor"><path d="M200,64V168a8,8,0,0,1-16,0V83.31L69.66,197.66a8,8,0,0,1-11.32-11.32L172.69,72H88a8,8,0,0,1,0-16H192A8,8,0,0,1,200,64Z"/></svg>';
?>
<section class="lm-home-servicios" aria-label="<?= esc_attr__('Servicios', 'lumenti') ?>" data-lm-section="servicios">
    <?php foreach ($lumenti_servicios as $lumenti_i => $lumenti_s) :
        $lumenti_attrs = lumenti_link_attrs($lumenti_s['enlace'] ?? null, ['class' => 'lm-home-servicios__card']);
        $lumenti_titulo = (string) ($lumenti_s['titulo'] ?? '');
        if ($lumenti_attrs === '' || $lumenti_titulo === '') {
            continue;
        }
        $lumenti_sin_degradado = !empty($lumenti_s['sin_degradado']);
        $lumenti_descripcion = (string) ($lumenti_s['descripcion'] ?? '');
        $lumenti_icono_img = lumenti_image($lumenti_s['icono'] ?? null, ['class' => 'lm-home-servicios__icon', 'alt' => '']);
        $lumenti_clase_img = trim('lm-home-servicios__img ' . ($lumenti_encuadres[$lumenti_i] ?? '') . ($lumenti_sin_degradado ? ' lm-home-servicios__img--wide' : ''));
    ?>
        <a<?= $lumenti_attrs ?>>
            <?= lumenti_image($lumenti_s['imagen'] ?? null, ['class' => $lumenti_clase_img, 'alt' => '', 'size' => 'large']) ?>
            <?php if (!$lumenti_sin_degradado) : ?>
                <span class="lm-home-servicios__overlay" aria-hidden="true"></span>
            <?php endif; ?>
            <span class="lm-home-servicios__icon-tile" aria-hidden="true"><?= $lumenti_icono_img !== '' ? $lumenti_icono_img : $lumenti_icono // SVG fijo del tema. ?></span>
            <div class="lm-home-servicios__body">
                <h2 class="lm-home-servicios__title"><?= esc_html($lumenti_titulo) ?></h2>
                <?php if ($lumenti_descripcion !== '') : ?>
                    <div class="lm-home-servicios__desc-wrap"><p class="lm-home-servicios__desc"><?= esc_html($lumenti_descripcion) ?></p></div>
                <?php endif; ?>
            </div>
        </a>
    <?php endforeach; ?>
</section>
