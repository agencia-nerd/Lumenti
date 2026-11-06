<?php
defined('ABSPATH') || exit;

/*
 * reCAPTCHA v3 para los forms de wp-form (código propio de Lumenti: el motor inc/forms.php no se edita).
 * - Claves en wp-config.php: LUMENTI_RECAPTCHA_SITE_KEY y LUMENTI_RECAPTCHA_SECRET (opcional LUMENTI_RECAPTCHA_SCORE,
 *   0.5 por defecto). Sin las dos claves queda apagado y los forms funcionan sin reCAPTCHA.
 * - La vista del form imprime lumenti_recaptcha_attrs(); src/js/modules/recaptcha.js pide el token antes del envío
 *   y lo deja en la cookie `lumenti_recaptcha`, que viaja sola en el fetch del motor.
 * - Aquí se verifica con Google antes del motor (wp_ajax_lumenti_form_submit, prioridad 4).
 */

const LUMENTI_RECAPTCHA_FORMS = ['empresas'];
const LUMENTI_RECAPTCHA_COOKIE = 'lumenti_recaptcha';

function lumenti_recaptcha_enabled(): bool
{
    return defined('LUMENTI_RECAPTCHA_SITE_KEY') && defined('LUMENTI_RECAPTCHA_SECRET')
        && LUMENTI_RECAPTCHA_SITE_KEY !== '' && LUMENTI_RECAPTCHA_SECRET !== '';
}

function lumenti_recaptcha_applies(string $form_id): bool
{
    return lumenti_recaptcha_enabled() && in_array($form_id, LUMENTI_RECAPTCHA_FORMS, true);
}

// Atributo del <form>: la clave del sitio (pública) para recaptcha.js.
function lumenti_recaptcha_attrs(string $form_id): void
{
    if (lumenti_recaptcha_applies($form_id)) {
        echo ' data-lm-recaptcha="' . esc_attr(LUMENTI_RECAPTCHA_SITE_KEY) . '"';
    }
}

function lumenti_recaptcha_verify()
{
    $form_id = isset($_POST['form']) ? sanitize_key(wp_unslash($_POST['form'])) : '';
    if (!lumenti_recaptcha_applies($form_id)) {
        return;
    }

    $token = isset($_COOKIE[LUMENTI_RECAPTCHA_COOKIE]) ? sanitize_text_field(wp_unslash($_COOKIE[LUMENTI_RECAPTCHA_COOKIE])) : '';

    // El token de Google es de un solo uso: la cookie se borra siempre.
    if (!headers_sent()) {
        setcookie(LUMENTI_RECAPTCHA_COOKIE, '', [
            'expires'  => time() - HOUR_IN_SECONDS,
            'path'     => '/',
            'secure'   => is_ssl(),
            'samesite' => 'Strict',
        ]);
    }

    $error = static function (string $motivo) {
        lumenti_form_log('reCAPTCHA rechazado: ' . $motivo);
        lumenti_form_error('No pudimos verificar tu envío. Intenta de nuevo.', 403, ['code' => 'recaptcha']);
    };

    if ($token === '') {
        $error('sin token');
    }

    $response = wp_remote_post('https://www.google.com/recaptcha/api/siteverify', [
        'timeout' => 8,
        'body'    => array_filter([
            'secret'   => LUMENTI_RECAPTCHA_SECRET,
            'response' => $token,
            'remoteip' => lumenti_form_client_ip(),
        ]),
    ]);

    if (is_wp_error($response) || (int) wp_remote_retrieve_response_code($response) !== 200) {
        $error('Google no respondió (' . (is_wp_error($response) ? $response->get_error_message() : wp_remote_retrieve_response_code($response)) . ')');
    }

    $data = json_decode((string) wp_remote_retrieve_body($response), true);
    if (!is_array($data) || empty($data['success'])) {
        $error('token inválido (' . implode(', ', (array) ($data['error-codes'] ?? [])) . ')');
    }

    $minimo = defined('LUMENTI_RECAPTCHA_SCORE') ? (float) LUMENTI_RECAPTCHA_SCORE : 0.5;
    $score = (float) ($data['score'] ?? 0);

    if (($data['action'] ?? '') !== $form_id) {
        $error('acción distinta (' . sanitize_key((string) ($data['action'] ?? '')) . ')');
    }
    if ($score < $minimo) {
        $error(sprintf('puntaje %.1f menor a %.1f', $score, $minimo));
    }
}
add_action('wp_ajax_lumenti_form_submit', 'lumenti_recaptcha_verify', 4);
add_action('wp_ajax_nopriv_lumenti_form_submit', 'lumenti_recaptcha_verify', 4);
