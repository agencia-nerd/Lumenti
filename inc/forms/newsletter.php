<?php
defined('ABSPATH') || exit;

/*
 * Newsletter del blog (specs/blog.md → cta). Vista: template-parts/forms/newsletter.php.
 * Por ahora llega por correo (sin servicio de newsletter). Destinatarios: Ajustes del sitio
 * (opciones_formularios_newsletter_correos). Para Mailchimp, Brevo u otro: hook lumenti_form_submitted.
 */
add_filter('lumenti_forms', function ($forms) {
    $forms['newsletter'] = [
        'title'    => 'Newsletter del blog',
        'subject'  => 'Nueva suscripción al newsletter desde la web',
        'to'       => lumenti_form_recipients('newsletter'),
        'reply_to' => 'email',
        'store'    => 'none',
        'redirect' => '',
        'success'  => '¡Listo! Te suscribiste. Pronto recibirás nuestros artículos en tu correo.',

        'fields' => [
            'email' => [
                'type'         => 'email',
                'label'        => 'Correo electrónico',
                'required'     => true,
                'autocomplete' => 'email',
                'messages'     => ['required' => 'Ingresa un correo válido.', 'invalid' => 'Ingresa un correo válido.'],
            ],
            'privacidad' => [
                'type'     => 'consent',
                'label'    => 'Acepta la Política de privacidad y recibir contenidos por correo',
                'messages' => ['required' => 'Debes aceptar la Política de privacidad.'],
            ],
        ],
    ];

    return $forms;
});
