<?php
defined('ABSPATH') || exit;

/*
 * Informes y certificados · tipos (specs/informes-y-certificados.md → tipos). Grupo ACF: informes_y_certificados_tipos.
 * Contenido: get_field('informes_y_certificados_tipos'). Una tarjeta por grupo (article + h3) con sus documentos en un <dl>.
 * Un grupo sin documentos no se muestra.
 */

$lumenti_tipos = get_field('informes_y_certificados_tipos') ?: [];

// Solo grupos con nombre y al menos un documento con nombre.
$lumenti_grupos = [];
foreach ((array) ($lumenti_tipos['grupos'] ?? []) as $lumenti_g) {
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
        'titulo' => (string) ($lumenti_tipos['titulo'] ?? ''),
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
                            <dd class="lm-doc-types__desc"><?= lumenti_highlight((string) ($lumenti_doc['descripcion'] ?? '')) ?></dd>
                        </div>
                    <?php endforeach; ?>
                </dl>
            </article>
        <?php endforeach; ?>
    </div>
</section>
