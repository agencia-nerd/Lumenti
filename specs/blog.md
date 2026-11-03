# Página: Blog

- **Resumen:** Listado de artículos sobre salud mental escritos por el equipo. El visitante filtra por tema, busca, abre un artículo y puede suscribirse al newsletter.
- **Fuente:** `html/blog.html`
- **Plantilla:** `home.php`
- **Tipo:** listado
- **Contenido:** post
- **Secciones (en orden):** encabezado, filtros, destacado, resultados, paginacion, cta
- **Skills usadas:** wp-form (newsletter del cta), wp-helper
- **Grupo ACF:** Blog
- **Ubicación:** página de opciones: archivo de post
- **Padre:** ninguno
- **Notas de página:**
  - `home.php` es la página de entradas (Ajustes → Lectura → "Página de entradas": Blog).
  - `category.php` reutiliza las mismas secciones: el título del encabezado pasa a ser el nombre de la categoría y su pill queda activa. No lleva spec propio.
  - `h1`: "RECURSOS Y CONTENIDO EDUCATIVO" (en el encabezado). Título SEO del diseño: "Blog — Lumenti". Sin meta descripción en el diseño.
  - `<body class="lm-page lm-page--blog">`; CSS de la página: `css/blog.css` → `src/css/pages/blog.css`; JS: `js/blog-filter.js` → `src/js/modules/blog-filter.js` (filtros) y `newsletter` (lo reemplaza wp-form).
  - En el diseño el CTA queda fuera de `<main>`; en el tema va dentro de `<main id="main-content">`.
  - En el diseño las 15 entradas están en el HTML y el JS filtra y pagina en el navegador. En el tema es la consulta principal (wp-query, `inc/query/post.php`): filtra, busca y pagina en el servidor y `src/js/modules/query.js` cambia las zonas sin recargar. Los 15 artículos del diseño son el contenido inicial (`inc/acf/seed/articulo.php`).
  - URLs (decisión del 2026-11-03): artículos en `/blog/<slug>/` y categorías en `/blog/categoria/<tema>/` (enlaces permanentes `/blog/%postname%/`, base de categoría `categoria`; los pone `inc/blog.php` una vez al cargar el contenido). El blog sigue en `/blog/` y sus páginas en `/blog/page/2/`.
  - Imagen destacada de cada entrada (nativa): se recorta a 16:10 en las cards, 4:3 en el destacado y 960:400 en el artículo.
- **Al filtrar:** sin recargar
- **Paginación:** números
- **Por página:** 6
- **Filtros en móvil:** igual
- **Estado:** aplicado

**Filtros**

| Filtro | Tipo | Fuente | Varios | Conteo | Vista |
|---|---|---|---|---|---|
| `categoria` | taxonomía | `category` | no | ninguno | pills |
| `q` | búsqueda | título, extracto y etiquetas | — | — | campo |

## Sección: encabezado

- **Origen:** `html/blog.html` líneas 151-163
- **Destino:** `template-parts/pages/blog/encabezado.php`
- **Grupo:** `blog_encabezado`
- **Skill:** wp-helper
- **Comportamiento:** breadcrumb Inicio / Blog con el componente `breadcrumb`. La etiqueta "BLOG" sobre el título es fija (decisión del 2026-11-03). El título se anima por líneas (`.lm-blog__title-mask`); la segunda línea ("EDUCATIVO") va en color de acento: se marca con el helper de texto resaltado de wp-helper. En `category.php` el título es el nombre de la categoría y la bajada su descripción (si existe).
- **Estado:** aplicado
- **ACF:** conectado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `blog_encabezado_titulo` | textarea | Título del blog, una línea por renglón (Enter). La línea entre *asteriscos* se muestra en color. | RECURSOS Y CONTENIDO<br>*EDUCATIVO* | sí |
| `blog_encabezado_bajada` | textarea | Texto bajo el título. | Artículos, guías y recursos sobre salud mental escritos por nuestro equipo de especialistas. Contenido basado en evidencia, claro y accesible para todos. | no |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] El `h1` es el título del blog (o el nombre de la categoría en `category.php`)
- [x] La bajada se oculta si el campo está vacío

## Sección: filtros

- **Origen:** `html/blog.html` líneas 165-178
- **Destino:** `template-parts/pages/blog/filtros.php`, `template-parts/components/filtros.php`
- **Grupo:** ninguno
- **Skill:** ninguna
- **Comportamiento:** un `<form method="get" data-query="filtros">` con las pills de categoría (enlaces `?categoria=<slug>` con `aria-current="true"` en la activa, una sola a la vez, "Todos" = sin valor; la elegida va también en un campo oculto para que buscar no la pierda; en una categoría las otras pills llevan al blog filtrado, recargando) y el buscador (`<input type="search" name="q">` con su `<label>` oculto "Buscar artículos"). En el diseño, al tocar una pill o escribir (espera 180 ms) la lista cambia sin recargar, vuelve a la página 1 y el destacado se oculta; la pill activa lleva `aria-current="true"` (son enlaces: query.js no lee el valor de un botón submit). El diseño leía `?cat=`; en el tema el parámetro es `?categoria=`. Textos fijos de la plantilla (decisión del 2026-11-03): "Filtrar por tema", "Todos" y "Buscar artículos…". Los términos son los de `category` (Salud mental, Neurodivergencias, Tratamientos y evaluaciones, Bienestar, relaciones y trabajo). Sin JS el form se envía y recarga.
- **Estado:** aplicado
- **Query:** conectado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Es un `<form method="get" data-query="filtros">`, sin `wp-form`
- [x] Las pills se recorren con teclado y la activa tiene `aria-current="true"`
- [x] El buscador tiene `name="q"` y un `label` accesible

## Sección: destacado

- **Origen:** `html/blog.html` líneas 179-188
- **Destino:** `template-parts/pages/blog/destacado.php`
- **Grupo:** `blog_destacado`
- **Skill:** wp-helper
- **Comportamiento:** card grande del artículo elegido como destacado (el `articulo_destacado` del README): imagen destacada 4:3 (16:10 en móvil) con la etiqueta, categoría, tiempo de lectura (`articulo_cabecera_tiempo_lectura`), título (`h2`), bajada y botón al artículo. Se oculta al filtrar o buscar, y en `category.php`. Si no hay artículo elegido, la sección no se imprime. Va en la zona `data-query="destacado"` (sus enlaces con `data-query-ignorar`) y, sin filtros, no se repite en la grilla. La imagen enlazada lleva `tabindex="-1"` y `aria-hidden="true"` (el enlace accesible es el título). Color suelto: fondo de la imagen `#e9e6df`; etiqueta `#8f6f45`.
- **Estado:** aplicado
- **ACF:** conectado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `blog_destacado_etiqueta` | text | Etiqueta sobre la imagen. | Destacado | no |
| `blog_destacado_boton_texto` | text | Texto del botón. | Leer artículo destacado | sí |

- **Campo fuera de wp-acf:** `blog_destacado_articulo` (post_object, "Artículo destacado"): artículo que se muestra destacado arriba del listado (valor actual: ¿EXISTE UN TRATAMIENTO EFECTIVO PARA EL TRASTORNO LÍMITE DE LA PERSONALIDAD?). wp-acf todavía no genera post_object: lo registra `inc/campos-extra.php` como subcampo local del grupo `blog_destacado` (no está en la tabla para que `generate.mjs` no lo pida). Cuando la skill lo soporte, se agrega a la tabla con el mismo nombre, se regenera y se borra de `inc/campos-extra.php`.

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] El título del destacado es `h2` y las cards del listado usan `h3`
- [x] La sección no se imprime si no hay artículo elegido

## Sección: resultados

- **Origen:** `html/blog.html` líneas 189-361
- **Destino:** `template-parts/pages/blog/resultados.php`, `template-parts/components/blog-card.php`
- **Grupo:** ninguno
- **Skill:** ninguna
- **Comportamiento:** el texto "Mostrando 7 de 15 entradas" (`aria-live="polite"`, `data-query="total"`), la grilla `<ul data-query="resultados">` con 6 cards por página del componente `blog-card` (`variante: listing`: imagen 16:10, categoría sobre la imagen, tiempo de lectura, título `h3`, bajada y botón "Ver artículo") y el estado vacío (texto fijo, decisión del 2026-11-03): caja blanca con ícono de lupa, título "NO ENCONTRAMOS ARTÍCULOS", el texto "Prueba con otra categoría o palabra." (con la búsqueda escrita, "No hay artículos que coincidan con «…»") y el botón "Ver todos los artículos" al blog sin filtros. Loop de la consulta principal, 6 por página; el destacado cuenta en "Mostrando N de M" cuando se ve. Al cambiar de página, las cards entran con la animación `is-entering` escalonada (`--lm-i`), sin animación con `prefers-reduced-motion`. El mensaje vacío (`role="status"`) solo se ve cuando no hay resultados. Color suelto: línea del contador `#e3dfd7`.
- **Estado:** aplicado
- **Query:** conectado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Cada card es el componente `blog-card` con `$args`; no hay markup de card repetido
- [x] La grilla lleva `data-query="resultados"` y el contador `data-query="total"`
- [x] El mensaje vacío existe en el HTML y está oculto mientras hay resultados

## Sección: paginacion

- **Origen:** `html/blog.html` líneas 362-366
- **Destino:** `template-parts/pages/blog/paginacion.php`
- **Grupo:** ninguno
- **Skill:** ninguna
- **Comportamiento:** `<nav aria-label="Paginación" data-query="paginacion">` con flecha anterior, números y flecha siguiente. En el diseño son botones que generaba el JS; en el tema son enlaces reales (`/blog/page/2/`), el actual con `aria-current="page"` y las flechas deshabilitadas en los extremos (sin enlace). Al cambiar de página la grilla no salta: se mantiene la posición del usuario relativa a la grilla. Se oculta si hay una sola página. Las páginas son las de la consulta principal; los enlaces conservan `?categoria=` y `?q=`. Al cambiar de página `query.js` baja a los resultados.
- **Estado:** aplicado
- **Query:** conectado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Es un `<nav aria-label="Paginación">` con enlaces reales y la página actual con `aria-current="page"`
- [x] Las flechas tienen `aria-label` ("Página anterior", "Página siguiente")

## Sección: cta

- **Origen:** `html/blog.html` líneas 369-389
- **Destino:** `home.php`, `template-parts/components/cta.php`
- **Grupo:** `blog_cta`
- **Skill:** wp-form
- **Comportamiento:** componente `cta` con `newsletter: true` (video de fondo, ícono, título, texto) y, en lugar del botón, el form del newsletter hecho con wp-form: campos `email` (obligatorio, formato de correo, placeholder "Tu correo electrónico", error "Ingresa un correo válido."), `privacidad` (casilla obligatoria: "Acepto la Política de privacidad y recibir contenidos de Lumenti por correo.", enlace a la página de Política de privacidad, error "Debes aceptar la Política de privacidad.") y honeypot `website`. Botón con spinner y `aria-busy` mientras envía; al terminar se oculta el form y se muestra el mensaje de éxito con foco. Servicio del newsletter por definir (Mailchimp, Brevo u otro, ver README): wp-form deja el envío listo para conectarlo.
- **Estado:** aplicado
- **ACF:** conectado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `blog_cta_titulo` | text | Título del bloque de suscripción. | MANTENTE AL DÍA CON NUESTRO CONTENIDO. | sí |
| `blog_cta_texto` | textarea | Texto bajo el título. | Artículos sobre salud mental escritos por nuestros especialistas. Novedades, recursos y contenido educativo, directo a tu correo y sin spam. | no |
| `blog_cta_boton_texto` | text | Texto del botón de suscribirse. | Suscribirme | sí |
| `blog_cta_exito` | text | Mensaje que se muestra al suscribirse. | ¡Listo! Te suscribiste. Pronto recibirás nuestros artículos en tu correo. | sí |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] El CTA queda dentro de `<main id="main-content">`
- [x] El video no se reproduce con `prefers-reduced-motion`
