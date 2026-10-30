<?php
defined('ABSPATH') || exit;

/*
 * Informes y certificados · tipos (specs/informes.md → tipos). Grupo ACF: informes_tipos.
 * Una tarjeta por grupo (article + h3) con sus documentos en un <dl>. Contenido inicial de data/informes.json.
 * Un grupo sin documentos no se muestra.
 */

$lumenti_tipos = [
    'titulo' => 'TIPOS DE DOCUMENTOS',
    'grupos' => [
        [
            'grupo' => 'GENERAL',
            'documentos' => [
                ['nombre' => 'CONSTANCIA DE ATENCIÓN', 'descripcion' => 'Documento que confirma que una persona recibió atención en Lumenti en una fecha determinada.'],
            ],
        ],
        [
            'grupo' => 'PSIQUIATRÍA',
            'documentos' => [
                ['nombre' => 'CERTIFICADO DE SALUD MENTAL', 'descripcion' => 'Documento médico emitido por un psiquiatra colegiado que certifica el estado de salud mental de una persona para una finalidad específica. Requiere una evaluación psiquiátrica previa.'],
                ['nombre' => 'INFORME DE SALUD MENTAL – PSIQUIATRÍA', 'descripcion' => 'Documento clínico elaborado por un médico psiquiatra que presenta información relevante sobre la evaluación, evolución, diagnóstico, tratamiento y recomendaciones, de acuerdo con la finalidad solicitada y el criterio del especialista.'],
                ['nombre' => 'CERTIFICADO DE MASCOTA DE APOYO EMOCIONAL', 'descripcion' => 'Documento emitido por un médico psiquiatra cuando, después de una evaluación clínica, determina que la compañía de una mascota cumple una función relevante dentro del bienestar o plan terapéutico del paciente.'],
            ],
        ],
        [
            'grupo' => 'PSICOLOGÍA',
            'documentos' => [
                ['nombre' => 'INFORME DE SALUD MENTAL – PSICOLOGÍA', 'descripcion' => 'Documento elaborado por un psicólogo colegiado que integra el motivo de evaluación, los procedimientos utilizados y las conclusiones o recomendaciones pertinentes. Su contenido dependerá del tipo de evaluación realizada.'],
                ['nombre' => 'REPORTE PSICOLÓGICO', 'descripcion' => 'Documento elaborado por un psicólogo colegiado que resume aspectos relevantes del proceso de atención, como la asistencia, el motivo de consulta, los objetivos trabajados, la evolución observada y las recomendaciones generales, según corresponda.'],
            ],
        ],
    ],
];

// Solo grupos con nombre y al menos un documento con nombre.
$lumenti_grupos = [];
foreach ($lumenti_tipos['grupos'] as $lumenti_g) {
    $lumenti_docs = array_filter((array) ($lumenti_g['documentos'] ?? []), static fn($d) => trim((string) ($d['nombre'] ?? '')) !== '');
    if (trim((string) ($lumenti_g['grupo'] ?? '')) !== '' && $lumenti_docs) {
        $lumenti_grupos[] = ['grupo' => $lumenti_g['grupo'], 'documentos' => $lumenti_docs];
    }
}
if (!$lumenti_grupos) {
    return;
}
?>
<section class="lm-service-section lm-service-section--flush" aria-labelledby="lm-tipos">
    <?php get_template_part('template-parts/components/section-title', null, [
        'titulo' => $lumenti_tipos['titulo'],
        'id' => 'lm-tipos',
        'centrado' => true,
    ]); ?>
    <div class="lm-doc-types">
        <?php foreach ($lumenti_grupos as $lumenti_grupo) : ?>
            <article class="lm-doc-types__group">
                <h3 class="lm-doc-types__group-title"><?= esc_html($lumenti_grupo['grupo']) ?></h3>
                <dl class="lm-doc-types__list">
                    <?php foreach ($lumenti_grupo['documentos'] as $lumenti_doc) : ?>
                        <div class="lm-doc-types__item">
                            <dt class="lm-doc-types__name"><?= esc_html($lumenti_doc['nombre']) ?></dt>
                            <dd class="lm-doc-types__desc"><?= esc_html((string) ($lumenti_doc['descripcion'] ?? '')) ?></dd>
                        </div>
                    <?php endforeach; ?>
                </dl>
            </article>
        <?php endforeach; ?>
    </div>
</section>
