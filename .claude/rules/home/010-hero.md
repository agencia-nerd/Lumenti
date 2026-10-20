---
paths:
  - "template-parts/sections/home/hero.php"
  - "src/css/sections/home/hero.css"
  - "src/js/sections/home/hero.js"
  - "acf-json/group_lumenti_inicio.json"
---

# Home · Hero

- Campos: grupo "Inicio · Hero" (`acf-json/group_lumenti_inicio.json`): repetidor `hero_diapositivas` (`pestana`, `titulo`, `texto`, `boton`, `imagen`) y `hero_sello_palabras`.
- Carrusel accesible: pestañas ARIA (`role="tab"`/`tabpanel`, flechas, Inicio, Fin), botón de pausa, pausa al pasar el mouse o con foco en el texto, sin avance con movimiento reducido. 6 s por diapositiva (`$lumenti_ms`). Numeración (pestaña y número grande) automática por orden.
- Título: cada línea del textarea es una línea; `*texto*` = verde con `lumenti_highlight()`. Las líneas pueden partirse (nunca `nowrap`).
- Botón vacío → "Agenda tu cita" a WhatsApp; con texto y sin enlace válido → WhatsApp con su texto; con enlace y sin texto → "Agenda tu cita".
- Altura en escritorio: `min-h` (no fija), para que el contenido largo no quede cortado.
- Sello: palabras separadas por comas en `textPath`; `hero.js` las reparte en el círculo y achica la letra si no entran.
- Fases de la animación por `data-fase` (`estatica`, `in`, `out`, `oculta`) en `hero.css`.
- Pausa: `[data-pausado]` congela la barra con `animation-play-state` en una regla **fuera de `@layer`** (la utilidad `animate-llenar` le ganaría dentro de `components`). Si la barra termina en pausa, `hero.js` marca `pendiente` y avanza al reanudar.
