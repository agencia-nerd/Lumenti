<?php
defined('ABSPATH') || exit;

/*
 * Especialista · resumen (specs/especialista.md → resumen). Grupo ACF: especialista_resumen.
 * Columna lateral: Población y Qué trata (taxonomías poblacion y que_trata, nombre corto), enfoques
 * (repetidor, oculto si está vacío), Modalidad e Idiomas (taxonomías modalidad e idioma).
 * Los chips son texto fijo (no enlazan a ninguna página).
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
?>
<aside class="lm-profile__side" aria-label="<?= esc_attr__('Resumen', 'lumenti') ?>">
    <div class="lm-profile__panel">
        <?php if ($lumenti_poblacion) : ?>
            <p class="lm-profile__panel-label">Población</p>
            <ul class="lm-profile__chips"><?php foreach ($lumenti_poblacion as $lumenti_p) : ?><li class="lm-card-especialista__chip"><?= esc_html($lumenti_p) ?></li><?php endforeach; ?></ul>
        <?php endif; ?>
        <?php if ($lumenti_que_trata) : ?>
            <p class="lm-profile__panel-label lm-profile__panel-label--spaced">Qué trata</p>
            <ul class="lm-profile__chips"><?php foreach ($lumenti_que_trata as $lumenti_t) : ?><li class="lm-card-especialista__chip lm-profile__chip"><?= esc_html($lumenti_t) ?></li><?php endforeach; ?></ul>
        <?php endif; ?>
    </div>
    <?php if ($lumenti_enfoques) : ?>
        <div class="lm-profile__panel">
            <p class="lm-profile__panel-label">Enfoques</p>
            <ul class="lm-profile__chips"><?php foreach ($lumenti_enfoques as $lumenti_e) : ?><li class="lm-card-especialista__chip lm-profile__chip"><?= esc_html($lumenti_e) ?></li><?php endforeach; ?></ul>
        </div>
    <?php endif; ?>
    <?php if ($lumenti_modalidad || $lumenti_idiomas) : ?>
        <div class="lm-profile__panel lm-profile__panel--split">
            <?php if ($lumenti_modalidad) : ?>
                <div class="lm-profile__fact"><p class="lm-profile__panel-label">Modalidad</p><p class="lm-profile__fact-value"><?= esc_html(implode(' · ', $lumenti_modalidad)) ?></p></div>
            <?php endif; ?>
            <?php if ($lumenti_idiomas) : ?>
                <div class="lm-profile__fact"><p class="lm-profile__panel-label">Idiomas</p><p class="lm-profile__fact-value"><?= esc_html(implode(' · ', $lumenti_idiomas)) ?></p></div>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</aside>
