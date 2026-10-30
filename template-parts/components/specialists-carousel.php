<?php
defined('ABSPATH') || exit;

/*
 * Carrusel de especialistas (.lm-specialists-carousel). Diseño: css/components.css §14
 * (condicion.html con pills; servicio-psiquiatria.html sin pills). JS: [data-lm-cond-specialists].
 *
 * $args:
 *   items     (array, sí)  $args de especialista-card por card (el nivel h3 lo pone el carrusel).
 *   titulo    (string)  con *marcador* para la parte en verde. Por defecto 'CONOCE A LOS *ESPECIALISTAS*'.
 *   texto     (string)  bajada bajo el título.
 *   enlace    (link ACF ['url','title','target'])  "Ver todos", con la flecha. Se oculta si está vacío.
 *   filtro    (bool)  pills Todos / Médicos psiquiatras / Psicólogos (Condición).
 *   variante  (servicio | condicion)  clase de la sección: lm-service-specialists (servicios) o
 *             lm-specialists-carousel (condición). Por defecto condicion si hay filtro, si no servicio.
 *   id        (string)  id del título. Por defecto lm-esp.
 *   nivel     (h2 | h3)  nivel del título. Por defecto h2.
 */

$lumenti_items = array_filter((array) ($args['items'] ?? []), 'is_array');
if (!$lumenti_items) {
    return;
}
$lumenti_filtro = !empty($args['filtro']);
$lumenti_variante = $args['variante'] ?? ($lumenti_filtro ? 'condicion' : 'servicio');
$lumenti_clase = $lumenti_variante === 'condicion' ? 'lm-specialists-carousel' : 'lm-service-specialists';
$lumenti_id = (string) ($args['id'] ?? 'lm-esp');
$lumenti_enlace = $args['enlace'] ?? null;
$lumenti_enlace_attrs = $lumenti_enlace ? lumenti_link_attrs($lumenti_enlace, ['class' => 'lm-link-arrow']) : '';
$lumenti_enlace_texto = is_array($lumenti_enlace) ? (string) ($lumenti_enlace['title'] ?? '') : '';
if ($lumenti_enlace_texto === '') {
    $lumenti_enlace_attrs = '';
}
$lumenti_pills = [
    '' => __('Todos', 'lumenti'),
    'psiquiatras' => __('Médicos psiquiatras', 'lumenti'),
    'psicologos' => __('Psicólogos', 'lumenti'),
];
?>
<section class="<?= esc_attr($lumenti_clase) ?>" aria-labelledby="<?= esc_attr($lumenti_id) ?>" data-lm-cond-specialists<?= $lumenti_variante === 'condicion' ? ' data-lm-specialists-carousel' : '' ?>>
    <div class="lm-specialists-carousel__head">
        <?php get_template_part('template-parts/components/section-title', null, [
            'titulo' => $args['titulo'] ?? __('CONOCE A LOS *ESPECIALISTAS*', 'lumenti'),
            'nivel' => $args['nivel'] ?? 'h2',
            'id' => $lumenti_id,
            'texto' => $args['texto'] ?? '',
            'texto_clase' => 'lm-specialists-carousel__intro',
        ]); ?>
        <?php if ($lumenti_filtro || $lumenti_enlace_attrs !== '') : ?>
            <div class="lm-specialists-carousel__bar">
                <?php if ($lumenti_filtro) : ?>
                    <div class="lm-specialists-carousel__pills" role="group" aria-label="<?= esc_attr__('Filtrar especialistas', 'lumenti') ?>">
                        <?php foreach ($lumenti_pills as $lumenti_valor => $lumenti_texto) : ?>
                            <button class="lm-specialists-carousel__pill" type="button" aria-pressed="<?= $lumenti_valor === '' ? 'true' : 'false' ?>" data-lm-cond-tipo="<?= esc_attr($lumenti_valor) ?>"><?= esc_html($lumenti_texto) ?></button>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <?php if ($lumenti_enlace_attrs !== '') : ?>
                    <a<?= $lumenti_enlace_attrs ?><?= $lumenti_filtro ? ' data-lm-cond-all' : '' ?>><?= esc_html($lumenti_enlace_texto) ?><?php if (strpos($lumenti_enlace_attrs, 'target="_blank"') !== false) : ?><span class="sr-only"> (<?= esc_html__('se abre en una pestaña nueva', 'lumenti') ?>)</span><?php endif; ?><svg aria-hidden="true" width="16" height="16" viewBox="0 0 256 256" fill="currentColor"><path d="M221.66,133.66l-72,72a8,8,0,0,1-11.32-11.32L196.69,136H40a8,8,0,0,1,0-16H196.69L138.34,61.66a8,8,0,0,1,11.32-11.32l72,72A8,8,0,0,1,221.66,133.66Z"/></svg></a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="lm-specialists-carousel__carousel">
        <ul class="lm-specialists-carousel__track" data-lm-cond-track tabindex="0" aria-label="<?= esc_attr__('Especialistas', 'lumenti') ?>">
            <?php foreach ($lumenti_items as $lumenti_item) : ?>
                <li class="lm-specialists-carousel__item">
                    <?php get_template_part('template-parts/components/especialista-card', null, $lumenti_item + ['nivel' => 'h3']); ?>
                </li>
            <?php endforeach; ?>
        </ul>
        <span class="lm-specialists-carousel__fade" aria-hidden="true"></span>
        <button class="lm-specialists-carousel__arrow lm-specialists-carousel__arrow--prev" type="button" aria-label="<?= esc_attr__('Anterior', 'lumenti') ?>" data-lm-cond-prev hidden><svg aria-hidden="true" width="20" height="20" viewBox="0 0 256 256" fill="currentColor"><path d="M224,128a8,8,0,0,1-8,8H59.31l58.35,58.34a8,8,0,0,1-11.32,11.32l-72-72a8,8,0,0,1,0-11.32l72-72a8,8,0,0,1,11.32,11.32L59.31,120H216A8,8,0,0,1,224,128Z"/></svg></button>
        <button class="lm-specialists-carousel__arrow lm-specialists-carousel__arrow--next" type="button" aria-label="<?= esc_attr__('Siguiente', 'lumenti') ?>" data-lm-cond-next><svg aria-hidden="true" width="20" height="20" viewBox="0 0 256 256" fill="currentColor"><path d="M221.66,133.66l-72,72a8,8,0,0,1-11.32-11.32L196.69,136H40a8,8,0,0,1,0-16H196.69L138.34,61.66a8,8,0,0,1,11.32-11.32l72,72A8,8,0,0,1,221.66,133.66Z"/></svg></button>
    </div>
</section>
