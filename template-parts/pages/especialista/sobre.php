<?php
defined('ABSPATH') || exit;

/*
 * Especialista · sobre (specs/especialista.md → sobre). Grupo ACF: especialista_sobre.
 * "SOBRE MÍ" (fijo) y la biografía (wysiwyg) con wp_kses_post; cada párrafo lleva el estilo lm-lead.
 */

$lumenti_sobre = get_field('especialista_sobre') ?: [];
$lumenti_bio = trim((string) ($lumenti_sobre['biografia'] ?? ''));
if ($lumenti_bio === '') {
    return;
}
// El editor guarda <p> sin clase: se les agrega lm-lead (el estilo del diseño).
$lumenti_bio = (string) preg_replace('/<p(?=[\s>])(?![^>]*class=)/i', '<p class="lm-lead"', wpautop($lumenti_bio));
?>
<section class="lm-profile__section" aria-labelledby="lm-sobre">
    <h2 class="lm-profile__h2" id="lm-sobre"><?= esc_html__('SOBRE MÍ', 'lumenti') ?></h2>
    <div class="lm-profile__bio"><?= wp_kses_post($lumenti_bio) ?></div>
</section>
