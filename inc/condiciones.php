<?php
defined('ABSPATH') || exit;

/*
 * Condiciones: lo propio de Lumenti que el JSON de wp-acf no cubre (specs/condicion.md).
 * - Sin archivo (/condicion/ no lista nada) y sin editor ni imagen destacada: todo el contenido son campos ACF.
 *   La URL de cada una es /condicion/<slug>/ (la clave del tipo).
 * - El término de que_trata de la condición (condicion_especialistas_que_trata, campo de inc/campos-extra.php)
 *   une la condición con sus especialistas y con el filtro "atiende" del listado.
 */

add_filter('register_post_type_args', function (array $args, string $post_type): array {
    if ($post_type === 'condicion') {
        $args['has_archive'] = false;
        $args['supports'] = ['title'];
    }
    return $args;
}, 10, 2);

// Término de que_trata de una condición, o null si no tiene. $grupo: el grupo condicion_especialistas ya leído.
function lumenti_condicion_termino($post = null, ?array $grupo = null): ?WP_Term
{
    if ($grupo === null) {
        $grupo = function_exists('get_field') ? (array) (get_field('condicion_especialistas', $post ?? get_the_ID()) ?: []) : [];
    }
    $term = get_term((int) ($grupo['que_trata'] ?? 0), 'que_trata');
    return $term instanceof WP_Term ? $term : null;
}

// Cards del carrusel de una condición: los especialistas publicados con su término, psiquiatras primero y luego
// por especialista_perfil_orden (lumenti_especialistas_ordenar, inc/especialistas.php).
function lumenti_condicion_especialistas_cards(?WP_Term $term): array
{
    if (!$term || !post_type_exists('especialista')) {
        return [];
    }
    $posts = get_posts([
        'post_type'      => 'especialista',
        'posts_per_page' => -1,
        'no_found_rows'  => true,
        'tax_query'      => [['taxonomy' => 'que_trata', 'field' => 'term_id', 'terms' => $term->term_id]],
    ]);
    return array_values(array_filter(array_map('lumenti_especialista_card_args', lumenti_especialistas_ordenar($posts))));
}
