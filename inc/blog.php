<?php
defined('ABSPATH') || exit;

/*
 * Blog: lo propio de Lumenti que el JSON de wp-acf y el motor de wp-query no cubren (specs/blog.md, articulo.md).
 * - URLs: artículos en /blog/<slug>/ y categorías en /blog/categoria/<tema>/ (lumenti_blog_enlaces, una sola vez
 *   desde inc/carga-extra.php). Los tipos propios (especialista, condicion) quedan fuera de /blog/ (with_front false).
 * - El artículo destacado (blog_destacado_articulo, campo de inc/campos-extra.php) no se repite en la grilla del
 *   blog sin filtros: se muestra arriba.
 * - Datos de la card de blog (blog-card) desde una entrada: listado, destacado, relacionados e Inicio. El tiempo de
 *   lectura no es campo: sale del contenido (inc/helpers/lectura.php).
 */

const LUMENTI_BLOG_ESTRUCTURA = '/blog/%postname%/';

// Enlaces permanentes del blog. Solo si siguen en el valor por defecto (vacío o /%postname%/): no pisa un ajuste
// hecho a mano en Ajustes > Enlaces permanentes.
function lumenti_blog_enlaces(): void
{
    $actual = (string) get_option('permalink_structure');
    if (!in_array($actual, ['', '/%postname%/'], true)) {
        return;
    }
    global $wp_rewrite;
    $wp_rewrite->set_permalink_structure(LUMENTI_BLOG_ESTRUCTURA);
    if ((string) get_option('category_base') === '') {
        $wp_rewrite->set_category_base('categoria');
    }
    flush_rewrite_rules();
}

// ID del artículo destacado elegido en "Archivo de post" (0 si no hay o no está publicado).
function lumenti_blog_destacado_id(): int
{
    if (!function_exists('get_field')) {
        return 0;
    }
    $grupo = (array) (get_field('blog_destacado', 'option') ?: []);
    $id = (int) ($grupo['articulo'] ?? 0);
    return $id && get_post_status($id) === 'publish' && get_post_type($id) === 'post' ? $id : 0;
}

// ¿El listado tiene filtro o búsqueda en la URL? (?categoria=, ?q=)
function lumenti_blog_filtrado(): bool
{
    // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- filtros GET públicos.
    return !empty($_GET['categoria']) || !empty($_GET['q']);
}

// En el blog sin filtros, el destacado va arriba y no se repite en la grilla (como en el diseño).
add_action('pre_get_posts', function (WP_Query $query): void {
    if (is_admin() || !$query->is_main_query() || !$query->is_home() || lumenti_blog_filtrado()) {
        return;
    }
    $destacado = lumenti_blog_destacado_id();
    if ($destacado) {
        $query->set('post__not_in', array_merge((array) $query->get('post__not_in'), [$destacado]));
    }
}, 20);

// Minutos de lectura de una entrada, calculados del contenido (lumenti_reading_time, inc/helpers/lectura.php).
function lumenti_blog_lectura($post = null): int
{
    return lumenti_reading_time($post);
}

// Bajada de una entrada: el campo; si está vacío, el extracto.
function lumenti_blog_bajada($post = null): string
{
    $post = get_post($post);
    if (!$post) {
        return '';
    }
    $grupo = function_exists('get_field') ? (array) (get_field('articulo_cabecera', $post->ID) ?: []) : [];
    $bajada = trim((string) ($grupo['bajada'] ?? ''));
    return $bajada !== '' ? $bajada : trim((string) get_the_excerpt($post));
}

// Primera categoría de una entrada, o null.
function lumenti_blog_categoria($post = null): ?WP_Term
{
    $terms = get_the_category(get_post($post)->ID ?? 0);
    return $terms ? $terms[0] : null;
}

// $args de template-parts/components/blog-card.php para una entrada. variante: '' (compacta, Inicio) | listing.
function lumenti_blog_card_args($post = null, string $variante = 'listing'): array
{
    $post = get_post($post);
    if (!$post) {
        return [];
    }
    $categoria = lumenti_blog_categoria($post);
    $nombre = $categoria ? $categoria->name : '';
    $args = [
        'titulo'    => get_the_title($post),
        'url'       => (string) get_permalink($post),
        'imagen'    => has_post_thumbnail($post) ? (int) get_post_thumbnail_id($post) : '',
        'categoria' => $variante === 'listing' ? $nombre : mb_strtoupper($nombre, 'UTF-8'),
        'variante'  => $variante,
    ];
    if ($variante === 'listing') {
        $args['lectura'] = lumenti_blog_lectura($post);
        $args['bajada'] = lumenti_blog_bajada($post);
    }
    return $args;
}

// Artículos del Inicio: los elegidos en "Artículos a mostrar" (home_blog_seleccion, inc/campos-extra.php), en ese
// orden; sin selección, los 4 más recientes.
function lumenti_blog_inicio(array $seleccion, int $cantidad = 4): array
{
    $ids = array_values(array_filter(array_map('intval', $seleccion)));
    $posts = $ids
        ? array_filter(array_map('get_post', $ids), static fn($p) => $p && $p->post_type === 'post' && $p->post_status === 'publish')
        : get_posts(['post_type' => 'post', 'posts_per_page' => $cantidad, 'ignore_sticky_posts' => true, 'no_found_rows' => true]);
    return array_values(array_filter(array_map(static fn($p) => lumenti_blog_card_args($p, ''), array_slice($posts, 0, $cantidad))));
}

// Relacionados de un artículo: los de su categoría (lumenti_query_related) y, si faltan, los más recientes.
function lumenti_blog_relacionados($post = null, int $cantidad = 3): array
{
    $post = get_post($post);
    if (!$post || !function_exists('lumenti_query_related')) {
        return [];
    }
    $query = lumenti_query_related($post, $cantidad);
    $posts = $query->posts;
    wp_reset_postdata();
    if (count($posts) < $cantidad) {
        $posts = array_merge($posts, get_posts([
            'post_type'           => 'post',
            'posts_per_page'      => $cantidad - count($posts),
            'post__not_in'        => array_merge([$post->ID], wp_list_pluck($posts, 'ID')),
            'ignore_sticky_posts' => true,
            'no_found_rows'       => true,
        ]));
    }
    return array_values(array_filter(array_map('lumenti_blog_card_args', $posts)));
}
