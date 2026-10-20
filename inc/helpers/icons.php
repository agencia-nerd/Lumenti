<?php
defined('ABSPATH') || exit;

/**
 * Helper local del proyecto (no viene de la skill wp-helper).
 *
 * Imprime un ícono de `assets/icons/<nombre>.svg` como SVG inline, decorativo (aria-hidden)
 * y con el color del texto (fill="currentColor"). Ícono inexistente → ''.
 *
 *   <?= lumenti_icon('flecha', 'size-4') ?>
 */
function lumenti_icon(string $name, string $class = ''): string
{
    static $cache = [];

    if (!preg_match('/^[a-z0-9-]+$/', $name)) {
        return '';
    }

    if (!array_key_exists($name, $cache)) {
        $path = get_theme_file_path('/assets/icons/' . $name . '.svg');
        $cache[$name] = is_readable($path) ? trim((string) file_get_contents($path)) : '';
    }

    if ($cache[$name] === '') {
        return '';
    }

    $attrs = ' aria-hidden="true" focusable="false"';
    if ($class !== '') {
        $attrs .= ' class="' . esc_attr($class) . '"';
    }

    return preg_replace('/^<svg\b/', '<svg' . $attrs, $cache[$name], 1);
}
