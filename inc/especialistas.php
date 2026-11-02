<?php
defined('ABSPATH') || exit;

/*
 * Especialistas: lo propio de Lumenti que el JSON de wp-acf no cubre (specs/especialistas.md, especialista.md).
 * - URLs: listado en /especialistas/ y perfil en /especialistas/<nombre-completo>/ (wp-acf deja la clave del
 *   tipo, /especialista/). Después del primer cambio: Ajustes > Enlaces permanentes > Guardar.
 * - Las taxonomías del especialista no tienen archivo propio: se filtran en el listado por parámetro.
 * - Helpers del perfil, la barra fija y las cards.
 */

const LUMENTI_ESPECIALISTA_TAXONOMIAS = ['tipo_especialista', 'poblacion', 'que_trata', 'idioma', 'modalidad'];

add_filter('register_post_type_args', function (array $args, string $post_type): array {
    if ($post_type === 'especialista') {
        $args['rewrite'] = array_merge((array) ($args['rewrite'] ?? []), ['slug' => 'especialistas', 'with_front' => false]);
        $args['has_archive'] = 'especialistas';
    }
    return $args;
}, 10, 2);

add_filter('register_taxonomy_args', function (array $args, string $taxonomy): array {
    if (in_array($taxonomy, LUMENTI_ESPECIALISTA_TAXONOMIAS, true)) {
        $args['publicly_queryable'] = false;
        $args['rewrite'] = false;
    }
    return $args;
}, 10, 2);

// Nombres de los términos de una taxonomía del post, en el orden en que se crearon.
function lumenti_especialista_terminos(string $taxonomy, $post = null): array
{
    $terms = get_the_terms($post ?? get_the_ID(), $taxonomy);
    if (!$terms || is_wp_error($terms)) {
        return [];
    }
    usort($terms, static fn($a, $b) => (int) $a->term_id <=> (int) $b->term_id);
    return $terms;
}

// URL de WhatsApp de paciente: "Hola, quisiera agendar una cita con la Dra./el Dr. {nombre}." (Acción de _shared.md).
function lumenti_especialista_whatsapp(string $nombre): string
{
    $nombre = trim($nombre);
    if ($nombre === '') {
        return lumenti_whatsapp_url('paciente');
    }
    $articulo = preg_match('/^Dra\.?\s/iu', $nombre) ? 'la ' : (preg_match('/^Dr\.?\s/iu', $nombre) ? 'el ' : '');
    return lumenti_whatsapp_url('paciente', sprintf(__('Hola, quisiera agendar una cita con %s.', 'lumenti'), $articulo . $nombre));
}

// URL del perfil de un especialista de la carga inicial, por su id ('mariela-linares'): la usan las cards fijas
// hasta wp-query. La URL real la arma WordPress con el nombre completo. Sin perfil, el listado.
function lumenti_especialista_url(string $seed_id): string
{
    static $cache = [];
    if (!isset($cache[$seed_id])) {
        $ids = post_type_exists('especialista') ? get_posts([
            'post_type'      => 'especialista',
            'posts_per_page' => 1,
            'fields'         => 'ids',
            'meta_key'       => '_lumenti_seed_id',
            'meta_value'     => $seed_id,
        ]) : [];
        $cache[$seed_id] = $ids ? (string) get_permalink((int) $ids[0]) : (string) get_post_type_archive_link('especialista');
    }
    return $cache[$seed_id];
}
