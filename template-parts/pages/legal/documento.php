<?php
defined('ABSPATH') || exit;

/*
 * Legal · documento (specs/politica-de-privacidad.md → documento). Grupo ACF: politica_de_privacidad_documento (cada página guarda el suyo).
 * Índice lateral + texto. Índice: src/js/modules/legal.js (gancho data-lm-legal-toc); sin JS las anclas siguen
 * funcionando. El contenido de cada sección es un wysiwyg: a sus párrafos, listas y subtítulos se les suman las
 * clases del diseño (lm-legal__p, __list, __li, __h2). Al pie, la fecha de politica_de_privacidad_cabecera.
 */

$lumenti_documento = get_field('politica_de_privacidad_documento') ?: [];
$lumenti_cabecera = get_field('politica_de_privacidad_cabecera') ?: [];
$lumenti_indice_titulo = (string) ($lumenti_documento['indice_titulo'] ?? '');
$lumenti_fecha = (string) ($lumenti_cabecera['actualizado'] ?? '');
$lumenti_secciones = array_values(array_filter((array) ($lumenti_documento['secciones'] ?? []), static fn($s) => trim((string) ($s['titulo'] ?? '')) !== ''));
if (!$lumenti_secciones) {
    return;
}

// Clases del diseño en el HTML del editor (solo en las etiquetas que no traen class).
$lumenti_clases = [
    'p' => 'lm-legal__p',
    'ul' => 'lm-legal__list',
    'ol' => 'lm-legal__list',
    'li' => 'lm-legal__li',
    'h3' => 'lm-legal__h2 lm-legal__p',
    'h4' => 'lm-legal__h2 lm-legal__p',
];
$lumenti_contenido = static function (string $html) use ($lumenti_clases): string {
    $html = (string) preg_replace_callback(
        '/<(p|ul|ol|li|h3|h4)(?=[\s>])(?![^>]*\bclass=)/i',
        static fn($m) => '<' . $m[1] . ' class="' . $lumenti_clases[strtolower($m[1])] . '"',
        wpautop($html)
    );
    return wp_kses_post($html);
};
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
                    <?= $lumenti_contenido((string) ($lumenti_s['contenido'] ?? '')) ?>
                </section>
            <?php endforeach; ?>
            <?php if ($lumenti_fecha !== '') : ?>
                <p class="lm-legal__foot"><?= esc_html__('Última actualización:', 'lumenti') ?> <?= esc_html($lumenti_fecha) ?></p>
            <?php endif; ?>
        </div>
    </div>
</div>
