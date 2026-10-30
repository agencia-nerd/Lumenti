<?php
defined('ABSPATH') || exit;

/*
 * Título de sección interno (.lm-section-title). Diseño: css/components.css §13.
 * Imprime solo el encabezado (y, si vienen, la etiqueta antes y el texto después): el contenedor es de cada sección.
 *
 * $args:
 *   titulo       (string, sí)  la parte en color va entre asteriscos: 'CONOCE A LOS *ESPECIALISTAS*'.
 *                             Un salto de línea en el texto es un <br> (corte del diseño).
 *   nivel        (h2 | h3)  por defecto h2.
 *   id           (string)  id del encabezado, para el aria-labelledby de la sección.
 *   etiqueta     (string)  eyebrow con punto antes del título.
 *   texto        (string)  bajada después del título (p.lm-lead).
 *   texto_clase  (string)  clases extra de la bajada (ej. lm-specialists-carousel__intro).
 *   centrado     (bool)  modificador --center.
 *   claro        (bool)  modificador --light (sobre fondo oscuro).
 *   clase        (string)  clases extra del encabezado.
 */

$lumenti_titulo = (string) ($args['titulo'] ?? '');
if ($lumenti_titulo === '') {
    return;
}
$lumenti_nivel = ($args['nivel'] ?? '') === 'h3' ? 'h3' : 'h2';
$lumenti_id = (string) ($args['id'] ?? '');
$lumenti_etiqueta = (string) ($args['etiqueta'] ?? '');
$lumenti_texto = (string) ($args['texto'] ?? '');
$lumenti_clases = 'lm-section-title'
    . (!empty($args['centrado']) ? ' lm-section-title--center' : '')
    . (!empty($args['claro']) ? ' lm-section-title--light' : '')
    . (!empty($args['clase']) ? ' ' . $args['clase'] : '');
?>
<?php if ($lumenti_etiqueta !== '') : ?>
    <p class="lm-eyebrow lm-eyebrow--dot"><?= esc_html($lumenti_etiqueta) ?></p>
<?php endif; ?>
<<?= $lumenti_nivel ?> class="<?= esc_attr($lumenti_clases) ?>"<?php if ($lumenti_id !== '') : ?> id="<?= esc_attr($lumenti_id) ?>"<?php endif; ?>><?= nl2br(lumenti_highlight($lumenti_titulo), false) ?></<?= $lumenti_nivel ?>>
<?php if ($lumenti_texto !== '') : ?>
    <p class="<?= esc_attr(trim('lm-lead ' . (string) ($args['texto_clase'] ?? ''))) ?>"><?= esc_html($lumenti_texto) ?></p>
<?php endif; ?>
