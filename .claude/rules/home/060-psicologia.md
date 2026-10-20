---
paths:
  - "template-parts/sections/home/psicologia.php"
  - "src/css/sections/home/psicologia.css"
  - "src/js/sections/home/psicologia.js"
  - "acf-json/group_lumenti_inicio_psicologia.json"
---

# Home · Psicología para el día a día

- Campos: grupo "Inicio · Psicología para el día a día": `psico_antetitulo`, `psico_titulo` (Enter por línea), `psico_texto`, `psico_pagina` (una sola página para **todos** los temas; sin página publicada las filas no enlazan ni llevan flecha), repetidor `psico_temas` (`titulo`, `texto`, `imagen`), y la franja: `psico_banda_imagen`, `psico_banda_titulo` (`h3`), `psico_banda_texto`, `psico_banda_boton` (vacío → «Quiero mi evaluación» con WhatsApp).
- Temas sin título no salen. Sin ninguna foto de tema, no hay columna de imagen y el texto ocupa todo. Sin título ni texto de franja, no hay franja.
- Fotos: decorativas (`aria-hidden`), apiladas; `psicologia.js` pone `data-estado` (activo | previa) y `data-entra` al pasar o enfocar un tema (barrido de izquierda a derecha) y `data-zoom` en el marco (acercamiento lento, sin movimiento reducido). Un tema sin foto deja la anterior. Desde `lg` la imagen es `sticky`.
- Ícono de flecha fijo (`flecha`), no administrable. Celular: `ver-mas.js` con 5 y luego todos (`btn btn-inverso`).
- La franja ocupa todo el ancho (`-mx-gutter`) y cierra la sección (sin `pb` cuando existe).
