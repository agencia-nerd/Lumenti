<?php
defined('ABSPATH') || exit;

/*
 * Contenido inicial de Informes y certificados (specs/informes-y-certificados.md): el texto y las imágenes que
 * salieron de template-parts/pages/informes/*.php (datos del diseño: data/informes.json).
 */
return [
    'page'   => 'informes-y-certificados',
    'fields' => [
        'informes_y_certificados_hero' => [
            'titulo'   => "*INFORMES Y*\nCERTIFICADOS CLÍNICOS",
            'nota'     => 'Atención presencial y virtual para cada etapa de la vida.',
            'etiqueta' => 'SOBRE EL SERVICIO',
            'bajada'   => 'Elaboramos informes y certificados clínicos respaldados por una evaluación profesional. Cada documento se emite de acuerdo con su finalidad, el criterio del especialista y la información clínica disponible.',
        ],
        'informes_y_certificados_intro' => [
            'titulo'            => 'RESPALDO CLÍNICO Y *VALIDEZ DOCUMENTAL*',
            'texto'             => "Los informes y certificados son documentos clínicos emitidos y firmados por profesionales de la salud colegiados, a partir de una evaluación profesional. Incluyen los datos del especialista responsable y quedan registrados en la historia clínica del paciente.\n\nSu contenido responde a los hallazgos clínicos y al propósito para el cual fueron solicitados. Por ello, no pueden emitirse sin una evaluación previa ni incorporar información que no cuente con sustento clínico suficiente.\n\nLa aceptación, vigencia, formato y requisitos específicos dependen de la institución que recibirá el documento. Recomendamos consultar previamente estas condiciones con el empleador, centro educativo, aseguradora, notaría u otra entidad solicitante.",
            'aviso'             => 'La aceptación, vigencia, formato y requisitos específicos dependen de la institución que recibirá el documento. Recomendamos consultar previamente estas condiciones con el empleador, centro educativo, aseguradora, notaría u otra entidad solicitante.',
            'imagen_principal'  => ['_file' => 'assets/img/inf-consulta.webp', 'alt' => 'Especialista de Lumenti conversando con un paciente en consulta'],
            'imagen_secundaria' => ['_file' => 'assets/img/inf-medico.webp', 'alt' => 'Médico con bata blanca redactando un documento'],
        ],
        'informes_y_certificados_tipos' => [
            'titulo' => 'TIPOS DE DOCUMENTOS',
            'grupos' => [
                [
                    'grupo'      => 'GENERAL',
                    'documentos' => [
                        ['nombre' => 'CONSTANCIA DE ATENCIÓN', 'descripcion' => 'Documento que confirma que una persona recibió atención en Lumenti en una fecha determinada.'],
                    ],
                ],
                [
                    'grupo'      => 'PSIQUIATRÍA',
                    'documentos' => [
                        ['nombre' => 'CERTIFICADO DE SALUD MENTAL', 'descripcion' => 'Documento médico emitido por un psiquiatra colegiado que certifica el estado de salud mental de una persona para una finalidad específica. Requiere una evaluación psiquiátrica previa.'],
                        ['nombre' => 'INFORME DE SALUD MENTAL – PSIQUIATRÍA', 'descripcion' => 'Documento clínico elaborado por un médico psiquiatra que presenta información relevante sobre la evaluación, evolución, diagnóstico, tratamiento y recomendaciones, de acuerdo con la finalidad solicitada y el criterio del especialista.'],
                        ['nombre' => 'CERTIFICADO DE MASCOTA DE APOYO EMOCIONAL', 'descripcion' => 'Documento emitido por un médico psiquiatra cuando, después de una evaluación clínica, determina que la compañía de una mascota cumple una función relevante dentro del bienestar o plan terapéutico del paciente.'],
                    ],
                ],
                [
                    'grupo'      => 'PSICOLOGÍA',
                    'documentos' => [
                        ['nombre' => 'INFORME DE SALUD MENTAL – PSICOLOGÍA', 'descripcion' => 'Documento elaborado por un psicólogo colegiado que integra el motivo de evaluación, los procedimientos utilizados y las conclusiones o recomendaciones pertinentes. Su contenido dependerá del tipo de evaluación realizada.'],
                        ['nombre' => 'REPORTE PSICOLÓGICO', 'descripcion' => 'Documento elaborado por un psicólogo colegiado que resume aspectos relevantes del proceso de atención, como la asistencia, el motivo de consulta, los objetivos trabajados, la evolución observada y las recomendaciones generales, según corresponda.'],
                    ],
                ],
            ],
        ],
        'informes_y_certificados_cta' => [
            'titulo'           => '¿NECESITAS UN CERTIFICADO O INFORME CLÍNICO?',
            'texto'            => 'Cuéntanos para qué entidad o finalidad lo necesitas y te orientaremos sobre el documento, la evaluación y los requisitos correspondientes.',
            'boton_texto'      => 'Escríbenos por WhatsApp',
            'mensaje_whatsapp' => 'Hola, quisiera información sobre informes y certificados.',
        ],
    ],
];
