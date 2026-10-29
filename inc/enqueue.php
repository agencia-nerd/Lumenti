<?php
defined('ABSPATH') || exit;

// Fallback si el archivo `hot` está vacío.
const LUMENTI_VITE_DEV_SERVER = 'http://localhost:5173';
const LUMENTI_CSS_ENTRY = 'src/css/input.css';
const LUMENTI_JS_ENTRY = 'src/js/main.js';

function lumenti_hot_path()
{
    return get_template_directory() . '/hot';
}

function lumenti_manifest_path()
{
    return get_template_directory() . '/dist/manifest.json';
}

// Dev = entorno local + archivo `hot` (lo crea `pnpm dev`). Si no, producción.
// El chequeo de entorno evita servir assets de Vite si `hot` llega por error al servidor.
function lumenti_is_vite_dev()
{
    return in_array(wp_get_environment_type(), ['local', 'development'], true)
        && file_exists(lumenti_hot_path());
}

function lumenti_vite_dev_server()
{
    $url = trim((string) @file_get_contents(lumenti_hot_path()));

    return $url !== '' ? untrailingslashit($url) : LUMENTI_VITE_DEV_SERVER;
}

function lumenti_log($message)
{
    if (defined('WP_DEBUG') && WP_DEBUG) {
        error_log('[lumenti] ' . $message);
    }
}

// Devuelve el manifest como array, o null si falta o es inválido.
function lumenti_get_manifest()
{
    $path = lumenti_manifest_path();

    if (!file_exists($path)) {
        lumenti_log('dist/manifest.json no existe. Ejecuta `pnpm build`.');
        return null;
    }

    $manifest = wp_json_file_decode($path, ['associative' => true]);

    if (!is_array($manifest)) {
        lumenti_log('dist/manifest.json es inválido.');
        return null;
    }

    return $manifest;
}

function lumenti_enqueue_assets()
{
    if (lumenti_is_vite_dev()) {
        // DESARROLLO - HMR
        $server = lumenti_vite_dev_server();
        wp_enqueue_script('vite-client', $server . '/@vite/client', [], null);
        wp_enqueue_script('lumenti-js', $server . '/' . LUMENTI_JS_ENTRY, [], null, true);
        wp_enqueue_style('lumenti-css', $server . '/' . LUMENTI_CSS_ENTRY, [], null);
        return;
    }

    // PRODUCCIÓN
    $manifest = lumenti_get_manifest();
    if ($manifest === null) {
        return;
    }

    $dist_uri = get_template_directory_uri() . '/dist/';

    if (isset($manifest[LUMENTI_CSS_ENTRY]['file'])) {
        wp_enqueue_style('lumenti-css', $dist_uri . $manifest[LUMENTI_CSS_ENTRY]['file'], [], null);
    }

    if (isset($manifest[LUMENTI_JS_ENTRY]['file'])) {
        wp_enqueue_script('lumenti-js', $dist_uri . $manifest[LUMENTI_JS_ENTRY]['file'], [], null, true);
    }
}
add_action('wp_enqueue_scripts', 'lumenti_enqueue_assets');

// Vite emite ES modules: type="module" en dev y producción.
function lumenti_add_module_type($tag, $handle)
{
    if ($handle !== 'vite-client' && $handle !== 'lumenti-js') {
        return $tag;
    }

    // Solo <script src>, y solo si aún no tiene type.
    return preg_replace('/<script(?=\s[^>]*\ssrc=)(?![^>]*\stype=)/', '<script type="module"', $tag);
}
add_filter('script_loader_tag', 'lumenti_add_module_type', 10, 2);
