---
paths:
  - "src/js/**"
  - "template-parts/**"
---

# Animaciones reutilizables (JS)

- `src/js/main.js` solo importa e inicia módulos. Uno por responsabilidad: `header.js`, `reveal.js`, `contador.js`, y los de cada sección en `src/js/sections/<página>/`.
- `data-reveal` en un bloque: entra subiendo y descubriéndose al hacer scroll (`data-reveal="img"`: solo se descubre). Los que aparecen juntos se escalonan solos. Lo que ya se ve al cargar no se anima; sin JS o con movimiento reducido, todo queda visible (`src/js/reveal.js`).
- `data-contador` en un número: cuenta desde 0 al aparecer, conservando prefijo, sufijo y separador de miles (`+3,000`). Decimales o textos como `24/7` quedan fijos. Pon `aria-hidden` en el que anima y el valor final en un `sr-only` (`src/js/contador.js`).
- `data-ver-mas` en una lista: en celular muestra `data-inicial` ítems (`data-ver-mas-item`) y el botón `data-ver-mas-boton` suma `data-paso` (0 = todos); con todos, "Ver menos" vuelve y sube. Sin JS se ven todos (`src/js/ver-mas.js`, estilos en `components.css`).
- Estados con atributos `data-*` (ej. `data-open`, `data-fase`, `data-pausado`), estilados en CSS; nada de estilos inline desde JS salvo variables CSS.
- Todo lo que se mueve solo respeta `prefers-reduced-motion`.
