<?php
defined('ABSPATH') || exit;

/*
 * Psiquiatría · hero (specs/psiquiatria.md → hero). Grupo ACF: psiquiatria_hero.
 * Prepara los datos y llama al componente page-hero (variante service) con su breadcrumb.
 */

$lumenti_hero = [
    'titulo_destacado' => 'PSIQUIATRÍA QUE',
    'titulo' => 'COMPRENDE TU HISTORIA',
    'nota' => 'Atención presencial y virtual para diferentes etapas de la vida.',
    'etiqueta' => 'NUESTRO ENFOQUE',
    'bajada' => 'Brindamos una evaluación clínica integral para comprender no solo tus síntomas, sino también tu historia, tu contexto y cómo lo que estás viviendo impacta en tu día a día. A partir de ello, construimos contigo un plan de tratamiento personalizado y basado en evidencia.',
    'variante' => 'service',
    'breadcrumb' => [
        ['texto' => 'Servicios'],
        ['texto' => 'Psiquiatría'],
    ],
];

get_template_part('template-parts/components/page-hero', null, $lumenti_hero);
