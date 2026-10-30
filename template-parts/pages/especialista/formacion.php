<?php
defined('ABSPATH') || exit;

/*
 * Especialista · formacion (specs/especialista.md → formacion). Grupo ACF: especialista_formacion.
 * "FORMACIÓN DESTACADA" (fijo) y carrusel horizontal (src/js/modules/especialista.js: data-lm-track,
 * data-lm-track-list, data-lm-track-prev/next). El número de cada tarjeta sale del índice (01, 02…).
 */

$lumenti_formacion = [
    'items' => [
        ['titulo' => 'Especialidad en Psiquiatría', 'institucion' => 'Universidad Nacional Mayor de San Marcos / Hospital Hermilio Valdizán'],
        ['titulo' => 'Medicina Humana', 'institucion' => 'Universidad Peruana de Ciencias Aplicadas, décimo superior'],
        ['titulo' => 'Psicoterapeuta DBT', 'institucion' => 'Corriente Dialéctica'],
        ['titulo' => 'Terapia de Pareja', 'institucion' => 'IFASIL'],
        ['titulo' => 'Psiquiatría Perinatal', 'institucion' => 'Instituto Europeo de Salud Mental Perinatal'],
        ['titulo' => 'Diplomado en Trastornos del Sueño y Vigilia', 'institucion' => 'Universidad Tecnológica'],
    ],
];

$lumenti_items = array_values(array_filter($lumenti_formacion['items'], static fn($i) => trim((string) ($i['titulo'] ?? '')) !== ''));
if (!$lumenti_items) {
    return;
}
$lumenti_icono = lumenti_theme_image('assets/icons/formacion.svg', ['class' => 'lm-profile__form-icon', 'alt' => '', 'width' => 29, 'height' => 31]);
?>
<section class="lm-profile__section" aria-labelledby="lm-form" data-lm-track>
    <div class="lm-profile__section-head">
        <h2 class="lm-profile__h2" id="lm-form">FORMACIÓN DESTACADA</h2>
        <div class="lm-profile__arrows">
            <button class="lm-profile__arrow" type="button" aria-label="Anterior" data-lm-track-prev disabled><svg aria-hidden="true" width="18" height="18" viewBox="0 0 256 256" fill="currentColor"><path d="M224,128a8,8,0,0,1-8,8H59.31l58.35,58.34a8,8,0,0,1-11.32,11.32l-72-72a8,8,0,0,1,0-11.32l72-72a8,8,0,0,1,11.32,11.32L59.31,120H216A8,8,0,0,1,224,128Z"/></svg></button>
            <button class="lm-profile__arrow" type="button" aria-label="Siguiente" data-lm-track-next><svg aria-hidden="true" width="18" height="18" viewBox="0 0 256 256" fill="currentColor"><path d="M221.66,133.66l-72,72a8,8,0,0,1-11.32-11.32L196.69,136H40a8,8,0,0,1,0-16H196.69L138.34,61.66a8,8,0,0,1,11.32-11.32l72,72A8,8,0,0,1,221.66,133.66Z"/></svg></button>
        </div>
    </div>
    <div class="lm-profile__track-wrap">
        <ul class="lm-profile__track" data-lm-track-list tabindex="0" aria-label="Formación destacada">
            <?php foreach ($lumenti_items as $lumenti_i => $lumenti_item) : ?>
                <li class="lm-profile__form-card"><span class="lm-profile__form-num" aria-hidden="true"><?= esc_html(sprintf('%02d', $lumenti_i + 1)) ?></span><?= $lumenti_icono ?><p class="lm-profile__form-title"><?= esc_html($lumenti_item['titulo']) ?></p><?php if (!empty($lumenti_item['institucion'])) : ?><p class="lm-profile__form-inst"><?= esc_html($lumenti_item['institucion']) ?></p><?php endif; ?></li>
            <?php endforeach; ?>
        </ul>
        <span class="lm-profile__track-fade" aria-hidden="true"></span>
    </div>
</section>
