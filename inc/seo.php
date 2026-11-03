<?php
defined('ABSPATH') || exit;

/*
 * SEO (Yoast): meta descripción de especialistas, condiciones y artículos, cuyo resumen está en ACF.
 * Si en la caja de Yoast del post no se escribió una, sale del campo que pide el spec, sin HTML ni marcadores
 * de color y recortada en ~155 caracteres:
 * - Especialista: el inicio de la biografía, especialista_sobre_biografia (specs/especialista.md).
 * - Condición: la bajada del hero, condicion_hero_bajada (specs/condicion.md).
 * - Artículo: la bajada, articulo_cabecera_bajada; si está vacía, el extracto o el inicio del contenido
 *   (specs/articulo.md).
 * En Yoast > Ajustes > Tipos de contenido, la meta description de estos tipos se deja vacía.
 */

const LUMENTI_SEO_DESCRIPCION_CAMPOS = [
    'especialista' => ['especialista_sobre', 'biografia'],
    'condicion'    => ['condicion_hero', 'bajada'],
    'post'         => ['articulo_cabecera', 'bajada'],
];

// Texto plano de un campo ACF del post actual para la meta descripción, o '' si no aplica.
function lumenti_seo_descripcion_acf(): string
{
    if (!function_exists('get_field') || !is_singular(array_keys(LUMENTI_SEO_DESCRIPCION_CAMPOS))) {
        return '';
    }

    [$grupo, $campo] = LUMENTI_SEO_DESCRIPCION_CAMPOS[get_post_type()];
    $valores = get_field($grupo, get_queried_object_id());
    $texto = is_array($valores) ? (string) ($valores[$campo] ?? '') : '';
    if (trim($texto) === '' && get_post_type() === 'post') {
        $texto = get_the_excerpt(get_queried_object_id()); // extracto escrito o el inicio del contenido
    }

    // Sin HTML, sin marcadores de color (el helper los convierte en etiquetas) y en una sola línea.
    $texto = wp_strip_all_tags(lumenti_highlight(wp_strip_all_tags($texto)), true);
    $texto = html_entity_decode($texto, ENT_QUOTES, 'UTF-8');

    return lumenti_seo_recortar($texto);
}

// Recorta en el último espacio antes del límite y agrega "…".
function lumenti_seo_recortar(string $texto, int $limite = 155): string
{
    $texto = trim(preg_replace('/\s+/u', ' ', $texto));
    if (mb_strlen($texto) <= $limite) {
        return $texto;
    }
    $corte = mb_substr($texto, 0, $limite - 1);
    $espacio = mb_strrpos($corte, ' ');

    return rtrim($espacio ? mb_substr($corte, 0, $espacio) : $corte, ' ,.;:') . '…';
}

// Solo cuando Yoast no tiene una descripción propia para ese post.
function lumenti_seo_descripcion_respaldo($descripcion)
{
    return trim((string) $descripcion) === '' ? lumenti_seo_descripcion_acf() : $descripcion;
}
add_filter('wpseo_metadesc', 'lumenti_seo_descripcion_respaldo');
add_filter('wpseo_opengraph_desc', 'lumenti_seo_descripcion_respaldo');
add_filter('wpseo_twitter_description', 'lumenti_seo_descripcion_respaldo');
