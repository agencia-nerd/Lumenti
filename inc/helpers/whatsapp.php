<?php
defined('ABSPATH') || exit;

/*
 * Helper local de Lumenti: enlaces wa.me con el número según el contexto.
 * Los números salen de Ajustes del sitio (opciones_contacto → telefono_paciente,
 * telefono_corporativo): el mismo teléfono que se muestra en el pie es el WhatsApp.
 *
 *   <a href="<?= esc_url(lumenti_whatsapp_url('paciente', 'Hola, quisiera agendar una cita.')) ?>">
 */

// Contexto de WhatsApp de la página: Empresas usa el corporativo; el resto, el de paciente.
function lumenti_whatsapp_context(): string
{
    return is_page_template('pages/template-empresas.php') ? 'corporativo' : 'paciente';
}

// Número (solo dígitos) del contexto, o '' si no está cargado.
function lumenti_whatsapp_number(string $context = 'paciente'): string
{
    static $contacto = null;
    if ($contacto === null) {
        $contacto = function_exists('get_field') ? ((array) get_field('opciones_contacto', 'option') ?: []) : [];
    }
    $key = $context === 'corporativo' ? 'telefono_corporativo' : 'telefono_paciente';

    return preg_replace('/\D+/', '', (string) ($contacto[$key] ?? ''));
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
