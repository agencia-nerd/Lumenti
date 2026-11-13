<?php
defined('ABSPATH') || exit;

/*
 * Especialista · resumen (specs/especialista.md → resumen). Grupo ACF: especialista_resumen.
 * Columna lateral: una tarjeta con Población, Modalidad e Idiomas (taxonomías poblacion, modalidad e
 * idioma) como texto separado por " · ", y Enfoques (repetidor) y Principales áreas de atención
 * (taxonomía que_trata) como listas con viñetas: se ven 8 y el resto se abre con "Ver N … más"
 * (especialista.js). Cada bloque se oculta si está vacío.
 */

$lumenti_resumen = get_field('especialista_resumen') ?: [];
$lumenti_nota_adultos = trim((string) ($lumenti_resumen['nota_adultos'] ?? ''));

$lumenti_poblacion = array_map(
    static fn($t) => ($t->name === 'Adultos' && $lumenti_nota_adultos !== '') ? sprintf('%s (%s)', $t->name, $lumenti_nota_adultos) : $t->name,
    lumenti_especialista_terminos('poblacion')
);
$lumenti_que_trata = wp_list_pluck(lumenti_especialista_terminos('que_trata'), 'name');
$lumenti_modalidad = wp_list_pluck(lumenti_especialista_terminos('modalidad'), 'name');
$lumenti_idiomas = wp_list_pluck(lumenti_especialista_terminos('idioma'), 'name');
$lumenti_enfoques = array_values(array_filter(array_map(
    static fn($fila) => trim((string) ($fila['nombre'] ?? '')),
    (array) ($lumenti_resumen['enfoques'] ?? [])
)));

// Bloques de texto unido con " · ".
$lumenti_bloques = array_filter([
    __('Población', 'lumenti') => $lumenti_poblacion,
    __('Modalidad', 'lumenti') => $lumenti_modalidad,
    __('Idiomas', 'lumenti') => $lumenti_idiomas,
]);

// Bloques de lista con viñetas: se ven $lumenti_lista_max y el resto se abre con "Ver más" (JS; sin JS se ven todos).
$lumenti_lista_max = 8;
$lumenti_listas = array_filter([
    'enfoques' => [
        'label' => __('Enfoques', 'lumenti'),
        'items' => $lumenti_enfoques,
        /* translators: %d: enfoques que faltan mostrar. */
        'more' => static fn(int $n) => sprintf(_n('Ver %d enfoque más', 'Ver los %d enfoques más', $n, 'lumenti'), $n),
    ],
    'areas' => [
        'label' => __('Principales áreas de atención', 'lumenti'),
        'items' => $lumenti_que_trata,
        /* translators: %d: áreas que faltan mostrar. */
        'more' => static fn(int $n) => sprintf(_n('Ver %d área más', 'Ver las %d áreas más', $n, 'lumenti'), $n),
    ],
], static fn($l) => (bool) $l['items']);

if (!$lumenti_bloques && !$lumenti_listas) {
    return;
}
?>
<aside class="lm-profile__side" aria-label="<?= esc_attr__('Resumen', 'lumenti') ?>">
    <div class="lm-profile__panel lm-profile__panel--resumen">
        <?php foreach ($lumenti_bloques as $lumenti_label => $lumenti_valores) : ?>
            <div class="lm-profile__block">
                <p class="lm-profile__panel-label"><?= esc_html($lumenti_label) ?></p>
                <p class="lm-profile__fact-value"><?= esc_html(implode(' · ', $lumenti_valores)) ?></p>
            </div>
        <?php endforeach; ?>
        <?php foreach ($lumenti_listas as $lumenti_key => $lumenti_lista) :
            $lumenti_id = 'lm-' . $lumenti_key;
            $lumenti_resto = count($lumenti_lista['items']) - $lumenti_lista_max;
            ?>
            <div class="lm-profile__block lm-profile__block--list" data-lm-side-block>
                <p class="lm-profile__panel-label" id="<?= esc_attr($lumenti_id . '-label') ?>"><?= esc_html($lumenti_lista['label']) ?></p>
                <ul class="lm-profile__bullets" id="<?= esc_attr($lumenti_id) ?>" aria-labelledby="<?= esc_attr($lumenti_id . '-label') ?>" data-lm-side-list data-max="<?= esc_attr((string) $lumenti_lista_max) ?>">
                    <?php foreach ($lumenti_lista['items'] as $lumenti_item) : ?>
                        <li class="lm-profile__bullet"><?= esc_html($lumenti_item) ?></li>
                    <?php endforeach; ?>
                </ul>
                <?php if ($lumenti_resto > 0) : ?>
                    <button type="button" class="lm-profile__more" aria-controls="<?= esc_attr($lumenti_id) ?>" aria-expanded="false" hidden data-lm-side-btn data-less="<?= esc_attr__('Ver menos', 'lumenti') ?>">
                        <span data-lm-side-text><?= esc_html(($lumenti_lista['more'])($lumenti_resto)) ?></span>
                        <span class="lm-profile__more-sign" aria-hidden="true" data-lm-side-sign>+</span>
                    </button>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</aside>
