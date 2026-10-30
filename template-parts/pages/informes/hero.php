<?php
defined('ABSPATH') || exit;

/*
 * Informes y certificados · hero (specs/informes.md → hero). Grupo ACF: informes_hero.
 * Prepara los datos y llama al componente page-hero (variante service) con su breadcrumb.
 */

$lumenti_hero = [
    'titulo_destacado' => 'INFORMES Y',
    'titulo' => 'CERTIFICADOS CLÍNICOS',
    'nota' => 'Atención presencial y virtual para cada etapa de la vida.',
    'etiqueta' => 'SOBRE EL SERVICIO',
    'bajada' => 'Elaboramos informes y certificados clínicos respaldados por una evaluación profesional. Cada documento se emite de acuerdo con su finalidad, el criterio del especialista y la información clínica disponible.',
    'variante' => 'service',
    'breadcrumb' => [
        ['texto' => 'Servicios'],
        ['texto' => 'Informes y certificados'],
    ],
];

get_template_part('template-parts/components/page-hero', null, $lumenti_hero);
