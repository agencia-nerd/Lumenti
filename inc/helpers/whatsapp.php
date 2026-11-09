<?php
defined('ABSPATH') || exit;

/*
 * Helper local de Lumenti: enlaces wa.me con el número según el contexto.
 * Los números y sus mensajes salen de Ajustes del sitio → Contacto (opciones_contacto → telefono_citas,
 * mensaje_citas, telefono_paciente, mensaje_paciente, telefono_corporativo, mensaje_corporativo): el mismo teléfono
 * del pie es el WhatsApp.
 *
 * La central de citas (citas) es el WhatsApp principal: cabecera, botón flotante y botones de las páginas.
 * Empresas usa el corporativo; el de paciente solo sale en el pie.
 *
 *   <a href="<?= esc_url(lumenti_whatsapp_url('citas', 'Hola, quisiera agendar una cita.')) ?>">
 */

// Contexto de WhatsApp de la página: Empresas usa el corporativo; el resto, la central de citas.
function lumenti_whatsapp_context(): string
{
    return is_page_template('pages/template-empresas.php') ? 'corporativo' : 'citas';
}

// Grupo opciones_contacto de Ajustes del sitio (leído una sola vez por página).
function lumenti_whatsapp_contacto(): array
{
    static $contacto = null;
    if ($contacto === null) {
        $contacto = function_exists('get_field') ? ((array) get_field('opciones_contacto', 'option') ?: []) : [];
    }
    return $contacto;
}

// Sufijo de los campos del contexto: citas (por defecto, central de citas), paciente o corporativo.
function lumenti_whatsapp_suffix(string $context): string
{
    return in_array($context, ['paciente', 'corporativo'], true) ? $context : 'citas';
}

// Número (solo dígitos) del contexto, o '' si no está cargado.
function lumenti_whatsapp_number(string $context = 'citas'): string
{
    $key = 'telefono_' . lumenti_whatsapp_suffix($context);

    return preg_replace('/\D+/', '', (string) (lumenti_whatsapp_contacto()[$key] ?? ''));
}

// Mensaje por defecto del contexto (mensaje_citas / mensaje_paciente / mensaje_corporativo), o '' si no está cargado.
function lumenti_whatsapp_message(string $context = 'citas'): string
{
    $key = 'mensaje_' . lumenti_whatsapp_suffix($context);

    return trim((string) (lumenti_whatsapp_contacto()[$key] ?? ''));
}

// URL de wa.me con el mensaje, o '' si no hay número (los helpers de enlaces descartan un enlace vacío).
function lumenti_whatsapp_url(string $context = 'citas', string $message = ''): string
{
    $number = lumenti_whatsapp_number($context);
    if ($number === '') {
        return '';
    }
    $url = 'https://wa.me/' . $number;

    return $message !== '' ? $url . '?text=' . rawurlencode($message) : $url;
}
