# Página: Psicología

- **Resumen:** Presenta el servicio de psicología de Lumenti: qué es, cuándo buscarla, sus dos servicios (psicoterapia y evaluaciones psicológicas) y el equipo de psicólogos. El visitante agenda psicoterapia o una evaluación por WhatsApp.
- **Fuente:** `html/servicio-psicologia.html`
- **Plantilla:** `pages/template-psicologia.php`
- **Tipo:** estática
- **Contenido:** ninguno
- **Secciones (en orden):** hero, intro, servicios, especialistas, cta
- **Skills usadas:** wp-helper (intro, servicios, especialistas)
- **Grupo ACF:** Psicología
- **Ubicación:** plantilla pages/template-psicologia.php
- **Padre:** ninguno
- **Notas de página:**
  - `h1` en el hero: "PSICOLOGÍA PARA COMPRENDERTE Y AVANZAR." (dos líneas, la primera en `--color-brand`).
  - Título SEO del diseño: "Psicología — Lumenti". El diseño no trae meta descripción.
  - Comparte estructura y hoja `css/servicios.css` con Psiquiatría e Informes (`src/css/pages/servicios.css`). Hero, intro, especialistas y CTA son componentes compartidos; solo "servicios" es propia de esta página.
  - La tarjeta "Evaluaciones psicológicas" conserva `id="evaluaciones"`: la enlazan el pie (menú `servicios`, "Evaluaciones psicológicas") y el Home como `/psicologia/#evaluaciones`.
  - `<main id="main-content" class="lm-service">`; el `<body>` lleva `lm-page lm-page--psicologia` (vía `body_class`).
  - En el header, "Servicios" y el ítem "Psicología" del mega menú van con `aria-current="page"` (lo resuelve el menú `servicios`).
  - JS: carrusel de especialistas (módulo de `specialists-carousel`) y el ancla con compensación del navbar y resaltado (hoy `hashTarget` de `main.js`).
  - Todos los WhatsApp usan `opciones_contacto_whatsapp_paciente` (`opciones.md`).
- **Estado:** aplicado

<!-- Una sección por bloque, con el formato de references/formato-spec.md -->

## Sección: hero

- **Origen:** `html/servicio-psicologia.html` líneas 152-176
- **Destino:** `pages/template-psicologia.php`, `template-parts/pages/psicologia/hero.php`, `template-parts/components/page-hero.php`, `template-parts/components/breadcrumb.php`
- **Grupo:** `psicologia_hero`
- **Skill:** ninguna
- **Comportamiento:** mismo componente `page-hero` (`variante` `service`) que Psiquiatría, con el mismo fondo decorativo de 5 capas SVG (`psiq-bg-1…5.svg`, fijos del tema) y las mismas animaciones de entrada, apagadas con `prefers-reduced-motion`. Breadcrumb Inicio › Servicios (sin enlace) › Psicología. El `h1` son dos líneas: `titulo_destacado` (verde) y `titulo`. Usa los argumentos nuevos `titulo_destacado` y `nota` de `page-hero`. La nota y la etiqueta se ocultan si están vacías.
- **Estado:** aplicado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `psicologia_hero_titulo_destacado` | text | Primera línea del título principal, en verde. | PSICOLOGÍA PARA | sí |
| `psicologia_hero_titulo` | text | Segunda línea del título principal. | COMPRENDERTE Y AVANZAR. | sí |
| `psicologia_hero_nota` | text | Frase corta junto al título. | Atención psicológica para diferentes etapas de la vida. | no |
| `psicologia_hero_etiqueta` | text | Etiqueta con punto sobre la bajada. | NUESTRO ENFOQUE | no |
| `psicologia_hero_bajada` | textarea | Párrafo de presentación del servicio, bajo el título. | Brindamos psicoterapia y evaluaciones psicológicas desde una mirada cercana, personalizada y basada en evidencia. Buscamos comprender tu historia, tu contexto y aquello que hoy está afectando tu bienestar, para brindarte herramientas que te ayuden a afrontar las dificultades, generar cambios y avanzar. | sí |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] El `h1` muestra las dos líneas y solo la primera va en `--color-brand`
- [x] Las 5 capas del fondo son decorativas (`alt=""`, `aria-hidden`) y no llevan `loading="lazy"`
- [x] Con `prefers-reduced-motion` el fondo y los textos aparecen sin animación
- [x] El último ítem del breadcrumb dice "Psicología" y lleva `aria-current="page"`

## Sección: intro

- **Origen:** `html/servicio-psicologia.html` líneas 179-192
- **Destino:** `pages/template-psicologia.php`, `template-parts/pages/psicologia/intro.php`, `template-parts/components/intro-split.php`, `template-parts/components/section-title.php`
- **Grupo:** `psicologia_intro`
- **Skill:** wp-helper
- **Comportamiento:** componente `intro-split` con `.lm-photo-duo`, igual que Psiquiatría. Título con la palabra en verde vía `lumenti_highlight` (marcador propuesto `*`). Segundo párrafo destacado (argumento nuevo `texto_destacado`), oculto si está vacío. Fotos con `lumenti_image()`, `loading="lazy"`, `object-cover` dentro de la caja `aspect-ratio: 349 / 339`.
- **Estado:** aplicado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `psicologia_intro_titulo` | text | Título de la sección. Encierra entre asteriscos la parte en verde. | ¿QUÉ ES LA *PSICOLOGÍA* Y CUÁNDO BUSCARLA? | sí |
| `psicologia_intro_texto` | textarea | Párrafo principal bajo el título. | La psicología ayuda a comprender cómo pensamos, sentimos, nos relacionamos y actuamos ante las distintas experiencias de la vida. A través de la psicoterapia y la evaluación psicológica, permite identificar dificultades, desarrollar recursos y promover cambios que favorezcan el bienestar. | sí |
| `psicologia_intro_texto_destacado` | textarea | Párrafo final en tono más oscuro. | Puedes consultar cuando una situación afecta tu vida cotidiana, tus emociones o tus relaciones, pero también cuando deseas conocerte mejor, afrontar una etapa de cambio o fortalecer herramientas personales. No necesitas tener un diagnóstico para pedir apoyo. | no |
| `psicologia_intro_imagen_principal` | image | Foto vertical de atrás, arriba a la derecha (en el diseño: hombre de perfil con luz cálida). Se recorta para llenar su caja. | — | sí |
| `psicologia_intro_imagen_secundaria` | image | Foto vertical de adelante, abajo a la izquierda (en el diseño: cabeza con una escalera dentro). Se recorta para llenar su caja. | — | sí |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] "PSICOLOGÍA" sale en `--color-brand` y el asterisco no se imprime
- [x] Las fotos se superponen como en el diseño y se recortan sin deformarse en móvil

## Sección: servicios

- **Origen:** `html/servicio-psicologia.html` líneas 195-211
- **Destino:** `template-parts/pages/psicologia/servicios.php`
- **Grupo:** `psicologia_servicios`
- **Skill:** wp-helper
- **Comportamiento:** título centrado (`section-title` con centrado: argumento nuevo `centrado` o clase `lm-section-title--center`) y dos tarjetas blancas en 2 columnas (1 en móvil). Cada tarjeta: título `h3`, párrafo, párrafo destacado opcional, lista opcional de 2 columnas (1 en móvil) con punto verde, y botón `boton` (`primary`, `md`, ícono WhatsApp) pegado abajo, que abre WhatsApp con `opciones_contacto_whatsapp_paciente` y el mensaje de la tarjeta. La tarjeta con `ancla` imprime ese `id` (en el diseño `evaluaciones` en la segunda): al llegar con `#evaluaciones` la página baja compensando la altura del navbar (`scroll-margin-top`) y la tarjeta se resalta 2,2 s con `.is-highlighted` (sombra `0 0 0 2px` brand + `0 18px 48px rgba(46,108,121,.18)`, valor suelto). Párrafo destacado y lista se ocultan si están vacíos. Texto de la lista en 15px/22px (valor suelto).
- **Estado:** aplicado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `psicologia_servicios_titulo` | text | Título de la sección. Encierra entre asteriscos la parte en verde. | SERVICIOS DE *PSICOLOGÍA* | sí |
| `psicologia_servicios_items` | repeater | Tarjetas de servicio (2 en el diseño: Psicoterapia y Evaluaciones psicológicas) | — | sí |
| `psicologia_servicios_items.titulo` | text | Nombre del servicio. | PSICOTERAPIA | sí |
| `psicologia_servicios_items.texto` | textarea | Descripción del servicio. | Contamos con psicólogos especializados en distintos enfoques psicoterapéuticos basados en evidencia. Esta diversidad nos permite orientar cada caso hacia el profesional y el tipo de terapia más adecuados, considerando el motivo de consulta, la etapa de vida y los objetivos de cada persona. | sí |
| `psicologia_servicios_items.texto_destacado` | textarea | Párrafo en tono más oscuro bajo la descripción. | Durante el proceso se trabajan herramientas para comprender y regular las emociones, afrontar dificultades, modificar patrones que generan malestar y construir cambios significativos en la vida cotidiana. | no |
| `psicologia_servicios_items.lista` | textarea | Lista de tipos del servicio, uno por línea. En el diseño solo la tiene Evaluaciones psicológicas (5 ítems). | Evaluación emocional | no |
| `psicologia_servicios_items.boton_texto` | text | Texto del botón de WhatsApp de la tarjeta. | Agendar psicoterapia | sí |
| `psicologia_servicios_items.mensaje_whatsapp` | text | Mensaje que se escribe solo al abrir WhatsApp desde la tarjeta. | Hola, quisiera agendar una cita de psicoterapia. | sí |
| `psicologia_servicios_items.ancla` | text | Identificador para enlazar directo a la tarjeta, sin `#` ni espacios. Evaluaciones psicológicas usa `evaluaciones`: lo enlazan el pie y el Home, cambiarlo rompe esos enlaces | — | no |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] La tarjeta "Evaluaciones psicológicas" tiene `id="evaluaciones"` y `/psicologia/#evaluaciones` la muestra debajo del navbar, resaltada unos segundos
- [x] Con `prefers-reduced-motion` el salto al ancla es instantáneo
- [x] Los botones quedan alineados abajo aunque las tarjetas tengan distinto largo
- [x] La lista es un `<ul>` y pasa a una columna en móvil
- [x] Cada botón abre WhatsApp con el número de opciones y el mensaje de su tarjeta

## Sección: especialistas

- **Origen:** `html/servicio-psicologia.html` líneas 214-507
- **Destino:** `pages/template-psicologia.php`, `template-parts/pages/psicologia/especialistas.php`, `template-parts/components/specialists-carousel.php`, `template-parts/components/especialista-card.php`, `template-parts/components/enlace-flecha.php`
- **Grupo:** `psicologia_especialistas`
- **Skill:** wp-helper
- **Comportamiento:** mismo componente `specialists-carousel` que Psiquiatría, con `filtro` en `false` (sin pills) y 6 cards de muestra fijas (José Muñoz, Allison García, Valeria Torres, Dora Pflucker, Valentina Gordillo, Anthony Román); sin consulta en esta etapa. Flechas Anterior/Siguiente, pista con teclado, popover "+N" y "Agenda tu cita" a WhatsApp con "Hola, quisiera agendar una cita con {nombre}.". "Ver todos" pasa por `lumenti_link_attrs()`. Bajada y enlace se ocultan si están vacíos.
- **Estado:** aplicado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `psicologia_especialistas_titulo` | text | Título del carrusel. Encierra entre asteriscos la parte en verde. | CONOCE A LOS *ESPECIALISTAS* | sí |
| `psicologia_especialistas_bajada` | text | Frase bajo el título. | Psicólogos clínicos con enfoque humano y basado en evidencia. | no |
| `psicologia_especialistas_enlace` | link | Enlace "Ver todos" a la página de especialistas filtrada por psicólogos (en el diseño `?tipo=psicologos`) | — | no |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Las flechas mueven la pista, la de "Anterior" está oculta al inicio y la pista se recorre con teclado
- [x] "Agenda tu cita" abre WhatsApp con el número de opciones y el nombre del especialista en el mensaje
- [x] "Ver todos" lleva al listado de especialistas, no a `especialistas.html`
- [x] No aparecen las pills Todos / Psiquiatras / Psicólogos

## Sección: cta

- **Origen:** `html/servicio-psicologia.html` líneas 510-521
- **Destino:** `pages/template-psicologia.php`, `template-parts/pages/psicologia/cta.php`, `template-parts/components/cta.php`, `template-parts/components/boton.php`
- **Grupo:** `psicologia_cta`
- **Skill:** ninguna
- **Comportamiento:** componente `cta` (video, insignia y overlay propios del componente). El botón abre WhatsApp con `opciones_contacto_whatsapp_paciente` y el mensaje del campo, con ícono de WhatsApp. El texto se oculta si está vacío.
- **Estado:** aplicado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `psicologia_cta_titulo` | text | Título del bloque final. | DAR EL PRIMER PASO TAMBIÉN ES UNA FORMA DE CUIDARTE | sí |
| `psicologia_cta_texto` | text | Frase bajo el título. | Encuentra en Lumenti una atención profesional, cercana y pensada para ti. | no |
| `psicologia_cta_boton_texto` | text | Texto del botón de WhatsApp. | Agendar una cita | sí |
| `psicologia_cta_mensaje_whatsapp` | text | Mensaje que se escribe solo al abrir WhatsApp desde el botón. | Hola, quisiera agendar una consulta de psicología. | sí |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] El botón abre `wa.me/<número de opciones>` con el mensaje codificado en la URL
