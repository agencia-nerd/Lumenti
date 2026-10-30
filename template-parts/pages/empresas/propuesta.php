<?php
defined('ABSPATH') || exit;

/*
 * Empresas → propuesta (specs/empresas.md). Grupo ACF: Empresas → empresas_propuesta.
 * Ancla #propuesta. A la izquierda el contenedor del form (data-lm-target="formulario", destino de data-lm-goto);
 * el form lo escribe wp-form en template-parts/forms/empresas-propuesta.php con los textos de $lumenti_form.
 * A la derecha título, bajada, WhatsApp corporativo y foto.
 */

$lumenti_propuesta = [
    'titulo' => 'CUÉNTANOS QUÉ NECESITA *TU ORGANIZACIÓN*',
    'bajada' => 'Comparte con nosotros el contexto de tu empresa y te contactaremos a la brevedad con una propuesta a medida.',
    'alternativa' => '¿Prefieres hablar primero?',
    'whatsapp_texto' => 'Escríbenos por WhatsApp',
    'mensaje_whatsapp' => 'Hola, quisiera información sobre las soluciones de salud mental para empresas.',
    'imagen' => ['ruta' => 'assets/img/emp-equipo.webp', 'ancho' => 980, 'alto' => 1041, 'alt' => 'Colaboradoras conversando y sonriendo al aire libre'],
    'exito_titulo' => '¡GRACIAS! RECIBIMOS TU SOLICITUD',
    'exito_texto' => 'Nuestro equipo corporativo revisará la información y te contactará a la brevedad con una propuesta a medida.',
];

// $args del form (wp-form). Los `name` son los del README "Formulario de Empresas".
$lumenti_form = [
    'fieldsets' => [
        'datos' => 'TUS DATOS',
        'necesidad' => '¿QUÉ NECESITAS?',
        'mas' => 'CUÉNTANOS MÁS',
    ],
    'campos' => [
        'nombre' => ['label' => 'Nombre y apellido', 'requerido' => true, 'solo_letras' => true, 'autocomplete' => 'name'],
        'empresa' => ['label' => 'Empresa / Organización', 'requerido' => true, 'autocomplete' => 'organization'],
        'cargo' => ['label' => 'Cargo o área', 'requerido' => true, 'solo_letras' => true, 'autocomplete' => 'organization-title'],
        'whatsapp' => ['label' => 'WhatsApp de contacto', 'requerido' => true, 'prefijo' => '+51', 'ayuda' => 'Celular de 9 dígitos, sin el +51.', 'autocomplete' => 'tel-national'],
        'correo' => ['label' => 'Correo corporativo', 'requerido' => true, 'autocomplete' => 'email'],
        'busca' => [
            'label' => '¿Qué estás buscando?',
            'nota' => '(puedes elegir varias)',
            'requerido' => true,
            'opciones' => [
                'taller' => 'Taller o charla para colaboradores',
                'prevencion' => 'Programa de prevención en salud mental',
                'atencion' => 'Atención psicológica o psiquiátrica para colaboradores',
                'inhouse' => 'Consultas in house',
                'convenio' => 'Convenio corporativo',
                'orientacion' => 'No estoy seguro, necesito orientación',
            ],
        ],
        'colaboradores' => [
            'label' => 'Cantidad aproximada de colaboradores',
            'requerido' => true,
            'placeholder' => 'Selecciona una opción',
            'opciones' => ['Menos de 50', '50 a 100', '101 a 300', 'Más de 300', 'Aún por definir'],
        ],
        'mensaje' => [
            'label' => 'Cuéntanos brevemente qué necesitan',
            'nota' => '(opcional)',
            'requerido' => false,
            'ayuda' => 'Cuéntanos qué necesita tu equipo y diseñaremos una propuesta a medida.',
        ],
        'privacidad' => [
            'texto' => 'He leído y acepto la Política de privacidad y autorizo a Lumenti a contactarme sobre mi solicitud.',
            'enlace_texto' => 'Política de privacidad',
            'url' => home_url('/politica-de-privacidad/'),
            'requerido' => true,
        ],
        'website' => ['label' => 'No completar'],
    ],
    'errores' => [
        'requerido' => 'Completa este campo.',
        'letras' => 'Usa solo letras.',
        'whatsapp' => 'Ingresa un celular de 9 dígitos.',
        'correo' => 'Ingresa un correo válido (ej. nombre@empresa.com).',
        'busca' => 'Elige al menos una opción.',
        'colaboradores' => 'Selecciona una opción.',
        'privacidad' => 'Debes aceptar la Política de privacidad para continuar.',
    ],
    'boton' => 'Solicitar propuesta',
    'exito_titulo' => $lumenti_propuesta['exito_titulo'],
    'exito_texto' => $lumenti_propuesta['exito_texto'],
    'exito_boton' => 'Enviar otra solicitud',
    // Prefijo que empresas.js escribe en `mensaje` con data-lm-prefill.
    'prefill' => 'Nos interesa el taller "%s".',
];
?>
<section class="lm-emp-proposal lm-emp-anchor" id="propuesta" aria-labelledby="lm-emp-form-title">
    <div class="lm-emp-proposal__inner">
        <div data-lm-target="formulario">
            <?php if (locate_template('template-parts/forms/empresas-propuesta.php') !== '') {
                get_template_part('template-parts/forms/empresas-propuesta', null, $lumenti_form);
            } ?>
        </div>
        <aside class="lm-emp-proposal__aside">
            <h2 class="lm-section-title" id="lm-emp-form-title"><?= lumenti_highlight($lumenti_propuesta['titulo']) ?></h2>
            <?php if ($lumenti_propuesta['bajada'] !== '') : ?>
                <p class="lm-emp-proposal__lead"><?= esc_html($lumenti_propuesta['bajada']) ?></p>
            <?php endif; ?>
            <?php if ($lumenti_propuesta['alternativa'] !== '') : ?>
                <p class="lm-emp-proposal__alt"><?= esc_html($lumenti_propuesta['alternativa']) ?></p>
            <?php endif; ?>
            <?php get_template_part('template-parts/components/enlace-flecha', null, [
                'texto' => $lumenti_propuesta['whatsapp_texto'],
                'url' => lumenti_whatsapp_url('corporativo', $lumenti_propuesta['mensaje_whatsapp']),
                'externo' => true,
                'clase' => 'lm-emp-proposal__wa',
            ]); ?>
            <?php $lumenti_img = lumenti_theme_image($lumenti_propuesta['imagen'], ['class' => 'lm-emp-proposal__img', 'size' => 'large']); ?>
            <?php if ($lumenti_img !== '') : ?>
                <div class="lm-emp-proposal__media"><?= $lumenti_img ?></div>
            <?php endif; ?>
        </aside>
    </div>
</section>
