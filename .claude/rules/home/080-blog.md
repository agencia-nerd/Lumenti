---
paths:
  - "template-parts/sections/home/blog.php"
  - "src/css/sections/home/blog.css"
  - "acf-json/group_lumenti_inicio_blog.json"
---

# Home · Blog

- El blog usa **entradas nativas** (sin CPT): categorías (Salud mental, Neurodivergencias, Tratamientos y evaluaciones, Bienestar, relaciones y trabajo), etiquetas, imagen destacada, extracto y contenido en bloques. Página de entradas: "Blog" (`/blog/`, Ajustes → Lectura). Los 15 artículos del prototipo se importaron una vez (las referencias son párrafos con clase `referencia`).
- Campos: grupo "Inicio · Blog": `blog_titulo`, `blog_texto`, `blog_boton` (vacío → «Explora nuestro blog» a la página de entradas), `blog_articulos` (relationship, orden arrastrando; vacío = los 4 más recientes). Sin artículos, no hay sección.
- Tarjeta: imagen destacada (decorativa, fondo `fondo-alt` si falta), primera categoría que no sea la por defecto, título en `line-clamp-2` y "Leer más". Al pasar/enfocar, la foto se acerca y la flecha avanza.
- Pendiente: plantillas del listado del blog (`Blog.dc.html`) y del artículo (`BlogArticulo.dc.html`).
