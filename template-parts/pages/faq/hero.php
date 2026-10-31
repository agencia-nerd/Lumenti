<?php
defined('ABSPATH') || exit;

/*
 * Preguntas frecuentes · hero (specs/faq.md → hero, grupo ACF faq_hero). Solo pasa sus $args a
 * template-parts/components/page-hero.php (variante service) y al breadcrumb. Datos fijos hasta el paso ACF.
 */

$lumenti_hero = [
    'titulo' => "*PREGUNTAS*\nFRECUENTES.",
    'nota' => 'Atención presencial y virtual para cada etapa de la vida.',
    'etiqueta' => 'AYUDA',
    'bajada' => 'Resolvemos las dudas más comunes sobre nuestros servicios, el proceso de atención y cómo empezar. Si no encuentras lo que buscas, escríbenos.',
];

get_template_part('template-parts/components/page-hero', null, [
    'titulo' => $lumenti_hero['titulo'],
    'nota' => $lumenti_hero['nota'],
    'etiqueta' => $lumenti_hero['etiqueta'],
    'bajada' => $lumenti_hero['bajada'],
    'breadcrumb' => [['texto' => get_the_title() ?: __('Preguntas frecuentes', 'lumenti')]],
    'variante' => 'service',
]);
