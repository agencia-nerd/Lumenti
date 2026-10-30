<?php
defined('ABSPATH') || exit;

/*
 * Empresas → por-que (specs/empresas.md). Grupo ACF: Empresas → empresas_por_que.
 * Componente intro-split invertido con el dúo de fotos ancho (lm-emp-why).
 */

$lumenti_por_que = [
    'titulo' => '¿POR QUÉ TRABAJAR CON LUMENTI?',
    'texto' => 'Contamos con un equipo de psiquiatras y psicólogos con experiencia clínica y formación en diferentes áreas de la salud mental. Diseñamos intervenciones basadas en evidencia y adaptadas al contexto, los objetivos y las características de cada organización.',
    'texto_destacado' => 'Nuestro enfoque combina prevención, formación y acceso a atención especializada, permitiendo desarrollar soluciones que van desde un taller puntual hasta un programa más amplio de bienestar.',
    'imagen_fondo' => ['ruta' => 'assets/img/emp-manos.webp', 'ancho' => 639, 'alto' => 832, 'alt' => 'Equipo de trabajo uniendo sus manos al centro'],
    'imagen_frente' => ['ruta' => 'assets/img/emp-medico.webp', 'ancho' => 569, 'alto' => 749, 'alt' => 'Especialista de Lumenti sentado en su consultorio'],
];

get_template_part('template-parts/components/intro-split', null, [
    'titulo' => $lumenti_por_que['titulo'],
    'id' => 'lm-emp-why',
    'texto' => [$lumenti_por_que['texto']],
    'texto_destacado' => $lumenti_por_que['texto_destacado'],
    'imagenes' => [$lumenti_por_que['imagen_fondo'], $lumenti_por_que['imagen_frente']],
    'invertido' => true,
    'ancho' => true,
    'clase' => 'lm-emp-why',
]);
?>
