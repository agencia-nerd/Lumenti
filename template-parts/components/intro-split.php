<?php
defined('ABSPATH') || exit;

/*
 * Intro en dos columnas: texto + dúo de fotos (.lm-intro-split, .lm-photo-duo). Diseño: css/components.css §15 y §16.
 *
 * $args:
 *   titulo           (string, sí)  con *marcador* para la parte en verde.
 *   id               (string)  id del título (aria-labelledby). Por defecto lm-intro.
 *   nivel            (h2 | h3)  por defecto h2.
 *   etiqueta         (string)  eyebrow antes del título.
 *   texto            (string | array)  párrafos: array, o un texto donde cada línea en blanco separa un párrafo.
 *   texto_destacado  (string)  párrafo oscuro (--strong) después de `texto`; se oculta si está vacío.
 *   aviso            (string)  nota con "!" (.lm-service-notice, role="note"); se oculta si está vacía.
 *   imagenes         (array de 2)  [atrás, adelante]: 'assets/img/x.webp', ['ruta', 'ancho', 'alto', 'alt'],
 *                    imagen ACF o ID. El alt de un archivo del tema va en 'alt'.
 *   invertido        (bool)  fotos a la izquierda en escritorio (--reverse).
 *   ancho            (bool)  dúo de fotos ancho (lm-photo-duo--wide, Empresas).
 *   clase            (string)  clases extra de la sección (ej. lm-emp-why).
 */

$lumenti_titulo = (string) ($args['titulo'] ?? '');
if ($lumenti_titulo === '') {
    return;
}
$lumenti_id = (string) ($args['id'] ?? 'lm-intro');
$lumenti_texto = $args['texto'] ?? [];
$lumenti_parrafos = is_array($lumenti_texto) ? $lumenti_texto : preg_split('/\R\s*\R/', trim((string) $lumenti_texto));
$lumenti_parrafos = array_values(array_filter(array_map('trim', array_map('strval', $lumenti_parrafos))));
$lumenti_destacado = trim((string) ($args['texto_destacado'] ?? ''));
$lumenti_aviso = trim((string) ($args['aviso'] ?? ''));
$lumenti_imagenes = array_values((array) ($args['imagenes'] ?? []));
$lumenti_clases = 'lm-intro-split'
    . (!empty($args['invertido']) ? ' lm-intro-split--reverse' : '')
    . (!empty($args['clase']) ? ' ' . $args['clase'] : '');

// Medidas del diseño (Psiquiatría) para archivos del tema sin 'ancho'/'alto'.
$lumenti_fotos = [];
foreach ([['back', 503, 832], ['front', 578, 757]] as $lumenti_i => [$lumenti_pos, $lumenti_w, $lumenti_h]) {
    $lumenti_img = lumenti_theme_image($lumenti_imagenes[$lumenti_i] ?? '', ['class' => 'lm-photo-duo__img', 'width' => $lumenti_w, 'height' => $lumenti_h, 'size' => 'large']);
    if ($lumenti_img !== '') {
        $lumenti_fotos[$lumenti_pos] = $lumenti_img;
    }
}
?>
<section class="<?= esc_attr($lumenti_clases) ?>" aria-labelledby="<?= esc_attr($lumenti_id) ?>">
    <div class="lm-intro-split__inner">
        <div class="lm-intro-split__text">
            <?php get_template_part('template-parts/components/section-title', null, [
                'titulo' => $lumenti_titulo,
                'id' => $lumenti_id,
                'nivel' => $args['nivel'] ?? 'h2',
                'etiqueta' => $args['etiqueta'] ?? '',
            ]); ?>
            <?php foreach ($lumenti_parrafos as $lumenti_p) : ?>
                <p class="lm-intro-split__p"><?= esc_html($lumenti_p) ?></p>
            <?php endforeach; ?>
            <?php if ($lumenti_destacado !== '') : ?>
                <p class="lm-intro-split__p lm-intro-split__p--strong"><?= esc_html($lumenti_destacado) ?></p>
            <?php endif; ?>
            <?php if ($lumenti_aviso !== '') : ?>
                <div class="lm-service-notice" role="note"><span class="lm-service-notice__icon" aria-hidden="true">!</span><p class="lm-service-notice__text"><?= esc_html($lumenti_aviso) ?></p></div>
            <?php endif; ?>
        </div>
        <?php if ($lumenti_fotos) : ?>
            <figure class="lm-photo-duo<?= !empty($args['ancho']) ? ' lm-photo-duo--wide' : '' ?>">
                <?php foreach ($lumenti_fotos as $lumenti_pos => $lumenti_img) : ?>
                    <span class="lm-photo-duo__item lm-photo-duo__item--<?= esc_attr($lumenti_pos) ?>"><?= $lumenti_img ?></span>
                <?php endforeach; ?>
            </figure>
        <?php endif; ?>
    </div>
</section>
