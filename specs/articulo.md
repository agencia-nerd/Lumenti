# Página: Artículo

- **Resumen:** Lectura completa de un artículo del blog. El visitante lee, ve artículos relacionados y, si necesita ayuda, escribe por WhatsApp.
- **Fuente:** `html/blog-articulo.html`
- **Plantilla:** `single.php`
- **Tipo:** detalle
- **Contenido:** post
- **Secciones (en orden):** cabecera, contenido, relacionados, cta
- **Skills usadas:** wp-helper
- **Grupo ACF:** Artículo
- **Ubicación:** tipo de contenido = post
- **Padre:** ninguno
- **Notas de página:**
  - Título, contenido, extracto, fecha, autor, imagen destacada, categorías y etiquetas son de WordPress; los campos propios son la bajada y las referencias. El tiempo de lectura no es campo: lo calcula `lumenti_reading_time()` (`inc/helpers/lectura.php`) con las palabras del contenido a 220 por minuto, redondeando hacia arriba (decisión del 2026-11-03; con 220 coinciden 14 de los 15 artículos del diseño).
  - `h1`: el título de la entrada. Título SEO: "<título> — Lumenti". Sin meta descripción en el diseño (puede salir de la bajada).
  - El diseño no muestra autor ni fecha (pendiente del cliente, ver README).
  - El diseño es un solo ejemplo ("¿Cómo se diagnostica el TDAH?"); el tema imprime la entrada real. Los 15 artículos del diseño son el contenido inicial (`inc/acf/seed/articulo.php`).
  - URL: `/blog/<slug>/` (ver `blog.md`).
  - `<body class="lm-page lm-page--articulo">`; CSS: `css/blog.css` → `src/css/pages/blog.css` (compartido con el listado). Sin JS propio.
  - En el diseño el CTA queda fuera de `<main>`; en el tema va dentro de `<main id="main-content">`.
- **Estado:** aplicado

## Sección: cabecera

- **Origen:** `html/blog-articulo.html` líneas 152-169
- **Destino:** `template-parts/pages/articulo/cabecera.php`
- **Grupo:** `articulo_cabecera`
- **Skill:** wp-helper
- **Comportamiento:** abre el `<article class="lm-article">` (lo cierra la sección contenido). Breadcrumb Inicio / Blog / título (componente `breadcrumb`, el blog apunta a la página de entradas). Etiqueta = primera categoría en mayúsculas; `h1` = título; bajada (si el campo está vacío, usa el extracto); "N min de lectura" con su ícono; imagen destacada a 960:400 (4:3 en móvil) con `loading="eager"` y `fetchpriority="high"`, `alt` del adjunto. Si la entrada no tiene imagen destacada, el `figure` no se imprime. Color suelto: fondo de la imagen `#e9e6df`.
- **Estado:** aplicado
- **ACF:** conectado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `articulo_cabecera_bajada` | textarea | Resumen bajo el título; también se usa en las cards del blog. | Una de las dudas más frecuentes sobre el trastorno por déficit de atención e hiperactividad (TDAH) es si existe algún examen que permita confirmarlo de manera objetiva. | no |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] El título de la entrada es el único `h1`
- [x] La imagen destacada carga con `loading="eager"` y sin mover el layout
- [x] La bajada se oculta si está vacía (cae al extracto) y el tiempo de lectura sale del contenido

## Sección: contenido

- **Origen:** `html/blog-articulo.html` líneas 170-221
- **Destino:** `template-parts/pages/articulo/contenido.php`
- **Grupo:** `articulo_contenido`
- **Skill:** ninguna
- **Comportamiento:** `the_content()` dentro de `.lm-article__body`. El contenido del editor no trae las clases del diseño (`lm-article__p`, `__h2`, `__list`, `__li`): el CSS se escribe por descendiente (`.lm-article__body p`, `h2`, `ul`, `li`) para que párrafos, títulos y listas se vean igual. Después del contenido, las referencias del campo (si hay) bajo "REFERENCIAS", en letra chica y gris, una por línea (decisión del 2026-11-03: antes eran un párrafo más del contenido y no se distinguían). Al final, las etiquetas (`post_tag`) bajo "ETIQUETAS" como texto plano; el bloque se oculta si la entrada no tiene etiquetas. Cierra el `<article>`.
- **Estado:** aplicado
- **ACF:** conectado
- **Query:** conectado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `articulo_contenido_referencias` | textarea | Fuentes o estudios citados en el artículo, uno por línea. Se muestran al final en letra chica. | — | no |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Un artículo escrito en el editor (párrafos, `h2`, listas) se ve igual que el diseño
- [x] Los títulos del contenido empiezan en `h2`
- [x] Sin etiquetas, el bloque "ETIQUETAS" no se imprime

## Sección: relacionados

- **Origen:** `html/blog-articulo.html` líneas 222-265
- **Destino:** `template-parts/pages/articulo/relacionados.php`, `template-parts/components/blog-card.php`
- **Grupo:** ninguno
- **Skill:** ninguna
- **Comportamiento:** título "ARTÍCULOS RELACIONADOS" (`h2`) y botón secundario "Ver todos los artículos" a la página de entradas; grilla de 3 cards del componente `blog-card` (`variante: listing`). 3 entradas de la misma categoría (`lumenti_query_related`), completando con las más recientes si faltan, sin repetir la actual (`lumenti_blog_relacionados`, `inc/blog.php`). Sin entradas, la sección no se imprime. Textos fijos de la plantilla (iguales en todas las entradas). Colores sueltos del botón: `#dfd9cd` y su fondo.
- **Estado:** aplicado
- **Query:** conectado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Las 3 cards son el componente `blog-card` con `$args`, con título `h3`
- [x] "Ver todos los artículos" apunta a la página de entradas del tema

## Sección: cta

- **Origen:** `html/blog-articulo.html` líneas 267-279
- **Destino:** `single.php`, `template-parts/components/cta.php`
- **Grupo:** ninguno
- **Skill:** wp-helper
- **Comportamiento:** componente `cta` con título "COMPRENDER LO QUE TE OCURRE PUEDE SER EL PRIMER PASO", texto "Encuentra información clara y responsable sobre salud mental. Y si necesitas acompañamiento, te ayudamos a encontrar al especialista adecuado." y botón "Escríbenos por WhatsApp" a `https://wa.me/<opciones_contacto_telefono_paciente>?text=Hola, leí un artículo del blog y quisiera orientación.` (mensaje codificado en la URL), en pestaña nueva con el helper de enlaces. Textos fijos de la plantilla, iguales en todos los artículos.
- **Estado:** aplicado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] El número de WhatsApp sale de `opciones_contacto_telefono_paciente`, no está escrito en la plantilla
- [x] El CTA queda dentro de `<main id="main-content">`
