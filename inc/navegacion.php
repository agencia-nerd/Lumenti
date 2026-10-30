<?php
defined('ABSPATH') || exit;

/*
 * Ítem activo del menú principal (aria-current="page"). Las claves son las del diseño (data-lm-nav-key).
 * Cuando los menús pasen a ser menús de WordPress, lo resuelve wp_nav_menu.
 */
function lumenti_nav_key(): string
{
    if (is_front_page()) {
        return 'inicio';
    }
    if (is_post_type_archive('especialista') || is_singular('especialista')) {
        return 'especialistas';
    }
    if (is_singular('condicion')) {
        return 'tratamos';
    }
    if (is_home() || is_singular('post') || is_category() || is_tag()) {
        return 'blog';
    }
    if (is_page_template('pages/template-empresas.php')) {
        return 'empresas';
    }
    if (is_page_template(['pages/template-psiquiatria.php', 'pages/template-psicologia.php', 'pages/template-informes.php'])) {
        return 'servicios';
    }

    return '';
}

// Atributo aria-current para el enlace de la clave dada.
function lumenti_nav_current(string $key): string
{
    return lumenti_nav_key() === $key ? ' aria-current="page"' : '';
}
