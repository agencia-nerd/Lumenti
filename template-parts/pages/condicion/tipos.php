<?php
defined('ABSPATH') || exit;

/*
 * Condición · tipos (specs/condicion.md → tipos). Grupo ACF: condicion_tipos.
 * Bloque extra opcional (.lm-cond-types) con tres variantes (diseño: html/_preview-condicion-bloques.html):
 *   tabla       <dl> título/texto en dos columnas (Bipolar, TCA)          → después de la nota
 *   tarjetas    <ul> de tarjetas con h3 (Ansiedad)                          → después de la nota
 *   comparativa <dl> lado a lado, modificador --before (Psicosis, Trauma) → antes de las señales
 * Vacío = sin bloque. Depresión no lo tiene: en el ejemplo no se imprime.
 *
 * $args: posicion (antes | despues): single-condicion.php lo llama dos veces; cada llamada imprime el
 *        bloque solo si su variante va en esa posición.
 */

$lumenti_tipos = [
    'variante' => '',
    'titulo' => '',
    'intro' => '',
    'items' => [
        // ['titulo' => 'ANOREXIA NERVIOSA', 'texto' => '…'],
    ],
];

$lumenti_variante = in_array($lumenti_tipos['variante'], ['tabla', 'tarjetas', 'comparativa'], true) ? $lumenti_tipos['variante'] : '';
$lumenti_items = array_values(array_filter($lumenti_tipos['items'], static fn($i) => trim((string) ($i['titulo'] ?? '')) !== ''));
if ($lumenti_variante === '' || !$lumenti_items) {
    return;
}
$lumenti_antes = $lumenti_variante === 'comparativa';
if ($lumenti_antes !== (($args['posicion'] ?? 'despues') === 'antes')) {
    return;
}
$lumenti_clase = 'lm-cond-types lm-cond-types--' . $lumenti_variante . ($lumenti_antes ? ' lm-cond-types--before' : '');
?>
<section class="<?= esc_attr($lumenti_clase) ?>" aria-labelledby="lm-types-title">
    <div class="lm-cond-types__header"><h2 class="lm-section-title" id="lm-types-title"><?= esc_html($lumenti_tipos['titulo']) ?></h2><?php if ($lumenti_tipos['intro'] !== '') : ?><p class="lm-lead lm-cond-types__intro"><?= esc_html($lumenti_tipos['intro']) ?></p><?php endif; ?></div>
    <?php if ($lumenti_variante === 'tarjetas') : ?>
        <ul class="lm-cond-types__list"><?php foreach ($lumenti_items as $lumenti_item) : ?><li class="lm-cond-types__item"><h3 class="lm-cond-types__item-title"><?= esc_html($lumenti_item['titulo']) ?></h3><p class="lm-cond-types__item-text"><?= esc_html((string) ($lumenti_item['texto'] ?? '')) ?></p></li><?php endforeach; ?></ul>
    <?php else : ?>
        <dl class="lm-cond-types__list"><?php foreach ($lumenti_items as $lumenti_item) : ?><div class="lm-cond-types__item"><dt class="lm-cond-types__item-title"><?= esc_html($lumenti_item['titulo']) ?></dt><dd class="lm-cond-types__item-text"><?= esc_html((string) ($lumenti_item['texto'] ?? '')) ?></dd></div><?php endforeach; ?></dl>
    <?php endif; ?>
</section>
