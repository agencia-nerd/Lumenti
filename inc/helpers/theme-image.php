<?php
defined('ABSPATH') || exit;

/*
 * Helper local de Lumenti: imágenes que hoy son archivos del tema y mañana campos ACF.
 *
 *   echo lumenti_theme_image('assets/img/psiq-sombrero.webp', ['width' => 503, 'height' => 832, 'alt' => '…']);
 *   echo lumenti_theme_image(['ruta' => 'assets/img/x.webp', 'ancho' => 800, 'alto' => 500, 'alt' => '…'], ['class' => 'x']);
 *   echo lumenti_theme_image($campo_acf, ['class' => 'x', 'loading' => 'eager']);   // array, ID o URL → lumenti_image()
 *
 * $attrs: class, alt (null = el de la imagen), width, height (para archivos del tema), loading (lazy|eager),
 * fetchpriority (high|low|auto), size (para ACF). Devuelve el <img> escapado o ''.
 */

function lumenti_theme_image($image, array $attrs = []): string
{
    $attrs += [
        'class' => '',
        'alt' => null,
        'width' => 0,
        'height' => 0,
        'loading' => 'lazy',
        'fetchpriority' => '',
        'size' => 'full',
    ];

    // Archivo del tema: 'assets/img/x.webp' o ['ruta' => 'assets/img/x.webp', 'ancho', 'alto', 'alt'].
    $path = '';
    $alt = '';
    $width = (int) $attrs['width'];
    $height = (int) $attrs['height'];
    if (is_array($image) && isset($image['ruta'])) {
        $path = (string) $image['ruta'];
        $alt = (string) ($image['alt'] ?? '');
        $width = (int) ($image['ancho'] ?? $width);
        $height = (int) ($image['alto'] ?? $height);
    } elseif (is_string($image) && $image !== '' && !ctype_digit(trim($image)) && !preg_match('#^(https?:)?//#i', $image)) {
        $path = $image;
    }

    if ($path === '') {
        // Campo ACF (array o ID), adjunto o URL: lo resuelve el helper de imágenes.
        return lumenti_image($image, [
            'size' => (string) $attrs['size'],
            'class' => (string) $attrs['class'],
            'alt' => $attrs['alt'],
            'loading' => (string) $attrs['loading'],
            'fetchpriority' => (string) $attrs['fetchpriority'],
        ]);
    }

    $path = ltrim($path, '/');
    if (!is_readable(get_theme_file_path('/' . $path))) {
        return '';
    }

    $alt = $attrs['alt'] !== null ? (string) $attrs['alt'] : $alt;
    $loading = $attrs['loading'] === 'eager' ? 'eager' : 'lazy';
    $priority = in_array($attrs['fetchpriority'], ['high', 'low', 'auto'], true) ? $attrs['fetchpriority'] : '';

    $html = '<img';
    if ($attrs['class'] !== '') {
        $html .= ' class="' . esc_attr((string) $attrs['class']) . '"';
    }
    $html .= ' src="' . esc_url(get_theme_file_uri('/' . $path)) . '" alt="' . esc_attr($alt) . '"';
    if ($width > 0 && $height > 0) {
        $html .= ' width="' . $width . '" height="' . $height . '"';
    }
    $html .= ' loading="' . $loading . '" decoding="async"';
    if ($priority !== '') {
        $html .= ' fetchpriority="' . $priority . '"';
    }

    return $html . '>';
}
