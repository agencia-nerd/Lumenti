<?php
defined('ABSPATH') || exit;

/*
 * Condición · especialistas (specs/condicion.md → especialistas). Grupo ACF: condicion_especialistas.
 * Componente specialists-carousel con pills (filtro => true; src/js/modules/condition-filter.js). Títulos fijos
 * en la plantilla (iguales en todas las condiciones, no son campos).
 * Cards: los especialistas con el término de "Qué trata" de la condición (que_trata, campo de inc/campos-extra.php),
 * psiquiatras primero y luego por su orden (lumenti_condicion_especialistas_cards, inc/condiciones.php).
 * "Ver todos" lleva ?atiende=<slug del término> (el JS suma ?tipo= con la pill elegida).
 */

$lumenti_especialistas = get_field('condicion_especialistas') ?: [];
$lumenti_termino = lumenti_condicion_termino(null, (array) $lumenti_especialistas);
$lumenti_items = lumenti_condicion_especialistas_cards($lumenti_termino);
if (!$lumenti_items) {
    return;
}

$lumenti_listado = (string) get_post_type_archive_link('especialista');

get_template_part('template-parts/components/specialists-carousel', null, [
    'titulo' => __('ESPECIALISTAS QUE PUEDEN *AYUDARTE*', 'lumenti'),
    'texto' => __('Un equipo humano listo para acompañarte.', 'lumenti'),
    'enlace' => [
        'url' => add_query_arg('atiende', $lumenti_termino->slug, $lumenti_listado),
        'title' => __('Ver todos los especialistas', 'lumenti'),
        'target' => '',
    ],
    'filtro' => true,
    'variante' => 'condicion',
    'id' => 'lm-cond-esp-title',
    'items' => $lumenti_items,
]);
