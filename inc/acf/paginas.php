<?php
defined('ABSPATH') || exit;

/*
 * Páginas de WordPress que crea inc/acf/runner.php. Lo genera wp-acf (generate.mjs) desde specs/_index.md:
 * no se edita a mano.
 */
return [
    'empresas' => ['titulo' => 'Empresas', 'slug' => 'empresas', 'frente' => false, 'plantilla' => 'pages/template-empresas.php', 'padre' => ''],
    'home' => ['titulo' => 'Inicio', 'slug' => 'inicio', 'frente' => true, 'plantilla' => '', 'padre' => ''],
    'informes-y-certificados' => ['titulo' => 'Informes y certificados', 'slug' => 'informes-y-certificados', 'frente' => false, 'plantilla' => 'pages/template-informes.php', 'padre' => ''],
    'politica-de-privacidad' => ['titulo' => 'Política de privacidad', 'slug' => 'politica-de-privacidad', 'frente' => false, 'plantilla' => 'pages/template-legal.php', 'padre' => ''],
    'preguntas-frecuentes' => ['titulo' => 'Preguntas frecuentes', 'slug' => 'preguntas-frecuentes', 'frente' => false, 'plantilla' => 'pages/template-faq.php', 'padre' => ''],
    'psicologia' => ['titulo' => 'Psicología', 'slug' => 'psicologia', 'frente' => false, 'plantilla' => 'pages/template-psicologia.php', 'padre' => ''],
    'psiquiatria' => ['titulo' => 'Psiquiatría', 'slug' => 'psiquiatria', 'frente' => false, 'plantilla' => 'pages/template-psiquiatria.php', 'padre' => ''],
];
