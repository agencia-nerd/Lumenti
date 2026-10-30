<?php
defined('ABSPATH') || exit;

/*
 * Psicología · hero (specs/psicologia.md → hero). Grupo ACF: psicologia_hero.
 * Prepara los datos y llama al componente page-hero (variante service) con su breadcrumb.
 */

$lumenti_hero = [
    'titulo_destacado' => 'PSICOLOGÍA PARA',
    'titulo' => 'COMPRENDERTE Y AVANZAR.',
    'nota' => 'Atención psicológica para diferentes etapas de la vida.',
    'etiqueta' => 'NUESTRO ENFOQUE',
    'bajada' => 'Brindamos psicoterapia y evaluaciones psicológicas desde una mirada cercana, personalizada y basada en evidencia. Buscamos comprender tu historia, tu contexto y aquello que hoy está afectando tu bienestar, para brindarte herramientas que te ayuden a afrontar las dificultades, generar cambios y avanzar.',
    'variante' => 'service',
    'breadcrumb' => [
        ['texto' => 'Servicios'],
        ['texto' => 'Psicología'],
    ],
];

get_template_part('template-parts/components/page-hero', null, $lumenti_hero);
