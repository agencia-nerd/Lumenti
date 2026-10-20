<?php
defined('ABSPATH') || exit;

function lumenti_setup()
{
    load_theme_textdomain('lumenti', get_template_directory() . '/languages');

    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script']);

    // Logo de la navbar (versión oscura). Apariencia → Personalizar → Identidad del sitio.
    add_theme_support('custom-logo', [
        'width'       => 332,
        'height'      => 53,
        'flex-width'  => true,
        'flex-height' => true,
    ]);

    register_nav_menus([
        'primary'          => __('Menú principal', 'lumenti'),
        'footer-servicios' => __('Footer: columna Servicios', 'lumenti'),
        'footer-explora'   => __('Footer: columna Explora', 'lumenti'),
        'legal'            => __('Footer: enlaces legales', 'lumenti'),
    ]);
}
add_action('after_setup_theme', 'lumenti_setup');
