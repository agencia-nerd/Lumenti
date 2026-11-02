<?php
defined('ABSPATH') || exit;

/*
 * Psicología · intro (specs/psicologia.md → intro). Grupo ACF: psicologia_intro.
 * Componente intro-split (título con *marcador* vía lumenti_highlight) con el dúo de fotos.
 */

$lumenti_intro = get_field('psicologia_intro') ?: [];
$lumenti_titulo = (string) ($lumenti_intro['titulo'] ?? '');

get_template_part('template-parts/components/intro-split', null, [
    'titulo' => $lumenti_titulo,
    'id' => 'lm-que-es',
    'texto' => (string) ($lumenti_intro['texto'] ?? ''),
    'texto_destacado' => (string) ($lumenti_intro['texto_destacado'] ?? ''),
    'imagenes' => [$lumenti_intro['imagen_principal'] ?? null, $lumenti_intro['imagen_secundaria'] ?? null],
    'alt_fallback' => wp_strip_all_tags(str_replace('*', '', $lumenti_titulo)),
]);
