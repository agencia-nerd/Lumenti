<?php
defined('ABSPATH') || exit;

/*
 * Página 404 (404.php): las páginas a las que se ofrece seguir. Cada URL se busca por su plantilla, así que si una
 * página cambia de dirección el enlace se actualiza solo; si una no existe o no está publicada, no se muestra.
 */

// URL de la primera página publicada con esa plantilla, o '' si no hay ninguna.
function lumenti_url_plantilla(string $plantilla): string
{
    $ids = get_posts([
        'post_type'      => 'page',
        'post_status'    => 'publish',
        'meta_key'       => '_wp_page_template',
        'meta_value'     => $plantilla,
        'fields'         => 'ids',
        'posts_per_page' => 1,
        'no_found_rows'  => true,
    ]);

    return $ids ? (string) get_permalink($ids[0]) : '';
}

// Accesos de la 404: [['titulo', 'texto', 'url']], solo los que tienen URL.
function lumenti_404_enlaces(): array
{
    $blog = (int) get_option('page_for_posts');

    $enlaces = [
        [
            'titulo' => __('Psiquiatría', 'lumenti'),
            'texto'  => __('Cuándo consultar y cómo es una cita.', 'lumenti'),
            'url'    => lumenti_url_plantilla('pages/template-psiquiatria.php'),
        ],
        [
            'titulo' => __('Psicología', 'lumenti'),
            'texto'  => __('Psicoterapia y evaluaciones psicológicas.', 'lumenti'),
            'url'    => lumenti_url_plantilla('pages/template-psicologia.php'),
        ],
        [
            'titulo' => __('Especialistas', 'lumenti'),
            'texto'  => __('Conoce al equipo y agenda con quien prefieras.', 'lumenti'),
            'url'    => (string) get_post_type_archive_link('especialista'),
        ],
        [
            'titulo' => __('Informes y certificados', 'lumenti'),
            'texto'  => __('Qué documentos emitimos y cómo pedirlos.', 'lumenti'),
            'url'    => lumenti_url_plantilla('pages/template-informes.php'),
        ],
        [
            'titulo' => __('Blog', 'lumenti'),
            'texto'  => __('Artículos sobre salud mental y bienestar.', 'lumenti'),
            'url'    => $blog ? (string) get_permalink($blog) : '',
        ],
        [
            'titulo' => __('Preguntas frecuentes', 'lumenti'),
            'texto'  => __('Dudas sobre las citas, la atención y el tratamiento.', 'lumenti'),
            'url'    => lumenti_url_plantilla('pages/template-faq.php'),
        ],
    ];

    return array_values(array_filter($enlaces, static fn($e) => $e['url'] !== ''));
}
