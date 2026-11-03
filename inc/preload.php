<?php
defined('ABSPATH') || exit;

// Precarga la imagen del primer slide del hero de la portada (LCP): la misma que imprime
// template-parts/pages/home/hero.php (campo home_hero, tamaño 'large'), con su srcset y sizes para que el
// navegador elija el mismo archivo que el <img>. Sin imagen cargada no imprime nada.
function lumenti_preload_hero()
{
    if (!is_front_page() || !function_exists('get_field')) {
        return;
    }

    $hero = get_field('home_hero') ?: [];
    $slides = array_values((array) ($hero['slides'] ?? []));
    $data = lumenti_image_data($slides[0]['imagen'] ?? null, 'large');
    if (!$data || $data['url'] === '') {
        return;
    }

    $srcset = $data['id'] > 0 ? (string) wp_get_attachment_image_srcset($data['id'], 'large') : '';
    $sizes = $data['id'] > 0 ? (string) wp_get_attachment_image_sizes($data['id'], 'large') : '';

    printf(
        '<link rel="preload" as="image" href="%s"%s%s fetchpriority="high">' . "\n",
        esc_url($data['url']),
        $srcset !== '' ? ' imagesrcset="' . esc_attr($srcset) . '"' : '',
        $srcset !== '' && $sizes !== '' ? ' imagesizes="' . esc_attr($sizes) . '"' : ''
    );
}
add_action('wp_head', 'lumenti_preload_hero', 2);
