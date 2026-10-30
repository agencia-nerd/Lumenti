<?php
defined('ABSPATH') || exit;

/*
 * Contenido inicial de Ajustes del sitio (specs/opciones.md): el texto que salió de header.php y footer.php.
 * Los títulos de las columnas del pie y el copyright son fijos en footer.php (no son campos).
 * Las URLs de redes están pendientes del cliente: las redes se cargan sin enlace y no se muestran hasta tenerlo.
 * Los destinatarios de los formularios se dejan vacíos (llegan al correo de administración hasta cargarlos).
 */
return [
    'option' => true,
    'fields' => [
        'opciones_cabecera' => [
            'logo_alternativo'  => ['_file' => 'assets/img/logo-white.svg', 'alt' => 'Lumenti'],
            'boton_texto'       => 'WhatsApp',
            'mensaje_whatsapp'  => 'Hola, quisiera agendar una cita.',
            'ayuda_texto'       => '¿No sabes cuál elegir?',
            'ayuda_enlace'      => 'Contáctanos',
            'tratamos_titulo'   => '¿NO SABES QUÉ CONDICIÓN TE AFECTA?',
            'tratamos_imagen'   => ['_file' => 'assets/img/mm-tratamos.webp', 'alt' => ''],
        ],
        'opciones_contacto' => [
            'telefono_paciente'    => '+51 939 033 999',
            'telefono_corporativo' => '+51 942 901 535',
            'correo'               => 'contacto@lumentisaludmental.com',
            'direccion'            => 'C. Los Antares 320, Santiago de Surco 15038',
        ],
        'opciones_redes' => [
            'items' => [
                ['red' => 'x', 'enlace' => ''],
                ['red' => 'facebook', 'enlace' => ''],
                ['red' => 'instagram', 'enlace' => ''],
                ['red' => 'youtube', 'enlace' => ''],
                ['red' => 'linkedin', 'enlace' => ''],
                ['red' => 'tiktok', 'enlace' => ''],
            ],
        ],
        'opciones_formularios' => [
            'empresas_correos'   => [],
            'newsletter_correos' => [],
        ],
    ],
];
