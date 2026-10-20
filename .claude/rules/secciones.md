---
paths:
  - "front-page.php"
  - "pages/**"
  - "template-parts/**"
---

# Páginas y secciones

- La portada es `front-page.php`: WordPress la usa sola para la página "Inicio" (fijada en Ajustes → Lectura). No tiene `Template Name` ni se elige en el admin. El tema crea "Inicio" al activarse (`inc/crear-inicio.php`).
- Cada otra página con diseño propio es `pages/template-<nombre>.php`, con `Template Name:` en la cabecera.
- Cada plantilla llama una sola vez a `get_header()` y a `get_footer()`, y pone el contenido dentro de `<main id="main-content">`.
- La plantilla solo llama a sus secciones. Las secciones van por página: `template-parts/sections/<página>/<sección>.php` (ej. `sections/home/hero.php`). Una sección compartida entre páginas (componente) va en `template-parts/sections/components/` (ej. `components/cta.php`), con su CSS/JS en `src/css|js/sections/components/`; un solo grupo ACF con una regla de ubicación por página, y cada página guarda su propio contenido.
- Estilos y JS propios de una sección siguen la misma ruta: `src/css/sections/<página>/<sección>.css` (importado en `input.css`) y `src/js/sections/<página>/<sección>.js` (importado en `main.js`).
- Cada sección lee sus campos de su grupo ACF "<Página> · <Sección>" y no imprime nada si no tiene contenido.
- Reglas de Claude con la misma estructura: `.claude/rules/<página>/000-<página>.md` (general, `paths` a la plantilla) y `.claude/rules/<página>/<NNN>-<sección>.md` con `NNN` en el orden de la página, en saltos de 10 (`paths` a la vista, CSS, JS y JSON de esa sección). Un componente compartido va suelto en `.claude/rules/` (ej. `cta.md`).
- Páginas de servicio (Psiquiatría, Psicología, Informes y certificados, Empresas): `pages/template-<slug>.php`, sus secciones en `template-parts/sections/<slug>/` y sus grupos "<Página> · <Sección>". Las crea `inc/crear-servicios.php`.
