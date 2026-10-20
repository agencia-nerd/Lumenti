<?php
defined('ABSPATH') || exit;

/*
 * "Ajustes del sitio" (ACF Pro): datos globales que usan la navbar, el footer y el botón
 * flotante. La página se registra aquí; sus campos viven en acf-json/group_lumenti_ajustes.json
 * y se editan en ACF → Grupos de campos. Sin ACF activo el sitio no se rompe: los helpers
 * devuelven vacío y cada elemento sin dato no se imprime.
 */

// Nombres visibles de las redes; las claves deben coincidir con las opciones del campo "red".
const LUMENTI_REDES = [
    'instagram' => 'Instagram',
    'facebook'  => 'Facebook',
    'linkedin'  => 'LinkedIn',
    'tiktok'    => 'TikTok',
    'x'         => 'X',
    'youtube'   => 'YouTube',
];

// ACF guarda y lee los grupos de campos como JSON en el tema (viajan con él).
function lumenti_acf_json_dir(): string
{
    return get_theme_file_path('/acf-json');
}
add_filter('acf/settings/save_json', 'lumenti_acf_json_dir');
add_filter('acf/settings/load_json', static fn(array $paths): array => [lumenti_acf_json_dir()]);

function lumenti_ajustes_registrar()
{
    if (!function_exists('acf_add_options_page')) {
        return;
    }

    acf_add_options_page([
        'page_title' => __('Ajustes del sitio', 'lumenti'),
        'menu_title' => __('Ajustes del sitio', 'lumenti'),
        'menu_slug'  => 'lumenti-ajustes',
        'capability' => 'edit_theme_options',
        'icon_url'   => 'dashicons-admin-site-alt3',
        'position'   => 59,
        'redirect'   => false,
    ]);
}
add_action('acf/init', 'lumenti_ajustes_registrar');

// Valor de un ajuste, o null si ACF no está activo o el campo está vacío.
function lumenti_ajuste(string $name)
{
    if (!function_exists('get_field')) {
        return null;
    }
    $value = get_field($name, 'option');

    return ($value === '' || $value === false || $value === []) ? null : $value;
}

// https://wa.me/<número>[?text=…], o '' si no hay número.
function lumenti_whatsapp_url(): string
{
    $digits = preg_replace('/\D/', '', (string) lumenti_ajuste('whatsapp_numero'));
    if ($digits === '') {
        return '';
    }

    $message = trim((string) lumenti_ajuste('whatsapp_mensaje'));

    return 'https://wa.me/' . $digits . ($message !== '' ? '?text=' . rawurlencode($message) : '');
}

// Redes con enlace: [['red' => 'instagram', 'nombre' => 'Instagram', 'url' => …], …].
function lumenti_redes(): array
{
    $redes = [];
    foreach ((array) lumenti_ajuste('redes') as $row) {
        $red = (string) ($row['red'] ?? '');
        $url = trim((string) ($row['url'] ?? ''));
        if ($url !== '' && isset(LUMENTI_REDES[$red])) {
            $redes[] = ['red' => $red, 'nombre' => LUMENTI_REDES[$red], 'url' => $url];
        }
    }

    return $redes;
}

function lumenti_copyright(): string
{
    return str_replace('{año}', wp_date('Y'), (string) lumenti_ajuste('footer_copyright'));
}
