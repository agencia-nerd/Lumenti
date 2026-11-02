<?php
defined('ABSPATH') || exit;

/*
 * Especialista · actualizacion (specs/especialista.md → actualizacion). Igual en todos los perfiles: sus campos
 * están en la página de opciones "Archivo de especialista" (specs/especialistas.md → actualizacion).
 * Contenido: get_field('especialistas_actualizacion', 'option'). Banner dorado con imagen decorativa (alt="").
 * Sin título, el banner no se muestra.
 */

$lumenti_actualizacion = get_field('especialistas_actualizacion', 'option') ?: [];
$lumenti_titulo = (string) ($lumenti_actualizacion['titulo'] ?? '');
$lumenti_texto = (string) ($lumenti_actualizacion['texto'] ?? '');
if ($lumenti_titulo === '') {
    return;
}
?>
<div class="lm-profile__banner">
    <?= lumenti_image($lumenti_actualizacion['imagen'] ?? null, ['class' => 'lm-profile__banner-img', 'alt' => '', 'size' => 'large']) ?>
    <div class="lm-profile__banner-body">
        <h2 class="lm-profile__h2 lm-profile__banner-title"><?= esc_html($lumenti_titulo) ?></h2>
        <?php if ($lumenti_texto !== '') : ?>
            <p class="lm-profile__banner-text"><?= lumenti_highlight($lumenti_texto) ?></p>
        <?php endif; ?>
    </div>
</div>
