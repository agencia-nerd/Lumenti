<?php
defined('ABSPATH') || exit;

/*
 * Legal · documento (specs/legal.md → documento, grupo ACF legal_documento). Índice lateral + texto.
 * Índice: src/js/modules/legal.js (gancho data-lm-legal-toc); sin JS las anclas siguen funcionando.
 * Cada página muestra solo su documento: $args['documento'] = privacidad | terminos (lo elige la plantilla por slug).
 * Textos del cliente tal cual (data/legal-privacidad.json y data/legal-terminos.json) hasta el paso ACF: cada bloque
 * es p, ul, ol o h (subtítulo h3). En ACF el contenido será un wysiwyg por sección.
 */

$lumenti_indice_titulo = 'EN ESTA PÁGINA';
$lumenti_documentos = [
    'privacidad' => [
        'actualizado' => '01 de junio de 2026',
        'secciones' => [
            [
                'titulo' => 'I. Uso autorizado de datos personales',
                'bloques' => [
                    ['t' => 'p', 'x' => 'En Renova Mentis S.A.C., en adelante Lumenti, tratamos datos personales obtenidos física o digitalmente y a los que accedemos legítimamente, incluyendo los que generamos durante la prestación de los servicios.'],
                    ['t' => 'p', 'x' => 'Las principales bases legales son:'],
                    ['t' => 'ul', 'items' => [
                        'Ejecución de la relación contractual o medidas precontractuales (p. ej., gestionar reservas, brindar atención clínica, emitir comprobantes).',
                        'Consentimiento expreso para el tratamiento de datos sensibles de salud cuando sea estrictamente necesario y envío de comunicaciones informativas y de marketing propio',
                        'Cumplimiento de obligaciones legales: conservación de historias clínicas, atención de reclamos en el Libro de reclamaciones, respuesta a requerimientos de autoridades competentes.',
                        'Interés legítimo: acciones de mejora continua, control de calidad y prevención de fraude, siempre respetando sus derechos fundamentales',
                    ]],
                    ['t' => 'p', 'x' => 'En los supuestos de excepción previstos por ley, podemos tratar datos sin consentimiento (p. ej., cumplimiento de obligaciones legales o provenientes de fuentes accesibles al público conforme a norma). Si empleamos datos de fuentes no públicas de terceros, verificaremos que dichos terceros cuenten con consentimiento y facultades suficientes para su tratamiento y transferencia.'],
                    ['t' => 'p', 'x' => 'Pedimos a los titulares mantener sus datos actualizados durante la relación con LUMENTI. Sin perjuicio del principio de Calidad podremos verificar y/o complementar la información mediante fuentes legitimas (públicas o privadas) o encargados debidamente contratados, siempre que resulte necesario para la preparación o ejecución de los servicios.'],
                ],
            ],
            [
                'titulo' => 'II. Datos que tratamos',
                'bloques' => [
                    ['t' => 'ul', 'items' => [
                        'Identificación y contacto: nombres, DNI/CE, fecha de nacimiento, teléfono, correo.',
                        'Datos de atención clínica: antecedentes, motivos de consulta, diagnósticos, prescripciones, historia clínica, interconsultas.',
                        'Datos de navegación y cookies: IP, identificadores en línea y cookies',
                        'Reclamaciones de consumo: datos consignados en el Libro de Reclamaciones (físico y virtual).',
                    ]],
                ],
            ],
            [
                'titulo' => 'III. Finalidades del tratamiento',
                'bloques' => [
                    ['t' => 'p', 'x' => 'Tratamos datos personales para:'],
                    ['t' => 'ol', 'items' => [
                        'Prestación del servicio clínico: atención médica y psicológica (presencial y online) programación y seguimiento de citas, coordinación de derivaciones, emisión de documentación clínica.',
                        'Gestión administrativa y legal: fracturación, cumplimiento de obligaciones tributarias y sanitarias, atención de reclamos y quejas.',
                        'Calidad y seguridad: soporte técnico y auditorias, encuestas de satisfacción y mejora de procesos.',
                        'Comunicaciones: informar sobre cambios en términos o políticas, funcionamiento de canales, recordatorios de citas y si lo autorizas- envió de información educativa o de marketing propio.',
                        'Cumplimiento normativo: atención de requerimientos regulatorios, administrativos o judiciales.',
                    ]],
                    ['t' => 'p', 'x' => 'LUMENTI no adopta decisiones exclusivamente automatizadas que produzcan efectos jurídicos o afecten significativamente al titular. Cualquier uso de analítica o segmentación se limita a calidad del servicio y comunicaciones propias, con posibilidad de oponerte a recibir marketing.'],
                ],
            ],
            [
                'titulo' => 'IV. Menores de edad',
                'bloques' => [
                    ['t' => 'p', 'x' => 'El tratamiento de datos de menores se realiza con la intervención y/o consentimiento de su padre, madre o representante legal, salvo excepciones legales. En el caso de adolescentes, se aplicarán las reglas civiles correspondientes respecto de su capacidad para consentir en actos específicos.'],
                ],
            ],
            [
                'titulo' => 'V. Encargados del tratamiento, destinatarios y transferencias Podemos tratar datos a través de encargados de confianza (p. ej., hosting, agenda, videoconferencia, mensajería, pagos, analítica, soporte), incluso en el extranjero, bajo contratos y medidas de seguridad adecuadas. Cuando corresponda, podremos comunicar datos a autoridades u otros terceros autorizados por ley.',
                'bloques' => [
                    ['t' => 'p', 'x' => 'No comercializamos datos personales.'],
                ],
            ],
            [
                'titulo' => 'VI. Bancos de datos personales',
                'bloques' => [
                    ['t' => 'p', 'x' => 'Bancos de datos inscritos en el Registro Nacional de Protección de Datos Personales:'],
                    ['t' => 'ul', 'items' => [
                        '“Pacientes” con código RNPDP-PJP-2025-479',
                        '“Proveedores” con código RNPDP-PJP-2025-481',
                        '“Trabajadores” con código RNPDP-PJP-2025-482',
                        '“Videovigilancia” con código RNPDP-PJP-2025-2835',
                        '“Quejas y reclamos” con código RNPDP-PJP-2025-2836',
                    ]],
                ],
            ],
            [
                'titulo' => 'VII. Conservación',
                'bloques' => [
                    ['t' => 'p', 'x' => 'En LUMENTI conservamos tus datos personales únicamente durante el tiempo necesario para cumplir las finalidades informadas y, en su caso, por los plazos de prescripción y conservación exigidos por la normativa peruana aplicable (protección de datos, sanitaria, contable, tributaria, de consumo y otras).'],
                    ['t' => 'p', 'x' => 'Si revoca su consentimiento para una finalidad específica, bloquearemos ese tratamiento y mantendremos los datos solo cuando exista una base legal distinta que lo exija.'],
                ],
            ],
            [
                'titulo' => 'VIII. Confidencialidad y seguridad',
                'bloques' => [
                    ['t' => 'p', 'x' => 'El personal de LUMENTI y los terceros encargados de tratamiento están obligados a guardar confidencialidad. En el caso de datos de salud, aplicamos el secreto profesional y la normativa sanitaria vigente.'],
                    ['t' => 'p', 'x' => 'Implementamos medidas técnicas y organizativas razonables para proteger los datos.'],
                    ['t' => 'p', 'x' => 'Notificaremos a la autoridad y/o a los titulares en caso de incidentes de seguridad, cuando corresponda.'],
                ],
            ],
            [
                'titulo' => 'IX. Derechos del titular',
                'bloques' => [
                    ['t' => 'p', 'x' => 'Puedes ejercer tus derechos de información, acceso, rectificación, cancelación/supresión, oposición, portabilidad y revocación del consentimiento escribiendo a contacto@lumentisaludmental.com'],
                    ['t' => 'p', 'x' => 'Si consideras que no hemos atendido adecuadamente tu solicitud, puedes acudir a la Autoridad Nacional de Protección de Datos Personales por los canales oficiales del Estado.'],
                ],
            ],
            [
                'titulo' => 'X. Cookies y terceros',
                'bloques' => [
                    ['t' => 'p', 'x' => 'Usamos cookies necesarias y, si lo autorizas en el banner, cookies funcionales para integrar herramientas como WhatsApp u otros servicios. Puedes aceptarlas, rechazarlas o configurarlas por categorías.'],
                    ['t' => 'p', 'x' => 'En enlaces externos (p. ej. WhatsApp, libro de reclamaciones) aplican las políticas propias de dichos terceros.'],
                ],
            ],
            [
                'titulo' => 'XI. Modificaciones',
                'bloques' => [
                    ['t' => 'p', 'x' => 'Esta Política puede ser actualizada debido a cambios legales u operativos. La versión vigente será siempre la publicada en nuestro sitio web y entrará en vigencia desde la fecha de su publicación.'],
                ],
            ],
        ],
    ],
    'terminos' => [
        'actualizado' => '21 de febrero de 2026',
        'secciones' => [
            [
                'titulo' => '¡Bienvenidos a nuestra web!',
                'bloques' => [
                    ['t' => 'p', 'x' => 'Renova Mentis S.A.C es una persona jurídica de derecho privado constituida según las leyes peruanas y domiciliada para efectos del presente documento en la ciudad de Lima, Perú.'],
                ],
            ],
            [
                'titulo' => 'I. Aceptación de los Términos',
                'bloques' => [
                    ['t' => 'p', 'x' => 'Estos Términos y Condiciones de Uso son un acuerdo legal (en adelante, "Términos") entre usted y Renova Mentis S.A.C., con RUC 20614155419 (en adelante, "LUMENTI" o "nosotros", " nos” o" nuestro ").'],
                    ['t' => 'p', 'x' => 'Al acceder al sitio web www.lumentisaludmental.com usted declara haber leído y aceptar estos Términos antes de usar el sitio y los servicios ofrecidos. Si no está de acuerdo, debe abstenerse de usar el sitio y/o los servicios. Además de no manipular cualquier tipo de información vertida en él bajo responsabilidad.'],
                ],
            ],
            [
                'titulo' => 'II. Objeto del sitio',
                'bloques' => [
                    ['t' => 'p', 'x' => 'El objeto del Sitio Web es proporcionar una navegación clara que permita encontrar y conocer toda la información vinculada a LUMENTI y los servicios médicos y psicológicos de los profesionales; así como información y noticias de salud mental relevantes para el usuario común.'],
                    ['t' => 'p', 'x' => 'La información y el contenido del Sitio Web, son únicamente para fines informativos y no reemplaza el asesoramiento, diagnóstico y/o tratamiento del médico o psicólogo profesional.'],
                ],
            ],
            [
                'titulo' => 'III. Canales oficiales',
                'bloques' => [
                    ['t' => 'p', 'x' => 'Canales de atención oficiales:'],
                    ['t' => 'ul', 'items' => [
                        'Sitio web: www.lumentisaludmental.com',
                        'WhatsApp: +51 939 033 999 — agendamiento y consultas',
                        'Correo: contacto@lumentisaludmental.com — consultas',
                        'Libro de Reclamaciones Virtual: disponible desde el botón “Libro de Reclamaciones” visible en el sitio o ingresando directamente a https://reclamovirtual.pe/reclamar/lumenti/libro',
                        'Libro de Reclamaciones Físico: disponible en nuestro consultorio ubicado en Calle Los Antares 320, Torre B, 604. Santiago de Surco.',
                    ]],
                    ['t' => 'h', 'x' => 'Importante:'],
                    ['t' => 'ul', 'items' => [
                        'La información y comunicaciones difundidas a través de este Sitio Web y de los canales oficiales de Lumenti (incluidos WhatsApp y correo) se proporcionan con fines informativos y/o de gestión de citas, y no constituyen asesoramiento médico / psicológico ni sustituyen una evaluación clínica, diagnóstico o tratamiento. Al escribirnos por estos canales, autoriza el tratamiento de sus datos personales conforme a nuestra Política de Privacidad.',
                        'No atendemos emergencias por ninguno de nuestros canales oficiales. En caso de urgencia, comuníquese con SAMU 106 o la Línea 113 (opción 5 – salud mental).',
                        'El horario de atención de nuestros canales oficiales (whatsapp y correo eletrónico) es de lunes a viernes de 9am a 6pm y los sábados de 9am a 1pm',
                        'No se consideran los feriados.',
                    ]],
                ],
            ],
            [
                'titulo' => 'IV. Usuarios y Edad mínima',
                'bloques' => [
                    ['t' => 'p', 'x' => 'El sitio web y nuestros canales oficiales están dirigidos a mayores de 18 años. En el caso de menores de edad, toda atención deberá ser gestionada por su representante legal.'],
                ],
            ],
            [
                'titulo' => 'V. Sobre nuestros servicios',
                'bloques' => [
                    ['t' => 'p', 'x' => 'LUMENTI, a través de profesionales médicos y psicólogos, brinda servicios de atenciones médicas, psicológicas, así como talleres y programas para personas y empresas.'],
                    ['t' => 'p', 'x' => 'Las condiciones para los servicios que ofrece LUMENTI, son los siguientes:'],
                    ['t' => 'h', 'x' => 'A. Sobre las citas:'],
                    ['t' => 'ul', 'items' => [
                        'Las atenciones médicas y psicológicas son brindadas de forma presencial en Calle Los Antares 320, torre B, 604, Santiago de Surco; y de forma virtual a través de una videoconferencia.',
                        'Cada cita confirmada, tendrá una duración de hasta 45 minutos.',
                        'Las citas podrán ser efectuadas en español, inglés o portugués previa coordinación con nuestra Asesora del canal de whatsapp o correo electrónico.',
                        'En caso de que el paciente no se presente o conecte a su cita programada, perderá la cita, sin opción a reprogramación ni devolución del dinero, salvo casos de emergencia debidamente sustentados (hospitalización, accidente, duelo o desastre)',
                        'En caso de tardanzas, se brindará la atención por el tiempo restante.',
                        'Las reprogramaciones de cita deberán ser realizadas a través de nuestro Whatsapp +51 939 033 999 con veinticuatro (24) horas de anticipación, de lo contrario la cita no podrá reprogramarse y no habrá devolución del dinero, salvo casos de emergencia debidamente sustentados (hospitalización, accidente, duelo o desastre)',
                        'Las atenciones a domicilio se podrán realizar sólo en algunos distritos de Lima, según la accesibilidad de la zona y previa coordinación mediante nuestros canales de atención de WhatsApp o correo electrónico.',
                        'Es responsabilidad exclusiva del cliente, recordar y asistir a la cita programada. A pesar de las posibles soluciones que el consultorio pueda ofrecer para que las programaciones se den de manera adecuada, no se hace responsable en caso el cliente tenga contratiempos que impidan cumplir con su cita programada.',
                    ]],
                    ['t' => 'h', 'x' => 'B. Sobre la atención a menores de edad:'],
                    ['t' => 'ol', 'items' => [
                        'Tanto para citas médicas y psicológicas, todo menor de edad deberá acudir a acompañado por uno o ambos padres y/o cuidadores, caso contrario no podrá ser atendido por el médico o psicólogo.',
                        'Los padres y/o cuidadores del menor se comprometen en participar y seguir las recomendaciones del especialista. Su participación es indispensable para la efectividad del tratamiento.',
                        'En caso de tutores, deberán venir con una carta de consentimiento emitido por ambos padres.',
                        'En el caso que la atención de un menor de edad sea solicitada sólo por uno de los padres o cuidador este será el único encargado y responsable de informar al otro progenitor o cuidador sobre el procedimiento realizado. El consultorio no se hace responsable por las formas y medios de comunicación que empleen los padres.',
                        'Si el progenitor o cuidador que no pudo asistir a la sesión del menor desea tener información del proceso, podrá hacerlo mediante una cita con el médico o psicólogo tratante según amerite la situación.',
                    ]],
                    ['t' => 'h', 'x' => 'C. Sobre los profesionales:'],
                    ['t' => 'ul', 'items' => [
                        'Los médicos y psicólogos que brindan servicios en LUMENTI ejercen plena autonomía técnica y asumen la responsabilidad directa por los actos que deriven del ejercicio de su profesión. En ese sentido, cada profesional se obliga a mantener indemne a LUMENTI, sus directores, empleados y accionistas respecto de cualquier demanda, reclamo, denuncia, proceso, medida judicial o extrajudicial, así como investigaciones administrativas, regulatorias, civiles, penales o arbitrales que pudieran originarse por la prestación parcial, tardía o defectuosa de los servicios, o por el incumplimiento de las obligaciones asumidas por el profesional en virtud del contrato que mantiene con LUMENTI.',
                        'En algunos casos, la atención puede ser brindada por profesionales que no mantienen una relación de dependencia laboral con LUMENTI, en estos casos específicos, las emisiones de comprobantes de pago correspondientes , así como el cumplimiento de las obligaciones tributarias, recae exclusivamente en el especialista que presta el servicio. En dichos escenarios, LUMENTI actúa únicamente como soporte administrativo, facilitando la agenda, la plataforma de coordinación y la gestión de citas para el paciente.',
                    ]],
                    ['t' => 'h', 'x' => 'D. Sobre los pagos:'],
                    ['t' => 'ul', 'items' => [
                        'El pago se realizará de acuerdo a las tarifas individuales médicas y psicológicas, como también a los paquetes psicológicos indicados en nuestro canal de atención whatsapp y correo electrónico. Los cuales podrán variar de acuerdo a criterio de LUMENTI.',
                        'Las formas de pago podrán variar y serán las que se informen debidamente por nuestro canal oficial de whatsapp y correo electrónico.',
                        'Los costos de cada atención podrán ser diferentes de acuerdo a la modalidad de la atención: presencial, virtual o a domicilio.',
                        'Para confirmar y reservar un horario en agenda, el pago deberá realizarse con una anticipación mínima de setenta y dos (72) horas previas a la cita programada. En caso de no efectuarse el pago dentro del plazo establecido, LUMENTI se reserva el derecho de liberar el horario para asignarlo a otro paciente.',
                    ]],
                    ['t' => 'h', 'x' => 'E. Sobre los certificados de salud mental e informes clínicos:'],
                    ['t' => 'ul', 'items' => [
                        'Los certificados médicos solo pueden ser emitidos por médicos colegiados (p. ej., psiquiatras). Los informes/constancias psicológicas son emitidos por psicólogos colegiados dentro de su competencia.',
                        'La emisión está sujeta a evaluación clínica (presencial u online con verificación de identidad) y a los criterios profesionales del/la especialista. No se emiten con carácter retroactivo ni sin evidencia clínica suficiente; la evaluación y el certificado se incorporan a la historia clínica.',
                        'Se expiden en formato institucional y/o formato oficial del CMP cuando corresponda, con firma manuscrita y sello o firma digital/electrónica conforme a la Ley de Firmas y Certificados Digitales y lineamientos del MINSA para actos médicos electrónicos.',
                        'La aceptación, vigencia y requisitos son definidos por la entidad receptora (p. ej., notaría, empleador, universidad, aseguradora). LUMENTI no garantiza la aceptación de un documento si la entidad exige formatos o evaluaciones adicionales ajenos a nuestra práctica.',
                        'El plazo de entrega estándar es de máximo 5 días hábiles (informes) tras la evaluación, salvo casos complejos que requieran revisión adicional. La emisión y duplicados tienen tarifas informadas previamente.',
                        'Los peritajes psiquiátricos u otros usos judiciales/administrativos no forman parte de las atenciones ordinarias y requieren servicio y presupuesto separados.',
                    ]],
                    ['t' => 'h', 'x' => 'F. Sobre las recetas médicas'],
                    ['t' => 'ul', 'items' => [
                        'Las recetas solo se emiten tras evaluación clínica (presencial u online) realizada por el médico tratante y registrada en la historia clínica.',
                        'No emitimos, renovamos ni modificamos recetas por WhatsApp, correo u otros canales sin consulta médica.',
                        'En consultas online verificamos la identidad y las condiciones mínimas de privacidad/seguridad antes de prescribir.',
                        'La necesidad de controles periódicos (frecuencia y modalidad) la define el médico tratante según el caso. Las renovaciones requieren control; no se entregan recetas “abiertas” ni de forma indefinida.',
                        'Para fármacos controlados, se exige cita de control y criterios de seguridad reforzados. No se emiten duplicados por extravío ni ampliaciones sin consulta.',
                        'Cualquier ajuste de dosis o sustitución debe ser indicado por el médico tratante; no se validan cambios propuestos por terceros o por la farmacia sin evaluación.',
                        'La receta se emite en formato institucional (digital firmada o física) según disponibilidad y requisitos del tratamiento.',
                        'La aceptación y requisitos del documento (p. ej., aseguradoras o farmacias) dependen de cada entidad.',
                        'LUMENTI desalienta la automedicación y el uso de recetas pasadas sin indicación vigente.',
                        'En casos excepcionales y debidamente justificados (p. ej., reprogramación de última hora ya confirmada), el médico tratante podrá otorgar una única extensión breve para continuidad del mismo tratamiento y limitada a un período acotado. Esta medida se evalúa caso por caso por seguridad del paciente y no sustituye la cita de control.',
                    ]],
                    ['t' => 'h', 'x' => 'G. Con relación a las atenciones online:'],
                    ['t' => 'ul', 'items' => [
                        'Las atenciones virtuales se pueden brindar a personas a nivel nacional (Perú) y en el extranjero.',
                        'Lumenti garantiza que las sesiones virtuales que realiza el especialista sean en un ambiente adecuado, no haciéndose responsable del ambiente que el cliente elija.',
                        'Lumenti no se responsabiliza por la caída del internet, señal o imagen del dispositivo del cliente al momento de la sesión virtual, si ocurriese un corte de luz o desperfecto impidiéndole mantener la conexión de la videollamada.',
                        'Si ocurriese una caída del internet, señal o imagen del equipo electrónico del especialista, será él/ella responsable de coordinar con él/la cliente, a través de las asistentes del consultorio, para reprogramarle la sesión o prolongarla de acuerdo con lo ocurrido.',
                        'Por respeto a la confidencialidad profesional - paciente, las sesiones no podrán ser grabadas por el profesional ni por el cliente.',
                    ]],
                ],
            ],
            [
                'titulo' => 'VI. Licencia de uso',
                'bloques' => [
                    ['t' => 'p', 'x' => 'LUMENTI le otorga una licencia limitada, revocable, no exclusiva, intransferible y sin sublicencia para acceder y usar este sitio y sus contenidos con fines personales y no comerciales, a efectos de informarte y gestionar citas.'],
                    ['t' => 'p', 'x' => 'Queda prohibido: (i) reproducir, distribuir, vender o revender contenidos; (ii) realizar scraping, minería/extracción automatizada de datos, uso de bots o herramientas similares; (iii) hacer framing o crear obras derivadas del sitio o sus contenidos; (iv) ingeniería inversa de funcionalidades; (v) compilar listados de profesionales, servicios o precios con fines comerciales; y (vi) borrar avisos de derechos o marcas.'],
                    ['t' => 'p', 'x' => 'Todos los derechos de propiedad intelectual sobre el sitio y sus contenidos pertenecen a LUMENTI o a sus licenciantes. No se cede ningún derecho distinto al uso limitado descrito. El incumplimiento de esta cláusula extingue automáticamente la licencia.'],
                ],
            ],
            [
                'titulo' => 'VII. Modificación de Términos y gestión de acceso',
                'bloques' => [
                    ['t' => 'p', 'x' => 'LUMENTI puede actualizar estos Términos; la versión vigente será la publicada en el sitio y regirá desde su publicación. El uso continuado del sitio implica su aceptación; le sugerimos revisarlos periódicamente. Podremos limitar o suspender el acceso al sitio o a ciertas funcionalidades (sin afectar citas ya confirmadas, salvo supuestos de fuerza mayor, seguridad o exigencia legal) ante: (i) incumplimiento de estos Términos; (ii) uso abusivo o riesgoso; (iii) fraude o presunta actividad ilícita; o (iv) requerimiento de autoridad. También podremos eliminar contenidos, bloquear transacciones o cancelar cuentas creadas indebidamente. El usuario mantendrá indemne a LUMENTI por los daños, costos y gastos (incluidos honorarios legales y tasas) que deriven de su incumplimiento o uso indebido del sitio y contenidos. Lo anterior no limita los derechos del consumidor ni nuestras obligaciones frente a pacientes conforme a la normativa aplicable.'],
                ],
            ],
            [
                'titulo' => 'VIII. Libro de reclamaciones',
                'bloques' => [
                    ['t' => 'p', 'x' => 'LUMENTI pone a disposición de sus usuarios Libro de Reclamaciones Físico y Virtual:'],
                    ['t' => 'ul', 'items' => [
                        'Libro de Reclamaciones Virtual: accesible desde el botón “Libro de Reclamaciones” visible en nuestro sitio web. Al registrarlo, recibirá su constancia por correo.',
                        'Libro de Reclamaciones Físico: disponible en recepción (Calle Antares 320, Torre B, Consultorio 604, Santiago de Surco, Lima) en horario lunes a viernes de 9am a 6pm y los sábados de 9am a 1pm, con hojas autocopiativas debidamente numeradas (se entrega copia al consumidor).',
                    ]],
                    ['t' => 'p', 'x' => 'Plazo de atención. Toda queja o reclamo registrado en el Libro (físico o virtual) será respondido en un máximo de 15 días hábiles, sin prórroga.'],
                    ['t' => 'p', 'x' => 'Si no recibe respuesta dentro del plazo o no queda conforme, puede acudir a Indecopi y sus canales de atención para consumidores.'],
                ],
            ],
            [
                'titulo' => 'IX. Derechos de autor, propiedad intelectual y bases de datos',
                'bloques' => [
                    ['t' => 'p', 'x' => 'Salvo indicación en contrario, todo el contenido publicado en este Sitio Web —incluidos, de forma enunciativa, textos, artículos, guías, gráficos, logotipos, iconos, imágenes, fotografías, videos, audios, diseños, código, layouts, así como bases de datos, compilaciones y su selección/organización— es titularidad de Renova Mentis S.A.C. (LUMENTI) o de sus licenciantes. Todos los derechos están reservados.'],
                    ['t' => 'p', 'x' => 'Queda prohibido copiar, reproducir, distribuir, comunicar públicamente, transformar, crear obras derivadas, hacer framing, realizar scraping/minería de datos o explotar comercialmente total o parcialmente los contenidos sin autorización previa y por escrito de LUMENTI. Se permite únicamente el uso personal y no comercial de visualización/impresión, siempre que no se altere el contenido y se mantengan los avisos de derechos correspondientes. Esta cláusula no concede licencias ni derechos distintos a los aquí previstos.'],
                    ['t' => 'p', 'x' => 'Las marcas, nombres comerciales y otros signos distintivos mostrados pertenecen a LUMENTI o a terceros y no pueden usarse sin autorización. El contenido de terceros publicado en el sitio permanece como propiedad de sus respectivos titulares.'],
                ],
            ],
            [
                'titulo' => 'X. Derechos de autor, propiedad intelectual y bases de datos',
                'bloques' => [
                    ['t' => 'p', 'x' => 'En la medida permitida por la ley aplicable, LUMENTI, sus profesionales independientes, proveedores y licenciantes no serán responsables por daños indirectos, incidentales, especiales, punitivos o consecuenciales (incluyendo lucro cesante, pérdida de datos, interrupción del negocio o fallas de equipos/softwares), derivados del uso o imposibilidad de uso del sitio, de sus contenidos o de las funcionalidades de reserva/comunicación, aun cuando se hubiera advertido la posibilidad de tales daños.'],
                    ['t' => 'p', 'x' => 'LUMENTI no garantiza la disponibilidad ininterrumpida del sitio ni la ausencia de errores, demoras, caídas de plataformas de terceros, cortes de internet/energía o tareas de mantenimiento, y no asume responsabilidad por tales eventos, sin perjuicio de reprogramar citas afectadas conforme a nuestras políticas.'],
                    ['t' => 'h', 'x' => 'Blog y contenidos/Enlaces de terceros'],
                    ['t' => 'p', 'x' => 'El Blog y cualquier contenido o enlace de terceros se ofrecen con fines informativos.'],
                    ['t' => 'p', 'x' => 'Aunque procuramos compartir información confiable y actualizada, LUMENTI no asume responsabilidad por su exactitud, vigencia o efectos. Dichos contenidos no sustituyen una evaluación clínica; para decisiones sobre su salud, consulte a su psiquiatra.'],
                    ['t' => 'h', 'x' => 'Límite máximo (sin afectar derechos del consumidor)'],
                    ['t' => 'p', 'x' => 'Cuando corresponda responsabilidad legal directa y exigible a LUMENTI, esta se limita —en conjunto— al monto efectivamente pagado por el servicio afectado, sin perjuicio de los derechos irrenunciables del consumidor previstos en la normativa peruana.'],
                ],
            ],
            [
                'titulo' => 'XI. Privacidad y tratamiento de datos personales',
                'bloques' => [
                    ['t' => 'p', 'x' => 'El tratamiento de los datos personales recabados a través de nuestros canales oficiales —Sitio web (www.lumentisaludmental.com), WhatsApp (+51 939 033 999) y correo contacto@lumentisaludmental.com), así como formularios de reserva— es realizado principalmente por Renova Mentis S.A.C. (LUMENTI), conforme a la Ley N.° 29733 y su Reglamento aprobado por D.S. N.° 016-2024-JUS.'],
                    ['t' => 'h', 'x' => 'Qué datos tratamos:'],
                    ['t' => 'ul', 'items' => [
                        'Identificación y contacto: nombres, documento, teléfono, correo.',
                        'Datos de navegación: IP, identificadores en línea, cookies de seguridad, carga de páginas, preferencias básicas.',
                        'Datos de salud: los estrictamente necesarios para brindar atención médica y psicológica (presencial u online), con consentimiento expreso.',
                    ]],
                    ['t' => 'p', 'x' => 'Finalidades: (i) Gestionar citas, comunicaciones y atención clínica; (ii) facturación y cumplimiento legal; (iii) seguridad y mejora del sitio; y (iv) comunicaciones informativas/marketing propio cuando lo autorices (puede darse de baja en cualquier momento).'],
                    ['t' => 'p', 'x' => 'Canales y consentimiento: Al interactuar por sitio, WhatsApp o correo, nos autoriza a tratar tus datos según esta cláusula y la Política de Privacidad. Estos canales son administrativos/informativos y no sustituyen una evaluación clínica ni atienden emergencias.'],
                    ['t' => 'p', 'x' => 'Encargados y transferencias: Podemos compartir datos con proveedores (hosting, agenda, videoconferencia, mensajería, pagos, analítica), incluso fuera del Perú, bajo acuerdos de encargo y salvaguardas adecuadas. No vendemos datos personales.'],
                    ['t' => 'p', 'x' => 'Derechos del titular: Puede ejercer acceso, información, rectificación, cancelación/supresión, oposición y revocación del consentimiento escribiendo a contacto@lumentisaludmental.com conforme a los plazos de la normativa peruana.'],
                    ['t' => 'p', 'x' => 'Más detalle en nuestra Política de Privacidad.'],
                ],
            ],
            [
                'titulo' => 'XII. Legislación aplicable',
                'bloques' => [
                    ['t' => 'p', 'x' => 'Estas Condiciones de Uso se rigen y serán aplicadas e interpretados de acuerdo con la legislación peruana. Cualquier disputa que surja en su aplicación se someterá al conocimiento de los tribunales con jurisdicción en Lima, Perú.'],
                ],
            ],
            [
                'titulo' => 'XIII. Contacto',
                'bloques' => [
                    ['t' => 'p', 'x' => 'Para cualquier pregunta respecto de estas Condiciones de Uso, por favor contáctenos a: contacto@lumentisaludmental.com'],
                ],
            ],
        ],
    ],
];

$lumenti_clave = (string) ($args['documento'] ?? 'privacidad');
$lumenti_doc = $lumenti_documentos[$lumenti_clave] ?? $lumenti_documentos['privacidad'];
$lumenti_secciones = array_values(array_filter($lumenti_doc['secciones'], static fn($s) => trim((string) ($s['titulo'] ?? '')) !== ''));
if (!$lumenti_secciones) {
    return;
}
?>
<div class="lm-legal">
    <div class="lm-legal__inner">
        <nav class="lm-legal__toc" aria-label="<?= esc_attr__('En esta página', 'lumenti') ?>" data-lm-legal-toc>
            <?php if ($lumenti_indice_titulo !== '') : ?>
                <p class="lm-legal__toc-title"><?= esc_html($lumenti_indice_titulo) ?></p>
            <?php endif; ?>
            <ol class="lm-legal__toc-list">
                <?php foreach ($lumenti_secciones as $lumenti_i => $lumenti_s) : ?>
                    <li><a class="lm-legal__toc-link" href="#seccion-<?= (int) $lumenti_i + 1 ?>"><?= esc_html($lumenti_s['titulo']) ?></a></li>
                <?php endforeach; ?>
            </ol>
        </nav>
        <div class="lm-legal__content">
            <?php foreach ($lumenti_secciones as $lumenti_i => $lumenti_s) : $lumenti_id = 'seccion-' . ($lumenti_i + 1); ?>
                <section class="lm-legal__section" id="<?= esc_attr($lumenti_id) ?>" aria-labelledby="<?= esc_attr($lumenti_id . '-t') ?>">
                    <h2 class="lm-legal__h2 uppercase" id="<?= esc_attr($lumenti_id . '-t') ?>"><?= esc_html($lumenti_s['titulo']) ?></h2>
                    <?php foreach ((array) ($lumenti_s['bloques'] ?? []) as $lumenti_b) :
                        $lumenti_t = (string) ($lumenti_b['t'] ?? 'p');
                    ?>
                        <?php if ($lumenti_t === 'ul' || $lumenti_t === 'ol') : ?>
                            <<?= $lumenti_t ?> class="lm-legal__list">
                                <?php foreach ((array) ($lumenti_b['items'] ?? []) as $lumenti_li) : ?>
                                    <li class="lm-legal__li"><?= esc_html($lumenti_li) ?></li>
                                <?php endforeach; ?>
                            </<?= $lumenti_t ?>>
                        <?php elseif ($lumenti_t === 'h') : ?>
                            <h3 class="lm-legal__h2 lm-legal__p"><?= esc_html($lumenti_b['x'] ?? '') ?></h3>
                        <?php else : ?>
                            <p class="lm-legal__p"><?= esc_html($lumenti_b['x'] ?? '') ?></p>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </section>
            <?php endforeach; ?>
            <?php if ($lumenti_doc['actualizado'] !== '') : ?>
                <p class="lm-legal__foot"><?= esc_html__('Última actualización:', 'lumenti') ?> <?= esc_html($lumenti_doc['actualizado']) ?></p>
            <?php endif; ?>
        </div>
    </div>
</div>
