<?php
defined('ABSPATH') || exit;

/*
 * Empresas → por-que (specs/empresas.md). Grupo ACF: Empresas → empresas_por_que.
 * Componente intro-split invertido con el dúo de fotos ancho (lm-emp-why).
 */

$lumenti_por_que = get_field('empresas_por_que') ?: [];
$lumenti_titulo = (string) ($lumenti_por_que['titulo'] ?? '');
$lumenti_texto = (string) ($lumenti_por_que['texto'] ?? '');

get_template_part('template-parts/components/intro-split', null, [
    'titulo' => $lumenti_titulo,
    'id' => 'lm-emp-why',
    'texto' => $lumenti_texto !== '' ? [$lumenti_texto] : [],
    'texto_destacado' => (string) ($lumenti_por_que['texto_destacado'] ?? ''),
    'imagenes' => [$lumenti_por_que['imagen_fondo'] ?? null, $lumenti_por_que['imagen_frente'] ?? null],
    'alt_fallback' => wp_strip_all_tags(str_replace('*', '', $lumenti_titulo)),
    'invertido' => true,
    'ancho' => true,
    'clase' => 'lm-emp-why',
]);
?>
