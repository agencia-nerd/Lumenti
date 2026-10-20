---
paths:
  - "template-parts/sections/home/sobre.php"
  - "src/css/sections/home/sobre.css"
  - "src/js/sections/home/sobre.js"
  - "acf-json/group_lumenti_inicio_sobre.json"
---

# Home · Sobre Lumenti

- Campos: grupo "Inicio · Sobre Lumenti" (`acf-json/group_lumenti_inicio_sobre.json`): `sobre_antetitulo` (la `h2`, con `eyebrow` en mayúsculas), `sobre_texto` (frase `text-statement` con `lumenti_highlight`), `sobre_foto_1` / `sobre_foto_2` (izquierda / derecha) y `sobre_logo` (si queda vacío, usa `footer_logo` de Ajustes).
- Sin antetítulo, texto ni fotos, no se imprime la sección. Una foto vacía simplemente no sale.
- Abanico: `sobre.js` pone `--abanico` (0 → 1) en `[data-sobre-abanico]` según el scroll; `sobre.css` mueve y gira cada `[data-sobre-foto]` con esa variable. Sin JS o con movimiento reducido quedan abiertas. La sección lleva `overflow-x-clip` para que las fotos no generen scroll lateral.
