<?php
defined('ABSPATH') || exit;

/*
 * Especialistas · vacio (specs/especialistas.md → vacio). Grupo ACF: especialistas_vacio.
 * Contenido: get_field('especialistas_vacio', 'option') (página de opciones Archivo de especialista):
 * solo el mensaje de WhatsApp; título, texto y botones son fijos.
 * Estado "sin resultados" (role="status"); va dentro de data-query="resultados" (lo incluye resultados.php).
 * "Limpiar filtros" es un enlace a la página sin parámetros (sin JS) y [data-lm-clear-filters] (con JS).
 *
 * $args: oculto (bool, por defecto true): hidden mientras haya cards.
 */

$lumenti_vacio = get_field('especialistas_vacio', 'option') ?: [];

$lumenti_oculto = $args['oculto'] ?? true;
$lumenti_wa = lumenti_link_attrs(
    ['url' => lumenti_whatsapp_url('citas', (string) ($lumenti_vacio['mensaje'] ?? '')), 'target' => '_blank'],
    ['class' => 'lm-btn lm-btn--soft lm-btn--md']
);
?>
<div class="lm-specialists__empty" role="status" data-lm-empty<?= $lumenti_oculto ? ' hidden' : '' ?>>
    <span class="lm-specialists__empty-icon" aria-hidden="true"><svg aria-hidden="true" width="26" height="26" viewBox="0 0 256 256" fill="currentColor"><path d="M230.92,212c-15.23-26.33-38.7-45.21-66.09-54.16a72,72,0,1,0-73.66,0C63.78,166.78,40.31,185.66,25.08,212a8,8,0,1,0,13.85,8c18.84-32.56,52.14-52,89.07-52s70.23,19.44,89.07,52a8,8,0,1,0,13.85-8ZM72,96a56,56,0,1,1,56,56A56.06,56.06,0,0,1,72,96Z"/></svg></span>
    <p class="lm-specialists__empty-title"><?= esc_html__('NO ENCONTRAMOS ESPECIALISTAS', 'lumenti') ?></p>
    <p class="lm-lead lm-specialists__empty-text"><?= esc_html__('Ningún especialista coincide con todos los filtros elegidos. Prueba quitando alguno o escríbenos y te ayudamos a encontrar al profesional adecuado.', 'lumenti') ?></p>
    <div class="lm-specialists__empty-actions">
        <a class="lm-btn lm-btn--primary lm-btn--md" href="<?= esc_url((string) get_post_type_archive_link('especialista')) ?>" data-lm-clear-filters><?= esc_html__('Limpiar filtros', 'lumenti') ?></a>
        <?php if ($lumenti_wa !== '') : ?>
            <a<?= $lumenti_wa ?>><?= esc_html__('Te ayudamos a elegir', 'lumenti') ?><span class="sr-only"> (<?= esc_html__('se abre en una pestaña nueva', 'lumenti') ?>)</span><span class="lm-btn__icon lm-icon--whatsapp" aria-hidden="true"></span></a>
        <?php endif; ?>
    </div>
</div>
