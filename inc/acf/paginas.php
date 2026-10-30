<?php
defined('ABSPATH') || exit;

/*
 * Páginas de WordPress que crea inc/acf/runner.php. Lo genera wp-acf (generate.mjs) desde specs/_index.md:
 * no se edita a mano.
 */
return [
    'empresas' => ['titulo' => 'Empresas', 'slug' => 'empresas', 'frente' => false, 'plantilla' => 'pages/template-empresas.php', 'padre' => ''],
    'faq' => ['titulo' => 'Preguntas frecuentes', 'slug' => 'faq', 'frente' => false, 'plantilla' => 'pages/template-faq.php', 'padre' => ''],
    'home' => ['titulo' => 'Inicio', 'slug' => 'inicio', 'frente' => true, 'plantilla' => '', 'padre' => ''],
    'informes' => ['titulo' => 'Informes y certificados', 'slug' => 'informes', 'frente' => false, 'plantilla' => 'pages/template-informes.php', 'padre' => ''],
    'legal' => ['titulo' => 'Legal', 'slug' => 'legal', 'frente' => false, 'plantilla' => 'pages/template-legal.php', 'padre' => ''],
    'psicologia' => ['titulo' => 'Psicología', 'slug' => 'psicologia', 'frente' => false, 'plantilla' => 'pages/template-psicologia.php', 'padre' => ''],
    'psiquiatria' => ['titulo' => 'Psiquiatría', 'slug' => 'psiquiatria', 'frente' => false, 'plantilla' => 'pages/template-psiquiatria.php', 'padre' => ''],
];
