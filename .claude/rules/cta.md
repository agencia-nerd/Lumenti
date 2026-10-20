---
paths:
  - "template-parts/sections/components/cta.php"
  - "src/css/sections/components/cta.css"
  - "src/js/sections/components/cta.js"
  - "acf-json/group_lumenti_cta.json"
---

# Componente · CTA final

- Va al final de la página (antes del footer): `get_template_part('template-parts/sections/components/cta')`; `$args['post_id']` opcional. Hoy: portada, Psiquiatría, Psicología, Informes y Empresas.
- Campos: grupo único "CTA final" (`group_lumenti_cta`) con una regla de ubicación por página (portada, cada `page_template` y el tipo `condicion`); cada página guarda sus `cta_titulo`, `cta_texto`, `cta_boton` (vacío → «Escríbenos por WhatsApp»), `cta_fondo` (campo archivo: foto o video, según el tipo del archivo). Para sumarlo a otra página: agrega la regla al grupo y la llamada a la plantilla.
- Sin título no se imprime. Ícono `cerebro` fijo; el botón lleva ícono de WhatsApp si el enlace es `wa.me`, si no la flecha.
- Fondo: `cta_fondo` es imagen → `lumenti_image()`; video → `<video muted loop playsinline>` que corre solo a la vista y nunca con movimiento reducido (sin JS queda el fondo oscuro `#2b2722`). Otro tipo de archivo se ignora.
- Arco: `cta.js` pone `--cta-r` y `data-arco`/`data-plano` en la caja; el arco se aplana al subir la sección. Sin JS o con movimiento reducido, recta. El fondo de la sección es mitad `fondo` / mitad `primario-700` para empalmar con el footer.
- Pendiente: la variante del blog con formulario de suscripción (`Blog.dc.html`, skill wp-form).
