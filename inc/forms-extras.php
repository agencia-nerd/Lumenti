<?php
defined('ABSPATH') || exit;

/*
 * Extensiones de wp-form propias de Lumenti (el motor inc/forms.php no se edita).
 *
 * 1. Destinatarios desde "Ajustes del sitio": cada form lee su repeater de correos
 *    (specs/opciones.md → opciones_formularios_<form>_correos). Sin correos, el motor usa admin_email.
 * 2. Grupos de casillas (varias opciones, mínimo de marcadas): el motor solo conoce casillas sí/no,
 *    así que el grupo se guarda en un campo `text` oculto del motor (mismo key) que
 *    src/js/modules/form-extras.js llena con las opciones marcadas (`<key>[]`), separadas por " | ".
 *    El motor valida "requerido" en los dos lados; aquí se valida que cada opción sea de la lista.
 * 3. Patrones: una regex extra por campo (p. ej. celular que empieza con 9), validada en el servidor.
 *    Su error vuelve al campo con el mismo formato del motor (422 + fields).
 *
 * Se declaran por form con el filtro lumenti_form_extras:
 *   $extras['empresas'] = [
 *       'grupos'   => ['busca' => ['options' => ['taller' => 'Taller…'], 'min' => 1, 'message' => '…']],
 *       'patrones' => ['whatsapp' => ['regex' => '/^9/', 'message' => '…']],
 *   ];
 */

const LUMENTI_FORM_GROUP_SEPARATOR = ' | ';

// Correos del repeater del form en la página de opciones (ACF), o [] si aún no existe.
function lumenti_form_recipients(string $form_key): array
{
    if (!function_exists('get_field')) {
        return [];
    }
    $rows = get_field('opciones_formularios_' . $form_key . '_correos', 'option');
    if (!is_array($rows)) {
        return [];
    }

    return array_values(array_filter(array_map(
        static fn($row) => sanitize_email((string) ($row['correo'] ?? '')),
        $rows
    )));
}

function lumenti_form_extras(string $form_id): array
{
    $extras = apply_filters('lumenti_form_extras', []);

    return is_array($extras[$form_id] ?? null) ? $extras[$form_id] : [];
}

// Atributo data-lm-form-extras para el <form>: lo lee form-extras.js.
function lumenti_form_extras_attrs(string $form_id): void
{
    $extras = lumenti_form_extras($form_id);
    $grupos = [];
    foreach ((array) ($extras['grupos'] ?? []) as $key => $grupo) {
        $grupos[$key] = ['min' => (int) ($grupo['min'] ?? 1)];
    }
    printf(' data-lm-form-extras="%s"', esc_attr(wp_json_encode(['grupos' => $grupos, 'separador' => LUMENTI_FORM_GROUP_SEPARATOR])));
}

// Opciones de un grupo de casillas, para la vista.
function lumenti_form_group_options(string $form_id, string $key): array
{
    return (array) (lumenti_form_extras($form_id)['grupos'][$key]['options'] ?? []);
}

// Valida grupos y patrones antes que el motor (prioridad 5 < 10). Si hay errores responde como el motor.
function lumenti_form_extras_validate()
{
    $form_id = isset($_POST['form']) ? sanitize_key(wp_unslash($_POST['form'])) : '';
    $extras = lumenti_form_extras($form_id);
    if (!$extras) {
        return;
    }

    $errors = [];

    foreach ((array) ($extras['grupos'] ?? []) as $key => $grupo) {
        $raw = isset($_POST[$key]) ? trim(sanitize_text_field(wp_unslash($_POST[$key]))) : '';
        $chosen = $raw === '' ? [] : array_map('trim', explode(trim(LUMENTI_FORM_GROUP_SEPARATOR), $raw));
        $labels = array_values((array) ($grupo['options'] ?? []));
        $valid = !array_diff($chosen, $labels) && count(array_unique($chosen)) >= (int) ($grupo['min'] ?? 1);
        if (!$valid) {
            $errors[$key] = (string) ($grupo['message'] ?? 'Elige al menos una opción.');
        }
    }

    foreach ((array) ($extras['patrones'] ?? []) as $key => $patron) {
        $value = isset($_POST[$key]) ? trim(sanitize_text_field(wp_unslash($_POST[$key]))) : '';
        if ($value !== '' && !preg_match((string) $patron['regex'], $value)) {
            $errors[$key] = (string) ($patron['message'] ?? 'Revisa este campo.');
        }
    }

    if ($errors) {
        wp_send_json_error(['message' => 'Revisa los campos marcados.', 'fields' => $errors], 422);
    }
}
add_action('wp_ajax_lumenti_form_submit', 'lumenti_form_extras_validate', 5);
add_action('wp_ajax_nopriv_lumenti_form_submit', 'lumenti_form_extras_validate', 5);
