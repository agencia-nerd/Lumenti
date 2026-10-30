<?php
defined('ABSPATH') || exit;

/*
 * Especialista · frase (specs/especialista.md → frase). Grupo ACF: especialista_frase.
 * <figure> verde con la frase, el nombre corto y el rol. Con foto: variante --photo (dos columnas);
 * sin foto, a todo el ancho. Sin frase no se imprime nada.
 */

$lumenti_frase = [
    'nombre_corto' => 'Dra. Mariela Linares',
    'texto' => 'Creo en una psiquiatría que escucha la historia de cada persona con profundidad y respeto. Acompañar no es solo tratar síntomas, sino ayudar a comprender, aceptar y construir una vida con mayor bienestar, sentido y humanidad.',
    'rol' => 'Médica Psiquiatra · Directora Médica',
    'foto' => ['ruta' => 'assets/img/esp/mariela-linares-escribiendo.webp', 'ancho' => 1080, 'alto' => 980, 'alt' => 'Dra. Mariela Linares escribiendo'],
];

if (trim($lumenti_frase['texto']) === '') {
    return;
}
$lumenti_foto = lumenti_theme_image($lumenti_frase['foto'], ['class' => 'lm-profile__quote-img', 'size' => 'large']);
?>
<figure class="lm-profile__quote<?= $lumenti_foto !== '' ? ' lm-profile__quote--photo' : '' ?>">
    <div class="lm-profile__quote-body">
        <span class="lm-profile__quote-mark" aria-hidden="true">“</span>
        <blockquote class="lm-profile__quote-text"><?= esc_html($lumenti_frase['texto']) ?></blockquote>
        <figcaption class="lm-profile__quote-caption"><span class="lm-profile__quote-name">— <?= esc_html($lumenti_frase['nombre_corto']) ?></span><?php if ($lumenti_frase['rol'] !== '') : ?><span class="lm-profile__quote-role"><?= esc_html($lumenti_frase['rol']) ?></span><?php endif; ?></figcaption>
    </div>
    <?= $lumenti_foto ?>
</figure>
