<?php
defined('ABSPATH') || exit;

/*
 * Condición · abordaje (specs/condicion.md → abordaje). Grupo ACF: condicion_abordaje.
 * Sección oscura (data-lm-nav-tone="dark": el header cambia de tono encima) con título, intro y la lista
 * ordenada de pasos, siempre visible (el diseño la plegaba en acordeón solo bajo 768 px).
 * En el texto, una línea en blanco separa párrafos.
 */

$lumenti_abordaje = get_field('condicion_abordaje') ?: [];
$lumenti_intro = trim((string) ($lumenti_abordaje['intro'] ?? ''));

$lumenti_items = array_values(array_filter((array) ($lumenti_abordaje['items'] ?? []), static fn($i) => trim((string) ($i['titulo'] ?? '')) !== ''));
if (!$lumenti_items) {
    return;
}
?>
<section class="lm-cond-approach" data-lm-nav-tone="dark" aria-labelledby="lm-approach-title">
    <div class="lm-cond-approach__header"><h2 class="lm-section-title lm-section-title--light" id="lm-approach-title"><?= esc_html((string) ($lumenti_abordaje['titulo'] ?? '')) ?></h2><?php if ($lumenti_intro !== '') : ?><p class="lm-cond-approach__intro"><?= lumenti_highlight($lumenti_intro) ?></p><?php endif; ?></div>
    <ol class="lm-cond-approach__list">
        <?php foreach ($lumenti_items as $lumenti_item) : ?>
            <li class="lm-cond-approach__item">
                <h3 class="lm-cond-approach__title"><?= esc_html($lumenti_item['titulo']) ?></h3>
                <div class="lm-cond-approach__body">
                    <?php foreach (preg_split('/\n\s*\n/', trim((string) ($lumenti_item['texto'] ?? ''))) as $lumenti_parrafo) : ?>
                        <p class="lm-cond-approach__text"><?= lumenti_highlight($lumenti_parrafo) ?></p>
                    <?php endforeach; ?>
                </div>
            </li>
        <?php endforeach; ?>
    </ol>
</section>
