<?php
defined('ABSPATH') || exit;

// Precarga la imagen principal del hero de la portada (LCP), como el <link rel="preload"> del diseño.
function lumenti_preload_hero()
{
    if (!is_front_page()) {
        return;
    }
    printf(
        '<link rel="preload" as="image" href="%s" fetchpriority="high">' . "\n",
        esc_url(get_theme_file_uri('assets/img/hero-integral.webp'))
    );
}
add_action('wp_head', 'lumenti_preload_hero', 2);
