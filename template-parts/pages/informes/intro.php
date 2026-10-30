<?php
defined('ABSPATH') || exit;

/*
 * Informes y certificados · intro (specs/informes.md → intro). Grupo ACF: informes_intro.
 * Prepara los datos y llama al componente intro-split: 3 párrafos (línea en blanco = párrafo nuevo) y el aviso
 * de validez (data/informes.json → aviso). El tercer párrafo repite el aviso, como en el diseño.
 */

$lumenti_intro = [
    'titulo' => 'RESPALDO CLÍNICO Y *VALIDEZ DOCUMENTAL*',
    'id' => 'lm-respaldo',
    'texto' => 'Los informes y certificados son documentos clínicos emitidos y firmados por profesionales de la salud colegiados, a partir de una evaluación profesional. Incluyen los datos del especialista responsable y quedan registrados en la historia clínica del paciente.

Su contenido responde a los hallazgos clínicos y al propósito para el cual fueron solicitados. Por ello, no pueden emitirse sin una evaluación previa ni incorporar información que no cuente con sustento clínico suficiente.

La aceptación, vigencia, formato y requisitos específicos dependen de la institución que recibirá el documento. Recomendamos consultar previamente estas condiciones con el empleador, centro educativo, aseguradora, notaría u otra entidad solicitante.',
    'aviso' => 'La aceptación, vigencia, formato y requisitos específicos dependen de la institución que recibirá el documento. Recomendamos consultar previamente estas condiciones con el empleador, centro educativo, aseguradora, notaría u otra entidad solicitante.',
    'imagenes' => [
        ['ruta' => 'assets/img/inf-consulta.webp', 'ancho' => 643, 'alto' => 834, 'alt' => 'Especialista de Lumenti conversando con un paciente en consulta'],
        ['ruta' => 'assets/img/inf-medico.webp', 'ancho' => 578, 'alto' => 758, 'alt' => 'Médico con bata blanca redactando un documento'],
    ],
];

get_template_part('template-parts/components/intro-split', null, $lumenti_intro);
