<?php
defined('ABSPATH') || exit;

/*
 * Envíos guardados: extensiones propias de Lumenti sobre el módulo de wp-form (inc/forms-entries.php,
 * menú "Envíos" del admin). El módulo y el motor no se editan: todo va por hooks.
 *
 * 1. Pestañas en el listado: Todos | Empresas | Newsletter, con su cantidad.
 * 2. Newsletter sin repetidos: si el correo ya tiene una suscripción guardada (y su correo salió bien),
 *    el envío se rechaza con un error bajo el campo y no se mandan correos ni se guarda otro registro.
 *    Borrar ese envío en el admin lo da de baja: el correo puede volver a suscribirse.
 */

// Forms con pestaña en el listado de Envíos (id del form => nombre de la pestaña).
const LUMENTI_ENVIOS_FORMS = [
    'empresas'   => 'Empresas',
    'newsletter' => 'Newsletter',
];

/* ---------------------------------------------------------------------------
 * 1. Pestañas del listado
 * ------------------------------------------------------------------------ */

// Form elegido en la pestaña (?lm_form=…), o '' en "Todos".
function lumenti_envios_form_actual(): string
{
    $form = isset($_GET['lm_form']) ? sanitize_key(wp_unslash($_GET['lm_form'])) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- filtro de listado.

    return array_key_exists($form, LUMENTI_ENVIOS_FORMS) ? $form : '';
}

function lumenti_envios_contar(string $form): int
{
    $q = new WP_Query([
        'post_type'      => LUMENTI_ENTRY_TYPE,
        'post_status'    => ['private', 'publish'],
        'meta_key'       => '_lumenti_form',
        'meta_value'     => $form,
        'fields'         => 'ids',
        'posts_per_page' => 1,
    ]);

    return (int) $q->found_posts;
}

add_filter('views_edit-' . (defined('LUMENTI_ENTRY_TYPE') ? LUMENTI_ENTRY_TYPE : 'lumenti_envio'), function (array $views) {
    $actual = lumenti_envios_form_actual();
    if ($actual !== '') {
        // Con una pestaña de form elegida, "Todos" deja de estar marcado.
        $views = array_map(static fn($v) => str_replace(['class="current"', 'aria-current="page"'], '', (string) $v), $views);
    }

    $base = admin_url('edit.php?post_type=' . LUMENTI_ENTRY_TYPE);
    $tabs = [];
    foreach (LUMENTI_ENVIOS_FORMS as $form => $nombre) {
        $activa = $actual === $form;
        $tabs['lm_' . $form] = sprintf(
            '<a href="%s"%s>%s <span class="count">(%d)</span></a>',
            esc_url(add_query_arg('lm_form', $form, $base)),
            $activa ? ' class="current" aria-current="page"' : '',
            esc_html($nombre),
            lumenti_envios_contar($form)
        );
    }

    // Las pestañas de los forms van después de "Todos".
    $todos = isset($views['all']) ? ['all' => $views['all']] : [];
    unset($views['all']);

    return $todos + $tabs + $views;
});

add_action('pre_get_posts', function (WP_Query $q) {
    if (!is_admin() || !$q->is_main_query() || !defined('LUMENTI_ENTRY_TYPE') || $q->get('post_type') !== LUMENTI_ENTRY_TYPE) {
        return;
    }
    $form = lumenti_envios_form_actual();
    if ($form !== '') {
        $q->set('meta_query', [['key' => '_lumenti_form', 'value' => $form]]);
    }
});

/* ---------------------------------------------------------------------------
 * 2. Newsletter: un correo ya suscrito no se vuelve a suscribir
 * ------------------------------------------------------------------------ */

// ¿Hay una suscripción guardada con este correo y su correo de aviso salió bien?
// Un intento que falló al enviar no cuenta (la persona puede reintentar).
function lumenti_newsletter_suscrito(string $correo): bool
{
    if (!defined('LUMENTI_ENTRY_TYPE') || $correo === '') {
        return false;
    }

    return (bool) get_posts([
        'post_type'      => LUMENTI_ENTRY_TYPE,
        'post_status'    => ['private', 'publish'],
        'fields'         => 'ids',
        'posts_per_page' => 1,
        'no_found_rows'  => true,
        'meta_query'     => [
            ['key' => '_lumenti_form', 'value' => 'newsletter'],
            ['key' => '_lumenti_email', 'value' => strtolower($correo)],
            ['key' => '_lumenti_status', 'value' => 'sent'],
        ],
    ]);
}

/*
 * Corre antes que el motor (prioridad 6; el motor va en 10 y forms-extras.php en 5).
 * Solo responde si el envío ya pasó las protecciones del motor (nonce, honeypot, token de tiempo): así no
 * sirve para averiguar en masa qué correos están suscritos. Si alguna falla, sigue el motor y responde él.
 */
function lumenti_newsletter_rechazar_repetido()
{
    $form_id = isset($_POST['form']) ? sanitize_key(wp_unslash($_POST['form'])) : '';
    if ($form_id !== 'newsletter') {
        return;
    }
    if (!check_ajax_referer(LUMENTI_FORM_NONCE, 'nonce', false) || !empty($_POST[LUMENTI_FORM_HONEYPOT])) {
        return;
    }
    $token = isset($_POST['token']) ? sanitize_text_field(wp_unslash($_POST['token'])) : '';
    if (lumenti_form_check_token($token) !== 'ok') {
        return;
    }

    $correo = isset($_POST['email']) ? sanitize_email(wp_unslash($_POST['email'])) : '';
    if (!is_email($correo) || !lumenti_newsletter_suscrito($correo)) {
        return;
    }

    // Mismo formato que los errores de campo del motor: form.js lo muestra bajo el correo.
    wp_send_json_error([
        'message' => 'Revisa los campos marcados.',
        'fields'  => ['email' => 'Este correo ya está suscrito al newsletter.'],
    ], 422);
}
add_action('wp_ajax_lumenti_form_submit', 'lumenti_newsletter_rechazar_repetido', 6);
add_action('wp_ajax_nopriv_lumenti_form_submit', 'lumenti_newsletter_rechazar_repetido', 6);
