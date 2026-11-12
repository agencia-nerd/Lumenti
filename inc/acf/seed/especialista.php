<?php
defined('ABSPATH') || exit;

/*
 * Contenido inicial de Especialista (specs/especialista.md): los 13 especialistas del diseño
 * (lumenti-diseño-web/data/especialistas.json) con sus términos y campos. El título es el nombre completo.
 * La foto destacada, el slug del post (id) y los slugs de que_trata los pone inc/carga-extra.php.
 * que_trata usa el nombre corto (el mismo en cards y perfil).
 */
return [
    'post_type' => 'especialista',
    'terms'     => [
        'tipo_especialista' => ['Psiquiatras', 'Psicólogos'],
        'poblacion'         => ['Niños', 'Pre adolescentes', 'Adolescentes', 'Adultos', 'Adulto mayor'],
        'que_trata'         => ['Depresión', 'Trastornos de ansiedad', 'Trauma (TEPT)', 'TDAH', 'Autismo (TEA)', 'TOC', 'TDC', 'TCA', 'TLP', 'Otros trastornos de la personalidad', 'Psicosis y esquizofrenia', 'Alteraciones del sueño', 'Salud mental perinatal', 'TDPM', 'Trastorno bipolar', 'Trastorno disociativo', 'Adicciones', 'Deterioro cognitivo mayor', 'Relaciones interpersonales', 'Procesos de autoconocimiento', 'Crisis vitales', 'Duelo', 'Dificultades de aprendizaje', 'Orientación vocacional'],
        'idioma'            => ['Español', 'Inglés', 'Portugués'],
        'modalidad'         => ['Online', 'Presencial (Surco)'],
    ],
    'items'     => [
        [
            'id'     => 'mariela-linares',
            'titulo' => 'Dra. Mariela Linares Linares',
            'terms'  => [
                'tipo_especialista' => ['Psiquiatras'],
                'poblacion'         => ['Adolescentes', 'Adultos', 'Adulto mayor'],
                'que_trata'         => ['Depresión', 'Trastornos de ansiedad', 'Trauma (TEPT)', 'TDAH', 'Autismo (TEA)', 'TOC', 'TDC', 'TCA', 'TLP', 'Otros trastornos de la personalidad', 'Alteraciones del sueño', 'Salud mental perinatal', 'TDPM', 'Trastorno bipolar', 'Trastorno disociativo'],
                'idioma'            => ['Español', 'Inglés', 'Portugués'],
                'modalidad'         => ['Online', 'Presencial (Surco)'],
            ],
            'fields' => [
                'especialista_perfil'    => [
                    'nombre_corto'    => 'Dra. Mariela Linares',
                    'cargo'           => 'Médica psiquiatra',
                    'cargo_destacado' => 'Directora Médica de Lumenti',
                    'colegiaturas'    => [
                        [
                            'registro' => 'CMP 080939',
                        ],
                        [
                            'registro' => 'RNE 045256',
                        ],
                    ],
                ],
                'especialista_resumen'   => [
                    'nota_adultos' => '',
                    'enfoques'     => [],
                ],
                'especialista_sobre'     => [
                    'biografia' => '<p>Mariela es médica psiquiatra y miembro de la Asociación de Psiquiatría Peruana. Su trayectoria integra la práctica clínica, la docencia y la divulgación científica aplicada, participando como conferencista, capacitadora e invitada en medios para acercar la psiquiatría a distintas audiencias con claridad, empatía y sensibilidad humana.</p><p>En su práctica clínica, Mariela le da especial importancia a la historia personal de cada paciente. Considera que comprender el contexto, las experiencias y la forma en que cada persona ha construido su mundo interno es fundamental para entender el origen de muchos malestares actuales y diseñar un tratamiento realmente personalizado.</p><p>Se formó como médico en la Universidad Peruana de Ciencias Aplicadas (UPC) y especialista en Psiquiatría en la Universidad Nacional Mayor de San Marcos y el Hospital Hermilio Valdizán, una de las instituciones referentes en salud mental del país. Además, cuenta con formación complementaria en Terapia Dialéctico Conductual, terapia de pareja, psiquiatría perinatal y trastornos del sueño, lo que le permite abordar la salud mental desde una perspectiva integral y actualizada.</p><p>Como Directora Médica de Lumenti, lidera un modelo de atención centrado en la evidencia científica, la calidez humana y el acompañamiento personalizado. Su enfoque busca que cada paciente pueda comprender mejor lo que está viviendo, recibir una evaluación cuidadosa y acceder a un tratamiento diseñado según sus necesidades clínicas, emocionales y contextuales.</p><p>Además de su labor asistencial, Mariela es conferencista y speaker en salud mental. Ha participado en talleres corporativos, capacitaciones para profesionales y estudiantes de la salud, paneles, entrevistas y medios de comunicación, traduciendo información científica compleja en mensajes claros, útiles y cercanos para distintas audiencias.</p>',
                ],
                'especialista_frase'     => [
                    'texto' => 'Creo en una psiquiatría que escucha la historia de cada persona con profundidad y respeto. Acompañar no es solo tratar síntomas, sino ayudar a comprender, aceptar y construir una vida con mayor bienestar, sentido y humanidad.',
                    'rol'   => 'Médica Psiquiatra · Directora Médica',
                    'foto'  => [
                        '_file' => 'assets/img/esp/mariela-linares-escribiendo.webp',
                        'alt'   => 'Dra. Mariela Linares escribiendo en su consultorio',
                    ],
                ],
                'especialista_formacion' => [
                    'items' => [
                        [
                            'titulo'      => 'Especialidad en Psiquiatría',
                            'institucion' => 'Universidad Nacional Mayor de San Marcos / Hospital Hermilio Valdizán',
                        ],
                        [
                            'titulo'      => 'Medicina Humana',
                            'institucion' => 'Universidad Peruana de Ciencias Aplicadas, décimo superior',
                        ],
                        [
                            'titulo'      => 'Psicoterapeuta DBT',
                            'institucion' => 'Corriente Dialéctica',
                        ],
                        [
                            'titulo'      => 'Terapia de Pareja',
                            'institucion' => 'IFASIL',
                        ],
                        [
                            'titulo'      => 'Psiquiatría Perinatal',
                            'institucion' => 'Instituto Europeo de Salud Mental Perinatal',
                        ],
                        [
                            'titulo'      => 'Diplomado en Trastornos del Sueño y Vigilia',
                            'institucion' => 'Universidad Tecnológica',
                        ],
                    ],
                ],
            ],
        ],
        [
            'id'     => 'francesca-valdivia',
            'titulo' => 'Dra. María Francesca Valdivia Francia',
            'terms'  => [
                'tipo_especialista' => ['Psiquiatras'],
                'poblacion'         => ['Pre adolescentes', 'Adolescentes', 'Adultos', 'Adulto mayor'],
                'que_trata'         => ['Depresión', 'Trastornos de ansiedad', 'Trauma (TEPT)', 'TDAH', 'Autismo (TEA)', 'TOC', 'TDC', 'TCA', 'TLP', 'Otros trastornos de la personalidad', 'Psicosis y esquizofrenia', 'Alteraciones del sueño', 'Salud mental perinatal', 'TDPM', 'Trastorno bipolar', 'Trastorno disociativo', 'Adicciones', 'Deterioro cognitivo mayor'],
                'idioma'            => ['Español', 'Inglés'],
                'modalidad'         => ['Online', 'Presencial (Surco)'],
            ],
            'fields' => [
                'especialista_perfil'    => [
                    'nombre_corto'    => 'Dra. Francesca Valdivia',
                    'cargo'           => 'Médica psiquiatra',
                    'cargo_destacado' => '',
                    'colegiaturas'    => [
                        [
                            'registro' => 'CMP 069020',
                        ],
                        [
                            'registro' => 'RNE 046602',
                        ],
                    ],
                ],
                'especialista_resumen'   => [
                    'nota_adultos' => '',
                    'enfoques'     => [],
                ],
                'especialista_sobre'     => [
                    'biografia' => '<p>Francesca es médica psiquiatra, miembro de la Asociación Psiquiátrica Peruana y parte del Grupo de Trabajo de Psiquiatría Perinatal de la APP. Su trayectoria integra la práctica clínica especializada, la docencia universitaria y la formación en terapia familiar sistémica, con una mirada amplia de la salud mental y de los vínculos que influyen en el bienestar de cada persona.</p><p>Su práctica clínica se caracteriza por una escucha cuidadosa, un trato cercano y una comprensión integral de cada paciente. Francesca considera importante entender no solo los síntomas, sino también la historia personal, familiar y relacional de cada persona, para construir un tratamiento que responda a sus necesidades clínicas, emocionales y contextuales.</p><p>Se formó como médica en la Universidad de San Martín de Porres y como especialista en Psiquiatría en la Universidad Nacional Mayor de San Marcos y el Hospital Hermilio Valdizán. Además, cuenta con formación en Terapia Familiar Sistémica por FASIS y realizó una rotación externa en Psiquiatría de Enlace en el Hospital Universitario de San Vicente Fundación, en Medellín, Colombia.</p><p>Su trayectoria profesional incluye experiencia en el Hospital Hermilio Valdizán —donde hoy sigue laborando—, centros de salud mental comunitaria, instituciones privadas de salud y docencia universitaria. Esta combinación le permite integrar una mirada médica, psicoterapéutica y académica en el acompañamiento de sus pacientes.</p><p>En Lumenti, Francesca aporta una atención psiquiátrica basada en evidencia, sensibilidad clínica y una comprensión profunda del entorno familiar y relacional. Su enfoque busca que cada paciente pueda sentirse escuchado, comprender mejor lo que está viviendo y acceder a un tratamiento personalizado, cuidadoso y humano.</p>',
                ],
                'especialista_frase'     => [
                    'texto' => 'Creo en una psiquiatría que escucha a la persona dentro de su historia, sus vínculos y su contexto. Acompañar implica mirar más allá del síntoma, comprender con profundidad y construir un tratamiento humano, cuidadoso y basado en evidencia.',
                    'rol'   => 'Médica Psiquiatra',
                ],
                'especialista_formacion' => [
                    'items' => [
                        [
                            'titulo'      => 'Especialidad en Psiquiatría',
                            'institucion' => 'Universidad Nacional Mayor de San Marcos / Hospital Hermilio Valdizán',
                        ],
                        [
                            'titulo'      => 'Medicina Humana',
                            'institucion' => 'Universidad de San Martín de Porres',
                        ],
                        [
                            'titulo'      => 'Terapia Familiar Sistémica',
                            'institucion' => 'FASIS, Grupo de Formación, Asistencia e Investigación en Terapia Familiar Sistémica',
                        ],
                        [
                            'titulo'      => 'Rotación externa en Psiquiatría de Enlace',
                            'institucion' => 'Hospital Universitario de San Vicente Fundación, Medellín, Colombia',
                        ],
                        [
                            'titulo'      => 'Manejo Conductual-Contextual del Suicidio',
                            'institucion' => 'CENTIDOS',
                        ],
                    ],
                ],
            ],
        ],
        [
            'id'     => 'fabrizio-martinez',
            'titulo' => 'Dr. Fabrizio Martínez Ríos',
            'terms'  => [
                'tipo_especialista' => ['Psiquiatras'],
                'poblacion'         => ['Adolescentes', 'Adultos', 'Adulto mayor'],
                'que_trata'         => ['Depresión', 'Trastornos de ansiedad', 'Trauma (TEPT)', 'TDAH', 'Autismo (TEA)', 'TOC', 'TDC', 'TCA', 'TLP', 'Otros trastornos de la personalidad', 'Psicosis y esquizofrenia', 'Alteraciones del sueño', 'Salud mental perinatal', 'TDPM', 'Trastorno bipolar', 'Trastorno disociativo', 'Adicciones', 'Deterioro cognitivo mayor'],
                'idioma'            => ['Español'],
                'modalidad'         => ['Online', 'Presencial (Surco)'],
            ],
            'fields' => [
                'especialista_perfil'    => [
                    'nombre_corto'    => 'Dr. Fabrizio Martínez',
                    'cargo'           => 'Médico psiquiatra',
                    'cargo_destacado' => '',
                    'colegiaturas'    => [
                        [
                            'registro' => 'CMP 077730',
                        ],
                        [
                            'registro' => 'RNE 045803',
                        ],
                    ],
                ],
                'especialista_resumen'   => [
                    'nota_adultos' => '',
                    'enfoques'     => [],
                ],
                'especialista_sobre'     => [
                    'biografia' => '<p>Fabrizio es médico psiquiatra y miembro de la Asociación Psiquiátrica Peruana. Su trayectoria integra la práctica clínica en instituciones públicas y privadas, con una formación orientada a la evaluación psiquiátrica integral, la psicofarmacología, la psicoterapia DBT y la psiquiatría perinatal.</p><p>Su práctica clínica se caracteriza por una escucha cuidadosa, un trato cercano y una mirada integral de cada paciente. Fabrizio considera fundamental comprender no solo los síntomas, sino también la historia personal, el contexto emocional y las necesidades particulares de cada persona, para construir un tratamiento claro, seguro y personalizado.</p><p>Se formó como médico en la Universidad de San Martín de Porres y como especialista en Psiquiatría en la Universidad Nacional Mayor de San Marcos y el Hospital Hermilio Valdizán, una de las instituciones referentes en salud mental del país. Además, cuenta con formación como psicoterapeuta DBT por Corriente Dialéctica, formación en psiquiatría perinatal por el Instituto Europeo de Salud Mental Perinatal y estudios de maestría en psicofarmacología por la Universidad Tecnológica.</p><p>Su experiencia incluye atención psiquiátrica en hospitales regionales y de Lima. Esta trayectoria le permite integrar una mirada clínica sólida, actualizada y sensible a las distintas realidades de sus pacientes.</p><p>En Lumenti, Fabrizio aporta una atención psiquiátrica basada en evidencia, claridad médica y acompañamiento humano, buscando que cada paciente pueda comprender mejor lo que vive y acceder a un tratamiento adaptado a sus necesidades clínicas, emocionales y contextuales.</p>',
                ],
                'especialista_frase'     => [
                    'texto' => 'Creo en una psiquiatría clara, cercana y basada en evidencia. Mi objetivo es que cada persona pueda comprender lo que le ocurre, sentirse acompañada durante su proceso y recibir un tratamiento seguro, personalizado y respetuoso de su historia.',
                    'rol'   => 'Médico Psiquiatra',
                ],
                'especialista_formacion' => [
                    'items' => [
                        [
                            'titulo'      => 'Especialidad en Psiquiatría',
                            'institucion' => 'Universidad Nacional Mayor de San Marcos / Hospital Hermilio Valdizán',
                        ],
                        [
                            'titulo'      => 'Medicina Humana',
                            'institucion' => 'Universidad de San Martín de Porres',
                        ],
                        [
                            'titulo'      => 'Maestría en Psicofarmacología',
                            'institucion' => 'Universidad Tecnológica',
                        ],
                        [
                            'titulo'      => 'Psicoterapeuta DBT',
                            'institucion' => 'Corriente Dialéctica',
                        ],
                        [
                            'titulo'      => 'Psiquiatría Perinatal',
                            'institucion' => 'Instituto Europeo de Salud Mental Perinatal',
                        ],
                    ],
                ],
            ],
        ],
        [
            'id'     => 'francesca-demarini',
            'titulo' => 'Dra. Francesca Demarini Orellana',
            'terms'  => [
                'tipo_especialista' => ['Psiquiatras'],
                'poblacion'         => ['Pre adolescentes', 'Adolescentes', 'Adultos', 'Adulto mayor'],
                'que_trata'         => ['Depresión', 'Trastornos de ansiedad', 'Trauma (TEPT)', 'TDAH', 'Autismo (TEA)', 'TOC', 'TDC', 'TCA', 'TLP', 'Otros trastornos de la personalidad', 'Psicosis y esquizofrenia', 'Alteraciones del sueño', 'Salud mental perinatal', 'TDPM', 'Trastorno bipolar', 'Trastorno disociativo'],
                'idioma'            => ['Español', 'Inglés'],
                'modalidad'         => ['Online', 'Presencial (Surco)'],
            ],
            'fields' => [
                'especialista_perfil'    => [
                    'nombre_corto'    => 'Dra. Francesca Demarini',
                    'cargo'           => 'Médica psiquiatra',
                    'cargo_destacado' => '',
                    'colegiaturas'    => [
                        [
                            'registro' => 'CMP 074291',
                        ],
                        [
                            'registro' => 'RNE 046248',
                        ],
                    ],
                ],
                'especialista_resumen'   => [
                    'nota_adultos' => '',
                    'enfoques'     => [],
                ],
                'especialista_sobre'     => [
                    'biografia' => '<p>Francesca es médica psiquiatra formada en la Universidad Nacional Mayor de San Marcos y en el Hospital Hermilio Valdizán. Su trayectoria integra la atención clínica especializada, la experiencia en salud mental comunitaria y una formación complementaria en Terapia Dialéctica Conductual y salud mental perinatal.</p><p>Su práctica clínica se caracteriza por una mirada empática, integral e inclusiva. Francesca busca comprender a cada persona desde su historia, su contexto, sus vínculos y sus necesidades particulares, brindando un espacio de atención respetuoso, seguro y basado en evidencia.</p><p>Se formó como médica en la Universidad de San Martín de Porres y realizó la especialidad en Psiquiatría en la Universidad Nacional Mayor de San Marcos. Además, cuenta con formación en Terapia Dialéctica Conductual por Corriente Dialéctica y realizó una pasantía internacional en Psiquiatría Genética y Perinatal en el Instituto Nacional de Psiquiatría Ramón de la Fuente Muñiz, en Ciudad de México.</p><p>Su experiencia incluye atención psiquiátrica en hospitales generales, centros de salud mental comunitaria, consulta externa, hospitalización, emergencia e interconsultas. También ha trabajado con personas que han atravesado situaciones de violencia y poblaciones que requieren una atención especialmente sensible, interdisciplinaria e inclusiva.</p><p>En Lumenti, Francesca aporta una atención psiquiátrica cercana, actualizada y cuidadosamente personalizada. Su enfoque busca que cada paciente pueda comprender mejor lo que vive, recibir una evaluación integral y acceder a un tratamiento seguro, humano y ajustado a sus necesidades clínicas y emocionales.</p>',
                ],
                'especialista_frase'     => [
                    'texto' => 'Creo en una psiquiatría que escucha con respeto, comprende el contexto de cada persona y acompaña desde la evidencia y la empatía. Mi objetivo es brindar un espacio seguro donde cada paciente pueda sentirse comprendido y construir un tratamiento acorde a su historia y necesidades.',
                    'rol'   => 'Médica Psiquiatra',
                ],
                'especialista_formacion' => [
                    'items' => [
                        [
                            'titulo'      => 'Especialidad en Psiquiatría',
                            'institucion' => 'Universidad Nacional Mayor de San Marcos / Hospital Hermilio Valdizán',
                        ],
                        [
                            'titulo'      => 'Medicina Humana',
                            'institucion' => 'Universidad de San Martín de Porres',
                        ],
                        [
                            'titulo'      => 'Terapia Dialéctica Conductual (DBT)',
                            'institucion' => 'Corriente Dialéctica',
                        ],
                        [
                            'titulo'      => 'Pasantía en Psiquiatría Genética y Perinatal',
                            'institucion' => 'Instituto Nacional de Psiquiatría Ramón de la Fuente Muñiz, Ciudad de México',
                        ],
                        [
                            'titulo'      => 'Duelo Gestacional, Perinatal y Neonatal',
                            'institucion' => 'Instituto Nacional Materno Perinatal',
                        ],
                        [
                            'titulo'      => 'Diagnóstico y tratamiento del Trastorno Bipolar',
                            'institucion' => 'IntraMed',
                        ],
                    ],
                ],
            ],
        ],
        [
            'id'     => 'derek-tantalean',
            'titulo' => 'Dr. Jorge Derek Tantaleán Yépez',
            'terms'  => [
                'tipo_especialista' => ['Psiquiatras'],
                'poblacion'         => ['Niños', 'Pre adolescentes', 'Adolescentes', 'Adultos', 'Adulto mayor'],
                'que_trata'         => ['Depresión', 'Trastornos de ansiedad', 'Trauma (TEPT)', 'TDAH', 'Autismo (TEA)', 'TOC', 'TDC', 'TCA', 'TLP', 'Otros trastornos de la personalidad', 'Psicosis y esquizofrenia', 'Alteraciones del sueño', 'Salud mental perinatal', 'TDPM', 'Trastorno bipolar', 'Trastorno disociativo', 'Adicciones', 'Deterioro cognitivo mayor'],
                'idioma'            => ['Español'],
                'modalidad'         => ['Online', 'Presencial (Surco)'],
            ],
            'fields' => [
                'especialista_perfil'    => [
                    'nombre_corto'    => 'Dr. Derek Tantaleán',
                    'cargo'           => 'Médico psiquiatra',
                    'cargo_destacado' => 'Psiquiatría de Niños y Adolescentes',
                    'colegiaturas'    => [
                        [
                            'registro' => 'CMP 080963',
                        ],
                        [
                            'registro' => 'RNE 045790',
                        ],
                        [
                            'registro' => 'RNSE S00760',
                        ],
                    ],
                ],
                'especialista_resumen'   => [
                    'nota_adultos' => '',
                    'enfoques'     => [],
                ],
                'especialista_sobre'     => [
                    'biografia' => '<p>Derek es médico psiquiatra con formación de subespecialidad en Psiquiatría del Niño y del Adolescente. Es miembro de la Asociación Psiquiátrica Peruana y actualmente se desempeña como psiquiatra de niños y adolescentes en Lumenti, además de ejercer como Jefe del Centro de Salud Mental Comunitario Sumaq Kawsay.</p><p>Su práctica clínica se caracteriza por la empatía, la paciencia y una escucha cuidadosa tanto del niño o adolescente como de su familia. Derek busca generar un espacio seguro, respetuoso y sin juicios, donde los padres puedan expresar sus preocupaciones con confianza y el paciente se sienta comprendido. Su enfoque parte de entender cada caso de manera integral, considerando la historia, el entorno familiar, la etapa del desarrollo y el contexto escolar antes de plantear un tratamiento.</p><p>Se formó como médico en la Universidad Peruana de Ciencias Aplicadas y como especialista en Psiquiatría en la Universidad Nacional Mayor de San Marcos y el Hospital Hermilio Valdizán, una de las instituciones referentes en salud mental del país. Posteriormente, realizó la subespecialidad en Psiquiatría del Niño y del Adolescente en la Universidad Ricardo Palma y el Hospital Edgardo Rebagliati Martins, fortaleciendo su mirada clínica hacia la evaluación y tratamiento de dificultades emocionales, conductuales y del neurodesarrollo en etapas tempranas de la vida.</p><p>Su trayectoria combina la atención clínica especializada, la salud mental comunitaria y el liderazgo asistencial. Esta experiencia le permite comprender las necesidades de niños, adolescentes y familias desde una mirada amplia, sensible y conectada con los distintos contextos que influyen en el bienestar emocional.</p><p>En Lumenti, Derek aporta una mirada especializada en psiquiatría infantil y adolescente, integrando evidencia científica, calidez humana y una comprensión profunda del entorno familiar y comunitario. Su enfoque busca acompañar tanto al paciente como a su familia, promoviendo evaluaciones cuidadosas y tratamientos personalizados según cada etapa del desarrollo.</p>',
                ],
                'especialista_frase'     => [
                    'texto' => 'Creo que acompañar la salud mental de niños y adolescentes implica escuchar no solo sus síntomas, sino también su historia, su familia, su entorno y su etapa de desarrollo. Mi objetivo es brindar una atención cuidadosa, respetuosa y basada en evidencia, que ayude a cada paciente y familia a encontrar mayor bienestar.',
                    'rol'   => 'Médico Psiquiatra · Niños y Adolescentes',
                ],
                'especialista_formacion' => [
                    'items' => [
                        [
                            'titulo'      => 'Subespecialidad en Psiquiatría del Niño y del Adolescente',
                            'institucion' => 'Universidad Ricardo Palma / Hospital Edgardo Rebagliati Martins',
                        ],
                        [
                            'titulo'      => 'Especialidad en Psiquiatría',
                            'institucion' => 'Universidad Nacional Mayor de San Marcos / Hospital Hermilio Valdizán',
                        ],
                        [
                            'titulo'      => 'Medicina Humana',
                            'institucion' => 'Universidad Peruana de Ciencias Aplicadas',
                        ],
                        [
                            'titulo'      => 'Terapia Dialéctica Conductual (DBT)',
                            'institucion' => 'Corriente Dialéctica',
                        ],
                        [
                            'titulo'      => 'Salud Mental Afirmativa',
                            'institucion' => 'Más Igualdad Perú',
                        ],
                        [
                            'titulo'      => 'Evaluación y certificación de la persona con discapacidad',
                            'institucion' => 'NTS N.° 127',
                        ],
                        [
                            'titulo'      => 'Transgender Medicine for General Medical Providers',
                            'institucion' => 'Icahn School of Medicine at Mount Sinai',
                        ],
                        [
                            'titulo'      => 'Miembro de WPATH',
                            'institucion' => 'World Professional Association for Transgender Health',
                        ],
                    ],
                ],
            ],
        ],
        [
            'id'     => 'claudia-campos',
            'titulo' => 'Dra. Claudia Campos Pajuelo',
            'terms'  => [
                'tipo_especialista' => ['Psiquiatras'],
                'poblacion'         => ['Adultos'],
                'que_trata'         => ['Depresión', 'Trastornos de ansiedad', 'Trauma (TEPT)', 'TDAH', 'TOC', 'TDC', 'TCA', 'Psicosis y esquizofrenia', 'Alteraciones del sueño', 'Salud mental perinatal', 'TDPM', 'Trastorno disociativo'],
                'idioma'            => ['Español'],
                'modalidad'         => ['Online'],
            ],
            'fields' => [
                'especialista_perfil'    => [
                    'nombre_corto'    => 'Dra. Claudia Campos',
                    'cargo'           => 'Médica psiquiatra',
                    'cargo_destacado' => '',
                    'colegiaturas'    => [
                        [
                            'registro' => 'CMP 064099',
                        ],
                        [
                            'registro' => 'RNE 045613',
                        ],
                    ],
                ],
                'especialista_resumen'   => [
                    'nota_adultos' => '',
                    'enfoques'     => [],
                ],
                'especialista_sobre'     => [
                    'biografia' => '<p>Claudia es médica psiquiatra, miembro asociado de la Asociación Psiquiátrica Peruana, con experiencia en salud mental hospitalaria y comunitaria. Su trayectoria integra la atención clínica especializada, el trabajo en instituciones públicas de salud y una actualización continua en psiquiatría, psicoterapia y abordajes basados en evidencia.</p><p>Su práctica clínica se caracteriza por una escucha empática, clara y respetuosa. Claudia busca comprender a cada paciente desde su historia, sus síntomas, su entorno y sus necesidades particulares, construyendo un espacio de atención seguro donde la persona pueda sentirse escuchada y acompañada durante su proceso.</p><p>Se formó como médica cirujana en la Universidad Privada Antenor Orrego y como especialista en Psiquiatría en la Universidad Nacional Mayor de San Marcos, realizando su residencia médica en el Hospital Hermilio Valdizán. Hoy también trabaja en el Hospital Víctor Ramos Guardia.</p><p>Cuenta con formación complementaria en Terapia Cognitivo-Conductual, Terapia Dialéctica Conductual, primeros auxilios psicológicos, salud mental y lactancia. Esta preparación le permite integrar una mirada clínica amplia, actualizada y sensible a las distintas necesidades de sus pacientes.</p><p>En Lumenti, Claudia aporta una atención psiquiátrica basada en evidencia, calidez y acompañamiento personalizado. Su enfoque busca que cada paciente pueda comprender mejor lo que está viviendo, recibir una evaluación cuidadosa y acceder a un tratamiento seguro, humano y adaptado a su contexto.</p>',
                ],
                'especialista_frase'     => [
                    'texto' => 'Creo en una psiquiatría que escucha con empatía, explica con claridad y acompaña con respeto. Mi objetivo es brindar una atención cuidadosa y basada en evidencia, ayudando a cada persona a comprender lo que vive y a construir un tratamiento acorde a su historia y necesidades.',
                    'rol'   => 'Médica Psiquiatra',
                ],
                'especialista_formacion' => [
                    'items' => [
                        [
                            'titulo'      => 'Especialidad en Psiquiatría',
                            'institucion' => 'Universidad Nacional Mayor de San Marcos / Hospital Hermilio Valdizán',
                        ],
                        [
                            'titulo'      => 'Medicina Humana',
                            'institucion' => 'Universidad Privada Antenor Orrego',
                        ],
                        [
                            'titulo'      => 'Psicoterapia Cognitivo-Conductual (TCC)',
                            'institucion' => 'Formación clínica',
                        ],
                        [
                            'titulo'      => 'Terapia Dialéctica Conductual (DBT)',
                            'institucion' => 'Formación clínica',
                        ],
                    ],
                ],
            ],
        ],
        [
            'id'     => 'fiorella-ruiz',
            'titulo' => 'Dra. Fiorella Ruiz Danckers',
            'terms'  => [
                'tipo_especialista' => ['Psiquiatras'],
                'poblacion'         => ['Pre adolescentes', 'Adolescentes', 'Adultos', 'Adulto mayor'],
                'que_trata'         => ['Depresión', 'Trastornos de ansiedad', 'Trauma (TEPT)', 'TDAH', 'TOC', 'TDC', 'TCA', 'TLP', 'Otros trastornos de la personalidad', 'Psicosis y esquizofrenia', 'Alteraciones del sueño', 'Salud mental perinatal', 'TDPM', 'Trastorno bipolar', 'Trastorno disociativo', 'Adicciones', 'Deterioro cognitivo mayor'],
                'idioma'            => ['Español', 'Inglés'],
                'modalidad'         => ['Online', 'Presencial (Surco)'],
            ],
            'fields' => [
                'especialista_perfil'    => [
                    'nombre_corto'    => 'Dra. Fiorella Ruiz',
                    'cargo'           => 'Médica psiquiatra',
                    'cargo_destacado' => '',
                    'colegiaturas'    => [
                        [
                            'registro' => 'CMP 071786',
                        ],
                        [
                            'registro' => 'RNE 042393',
                        ],
                    ],
                ],
                'especialista_resumen'   => [
                    'nota_adultos' => '',
                    'enfoques'     => [],
                ],
                'especialista_sobre'     => [
                    'biografia' => '<p>Fiorella es médica psiquiatra con experiencia en el ámbito público, privado y académico. Su trayectoria integra la atención clínica especializada, la docencia universitaria, la formación en Terapia Dialéctica Conductual y estudios de máster en Sexología y Terapia de Pareja, lo que le permite abordar la salud mental desde una mirada integral, sensible y actualizada.</p><p>Su práctica clínica se caracteriza por una escucha cercana, empática y respetuosa. Fiorella busca comprender a cada paciente desde su historia, sus síntomas, sus vínculos y su contexto personal, construyendo un espacio de atención seguro donde la persona pueda expresar lo que vive sin sentirse juzgada.</p><p>Se formó como médica en la Universidad de San Martín de Porres y realizó su especialidad en Psiquiatría por la misma universidad, con formación hospitalaria en el Hospital María Auxiliadora, donde se desempeñó como médica residente y jefa de médicos residentes de Psiquiatría. Actualmente continúa laborando como médica asistente de Psiquiatría en dicha institución.</p><p>Además, cuenta con formación psicoterapéutica en Terapia Dialéctica Conductual por Corriente Dialéctica y un Máster en Sexología y Terapia de Pareja por la Universidad a Distancia de Madrid – Grupo AMIR. Esta formación complementa su mirada clínica, permitiéndole abordar aspectos vinculados a la regulación emocional, los vínculos afectivos, la salud sexual y las relaciones de pareja.</p><p>En Lumenti, Fiorella aporta una atención psiquiátrica basada en evidencia, calidez y respeto por la individualidad de cada paciente. Su enfoque busca que cada persona pueda comprender mejor lo que le ocurre, recibir una evaluación cuidadosa y acceder a un tratamiento personalizado según sus necesidades clínicas, emocionales y relacionales.</p>',
                ],
                'especialista_frase'     => [
                    'texto' => 'Creo en una psiquiatría que escucha con respeto la historia, los vínculos y el mundo emocional de cada persona. Mi objetivo es brindar una atención cercana, segura y basada en evidencia, acompañando a cada paciente a comprender lo que vive y construir un tratamiento acorde a sus necesidades.',
                    'rol'   => 'Médica Psiquiatra',
                ],
                'especialista_formacion' => [
                    'items' => [
                        [
                            'titulo'      => 'Especialidad en Psiquiatría',
                            'institucion' => 'Universidad de San Martín de Porres',
                        ],
                        [
                            'titulo'      => 'Medicina Humana',
                            'institucion' => 'Universidad de San Martín de Porres',
                        ],
                        [
                            'titulo'      => 'Máster en Sexología y Terapia de Pareja',
                            'institucion' => 'UDIMA / Grupo AMIR',
                        ],
                        [
                            'titulo'      => 'Terapia Dialéctica Conductual (DBT)',
                            'institucion' => 'Corriente Dialéctica',
                        ],
                        [
                            'titulo'      => 'Diplomado en Salud Ocupacional y Ambiental',
                            'institucion' => 'CIELA, Universidad de Bonn, Alemania',
                        ],
                        [
                            'titulo'      => 'Diplomado en Emergencias Médicas',
                            'institucion' => 'Universidad Nacional San Luis Gonzaga',
                        ],
                    ],
                ],
            ],
        ],
        [
            'id'     => 'jose-munoz',
            'titulo' => 'José Muñoz Castillejo',
            'terms'  => [
                'tipo_especialista' => ['Psicólogos'],
                'poblacion'         => ['Adolescentes', 'Adultos', 'Adulto mayor'],
                'que_trata'         => ['Depresión', 'Trastornos de ansiedad', 'Trauma (TEPT)', 'TDAH', 'Autismo (TEA)', 'TOC', 'TDC', 'TCA', 'TLP', 'Otros trastornos de la personalidad', 'Psicosis y esquizofrenia', 'Alteraciones del sueño', 'Trastorno bipolar', 'Adicciones', 'Relaciones interpersonales', 'Procesos de autoconocimiento', 'Crisis vitales', 'Duelo'],
                'idioma'            => ['Español'],
                'modalidad'         => ['Online', 'Presencial (Surco)'],
            ],
            'fields' => [
                'especialista_perfil'    => [
                    'nombre_corto'    => 'José Muñoz',
                    'cargo'           => 'Psicólogo clínico',
                    'cargo_destacado' => '',
                    'colegiaturas'    => [
                        [
                            'registro' => 'C.Ps.P. 47942',
                        ],
                    ],
                ],
                'especialista_resumen'   => [
                    'nota_adultos' => '',
                    'enfoques'     => [
                        [
                            'nombre' => 'Terapia Dialéctica Conductual (DBT)',
                        ],
                        [
                            'nombre' => 'Terapia de Aceptación y Compromiso (ACT)',
                        ],
                        [
                            'nombre' => 'Psicoterapia Analítica Funcional (FAP)',
                        ],
                        [
                            'nombre' => 'Terapia Cognitivo-Conductual (TCC)',
                        ],
                        [
                            'nombre' => 'Mindfulness',
                        ],
                        [
                            'nombre' => 'Terapias Conductuales Contextuales',
                        ],
                        [
                            'nombre' => 'Intervenciones basadas en evidencia para trauma y conductas de riesgo',
                        ],
                    ],
                ],
                'especialista_sobre'     => [
                    'biografia' => '<p>José brinda un acompañamiento psicoterapéutico basado en evidencia, con una mirada clínica, estructurada y profundamente humana. Su trabajo se orienta a ayudar a las personas a comprender sus patrones emocionales y conductuales, desarrollar habilidades concretas y construir formas más efectivas de afrontar el malestar.</p><p>Su enfoque integra terapias conductuales y contextuales como la Terapia Dialéctica Conductual (DBT), la Terapia de Aceptación y Compromiso (ACT), la Psicoterapia Analítica Funcional (FAP), Mindfulness y Terapia Cognitivo-Conductual (TCC). Desde esta perspectiva, adapta cada proceso terapéutico a las necesidades, objetivos y nivel de complejidad de cada persona.</p><p>Cuenta con experiencia en el abordaje de dificultades emocionales complejas, regulación emocional, trauma, consumo de sustancias, trastornos de la conducta alimentaria y conductas de riesgo, trabajando desde intervenciones psicológicas estructuradas, colaborativas y respaldadas por la evidencia científica.</p>',
                ],
                'especialista_frase'     => [
                    'texto' => 'Creo que la terapia es un espacio para comprender lo que nos pasa, desarrollar habilidades y construir una vida con mayor dirección, incluso cuando atravesamos momentos difíciles. Mi objetivo es acompañarte con claridad, respeto y herramientas basadas en evidencia.',
                    'rol'   => 'Psicólogo Clínico',
                ],
                'especialista_formacion' => [
                    'items' => [
                        [
                            'titulo'      => 'Licenciado en Psicología',
                            'institucion' => 'Universidad Nacional Mayor de San Marcos (UNMSM), Perú',
                        ],
                        [
                            'titulo'      => 'Escuela de Formación en Suicidología y Prevención del Suicidio',
                            'institucion' => 'SENTIDO, Centro Peruano de Suicidología y Prevención del Suicidio',
                        ],
                        [
                            'titulo'      => 'Diplomado en Trauma, Disociación y Suicidio',
                            'institucion' => 'SENTIDO, Centro Peruano de Suicidología y Prevención del Suicidio',
                        ],
                        [
                            'titulo'      => 'Programa de Entrenamiento en Terapia de Aceptación y Compromiso: ACT Esencial',
                            'institucion' => 'Centro InterContext',
                        ],
                        [
                            'titulo'      => 'Programa de Entrenamiento en Terapia Dialéctica Conductual: Protocolos Específicos',
                            'institucion' => 'Centro InterContext',
                        ],
                        [
                            'titulo'      => 'Curso de DBT en el abordaje de las adicciones',
                            'institucion' => 'Instituto Peruano de Análisis Conductual (IPAC)',
                        ],
                        [
                            'titulo'      => 'Curso de Abordaje del Estrés Postraumático desde el Enfoque Contextual',
                            'institucion' => 'Instituto de Psicoterapia y Docencia',
                        ],
                        [
                            'titulo'      => 'Curso-taller en Intervención Terapéutica en Duelo de Sobrevivientes al Suicidio',
                            'institucion' => 'SENTIDO',
                        ],
                        [
                            'titulo'      => 'Curso-taller en Intervención Terapéutica en Violencia Familiar y Abuso Sexual',
                            'institucion' => 'Unidad de Posgrado de la Facultad de Psicología, UNMSM',
                        ],
                    ],
                ],
            ],
        ],
        [
            'id'     => 'allison-garcia',
            'titulo' => 'Allison García Córdova',
            'terms'  => [
                'tipo_especialista' => ['Psicólogos'],
                'poblacion'         => ['Adolescentes', 'Adultos'],
                'que_trata'         => ['Depresión', 'Trastornos de ansiedad', 'Trauma (TEPT)', 'TDAH', 'Autismo (TEA)', 'TOC', 'TDC', 'TCA', 'TLP', 'Otros trastornos de la personalidad', 'Psicosis y esquizofrenia', 'Alteraciones del sueño', 'Salud mental perinatal', 'TDPM', 'Trastorno bipolar', 'Relaciones interpersonales', 'Procesos de autoconocimiento', 'Crisis vitales', 'Duelo'],
                'idioma'            => ['Español'],
                'modalidad'         => ['Online', 'Presencial (Surco)'],
            ],
            'fields' => [
                'especialista_perfil'    => [
                    'nombre_corto'    => 'Allison García',
                    'cargo'           => 'Psicóloga clínica',
                    'cargo_destacado' => '',
                    'colegiaturas'    => [
                        [
                            'registro' => 'C.Ps.P. 75874',
                        ],
                    ],
                ],
                'especialista_resumen'   => [
                    'nota_adultos' => '',
                    'enfoques'     => [
                        [
                            'nombre' => 'Terapia Dialéctica Conductual (DBT)',
                        ],
                        [
                            'nombre' => 'Terapias Contextuales',
                        ],
                        [
                            'nombre' => 'Protocolo Unificado para Trastornos Emocionales',
                        ],
                        [
                            'nombre' => 'Psicoterapia Analítica Funcional (FAP)',
                        ],
                        [
                            'nombre' => 'Activación Conductual',
                        ],
                        [
                            'nombre' => 'Terapia de Conducta',
                        ],
                    ],
                ],
                'especialista_sobre'     => [
                    'biografia' => '<p>Allison brinda un acompañamiento psicoterapéutico basado en evidencia, con una mirada cálida, colaborativa y orientada al desarrollo de habilidades para afrontar las dificultades emocionales de manera más efectiva.</p><p>Su práctica clínica se fundamenta principalmente en la Terapia Dialéctica Conductual (DBT) y otras terapias contextuales contemporáneas. Desde este enfoque, acompaña a las personas a fortalecer su regulación emocional, mejorar sus relaciones interpersonales, tolerar momentos de malestar y construir una vida más alineada con sus valores y objetivos personales.</p><p>Cuenta con formación especializada en DBT, terapias conductuales-contextuales y abordajes transdiagnósticos, con especial interés en el trabajo con desregulación emocional, trastornos de la conducta alimentaria, dificultades emocionales complejas y procesos terapéuticos que requieren una intervención estructurada y sensible a las necesidades de cada persona.</p>',
                ],
                'especialista_frase'     => [
                    'texto' => 'Creo que la terapia es un espacio para aprender nuevas formas de relacionarnos con nuestras emociones, fortalecer habilidades y construir una vida que valga la pena ser vivida, incluso en medio de las dificultades.',
                    'rol'   => 'Psicóloga Clínica',
                ],
                'especialista_formacion' => [
                    'items' => [
                        [
                            'titulo'      => 'Licenciada en Psicología',
                            'institucion' => 'Universidad Nacional Mayor de San Marcos (UNMSM), Perú',
                        ],
                        [
                            'titulo'      => 'Colegiada',
                            'institucion' => 'Colegio de Psicólogos del Perú, C.Ps.P. 75874',
                        ],
                        [
                            'titulo'      => 'Especialización en Terapia Dialéctica Comportamental (DBT)',
                            'institucion' => 'Contexto, Perú',
                        ],
                        [
                            'titulo'      => 'Especialización Transdiagnóstica en Trastornos de la Conducta Alimentaria (TCA)',
                            'institucion' => 'Somos Mente y Cuerpo',
                        ],
                        [
                            'titulo'      => 'Entrenamiento en Protocolo Unificado de Barlow para Trastornos Emocionales, Nivel 1',
                            'institucion' => 'ITACA',
                        ],
                        [
                            'titulo'      => 'Formación en Psicoterapia Analítica Funcional (FAP)',
                            'institucion' => 'Intercontext',
                        ],
                        [
                            'titulo'      => 'Abordaje Transdiagnóstico en Trastornos de la Conducta Alimentaria',
                            'institucion' => 'Somos Mente y Cuerpo',
                        ],
                        [
                            'titulo'      => 'Abordaje del Estrés Postraumático desde el Enfoque Contextual',
                            'institucion' => 'Instituto de Psicoterapia y Docencia e IAPSI',
                        ],
                        [
                            'titulo'      => 'Entrenamiento en Activación Conductual',
                            'institucion' => 'IPAC',
                        ],
                        [
                            'titulo'      => 'Terapia de Conducta para la Depresión',
                            'institucion' => 'Sociedad de Analistas de la Conducta',
                        ],
                        [
                            'titulo'      => 'Evaluación Clínica en Salud Mental',
                            'institucion' => 'Sociedad de Analistas de la Conducta',
                        ],
                    ],
                ],
            ],
        ],
        [
            'id'     => 'valeria-torres',
            'titulo' => 'Valeria Torres Ruiz',
            'terms'  => [
                'tipo_especialista' => ['Psicólogos'],
                'poblacion'         => ['Adultos'],
                'que_trata'         => ['Depresión', 'Trastornos de ansiedad', 'TDAH', 'Autismo (TEA)', 'TOC', 'TDC', 'Alteraciones del sueño', 'Salud mental perinatal', 'TDPM', 'Relaciones interpersonales', 'Procesos de autoconocimiento', 'Crisis vitales', 'Duelo', 'Orientación vocacional'],
                'idioma'            => ['Español'],
                'modalidad'         => ['Online', 'Presencial (Surco)'],
            ],
            'fields' => [
                'especialista_perfil'    => [
                    'nombre_corto'    => 'Valeria Torres',
                    'cargo'           => 'Psicóloga clínica',
                    'cargo_destacado' => '',
                    'colegiaturas'    => [
                        [
                            'registro' => 'C.Ps.P. 76692',
                        ],
                    ],
                ],
                'especialista_resumen'   => [
                    'nota_adultos' => '',
                    'enfoques'     => [
                        [
                            'nombre' => 'Terapia Cognitivo-Conductual (TCC)',
                        ],
                        [
                            'nombre' => 'Terapia de Aceptación y Compromiso (ACT)',
                        ],
                        [
                            'nombre' => 'Psicoterapia Humanista',
                        ],
                    ],
                ],
                'especialista_sobre'     => [
                    'biografia' => '<p>Valeria brinda un acompañamiento psicoterapéutico basado en evidencia, donde la escucha activa, la empatía y el respeto por la historia de cada persona son pilares fundamentales del proceso terapéutico. Su objetivo es ayudar a que las personas desarrollen una mayor comprensión de sí mismas, fortalezcan sus recursos emocionales y generen cambios sostenibles en su bienestar.</p><p>Su enfoque terapéutico combina herramientas de la Terapia Cognitivo-Conductual (TCC), la Terapia de Aceptación y Compromiso (ACT) y otros modelos contemporáneos de psicoterapia. Considera que cada proceso es único, por lo que adapta la intervención a las necesidades, objetivos y momento de vida de cada persona.</p><p>Se caracteriza por una atención cálida, cercana y clara, orientada a que las personas comprendan mejor sus emociones, desarrollen mayor flexibilidad psicológica y construyan estrategias prácticas para afrontar los desafíos de la vida cotidiana.</p>',
                ],
                'especialista_frase'     => [
                    'texto' => 'Creo que la psicoterapia es un espacio para comprendernos con mayor profundidad, desarrollar nuevas herramientas y aprender a relacionarnos de una manera más saludable con nuestras emociones. Mi objetivo es acompañarte con empatía, claridad y respaldo científico durante ese proceso.',
                    'rol'   => 'Psicóloga Clínica',
                ],
                'especialista_formacion' => [
                    'items' => [
                        [
                            'titulo'      => 'Licenciada en Psicología',
                            'institucion' => 'Universidad Femenina del Sagrado Corazón (UNIFÉ), Perú',
                        ],
                        [
                            'titulo'      => 'Colegiada',
                            'institucion' => 'Colegio de Psicólogos del Perú, C.Ps.P. 76692',
                        ],
                        [
                            'titulo'      => 'Formación en Terapia de Aceptación y Compromiso (ACT)',
                            'institucion' => 'Values, Perú',
                        ],
                        [
                            'titulo'      => 'Diplomado en Terapia Cognitivo-Conductual (TCC)',
                            'institucion' => 'Escuela de posgrado de México',
                        ],
                        [
                            'titulo'      => 'Formación en Terapia Cognitivo-Conductual (TCC)',
                            'institucion' => 'IPETEC (Instituto Peruano de Terapia Cognitivo Conductual), Perú',
                        ],
                        [
                            'titulo'      => 'Formación en Terapia Dialéctica Conductual (DBT)',
                            'institucion' => 'Tres Olas, Perú',
                        ],
                        [
                            'titulo'      => 'Formación en Psicoterapia Humanista',
                            'institucion' => 'EPHE (Escuela Peruana de Humanidades y Estudios Existenciales), Perú',
                        ],
                    ],
                ],
            ],
        ],
        [
            'id'     => 'dora-pflucker',
            'titulo' => 'Dora Cristina Pflucker Muñoz',
            'terms'  => [
                'tipo_especialista' => ['Psicólogos'],
                'poblacion'         => ['Pre adolescentes', 'Adolescentes', 'Adultos', 'Adulto mayor'],
                'que_trata'         => ['Depresión', 'Trastornos de ansiedad', 'Trauma (TEPT)', 'TDAH', 'Autismo (TEA)', 'TOC', 'Alteraciones del sueño', 'TDPM', 'Relaciones interpersonales', 'Procesos de autoconocimiento', 'Crisis vitales', 'Duelo', 'Dificultades de aprendizaje', 'Orientación vocacional'],
                'idioma'            => ['Español'],
                'modalidad'         => ['Online', 'Presencial (Surco)'],
            ],
            'fields' => [
                'especialista_perfil'    => [
                    'nombre_corto'    => 'Dora Pflucker',
                    'cargo'           => 'Psicóloga clínica',
                    'cargo_destacado' => '',
                    'colegiaturas'    => [
                        [
                            'registro' => 'C.Ps.P. 32634',
                        ],
                    ],
                ],
                'especialista_resumen'   => [
                    'nota_adultos' => '',
                    'enfoques'     => [
                        [
                            'nombre' => 'Análisis Transaccional',
                        ],
                        [
                            'nombre' => 'Terapias Contextuales',
                        ],
                        [
                            'nombre' => 'Psicotraumatología',
                        ],
                        [
                            'nombre' => 'Primeros auxilios psicológicos',
                        ],
                        [
                            'nombre' => 'Psicoeducación en salud mental',
                        ],
                    ],
                ],
                'especialista_sobre'     => [
                    'biografia' => '<p>Dora brinda un acompañamiento psicoterapéutico cálido, reflexivo y basado en evidencia, orientado a que cada persona pueda comprender mejor su mundo emocional, fortalecer sus recursos personales y desarrollar formas más saludables de relacionarse consigo misma y con los demás.</p><p>Su trabajo integra herramientas de la Terapia Dialéctico Conductual (DBT), el Análisis Transaccional, las terapias contextuales y la psicotraumatología. Desde esta mirada, acompaña procesos relacionados con la regulación emocional, autoestima, vínculos, manejo del estrés, crisis personales y crecimiento personal.</p><p>Además de su experiencia clínica, cuenta con una sólida trayectoria como docente universitaria y facilitadora de talleres psicoeducativos, lo que le permite transmitir herramientas psicológicas de manera clara, cercana y práctica, tanto en procesos individuales como grupales.</p>',
                ],
                'especialista_frase'     => [
                    'texto' => 'Creo que la terapia es un espacio para comprender nuestra historia, fortalecer nuestros recursos y aprender nuevas formas de responder a lo que vivimos. Mi objetivo es acompañarte con calidez, claridad y herramientas que puedas llevar a tu vida cotidiana.',
                    'rol'   => 'Psicóloga Clínica',
                ],
                'especialista_formacion' => [
                    'items' => [
                        [
                            'titulo'      => 'Licenciada en Psicología',
                            'institucion' => 'Universidad Científica del Sur, Perú',
                        ],
                        [
                            'titulo'      => 'Maestría en Diagnóstico e Intervención Psicoeducativa',
                            'institucion' => 'Universidad Femenina del Sagrado Corazón (UNIFÉ), Perú',
                        ],
                        [
                            'titulo'      => 'Formación en Terapia Dialéctico Conductual (DBT)',
                            'institucion' => 'CENTIDOS, Perú',
                        ],
                        [
                            'titulo'      => 'Formación en Análisis Transaccional',
                            'institucion' => 'Mario Ledesma y Favio Vega',
                        ],
                        [
                            'titulo'      => 'Formación en Psicotraumatología',
                            'institucion' => 'Instituto Newman',
                        ],
                        [
                            'titulo'      => 'Formación en Terapias Contextuales',
                            'institucion' => 'ÍTACA Formación',
                        ],
                        [
                            'titulo'      => 'Curso de Destrezas para la Recuperación Psicológica y Primeros Auxilios Psicológicos',
                            'institucion' => 'The National Child Traumatic Stress Network (NCTSN)',
                        ],
                        [
                            'titulo'      => 'Seminarios en terapia familiar, infancia, adolescencia, adicciones y psicodrama relacional',
                            'institucion' => 'REDES, Centro de Terapia de Familia y Parejas',
                        ],
                    ],
                ],
            ],
        ],
        [
            'id'     => 'valentina-gordillo',
            'titulo' => 'Valentina Gordillo Valdez',
            'terms'  => [
                'tipo_especialista' => ['Psicólogos'],
                'poblacion'         => ['Niños', 'Pre adolescentes', 'Adolescentes', 'Adultos'],
                'que_trata'         => ['Depresión', 'Trastornos de ansiedad', 'TDAH', 'Autismo (TEA)', 'TOC', 'TDC', 'TCA', 'TDPM', 'Relaciones interpersonales', 'Procesos de autoconocimiento', 'Crisis vitales', 'Dificultades de aprendizaje'],
                'idioma'            => ['Español', 'Inglés'],
                'modalidad'         => ['Online', 'Presencial (Surco)'],
            ],
            'fields' => [
                'especialista_perfil'    => [
                    'nombre_corto'    => 'Valentina Gordillo',
                    'cargo'           => 'Psicóloga clínica',
                    'cargo_destacado' => '',
                    'colegiaturas'    => [
                        [
                            'registro' => 'C.Ps.P. 75038',
                        ],
                    ],
                ],
                'especialista_resumen'   => [
                    'nota_adultos' => 'hasta 22 años',
                    'enfoques'     => [
                        [
                            'nombre' => 'Terapias de Tercera Generación',
                        ],
                        [
                            'nombre' => 'Terapia de Esquemas',
                        ],
                        [
                            'nombre' => 'Orientación y acompañamiento psicológico',
                        ],
                        [
                            'nombre' => 'Evaluación psicológica',
                        ],
                    ],
                ],
                'especialista_sobre'     => [
                    'biografia' => '<p>Valentina brinda un acompañamiento psicoterapéutico basado en evidencia, caracterizado por la cercanía, la empatía y el respeto por la individualidad de cada persona. Tiene especial interés en el trabajo con niños, adolescentes y sus familias, promoviendo espacios seguros donde puedan desarrollar herramientas para afrontar los desafíos emocionales, conductuales y relacionales propios de cada etapa del desarrollo.</p><p>Su enfoque integra conocimientos de las terapias contextuales y otros modelos contemporáneos de psicoterapia, adaptando cada proceso a las necesidades particulares de quien consulta. Busca generar un entorno cálido y colaborativo que favorezca el bienestar emocional, el autoconocimiento y el fortalecimiento de habilidades para la vida cotidiana.</p><p>Además, cuenta con experiencia en contextos clínicos y educativos, participando en procesos de acompañamiento psicológico, evaluación, orientación a familias y trabajo interdisciplinario con instituciones educativas, lo que le permite comprender de manera integral las necesidades de niños y adolescentes.</p>',
                ],
                'especialista_frase'     => [
                    'texto' => 'Creo que cada niño y adolescente tiene fortalezas que pueden desarrollarse cuando encuentran un espacio seguro para sentirse escuchados y comprendidos. Mi objetivo es acompañarlos con empatía y herramientas basadas en evidencia para favorecer su bienestar y desarrollo emocional.',
                    'rol'   => 'Psicóloga Clínica',
                ],
                'especialista_formacion' => [
                    'items' => [
                        [
                            'titulo'      => 'Licenciada en Psicología',
                            'institucion' => 'Universidad de Lima, Perú',
                        ],
                        [
                            'titulo'      => 'Colegiada',
                            'institucion' => 'Colegio de Psicólogos del Perú, C.Ps.P. 75038',
                        ],
                        [
                            'titulo'      => 'Diplomado en Psicología Infantil',
                            'institucion' => 'Escuela de Posgrado de México',
                        ],
                        [
                            'titulo'      => 'Diplomado en Terapias de Tercera Generación y Terapias Contextuales',
                            'institucion' => 'Escuela de Posgrado de México',
                        ],
                    ],
                ],
            ],
        ],
        [
            'id'     => 'anthony-roman',
            'titulo' => 'Anthony Román Solano',
            'terms'  => [
                'tipo_especialista' => ['Psicólogos'],
                'poblacion'         => ['Adolescentes', 'Adultos'],
                'que_trata'         => ['Depresión', 'Trastornos de ansiedad', 'Trauma (TEPT)', 'TDAH', 'Autismo (TEA)', 'TOC', 'TDC', 'TCA', 'TLP', 'Otros trastornos de la personalidad', 'Psicosis y esquizofrenia', 'Alteraciones del sueño', 'Salud mental perinatal', 'TDPM', 'Trastorno bipolar', 'Relaciones interpersonales', 'Procesos de autoconocimiento', 'Crisis vitales', 'Duelo'],
                'idioma'            => ['Español'],
                'modalidad'         => ['Online', 'Presencial (Surco)'],
            ],
            'fields' => [
                'especialista_perfil'    => [
                    'nombre_corto'    => 'Anthony Román',
                    'cargo'           => 'Psicólogo clínico',
                    'cargo_destacado' => '',
                    'colegiaturas'    => [
                        [
                            'registro' => 'C.Ps.P. 76661',
                        ],
                    ],
                ],
                'especialista_resumen'   => [
                    'nota_adultos' => '',
                    'enfoques'     => [
                        [
                            'nombre' => 'Terapia de Aceptación y Compromiso (ACT)',
                        ],
                        [
                            'nombre' => 'Terapia Dialéctica Conductual (DBT)',
                        ],
                        [
                            'nombre' => 'Psicoterapia Analítica Funcional (FAP)',
                        ],
                    ],
                ],
                'especialista_sobre'     => [
                    'biografia' => '<p>Anthony brinda un acompañamiento psicoterapéutico basado en evidencia, con un estilo cálido, empático y colaborativo. Su trabajo se orienta a construir un espacio de confianza donde cada persona pueda comprender mejor lo que está viviendo, desarrollar habilidades para afrontar sus dificultades y avanzar hacia una vida más conectada con aquello que considera importante.</p><p>Su práctica clínica integra herramientas de la Terapia Dialéctica Conductual (DBT), la Terapia de Aceptación y Compromiso (ACT) y la Psicoterapia Analítica Funcional (FAP). Desde estos enfoques, acompaña a las personas a fortalecer su regulación emocional, relacionarse con mayor flexibilidad con sus pensamientos y emociones, mejorar sus vínculos y construir cambios significativos en su vida cotidiana.</p><p>Cuenta con experiencia en la atención de jóvenes y adultos con dificultades de regulación emocional, depresión, ansiedad, trastorno obsesivo-compulsivo y dificultades interpersonales. Su formación en terapias contextuales y su compromiso con la actualización continua le permiten adaptar el proceso terapéutico a las necesidades, objetivos e historia de cada persona.</p>',
                ],
                'especialista_frase'     => [
                    'texto' => 'Creo en una terapia donde puedas sentirte escuchado y acompañado, aprender nuevas formas de relacionarte contigo mismo y con los demás, y dar pasos hacia la vida que deseas construir.',
                    'rol'   => 'Psicólogo Clínico',
                ],
                'especialista_formacion' => [
                    'items' => [
                        [
                            'titulo'      => 'Licenciado en Psicología',
                            'institucion' => 'Universidad Nacional Mayor de San Marcos (UNMSM), Perú',
                        ],
                        [
                            'titulo'      => 'Colegiado',
                            'institucion' => 'Colegio de Psicólogos del Perú, C.Ps.P. 76661',
                        ],
                        [
                            'titulo'      => 'Especialización en Terapia Dialéctica Conductual (DBT)',
                            'institucion' => 'Contexto',
                        ],
                        [
                            'titulo'      => 'Formación en Habilidades DBT',
                            'institucion' => 'Contexto',
                        ],
                        [
                            'titulo'      => 'Especialización en Terapia de Aceptación y Compromiso (ACT)',
                            'institucion' => 'Dirección Valiosa',
                        ],
                        [
                            'titulo'      => 'Formación en Psicoterapia Analítica Funcional (FAP)',
                            'institucion' => 'Psicoflix',
                        ],
                        [
                            'titulo'      => 'Formación en Activación Conductual: aplicaciones',
                            'institucion' => 'Liceo Contextual',
                        ],
                        [
                            'titulo'      => 'Formación en Evaluación y Tratamiento del Trastorno Obsesivo-Compulsivo (TOC)',
                            'institucion' => 'ALTOC',
                        ],
                    ],
                ],
            ],
        ],
    ],
];
