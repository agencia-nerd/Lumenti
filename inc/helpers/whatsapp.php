<?php
defined('ABSPATH') || exit;

/*
 * Helper local de Lumenti: enlaces wa.me con el número según el contexto.
 * Los números y sus mensajes salen de Ajustes del sitio → Contacto (opciones_contacto → telefono_paciente,
 * mensaje_paciente, telefono_corporativo, mensaje_corporativo): el mismo teléfono del pie es el WhatsApp.
 *
 *   <a href="<?= esc_url(lumenti_whatsapp_url('paciente', 'Hola, quisiera agendar una cita.')) ?>">
 */

// Contexto de WhatsApp de la página: Empresas usa el corporativo; el resto, el de paciente.
function lumenti_whatsapp_context(): string
{
    return is_page_template('pages/template-empresas.php') ? 'corporativo' : 'paciente';
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

// Número (solo dígitos) del contexto, o '' si no está cargado.
function lumenti_whatsapp_number(string $context = 'paciente'): string
{
    $key = $context === 'corporativo' ? 'telefono_corporativo' : 'telefono_paciente';

    return preg_replace('/\D+/', '', (string) (lumenti_whatsapp_contacto()[$key] ?? ''));
}

// Mensaje por defecto del contexto (mensaje_paciente / mensaje_corporativo), o '' si no está cargado.
function lumenti_whatsapp_message(string $context = 'paciente'): string
{
    $key = $context === 'corporativo' ? 'mensaje_corporativo' : 'mensaje_paciente';

    return trim((string) (lumenti_whatsapp_contacto()[$key] ?? ''));
}

// URL de wa.me con el mensaje, o '' si no hay número (los helpers de enlaces descartan un enlace vacío).
function lumenti_whatsapp_url(string $context = 'paciente', string $message = ''): string
{
    $number = lumenti_whatsapp_number($context);
    if ($number === '') {
        return '';
    }
    $url = 'https://wa.me/' . $number;

    return $message !== '' ? $url . '?text=' . rawurlencode($message) : $url;
}
