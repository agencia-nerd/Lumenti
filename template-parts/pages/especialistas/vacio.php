<?php
defined('ABSPATH') || exit;

/*
 * Especialistas · vacio (specs/especialistas.md → vacio). Grupo ACF: especialistas_vacio.
 * Estado "sin resultados" (role="status"); va dentro de data-query="resultados" (lo incluye resultados.php).
 * "Limpiar filtros" es un enlace a la página sin parámetros (sin JS) y [data-lm-clear-filters] (con JS).
 *
 * $args: oculto (bool, por defecto true): hidden mientras haya cards.
 */

$lumenti_vacio = [
    'titulo' => 'NO ENCONTRAMOS ESPECIALISTAS',
    'texto' => 'Ningún especialista coincide con todos los filtros elegidos. Prueba quitando alguno o escríbenos y te ayudamos a encontrar al profesional adecuado.',
    'boton' => 'Te ayudamos a elegir',
    'mensaje' => 'Hola, necesito ayuda para elegir un especialista.',
];

$lumenti_oculto = $args['oculto'] ?? true;
$lumenti_wa = lumenti_link_attrs(
    ['url' => lumenti_whatsapp_url('paciente', $lumenti_vacio['mensaje']), 'target' => '_blank'],
    ['class' => 'lm-btn lm-btn--soft lm-btn--md']
);
?>
<div class="lm-specialists__empty" role="status" data-lm-empty<?= $lumenti_oculto ? ' hidden' : '' ?>>
    <span class="lm-specialists__empty-icon" aria-hidden="true"><svg aria-hidden="true" width="26" height="26" viewBox="0 0 256 256" fill="currentColor"><path d="M230.92,212c-15.23-26.33-38.7-45.21-66.09-54.16a72,72,0,1,0-73.66,0C63.78,166.78,40.31,185.66,25.08,212a8,8,0,1,0,13.85,8c18.84-32.56,52.14-52,89.07-52s70.23,19.44,89.07,52a8,8,0,1,0,13.85-8ZM72,96a56,56,0,1,1,56,56A56.06,56.06,0,0,1,72,96Z"/></svg></span>
    <p class="lm-specialists__empty-title"><?= esc_html($lumenti_vacio['titulo']) ?></p>
    <p class="lm-lead lm-specialists__empty-text"><?= esc_html($lumenti_vacio['texto']) ?></p>
    <div class="lm-specialists__empty-actions">
        <a class="lm-btn lm-btn--primary lm-btn--md" href="<?= esc_url(home_url('/especialistas/')) ?>" data-lm-clear-filters>Limpiar filtros</a>
        <?php if ($lumenti_wa !== '' && $lumenti_vacio['boton'] !== '') : ?>
            <a<?= $lumenti_wa ?>><?= esc_html($lumenti_vacio['boton']) ?><span class="sr-only"> (<?= esc_html__('se abre en una pestaña nueva', 'lumenti') ?>)</span><span class="lm-btn__icon lm-icon--whatsapp" aria-hidden="true"></span></a>
        <?php endif; ?>
    </div>
</div>
