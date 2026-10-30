<?php
defined('ABSPATH') || exit;

/*
 * Contenido inicial de Inicio (specs/home.md): el texto, las imágenes y los enlaces que salieron de
 * template-parts/pages/home/*.php. Las cards de ayuda y blog son de muestra (inc/muestras/home-*.php), no van aquí.
 */
return [
    'page'   => 'home',
    'fields' => [
        'home_hero' => [
            'slides' => [
                [
                    'pestana'        => 'INTEGRAL',
                    'titulo_linea_1' => 'SALUD MENTAL',
                    'titulo_linea_2' => 'INTEGRAL PARA CADA',
                    'titulo_linea_3' => 'ETAPA DE LA VIDA',
                    'bajada'         => 'Consultorio especializado en psiquiatría y psicología para niños, adolescentes y adultos, con atención presencial y virtual.',
                    'boton_texto'    => 'Agenda tu cita',
                    'boton_mensaje'  => '',
                    'imagen'         => ['_file' => 'assets/img/hero-integral.webp', 'alt' => 'Mujer respirando con los ojos cerrados frente al mar'],
                ],
                [
                    'pestana'        => 'EMPRESAS',
                    'titulo_linea_1' => 'TU ALIADO EN',
                    'titulo_linea_2' => 'BIENESTAR MENTAL',
                    'titulo_linea_3' => 'ORGANIZACIONAL',
                    'bajada'         => 'Ayudamos a las empresas a prevenir, detectar y abordar desafíos de salud mental mediante programas, talleres y atención especializada.',
                    'boton_texto'    => 'Solicitar información',
                    'boton_mensaje'  => '',
                    'imagen'         => ['_file' => 'assets/img/hero-empresas.webp', 'alt' => 'Profesional sonriendo en una oficina junto a su equipo'],
                ],
            ],
            'sello_palabra_1' => 'ACOMPAÑAMOS',
            'sello_palabra_2' => 'ESCUCHAMOS',
            'sello_palabra_3' => 'TRANSFORMAMOS',
        ],
        'home_cifras' => [
            'items' => [
                ['valor' => '+3,000', 'etiqueta' => 'Pacientes atendidos', 'nota' => 'En atención presencial y online'],
                ['valor' => '13', 'etiqueta' => 'Especialistas', 'nota' => 'Psiquiatras y psicólogos'],
                ['valor' => '3', 'etiqueta' => 'Idiomas de atención', 'nota' => 'Atención presencial y virtual para cada etapa de la vida.'],
            ],
        ],
        'home_sobre' => [
            'etiqueta'          => 'UN EQUIPO CON ENFOQUE INTEGRAL',
            'texto'             => 'En Lumenti creemos que cada historia merece ser *escuchada y comprendida*. Por eso, te acompañamos con una atención cercana, personalizada y basada en evidencia, respetando tu proceso y avanzando contigo hacia un mayor bienestar.',
            'imagen_principal'  => ['_file' => 'assets/img/sobre-equipo.webp', 'alt' => 'Especialista de Lumenti revisando una tablet en recepción'],
            'imagen_secundaria' => ['_file' => 'assets/img/sobre-consulta.webp', 'alt' => 'Especialista conversando con una paciente en consulta'],
        ],
        'home_servicios' => [
            'items' => [
                [
                    'titulo'        => 'PSIQUIATRÍA',
                    'descripcion'   => 'Evaluación, diagnóstico y tratamiento integral.',
                    'enlace'        => ['title' => 'PSIQUIATRÍA', 'url' => ['_page' => 'psiquiatria']],
                    'imagen'        => ['_file' => 'assets/img/servicio-psiquiatria.webp', 'alt' => ''],
                    'sin_degradado' => 0,
                ],
                [
                    'titulo'        => 'PSICOLOGÍA',
                    'descripcion'   => 'Psicoterapia y evaluaciones psicológicas basadas en evidencia.',
                    'enlace'        => ['title' => 'PSICOLOGÍA', 'url' => ['_page' => 'psicologia']],
                    'imagen'        => ['_file' => 'assets/img/servicio-psicologia.webp', 'alt' => ''],
                    'sin_degradado' => 0,
                ],
                [
                    'titulo'        => 'INFORMES Y CERTIFICADOS',
                    'descripcion'   => 'Documentos clínicos elaborados previa evaluación profesional.',
                    'enlace'        => ['title' => 'INFORMES Y CERTIFICADOS', 'url' => ['_page' => 'informes']],
                    'imagen'        => ['_file' => 'assets/img/servicio-informes.webp', 'alt' => ''],
                    'sin_degradado' => 1,
                ],
                [
                    'titulo'        => 'EMPRESAS',
                    'descripcion'   => 'Talleres y programas de salud mental para organizaciones',
                    'enlace'        => ['title' => 'EMPRESAS', 'url' => ['_page' => 'empresas']],
                    'imagen'        => ['_file' => 'assets/img/servicio-empresas.webp', 'alt' => ''],
                    'sin_degradado' => 1,
                ],
            ],
        ],
        'home_ayuda' => [
            'titulo' => '¿CÓMO PODEMOS AYUDARTE?',
            'bajada' => 'Brindamos orientación, evaluación, tratamiento y acompañamiento en distintas áreas de la salud mental, según la etapa de vida y situación de cada persona.',
        ],
        'home_diario' => [
            'etiqueta' => 'ACOMPAÑAMIENTO PSICOLÓGICO',
            // Cada renglón del título es una línea del h2.
            'titulo'   => 'PSICOLOGÍA PARA EL
DÍA A DÍA',
            'bajada'   => 'No necesitas un diagnóstico para pedir apoyo. Nuestros psicólogos te acompañan en los desafíos cotidianos que afectan tu bienestar emocional.',
            'enlace'   => ['title' => 'Psicología', 'url' => ['_page' => 'psicologia']],
            'items'    => [
                ['titulo' => 'Regulación emocional', 'descripcion' => 'Aprende a reconocer y manejar lo que sientes para vivir tu día con más calma.', 'imagen' => ['_file' => 'assets/img/psico-regulacion.webp', 'alt' => 'Mujer con los ojos cerrados y las manos en el pecho']],
                ['titulo' => 'Autoestima y autoconocimiento', 'descripcion' => 'Descubre tus fortalezas y construye una relación más amable contigo mismo.', 'imagen' => ['_file' => 'assets/img/psico-autoestima.webp', 'alt' => '']],
                ['titulo' => 'Duelo y crisis vitales', 'descripcion' => 'Acompañamiento para atravesar pérdidas y cambios difíciles sin cargarlo solo.', 'imagen' => ['_file' => 'assets/img/psico-duelo.webp', 'alt' => '']],
                ['titulo' => 'Estrés y adaptación a cambios', 'descripcion' => 'Herramientas para afrontar la presión y adaptarte a nuevas etapas con equilibrio.', 'imagen' => ['_file' => 'assets/img/psico-estres.webp', 'alt' => '']],
                ['titulo' => 'Dificultades en vínculos y relaciones', 'descripcion' => 'Mejora cómo te relacionas y aprende a resolver conflictos de forma sana.', 'imagen' => ['_file' => 'assets/img/psico-vinculos.webp', 'alt' => '']],
                ['titulo' => 'Habilidades sociales', 'descripcion' => 'Gana seguridad para comunicarte y conectar con los demás de forma auténtica.', 'imagen' => ['_file' => 'assets/img/psico-habilidades.webp', 'alt' => '']],
                ['titulo' => 'Organización, hábitos y manejo del tiempo', 'descripcion' => 'Crea rutinas y hábitos que te ayuden a sentirte más en control de tu día.', 'imagen' => ['_file' => 'assets/img/psico-organizacion.webp', 'alt' => '']],
                ['titulo' => 'Orientación vocacional', 'descripcion' => 'Explora tus intereses y toma decisiones sobre tu futuro con más claridad.', 'imagen' => ['_file' => 'assets/img/psico-vocacional.webp', 'alt' => '']],
                ['titulo' => 'Dificultades emocionales y conductuales', 'descripcion' => 'Apoyo para comprender y encauzar emociones y conductas del día a día.', 'imagen' => ['_file' => 'assets/img/psico-conductuales.webp', 'alt' => '']],
            ],
        ],
        'home_evaluaciones' => [
            'titulo'        => 'EVALUACIONES PSICOLÓGICAS CON RESPALDO PROFESIONAL',
            'texto'         => 'Procesos especializados para conocer aspectos emocionales, cognitivos, conductuales o vocacionales, mediante una valoración profesional e instrumentos psicológicos seleccionados según cada caso.',
            'boton_texto'   => 'Quiero mi evaluación',
            'boton_mensaje' => 'Hola, quisiera información sobre una evaluación psicológica.',
            'imagen'        => ['_file' => 'assets/img/psico-evaluacion.webp', 'alt' => 'Psicólogo conversando con una paciente durante una evaluación'],
        ],
        'home_testimonios' => [
            // Cada renglón del título es una línea del h2.
            'titulo' => 'LO QUE DICEN
NUESTROS CLIENTES',
            'bajada' => 'Experiencias de personas que confiaron en nosotros para cuidar su salud mental.',
            'items'  => [
                ['texto' => 'En Lumenti he encontrado profesionales muy capacitados y principalmente humanos. Me gusta que toda la coordinación es muy eficiente.', 'nombre' => 'Luz del Pilar S.', 'fuente' => 'Google Reviews', 'estrellas' => 5],
                ['texto' => 'Cuenta con médicos súper atentos y agradables. El consultorio es moderno y cómodo. Te hacen sentir muy tranquila y en confianza desde el primer día!', 'nombre' => 'Mariale V.', 'fuente' => 'Google Reviews', 'estrellas' => 5],
                ['texto' => 'Lo que más resalto del centro es que los psiquiatras y psicoterapeutas trabajan en coordinación y eso ahorra tiempo y ayuda mucho al tratamiento. Recomendados! Me están ayudando mucho.', 'nombre' => 'Gladys M.', 'fuente' => 'Google Reviews', 'estrellas' => 5],
                ['texto' => 'I highly recommend this great team at Lumenti Salud Mental Integral. I truly appreciated the closeness of the professionals and the excellent coordination between the psychotherapy and psychiatry appointments. This integrated care made my treatment incredibly effective.', 'nombre' => 'Bernardo D.', 'fuente' => 'Google Reviews', 'estrellas' => 5],
                ['texto' => 'El mejor servicio! Si necesitan ayuda, no duden en contactarlos, equipo profesional!', 'nombre' => 'Alejandra G.', 'fuente' => 'Google Reviews', 'estrellas' => 5],
                ['texto' => 'Súper agradecida con el trato de los doctores. El espacio es lindo. Los felicito!', 'nombre' => 'Mariana D.', 'fuente' => 'Google Reviews', 'estrellas' => 5],
                ['texto' => 'I highly recommend this practice. Excellent care and professional, kind practitioners.', 'nombre' => 'Elizabeth S.', 'fuente' => 'Google Reviews', 'estrellas' => 5],
                ['texto' => 'Un centro especializado, de primer nivel y enfocado en el bienestar de sus pacientes. Muchas gracias por su contribución a la salud mental del país.', 'nombre' => 'Samuel C.', 'fuente' => 'Google Reviews', 'estrellas' => 5],
                ['texto' => 'Muy buen proveedor de Servicios, excelente comunicación, facilidad para agendar las citas, facilidad en relación a métodos de pago, buen seguimiento y profesionalismo.', 'nombre' => 'Laura U.', 'fuente' => 'Google Reviews', 'estrellas' => 5],
            ],
        ],
        'home_blog' => [
            'titulo' => 'NUESTROS ARTÍCULOS PARA EL BIENESTAR',
            'bajada' => 'Artículos escritos por nuestros especialistas sobre salud mental, tratamientos y bienestar. Contenido claro, basado en evidencia y pensado para ti.',
            'boton'  => ['title' => 'Explora nuestro blog', 'url' => '/blog/'],
        ],
        'home_cta' => [
            'titulo'        => 'DAR EL PRIMER PASO TAMBIÉN ES UNA FORMA DE CUIDARTE',
            'texto'         => 'Encuentra en Lumenti una atención profesional, cercana y pensada para ti.',
            'boton_texto'   => 'Escríbenos por WhatsApp',
            'boton_mensaje' => '',
            'video'         => ['_file' => 'assets/video/cta-mar-v4.mp4'],
        ],
    ],
];
