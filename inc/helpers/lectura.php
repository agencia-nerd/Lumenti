<?php
defined('ABSPATH') || exit;

/*
 * Tiempo de lectura de una entrada, calculado del contenido (helper propio de Lumenti, no del motor de wp-helper).
 * Cuenta las palabras del contenido sin HTML (los comentarios de bloque también se quitan) y las divide por $por_minuto (220 por defecto: con ese valor
 * coinciden 14 de los 15 artículos del diseño), redondeando hacia arriba. Devuelve 0 si la entrada no tiene texto.
 */
function lumenti_reading_time($post = null, int $por_minuto = 220): int
{
    $post = get_post($post);
    if (!$post || $por_minuto < 1) {
        return 0;
    }
    $texto = wp_strip_all_tags(strip_shortcodes((string) $post->post_content));
    $texto = html_entity_decode($texto, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $palabras = preg_match_all('/[\p{L}\p{N}]+(?:[\'’\-][\p{L}\p{N}]+)*/u', $texto);
    return $palabras ? (int) ceil($palabras / $por_minuto) : 0;
}
