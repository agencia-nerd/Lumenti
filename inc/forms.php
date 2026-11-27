<?php
defined('ABSPATH') || exit;

/*
 * Motor de formularios (skill wp-form).
 * Versión del motor: 1.7.0
 *
 * Cada formulario se define una sola vez en `inc/forms/<id>.php` con el filtro
 * `lumenti_forms`. De esa definición salen las tres capas:
 *   - HTML: atributos de cada campo (lumenti_field_attrs).
 *   - JS:   las reglas viajan en data-rules y el módulo arma el esquema Zod.
 *   - PHP:  validación, sanitizado y envío (lumenti_form_submit).
 * Así front y back comparten reglas y mensajes: un cambio en la definición cambia todo.
 * Donde las librerías no son idénticas, el servidor manda: su error vuelve al campo (422).
 * tests/ en la skill compara ambos lados con los mismos casos.
 *
 * Este archivo no se edita por proyecto. Lo propio de cada form va en inc/forms/.
 */

const LUMENTI_FORM_NONCE = 'lumenti_form';
const LUMENTI_FORM_MIN_SECONDS = 3;          // Tiempo mínimo entre ver el form y enviarlo.
const LUMENTI_FORM_TOKEN_MAX_AGE = 12 * HOUR_IN_SECONDS;
const LUMENTI_FORM_RATE_WINDOW = HOUR_IN_SECONDS;
const LUMENTI_FORM_DUPLICATE_WINDOW = 2 * MINUTE_IN_SECONDS;
// Nombre poco reconocible a propósito: los autocompletadores rellenan campos como
// "website" o "url", y un humano con autocompletado perdería su envío.
const LUMENTI_FORM_HONEYPOT = 'lumenti_hp';
// Claves que el motor usa en el POST; ningún campo puede llamarse así.
const LUMENTI_FORM_RESERVED = ['action', 'form', 'nonce', 'token', LUMENTI_FORM_HONEYPOT];

// Definiciones de cada form y módulo opcional de envíos guardados.
(function () {
    foreach (glob(get_theme_file_path('/inc/forms/*.php')) ?: [] as $file) {
        require_once $file;
    }

    if (file_exists(get_theme_file_path('/inc/forms-entries.php'))) {
        require_once get_theme_file_path('/inc/forms-entries.php');
    }
})();

/* -------------------------------------------------------------------------
 * Definiciones
 * ---------------------------------------------------------------------- */

// Devuelve la definición normalizada de un form, o null si no existe.
function lumenti_get_form($form_id)
{
    static $cache = [];

    $form_id = (string) $form_id;
    if (array_key_exists($form_id, $cache)) {
        return $cache[$form_id];
    }

    $forms = apply_filters('lumenti_forms', []);
    if (!isset($forms[$form_id]) || !is_array($forms[$form_id])) {
        return $cache[$form_id] = null;
    }

    $form = wp_parse_args($forms[$form_id], [
        'title'      => $form_id,
        'subject'    => 'Nuevo mensaje desde la web',
        'to'         => [],
        'reply_to'   => '',
        'store'      => 'none',   // none | all | failed
        'redirect'   => '',       // URL de la página de gracias; vacío = mensaje en el form
        'success'    => 'Gracias, recibimos tu mensaje. Te responderemos pronto.',
        'rate_limit' => 10,       // Envíos por IP por hora.
        'fields'     => [],
    ]);

    $fields = [];
    foreach ((array) $form['fields'] as $key => $field) {
        $key = (string) $key;
        if (in_array($key, LUMENTI_FORM_RESERVED, true)) {
            lumenti_form_log("El campo \"$key\" del form \"$form_id\" usa una clave reservada y se ignora.");
            continue;
        }
        $fields[$key] = lumenti_normalize_field((array) $field);
    }
    $form['id'] = $form_id;
    $form['fields'] = $fields;

    return $cache[$form_id] = $form;
}

// Completa una definición de campo con los valores y mensajes por defecto de su tipo.
function lumenti_normalize_field(array $field)
{
    $type = $field['type'] ?? 'text';

    $defaults = [
        'text'     => ['min' => 0, 'max' => 150, 'invalid' => 'No se permiten los caracteres < ni >.'],
        'name'     => ['min' => 2, 'max' => 100, 'invalid' => 'Solo se permiten letras, espacios, punto, apóstrofe y guion.', 'autocomplete' => 'name'],
        'email'    => ['min' => 0, 'max' => 254, 'invalid' => 'Ingresa un correo electrónico válido.', 'autocomplete' => 'email'],
        'phone'    => ['min' => 0, 'max' => 20, 'min_digits' => 7, 'max_digits' => 15, 'autocomplete' => 'tel'],
        'digits'   => ['min' => 0, 'max' => 20, 'invalid' => 'Solo se permiten números.'],
        'textarea' => ['min' => 0, 'max' => 1000, 'invalid' => 'Solo se permiten letras, números y los signos . , ; : ¿ ? ¡ ! ( ) - " \' @ / % + # * _ $'],
        'select'   => ['invalid' => 'Elige una opción válida.'],
        'radio'    => ['invalid' => 'Elige una opción válida.'],
        'checkbox' => [],
        // Varias opciones: min y max cuentan opciones marcadas; max 0 = sin límite.
        'checkboxes' => ['min' => 0, 'max' => 0, 'invalid' => 'Elige una opción válida.'],
        'consent'  => ['required' => true],
    ];

    if (!isset($defaults[$type])) {
        lumenti_form_log("Tipo de campo desconocido \"$type\"; se usa text.");
        $type = 'text';
    }

    $field = wp_parse_args($field, $defaults[$type] + [
        'label'        => '',
        'required'     => false,
        'options'      => [],
        'autocomplete' => '',
        'messages'     => [],
    ]);
    $field['type'] = $type;

    if ($type === 'phone') {
        $field['invalid'] = sprintf('Ingresa un teléfono válido (%d a %d dígitos).', $field['min_digits'], $field['max_digits']);
    }

    $required = $type === 'consent'
        ? 'Debes aceptar la política de privacidad.'
        : (in_array($type, ['select', 'radio'], true) ? 'Elige una opción.' : 'Este campo es obligatorio.');

    // Mensajes finales: los mismos en PHP y en JS.
    $field['messages'] = wp_parse_args((array) $field['messages'], $type === 'checkboxes' ? [
        'required' => 'Elige al menos una opción.',
        'invalid'  => $field['invalid'],
        'min'      => sprintf((int) $field['min'] === 1 ? 'Elige al menos %d opción.' : 'Elige al menos %d opciones.', (int) $field['min']),
        'max'      => sprintf((int) $field['max'] === 1 ? 'Elige como máximo %d opción.' : 'Elige como máximo %d opciones.', (int) $field['max']),
    ] : [
        'required' => $required,
        'invalid'  => $field['invalid'] ?? 'Valor no válido.',
        'min'      => sprintf('Debe tener al menos %d caracteres.', (int) ($field['min'] ?? 0)),
        'max'      => sprintf('No puede superar %d caracteres.', (int) ($field['max'] ?? 0)),
    ]);
    unset($field['invalid']);

    return $field;
}

/* -------------------------------------------------------------------------
 * Helpers de HTML (las vistas en template-parts/forms/ los usan)
 * ---------------------------------------------------------------------- */

function lumenti_field_id($form_id, $key)
{
    return sanitize_html_class($form_id . '-' . $key);
}

// Regla de un campo tal como la recibe el JS (data-rules). La usa también tests/check.php.
function lumenti_field_rule(array $field)
{
    $rule = [
        'type'     => $field['type'],
        'required' => (bool) $field['required'],
        'messages' => $field['messages'],
    ];
    if (in_array($field['type'], ['text', 'name', 'email', 'phone', 'digits', 'textarea'], true)) {
        $rule['min'] = (int) $field['min'];
        $rule['max'] = (int) $field['max'];
    }
    if ($field['type'] === 'phone') {
        $rule['min_digits'] = (int) $field['min_digits'];
        $rule['max_digits'] = (int) $field['max_digits'];
    }
    if (in_array($field['type'], ['select', 'radio', 'checkboxes'], true)) {
        $rule['options'] = array_map('strval', array_keys((array) $field['options']));
    }
    if ($field['type'] === 'checkboxes') {
        $rule['min'] = (int) $field['min'];
        $rule['max'] = (int) $field['max'];
    }

    return $rule;
}

// Atributos del <form>: identificación, endpoint y reglas para Zod.
// method="post": si el JS no llegó a cargar, el navegador no pone los datos en la URL.
function lumenti_form_attrs($form_id)
{
    $form = lumenti_get_form($form_id);
    if (!$form) {
        lumenti_form_log("El form \"$form_id\" no está definido en inc/forms/.");
        return;
    }

    $rules = array_map('lumenti_field_rule', $form['fields']);

    printf(
        'id="%s" method="post" data-form="%s" data-ajax-url="%s" data-rules="%s" novalidate',
        esc_attr(sanitize_html_class($form_id)),
        esc_attr($form_id),
        esc_url(admin_url('admin-ajax.php')),
        esc_attr(wp_json_encode($rules))
    );
}

// Atributos de un input/textarea/select. Las clases las pone la vista (vienen de Figma).
// Para radios y checkboxes de varias opciones, pasa el valor de la opción en $option.
function lumenti_field_attrs($form_id, $key, $option = null)
{
    $form = lumenti_get_form($form_id);
    $field = $form['fields'][$key] ?? null;
    if (!$field) {
        lumenti_form_log("El campo \"$key\" no existe en el form \"$form_id\".");
        return;
    }

    $id = lumenti_field_id($form_id, $key);
    $attrs = ['name' => $key, 'aria-describedby' => $id . '-error'];

    switch ($field['type']) {
        case 'radio':
            $attrs['type'] = 'radio';
            $attrs['id'] = $id . '-' . sanitize_html_class((string) $option);
            $attrs['value'] = (string) $option;
            break;
        case 'checkboxes':
            // name[]: el navegador manda todas las marcadas como lista.
            $attrs['type'] = 'checkbox';
            $attrs['name'] = $key . '[]';
            $attrs['id'] = $id . '-' . sanitize_html_class((string) $option);
            $attrs['value'] = (string) $option;
            break;
        case 'checkbox':
        case 'consent':
            $attrs['type'] = 'checkbox';
            $attrs['id'] = $id;
            $attrs['value'] = '1';
            break;
        case 'select':
            $attrs['id'] = $id;
            break;
        default:
            $attrs['id'] = $id;
            $attrs['maxlength'] = (int) $field['max'];
            if ($field['type'] !== 'textarea') {
                $attrs['type'] = ['email' => 'email', 'phone' => 'tel'][$field['type']] ?? 'text';
            }
            if ($field['type'] === 'digits') {
                $attrs['inputmode'] = 'numeric';
            }
            if ($field['autocomplete'] !== '') {
                $attrs['autocomplete'] = $field['autocomplete'];
            }
    }

    $out = [];
    foreach ($attrs as $name => $value) {
        $out[] = sprintf('%s="%s"', $name, esc_attr((string) $value));
    }
    // En un grupo de checkboxes, "required" en cada casilla pediría marcarlas todas: el
    // obligatorio se marca en el legend y lo valida el módulo.
    if ($field['required'] && $field['type'] !== 'checkboxes') {
        $out[] = 'required';
    }

    echo implode(' ', $out);
}

// Opciones de un select, radio o checkboxes, desde la definición: [valor => etiqueta].
function lumenti_field_options($form_id, $key)
{
    $form = lumenti_get_form($form_id);

    return (array) ($form['fields'][$key]['options'] ?? []);
}

// Atributos del contenedor de error de un campo.
function lumenti_error_attrs($form_id, $key)
{
    printf(
        'id="%s" data-error-for="%s"',
        esc_attr(lumenti_field_id($form_id, $key) . '-error'),
        esc_attr($key)
    );
}

// Campo trampa: invisible para personas, los bots lo llenan.
function lumenti_form_honeypot()
{
    printf(
        '<div aria-hidden="true" style="position:absolute;left:-9999px;width:1px;height:1px;overflow:hidden;">'
        . '<label>No llenar este campo<input type="text" name="%s" tabindex="-1" autocomplete="off" data-1p-ignore data-lpignore="true" data-bwignore></label></div>',
        esc_attr(LUMENTI_FORM_HONEYPOT)
    );
}

/* -------------------------------------------------------------------------
 * Validación y sanitizado (servidor)
 * ---------------------------------------------------------------------- */

function lumenti_form_length($value)
{
    return mb_strlen($value, 'UTF-8');
}

// Igual que String.prototype.trim() de JS: también quita espacios Unicode (NBSP, etc.).
function lumenti_form_trim($value)
{
    return (string) preg_replace('/^[\s\p{Z}\x{FEFF}]+|[\s\p{Z}\x{FEFF}]+$/u', '', $value);
}

// Valida un campo. Devuelve [valor_sanitizado, mensaje_error|null].
// El orden de los chequeos es el mismo que en el módulo JS.
function lumenti_validate_field(array $field, $raw)
{
    $m = $field['messages'];
    $type = $field['type'];

    if ($type === 'checkboxes') {
        return lumenti_validate_choices($field, $raw);
    }

    if (is_array($raw)) {
        return ['', $m['invalid']];
    }

    if ($type === 'checkbox' || $type === 'consent') {
        $checked = in_array((string) $raw, ['1', 'on', 'true'], true);
        return [$checked, ($field['required'] && !$checked) ? $m['required'] : null];
    }

    $value = (string) $raw;
    if ($value !== '' && wp_check_invalid_utf8($value) === '') {
        return ['', $m['invalid']];
    }
    if ($type === 'textarea') {
        $value = str_replace(["\r\n", "\r"], "\n", $value);
    }
    $value = lumenti_form_trim($value);

    if ($value === '') {
        return ['', $field['required'] ? $m['required'] : null];
    }

    if ($type === 'select' || $type === 'radio') {
        $valid = in_array($value, array_map('strval', array_keys((array) $field['options'])), true);
        return [$valid ? $value : '', $valid ? null : $m['invalid']];
    }

    if (lumenti_form_length($value) > (int) $field['max']) {
        return ['', $m['max']];
    }

    switch ($type) {
        case 'name':
            $valid = preg_match('/^[\p{L}\p{M} .\'\-]+$/u', $value) === 1;
            break;
        case 'email':
            // is_email() a secas: form.js tiene una copia exacta de sus reglas.
            $valid = (bool) is_email($value);
            break;
        case 'phone':
            $digits = strlen(preg_replace('/[^0-9]/', '', $value));
            $valid = preg_match('/^\+?[0-9 ()\-]+$/', $value) === 1
                && $digits >= (int) $field['min_digits']
                && $digits <= (int) $field['max_digits'];
            break;
        case 'digits':
            $valid = preg_match('/^[0-9]+$/', $value) === 1;
            break;
        case 'textarea':
            // Lista blanca, la misma que TEXTAREA_CHARS en form.js: letras, marcas (tildes), números,
            // espacio, espacio duro, tabulador, salto de línea y . , ; : ¿ ? ¡ ! ( ) - " ' “ ” ‘ ’ – — … @ / % + # * _ $
            $valid = preg_match('/^[\p{L}\p{M}\p{N} \x{00A0}\t\n.,;:¿?¡!()"\'“”‘’–—…@\/%+#*_$-]+$/u', $value) === 1;
            break;
        default: // text
            $valid = preg_match('/[<>\x00-\x1F\x7F]/u', $value) === 0;
    }
    if (!$valid) {
        return ['', $m['invalid']];
    }

    if (lumenti_form_length($value) < (int) $field['min']) {
        return ['', $m['min']];
    }

    switch ($type) {
        case 'textarea':
            return [sanitize_textarea_field($value), null];
        case 'email':
            return [sanitize_email($value), null];
        case 'phone':
            // Se guarda normalizado: + opcional y solo dígitos.
            return [(str_starts_with($value, '+') ? '+' : '') . preg_replace('/[^0-9]/', '', $value), null];
        case 'digits':
            return [$value, null];
        default:
            return [sanitize_text_field($value), null];
    }
}

// Varias opciones (checkboxes): llega como lista de valores; vacío = ninguna marcada.
// Devuelve [valores en el orden de las opciones, mensaje_error|null]. Mismo orden que el JS:
// obligatorio → opción válida → máximo → mínimo.
function lumenti_validate_choices(array $field, $raw)
{
    $m = $field['messages'];
    if ($raw === '' || $raw === null) {
        $raw = [];
    }
    if (!is_array($raw)) {
        return [[], $m['invalid']];
    }

    $values = [];
    foreach ($raw as $item) {
        if (!is_string($item)) {
            return [[], $m['invalid']];
        }
        $values[] = $item;
    }
    $values = array_values(array_unique($values));

    if (!$values) {
        return [[], $field['required'] ? $m['required'] : null];
    }

    $allowed = array_map('strval', array_keys((array) $field['options']));
    if (array_diff($values, $allowed)) {
        return [[], $m['invalid']];
    }
    if ((int) $field['max'] > 0 && count($values) > (int) $field['max']) {
        return [[], $m['max']];
    }
    if (count($values) < (int) $field['min']) {
        return [[], $m['min']];
    }

    // El orden de las opciones, no el de llegada: el correo sale siempre igual.
    return [array_values(array_intersect($allowed, $values)), null];
}

// Valor de un campo como texto, para el correo y los envíos guardados.
function lumenti_form_value_text(array $field, $value)
{
    if (is_bool($value)) {
        return $value ? 'Sí' : 'No';
    }
    if (is_array($value)) {
        return implode(', ', array_map(static fn($item): string => (string) ($field['options'][$item] ?? $item), $value));
    }
    if (in_array($field['type'], ['select', 'radio'], true) && $value !== '') {
        return (string) ($field['options'][$value] ?? $value);
    }

    return (string) $value;
}

// Valida todos los campos definidos. Los campos no definidos se ignoran.
function lumenti_validate_form(array $form, array $input)
{
    $data = [];
    $errors = [];

    foreach ($form['fields'] as $key => $field) {
        $raw = array_key_exists($key, $input) ? wp_unslash($input[$key]) : '';
        [$value, $error] = lumenti_validate_field($field, $raw);
        $data[$key] = $value;
        if ($error !== null) {
            $errors[$key] = $error;
        }
    }

    return [$data, $errors];
}

/* -------------------------------------------------------------------------
 * Antispam
 * ---------------------------------------------------------------------- */

/*
 * IP de la visitante para el límite de envíos y los duplicados.
 *
 * Detrás de Cloudflare o de un proxy del hosting, REMOTE_ADDR es la IP del proxy y todas las
 * visitantes compartirían un solo límite. El motor lo resuelve solo, sin configurar el servidor:
 *   - si REMOTE_ADDR no es un proxy de confianza, se usa tal cual y se ignora toda cabecera (nadie
 *     cambia su IP mandando cabeceras);
 *   - si es de Cloudflare y CF-Connecting-IP trae una IP válida, se usa esa;
 *   - si no, X-Forwarded-For se lee de derecha a izquierda saltando los proxies de confianza: la
 *     primera que no lo es la agregó el último proxy. La de la izquierda la manda el cliente y nunca
 *     se toma sola. Un valor inválido corta la lectura y queda REMOTE_ADDR.
 * Con la constante LUMENTI_FORM_TRUST_PROXIES en false (wp-config.php) vuelve a ser solo
 * REMOTE_ADDR. El filtro lumenti_form_client_ip se aplica al final, como siempre.
 */
function lumenti_form_client_ip()
{
    $remote = isset($_SERVER['REMOTE_ADDR']) ? lumenti_form_ip(sanitize_text_field(wp_unslash($_SERVER['REMOTE_ADDR']))) : '';
    $ip = $remote;

    $enabled = !defined('LUMENTI_FORM_TRUST_PROXIES') || constant('LUMENTI_FORM_TRUST_PROXIES');
    if ($remote !== '' && $enabled) {
        $trusted = (array) apply_filters('lumenti_form_trusted_proxies', lumenti_form_default_proxies());
        if (lumenti_form_ip_in($remote, $trusted)) {
            $ip = lumenti_form_forwarded_ip($remote, $trusted);
        }
    }

    $ip = (string) apply_filters('lumenti_form_client_ip', $ip);

    return filter_var($ip, FILTER_VALIDATE_IP) ? $ip : '';
}

// La IP de un proxy de confianza: la de Cloudflare o la que trae X-Forwarded-For.
function lumenti_form_forwarded_ip($remote, array $trusted)
{
    if (lumenti_form_ip_in($remote, lumenti_form_cloudflare_ips()) && isset($_SERVER['HTTP_CF_CONNECTING_IP'])) {
        $cf = lumenti_form_ip(sanitize_text_field(wp_unslash($_SERVER['HTTP_CF_CONNECTING_IP'])));
        if ($cf !== '') {
            return $cf;
        }
    }

    if (empty($_SERVER['HTTP_X_FORWARDED_FOR']) || !is_string($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return $remote;
    }
    // Cada proxy agrega a la derecha la IP que le habló; se mira como mucho las últimas 20.
    $hops = array_slice(explode(',', sanitize_text_field(wp_unslash($_SERVER['HTTP_X_FORWARDED_FOR']))), -20);
    foreach (array_reverse($hops) as $hop) {
        $hop = lumenti_form_ip(trim($hop));
        if ($hop === '') {
            return $remote;
        }
        if (!lumenti_form_ip_in($hop, $trusted)) {
            return $hop;
        }
    }

    return $remote;
}

// Una IP válida (IPv4 o IPv6) o ''. Una IPv4 escrita como IPv6 (::ffff:1.2.3.4) se pasa a IPv4.
function lumenti_form_ip($ip)
{
    if (!is_string($ip) || !filter_var($ip, FILTER_VALIDATE_IP)) {
        return '';
    }
    $bin = inet_pton($ip);
    if (strlen($bin) === 16 && substr($bin, 0, 12) === str_repeat("\0", 10) . "\xff\xff") {
        return inet_ntop(substr($bin, 12));
    }

    return $ip;
}

// ¿La IP está en alguno de los rangos CIDR? IPv4 e IPv6, comparando bits; un rango mal escrito no coincide.
function lumenti_form_ip_in($ip, array $ranges)
{
    $ip_bin = filter_var($ip, FILTER_VALIDATE_IP) ? inet_pton($ip) : false;
    if ($ip_bin === false) {
        return false;
    }
    foreach ($ranges as $range) {
        $parts = explode('/', (string) $range, 2);
        $net_bin = filter_var($parts[0], FILTER_VALIDATE_IP) ? inet_pton($parts[0]) : false;
        if ($net_bin === false || strlen($net_bin) !== strlen($ip_bin)) {
            continue;
        }
        $max = strlen($ip_bin) * 8;
        $bits = isset($parts[1]) ? (ctype_digit($parts[1]) ? (int) $parts[1] : -1) : $max;
        if ($bits < 0 || $bits > $max) {
            continue;
        }
        $bytes = intdiv($bits, 8);
        $rest = $bits % 8;
        if (substr($ip_bin, 0, $bytes) !== substr($net_bin, 0, $bytes)) {
            continue;
        }
        if ($rest === 0) {
            return true;
        }
        $mask = (0xff << (8 - $rest)) & 0xff;
        if ((ord($ip_bin[$bytes]) & $mask) === (ord($net_bin[$bytes]) & $mask)) {
            return true;
        }
    }

    return false;
}

/*
 * Rangos publicados de Cloudflare, copiados el 2026-11-26 de https://www.cloudflare.com/ips-v4 y
 * https://www.cloudflare.com/ips-v6. Cambian poco, pero hay que revisarlos de vez en cuando (al
 * actualizar la skill); un rango nuevo se puede sumar antes con el filtro lumenti_form_trusted_proxies.
 */
function lumenti_form_cloudflare_ips()
{
    return [
        '173.245.48.0/20', '103.21.244.0/22', '103.22.200.0/22', '103.31.4.0/22', '141.101.64.0/18',
        '108.162.192.0/18', '190.93.240.0/20', '188.114.96.0/20', '197.234.240.0/22', '198.41.128.0/17',
        '162.158.0.0/15', '104.16.0.0/13', '104.24.0.0/14', '172.64.0.0/13', '131.0.72.0/22',
        '2400:cb00::/32', '2606:4700::/32', '2803:f800::/32', '2405:b500::/32', '2405:8100::/32',
        '2a06:98c0::/29', '2c0f:f248::/32',
    ];
}

/*
 * Proxies de confianza por defecto: Cloudflare más las IP privadas, loopback y reservadas (lo que
 * FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE rechaza), que es lo que se ve cuando el hosting
 * pone un proxy delante. ::ffff:0:0/96 no va: esas IP se pasan a IPv4 antes de comparar.
 */
function lumenti_form_default_proxies()
{
    return array_merge(lumenti_form_cloudflare_ips(), [
        '0.0.0.0/8', '10.0.0.0/8', '127.0.0.0/8', '169.254.0.0/16', '172.16.0.0/12', '192.168.0.0/16', '240.0.0.0/4',
        '::/128', '::1/128', 'fc00::/7', 'fe80::/10',
    ]);
}

function lumenti_form_sign($time)
{
    return hash_hmac('sha256', (string) $time, wp_salt('nonce'));
}

// 'ok', 'too_fast' o 'expired'.
function lumenti_form_check_token($token)
{
    $parts = explode('.', (string) $token, 2);
    if (count($parts) !== 2 || !ctype_digit($parts[0]) || !hash_equals(lumenti_form_sign($parts[0]), $parts[1])) {
        return 'expired';
    }

    $elapsed = time() - (int) $parts[0];
    if ($elapsed < LUMENTI_FORM_MIN_SECONDS) {
        return 'too_fast';
    }

    return $elapsed > LUMENTI_FORM_TOKEN_MAX_AGE ? 'expired' : 'ok';
}

// El token es de un solo uso: tras un envío real ya no sirve. Frena bots simples que
// reutilizan el mismo token; no es una defensa fuerte, el límite real es por IP.
function lumenti_form_token_key($token)
{
    return 'lumenti_tk_' . md5((string) $token);
}

// Suma un envío para esta IP y form. Devuelve false si superó el límite.
function lumenti_form_rate_limit($form_id, $limit)
{
    if ((int) $limit <= 0) {
        return true;
    }

    $key = 'lumenti_rl_' . md5($form_id . '|' . lumenti_form_client_ip());
    $count = (int) get_transient($key);
    if ($count >= (int) $limit) {
        return false;
    }

    set_transient($key, $count + 1, LUMENTI_FORM_RATE_WINDOW);
    return true;
}

/* -------------------------------------------------------------------------
 * Envío del correo
 * ---------------------------------------------------------------------- */

function lumenti_form_mail(array $form, array $data)
{
    $lines = [];
    foreach ($form['fields'] as $key => $field) {
        $label = $field['label'] !== '' ? $field['label'] : $key;
        $value = lumenti_form_value_text($field, $data[$key]);

        $lines[] = $field['type'] === 'textarea'
            ? $label . ":\n" . $value
            : $label . ': ' . $value;
    }

    $page = esc_url_raw((string) wp_get_raw_referer());
    $body = sprintf("Nuevo envío del formulario \"%s\" en %s.\n\n", $form['title'], wp_specialchars_decode(get_bloginfo('name'), ENT_QUOTES))
        . implode("\n\n", $lines)
        . ($page !== '' ? "\n\nPágina: " . $page : '');

    $to = array_filter(array_map('sanitize_email', (array) $form['to']));
    if (!$to) {
        $to = [get_option('admin_email')];
    }

    // El From lo define Fluent SMTP en producción (un correo del dominio del cliente).
    // El correo del usuario va solo en Reply-To; ya viene validado y sin saltos de línea.
    $headers = ['Content-Type: text/plain; charset=UTF-8'];
    $reply_to = $form['reply_to'] !== '' ? (string) ($data[$form['reply_to']] ?? '') : '';
    if ($reply_to !== '' && is_email($reply_to)) {
        $headers[] = 'Reply-To: ' . $reply_to;
    }

    $mail = apply_filters('lumenti_form_mail', [
        'to'      => $to,
        'subject' => trim(preg_replace('/[\r\n]+/', ' ', wp_strip_all_tags($form['subject']))),
        'message' => $body,
        'headers' => $headers,
    ], $form, $data);

    return (bool) wp_mail($mail['to'], $mail['subject'], $mail['message'], $mail['headers']);
}

function lumenti_form_mail_failed($error)
{
    lumenti_form_log('wp_mail falló: ' . $error->get_error_message());
}
add_action('wp_mail_failed', 'lumenti_form_mail_failed');

/* -------------------------------------------------------------------------
 * Endpoints AJAX
 * ---------------------------------------------------------------------- */

// Nonce y token de tiempo frescos. El JS los pide cuando el form aparece en pantalla,
// así funcionan aunque la página esté en caché.
function lumenti_form_token()
{
    nocache_headers();
    $time = time();

    wp_send_json_success([
        'nonce' => wp_create_nonce(LUMENTI_FORM_NONCE),
        'token' => $time . '.' . lumenti_form_sign($time),
    ]);
}
add_action('wp_ajax_lumenti_form_token', 'lumenti_form_token');
add_action('wp_ajax_nopriv_lumenti_form_token', 'lumenti_form_token');

function lumenti_form_error($message, $status, array $extra = [])
{
    wp_send_json_error(['message' => $message] + $extra, $status);
}

function lumenti_form_submit()
{
    nocache_headers();

    $generic = 'No pudimos enviar tu mensaje. Intenta de nuevo en unos minutos.';
    $form_id = isset($_POST['form']) ? sanitize_key(wp_unslash($_POST['form'])) : '';
    $form = lumenti_get_form($form_id);
    if (!$form) {
        lumenti_form_error($generic, 400);
    }

    // 1. Nonce (CSRF).
    if (!check_ajax_referer(LUMENTI_FORM_NONCE, 'nonce', false)) {
        lumenti_form_error('El formulario venció. Vuelve a enviarlo.', 403, ['code' => 'expired']);
    }

    // 2. Honeypot: a un bot se le responde éxito para no darle pistas.
    if (!empty($_POST[LUMENTI_FORM_HONEYPOT])) {
        lumenti_form_log("Honeypot activado en \"$form_id\".");
        wp_send_json_success(['message' => $form['success'], 'redirect' => '']);
    }

    // 3. Tiempo mínimo y vigencia del token.
    $raw_token = isset($_POST['token']) ? sanitize_text_field(wp_unslash($_POST['token'])) : '';
    $token = lumenti_form_check_token($raw_token);
    if ($token === 'too_fast') {
        lumenti_form_error('Espera unos segundos y vuelve a enviarlo.', 429, ['code' => 'too_fast']);
    }
    if ($token === 'expired') {
        lumenti_form_error('El formulario venció. Vuelve a enviarlo.', 403, ['code' => 'expired']);
    }

    // 4. Validación con las mismas reglas que el front.
    [$data, $errors] = lumenti_validate_form($form, $_POST);
    if ($errors) {
        lumenti_form_error('Revisa los campos marcados.', 422, ['fields' => $errors]);
    }

    // 5. Doble envío: el mismo contenido desde la misma IP en poco tiempo se ignora.
    $duplicate_key = 'lumenti_dup_' . md5($form_id . '|' . lumenti_form_client_ip() . '|' . wp_json_encode($data));
    if (get_transient($duplicate_key)) {
        wp_send_json_success(['message' => $form['success'], 'redirect' => esc_url_raw($form['redirect'])]);
    }

    // 6. Token ya usado en otro envío.
    if (get_transient(lumenti_form_token_key($raw_token))) {
        lumenti_form_error('El formulario venció. Vuelve a enviarlo.', 403, ['code' => 'expired']);
    }

    // 7. Límite de envíos por IP.
    if (!lumenti_form_rate_limit($form_id, $form['rate_limit'])) {
        lumenti_form_error('Recibimos varios envíos seguidos. Intenta de nuevo más tarde.', 429, ['code' => 'rate_limit']);
    }

    set_transient($duplicate_key, 1, LUMENTI_FORM_DUPLICATE_WINDOW);
    set_transient(lumenti_form_token_key($raw_token), 1, LUMENTI_FORM_TOKEN_MAX_AGE);

    // 8. Envío, guardado opcional y gancho para integraciones (CRM, etc.).
    $sent = lumenti_form_mail($form, $data);

    $store = $form['store'];
    if (function_exists('lumenti_form_store_entry') && ($store === 'all' || ($store === 'failed' && !$sent))) {
        lumenti_form_store_entry($form, $data, $sent);
    }

    do_action('lumenti_form_submitted', $form_id, $data, $sent, $form);

    if (!$sent) {
        delete_transient($duplicate_key); // Permite reintentar.
        delete_transient(lumenti_form_token_key($raw_token)); // Y con el mismo token.
        lumenti_form_error($generic, 500);
    }

    wp_send_json_success(['message' => $form['success'], 'redirect' => esc_url_raw($form['redirect'])]);
}
add_action('wp_ajax_lumenti_form_submit', 'lumenti_form_submit');
add_action('wp_ajax_nopriv_lumenti_form_submit', 'lumenti_form_submit');

function lumenti_form_log($message)
{
    if (defined('WP_DEBUG') && WP_DEBUG) {
        error_log('[lumenti:forms] ' . $message);
    }
}
