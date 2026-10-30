<?php
defined('ABSPATH') || exit;

/*
 * Form "Solicitar propuesta" de Empresas (specs/empresas.md → propuesta).
 * Vista: template-parts/forms/empresas-propuesta.php. Destinatarios: Ajustes del sitio
 * (opciones_formularios_empresas_correos). `busca` es un grupo de casillas: ver inc/forms-extras.php.
 */

const LUMENTI_EMPRESAS_BUSCA = [
    'taller'      => 'Taller o charla para colaboradores',
    'prevencion'  => 'Programa de prevención en salud mental',
    'atencion'    => 'Atención psicológica o psiquiátrica para colaboradores',
    'inhouse'     => 'Consultas in house',
    'convenio'    => 'Convenio corporativo',
    'orientacion' => 'No estoy seguro, necesito orientación',
];

add_filter('lumenti_forms', function ($forms) {
    $requerido = 'Completa este campo.';
    $letras = 'Usa solo letras.';
    $celular = 'Ingresa un celular de 9 dígitos.';

    $forms['empresas'] = [
        'title'    => 'Empresas: solicitud de propuesta',
        'subject'  => 'Nueva solicitud de propuesta para empresas desde la web',
        'to'       => lumenti_form_recipients('empresas'),
        'reply_to' => 'correo',
        'store'    => 'none',
        'redirect' => '',
        'success'  => 'Nuestro equipo corporativo revisará la información y te contactará a la brevedad con una propuesta a medida.',

        'fields' => [
            'nombre' => [
                'type'         => 'name',
                'label'        => 'Nombre y apellido',
                'required'     => true,
                'autocomplete' => 'name',
                'messages'     => ['required' => $requerido, 'invalid' => $letras, 'min' => $requerido],
            ],
            'empresa' => [
                'type'         => 'text',
                'label'        => 'Empresa / Organización',
                'required'     => true,
                'autocomplete' => 'organization',
                'messages'     => ['required' => $requerido],
            ],
            'cargo' => [
                'type'         => 'name',
                'label'        => 'Cargo o área',
                'required'     => true,
                'autocomplete' => 'organization-title',
                'messages'     => ['required' => $requerido, 'invalid' => $letras, 'min' => $requerido],
            ],
            'whatsapp' => [
                'type'         => 'digits',
                'label'        => 'WhatsApp de contacto (+51)',
                'required'     => true,
                'min'          => 9,
                'max'          => 9,
                'autocomplete' => 'tel-national',
                'messages'     => ['required' => $requerido, 'invalid' => $celular, 'min' => $celular, 'max' => $celular],
            ],
            'correo' => [
                'type'         => 'email',
                'label'        => 'Correo corporativo',
                'required'     => true,
                'autocomplete' => 'email',
                'messages'     => ['required' => $requerido, 'invalid' => 'Ingresa un correo válido (ej. nombre@empresa.com).'],
            ],
            // Grupo de casillas busca[]: aquí llegan las opciones marcadas, separadas por " | ".
            'busca' => [
                'type'     => 'text',
                'label'    => '¿Qué estás buscando?',
                'required' => true,
                'max'      => 400,
                'messages' => ['required' => 'Elige al menos una opción.'],
            ],
            'colaboradores' => [
                'type'     => 'select',
                'label'    => 'Cantidad aproximada de colaboradores',
                'required' => true,
                'options'  => [
                    'menos-50'      => 'Menos de 50',
                    '50-100'        => '50 a 100',
                    '101-300'       => '101 a 300',
                    'mas-300'       => 'Más de 300',
                    'por-definir'   => 'Aún por definir',
                ],
                'messages' => ['required' => 'Selecciona una opción.', 'invalid' => 'Selecciona una opción.'],
            ],
            'mensaje' => [
                'type'     => 'textarea',
                'label'    => 'Cuéntanos brevemente qué necesitan',
                'required' => false,
            ],
            'privacidad' => [
                'type'     => 'consent',
                'label'    => 'Acepta la Política de privacidad',
                'messages' => ['required' => 'Debes aceptar la Política de privacidad para continuar.'],
            ],
        ],
    ];

    return $forms;
});

add_filter('lumenti_form_extras', function ($extras) {
    $extras['empresas'] = [
        'grupos' => [
            'busca' => ['options' => LUMENTI_EMPRESAS_BUSCA, 'min' => 1, 'message' => 'Elige al menos una opción.'],
        ],
        'patrones' => [
            'whatsapp' => ['regex' => '/^9\d{8}$/', 'message' => 'Ingresa un celular de 9 dígitos.'],
        ],
    ];

    return $extras;
});
