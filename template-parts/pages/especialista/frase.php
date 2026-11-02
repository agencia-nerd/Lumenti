<?php
defined('ABSPATH') || exit;

/*
 * Especialista · frase (specs/especialista.md → frase). Grupo ACF: especialista_frase.
 * <figure> verde con la frase, el nombre corto y el rol. Con foto: variante --photo (dos columnas);
 * sin foto, a todo el ancho. Sin frase no se imprime nada.
 */

$lumenti_frase = get_field('especialista_frase') ?: [];
$lumenti_texto = trim((string) ($lumenti_frase['texto'] ?? ''));
if ($lumenti_texto === '') {
    return;
}
$lumenti_nombre = trim((string) ((get_field('especialista_perfil') ?: [])['nombre_corto'] ?? ''));
$lumenti_rol = (string) ($lumenti_frase['rol'] ?? '');
$lumenti_foto = lumenti_image($lumenti_frase['foto'] ?? null, [
    'class' => 'lm-profile__quote-img',
    'size' => 'large',
    'alt_fallback' => $lumenti_nombre,
]);
?>
<figure class="lm-profile__quote<?= $lumenti_foto !== '' ? ' lm-profile__quote--photo' : '' ?>">
    <div class="lm-profile__quote-body">
        <span class="lm-profile__quote-mark" aria-hidden="true">“</span>
        <blockquote class="lm-profile__quote-text"><?= lumenti_highlight($lumenti_texto) ?></blockquote>
        <figcaption class="lm-profile__quote-caption"><?php if ($lumenti_nombre !== '') : ?><span class="lm-profile__quote-name">— <?= esc_html($lumenti_nombre) ?></span><?php endif; ?><?php if ($lumenti_rol !== '') : ?><span class="lm-profile__quote-role"><?= esc_html($lumenti_rol) ?></span><?php endif; ?></figcaption>
    </div>
    <?= $lumenti_foto ?>
</figure>
