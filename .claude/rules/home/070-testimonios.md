---
paths:
  - "template-parts/sections/home/testimonios.php"
  - "src/css/sections/home/testimonios.css"
  - "src/js/sections/home/testimonios.js"
  - "acf-json/group_lumenti_inicio_testimonios.json"
---

# Home · Testimonios

- Repetidor en la home, **no CPT**: solo se muestran aquí, sin página propia ni filtros, y el orden es el de las filas. Si se reutilizan en otras páginas, el repetidor pasa a "Ajustes del sitio".
- Campos: grupo "Inicio · Testimonios": `testimonios_titulo` (Enter por línea), `testimonios_texto`, repetidor `testimonios_items` (`texto`, `nombre`, `fuente`, `estrellas` 1–5, por defecto 5). Las comillas las pone la vista (se quitan las pegadas). Sin texto, el testimonio no sale; sin testimonios, no hay sección.
- Estrellas: `lumenti_icon('estrella')` en `text-dorado`, con `role="img"` y "N de 5 estrellas".
- Carrusel (`testimonios.js`): mazo con la actual al centro y hasta 2 vecinas por lado; el resto fuera de pantalla y, al cambiar de lado, cruza sin animar solo después de 820 ms. Posición con `--tx/--ty/--rot`, color con `data-pos`, capa y sombra con `data-dist`; medidas en `--card-w/--card-h/--escena-h` (alto = tarjeta con más texto). Las tarjetas no actuales llevan `inert` + `aria-hidden`.
- Controles: flechas (`btn btn-primario` redondo), puntos con `aria-current`, arrastre > 40 px y ← → del teclado. Con 1 testimonio no hay controles. Sin JS, las tarjetas se ven en lista.
