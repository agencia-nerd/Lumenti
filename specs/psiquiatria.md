# Página: Psiquiatría

- **Resumen:** Presenta el servicio de psiquiatría de Lumenti: qué es, cuándo consultar, cómo es una cita y quiénes son los psiquiatras. El visitante termina agendando una cita por WhatsApp.
- **Fuente:** `html/servicio-psiquiatria.html`
- **Plantilla:** `pages/template-psiquiatria.php`
- **Tipo:** estática
- **Contenido:** ninguno
- **Secciones (en orden):** hero, intro, cita, especialistas, cta
- **Skills usadas:** wp-helper (intro, especialistas)
- **Grupo ACF:** Psiquiatría
- **Ubicación:** plantilla pages/template-psiquiatria.php
- **Padre:** ninguno
- **Notas de página:**
  - `h1` en el hero: "PSIQUIATRÍA QUE COMPRENDE TU HISTORIA" (dos líneas, la primera en `--color-brand`).
  - Título SEO del diseño: "Psiquiatría — Lumenti". El diseño no trae meta descripción.
  - Comparte estructura y hoja `css/servicios.css` con Psicología e Informes: se porta una sola vez como `src/css/pages/servicios.css`. Hero, intro, especialistas y CTA son componentes compartidos; solo "cita" es propia de esta página.
  - `<main id="main-content" class="lm-service">`; el `<body>` lleva `lm-page lm-page--psiquiatria` (vía `body_class`).
  - En el header, "Servicios" y el ítem "Psiquiatría" del mega menú van con `aria-current="page"` (lo resuelve el menú `servicios`).
  - JS: el carrusel de especialistas (módulo de `specialists-carousel`, hoy `condition-filter.js`); esta página no usa las pills.
  - Todos los WhatsApp usan `opciones_contacto_whatsapp_paciente` (`opciones.md`).
- **Estado:** aplicado

<!-- Una sección por bloque, con el formato de references/formato-spec.md -->

## Sección: hero

- **Origen:** `html/servicio-psiquiatria.html` líneas 152-176
- **Destino:** `pages/template-psiquiatria.php`, `template-parts/pages/psiquiatria/hero.php`, `template-parts/components/page-hero.php`, `template-parts/components/breadcrumb.php`
- **Grupo:** `psiquiatria_hero`
- **Skill:** ninguna
- **Comportamiento:** componente `page-hero` con `variante` `service` (mismo marcado en Psicología e Informes). Fondo de 5 capas SVG decorativas (`psiq-bg-1…5.svg`, archivos fijos del tema en `assets/img/`, `alt=""` y `aria-hidden`) con entrada escalonada y deriva lenta; título, nota y bajada suben con `lmRise`. Todas las animaciones se apagan con `prefers-reduced-motion`. Breadcrumb Inicio › Servicios › Psiquiatría: "Servicios" no tiene enlace en el diseño (es un `span`) y el último ítem es el título de la página con `aria-current="page"`. El `h1` son dos líneas: `titulo_destacado` (verde) y `titulo`. Necesita en `page-hero` los argumentos nuevos `titulo_destacado` y `nota` (no están en `_shared.md`). La nota y la etiqueta se ocultan si el campo está vacío.
- **Estado:** aplicado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `psiquiatria_hero_titulo_destacado` | text | Primera línea del título principal, en verde. | PSIQUIATRÍA QUE | sí |
| `psiquiatria_hero_titulo` | text | Segunda línea del título principal. | COMPRENDE TU HISTORIA | sí |
| `psiquiatria_hero_nota` | text | Frase corta junto al título. | Atención presencial y virtual para diferentes etapas de la vida. | no |
| `psiquiatria_hero_etiqueta` | text | Etiqueta con punto sobre la bajada. | NUESTRO ENFOQUE | no |
| `psiquiatria_hero_bajada` | textarea | Párrafo de presentación del servicio, bajo el título. | Brindamos una evaluación clínica integral para comprender no solo tus síntomas, sino también tu historia, tu contexto y cómo lo que estás viviendo impacta en tu día a día. A partir de ello, construimos contigo un plan de tratamiento personalizado y basado en evidencia. | sí |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] El `h1` muestra las dos líneas y solo la primera va en `--color-brand`
- [x] Las 5 capas del fondo son decorativas (`alt=""`, `aria-hidden`) y no llevan `loading="lazy"` (primera pantalla)
- [x] Con `prefers-reduced-motion` el fondo y los textos aparecen sin animación
- [x] El breadcrumb es un `<nav aria-label="Ruta de navegación">`, "Inicio" enlaza a la portada y el último ítem lleva `aria-current="page"`

## Sección: intro

- **Origen:** `html/servicio-psiquiatria.html` líneas 179-192
- **Destino:** `pages/template-psiquiatria.php`, `template-parts/pages/psiquiatria/intro.php`, `template-parts/components/intro-split.php`, `template-parts/components/section-title.php`
- **Grupo:** `psiquiatria_intro`
- **Skill:** wp-helper
- **Comportamiento:** componente `intro-split` (texto a la izquierda, `.lm-photo-duo` a la derecha; en móvil se apilan). El título usa `section-title` con la palabra marcada en `--color-brand` mediante el helper de texto de dos colores de wp-helper (`lumenti_highlight`, marcador propuesto `*` → clase `lm-section-title__accent`; el helper aún no está instalado). El segundo párrafo va en peso 500 y `--color-ink-2` (`lm-intro-split__p--strong`): necesita el argumento nuevo `texto_destacado` en `intro-split`. Las dos fotos pasan por `lumenti_image()` con `loading="lazy"`; la caja mantiene `aspect-ratio: 349 / 339` y cada foto se recorta con `object-cover`. El párrafo destacado se oculta si está vacío.
- **Estado:** aplicado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `psiquiatria_intro_titulo` | text | Título de la sección. Encierra entre asteriscos la parte en verde. | ¿QUÉ ES LA *PSIQUIATRÍA* Y CUÁNDO CONSULTAR? | sí |
| `psiquiatria_intro_texto` | textarea | Párrafo principal bajo el título. | La psiquiatría es la especialidad médica dedicada a evaluar y abordar la salud mental desde una mirada integral. Considera factores emocionales, biológicos, conductuales y del entorno, además de posibles causas médicas que puedan estar influyendo. | sí |
| `psiquiatria_intro_texto_destacado` | textarea | Párrafo final en tono más oscuro. | Es recomendable consultar cuando lo que sientes comienza a afectar tu bienestar, tus relaciones, tus estudios, tu trabajo o tu funcionamiento cotidiano. Acudir a un psiquiatra no significa necesariamente iniciar medicación: el tratamiento se define de manera individual después de una evaluación clínica. | no |
| `psiquiatria_intro_imagen_principal` | image | Foto vertical de atrás, arriba a la derecha (en el diseño: mujer con sombrero frente al mar). Se recorta para llenar su caja. | — | sí |
| `psiquiatria_intro_imagen_secundaria` | image | Foto vertical de adelante, abajo a la izquierda (en el diseño: silueta de perfil frente al cielo). Se recorta para llenar su caja. | — | sí |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] "PSIQUIATRÍA" sale en `--color-brand` y el asterisco no se imprime
- [x] Las fotos se superponen como en el diseño y se recortan sin deformarse en móvil
- [x] Cada foto tiene `alt` (el del diseño como texto alternativo en la biblioteca de medios)

## Sección: cita

- **Origen:** `html/servicio-psiquiatria.html` líneas 195-205
- **Destino:** `template-parts/pages/psiquiatria/cita.php`
- **Grupo:** `psiquiatria_cita`
- **Skill:** ninguna
- **Comportamiento:** tarjeta blanca centrada con título y texto, rodeada de 4 globos (chips) en posiciones fijas `--a` a `--d` y dos fichas giradas decorativas (corazón SVG y manos con `mask` de `assets/icons/manos.svg`, `aria-hidden`). Las posiciones están pensadas para 4 globos: si hay otro número, los que pasen del cuarto no tienen lugar asignado (recomendación de 4 en el campo). Valores sueltos del diseño que se mantienen: sombra del globo `0 8px 24px rgba(28,44,58,.06)`, texto del globo 15px, ficha de 128 × 128 px con radio 24px, tarjeta de máximo 760px, globo con radio `999px` y fondo blanco (`--lm-r-pill`/`--lm-white`, no están en la tabla de tokens).
- **Estado:** aplicado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `psiquiatria_cita_titulo` | text | Título de la tarjeta central. | ¿CÓMO ES UNA CITA POR PSIQUIATRÍA EN LUMENTI? | sí |
| `psiquiatria_cita_texto` | textarea | Texto de la tarjeta central. | Desde la primera consulta realizamos una evaluación clínica integral para comprender qué está ocurriendo, cómo ha evolucionado y de qué manera está impactando en tu vida. Cada atención se adapta al motivo de consulta y a la situación de la persona. | sí |
| `psiquiatria_cita_globos` | repeater | Frases cortas que flotan alrededor de la tarjeta (4 en el diseño). | — | no |
| `psiquiatria_cita_globos.texto` | text | Texto del globo. | Mirada integral | sí |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Los 4 globos quedan en las mismas posiciones que el diseño y no tapan el texto de la tarjeta en escritorio ni en móvil
- [x] Las fichas del corazón y las manos son decorativas (`aria-hidden`)

## Sección: especialistas

- **Origen:** `html/servicio-psiquiatria.html` líneas 208-556
- **Destino:** `pages/template-psiquiatria.php`, `template-parts/pages/psiquiatria/especialistas.php`, `template-parts/components/specialists-carousel.php`, `template-parts/components/especialista-card.php`, `template-parts/components/enlace-flecha.php`
- **Grupo:** `psiquiatria_especialistas`
- **Skill:** wp-helper
- **Comportamiento:** componente `specialists-carousel` con `filtro` en `false` (sin pills). Muestra 7 cards de muestra fijas (Dra. Mariela Linares, Dra. Francesca Valdivia, Dr. Fabrizio Martínez, Dra. Francesca Demarini, Dr. Derek Tantaleán, Dra. Claudia Campos, Dra. Fiorella Ruiz) con `especialista-card`; no hay consulta en esta etapa (la consulta de psiquiatras por `orden` es un paso posterior). Pista con desplazamiento horizontal (`tabindex="0"`), flechas Anterior/Siguiente (la de atrás oculta al inicio) y degradado al borde. Cada card: "Ver perfil" a la ficha del especialista y "Agenda tu cita" a WhatsApp (`opciones_contacto_whatsapp_paciente`, "Hola, quisiera agendar una cita con {nombre}."), popover "+N" de lo que atiende. El título usa el marcador de `lumenti_highlight`; "Ver todos" es un campo link que pasa por `lumenti_link_attrs()` con la flecha como hijo. Necesita en `specialists-carousel` los argumentos nuevos `texto` (bajada) y `enlace` (Ver todos). La bajada y el enlace se ocultan si están vacíos.
- **Estado:** aplicado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `psiquiatria_especialistas_titulo` | text | Título del carrusel. Encierra entre asteriscos la parte en verde. | CONOCE A LOS *ESPECIALISTAS* | sí |
| `psiquiatria_especialistas_bajada` | text | Frase bajo el título. | Médicos psiquiatras con enfoque humano y basado en evidencia. | no |
| `psiquiatria_especialistas_enlace` | link | Enlace "Ver todos" a la página de especialistas filtrada por psiquiatras (en el diseño `?tipo=psiquiatras`) | — | no |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Las flechas mueven la pista, la de "Anterior" está oculta al inicio y la pista se recorre con teclado
- [x] Con `prefers-reduced-motion` el desplazamiento de las flechas es instantáneo
- [x] "Agenda tu cita" abre WhatsApp con el número de opciones y el nombre del especialista en el mensaje
- [x] "Ver todos" lleva al listado de especialistas, no a `especialistas.html`
- [x] No aparecen las pills Todos / Psiquiatras / Psicólogos

## Sección: cta

- **Origen:** `html/servicio-psiquiatria.html` líneas 559-570
- **Destino:** `pages/template-psiquiatria.php`, `template-parts/pages/psiquiatria/cta.php`, `template-parts/components/cta.php`, `template-parts/components/boton.php`
- **Grupo:** `psiquiatria_cta`
- **Skill:** ninguna
- **Comportamiento:** componente `cta` (mismo video `cta-mar-v4.mp4`, insignia del cerebro y overlay del resto del sitio: son del componente, no campos). El botón abre WhatsApp con `opciones_contacto_whatsapp_paciente` y el mensaje del campo, en pestaña nueva con `rel="noopener"`; ícono de WhatsApp. El título entra con `data-lm-reveal="up"`. El texto se oculta si está vacío.
- **Estado:** aplicado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `psiquiatria_cta_titulo` | text | Título del bloque final. | DAR EL PRIMER PASO TAMBIÉN ES UNA FORMA DE CUIDARTE | sí |
| `psiquiatria_cta_texto` | text | Frase bajo el título. | Encuentra en Lumenti una atención profesional, cercana y pensada para ti. | no |
| `psiquiatria_cta_boton_texto` | text | Texto del botón de WhatsApp. | Agendar una cita | sí |
| `psiquiatria_cta_mensaje_whatsapp` | text | Mensaje que se escribe solo al abrir WhatsApp desde el botón. | Hola, quisiera agendar una consulta de psiquiatría. | sí |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] El botón abre `wa.me/<número de opciones>` con el mensaje codificado en la URL
- [x] El video es decorativo (`muted`, `aria-hidden`) y no se reproduce con `prefers-reduced-motion`
