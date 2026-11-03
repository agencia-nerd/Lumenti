<?php
defined('ABSPATH') || exit;

/*
 * Contenido inicial de Condición (specs/condicion.md): las 16 condiciones del diseño (data/condiciones.json),
 * una por elemento. El título de WordPress es el nombre de la condición; 'id' es su slug (/condicion/<id>/).
 * 'que_trata' no es de wp-acf: es el nombre del término de que_trata (el corto, el mismo de los especialistas)
 * que inc/carga-extra.php guarda en condicion_especialistas_que_trata (campo de inc/campos-extra.php), junto con
 * el slug del post. Ninguno pisa lo editado.
 */
return [
    'post_type' => 'condicion',
    'items'     => [
        [
            'id'        => 'depresion',
            'titulo'    => 'Depresión',
            'que_trata' => 'Depresión',
            'fields'    => [
                'condicion_hero'          => [
                    'titulo' => "*LA DEPRESIÓN*\nTIENE TRATAMIENTO",
                    'nota'   => 'Atención presencial y virtual para cada etapa de la vida.',
                    'bajada' => 'La depresión puede afectar el ánimo, la energía, el sueño, la concentración y la capacidad de disfrutar las actividades cotidianas. No es falta de voluntad ni una tristeza pasajera: con una evaluación adecuada y un tratamiento personalizado, es posible reducir los síntomas y recuperar el bienestar.',
                ],
                'condicion_imagen'        => [
                    'foto'           => [
                        '_file' => 'assets/img/cond-depresion.webp',
                        'alt'   => 'Dos personas tomadas de la mano en señal de apoyo',
                    ],
                    'leyenda_titulo' => '',
                    'leyenda_texto'  => '',
                ],
                'condicion_senales'       => [
                    'titulo'    => 'SEÑALES Y SÍNTOMAS FRECUENTES',
                    'intro'     => 'La depresión puede manifestarse de distintas maneras. Presentar uno o varios de estos signos no confirma por sí solo un diagnóstico, pero puede indicar que es momento de buscar orientación profesional.',
                    'destacado' => '',
                    'grupos'    => [
                        [
                            'titulo' => '',
                            'items'  => [
                                [
                                    'titulo' => 'ÁNIMO BAJO PERSISTENTE',
                                    'texto'  => 'Un estado de tristeza, vacío o desesperanza que se mantiene la mayor parte del día y durante casi todos los días.',
                                ],
                                [
                                    'titulo' => 'PÉRDIDA DE INTERÉS',
                                    'texto'  => 'Dejas de disfrutar actividades, personas o pasatiempos que antes te resultaban placenteros o importantes en tu día a día.',
                                ],
                                [
                                    'titulo' => 'FATIGA Y FALTA DE ENERGÍA',
                                    'texto'  => 'Sensación de cansancio y agotamiento constante, incluso al realizar tareas pequeñas o después de haber descansado.',
                                ],
                                [
                                    'titulo' => 'CAMBIOS EN SUEÑO O APETITO',
                                    'texto'  => 'Dormir o comer mucho más —o mucho menos— de lo habitual, sin una causa física aparente que lo explique.',
                                ],
                                [
                                    'titulo' => 'DIFICULTAD PARA CONCENTRARTE',
                                    'texto'  => 'Cuesta pensar con claridad, mantener la atención, recordar cosas o tomar decisiones cotidianas.',
                                ],
                                [
                                    'titulo' => 'CULPA O INUTILIDAD',
                                    'texto'  => 'Sentimientos de inutilidad o culpa excesiva, incluso por situaciones que antes no te afectaban.',
                                ],
                                [
                                    'titulo' => 'IRRITABILIDAD O INQUIETUD',
                                    'texto'  => 'Mayor sensibilidad, enojo frecuente o sensación de no poder estar en calma.',
                                ],
                                [
                                    'titulo' => 'DESESPERANZA O PENSAMIENTOS RELACIONADOS CON LA MUERTE',
                                    'texto'  => 'Sentir que nada va a mejorar, perder el sentido de las cosas o tener pensamientos sobre no querer continuar son señales que necesitan atención profesional oportuna.',
                                ],
                            ],
                        ],
                    ],
                    'pie'       => '',
                ],
                'condicion_nota'          => [
                    'titulo' => '',
                    'texto'  => '',
                ],
                'condicion_tipos'         => [
                    'variante' => 'sin_bloque',
                    'titulo'   => '',
                    'intro'    => '',
                    'items'    => [],
                ],
                'condicion_abordaje'      => [
                    'titulo' => '¿CÓMO ABORDAMOS LA DEPRESIÓN?',
                    'intro'  => 'Un enfoque integral, personalizado y con acompañamiento en cada etapa, respaldado por evidencia clínica.',
                    'items'  => [
                        [
                            'titulo' => 'EVALUACIÓN INTEGRAL',
                            'texto'  => 'Como punto de partida, en Lumenti solemos recomendar una evaluación por Psiquiatría, especialmente cuando los síntomas son persistentes, intensos o afectan el funcionamiento cotidiano. Durante esta valoración buscamos comprender los síntomas, su evolución y el impacto que están teniendo en tu vida. También revisamos antecedentes, tratamientos previos y otros factores médicos, emocionales o del entorno que puedan estar influyendo, con el objetivo de descartar posibles causas médicas y orientar el plan de tratamiento más adecuado.',
                        ],
                        [
                            'titulo' => 'PLAN DE TRATAMIENTO PERSONALIZADO',
                            'texto'  => 'El tratamiento se define según las características y necesidades de cada persona. Puede integrar psicoterapia, psicoeducación, herramientas para manejar los síntomas, fortalecimiento de la red de apoyo y cambios en hábitos como el sueño y la actividad física. Cuando la evaluación médica indica que puede ser beneficioso, también puede incluir tratamiento farmacológico.',
                        ],
                        [
                            'titulo' => 'SEGUIMIENTO, EVOLUCIÓN Y ALTA',
                            'texto'  => 'A lo largo del tratamiento se evalúan los cambios en los síntomas, el bienestar y el funcionamiento cotidiano. Según la evolución, el profesional puede ajustar las intervenciones o espaciar progresivamente las consultas. Cuando se alcanzan los objetivos terapéuticos y existe una estabilidad sostenida, se planifica el alta de manera conjunta, incorporando herramientas para mantener los avances, reconocer señales de alerta y reducir el riesgo de recaídas.',
                        ],
                    ],
                ],
                'condicion_especialistas' => [],
                'condicion_cta'           => [
                    'titulo'  => 'NO TIENES QUE ATRAVESAR LA DEPRESIÓN SIN APOYO.',
                    'texto'   => 'Escríbenos y te orientaremos para encontrar la atención más adecuada para ti.',
                    'boton'   => 'Solicitar orientación por WhatsApp',
                    'mensaje' => 'Hola, quisiera información sobre el tratamiento de la depresión.',
                ],
            ],
        ],
        [
            'id'        => 'ansiedad',
            'titulo'    => 'Trastornos de ansiedad',
            'que_trata' => 'Trastornos de ansiedad',
            'fields'    => [
                'condicion_hero'          => [
                    'titulo' => "*CUANDO LA ANSIEDAD INTERFIERE*\nEN TU VIDA, HAY TRATAMIENTO.",
                    'nota'   => 'Atención presencial y virtual para cada etapa de la vida.',
                    'bajada' => 'La ansiedad es una respuesta natural ante situaciones de tensión o incertidumbre. Sin embargo, cuando la preocupación o el miedo se vuelven intensos, persistentes o difíciles de controlar, pueden afectar el sueño, las relaciones, los estudios, el trabajo y la vida cotidiana. Los trastornos de ansiedad tienen tratamiento y una evaluación profesional permite identificar el abordaje más adecuado.',
                ],
                'condicion_imagen'        => [
                    'foto'           => [
                        '_file' => 'assets/img/cond-ansiedad.webp',
                        'alt'   => 'Mujer con lentes sosteniendo su cabeza con preocupación',
                    ],
                    'leyenda_titulo' => '',
                    'leyenda_texto'  => '',
                ],
                'condicion_senales'       => [
                    'titulo'    => 'SEÑALES Y SÍNTOMAS FRECUENTES',
                    'intro'     => 'La ansiedad puede manifestarse de distintas maneras. Presentar uno o varios de estos signos no confirma por sí solo un diagnóstico, pero puede indicar que es momento de buscar orientación profesional.',
                    'destacado' => '',
                    'grupos'    => [
                        [
                            'titulo' => '',
                            'items'  => [
                                [
                                    'titulo' => 'PREOCUPACIÓN DIFÍCIL DE CONTROLAR',
                                    'texto'  => 'Pensamientos recurrentes sobre distintos aspectos de la vida que resultan difíciles de detener, incluso cuando intentas distraerte o tranquilizarte.',
                                ],
                                [
                                    'titulo' => 'INQUIETUD O TENSIÓN CONSTANTE',
                                    'texto'  => 'Sensación de estar permanentemente en alerta, con nerviosismo, tensión muscular o dificultad para relajarte.',
                                ],
                                [
                                    'titulo' => 'SENSACIÓN DE PELIGRO O MIEDO INTENSO',
                                    'texto'  => 'Percepción de que algo malo podría ocurrir, aun cuando no existe una amenaza clara o proporcional a la situación.',
                                ],
                                [
                                    'titulo' => 'SÍNTOMAS FÍSICOS',
                                    'texto'  => 'Palpitaciones, sudoración, temblores, presión en el pecho, molestias digestivas, mareos o sensación de falta de aire.',
                                ],
                                [
                                    'titulo' => 'ALTERACIONES DEL SUEÑO Y CANSANCIO',
                                    'texto'  => 'Dificultad para conciliar o mantener el sueño, descanso poco reparador y fatiga durante el día.',
                                ],
                                [
                                    'titulo' => 'IRRITABILIDAD O DIFICULTAD PARA CONCENTRARSE',
                                    'texto'  => 'Mayor sensibilidad, impaciencia o dificultad para mantener la atención y tomar decisiones.',
                                ],
                                [
                                    'titulo' => 'EVITACIÓN',
                                    'texto'  => 'Dejar de acudir a lugares, realizar actividades o enfrentar situaciones por temor a sentir ansiedad, perder el control o que algo malo ocurra.',
                                ],
                            ],
                        ],
                    ],
                    'pie'       => '',
                ],
                'condicion_nota'          => [
                    'titulo' => '',
                    'texto'  => '',
                ],
                'condicion_tipos'         => [
                    'variante' => 'tarjetas',
                    'titulo'   => 'TRASTORNOS DE ANSIEDAD MÁS FRECUENTES',
                    'intro'    => 'La ansiedad puede presentarse de distintas formas. Identificar el tipo de síntomas y las situaciones en las que aparecen permite orientar mejor la evaluación y el tratamiento.',
                    'items'    => [
                        [
                            'titulo' => 'TRASTORNO DE ANSIEDAD GENERALIZADA',
                            'texto'  => 'Preocupación excesiva y difícil de controlar sobre diferentes situaciones de la vida cotidiana, generalmente acompañada de tensión, inquietud, fatiga o problemas de sueño.',
                        ],
                        [
                            'titulo' => 'TRASTORNO DE PÁNICO',
                            'texto'  => 'Crisis repentinas de miedo o malestar intenso, con síntomas como palpitaciones, sensación de falta de aire, mareos o temor a perder el control. También puede aparecer preocupación constante por tener una nueva crisis.',
                        ],
                        [
                            'titulo' => 'ANSIEDAD SOCIAL',
                            'texto'  => 'Miedo intenso a sentirse observado, evaluado o rechazado en situaciones sociales, que puede generar un gran malestar o llevar a evitarlas.',
                        ],
                        [
                            'titulo' => 'FOBIAS ESPECÍFICAS',
                            'texto'  => 'Miedo intenso y desproporcionado ante determinados animales, objetos, procedimientos o situaciones, que suele generar evitación y afectar la vida cotidiana.',
                        ],
                        [
                            'titulo' => 'AGORAFOBIA',
                            'texto'  => 'Miedo o ansiedad ante lugares o situaciones de los que podría resultar difícil salir o recibir ayuda, como espacios concurridos, transporte público o lugares alejados de casa.',
                        ],
                        [
                            'titulo' => 'ANSIEDAD POR SEPARACIÓN',
                            'texto'  => 'Miedo excesivo ante la posibilidad de separarse de una persona con quien existe un vínculo significativo. Puede presentarse tanto en niños como en adultos.',
                        ],
                    ],
                ],
                'condicion_abordaje'      => [
                    'titulo' => '¿CÓMO ABORDAMOS LA ANSIEDAD?',
                    'intro'  => 'Un enfoque integral, personalizado y con acompañamiento en cada etapa, respaldado por evidencia clínica.',
                    'items'  => [
                        [
                            'titulo' => 'EVALUACIÓN INTEGRAL',
                            'texto'  => 'Como punto de partida, solemos recomendar una evaluación por Psiquiatría, especialmente cuando los síntomas son persistentes, intensos, generan manifestaciones físicas o afectan el funcionamiento cotidiano. En ella buscamos comprender los síntomas, sus desencadenantes, su evolución y su impacto en tu vida, y revisamos antecedentes, tratamientos previos y otros factores médicos, emocionales o del entorno, para descartar causas físicas, identificar el tipo de ansiedad y orientar el tratamiento más adecuado.',
                        ],
                        [
                            'titulo' => 'PLAN DE TRATAMIENTO PERSONALIZADO',
                            'texto'  => 'Se define según el tipo de ansiedad y las necesidades de cada persona. Puede integrar psicoterapia, psicoeducación, herramientas para regular los síntomas físicos, técnicas de relajación o atención plena, exposición gradual cuando resulte indicada, fortalecimiento de la red de apoyo y cambios en el sueño, la actividad física y otros hábitos. Si la evaluación médica lo indica, también puede incluir tratamiento farmacológico.',
                        ],
                        [
                            'titulo' => 'SEGUIMIENTO, EVOLUCIÓN Y ALTA',
                            'texto'  => 'Se evalúan los cambios en la intensidad de la ansiedad, sus desencadenantes y su impacto en el funcionamiento cotidiano; según la evolución, el profesional puede ajustar las intervenciones, coordinar con otros especialistas o espaciar las consultas. Al alcanzar los objetivos terapéuticos y una estabilidad sostenida, el alta se planifica en conjunto, con herramientas para mantener los avances, afrontar desencadenantes y reconocer a tiempo señales de recaída.',
                        ],
                    ],
                ],
                'condicion_especialistas' => [],
                'condicion_cta'           => [
                    'titulo'  => 'LA ANSIEDAD NO TIENE QUE LIMITAR TU VIDA.',
                    'texto'   => 'Escríbenos y te orientaremos para encontrar la atención más adecuada para ti.',
                    'boton'   => 'Solicitar orientación por WhatsApp',
                    'mensaje' => 'Hola, quisiera información sobre el tratamiento de los trastornos de ansiedad.',
                ],
            ],
        ],
        [
            'id'        => 'toc',
            'titulo'    => 'Trastorno obsesivo compulsivo',
            'que_trata' => 'TOC',
            'fields'    => [
                'condicion_hero'          => [
                    'titulo' => "*EL TOC*\nMEJORA CON TRATAMIENTO.",
                    'nota'   => 'Atención presencial y virtual para cada etapa de la vida.',
                    'bajada' => 'El TOC se caracteriza por pensamientos, imágenes o impulsos intrusivos que generan malestar —obsesiones— y por conductas o rituales mentales que la persona siente que debe realizar para aliviarlo —compulsiones—. No es simplemente una preferencia por el orden o la limpieza: puede ocupar mucho tiempo e interferir significativamente en la vida cotidiana. Con el tratamiento adecuado, el TOC puede mejorar.',
                ],
                'condicion_imagen'        => [
                    'foto'           => [
                        '_file' => 'assets/img/cond-toc.webp',
                        'alt'   => 'Mujer con las manos en la sien y objetos cotidianos enredados en el cabello',
                    ],
                    'leyenda_titulo' => '',
                    'leyenda_texto'  => '',
                ],
                'condicion_senales'       => [
                    'titulo'    => '¿CÓMO PUEDE MANIFESTARSE EL TOC?',
                    'intro'     => 'El contenido de las obsesiones y compulsiones puede variar ampliamente. Presentar alguno de estos comportamientos no confirma por sí solo un diagnóstico; lo importante es evaluar el malestar, el tiempo que ocupa y cuánto interfiere en la vida cotidiana.',
                    'destacado' => '',
                    'grupos'    => [
                        [
                            'titulo' => '',
                            'items'  => [
                                [
                                    'titulo' => 'CONTAMINACIÓN Y LIMPIEZA',
                                    'texto'  => 'Temor intenso a la suciedad, los gérmenes o la contaminación, acompañado de lavado, limpieza o evitación excesivos.',
                                ],
                                [
                                    'titulo' => 'DUDAS Y COMPROBACIÓN',
                                    'texto'  => 'Necesidad de revisar repetidamente puertas, electrodomésticos, mensajes o tareas por temor a haber cometido un error o causado un daño.',
                                ],
                                [
                                    'titulo' => 'ORDEN, SIMETRÍA O EXACTITUD',
                                    'texto'  => 'Sensación de que los objetos, acciones o pensamientos deben estar ordenados, equilibrados o realizarse de una manera específica para sentir alivio.',
                                ],
                                [
                                    'titulo' => 'BÚSQUEDA DE TRANQUILIDAD',
                                    'texto'  => 'Pedir confirmación repetidamente a otras personas, investigar de forma constante o revisar la propia memoria para sentirse seguro por un momento.',
                                ],
                                [
                                    'titulo' => 'RITUALES MENTALES',
                                    'texto'  => 'Repetir palabras, contar, revisar recuerdos o analizar mentalmente una situación para intentar reducir la incertidumbre o neutralizar un pensamiento.',
                                ],
                                [
                                    'titulo' => 'EVITACIÓN',
                                    'texto'  => 'Evitar lugares, personas, objetos o situaciones que podrían activar las obsesiones o generar la necesidad de realizar compulsiones.',
                                ],
                                [
                                    'titulo' => 'PENSAMIENTOS INTRUSIVOS',
                                    'texto'  => "Pensamientos, imágenes o impulsos no deseados de contenido agresivo, sexual, religioso o moral que generan angustia porque contradicen los valores de la persona.\n\nTenerlos no significa necesariamente desearlos, estar de acuerdo ni tener intención de realizarlos.",
                                ],
                            ],
                        ],
                    ],
                    'pie'       => '',
                ],
                'condicion_nota'          => [
                    'titulo' => '',
                    'texto'  => '',
                ],
                'condicion_tipos'         => [
                    'variante' => 'sin_bloque',
                    'titulo'   => '',
                    'intro'    => '',
                    'items'    => [],
                ],
                'condicion_abordaje'      => [
                    'titulo' => '¿CÓMO ABORDAMOS EL TOC?',
                    'intro'  => 'Un enfoque integral, personalizado y con acompañamiento en cada etapa, respaldado por evidencia clínica.',
                    'items'  => [
                        [
                            'titulo' => 'EVALUACIÓN INTEGRAL',
                            'texto'  => 'Como punto de partida, recomendamos una evaluación por Psiquiatría para comprender las obsesiones, compulsiones, evitaciones y su impacto en la vida cotidiana. Revisamos su evolución, el tiempo que ocupan, tratamientos previos y la posible presencia de ansiedad, depresión, tics u otras condiciones, para diferenciar el TOC de preocupaciones habituales y orientar el tratamiento más adecuado.',
                        ],
                        [
                            'titulo' => 'PLAN DE TRATAMIENTO PERSONALIZADO',
                            'texto'  => 'Se define según la intensidad de los síntomas, el nivel de interferencia y las necesidades de cada persona. Puede incluir psicoterapia especializada basada en evidencia, psicoeducación, herramientas para manejar la ansiedad y la incertidumbre, trabajo con la familia cuando corresponde y cambios en hábitos. Si la evaluación médica lo indica, también puede incorporarse tratamiento farmacológico como parte de un plan integral.',
                        ],
                        [
                            'titulo' => 'SEGUIMIENTO, EVOLUCIÓN Y ALTA',
                            'texto'  => 'Se evalúan los cambios en el tiempo dedicado a las obsesiones y compulsiones, la ansiedad, la evitación y el funcionamiento cotidiano, ajustando las intervenciones y espaciando las consultas según la evolución. Cuando la persona cuenta con herramientas para responder de otra manera ante las obsesiones, el alta se planifica en conjunto, con estrategias para mantener los avances y reconocer señales de recaída.',
                        ],
                    ],
                ],
                'condicion_especialistas' => [],
                'condicion_cta'           => [
                    'titulo'  => 'CON EL TRATAMIENTO ADECUADO, EL TOC PUEDE OCUPAR CADA VEZ MENOS ESPACIO EN TU VIDA.',
                    'texto'   => 'Escríbenos y te orientaremos para encontrar la atención más adecuada para ti.',
                    'boton'   => 'Escríbenos por WhatsApp',
                    'mensaje' => 'Hola, quisiera información sobre el tratamiento de el TOC.',
                ],
            ],
        ],
        [
            'id'        => 'tlp',
            'titulo'    => 'Trastorno límite de la personalidad',
            'que_trata' => 'TLP',
            'fields'    => [
                'condicion_hero'          => [
                    'titulo' => "*EL TLP*\nTIENE TRATAMIENTO.",
                    'nota'   => 'Atención presencial y virtual para cada etapa de la vida.',
                    'bajada' => 'El trastorno límite de la personalidad puede afectar la regulación emocional, la identidad, los impulsos y las relaciones. No es una elección ni un defecto de carácter: con una evaluación adecuada y psicoterapia estructurada, es posible desarrollar herramientas, reducir el malestar y construir una vida más estable.',
                ],
                'condicion_imagen'        => [
                    'foto'           => [
                        '_file' => 'assets/img/cond-tlp.webp',
                        'alt'   => 'Joven pensativa sentada junto a una ventana',
                    ],
                    'leyenda_titulo' => '',
                    'leyenda_texto'  => '',
                ],
                'condicion_senales'       => [
                    'titulo'    => 'SEÑALES FRECUENTES',
                    'intro'     => 'El TLP puede manifestarse de manera diferente en cada persona. Presentar algunas de estas señales no confirma por sí solo un diagnóstico, por lo que es necesaria una evaluación profesional.',
                    'destacado' => '',
                    'grupos'    => [
                        [
                            'titulo' => '',
                            'items'  => [
                                [
                                    'titulo' => 'EMOCIONES INTENSAS Y CAMBIANTES',
                                    'texto'  => 'Experiencias emocionales que pueden aparecer con mucha intensidad y cambiar rápidamente, haciendo difícil recuperar la calma.',
                                ],
                                [
                                    'titulo' => 'TEMOR AL ABANDONO',
                                    'texto'  => 'Miedo intenso a ser rechazado o abandonado, que puede generar angustia y reacciones difíciles de manejar en las relaciones cercanas.',
                                ],
                                [
                                    'titulo' => 'RELACIONES INTERPERSONALES INESTABLES',
                                    'texto'  => 'Vínculos que pueden vivirse con mucha intensidad y pasar rápidamente entre la cercanía, la decepción, el conflicto o el distanciamiento.',
                                ],
                                [
                                    'titulo' => 'IMPULSIVIDAD',
                                    'texto'  => 'Dificultad para detener determinadas conductas, como gastos excesivos, atracones, consumo de sustancias u otras acciones que pueden generar consecuencias negativas.',
                                ],
                                [
                                    'titulo' => 'CAMBIOS EN LA IDENTIDAD O AUTOIMAGEN',
                                    'texto'  => 'Dificultad para mantener una percepción estable de uno mismo, de los propios objetivos o del lugar que se ocupa en las relaciones.',
                                ],
                                [
                                    'titulo' => 'SENSACIÓN PERSISTENTE DE VACÍO',
                                    'texto'  => 'Experiencia frecuente de desconexión, vacío interior o dificultad para encontrar sentido y estabilidad emocional.',
                                ],
                            ],
                        ],
                    ],
                    'pie'       => '',
                ],
                'condicion_nota'          => [
                    'titulo' => '',
                    'texto'  => '',
                ],
                'condicion_tipos'         => [
                    'variante' => 'sin_bloque',
                    'titulo'   => '',
                    'intro'    => '',
                    'items'    => [],
                ],
                'condicion_abordaje'      => [
                    'titulo' => '¿CÓMO ABORDAMOS EL TLP?',
                    'intro'  => 'Un enfoque integral, personalizado y con acompañamiento en cada etapa, respaldado por evidencia clínica.',
                    'items'  => [
                        [
                            'titulo' => 'EVALUACIÓN INTEGRAL',
                            'texto'  => 'Como punto de partida, recomendamos una evaluación por Psiquiatría para comprender los síntomas, su evolución y su impacto en la vida de la persona. Revisamos antecedentes, relaciones, tratamientos previos, posibles situaciones de riesgo y otros factores médicos o emocionales, para diferenciar el TLP de condiciones similares, identificar diagnósticos asociados y orientar el tratamiento más adecuado.',
                        ],
                        [
                            'titulo' => 'PSICOTERAPIA ESPECIALIZADA',
                            'texto'  => 'La psicoterapia estructurada es el componente principal del tratamiento. Trabajamos principalmente con Terapia Dialéctico-Conductual (DBT), un enfoque basado en evidencia para regular emociones intensas, afrontar crisis, reducir conductas impulsivas y construir relaciones más saludables. Según cada caso, puede incluir terapia individual, entrenamiento grupal en habilidades DBT y coordinación con Psiquiatría.',
                        ],
                        [
                            'titulo' => 'SEGUIMIENTO, EVOLUCIÓN Y CIERRE DEL PROCESO',
                            'texto'  => 'Se evalúan los cambios en la regulación emocional, las relaciones, la impulsividad, el funcionamiento cotidiano y las conductas de riesgo, y pueden establecerse planes de seguridad para momentos de crisis. Con mayor estabilidad, las consultas se espacian y, al cumplir los objetivos, el cierre se planifica en conjunto, con herramientas para mantener los avances y reconocer a tiempo señales de desregulación.',
                        ],
                    ],
                ],
                'condicion_especialistas' => [],
                'condicion_cta'           => [
                    'titulo'  => 'EL TLP TIENE TRATAMIENTO Y EL CAMBIO ES POSIBLE.',
                    'texto'   => 'Escríbenos y te orientaremos sobre la atención y el programa más adecuados para ti.',
                    'boton'   => 'Escríbenos por WhatsApp',
                    'mensaje' => 'Hola, quisiera información sobre el tratamiento de el trastorno límite de la personalidad.',
                ],
            ],
        ],
        [
            'id'        => 'bipolar',
            'titulo'    => 'Trastorno bipolar',
            'que_trata' => 'Trastorno bipolar',
            'fields'    => [
                'condicion_hero'          => [
                    'titulo' => "*LA ESTABILIDAD*\nES POSIBLE.",
                    'nota'   => 'Atención presencial y virtual para cada etapa de la vida.',
                    'bajada' => 'El trastorno bipolar se caracteriza por episodios definidos de cambios en el ánimo, la energía y la actividad, que pueden incluir episodios de manía o hipomanía y episodios depresivos. No son cambios cotidianos de humor: con tratamiento y seguimiento, es posible alcanzar estabilidad y reducir el riesgo de nuevos episodios.',
                ],
                'condicion_imagen'        => [
                    'foto'           => [
                        '_file' => 'assets/img/cond-bipolar.webp',
                        'alt'   => 'Mano rozando la hierba al atardecer',
                    ],
                    'leyenda_titulo' => '',
                    'leyenda_texto'  => '',
                ],
                'condicion_senales'       => [
                    'titulo'    => 'SEÑALES FRECUENTES',
                    'intro'     => 'Los síntomas pueden variar en intensidad y duración. Algunas personas presentan periodos prolongados de estabilidad entre episodios y otras pueden experimentar síntomas de manía y depresión al mismo tiempo.',
                    'destacado' => '',
                    'grupos'    => [
                        [
                            'titulo' => 'DURANTE LA MANÍA O HIPOMANÍA',
                            'items'  => [
                                [
                                    'titulo' => 'AUMENTO INUSUAL DE ENERGÍA',
                                    'texto'  => 'Mayor actividad, inquietud o sensación de tener mucha más energía de lo habitual.',
                                ],
                                [
                                    'titulo' => 'MENOR NECESIDAD DE DORMIR',
                                    'texto'  => 'Dormir pocas horas sin sentirse cansado, acompañado de un incremento de la actividad o la energía.',
                                ],
                                [
                                    'titulo' => 'PENSAMIENTOS Y HABLA ACELERADOS',
                                    'texto'  => 'Sensación de que las ideas avanzan muy rápido, hablar más de lo habitual o tener dificultad para mantener la atención en un solo tema.',
                                ],
                                [
                                    'titulo' => 'IMPULSIVIDAD O CONDUCTAS DE RIESGO',
                                    'texto'  => 'Gastos excesivos, decisiones apresuradas, mayor consumo de sustancias, conductas sexuales de riesgo u otras acciones con posibles consecuencias negativas.',
                                ],
                                [
                                    'titulo' => 'EUFORIA, IRRITABILIDAD O CONFIANZA EXCESIVA',
                                    'texto'  => 'Estado de ánimo inusualmente elevado o irritable, acompañado de una seguridad desproporcionada en las propias capacidades.',
                                ],
                            ],
                        ],
                        [
                            'titulo' => 'DURANTE UN EPISODIO DEPRESIVO',
                            'items'  => [
                                [
                                    'titulo' => 'ÁNIMO BAJO O PÉRDIDA DE INTERÉS',
                                    'texto'  => 'Tristeza, vacío, desesperanza o dificultad para disfrutar actividades que anteriormente resultaban importantes.',
                                ],
                                [
                                    'titulo' => 'FATIGA Y CAMBIOS EN EL SUEÑO',
                                    'texto'  => 'Falta de energía, dormir demasiado o muy poco y dificultad para realizar actividades cotidianas.',
                                ],
                                [
                                    'titulo' => 'DIFICULTAD PARA CONCENTRARSE',
                                    'texto'  => 'Problemas para pensar con claridad, recordar información o tomar decisiones.',
                                ],
                                [
                                    'titulo' => 'PENSAMIENTOS MUY NEGATIVOS',
                                    'texto'  => 'Sentimientos de inutilidad, culpa intensa, desesperanza o pensamientos relacionados con no querer continuar.',
                                ],
                            ],
                        ],
                    ],
                    'pie'       => '',
                ],
                'condicion_nota'          => [
                    'titulo' => '',
                    'texto'  => 'La evaluación profesional permite identificar el patrón de los episodios y diferenciarlo de otras condiciones con síntomas similares.',
                ],
                'condicion_tipos'         => [
                    'variante' => 'tabla',
                    'titulo'   => 'PRINCIPALES PRESENTACIONES',
                    'intro'    => '',
                    'items'    => [
                        [
                            'titulo' => 'TRASTORNO BIPOLAR TIPO I',
                            'texto'  => 'Se caracteriza por la presencia de al menos un episodio de manía. También pueden presentarse episodios depresivos, aunque no son indispensables para establecer el diagnóstico.',
                        ],
                        [
                            'titulo' => 'TRASTORNO BIPOLAR TIPO II',
                            'texto'  => 'Incluye episodios de hipomanía y episodios depresivos mayores. La hipomanía es menos intensa que la manía, pero los episodios depresivos pueden generar un impacto significativo.',
                        ],
                        [
                            'titulo' => 'TRASTORNO CICLOTÍMICO',
                            'texto'  => 'Presenta periodos prolongados de síntomas hipomaníacos y depresivos que no alcanzan completamente la intensidad o duración de un episodio definido, pero pueden afectar el bienestar y el funcionamiento.',
                        ],
                    ],
                ],
                'condicion_abordaje'      => [
                    'titulo' => '¿CÓMO ABORDAMOS EL TRASTORNO BIPOLAR?',
                    'intro'  => 'Un enfoque integral, personalizado y con acompañamiento en cada etapa, respaldado por evidencia clínica.',
                    'items'  => [
                        [
                            'titulo' => 'EVALUACIÓN PSIQUIÁTRICA INTEGRAL',
                            'texto'  => "En Lumenti recomendamos iniciar con una evaluación por Psiquiatría. El especialista revisa los cambios en el estado de ánimo, la energía, el sueño y el funcionamiento, así como su intensidad, duración y evolución a lo largo del tiempo. También considera antecedentes personales y familiares, tratamientos previos, consumo de sustancias y posibles factores médicos o medicamentos que puedan estar influyendo.\n\nEsta evaluación permite diferenciar el trastorno bipolar de la depresión unipolar, el TDAH, la ansiedad y otras condiciones que pueden presentar síntomas similares o coexistir. En algunos casos, el diagnóstico requiere seguimiento y observación de la evolución antes de establecerse con mayor claridad.",
                        ],
                        [
                            'titulo' => 'PLAN DE TRATAMIENTO PERSONALIZADO',
                            'texto'  => 'Se define según el tipo de trastorno bipolar, la fase del episodio y la severidad de los síntomas. Generalmente incluye tratamiento farmacológico supervisado por el psiquiatra, psicoeducación, psicoterapia y herramientas para reconocer señales tempranas, junto con factores protectores: horarios regulares de sueño, menor consumo de alcohol y sustancias, red de apoyo y un plan de acción ante cambios en el ánimo.',
                        ],
                        [
                            'titulo' => 'SEGUIMIENTO Y PREVENCIÓN DE RECAÍDAS',
                            'texto'  => 'El seguimiento evalúa la estabilidad del ánimo, el sueño, el funcionamiento cotidiano y la respuesta al tratamiento, con ajustes y consultas cada vez más espaciadas si la evolución es positiva. Con una estabilidad sostenida, el tratamiento entra en una etapa de mantenimiento para prevenir nuevos episodios. Cualquier cambio o retiro de la medicación debe planificarse con el psiquiatra, nunca de forma abrupta ni por cuenta propia.',
                        ],
                    ],
                ],
                'condicion_especialistas' => [],
                'condicion_cta'           => [
                    'titulo'  => 'LA ESTABILIDAD ES POSIBLE. PODEMOS ACOMPAÑARTE.',
                    'texto'   => 'Escríbenos y te orientaremos para encontrar al especialista más adecuado.',
                    'boton'   => 'Escríbenos por WhatsApp',
                    'mensaje' => 'Hola, quisiera información sobre el tratamiento de el trastorno bipolar.',
                ],
            ],
        ],
        [
            'id'        => 'tca',
            'titulo'    => 'Trastornos de la conducta alimentaria',
            'que_trata' => 'TCA',
            'fields'    => [
                'condicion_hero'          => [
                    'titulo' => "*TRASTORNOS DE LA CONDUCTA*\nALIMENTARIA: HAY TRATAMIENTO.",
                    'nota'   => 'Atención presencial y virtual para cada etapa de la vida.',
                    'bajada' => 'Los TCA afectan la relación con la comida, el cuerpo o la imagen corporal y pueden comprometer la salud física y emocional. No son una elección ni se explican solo por el peso o la apariencia: con una detección oportuna y un tratamiento especializado, la recuperación es posible.',
                ],
                'condicion_imagen'        => [
                    'foto'           => [
                        '_file' => 'assets/img/cond-tca.webp',
                        'alt'   => 'Plato vacío con cubiertos atados por una cinta métrica, rodeado de verduras',
                    ],
                    'leyenda_titulo' => '',
                    'leyenda_texto'  => '',
                ],
                'condicion_senales'       => [
                    'titulo'    => 'SEÑALES DE ALERTA',
                    'intro'     => 'Los TCA pueden pasar desapercibidos y manifestarse de distintas maneras. Presentar una o varias de estas señales no confirma por sí solo un diagnóstico, pero puede indicar que es necesario buscar una evaluación profesional.',
                    'destacado' => '',
                    'grupos'    => [
                        [
                            'titulo' => '',
                            'items'  => [
                                [
                                    'titulo' => 'PREOCUPACIÓN CONSTANTE POR LA COMIDA O EL CUERPO',
                                    'texto'  => 'Pensamientos frecuentes sobre el peso, las calorías, la alimentación o la forma corporal que generan malestar y ocupan una parte importante del día.',
                                ],
                                [
                                    'titulo' => 'RESTRICCIÓN O REGLAS RÍGIDAS AL COMER',
                                    'texto'  => 'Eliminar grupos de alimentos, saltarse comidas, reducir progresivamente las porciones o seguir rituales estrictos relacionados con la alimentación.',
                                ],
                                [
                                    'titulo' => 'ATRACONES O SENSACIÓN DE PÉRDIDA DE CONTROL',
                                    'texto'  => 'Episodios en los que se consume una gran cantidad de alimentos con la sensación de no poder detenerse, generalmente acompañados de culpa o malestar.',
                                ],
                                [
                                    'titulo' => 'CONDUCTAS COMPENSATORIAS',
                                    'texto'  => 'Vómitos provocados, uso inadecuado de laxantes, ayunos o ejercicio excesivo para intentar compensar lo que se ha comido.',
                                ],
                                [
                                    'titulo' => 'EVITACIÓN Y AISLAMIENTO',
                                    'texto'  => 'Evitar comer con otras personas, dejar de asistir a reuniones o experimentar ansiedad ante situaciones que involucran alimentos.',
                                ],
                                [
                                    'titulo' => 'CAMBIOS FÍSICOS O EMOCIONALES',
                                    'texto'  => 'Variaciones de peso, cansancio, mareos, alteraciones digestivas, irritabilidad, cambios en el ánimo o dificultades de concentración.',
                                ],
                            ],
                        ],
                    ],
                    'pie'       => '',
                ],
                'condicion_nota'          => [
                    'titulo' => '',
                    'texto'  => '',
                ],
                'condicion_tipos'         => [
                    'variante' => 'tabla',
                    'titulo'   => 'TIPOS DE TCA MÁS FRECUENTES',
                    'intro'    => '',
                    'items'    => [
                        [
                            'titulo' => 'ANOREXIA NERVIOSA',
                            'texto'  => 'Restricción persistente de la alimentación, temor intenso a aumentar de peso y alteraciones en la percepción o valoración del cuerpo. Puede generar consecuencias médicas importantes.',
                        ],
                        [
                            'titulo' => 'BULIMIA NERVIOSA',
                            'texto'  => 'Episodios recurrentes de atracones seguidos de conductas compensatorias, como vómitos, ayunos, uso inadecuado de laxantes o ejercicio excesivo.',
                        ],
                        [
                            'titulo' => 'TRASTORNO POR ATRACÓN',
                            'texto'  => 'Episodios recurrentes de ingesta con sensación de pérdida de control y malestar significativo, sin conductas compensatorias regulares.',
                        ],
                        [
                            'titulo' => 'ARFID',
                            'texto'  => 'Evitación o restricción de alimentos relacionada con características sensoriales, falta de interés en comer o temor a consecuencias negativas, sin que necesariamente exista preocupación por el peso o la imagen corporal.',
                        ],
                        [
                            'titulo' => 'OTROS TCA ESPECIFICADOS',
                            'texto'  => 'Presentaciones que generan malestar o afectan la salud y el funcionamiento, aunque no cumplan todos los criterios de los diagnósticos anteriores.',
                        ],
                    ],
                ],
                'condicion_abordaje'      => [
                    'titulo' => '¿CÓMO ABORDAMOS LOS TCA?',
                    'intro'  => 'Un enfoque integral, personalizado y con acompañamiento en cada etapa, respaldado por evidencia clínica.',
                    'items'  => [
                        [
                            'titulo' => 'EVALUACIÓN INTEGRAL',
                            'texto'  => 'Como punto de partida, recomendamos una evaluación por Psiquiatría para comprender las conductas alimentarias, su evolución y su impacto en la salud física, emocional y en la vida cotidiana. Revisamos antecedentes, tratamientos previos, condiciones asociadas y señales de riesgo y, como los TCA pueden generar complicaciones físicas, según el caso se complementa con valoración médica, análisis de laboratorio y evaluación nutricional.',
                        ],
                        [
                            'titulo' => 'PLAN DE TRATAMIENTO MULTIDISCIPLINARIO',
                            'texto'  => 'Se diseña según el tipo de TCA, la etapa de vida, el estado de salud y las necesidades de cada persona. Puede integrar psicoterapia especializada, psicoeducación, patrones de alimentación más seguros, trabajo sobre la imagen corporal, participación de la familia cuando corresponde y seguimiento médico y nutricional, además de tratamiento para condiciones asociadas como depresión, ansiedad, TDAH o problemas de sueño.',
                        ],
                        [
                            'titulo' => 'SEGUIMIENTO, EVOLUCIÓN Y ALTA',
                            'texto'  => 'Se evalúan los cambios en la alimentación, la salud física, el bienestar emocional y el funcionamiento cotidiano, ajustando las intervenciones y coordinando a los profesionales involucrados. Al alcanzar los objetivos y una estabilidad sostenida, las consultas se espacian y el alta se planifica en conjunto, con herramientas para mantener los avances, reconocer señales de recaída y pedir ayuda a tiempo.',
                        ],
                    ],
                ],
                'condicion_especialistas' => [],
                'condicion_cta'           => [
                    'titulo'  => 'LA RECUPERACIÓN ES POSIBLE Y NO TIENES QUE ATRAVESAR ESTE PROCESO SIN APOYO.',
                    'texto'   => 'Escríbenos y te orientaremos sobre la atención más adecuada según tu situación.',
                    'boton'   => 'Escríbenos por WhatsApp',
                    'mensaje' => 'Hola, quisiera información sobre el tratamiento de los trastornos de la conducta alimentaria.',
                ],
            ],
        ],
        [
            'id'        => 'psicosis',
            'titulo'    => 'Psicosis y esquizofrenia',
            'que_trata' => 'Psicosis y esquizofrenia',
            'fields'    => [
                'condicion_hero'          => [
                    'titulo' => "*LA ATENCIÓN TEMPRANA PUEDE*\nMARCAR UNA DIFERENCIA.",
                    'nota'   => 'Atención presencial y virtual para cada etapa de la vida.',
                    'bajada' => 'La psicosis es un conjunto de síntomas que puede afectar la manera de percibir, pensar e interpretar la realidad. Atravesar un episodio psicótico no significa necesariamente tener esquizofrenia; una evaluación especializada permite comprender qué ocurre y orientar el tratamiento más adecuado.',
                ],
                'condicion_imagen'        => [
                    'foto'           => [
                        '_file' => 'assets/img/cond-psicosis.webp',
                        'alt'   => 'Silueta de una persona con los brazos en alto frente al mar al atardecer',
                    ],
                    'leyenda_titulo' => '',
                    'leyenda_texto'  => '',
                ],
                'condicion_senales'       => [
                    'titulo'    => 'ALGUNAS SEÑALES QUE PUEDEN PRESENTARSE',
                    'intro'     => '',
                    'destacado' => '',
                    'grupos'    => [
                        [
                            'titulo' => '',
                            'items'  => [
                                [
                                    'titulo' => 'CAMBIOS EN LA PERCEPCIÓN',
                                    'texto'  => 'Escuchar, ver o sentir cosas que otras personas no perciben.',
                                ],
                                [
                                    'titulo' => 'CREENCIAS O INTERPRETACIONES DIFÍCILES DE CUESTIONAR',
                                    'texto'  => 'Sentir, por ejemplo, que se está siendo observado, perseguido o amenazado.',
                                ],
                                [
                                    'titulo' => 'PENSAMIENTO O LENGUAJE DESORGANIZADO',
                                    'texto'  => 'Dificultad para ordenar o comunicar las ideas con claridad.',
                                ],
                                [
                                    'titulo' => 'CAMBIOS IMPORTANTES EN LA CONDUCTA',
                                    'texto'  => 'Comportamientos poco habituales o difíciles de comprender para el entorno.',
                                ],
                                [
                                    'titulo' => 'AISLAMIENTO O MENOR INICIATIVA',
                                    'texto'  => 'Pérdida de interés, retraimiento o dificultad para iniciar actividades.',
                                ],
                                [
                                    'titulo' => 'DIFICULTADES COGNITIVAS',
                                    'texto'  => 'Problemas de atención, memoria, planificación u organización.',
                                ],
                                [
                                    'titulo' => 'CAMBIOS EN EL FUNCIONAMIENTO COTIDIANO',
                                    'texto'  => 'Dificultades nuevas o progresivas para estudiar, trabajar, relacionarse o cuidar de uno mismo.',
                                ],
                            ],
                        ],
                    ],
                    'pie'       => '',
                ],
                'condicion_nota'          => [
                    'titulo' => '',
                    'texto'  => '',
                ],
                'condicion_tipos'         => [
                    'variante' => 'comparativa',
                    'titulo'   => '¿CÓMO SE RELACIONAN?',
                    'intro'    => '',
                    'items'    => [
                        [
                            'titulo' => 'PSICOSIS',
                            'texto'  => 'Puede aparecer como un episodio aislado o formar parte de distintos cuadros. También puede estar relacionada con alteraciones del ánimo, consumo de sustancias, medicamentos o algunas condiciones médicas.',
                        ],
                        [
                            'titulo' => 'ESQUIZOFRENIA',
                            'texto'  => 'Es un trastorno de salud mental que puede incluir episodios psicóticos, además de cambios persistentes en la motivación, la expresión emocional, el pensamiento y el funcionamiento cotidiano.',
                        ],
                    ],
                ],
                'condicion_abordaje'      => [
                    'titulo' => '¿CÓMO TE AYUDAMOS?',
                    'intro'  => 'Un enfoque integral, personalizado y con acompañamiento en cada etapa, respaldado por evidencia clínica.',
                    'items'  => [
                        [
                            'titulo' => 'EVALUACIÓN INTEGRAL',
                            'texto'  => 'Recomendamos comenzar con una evaluación por Psiquiatría que explora los síntomas, cuándo comenzaron y cómo afectan la vida diaria, junto con el ánimo, el sueño, los antecedentes, tratamientos previos y el posible consumo de sustancias o medicamentos. Con autorización de la persona, la información de familiares puede ayudar, y según el caso se indican exámenes para descartar otras causas.',
                        ],
                        [
                            'titulo' => 'PLAN DE TRATAMIENTO',
                            'texto'  => 'Se adapta al origen de los síntomas, su intensidad y las necesidades de cada persona. Puede incluir medicación, psicoeducación, psicoterapia, acompañamiento familiar y herramientas para recuperar rutinas, vínculos, autonomía y participación en los estudios o el trabajo, coordinando a los distintos profesionales para ofrecer un abordaje integral.',
                        ],
                        [
                            'titulo' => 'SEGUIMIENTO, ESTABILIDAD Y RECUPERACIÓN',
                            'texto'  => 'Se evalúan los síntomas, el funcionamiento cotidiano, la respuesta al tratamiento y sus efectos secundarios, y se construye un plan ante señales tempranas de descompensación. Con una estabilidad sostenida, las consultas se espacian y el tratamiento se ajusta de forma supervisada: el objetivo es favorecer la autonomía, prevenir recaídas y acompañar la recuperación del proyecto de vida.',
                        ],
                    ],
                ],
                'condicion_especialistas' => [],
                'condicion_cta'           => [
                    'titulo'  => 'COMPRENDER LO QUE ESTÁ OCURRIENDO ES EL PRIMER PASO PARA RECIBIR LA AYUDA ADECUADA.',
                    'texto'   => 'Escríbenos y te orientamos desde el primer contacto.',
                    'boton'   => 'Escríbenos por WhatsApp',
                    'mensaje' => 'Hola, quisiera información sobre el tratamiento de la psicosis y la esquizofrenia.',
                ],
            ],
        ],
        [
            'id'        => 'trauma',
            'titulo'    => 'Trauma y TEPT',
            'que_trata' => 'Trauma (TEPT)',
            'fields'    => [
                'condicion_hero'          => [
                    'titulo' => "*RECUPERAR LA SEGURIDAD*\nES POSIBLE.",
                    'nota'   => 'Atención presencial y virtual para cada etapa de la vida.',
                    'bajada' => 'Algunas experiencias pueden seguir afectando la manera de sentir, relacionarse o desenvolverse en la vida cotidiana. Con atención especializada, es posible comprender estas reacciones, reducir su impacto y recuperar progresivamente el bienestar.',
                ],
                'condicion_imagen'        => [
                    'foto'           => [
                        '_file' => 'assets/img/cond-trauma.webp',
                        'alt'   => 'Silueta de una mujer pensativa junto a una ventana',
                    ],
                    'leyenda_titulo' => '',
                    'leyenda_texto'  => '',
                ],
                'condicion_senales'       => [
                    'titulo'    => 'REACCIONES QUE PUEDEN PRESENTARSE',
                    'intro'     => 'Después de una experiencia traumática pueden aparecer distintas reacciones emocionales, físicas y conductuales. Cuando persisten o interfieren en la vida cotidiana, es recomendable buscar orientación profesional.',
                    'destacado' => '',
                    'grupos'    => [
                        [
                            'titulo' => '',
                            'items'  => [
                                [
                                    'titulo' => 'RECUERDOS INTRUSIVOS',
                                    'texto'  => 'Recuerdos, imágenes, sensaciones o pesadillas que aparecen involuntariamente y generan malestar.',
                                ],
                                [
                                    'titulo' => 'EVITACIÓN',
                                    'texto'  => 'Evitar personas, lugares, actividades o conversaciones que recuerdan lo ocurrido.',
                                ],
                                [
                                    'titulo' => 'ESTADO DE ALERTA',
                                    'texto'  => 'Sobresaltos frecuentes, irritabilidad o sensación persistente de peligro.',
                                ],
                                [
                                    'titulo' => 'DIFICULTADES PARA DORMIR',
                                    'texto'  => 'Problemas para conciliar o mantener el sueño, pesadillas o descanso poco reparador.',
                                ],
                                [
                                    'titulo' => 'CAMBIOS EMOCIONALES',
                                    'texto'  => 'Miedo, culpa, vergüenza, tristeza, desconfianza o dificultad para conectar con otras personas.',
                                ],
                                [
                                    'titulo' => 'DESCONEXIÓN O DISOCIACIÓN',
                                    'texto'  => 'Sensación de estar distante de uno mismo, del entorno o de las propias emociones.',
                                ],
                            ],
                        ],
                    ],
                    'pie'       => '',
                ],
                'condicion_nota'          => [
                    'titulo' => '',
                    'texto'  => '',
                ],
                'condicion_tipos'         => [
                    'variante' => 'comparativa',
                    'titulo'   => 'TRAUMA Y TEPT',
                    'intro'    => '',
                    'items'    => [
                        [
                            'titulo' => 'EXPERIENCIA TRAUMÁTICA',
                            'texto'  => 'Puede ser un evento único o una situación sostenida en el tiempo que sobrepasa los recursos de la persona para afrontarla. Puede estar relacionada con violencia, abuso, accidentes, pérdidas, emergencias médicas u otras experiencias percibidas como amenazantes.',
                        ],
                        [
                            'titulo' => 'TRASTORNO DE ESTRÉS POSTRAUMÁTICO (TEPT)',
                            'texto'  => 'No todas las personas que atraviesan un trauma desarrollan TEPT. Puede aparecer cuando ciertas reacciones persisten, generan un malestar importante e interfieren en la vida cotidiana. Su diagnóstico requiere una evaluación clínica especializada.',
                        ],
                    ],
                ],
                'condicion_abordaje'      => [
                    'titulo' => '¿CÓMO ABORDAMOS EL TRAUMA?',
                    'intro'  => 'Un enfoque integral, personalizado y con acompañamiento en cada etapa, respaldado por evidencia clínica.',
                    'items'  => [
                        [
                            'titulo' => 'EVALUACIÓN INTEGRAL',
                            'texto'  => 'Realizamos una evaluación clínica cuidadosa para comprender la experiencia vivida, las reacciones que han aparecido y su impacto en la vida cotidiana. También exploramos el sueño, el ánimo, la ansiedad, los vínculos y otros factores que puedan influir y, cuando corresponde, usamos escalas validadas como apoyo.',
                        ],
                        [
                            'titulo' => 'PLAN PERSONALIZADO',
                            'texto'  => 'Puede incluir psicoterapia especializada, herramientas para regular las emociones y las respuestas físicas, y un abordaje progresivo de las experiencias vividas, respetando el ritmo y los límites de cada persona. Si los síntomas lo requieren, se complementa con una evaluación por Psiquiatría.',
                        ],
                        [
                            'titulo' => 'SEGUIMIENTO Y AVANCES',
                            'texto'  => 'Evaluamos los cambios en los síntomas, la sensación de seguridad y la recuperación de actividades, vínculos y espacios afectados. Al alcanzar los objetivos, las sesiones se espacian hasta el cierre del proceso, dejando herramientas para afrontar posibles dificultades futuras.',
                        ],
                    ],
                ],
                'condicion_especialistas' => [],
                'condicion_cta'           => [
                    'titulo'  => 'LO VIVIDO FORMA PARTE DE TU HISTORIA, PERO NO TIENE QUE SEGUIR DEFINIENDO TU PRESENTE.',
                    'texto'   => 'Te ayudamos a encontrar al especialista adecuado para iniciar tu proceso.',
                    'boton'   => 'Escríbenos por WhatsApp',
                    'mensaje' => 'Hola, quisiera información sobre el tratamiento de el trauma y el estrés postraumático.',
                ],
            ],
        ],
        [
            'id'        => 'sueno',
            'titulo'    => 'Alteraciones del sueño',
            'que_trata' => 'Alteraciones del sueño',
            'fields'    => [
                'condicion_hero'          => [
                    'titulo' => "*DORMIR MEJOR*\nSÍ ES POSIBLE.",
                    'nota'   => 'Atención presencial y virtual para cada etapa de la vida.',
                    'bajada' => 'Dormir bien influye en el ánimo, la concentración y la energía. Las alteraciones del sueño son cambios persistentes en la calidad, duración, horarios o continuidad del descanso, con causas emocionales, médicas o de hábitos; una evaluación permite comprender su origen y orientar el abordaje.',
                ],
                'condicion_imagen'        => [
                    'foto'           => [
                        '_file' => 'assets/img/cond-sueno.webp',
                        'alt'   => 'Hombre durmiendo profundamente sobre una almohada',
                    ],
                    'leyenda_titulo' => '',
                    'leyenda_texto'  => '',
                ],
                'condicion_senales'       => [
                    'titulo'    => 'CÓMO PUEDEN MANIFESTARSE',
                    'intro'     => 'Las dificultades del sueño pueden presentarse de distintas formas y tener diferentes causas.',
                    'destacado' => '',
                    'grupos'    => [
                        [
                            'titulo' => '',
                            'items'  => [
                                [
                                    'titulo' => 'INSOMNIO',
                                    'texto'  => 'Dificultad persistente para conciliar el sueño, mantenerlo o volver a dormir después de despertar antes de lo deseado.',
                                ],
                                [
                                    'titulo' => 'SOMNOLENCIA EXCESIVA',
                                    'texto'  => 'Necesidad frecuente de dormir, dificultad para mantenerse despierto o cansancio que afecta la concentración y las actividades cotidianas.',
                                ],
                                [
                                    'titulo' => 'CAMBIOS EN LOS HORARIOS DE SUEÑO',
                                    'texto'  => 'Dormirse y despertarse en horarios muy tardíos, tempranos o irregulares, con dificultad para adaptar el descanso a las actividades diarias.',
                                ],
                                [
                                    'titulo' => 'PARASOMNIAS',
                                    'texto'  => 'Episodios como sonambulismo, terrores nocturnos, pesadillas frecuentes u otras conductas que ocurren durante el sueño.',
                                ],
                                [
                                    'titulo' => 'RONQUIDOS O PAUSAS AL RESPIRAR',
                                    'texto'  => 'Ronquidos intensos, pausas respiratorias, sensación de ahogo al dormir o despertar sin haber descansado pueden requerir una evaluación médica especializada.',
                                ],
                                [
                                    'titulo' => 'SENSACIONES INCÓMODAS EN LAS PIERNAS',
                                    'texto'  => 'Necesidad difícil de controlar de mover las piernas, especialmente durante el descanso o por la noche, que dificulta conciliar el sueño.',
                                ],
                            ],
                        ],
                    ],
                    'pie'       => '',
                ],
                'condicion_nota'          => [
                    'titulo' => '',
                    'texto'  => '',
                ],
                'condicion_tipos'         => [
                    'variante' => 'sin_bloque',
                    'titulo'   => '',
                    'intro'    => '',
                    'items'    => [],
                ],
                'condicion_abordaje'      => [
                    'titulo' => '¿CÓMO ABORDAMOS LAS ALTERACIONES DEL SUEÑO?',
                    'intro'  => 'Un enfoque integral, personalizado y con acompañamiento en cada etapa, respaldado por evidencia clínica.',
                    'items'  => [
                        [
                            'titulo' => 'EVALUACIÓN INTEGRAL',
                            'texto'  => 'Realizamos una evaluación clínica para conocer el patrón de sueño, su evolución y su impacto en tu vida. Revisamos horarios, rutinas, estado de ánimo, estrés, medicamentos, consumo de cafeína, alcohol u otras sustancias, y posibles condiciones médicas o de salud mental relacionadas.',
                        ],
                        [
                            'titulo' => 'PLAN PERSONALIZADO',
                            'texto'  => 'Se define según el tipo de dificultad y los factores que la mantienen. Puede incluir intervenciones psicológicas especializadas para el insomnio, regulación de horarios y rutinas, y tratamiento médico cuando corresponde.',
                        ],
                        [
                            'titulo' => 'EVOLUCIÓN Y AJUSTES',
                            'texto'  => 'Evaluamos la calidad y continuidad del sueño, el funcionamiento durante el día y la respuesta a las estrategias indicadas. Cuando el descanso mejora y los cambios se mantienen de forma autónoma, las consultas se espacian hasta el cierre del proceso.',
                        ],
                    ],
                ],
                'condicion_especialistas' => [],
                'condicion_cta'           => [
                    'titulo'  => 'RECUPERAR UN DESCANSO SALUDABLE PUEDE CAMBIAR CÓMO TE SIENTES DURANTE EL DÍA.',
                    'texto'   => 'Escríbenos y diseñemos contigo un plan personalizado.',
                    'boton'   => 'Escríbenos por WhatsApp',
                    'mensaje' => 'Hola, quisiera información sobre el tratamiento de las alteraciones del sueño.',
                ],
            ],
        ],
        [
            'id'        => 'adicciones',
            'titulo'    => 'Adicciones',
            'que_trata' => 'Adicciones',
            'fields'    => [
                'condicion_hero'          => [
                    'titulo' => "*RECUPERAR EL CONTROL*\nES POSIBLE.",
                    'nota'   => 'Atención presencial y virtual para cada etapa de la vida.',
                    'bajada' => 'Una adicción puede desarrollarse cuando el consumo de una sustancia o una conducta se vuelve difícil de controlar y continúa a pesar de sus consecuencias. No es falta de voluntad: intervienen factores biológicos, psicológicos y sociales, y existen diferentes alternativas de tratamiento.',
                ],
                'condicion_imagen'        => [
                    'foto'           => [
                        '_file' => 'assets/img/cond-adicciones.webp',
                        'alt'   => 'Mujer con los ojos cerrados respirando con calma en su sala',
                    ],
                    'leyenda_titulo' => '',
                    'leyenda_texto'  => '',
                ],
                'condicion_senales'       => [
                    'titulo'    => 'SEÑALES QUE PUEDEN INDICAR UN PROBLEMA',
                    'intro'     => 'No todas las personas presentan las mismas señales. La evaluación considera el tipo de sustancia o conducta, su frecuencia, el nivel de control y el impacto que está teniendo en la vida cotidiana.',
                    'destacado' => '',
                    'grupos'    => [
                        [
                            'titulo' => '',
                            'items'  => [
                                [
                                    'titulo' => 'DIFICULTAD PARA CONTROLAR',
                                    'texto'  => 'Consumir más de lo previsto o dedicar a la conducta más tiempo del que se había pensado.',
                                ],
                                [
                                    'titulo' => 'DESEO INTENSO O URGENCIA',
                                    'texto'  => 'Sentir una necesidad difícil de manejar de consumir o repetir la conducta.',
                                ],
                                [
                                    'titulo' => 'INTENTOS DE REDUCIR O DEJAR',
                                    'texto'  => 'Haber intentado disminuir o suspender el consumo o la conducta sin lograr sostener el cambio.',
                                ],
                                [
                                    'titulo' => 'MAYOR PRIORIDAD Y TIEMPO DEDICADO',
                                    'texto'  => 'Organizar progresivamente la vida alrededor del consumo o la conducta, dejando de lado otras actividades, vínculos o responsabilidades.',
                                ],
                                [
                                    'titulo' => 'TOLERANCIA O MALESTAR AL SUSPENDER',
                                    'texto'  => 'Necesitar cantidades mayores para obtener el mismo efecto o experimentar malestar físico o emocional al reducir o interrumpir el consumo. Estas manifestaciones varían según la sustancia o conducta.',
                                ],
                                [
                                    'titulo' => 'CONTINUIDAD A PESAR DE LAS CONSECUENCIAS',
                                    'texto'  => 'Mantener el consumo o la conducta aunque esté afectando la salud, los vínculos, la economía, los estudios o el trabajo.',
                                ],
                            ],
                        ],
                    ],
                    'pie'       => '',
                ],
                'condicion_nota'          => [
                    'titulo' => '',
                    'texto'  => 'Las adicciones pueden estar relacionadas con alcohol, nicotina, medicamentos u otras sustancias, así como con determinadas conductas, como las apuestas o los videojuegos. También evaluamos el uso problemático de internet, redes sociales, compras u otras conductas cuando comienzan a afectar la vida cotidiana.',
                ],
                'condicion_tipos'         => [
                    'variante' => 'sin_bloque',
                    'titulo'   => '',
                    'intro'    => '',
                    'items'    => [],
                ],
                'condicion_abordaje'      => [
                    'titulo' => '¿CÓMO ABORDAMOS LAS ADICCIONES?',
                    'intro'  => 'Un enfoque integral, personalizado y con acompañamiento en cada etapa, respaldado por evidencia clínica.',
                    'items'  => [
                        [
                            'titulo' => 'EVALUACIÓN INTEGRAL',
                            'texto'  => 'Realizamos una evaluación clínica para comprender el patrón de consumo o conducta, su evolución, los intentos previos de cambio y su impacto en la vida, junto con riesgos físicos, síntomas de abstinencia y otras condiciones de salud mental. Si se requiere desintoxicación supervisada, internamiento u otro nivel de atención, orientamos a la persona y su familia hacia un servicio especializado.',
                        ],
                        [
                            'titulo' => 'PLAN PERSONALIZADO',
                            'texto'  => 'Se construye junto con cada persona y puede incluir psicoterapia, estrategias para manejar el deseo de consumir, reducción de riesgos, cambios progresivos en los hábitos y fortalecimiento de la red de apoyo. Cuando corresponde, se incorpora tratamiento médico para determinadas adicciones o para manejar los síntomas asociados de forma segura.',
                        ],
                        [
                            'titulo' => 'EVOLUCIÓN Y AJUSTES',
                            'texto'  => 'Evaluamos los avances, las dificultades y las situaciones que aumentan el riesgo de volver al consumo o la conducta, ajustando objetivos y estrategias según la evolución. Con una estabilidad sostenida, las consultas se espacian, manteniendo herramientas para cuidar los cambios logrados.',
                        ],
                    ],
                ],
                'condicion_especialistas' => [],
                'condicion_cta'           => [
                    'titulo'  => 'DAR EL PRIMER PASO TAMBIÉN ES PARTE DEL CAMBIO.',
                    'texto'   => 'Escríbenos y te ayudamos a encontrar el acompañamiento adecuado.',
                    'boton'   => 'Escríbenos por WhatsApp',
                    'mensaje' => 'Hola, quisiera información sobre el tratamiento de las adicciones.',
                ],
            ],
        ],
        [
            'id'        => 'tdah',
            'titulo'    => 'TDAH',
            'que_trata' => 'TDAH',
            'fields'    => [
                'condicion_hero'          => [
                    'titulo' => "*ENTENDER EL TDAH PUEDE*\nCAMBIAR LA FORMA DE AFRONTARLO.",
                    'nota'   => 'Atención presencial y virtual para cada etapa de la vida.',
                    'bajada' => 'El TDAH es una condición del neurodesarrollo caracterizada por un patrón persistente de desatención y/o hiperactividad e impulsividad, que puede afectar los estudios, el trabajo y las relaciones. Su forma de manifestarse varía según la persona y la etapa de vida.',
                ],
                'condicion_imagen'        => [
                    'foto'           => [
                        '_file' => 'assets/img/cond-tdah.webp',
                        'alt'   => 'Mujer al teléfono sosteniendo sus lentes con gesto de agobio',
                    ],
                    'leyenda_titulo' => '',
                    'leyenda_texto'  => '',
                ],
                'condicion_senales'       => [
                    'titulo'    => 'CÓMO PUEDE MANIFESTARSE',
                    'intro'     => 'El TDAH se expresa de manera diferente según la persona, la etapa de vida y las exigencias de su entorno. Estas son algunas de sus manifestaciones más frecuentes.',
                    'destacado' => 'Evaluamos y tratamos el TDAH tanto en adultos como en niños y adolescentes, adaptando el proceso a cada etapa de la vida.',
                    'grupos'    => [
                        [
                            'titulo' => '',
                            'items'  => [
                                [
                                    'titulo' => 'ATENCIÓN Y PERSISTENCIA',
                                    'texto'  => 'Dificultad para sostener la atención, seguir instrucciones, completar tareas o mantener el esfuerzo en actividades prolongadas.',
                                ],
                                [
                                    'titulo' => 'ORGANIZACIÓN Y MANEJO DEL TIEMPO',
                                    'texto'  => 'Problemas para planificar, establecer prioridades, calcular el tiempo o cumplir plazos, con postergaciones frecuentes.',
                                ],
                                [
                                    'titulo' => 'OLVIDOS Y PÉRDIDA DE OBJETOS',
                                    'texto'  => 'Olvidar citas, tareas o compromisos, perder objetos importantes o necesitar recordatorios constantes.',
                                ],
                                [
                                    'titulo' => 'IMPULSIVIDAD',
                                    'texto'  => 'Actuar o responder apresuradamente, interrumpir, tomar decisiones sin anticipar sus consecuencias o tener dificultad para esperar.',
                                ],
                                [
                                    'titulo' => 'HIPERACTIVIDAD O INQUIETUD',
                                    'texto'  => 'Necesidad frecuente de moverse o dificultad para permanecer quieto. En adolescentes y adultos puede sentirse más como una inquietud interna.',
                                ],
                                [
                                    'titulo' => 'IMPACTO EN LA VIDA COTIDIANA',
                                    'texto'  => 'Dificultades persistentes en los estudios, el trabajo, las relaciones, la autonomía o la autoestima.',
                                ],
                            ],
                        ],
                    ],
                    'pie'       => 'Algunas personas también presentan frustración intensa, irritabilidad o dificultad para regular sus emociones. Estas manifestaciones pueden acompañar al TDAH, pero también aparecer en otras condiciones.',
                ],
                'condicion_nota'          => [
                    'titulo' => '',
                    'texto'  => 'La evaluación del TDAH es diferente en niños, adolescentes y adultos, pero en todos los casos el diagnóstico es clínico y requiere comprender los síntomas a lo largo del tiempo y en distintos contextos.',
                ],
                'condicion_tipos'         => [
                    'variante' => 'sin_bloque',
                    'titulo'   => '',
                    'intro'    => '',
                    'items'    => [],
                ],
                'condicion_abordaje'      => [
                    'titulo' => '¿CÓMO ABORDAMOS EL TDAH?',
                    'intro'  => 'Un enfoque integral, personalizado y con acompañamiento en cada etapa, respaldado por evidencia clínica.',
                    'items'  => [
                        [
                            'titulo' => 'EVALUACIÓN CLÍNICA INTEGRAL',
                            'texto'  => "Realizamos una evaluación clínica completa para comprender los síntomas actuales, su evolución y el impacto que tienen en los estudios, el trabajo, las relaciones y la vida cotidiana. Exploramos antecedentes médicos, familiares y del desarrollo, así como el sueño, el estado de ánimo, los hábitos y otros factores que podrían generar dificultades similares o coexistir con un TDAH.\n\nEl diagnóstico se construye integrando toda esta información y no depende de una sola prueba. Cuando resulta útil, empleamos escalas y cuestionarios validados como herramientas complementarias. En niños y adolescentes también recogemos información de la familia y el colegio para conocer cómo se manifiestan las dificultades en diferentes entornos.\n\nEn algunos casos podemos recomendar una evaluación neuropsicológica cuando existen dudas sobre dificultades de aprendizaje, memoria, atención, funciones ejecutivas u otras habilidades cognitivas, o cuando se requiere conocer un perfil específico para orientar determinadas recomendaciones. Esta evaluación es complementaria, no es necesaria en todos los casos y no reemplaza la evaluación clínica para el diagnóstico del TDAH.",
                        ],
                        [
                            'titulo' => 'PLAN DE TRATAMIENTO',
                            'texto'  => 'Construimos un plan adaptado a cada persona y etapa de vida, que puede incluir psicoeducación, psicoterapia, herramientas de organización y manejo del tiempo, estrategias para la impulsividad y ajustes en las rutinas. Luego de la evaluación médica, el psiquiatra también puede incorporar medicación y realizar el seguimiento de su respuesta.',
                        ],
                        [
                            'titulo' => 'EVOLUCIÓN Y AJUSTES',
                            'texto'  => 'Evaluamos los avances, las dificultades y el impacto del tratamiento en la vida cotidiana, ajustando las estrategias según la respuesta de cada persona para que desarrolle herramientas, mayor autonomía y un funcionamiento más saludable en sus distintos entornos.',
                        ],
                    ],
                ],
                'condicion_especialistas' => [],
                'condicion_cta'           => [
                    'titulo'  => 'COMPRENDER LO QUE TE OCURRE ES EL PRIMER PASO PARA ENCONTRAR LAS HERRAMIENTAS ADECUADAS.',
                    'texto'   => 'Te acompañamos desde la evaluación hasta el tratamiento, con un plan adaptado a tu etapa de vida.',
                    'boton'   => 'Escríbenos por WhatsApp',
                    'mensaje' => 'Hola, quisiera información sobre el tratamiento de el TDAH.',
                ],
            ],
        ],
        [
            'id'        => 'autismo',
            'titulo'    => 'Autismo (TEA)',
            'que_trata' => 'Autismo (TEA)',
            'fields'    => [
                'condicion_hero'          => [
                    'titulo' => "*ACOMPAÑARTE*\nPARTE DE COMPRENDERTE",
                    'nota'   => 'Atención presencial y virtual para cada etapa de la vida.',
                    'bajada' => 'El autismo es una condición del neurodesarrollo que influye en la manera de comunicarse, relacionarse, procesar los estímulos y experimentar el entorno. Cada persona autista tiene características, fortalezas y necesidades de apoyo diferentes, que también pueden cambiar a lo largo de la vida. En Lumenti brindamos evaluación y acompañamiento en salud mental desde una mirada respetuosa de cada persona y su contexto.',
                ],
                'condicion_imagen'        => [
                    'foto'           => [
                        '_file' => 'assets/img/cond-autismo.webp',
                        'alt'   => 'Personas estudiando juntas en una biblioteca',
                    ],
                    'leyenda_titulo' => '',
                    'leyenda_texto'  => '',
                ],
                'condicion_senales'       => [
                    'titulo'    => 'EN QUÉ TE ACOMPAÑAMOS',
                    'intro'     => 'Acompañamos las dificultades emocionales, conductuales o cotidianas que pueden presentarse junto con el autismo, así como aquellas situaciones que la persona desea comprender o manejar de una manera diferente.',
                    'destacado' => '',
                    'grupos'    => [
                        [
                            'titulo' => '',
                            'items'  => [
                                [
                                    'titulo' => 'ANSIEDAD Y ESTADO DE ÁNIMO',
                                    'texto'  => 'Acompañamiento ante ansiedad, tristeza, irritabilidad u otras dificultades emocionales que afectan el bienestar cotidiano.',
                                ],
                                [
                                    'titulo' => 'SUEÑO',
                                    'texto'  => 'Evaluación y abordaje de las dificultades para conciliar o mantener el sueño y de su impacto durante el día.',
                                ],
                                [
                                    'titulo' => 'ATENCIÓN Y ORGANIZACIÓN',
                                    'texto'  => 'Apoyo ante dificultades de atención, planificación, manejo del tiempo, impulsividad o condiciones asociadas como el TDAH.',
                                ],
                                [
                                    'titulo' => 'REGULACIÓN EMOCIONAL Y CRISIS',
                                    'texto'  => 'Herramientas para reconocer las emociones, comunicar el malestar y afrontar momentos de desregulación.',
                                ],
                                [
                                    'titulo' => 'SOBRECARGA SENSORIAL',
                                    'texto'  => 'Identificación de estímulos y situaciones que generan sobrecarga, junto con estrategias y ajustes que favorezcan el bienestar.',
                                ],
                                [
                                    'titulo' => 'CAMBIOS, VÍNCULOS Y VIDA COTIDIANA',
                                    'texto'  => 'Acompañamiento para afrontar transiciones, desenvolverse en distintos entornos y construir relaciones respetando la forma de comunicarse de cada persona.',
                                ],
                            ],
                        ],
                    ],
                    'pie'       => '',
                ],
                'condicion_nota'          => [
                    'titulo' => '',
                    'texto'  => '',
                ],
                'condicion_tipos'         => [
                    'variante' => 'sin_bloque',
                    'titulo'   => '',
                    'intro'    => '',
                    'items'    => [],
                ],
                'condicion_abordaje'      => [
                    'titulo' => '¿CÓMO TE ACOMPAÑAMOS?',
                    'intro'  => 'Un enfoque integral, personalizado y con acompañamiento en cada etapa, respaldado por evidencia clínica.',
                    'items'  => [
                        [
                            'titulo' => 'EVALUACIÓN Y COMPRENSIÓN',
                            'texto'  => 'Realizamos una evaluación clínica para conocer la historia, las características actuales, el contexto y las situaciones que generan dudas o malestar. Cuando se busca un diagnóstico, integramos información del desarrollo y de distintas etapas de la vida con herramientas complementarias y, si se requiere una evaluación especializada adicional, orientamos sobre las alternativas más adecuadas.',
                        ],
                        [
                            'titulo' => 'PLAN DE ACOMPAÑAMIENTO',
                            'texto'  => 'Construimos un plan a partir de los objetivos de la persona y, cuando corresponde, de su familia. Puede incluir psicoterapia adaptada, psicoeducación, herramientas de regulación emocional, ajustes en las rutinas y tratamiento de condiciones asociadas, incluida medicación indicada por el psiquiatra cuando podría ser beneficiosa.',
                        ],
                    ],
                ],
                'condicion_especialistas' => [],
                'condicion_cta'           => [
                    'titulo'  => 'UN ACOMPAÑAMIENTO QUE PARTE DE COMPRENDERTE.',
                    'texto'   => 'Escríbenos y te ayudamos a encontrar el acompañamiento adecuado.',
                    'boton'   => 'Escríbenos por WhatsApp',
                    'mensaje' => 'Hola, quisiera información sobre el tratamiento de el autismo (TEA).',
                ],
            ],
        ],
        [
            'id'        => 'personalidad',
            'titulo'    => 'Trastornos de la personalidad',
            'que_trata' => 'Otros trastornos de la personalidad',
            'fields'    => [
                'condicion_hero'          => [
                    'titulo' => "*CAMBIAR PATRONES QUE*\nGENERAN MALESTAR ES POSIBLE.",
                    'nota'   => 'Atención presencial y virtual para cada etapa de la vida.',
                    'bajada' => 'Son patrones persistentes y poco flexibles de pensar, sentir y relacionarse que pueden generar malestar. Tener algunos rasgos no significa tener un trastorno, y un diagnóstico no define a una persona: con un abordaje adecuado es posible afrontar de otra manera y mejorar el bienestar.',
                ],
                'condicion_imagen'        => [
                    'foto'           => [
                        '_file' => 'assets/img/cond-personalidad.webp',
                        'alt'   => 'Mujer caminando por un campo de flores al atardecer',
                    ],
                    'leyenda_titulo' => '¿DE QUÉ TRASTORNOS HABLAMOS?',
                    'leyenda_texto'  => 'Esta página aborda los trastornos paranoide, esquizoide, esquizotípico, antisocial, histriónico, narcisista, evitativo, dependiente y obsesivo-compulsivo de la personalidad. El trastorno límite de la personalidad cuenta con una sección específica.',
                ],
                'condicion_senales'       => [
                    'titulo'    => 'ÁREAS QUE PUEDEN VERSE AFECTADAS',
                    'intro'     => 'Los trastornos de la personalidad son diversos y no todas las personas presentan las mismas dificultades. Estas son algunas áreas que pueden verse afectadas.',
                    'destacado' => '',
                    'grupos'    => [
                        [
                            'titulo' => '',
                            'items'  => [
                                [
                                    'titulo' => 'INTERPRETACIÓN DE LAS SITUACIONES',
                                    'texto'  => 'Desconfianza persistente, interpretaciones poco flexibles o dificultad para considerar otras perspectivas sobre uno mismo y los demás.',
                                ],
                                [
                                    'titulo' => 'EXPRESIÓN EMOCIONAL',
                                    'texto'  => 'Formas muy contenidas, intensas o cambiantes de expresar las emociones, según el patrón de cada persona.',
                                ],
                                [
                                    'titulo' => 'FLEXIBILIDAD Y NECESIDAD DE CONTROL',
                                    'texto'  => 'Perfeccionismo, rigidez, preocupación excesiva por el orden o dificultad para adaptarse a cambios e imprevistos.',
                                ],
                                [
                                    'titulo' => 'VÍNCULOS Y CERCANÍA EMOCIONAL',
                                    'texto'  => 'Dificultad para establecer o mantener relaciones, tendencia al distanciamiento, dependencia o conflictos repetidos.',
                                ],
                                [
                                    'titulo' => 'AUTOIMAGEN Y RECONOCIMIENTO',
                                    'texto'  => 'Sentimientos persistentes de inadecuación o una necesidad intensa de aprobación, admiración o reconocimiento.',
                                ],
                                [
                                    'titulo' => 'AUTONOMÍA Y TOMA DE DECISIONES',
                                    'texto'  => 'Dificultad para tomar decisiones de manera independiente o patrones de conducta que generan consecuencias en las relaciones, el trabajo u otras áreas.',
                                ],
                            ],
                        ],
                    ],
                    'pie'       => '',
                ],
                'condicion_nota'          => [
                    'titulo' => '',
                    'texto'  => 'Estas características también pueden presentarse en otras condiciones o como rasgos aislados. Por sí solas no permiten establecer un diagnóstico.',
                ],
                'condicion_tipos'         => [
                    'variante' => 'sin_bloque',
                    'titulo'   => '',
                    'intro'    => '',
                    'items'    => [],
                ],
                'condicion_abordaje'      => [
                    'titulo' => '¿CÓMO ABORDAMOS LOS TRASTORNOS DE LA PERSONALIDAD?',
                    'intro'  => 'Un enfoque integral, personalizado y con acompañamiento en cada etapa, respaldado por evidencia clínica.',
                    'items'  => [
                        [
                            'titulo' => 'EVALUACIÓN CLÍNICA INTEGRAL',
                            'texto'  => 'Comprendemos los patrones que generan malestar, cómo se manifiestan en distintos contextos y cómo han evolucionado, explorando vínculos, regulación emocional, autoimagen y funcionamiento cotidiano. Esto permite diferenciarlos de rasgos aislados o de condiciones como ansiedad, depresión, trauma, neurodivergencias o consumo de sustancias; el diagnóstico no depende de una sola prueba y, en la adolescencia, requiere especial cuidado.',
                        ],
                        [
                            'titulo' => 'PLAN DE TRATAMIENTO',
                            'texto'  => 'Construimos un plan según las dificultades, objetivos y contexto de cada persona. La psicoterapia ocupa un lugar central: busca comprender los patrones, desarrollar flexibilidad, mejorar los vínculos y regular las emociones. Si existen condiciones asociadas, el psiquiatra puede incorporar tratamiento farmacológico y realizar su seguimiento.',
                        ],
                        [
                            'titulo' => 'EVOLUCIÓN Y AJUSTES',
                            'texto'  => 'Evaluamos los cambios en el bienestar, los vínculos y el funcionamiento cotidiano, ajustando el plan según la evolución. Cuando los objetivos se mantienen de forma sostenida, las sesiones se espacian hasta llegar al cierre del proceso.',
                        ],
                    ],
                ],
                'condicion_especialistas' => [],
                'condicion_cta'           => [
                    'titulo'  => 'COMPRENDER TUS PATRONES PUEDE ABRIR NUEVAS FORMAS DE SENTIRTE Y RELACIONARTE.',
                    'texto'   => 'Escríbenos y te orientamos desde el primer contacto.',
                    'boton'   => 'Escríbenos por WhatsApp',
                    'mensaje' => 'Hola, quisiera información sobre el tratamiento de los trastornos de la personalidad.',
                ],
            ],
        ],
        [
            'id'        => 'tdc',
            'titulo'    => 'Trastorno dismórfico corporal',
            'que_trata' => 'TDC',
            'fields'    => [
                'condicion_hero'          => [
                    'titulo' => "*LO QUE VES*\nNO TE DEFINE.",
                    'nota'   => 'Atención presencial y virtual para cada etapa de la vida.',
                    'bajada' => 'El trastorno dismórfico corporal se caracteriza por una preocupación intensa y persistente por aspectos de la apariencia que se perciben como defectuosos, aunque para otras personas sean poco notorios. Suele acompañarse de conductas repetitivas y puede afectar el bienestar, las relaciones, los estudios o el trabajo.',
                ],
                'condicion_imagen'        => [
                    'foto'           => [
                        '_file' => 'assets/img/cond-tdc.webp',
                        'alt'   => 'Mujer observando su reflejo en un espejo',
                    ],
                    'leyenda_titulo' => '',
                    'leyenda_texto'  => '',
                ],
                'condicion_senales'       => [
                    'titulo'    => 'SEÑALES QUE PUEDEN PRESENTARSE',
                    'intro'     => 'La preocupación por la apariencia puede manifestarse de distintas maneras. Estas señales no permiten establecer un diagnóstico por sí solas, pero pueden indicar que es recomendable buscar una evaluación profesional.',
                    'destacado' => '',
                    'grupos'    => [
                        [
                            'titulo' => '',
                            'items'  => [
                                [
                                    'titulo' => 'PREOCUPACIÓN PERSISTENTE',
                                    'texto'  => 'Pensamientos frecuentes sobre uno o más aspectos de la apariencia que resultan difíciles de controlar y ocupan una parte importante del día.',
                                ],
                                [
                                    'titulo' => 'COMPARACIÓN Y BÚSQUEDA DE SEGURIDAD',
                                    'texto'  => 'Comparar constantemente la propia apariencia con la de otras personas o pedir repetidamente opiniones y confirmación sobre cómo se luce.',
                                ],
                                [
                                    'titulo' => 'EVITACIÓN SOCIAL',
                                    'texto'  => 'Evitar fotografías, reuniones, estudios, trabajo, vínculos o actividades por vergüenza o temor a que otras personas noten aquello que preocupa.',
                                ],
                                [
                                    'titulo' => 'COMPROBACIÓN O EVITACIÓN',
                                    'texto'  => 'Revisarse repetidamente en espejos, cámaras o superficies reflectantes, o evitarlos por completo para reducir momentáneamente el malestar.',
                                ],
                                [
                                    'titulo' => 'OCULTAMIENTO O ARREGLO EXCESIVO',
                                    'texto'  => 'Dedicar mucho tiempo a cubrir, modificar o disimular el aspecto que genera preocupación mediante ropa, maquillaje, peinados u otras conductas.',
                                ],
                                [
                                    'titulo' => 'PROCEDIMIENTOS SIN ALIVIO DURADERO',
                                    'texto'  => 'Buscar repetidamente tratamientos dermatológicos, estéticos o quirúrgicos sin que la preocupación disminuya de manera sostenida.',
                                ],
                            ],
                        ],
                    ],
                    'pie'       => '',
                ],
                'condicion_nota'          => [
                    'titulo' => '',
                    'texto'  => '',
                ],
                'condicion_tipos'         => [
                    'variante' => 'sin_bloque',
                    'titulo'   => '',
                    'intro'    => '',
                    'items'    => [],
                ],
                'condicion_abordaje'      => [
                    'titulo' => '¿CÓMO ABORDAMOS EL TDC?',
                    'intro'  => 'Un enfoque integral, personalizado y con acompañamiento en cada etapa, respaldado por evidencia clínica.',
                    'items'  => [
                        [
                            'titulo' => 'EVALUACIÓN CLÍNICA INTEGRAL',
                            'texto'  => 'Comprendemos el contenido e intensidad de la preocupación, el tiempo que ocupa, las conductas repetitivas y su impacto en la vida cotidiana. Revisamos tratamientos o procedimientos previos y posibles condiciones relacionadas, como ansiedad, depresión, TOC o trastornos de la conducta alimentaria, para explicar los hallazgos y definir si corresponden a un trastorno dismórfico corporal.',
                        ],
                        [
                            'titulo' => 'PLAN DE TRATAMIENTO',
                            'texto'  => 'Construimos un plan personalizado que puede incluir psicoterapia orientada a reducir la preocupación, las conductas de comprobación, la evitación y su impacto en la vida cotidiana. Cuando el psiquiatra lo considera adecuado, puede incorporar medicación y realizar el seguimiento de la respuesta.',
                        ],
                        [
                            'titulo' => 'EVOLUCIÓN Y AJUSTES',
                            'texto'  => 'Evaluamos cuánto espacio ocupa la preocupación, la frecuencia de las conductas repetitivas y la recuperación de actividades y vínculos afectados. El plan se ajusta según los avances y, cuando se mantienen, las consultas se espacian hasta el cierre del proceso.',
                        ],
                    ],
                ],
                'condicion_especialistas' => [],
                'condicion_cta'           => [
                    'titulo'  => 'LA PREOCUPACIÓN POR LA APARIENCIA PUEDE TRATARSE.',
                    'texto'   => 'Escríbenos y te ayudamos a encontrar al especialista adecuado.',
                    'boton'   => 'Escríbenos por WhatsApp',
                    'mensaje' => 'Hola, quisiera información sobre el tratamiento de el trastorno dismórfico corporal.',
                ],
            ],
        ],
        [
            'id'        => 'perinatal',
            'titulo'    => 'Salud mental perinatal',
            'que_trata' => 'Salud mental perinatal',
            'fields'    => [
                'condicion_hero'          => [
                    'titulo' => "*NO TIENES QUE ATRAVESAR*\nESTA ETAPA SIN APOYO.",
                    'nota'   => 'Atención presencial y virtual para cada etapa de la vida.',
                    'bajada' => 'La salud mental perinatal abarca el bienestar emocional en el embarazo y el primer año tras el parto, cuando pueden aparecer depresión, ansiedad o pensamientos intrusivos. Pedir ayuda no es falta de fortaleza ni de amor por el bebé: estas dificultades tienen tratamiento.',
                ],
                'condicion_imagen'        => [
                    'foto'           => [
                        '_file' => 'assets/img/cond-perinatal.webp',
                        'alt'   => 'Mujer embarazada descansando en un sofá',
                    ],
                    'leyenda_titulo' => '',
                    'leyenda_texto'  => '',
                ],
                'condicion_senales'       => [
                    'titulo'    => 'SEÑALES QUE PUEDEN PRESENTARSE',
                    'intro'     => 'Es normal atravesar cambios emocionales durante esta etapa. Sin embargo, cuando el malestar es intenso, persiste o dificulta el cuidado personal y la vida cotidiana, es recomendable buscar orientación profesional.',
                    'destacado' => '',
                    'grupos'    => [
                        [
                            'titulo' => '',
                            'items'  => [
                                [
                                    'titulo' => 'TRISTEZA O PÉRDIDA DE INTERÉS',
                                    'texto'  => 'Ánimo bajo, llanto frecuente, sensación de vacío o dificultad para disfrutar actividades que antes resultaban significativas.',
                                ],
                                [
                                    'titulo' => 'DIFICULTAD PARA SENTIRSE CONECTADA',
                                    'texto'  => 'Sensación de distancia emocional o dificultad para conectar con el bebé. Esto puede ocurrir y no significa falta de amor ni una falla como madre.',
                                ],
                                [
                                    'titulo' => 'CAMBIOS EN EL SUEÑO Y EL APETITO',
                                    'texto'  => 'Dificultad para dormir incluso cuando existe la oportunidad de hacerlo, sueño poco reparador o cambios importantes en el apetito que van más allá de lo esperado en esta etapa.',
                                ],
                                [
                                    'titulo' => 'ANSIEDAD O PREOCUPACIÓN INTENSA',
                                    'texto'  => 'Preocupación difícil de controlar por el embarazo, el parto, la salud del bebé o la capacidad para cuidarlo, acompañada de tensión o sensación constante de alerta.',
                                ],
                                [
                                    'titulo' => 'PENSAMIENTOS INTRUSIVOS',
                                    'texto'  => 'Pensamientos o imágenes involuntarias y no deseadas sobre que algo malo podría ocurrirle al bebé, que generan miedo o angustia aunque la persona no quiera llevarlos a cabo.',
                                ],
                                [
                                    'titulo' => 'IRRITABILIDAD, CULPA O DESCONEXIÓN',
                                    'texto'  => 'Irritabilidad intensa, sensación de estar sobrepasada, culpa persistente o dificultad para sentirse presente y conectada con lo que ocurre.',
                                ],
                            ],
                        ],
                    ],
                    'pie'       => '',
                ],
                'condicion_nota'          => [
                    'titulo' => '',
                    'texto'  => '',
                ],
                'condicion_tipos'         => [
                    'variante' => 'sin_bloque',
                    'titulo'   => '',
                    'intro'    => '',
                    'items'    => [],
                ],
                'condicion_abordaje'      => [
                    'titulo' => '¿CÓMO ABORDAMOS LA SALUD MENTAL PERINATAL?',
                    'intro'  => 'Un enfoque integral, personalizado y con acompañamiento en cada etapa, respaldado por evidencia clínica.',
                    'items'  => [
                        [
                            'titulo' => 'EVALUACIÓN INTEGRAL',
                            'texto'  => 'Consideramos el momento del embarazo o posparto, los síntomas, su evolución y su impacto en la vida cotidiana, junto con el sueño, los antecedentes, tratamientos previos, la historia obstétrica, los medicamentos y la red de apoyo. Así diferenciamos los cambios esperables de esta etapa de condiciones como depresión, ansiedad, TOC, trauma o trastorno bipolar.',
                        ],
                        [
                            'titulo' => 'PLAN DE TRATAMIENTO',
                            'texto'  => 'Construimos un plan adaptado a cada persona y momento, que puede incluir psicoterapia, herramientas para la ansiedad y los pensamientos intrusivos, recuperación del descanso, fortalecimiento de la red de apoyo y abordaje de experiencias difíciles del embarazo, el parto o una pérdida. Si se considera medicación, el psiquiatra evalúa individualmente sus beneficios y riesgos durante el embarazo o la lactancia.',
                        ],
                        [
                            'titulo' => 'EVOLUCIÓN Y COORDINACIÓN',
                            'texto'  => 'Evaluamos los cambios y ajustamos el plan según cada etapa. Con autorización de la paciente, la atención puede coordinarse con su psicoterapeuta, obstetra u otros profesionales, e incorporar a la pareja o red de apoyo cuando resulte beneficioso.',
                        ],
                    ],
                ],
                'condicion_especialistas' => [],
                'condicion_cta'           => [
                    'titulo'  => 'TU BIENESTAR TAMBIÉN IMPORTA EN ESTA ETAPA.',
                    'texto'   => 'Escríbenos y te ayudamos a encontrar el acompañamiento adecuado.',
                    'boton'   => 'Escríbenos por WhatsApp',
                    'mensaje' => 'Hola, quisiera información sobre el tratamiento de la salud mental perinatal.',
                ],
            ],
        ],
        [
            'id'        => 'tdpm',
            'titulo'    => 'Trastorno disfórico premenstrual',
            'que_trata' => 'TDPM',
            'fields'    => [
                'condicion_hero'          => [
                    'titulo' => "*CUANDO EL CICLO MENSTRUAL*\nAFECTA PROFUNDAMENTE\nCÓMO TE SIENTES",
                    'nota'   => 'Atención presencial y virtual para cada etapa de la vida.',
                    'bajada' => 'El trastorno disfórico premenstrual (TDPM) provoca cambios emocionales, cognitivos y físicos intensos, en la mayoría de los casos, los días previos a la menstruación. Estos síntomas suelen mejorar al comenzar el periodo, pero pueden afectar significativamente las relaciones, el trabajo, los estudios y la vida cotidiana.',
                ],
                'condicion_imagen'        => [
                    'foto'           => [
                        '_file' => 'assets/img/cond-tdpm.webp',
                        'alt'   => 'Mujer sonriente con los brazos abiertos y los ojos cerrados',
                    ],
                    'leyenda_titulo' => '',
                    'leyenda_texto'  => '',
                ],
                'condicion_senales'       => [
                    'titulo'    => 'MANIFESTACIONES FRECUENTES',
                    'intro'     => '',
                    'destacado' => '',
                    'grupos'    => [
                        [
                            'titulo' => '',
                            'items'  => [
                                [
                                    'titulo' => 'CAMBIOS INTENSOS EN EL ESTADO DE ÁNIMO',
                                    'texto'  => 'Tristeza, sensibilidad emocional o sensación de perder el control.',
                                ],
                                [
                                    'titulo' => 'ANSIEDAD O TENSIÓN',
                                    'texto'  => 'Sensación de estar sobrepasada, inquietud o dificultad para relajarse.',
                                ],
                                [
                                    'titulo' => 'CAMBIOS EN EL SUEÑO O EL APETITO',
                                    'texto'  => 'Dormir más o menos de lo habitual, antojos o aumento del apetito.',
                                ],
                                [
                                    'titulo' => 'IRRITABILIDAD O ENOJO',
                                    'texto'  => 'Reacciones más intensas de lo habitual y mayor dificultad para manejar los conflictos.',
                                ],
                                [
                                    'titulo' => 'FALTA DE ENERGÍA O CONCENTRACIÓN',
                                    'texto'  => 'Cansancio, menor motivación y dificultad para enfocarse.',
                                ],
                                [
                                    'titulo' => 'SÍNTOMAS FÍSICOS',
                                    'texto'  => 'Hinchazón, dolor de cabeza, sensibilidad en los senos o molestias musculares.',
                                ],
                            ],
                        ],
                    ],
                    'pie'       => '',
                ],
                'condicion_nota'          => [
                    'titulo' => 'No es solo “sentirse mal antes de la menstruación”',
                    'texto'  => 'La principal diferencia con el síndrome premenstrual es la intensidad de los síntomas y cuánto interfieren en la vida diaria. En el TDPM, el patrón se repite de manera cíclica y puede generar un malestar emocional considerable.',
                ],
                'condicion_tipos'         => [
                    'variante' => 'sin_bloque',
                    'titulo'   => '',
                    'intro'    => '',
                    'items'    => [],
                ],
                'condicion_abordaje'      => [
                    'titulo' => '¿CÓMO LO ABORDAMOS?',
                    'intro'  => 'Un enfoque integral, personalizado y con acompañamiento en cada etapa, respaldado por evidencia clínica.',
                    'items'  => [
                        [
                            'titulo' => 'EVALUACIÓN INTEGRAL',
                            'texto'  => "Recomendamos comenzar con una evaluación por psiquiatría para conocer los síntomas, su relación con el ciclo menstrual y el impacto que están teniendo en tu vida. También se revisan antecedentes médicos, emocionales y tratamientos previos.\n\nComo parte de la evaluación, puede solicitarse un registro diario de los síntomas durante algunos ciclos. Cuando sea necesario, se coordinará la atención con ginecología u otros especialistas.",
                        ],
                        [
                            'titulo' => 'PLAN DE TRATAMIENTO',
                            'texto'  => "El tratamiento se adapta a la intensidad de los síntomas y a las necesidades de cada persona. Puede incluir psicoterapia, herramientas para reconocer y manejar los cambios emocionales, recomendaciones sobre hábitos y medicación indicada por el médico psiquiatra.\n\nEn algunos casos, también puede ser necesaria una evaluación ginecológica para considerar alternativas hormonales dentro de un abordaje coordinado.",
                        ],
                        [
                            'titulo' => 'EVOLUCIÓN Y SEGUIMIENTO',
                            'texto'  => 'Durante las siguientes consultas se revisa cómo cambian los síntomas a lo largo de los ciclos y qué tan bien está funcionando el tratamiento. Según la evolución, el plan puede ajustarse, las consultas pueden espaciarse y, cuando existe una mejoría estable, puede considerarse el alta con pautas de seguimiento.',
                        ],
                    ],
                ],
                'condicion_especialistas' => [],
                'condicion_cta'           => [
                    'titulo'  => 'PODEMOS AYUDARTE A COMPRENDER Y TRATAR LO QUE ESTÁS VIVIENDO',
                    'texto'   => 'Escríbenos para encontrar el tratamiento adecuado para ti.',
                    'boton'   => 'Escríbenos por WhatsApp',
                    'mensaje' => 'Hola, quisiera información sobre el tratamiento de el trastorno disfórico premenstrual.',
                ],
            ],
        ],
    ],
];
