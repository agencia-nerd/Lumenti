---
paths:
  - "front-page.php"
  - "template-parts/sections/home/**"
---

# Portada (home): general

- Orden de secciones en `front-page.php`: `hero` (grupo "Inicio · Hero", `menu_order` 0) → `metricas` ("Inicio · Métricas", 1) → `sobre` ("Inicio · Sobre Lumenti", 2) → `servicios` ("Inicio · Servicios", 3) → `ayuda` ("Inicio · Cómo podemos ayudarte", 4) → `psicologia` ("Inicio · Psicología para el día a día", 5) → `testimonios` ("Inicio · Testimonios", 6) → `blog` ("Inicio · Blog", 7) → componente CTA final (`sections/components/cta`, grupo compartido "CTA final"). Una sección nueva suma su archivo en `template-parts/sections/home/`, su grupo con el siguiente `menu_order` y su regla en `.claude/rules/home/<NNN>-<sección>.md`, donde `NNN` sigue el orden de la portada en saltos de 10 (`010-hero.md`, `020-metricas.md`…; si una sección entra entre dos, usa un número intermedio, ej. `035-`). Si cambia el orden de las secciones, renombra también las reglas. El prefijo es solo para ordenar: lo que carga cada regla es su `paths:`.
- Referencia de diseño: prototipo en `C:\Users\Usuario\Desktop\deploy\index.html` (cada sección es un `<section data-screen-label="…">`). No uses `assets/img` ni `assets/video` del prototipo salvo que se pida.
- La única `h1` de la página es el título de la 1.ª diapositiva del hero; el resto de secciones usa `h2`.
