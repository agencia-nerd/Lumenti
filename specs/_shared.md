# Compartido

Se define una sola vez y vale para todas las páginas.

- **Estado:** aprobado
- **Notas:**
  - Clases BEM con prefijo `lm-` (las del diseño); los ganchos de JS son atributos `data-lm-*`, nunca clases.
  - JS: cada módulo del diseño (IIFE + `window.Lumenti`) se reescribe como módulo ES en `src/js/modules/` y lo inicializa `src/js/main.js` solo si su componente existe.
  - Imágenes que imprime PHP: `assets/img/` del tema (se sube junto con `dist/`); íconos y fuentes usados por CSS: `src/img/`, `src/fonts/`.
  - Abenda requiere licencia web (pendiente del cliente); se convierte a woff2 si el cliente la entrega.
  - Textos en dos colores: marcador `*asteriscos*` → helper de texto de wp-helper (`lumenti_highlight`, aún no instalado; se instala en la etapa C).
  - Módulos JS compartidos: `ver-mas.js` (`data-lm-more`, home ayuda y diario) y `carousel.js` genérico (testimonios y carrusel de especialistas).
  - Valores sueltos (una sola vez) quedan como valor arbitrario y están listados en el `Comportamiento` de cada sección; no se crean tokens.

## Alcance

Qué es cada página del diseño. Lo responde el usuario una sola vez; `analyze.mjs` solo propone candidatos (`dynamicCandidates`).

| Diseño | Qué es | Contenido |
|---|---|---|
| `html/home.html` | estática | ninguno |
| `html/especialistas.html` | catálogo | `especialista` |
| `html/especialista-detalle.html` | catálogo | `especialista` |
| `html/condicion.html` | catálogo | `condicion` |
| `html/blog.html` | blog | `post` |
| `html/blog-articulo.html` | blog | `post` |
| `html/servicio-psiquiatria.html` | estática | ninguno |
| `html/servicio-psicologia.html` | estática | ninguno |
| `html/informes.html` | estática | ninguno |
| `html/empresas.html` | estática | ninguno |
| `html/faq.html` | estática | ninguno |
| `html/legal.html` | estática | ninguno |

- `html/legal.html` es una sola plantilla para 2 páginas: Política de privacidad y Términos y condiciones.
- `html/partials/*.html` son la cabecera, el pie, el CTA y la card: van a `specs/opciones.md` y a los componentes.
- `html/_preview-*.html` son vistas previas del diseño: no se importan.

`Qué es`: `estática`, `blog`, `catálogo` (tipo de contenido propio), `woocommerce` u `otro`. `Contenido`: `ninguno` o la fila de abajo que lo describe.

## Contenido dinámico

Una fila por tipo de contenido que se repite o se filtra (entradas, productos, proyectos). Solo se documenta: no se registra el tipo de contenido ni se escribe la consulta.

| Contenido | Origen | Taxonomías | Campos por elemento | Filtros | Plantillas | Acción |
|---|---|---|---|---|---|---|
| `especialista` | cpt | `tipo_especialista` (no jerárquica: Psiquiatras, Psicólogos; slugs psiquiatras y psicologos, los del diseño en ?tipo=), `poblacion` (no jerárquica: Niños, Pre adolescentes, Adolescentes, Adultos, Adulto mayor), `que_trata` (no jerárquica: Depresión, Ansiedad, TEPT, TDAH…; la comparte condicion), `idioma` (no jerárquica: Español, Inglés, Portugués), `modalidad` (no jerárquica: Online, Presencial (Surco)) | nombre corto, cargo, cargo destacado, colegiatura, nota de población adultos, enfoques (repeater), biografía, formación destacada (repeater), frase, rol en la frase, foto de la frase, orden. Foto = imagen destacada 600×600 | tipo (segmentado), población, qué atiende, idioma, buscador con sinónimos | `archive-especialista.php`, `single-especialista.php` | WhatsApp a `opciones_contacto_telefono_paciente` con "Hola, quisiera agendar una cita con {nombre}." |
| `condicion` | cpt | ninguna propia: se enlaza con el término de `que_trata` (psiquiatras primero, luego por orden) | clave, hero (etiqueta, título, bajada), imagen, señales, nota dorada, bloque extra (tabla / tarjetas / comparativa), abordaje (repeater), CTA (título, texto, botón); término de `que_trata` (campo taxonomía). El grupo del menú lo da el menú `tratamos` | ninguno (las pills Todos / Psiquiatras / Psicólogos solo filtran el carrusel en el navegador) | `single-condicion.php` (sin archivo) | WhatsApp a `opciones_contacto_telefono_paciente` con "Hola, quisiera orientación sobre {condicion}." |
| `post` | post | `category` (jerárquica: Salud mental, Neurodivergencias, Tratamientos y evaluaciones, Bienestar, relaciones y trabajo), `post_tag` | tiempo de lectura, bajada. Opciones del blog: artículo destacado y destacados del Home (relación) | categoría (pills), buscador, paginación de 6 | `home.php`, `single.php`, `category.php` (reutiliza las secciones del listado) | ninguna (la card lleva al artículo) |

- `Contenido`: nombre en singular, snake_case, sin tildes (`producto`, `proyecto`, `post`).
- `Origen`: `post` (entradas del blog), `cpt` (tipo de contenido propio, nuevo o ya existente) o `woo` (WooCommerce: solo se maqueta).
- `Taxonomías`: nombre, si es jerárquica y los términos de ejemplo del diseño (`categoria_producto` jerárquica: Sillas, Mesas).
- `Campos por elemento`: lo que cada elemento guarda (precio, galería, ficha). El detalle va en el spec del detalle.
- `Filtros`: los que muestra el diseño (categoría, marca, orden, buscador) o `ninguno`.
- `Plantillas`: archivo de listado, de detalle y de taxonomía (`archive-producto.php`, `single-producto.php`).
- `Acción`: qué hace el botón de cada elemento (WhatsApp con mensaje, formulario de consulta, contacto, carrito de Woo, ninguna) y de dónde sale el dato (campo global, campo del elemento).

## Sitio

Lo que se repite en todas las páginas (cabecera, menú, pie). Aquí solo se decide dónde vive cada cosa; los campos van en `specs/opciones.md`. Nada se crea en esta etapa.

- **Identidad del sitio** (Personalizar > Identidad del sitio, nativo de WordPress): logo principal, ícono del sitio, nombre y descripción. No son campos ACF.
- **Menús** (Apariencia > Menús): cada menú es una ubicación del tema, no un campo.
- **Todo lo demás que se repite** (logo alternativo, contacto, redes, copyright, textos fijos del pie, aviso superior): campos de la página de opciones "Ajustes del sitio", en `specs/opciones.md`.

### Menús

| Ubicación | Dónde se muestra | Enlaces del diseño |
|---|---|---|
| `principal` | Barra del header (≥1200 px) y menú móvil | Inicio, Servicios (mega menú), Qué tratamos (mega menú), Especialistas, Empresas, Blog |
| `servicios` | Mega menú "Servicios" y submenú móvil | Psiquiatría, Psicología, Empresas, Informes y certificados. Bajada de cada card: "Descripción" del elemento de menú; imagen: imagen destacada de la página |
| `pie_servicios` | Columna SERVICIOS del pie | Psiquiatría, Psicología, Informes y certificados, Empresas, Evaluaciones psicológicas |
| `tratamos` | Mega menú "Qué tratamos" y submenú móvil | 3 grupos (ESTADO DEL ÁNIMO, ANSIEDAD Y TRAUMA, OTRAS CONDICIONES) como elementos padre, con las 16 condiciones |
| `pie_explora` | Columna EXPLORA del pie | Especialistas, Qué tratamos, Blog, Preguntas frecuentes |
| `legal` | Barra inferior del pie | Política de privacidad, Términos y condiciones, Libro de reclamaciones (externo) |

- Logo principal (`logo.svg`) e ícono del sitio (`favicon.svg`): Identidad del sitio. Logo blanco (`logo-white.svg`, header sobre fondo oscuro y pie): campo `opciones_cabecera_logo_alternativo`.
- WhatsApp por contexto: todo el sitio usa el número de paciente; la plantilla de Empresas imprime `data-lm-wa-context="empresas"` en `<body>` y usa el corporativo.

## Tokens

Van en `@theme` del CSS principal. Todo valor repetido del diseño se reemplaza por su token.

| Token | Valor | Uso | Origen |
|---|---|---|---|
| `--color-brand` | #2e6c79 | botones primarios, enlaces, acentos | `--lm-teal` |
| `--color-brand-dark` | #244b53 | hover de botón, fondos oscuros, pie | `--lm-teal-dark` |
| `--color-brand-700` | #295a65 | fondos de sección oscura | `--lm-teal-700` |
| `--color-brand-600` | #49737c | recuadros de íconos | `--lm-teal-600` |
| `--color-brand-400` | #73939a | texto secundario sobre oscuro | `--lm-teal-400` |
| `--color-brand-200` | #c3d1d4 | bordes sobre oscuro | `--lm-teal-200` |
| `--color-brand-150` | #abc4c9 | detalles | `--lm-teal-150` |
| `--color-brand-100` | #dbe6e7 | fondos suaves | `--lm-teal-100` |
| `--color-brand-50` | #eef4f3 | fondos muy suaves | `--lm-teal-50` |
| `--color-ink` | #1a202c | títulos | `--lm-ink` |
| `--color-ink-2` | #1c2c3a | títulos de card, botón secundario | `--lm-ink-2` |
| `--color-body` | #4e5e68 | texto de cuerpo | `--lm-body` |
| `--color-muted` | #626771 | texto secundario | `--lm-muted` |
| `--color-muted-2` | #7b8088 | metadatos | `--lm-muted-2` |
| `--color-footer-text` | #b4c5c9 | texto del pie | `--lm-footer-text` |
| `--color-sand` | #f5f3ee | fondo arena | `--lm-sand` |
| `--color-sand-2` | #efebe3 | fondo arena 2 | `--lm-sand-2` |
| `--color-line` | #ece9e2 | separadores | `--lm-line` |
| `--color-line-2` | #e2dfd7 | bordes de campos | `--lm-line-2` |
| `--color-nav` | #ecddd2 | fondo del header | `--lm-nav` |
| `--color-tag` | #f4f4f4 | etiquetas | `--lm-tag` |
| `--color-dark` | #2b2722 | fondo oscuro cálido | `--lm-dark` |
| `--color-gold` | #c6a36c | acento dorado | `--lm-gold` |
| `--color-gold-dark` | #7a5a2e | texto dorado | `--lm-gold-dark` |
| `--color-error` | #b3443f | errores de formulario | `--lm-error` |
| `--font-display` | 'Abenda', Georgia, serif | títulos | `--lm-font-title` |
| `--font-sans` | 'DM Sans', system-ui, sans-serif | cuerpo (400, 500, 600) | `--lm-font-body` |
| `--text-body` | 16px / 24px | cuerpo y métricas (regla del cliente) | `--lm-fs-body` |
| `--text-small` | 14px / 20px | textos pequeños | `--lm-fs-small` |
| `--text-h2` | clamp(40px, 2.8125vw, 54px) | títulos de sección | `--lm-fs-h2` |
| `--text-h3` | clamp(26px, 1.77vw, 34px) | subtítulos | `--lm-fs-h3` |
| `--text-card-title` | clamp(18px, 1.0417vw, 20px) | títulos de card | `--lm-fs-card-title` |
| `--tracking-title` | 0.01em | títulos | `--lm-ls-title` |
| `--container-site` | 1600px | ancho máximo | `--lm-max` |
| `--radius-card` | 6px | cards | `--lm-r-card` |
| `--radius-img` | 4px | imágenes | `--lm-r-img` |
| `--radius-btn` | 8px | botones | `--lm-r-btn` |
| `--shadow-pop` | 0 12px 32px rgba(28,44,58,.12) | popovers | `--lm-shadow-pop` |
| `--ease-site` | cubic-bezier(.2,.8,.2,1) | transiciones | `--lm-ease` |
| `--breakpoint-md` / `--breakpoint-lg` / `--breakpoint-xl` | 768px / 1024px / 1200px | móvil, 2 columnas, navbar completo | `tokens.css` |

- **Responsivos fuera de `@theme`:** `--lm-side` (clamp(24px, 8.3333vw, 160px) · 40px tablet · 20px móvil), `--lm-sec-top` / `--lm-sec-bottom` (160/200 · 112/128 · 80/96 px) y `--lm-nav-h` (104 · 84 · 76 px) cambian por breakpoint: siguen en `:root` con sus media queries.
- **Cómo se aplica el CSS:** las hojas del diseño ya están en BEM `lm-` (≈2 800 líneas). Para no cambiar el aspecto se portan como capas en `src/css/` (`base.css`, `components.css`, `pages/<plantilla>.css`) importadas desde `input.css` en `@layer components`; las variables `--lm-*` pasan a ser alias de los tokens (`--lm-teal: var(--color-brand)`). Tailwind queda para piezas nuevas.

## Componentes compartidos

Cada componente vive en `template-parts/components/<nombre>.php` y recibe sus datos por `$args`.

### boton

- **Origen:** `css/components.css` §1 y §5 (`.lm-btn`, `--primary`, `--secondary`, `--soft`, `--md`)
- **Destino:** `template-parts/components/boton.php`
- **Argumentos:** `texto` (sí), `url` (string o link ACF; sí salvo con `whatsapp`), `variante` (primary, secondary o soft; no), `tamano` (md; no), `icono` (flecha o whatsapp; no), `externo` (bool; no), `whatsapp` (paciente, corporativo o true = contexto de la página; no) + `mensaje` (no): arma la URL `wa.me` y abre en pestaña nueva, `clase` (no), `atributos` (data-*/aria-*, ej. `data-lm-goto`; no)
- **Se usa en:** todas las páginas

### enlace-flecha

- **Origen:** `css/components.css` §1 (`.lm-link-arrow`)
- **Destino:** `template-parts/components/enlace-flecha.php`
- **Argumentos:** `texto` (sí, o el `title` del link), `url` (string o link ACF; sí), `externo` (no), `icono` (derecha o abajo; no), `clase` (no), `atributos` (data-*/aria-*; no)
- **Se usa en:** mega menús, home, servicios, blog

### icon-tile

- **Origen:** `css/components.css` §2 (`.lm-icon-tile`)
- **Destino:** `template-parts/components/icon-tile.php`
- **Argumentos:** `icono` (slug de `assets/icons`, sí), `url` (no), `etiqueta` (aria-label, no), `variante` (light o sm, no)
- **Se usa en:** pie, menú móvil, home

### breadcrumb

- **Origen:** `css/components.css` §6 (`.lm-breadcrumb`)
- **Destino:** `template-parts/components/breadcrumb.php`
- **Argumentos:** `items` (array de `texto`, `url`; sin "Inicio"; un ítem sin url es un `span`; el último es la página actual con `aria-current`; sí), `inicio` (bool, por defecto true: antepone "Inicio" con ícono enlazado a la portada), `clase` (no)
- **Se usa en:** especialistas, especialista, blog, artículo, servicios

### page-hero

- **Origen:** `css/components.css` §12 (`.lm-page-hero`, `--service`)
- **Destino:** `template-parts/components/page-hero.php`
- **Argumentos:** `titulo` (sí; una línea del `h1` por renglón, una línea entera entre `*` va en verde; si ninguna, la primera), `titulo_destacado` (primera línea en verde), `nota`, `etiqueta`, `bajada`, `acciones` (array de `['tipo' => 'boton'|'enlace', …args del componente]`), `acciones_clase` (por defecto `lm-emp-hero__actions`), `breadcrumb` (ítems del componente breadcrumb), `variante` (service o vacío = condición), `id` (del `h1`, por defecto `lm-page-title`), `ajustar` (bool: `data-lm-fit-title`). El fondo de 5 capas SVG es fijo del componente
- **Se usa en:** psiquiatría, psicología, informes, faq, condición, empresas

### section-title

- **Origen:** `css/components.css` §13 (`.lm-section-title`)
- **Destino:** `template-parts/components/section-title.php`
- **Argumentos:** `titulo` (sí, con `*marcador*` para la parte en color), `nivel` (h2 o h3), `id`, `etiqueta` (eyebrow), `texto` (bajada `p.lm-lead`), `texto_clase`, `centrado` (bool), `claro` (bool, `--light`), `clase`
- **Se usa en:** páginas internas

### especialista-card

- **Origen:** `html/partials/card-especialista.html`, `css/components.css` §10
- **Destino:** `template-parts/components/especialista-card.php`
- **Argumentos:** `nombre` (sí, se muestra en mayúsculas), `url` (sí), `cargo`, `cargo_destacado`, `foto`, `tipo` (psiquiatra o psicologo), `poblacion` (array), `atiende` (array de textos o de `texto` + `clave` para `data-atiende`), `visibles` (int, por defecto 6; el resto va al popover "+N"), `idiomas` (array), `whatsapp` (mensaje; vacío = "Hola, quisiera agendar una cita con la Dra./el Dr. {nombre}."), `whatsapp_contexto` (paciente o corporativo), `nivel` (h2 en el listado, h3 en carruseles)
- **Se usa en:** especialistas, condición, servicios

### specialists-carousel

- **Origen:** `css/components.css` §14 (`.lm-specialists-carousel`)
- **Destino:** `template-parts/components/specialists-carousel.php`
- **Argumentos:** `items` (array de `$args` de especialista-card, sí), `titulo` (con `*marcador*`), `texto` (bajada), `enlace` (link ACF "Ver todos"), `filtro` (bool: pills Todos / Médicos psiquiatras / Psicólogos), `variante` (condicion o servicio; por defecto condicion si hay filtro), `id`, `nivel`
- **Se usa en:** condición, psiquiatría, psicología

### blog-card

- **Origen:** `css/components.css` §18 (`.lm-card-blog`, `--listing`)
- **Destino:** `template-parts/components/blog-card.php`
- **Argumentos:** `titulo` (sí, en mayúsculas), `url` (sí), `imagen`, `imagen_alt` (compacta), `categoria`, `lectura` (minutos o texto), `bajada`, `variante` (listing), `nivel` (por defecto h3), `boton` (texto de la acción)
- **Se usa en:** home, blog, artículo (relacionados)

### cta

- **Origen:** `html/partials/cta.html`, `css/components.css` §11 y §20
- **Destino:** `template-parts/components/cta.php`
- **Argumentos:** `titulo` (sí), `texto`, `boton` (`$args` de boton: `texto` + `whatsapp`/`mensaje` o `url`; por defecto ícono de WhatsApp), `newsletter` (bool: en lugar del botón muestra `template-parts/forms/newsletter.php` de wp-form), `form` (`$args` del form), `video` (video MP4 o imagen, se distingue por la extensión; por defecto `assets/video/cta-mar-v4.mp4`), `variante` (condicion), `id`, `nivel`
- **Se usa en:** home, servicios, especialistas, condición, faq, blog, empresas, informes

### intro-split

- **Origen:** `css/components.css` §15 y §16 (`.lm-intro-split`, `--reverse`, `.lm-photo-duo`)
- **Destino:** `template-parts/components/intro-split.php`
- **Argumentos:** `titulo` (sí, con `*marcador*`), `id`, `nivel`, `etiqueta`, `texto` (array de párrafos o texto con líneas en blanco), `texto_destacado` (párrafo oscuro), `aviso`, `imagenes` (2: atrás, adelante), `invertido` (bool), `ancho` (bool), `clase` (ej. `lm-emp-why`)
- **Se usa en:** servicios, empresas, informes

### filtros

- **Origen:** `css/components.css` §8, §9 y §19 (`.lm-segmented`, `.lm-filter-chip`, `.lm-pills`)
- **Destino:** `template-parts/components/filtros.php`
- **Argumentos:** `nombre` (name en la URL, sí), `opciones` (array de `valor`, `texto`; sí), `tipo` (segmentado = radios, pills = botones submit con `aria-pressed`, chips = filtros activos, select), `activo` (por defecto el valor de la URL), `etiqueta` (nombre accesible del grupo o label del select), `etiqueta_id` (aria-labelledby), `clase`
- **Se usa en:** especialistas, blog, condición

### mm-card

- **Origen:** `html/partials/header.html` 25-56 (`.lm-mm-card`)
- **Destino:** `template-parts/components/mm-card.php`
- **Argumentos:** `titulo` (sí), `texto`, `imagen`, `url` (sí), `alto` (bool)
- **Se usa en:** header (mega menús)

## Criterios comunes

Valen para todas las secciones y páginas. Cada sección lo declara con una sola línea ("Cumple los criterios comunes") y solo lista los suyos. Se marcan `[x]` en la sección cuando se comprueban.

### Todas las secciones

- [ ] Un solo `h1` por página y los encabezados no saltan de nivel
- [ ] Sin estilos inline, `!important` ni manejadores `onclick=` en el HTML
- [ ] Controles correctos: acciones con `<button>`, navegación con `<a href>`, campos con `<label>`
- [ ] Imágenes con `alt` (vacío si son decorativas) y proporción fija (`aspect-ratio` + `object-cover`)
- [ ] Colores, tipografías, radios y sombras salen de los tokens de este archivo; los valores sueltos están listados en "Comportamiento"
- [ ] Mismo aspecto que el original en escritorio y en móvil (espaciados, tamaños y colores iguales)
- [ ] Toda la salida PHP escapada (`esc_html`, `esc_url`, `esc_attr`) y el archivo empieza con `defined('ABSPATH') || exit;`
- [ ] `php -l` sin errores en cada archivo creado y `pnpm build` sin errores

### Según lo que tenga la sección

- Imágenes: `width`/`height` o `aspect-ratio` para no mover el layout; `loading="lazy"` salvo las de la primera pantalla.
- Enlaces: destinos reales; los externos con `rel` seguro (helper de enlaces de `wp-helper`).
- Comportamiento con JS: el JS vive en `src/js/modules/`, se activa por `data-` o clase, funciona con teclado y respeta `prefers-reduced-motion`.
- Con skill (`wp-form`, `wp-modal`, `wp-accordion`, `wp-helper`): pasa los criterios de esa skill.
- Bloque repetido: un solo componente con `$args`, usado en todos los lugares donde se repetía.

### Cada página (una vez, al final)

- [ ] `check.mjs` sale con `0`
- [ ] Los enlaces internos apuntan a las páginas del tema, no a los `.html` del diseño
- [ ] `header.php` y `footer.php` no se repiten dentro de la plantilla de la página

## Nomenclatura

- Un grupo de campos por página (`Grupo ACF`) con su regla de ubicación; cada sección es un campo de tipo `group` (`home_hero`) y sus subcampos se guardan como `<sección>_<campo>`.
- Campos ACF: `<página>_<sección>_<campo>` en snake_case y en español (`home_hero_titulo`), que es el nombre con el que ACF guarda el subcampo `titulo` del grupo `home_hero`.
- Repetidos (cards, ítems): un repeater `<página>_<sección>_<plural>` con subcampos sin prefijo (`home_servicios_items.titulo`).
- Página en español, sin tildes ni `ñ` en el nombre del campo.
- Sin límites impuestos: la descripción del campo trae una recomendación, no una validación.
