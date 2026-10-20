---
paths:
  - "template-parts/sections/home/servicios.php"
  - "src/css/sections/home/servicios.css"
  - "src/js/sections/home/servicios.js"
  - "acf-json/group_lumenti_inicio_servicios.json"
  - "inc/crear-servicios.php"
---

# Home · Servicios

- Cada servicio es una **página** con su plantilla propia (`pages/template-psiquiatria|psicologia|informes|empresas.php`), no un post ni un CPT: cada una tiene secciones distintas. `inc/crear-servicios.php` las crea vacías (al activar el tema y una vez en el admin, guardado en la opción `lumenti_paginas_servicios`) y nunca pisa una existente.
- Campos: grupo "Inicio · Servicios": repetidor `servicios_items` (`pagina` post_object → ID, `titulo`, `descripcion`) y `servicios_cursor` (por defecto "Saber más"). La foto **no** se carga en la home: es la imagen destacada de cada página (la misma del mega menú), así se cambia en un solo lugar. Título vacío cae al de la página; sin imagen destacada, la tarjeta queda en `bg-primario-900`. Filas sin página publicada no salen.
- El orden lo da el repetidor y el ancho sale de la posición: 1.º y 2.º a todo el ancho, el resto de a dos desde `md`; un último que queda solo va a todo el ancho. La clienta no elige el ancho.
- `h2` "Servicios" en `sr-only`; cada tarjeta lleva `h3` y la foto es decorativa (`alt=""`).
- Táctil: descripción y flecha siempre visibles. Con mouse: la descripción se abre al pasar o enfocar (`grid-template-rows` 0fr → 1fr, sin alto máximo) y la foto se acerca. `servicios.js` marca `[data-cursor]` y mueve el círculo con `--cursor-x/y`; sin JS o con movimiento reducido no hay círculo y queda la flecha.
