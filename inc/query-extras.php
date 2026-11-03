<?php
defined('ABSPATH') || exit;

/*
 * Ajustes del proyecto sobre el motor de wp-query (inc/query/motor.php, que no se edita).
 * - Título de la pestaña al filtrar sin recargar: el motor manda wp_get_document_title() en el JSON y
 *   src/js/modules/query.js lo pone en document.title, que no interpreta entidades HTML ("Blog &#8211; Lumenti").
 *   Solo en ese pedido (X-WP-Query: 1) el título va decodificado. Cubre el título de WordPress (document_title) y
 *   el de un plugin de SEO como Yoast (pre_get_document_title, que lo reemplaza antes); la página normal no cambia.
 */

function lumenti_query_titulo_plano(string $titulo): string
{
    if ($titulo === '' || !function_exists('lumenti_query_is_partial') || !lumenti_query_is_partial()) {
        return $titulo;
    }
    return html_entity_decode($titulo, ENT_QUOTES | ENT_HTML5, 'UTF-8');
}
add_filter('document_title', 'lumenti_query_titulo_plano', PHP_INT_MAX);
add_filter('pre_get_document_title', static fn($titulo) => lumenti_query_titulo_plano((string) $titulo), PHP_INT_MAX);
