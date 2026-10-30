<?php
defined('ABSPATH') || exit;

function lumenti_setup()
{
    load_theme_textdomain('lumenti', get_template_directory() . '/languages');

    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script']);

    // Las ubicaciones de menú las registra inc/acf/runner.php desde inc/acf/sitio.php.
    add_theme_support('custom-logo');
}
add_action('after_setup_theme', 'lumenti_setup');
