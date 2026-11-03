<?php
defined('ABSPATH') || exit;

/*
 * Condición · nota (specs/condicion.md → nota). Grupo ACF: condicion_nota.
 * Nota dorada opcional al final de la sección de señales (la incluye senales.php). Solo si tiene texto;
 * el título es opcional.
 */

$lumenti_nota = get_field('condicion_nota') ?: [];
$lumenti_titulo = trim((string) ($lumenti_nota['titulo'] ?? ''));
$lumenti_texto = trim((string) ($lumenti_nota['texto'] ?? ''));

if ($lumenti_texto === '') {
    return;
}
?>
<aside class="lm-cond-note" aria-label="<?= esc_attr__('Nota', 'lumenti') ?>"><svg class="lm-cond-note__icon" aria-hidden="true" width="24" height="24" viewBox="0 0 256 256" fill="currentColor"><path d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm0,192a88,88,0,1,1,88-88A88.1,88.1,0,0,1,128,216Zm16-40a8,8,0,0,1-8,8,16,16,0,0,1-16-16V128a8,8,0,0,1,0-16,16,16,0,0,1,16,16v40A8,8,0,0,1,144,176ZM112,84a12,12,0,1,1,12,12A12,12,0,0,1,112,84Z"/></svg><div><?php if ($lumenti_titulo !== '') : ?><p class="lm-cond-note__title"><?= esc_html($lumenti_titulo) ?></p><?php endif; ?><p class="lm-cond-note__text"><?= lumenti_highlight($lumenti_texto) ?></p></div></aside>
