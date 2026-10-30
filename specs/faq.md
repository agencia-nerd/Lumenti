# Página: Preguntas frecuentes

- **Resumen:** Responde las dudas más comunes sobre las citas, la atención y el tratamiento, agrupadas por tema, y lleva a quien no encuentra su respuesta a escribir por WhatsApp.
- **Fuente:** `html/faq.html`
- **Plantilla:** `pages/template-faq.php`
- **Tipo:** estática
- **Contenido:** ninguno
- **Secciones (en orden):** hero, preguntas, cta
- **Skills usadas:** wp-accordion (preguntas)
- **Grupo ACF:** Preguntas frecuentes
- **Ubicación:** plantilla pages/template-faq.php
- **Padre:** ninguno
- **Notas de página:**
  - `h1`: "PREGUNTAS FRECUENTES." en el hero.
  - Título SEO "Preguntas frecuentes — Lumenti"; el diseño no trae meta descripción.
  - Opcional, no está en el diseño: datos estructurados `FAQPage` (JSON-LD) armados desde el mismo repeater; se decide en el paso ACF.
  - `css/pages.css` del diseño (bloque `.lm-faq`) se porta a `src/css/pages/faq.css`.
- **Estado:** aplicado

## Sección: hero

- **Origen:** `html/faq.html` líneas 151-173
- **Destino:** `template-parts/pages/faq/hero.php`, `template-parts/components/page-hero.php`, `template-parts/components/breadcrumb.php`
- **Grupo:** `faq_hero`
- **Skill:** ninguna
- **Comportamiento:** usa el componente `page-hero` con `variante` service (fondo de 5 capas SVG decorativas `psiq-bg-1…5.svg`, `aria-hidden`) y el componente `breadcrumb` (Inicio › título de la página). Título en dos líneas con máscara de entrada, la primera en color de acento; nota a la derecha del título; debajo etiqueta con punto y bajada. La sección solo pasa sus `$args` a los componentes.
- **Estado:** aplicado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `faq_hero_titulo_linea_1` | text | Primera línea del título, en color de acento. Es el `h1` de la página. | PREGUNTAS | sí |
| `faq_hero_titulo_linea_2` | text | Segunda línea del título. | FRECUENTES. | no |
| `faq_hero_nota` | text | Frase corta junto al título. | Atención presencial y virtual para cada etapa de la vida. | no |
| `faq_hero_etiqueta` | text | Texto pequeño sobre la bajada. | AYUDA | no |
| `faq_hero_bajada` | textarea | Texto de introducción bajo el título. | Resolvemos las dudas más comunes sobre nuestros servicios, el proceso de atención y cómo empezar. Si no encuentras lo que buscas, escríbenos. | no |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] El hero usa `template-parts/components/page-hero.php` y el breadcrumb `template-parts/components/breadcrumb.php` con `$args`
- [x] El breadcrumb enlaza a la portada y marca la página actual con `aria-current="page"`

## Sección: preguntas

- **Origen:** `html/faq.html` líneas 175-199
- **Destino:** `template-parts/pages/faq/preguntas.php`
- **Grupo:** `faq_preguntas`
- **Skill:** wp-accordion
- **Comportamiento:** la skill construye el acordeón sobre `<details>`/`<summary>` conservando las clases `lm-faq__*` y el ícono +/− (`lm-faq__icon`). Grupos con título `h2` (CONSULTAS Y CITAS, EVALUACIÓN Y TRATAMIENTO) y debajo sus preguntas. Comportamiento del diseño: una sola pregunta abierta a la vez en toda la página (no por grupo) y la primera abierta al cargar; el diseño además impide cerrar la última abierta ("siempre al menos una abierta", `data-lm-acc-keep`): la skill decide si lo conserva o si se permite cerrar todas. Apertura con transición de alto, sin animación con `prefers-reduced-motion`. El texto de las respuestas debe estar en el HTML (visible para buscadores) aunque esté cerrado. Reemplaza `js/accordion.js` del diseño. **Decisión 2026-10-30:** exclusivo dentro de cada tema (un acordeón por tema) y se pueden cerrar todas.
- **Estado:** aplicado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `faq_preguntas_grupos` | repeater | Temas de preguntas, en orden (2 en el diseño) | — | sí |
| `faq_preguntas_grupos.titulo` | text | Nombre del tema. | CONSULTAS Y CITAS | sí |
| `faq_preguntas_grupos.preguntas` | repeater | Preguntas del tema, en orden (5 y 6 en el diseño). La primera del primer tema se muestra abierta | — | sí |
| `faq_preguntas_grupos.preguntas.pregunta` | text | La pregunta, tal como se lee. | ¿CÓMO AGENDO MI PRIMERA CITA? | sí |
| `faq_preguntas_grupos.preguntas.respuesta` | textarea | Respuesta que se despliega. | Escríbenos por WhatsApp. Te pediremos algunos datos para orientarte y ayudarte a encontrar al profesional más adecuado. | sí |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Al abrir una pregunta se cierra la que estaba abierta dentro de su tema; se pueden cerrar todas (decisión del 2026-10-30)
- [x] La primera pregunta aparece abierta al cargar
- [x] Las respuestas están en el HTML inicial aunque estén cerradas
- [x] Los títulos de tema son `h2` y las preguntas no saltan de nivel

## Sección: cta

- **Origen:** `html/faq.html` líneas 201-212
- **Destino:** `template-parts/pages/faq/cta.php`, `template-parts/components/cta.php`
- **Grupo:** `faq_cta`
- **Skill:** ninguna
- **Comportamiento:** usa el componente `cta` (video de fondo decorativo, sello, título, texto y botón). El botón abre WhatsApp a `opciones_contacto_whatsapp_paciente` con el mensaje del campo, en pestaña nueva. La sección solo pasa sus `$args` al componente.
- **Estado:** aplicado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `faq_cta_titulo` | text | Título del cierre. | ¿TIENES MÁS PREGUNTAS? ESCRÍBENOS. | sí |
| `faq_cta_texto` | textarea | Texto bajo el título. | Escríbenos por WhatsApp y te orientamos en el momento. | no |
| `faq_cta_boton_texto` | text | Texto del botón de WhatsApp. | Escríbenos por WhatsApp | sí |
| `faq_cta_boton_mensaje` | text | Mensaje que se escribe solo al abrir WhatsApp. | Hola, tengo una consulta sobre la atención en Lumenti. | no |
| `faq_cta_video` | file | Video de fondo en MP4, sin sonido. Vacío usa el mismo de la portada. | — | no |
| `faq_cta_poster` | image | Imagen que se ve mientras carga el video. | — | no |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] La sección llama a `template-parts/components/cta.php` con `$args`, sin copiar su markup
- [x] El botón abre WhatsApp con el mensaje del campo codificado en la URL
