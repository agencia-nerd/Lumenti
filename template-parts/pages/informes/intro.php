<?php
defined('ABSPATH') || exit;

/*
 * Informes y certificados · intro (specs/informes-y-certificados.md → intro). Grupo ACF: informes_y_certificados_intro.
 * Componente intro-split: párrafos del textarea (una línea en blanco = párrafo nuevo), el aviso de validez
 * (role="note") y el dúo de fotos.
 */

$lumenti_intro = get_field('informes_y_certificados_intro') ?: [];
$lumenti_titulo = (string) ($lumenti_intro['titulo'] ?? '');

get_template_part('template-parts/components/intro-split', null, [
    'titulo' => $lumenti_titulo,
    'id' => 'lm-respaldo',
    'texto' => (string) ($lumenti_intro['texto'] ?? ''),
    'aviso' => (string) ($lumenti_intro['aviso'] ?? ''),
    'imagenes' => [$lumenti_intro['imagen_principal'] ?? null, $lumenti_intro['imagen_secundaria'] ?? null],
    'alt_fallback' => wp_strip_all_tags(str_replace('*', '', $lumenti_titulo)),
]);
