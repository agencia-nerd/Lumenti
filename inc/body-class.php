<?php
defined('ABSPATH') || exit;

// Clases del diseño en <body>: `lm-page lm-page--<página>` (el CSS de algunas plantillas depende de ellas).
function lumenti_body_class(array $classes): array
{
    $page = '';

    if (is_front_page()) {
        $page = 'home';
    } elseif (is_post_type_archive('especialista')) {
        $page = 'especialistas';
    } elseif (is_singular('especialista')) {
        $page = 'especialista';
    } elseif (is_singular('condicion')) {
        $page = 'condicion';
    } elseif (is_home() || is_category()) {
        $page = 'blog';
    } elseif (is_singular('post')) {
        $page = 'articulo';
    } elseif (is_page_template()) {
        // pages/template-<slug>.php → <slug>
        $page = preg_replace('#^pages/template-(.+)\.php$#', '$1', (string) get_page_template_slug());
    }

    $classes[] = 'lm-page';
    if ($page !== '') {
        $classes[] = 'lm-page--' . sanitize_html_class($page);
    }

    return $classes;
}
add_filter('body_class', 'lumenti_body_class');
