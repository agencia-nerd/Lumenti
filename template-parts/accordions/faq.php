<?php
defined('ABSPATH') || exit;

/*
 * Acordeón de un tema de la FAQ (specs/faq.md → preguntas). Motor: inc/accordions.php (wp-accordion).
 * Uno abierto a la vez dentro del tema (exclusive); se pueden cerrar todos. Clases del diseño (lm-faq__*);
 * el ajuste del ícono y del movimiento está en src/css/input.css.
 * $args: items [['pregunta', 'respuesta']], titulo_id (h2 del tema), abierta (índice abierto al cargar o null),
 *        inicio (número corrido para los ids lm-faq-q{n}).
 */

$lumenti_items = (array) ($args['items'] ?? []);
$lumenti_abierta = $args['abierta'] ?? null;
$lumenti_inicio = (int) ($args['inicio'] ?? 0);
$lumenti_titulo_id = (string) ($args['titulo_id'] ?? 'lm-faq');

if (!$lumenti_items) {
    return;
}

lumenti_accordion_start($lumenti_titulo_id . '-preguntas', [
    'exclusive' => true,
    'icon' => 'plus',
    'heading' => 3,
    'class' => 'lm-faq__list',
    'item_class' => 'lm-faq__item',
    'summary_class' => 'lm-faq__toggle',
    'title_class' => 'lm-faq__question',
    'icon_class' => 'lm-faq__icon',
]);

foreach ($lumenti_items as $lumenti_i => $lumenti_item) {
    $lumenti_pregunta = (string) ($lumenti_item['pregunta'] ?? '');
    if (trim($lumenti_pregunta) === '') {
        continue;
    }
    lumenti_accordion_item_start($lumenti_pregunta, [
        'id' => 'lm-faq-q' . ($lumenti_inicio + $lumenti_i),
        'open' => $lumenti_abierta !== null && (int) $lumenti_abierta === $lumenti_i,
    ]);
    ?>
    <p class="lm-faq__answer"><?= esc_html($lumenti_item['respuesta'] ?? '') ?></p>
    <?php
    lumenti_accordion_item_end();
}

lumenti_accordion_end();
