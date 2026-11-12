<?php
defined('ABSPATH') || exit;

/*
 * Especialistas: lo propio de Lumenti que el JSON de wp-acf y el motor de wp-query no cubren
 * (specs/especialistas.md, especialista.md).
 * - URLs: listado en /especialistas/ y perfil en /especialistas/<nombre-completo>/ (wp-acf deja la clave del
 *   tipo, /especialista/). Después del primer cambio: Ajustes > Enlaces permanentes > Guardar.
 * - Las taxonomías del especialista no tienen archivo propio: se filtran en el listado por parámetro.
 * - Listado (wp-query): orden (psiquiatras primero, luego el de Especialistas > Ordenar, inc/especialistas-orden.php)
 *   y buscador ?q= por nombre
 *   o condición, con los sinónimos de assets/data/sinonimos.json.
 * - Helpers del perfil, la barra fija, las cards y los carruseles.
 */

const LUMENTI_ESPECIALISTA_TAXONOMIAS = ['tipo_especialista', 'poblacion', 'que_trata', 'idioma', 'modalidad'];

add_filter('register_post_type_args', function (array $args, string $post_type): array {
    if ($post_type === 'especialista') {
        $args['rewrite'] = array_merge((array) ($args['rewrite'] ?? []), ['slug' => 'especialistas', 'with_front' => false]);
        $args['has_archive'] = 'especialistas';
        $args['menu_icon'] = 'dashicons-businessperson';
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

// URL de WhatsApp de la central de citas: "Hola, quisiera agendar una cita con la Dra./el Dr. {nombre}." (Acción de _shared.md).
function lumenti_especialista_whatsapp(string $nombre): string
{
    $nombre = trim($nombre);
    if ($nombre === '') {
        return lumenti_whatsapp_url('citas');
    }
    $articulo = preg_match('/^Dra\.?\s/iu', $nombre) ? 'la ' : (preg_match('/^Dr\.?\s/iu', $nombre) ? 'el ' : '');
    return lumenti_whatsapp_url('citas', sprintf(__('Hola, quisiera agendar una cita con %s.', 'lumenti'), $articulo . $nombre));
}

// ---------- Orden ----------

// Posición de cada término de tipo_especialista (el primero creado, Psiquiatras, va primero).
function lumenti_especialistas_tipo_posicion(): array
{
    static $posicion = null;
    if ($posicion === null) {
        $ids = get_terms(['taxonomy' => 'tipo_especialista', 'hide_empty' => false, 'orderby' => 'term_id', 'fields' => 'ids']);
        $posicion = is_array($ids) ? array_flip(array_map('intval', $ids)) : [];
    }
    return $posicion;
}

// Posición del tipo de un especialista (la del primer término creado que tenga; sin tipo, al final).
function lumenti_especialista_tipo_orden(int $post_id): int
{
    $posicion = lumenti_especialistas_tipo_posicion();
    $tipos = wp_get_post_terms($post_id, 'tipo_especialista', ['fields' => 'ids']);
    $tipo = PHP_INT_MAX;
    foreach (is_array($tipos) ? $tipos : [] as $id) {
        $tipo = min($tipo, $posicion[(int) $id] ?? PHP_INT_MAX);
    }
    return $tipo;
}

// Ordena especialistas (carruseles, sin paginar): por tipo (psiquiatras primero), luego el orden de
// Especialistas > Ordenar (menu_order; 0 = sin orden, al final) y nombre. Es el mismo orden que el SQL del listado.
function lumenti_especialistas_ordenar(array $posts): array
{
    $clave = [];
    foreach ($posts as $post) {
        $post = get_post($post);
        if (!$post) {
            continue;
        }
        $orden = (int) $post->menu_order > 0 ? (int) $post->menu_order : PHP_INT_MAX;
        $clave[$post->ID] = [lumenti_especialista_tipo_orden($post->ID), $orden, mb_strtolower($post->post_title, 'UTF-8')];
    }
    usort($posts, static function ($a, $b) use ($clave) {
        return ($clave[get_post($a)->ID] ?? []) <=> ($clave[get_post($b)->ID] ?? []);
    });
    return $posts;
}

// El listado pagina de a 20 ("Ver más"): el mismo orden va en el SQL para que cada tanda siga a la anterior.
// Tipo (el primer término creado de tipo_especialista primero), menu_order (0 = sin orden, al final) y título.
// También lo usa la lista del admin (inc/especialistas-orden.php).
function lumenti_especialistas_orderby_sql(): string
{
    global $wpdb;
    $tipo = "(SELECT MIN(tt.term_id) FROM {$wpdb->term_relationships} tr"
        . " INNER JOIN {$wpdb->term_taxonomy} tt ON tt.term_taxonomy_id = tr.term_taxonomy_id"
        . " WHERE tr.object_id = {$wpdb->posts}.ID AND tt.taxonomy = 'tipo_especialista')";
    $orden = "{$wpdb->posts}.menu_order";
    return "{$tipo} IS NULL, {$tipo} ASC, {$orden} = 0, {$orden} ASC, {$wpdb->posts}.post_title ASC";
}

add_filter('posts_orderby', function (string $orderby, WP_Query $query): string {
    if (is_admin() || !$query->is_main_query() || !$query->is_post_type_archive('especialista')) {
        return $orderby;
    }
    return lumenti_especialistas_orderby_sql();
}, 10, 2);

// ---------- Buscador ----------

function lumenti_especialistas_normalizar(string $texto): string
{
    return mb_strtolower(remove_accents(trim($texto)), 'UTF-8');
}

// Términos de que_trata que coinciden con el texto: por su nombre o por los sinónimos de assets/data/sinonimos.json.
function lumenti_especialistas_condiciones_buscadas(string $texto): array
{
    $nq = lumenti_especialistas_normalizar($texto);
    if (mb_strlen($nq) < 3) {
        return [];
    }
    $nombres = [];
    $datos = wp_json_file_decode(get_theme_file_path('/assets/data/sinonimos.json'), ['associative' => true]);
    foreach ((array) ($datos['grupos'] ?? []) as $grupo) {
        $hit = str_contains(lumenti_especialistas_normalizar((string) ($grupo['grupo'] ?? '')), $nq);
        foreach ((array) ($grupo['palabras'] ?? []) as $palabra) {
            $nw = lumenti_especialistas_normalizar((string) $palabra);
            if ($nw !== '' && (str_contains($nw, $nq) || str_contains($nq, $nw))) {
                $hit = true;
                break;
            }
        }
        if ($hit) {
            $nombres = array_merge($nombres, array_map('strval', (array) ($grupo['que_trata'] ?? [])));
        }
    }
    $ids = [];
    $terms = get_terms(['taxonomy' => 'que_trata', 'hide_empty' => false]);
    foreach (is_array($terms) ? $terms : [] as $term) {
        if (in_array($term->name, $nombres, true) || str_contains(lumenti_especialistas_normalizar($term->name), $nq)) {
            $ids[] = (int) $term->term_id;
        }
    }
    return $ids;
}

/*
 * ?q= busca por nombre del especialista o por condición (con sinónimos). El motor lo pasa a `s`, que busca en
 * título y contenido; aquí se cambia por los IDs que coinciden. Los demás filtros siguen sumándose con Y.
 */
add_action('pre_get_posts', function (WP_Query $query) {
    if (is_admin() || !$query->is_main_query() || !$query->is_post_type_archive('especialista')) {
        return;
    }
    $texto = (string) $query->get('s');
    if ($texto === '') {
        return;
    }
    $ids = get_posts([
        'post_type'      => 'especialista',
        'posts_per_page' => -1,
        'fields'         => 'ids',
        's'              => $texto,
        'search_columns' => ['post_title'],
    ]);
    $condiciones = lumenti_especialistas_condiciones_buscadas($texto);
    if ($condiciones) {
        $ids = array_merge($ids, get_posts([
            'post_type'      => 'especialista',
            'posts_per_page' => -1,
            'fields'         => 'ids',
            'tax_query'      => [['taxonomy' => 'que_trata', 'field' => 'term_id', 'terms' => $condiciones]],
        ]));
    }
    $query->set('s', '');
    $query->set('post__in', $ids ? array_values(array_unique(array_map('intval', $ids))) : [0]);
}, 30);

// ---------- Datos para la vista ----------

// Opciones de un filtro de taxonomía de lumenti_query_filters(), en el orden en que se crearon los términos.
function lumenti_especialistas_opciones(?array $filtro, string $taxonomy): array
{
    if (!$filtro) {
        return [];
    }
    $opciones = (array) ($filtro['opciones'] ?? []);
    $orden = get_terms(['taxonomy' => $taxonomy, 'hide_empty' => false, 'orderby' => 'term_id', 'fields' => 'id=>slug']);
    if (is_array($orden)) {
        $posicion = array_flip(array_values($orden));
        usort($opciones, static fn($a, $b) => ($posicion[$a['valor']] ?? PHP_INT_MAX) <=> ($posicion[$b['valor']] ?? PHP_INT_MAX));
    }
    return $opciones;
}

// $args del componente especialista-card a partir de un especialista.
function lumenti_especialista_card_args($post = null): array
{
    $post = get_post($post);
    if (!$post) {
        return [];
    }
    $perfil = (array) (get_field('especialista_perfil', $post->ID) ?: []);
    $nombres = static fn(string $taxonomy) => wp_list_pluck(lumenti_especialista_terminos($taxonomy, $post), 'name');
    $tipo = lumenti_especialista_terminos('tipo_especialista', $post);
    $nombre = trim((string) ($perfil['nombre_corto'] ?? ''));

    return [
        'nombre'          => $nombre !== '' ? $nombre : get_the_title($post),
        'url'             => (string) get_permalink($post),
        'cargo'           => (string) ($perfil['cargo'] ?? ''),
        'cargo_destacado' => (string) ($perfil['cargo_destacado'] ?? ''),
        'foto'            => has_post_thumbnail($post) ? (int) get_post_thumbnail_id($post) : '',
        // data-tipo de la card (psiquiatra | psicologo): lo usan las pills del carrusel de Condición.
        'tipo'            => $tipo ? rtrim($tipo[0]->slug, 's') : '',
        'poblacion'       => $nombres('poblacion'),
        'atiende'         => $nombres('que_trata'),
        'idiomas'         => $nombres('idioma'),
    ];
}

/*
 * Cards de los carruseles (Psiquiatría, Psicología). $seleccion: IDs elegidos a mano en el campo "Especialistas a
 * mostrar" (inc/campos-extra.php), en ese orden; solo los publicados. Sin selección: todos los especialistas de un
 * tipo ('psiquiatras', 'psicologos'), en su orden.
 */
function lumenti_especialistas_cards(string $tipo = '', array $seleccion = []): array
{
    if (!post_type_exists('especialista')) {
        return [];
    }
    $seleccion = array_values(array_filter(array_map('intval', $seleccion)));
    if ($seleccion) {
        $posts = array_filter(array_map('get_post', $seleccion), static fn($p) => $p && $p->post_type === 'especialista' && $p->post_status === 'publish');
        return array_values(array_filter(array_map('lumenti_especialista_card_args', $posts)));
    }
    $args = ['post_type' => 'especialista', 'posts_per_page' => -1, 'no_found_rows' => true];
    if ($tipo !== '') {
        $args['tax_query'] = [['taxonomy' => 'tipo_especialista', 'field' => 'slug', 'terms' => $tipo]];
    }
    return array_values(array_filter(array_map('lumenti_especialista_card_args', lumenti_especialistas_ordenar(get_posts($args)))));
}
