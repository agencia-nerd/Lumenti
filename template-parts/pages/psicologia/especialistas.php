<?php
defined('ABSPATH') || exit;

/*
 * Psicología · especialistas (specs/psicologia.md → especialistas). Grupo ACF: psicologia_especialistas.
 * Componente specialists-carousel sin pills (filtro false). Título con *marcador* y bajada; "Ver todos" es fijo.
 * Cards: los elegidos en "Especialistas a mostrar" (seleccion, campo de inc/campos-extra.php), en ese orden;
 * sin selección, todos los de tipo psicologos, en su orden (lumenti_especialistas_cards, inc/especialistas.php).
 */

$lumenti_especialistas = get_field('psicologia_especialistas') ?: [];

get_template_part('template-parts/components/specialists-carousel', null, [
    'titulo' => (string) ($lumenti_especialistas['titulo'] ?? ''),
    'texto' => (string) ($lumenti_especialistas['bajada'] ?? ''),
    // "Ver todos" es fijo: el listado filtrado por el tipo de la página.
    'enlace' => ['url' => add_query_arg('tipo', 'psicologos', (string) get_post_type_archive_link('especialista')), 'title' => __('Ver todos', 'lumenti')],
    'filtro' => false,
    'variante' => 'servicio',
    'id' => 'lm-esp',
    'items' => lumenti_especialistas_cards('psicologos', (array) ($lumenti_especialistas['seleccion'] ?? [])),
]);
