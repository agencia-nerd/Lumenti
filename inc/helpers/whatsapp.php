<?php
defined('ABSPATH') || exit;

/*
 * Helper local de Lumenti: enlaces wa.me con el número según el contexto.
 * Los números quedan fijos hasta el paso ACF (specs/opciones.md → opciones_contacto_whatsapp_paciente
 * y opciones_contacto_whatsapp_corporativo).
 *
 *   <a href="<?= esc_url(lumenti_whatsapp_url('paciente', 'Hola, quisiera agendar una cita.')) ?>">
 */

const LUMENTI_WHATSAPP = [
    'paciente'    => '51939033999',
    'corporativo' => '51942901535',
];

// Contexto de WhatsApp de la página: Empresas usa el corporativo; el resto, el de paciente.
function lumenti_whatsapp_context(): string
{
    return is_page_template('pages/template-empresas.php') ? 'corporativo' : 'paciente';
}

function lumenti_whatsapp_url(string $context = 'paciente', string $message = ''): string
{
    $number = LUMENTI_WHATSAPP[$context] ?? LUMENTI_WHATSAPP['paciente'];
    $url = 'https://wa.me/' . $number;

    return $message !== '' ? $url . '?text=' . rawurlencode($message) : $url;
}
