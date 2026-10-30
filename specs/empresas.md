# Página: Empresas

- **Resumen:** Presenta las soluciones de salud mental para organizaciones (talleres, programas de prevención y atención clínica). La empresa revisa los talleres y pide una propuesta con el formulario o por WhatsApp corporativo.
- **Fuente:** `html/empresas.html`
- **Plantilla:** `pages/template-empresas.php`
- **Tipo:** estática
- **Contenido:** ninguno
- **Secciones (en orden):** hero, desafios, soluciones, como-trabajamos, por-que, talleres, propuesta, cta
- **Skills usadas:** wp-form (propuesta), wp-helper
- **Grupo ACF:** Empresas
- **Ubicación:** plantilla pages/template-empresas.php
- **Padre:** ninguno
- **Notas de página:**
  - La plantilla imprime `data-lm-wa-context="empresas"` en `<body>` (filtro `body_class` no sirve: es un atributo; usar un hook `lumenti_` en `header.php` o un filtro propio). Con eso `navbar.js` cambia el botón flotante al número corporativo.
  - Todos los enlaces de WhatsApp de la página usan `opciones_contacto_whatsapp_corporativo`; "Agenda tu cita" y "Contáctanos" del header siguen con el de paciente.
  - `h1`: "SALUD MENTAL PARA ORGANIZACIONES." (en el hero). Título SEO del diseño: "Empresas — Lumenti". Sin meta descripción en el diseño.
  - `<body class="lm-page lm-page--empresas">`; CSS: `css/empresas.css` → `src/css/pages/empresas.css`; JS: `js/empresas-form.js` → `src/js/modules/empresas.js` (enlaces con preselección y pasos; el envío del form es de wp-form).
  - Contenido de origen: `data/empresas.json` y `data/talleres.json`.
  - Las anclas internas (`#soluciones`, `#talleres`, `#propuesta`) compensan la altura del header al hacer scroll.
- **Estado:** aplicado

## Sección: hero

- **Origen:** `html/empresas.html` líneas 152-178
- **Destino:** `template-parts/pages/empresas/hero.php`, `template-parts/components/page-hero.php`
- **Grupo:** `empresas_hero`
- **Skill:** wp-helper
- **Comportamiento:** componente `page-hero` variante `service`: 5 capas SVG decorativas de fondo (archivos del tema, no campos), breadcrumb Inicio / Empresas, `h1` en dos líneas animadas (la primera, "SALUD MENTAL", en color de acento: se marca con el helper de texto resaltado), nota a la derecha, etiqueta, bajada y dos acciones: botón "Solicitar propuesta" (`href="#propuesta"`, `data-lm-goto="formulario"`) y enlace con flecha "Ver soluciones" (`href="#soluciones"`, `data-lm-goto="soluciones"`). Los textos de los botones son fijos porque llevan a anclas de la misma página. `page-hero` necesita dos argumentos más que no están en `_shared.md`: `nota` y `acciones`.
- **Estado:** aplicado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `empresas_hero_titulo` | text | Título principal. Lo que va entre *asteriscos* se muestra en color. | SALUD MENTAL PARA ORGANIZACIONES. | sí |
| `empresas_hero_nota` | text | Frase corta junto al título. | Soluciones adaptadas a la realidad y los objetivos de cada organización. | no |
| `empresas_hero_etiqueta` | text | Texto pequeño sobre la bajada. | EMPRESAS | no |
| `empresas_hero_bajada` | textarea | Texto de presentación. | Ayudamos a las organizaciones a promover el bienestar, prevenir riesgos y responder de manera responsable ante los desafíos de salud mental de sus equipos, mediante talleres, programas y atención especializada. | sí |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] "Solicitar propuesta" y "Ver soluciones" son enlaces a anclas que funcionan sin JS
- [x] La nota, la etiqueta y la bajada se ocultan si el campo está vacío

## Sección: desafios

- **Origen:** `html/empresas.html` líneas 180-190
- **Destino:** `template-parts/pages/empresas/desafios.php`
- **Grupo:** `empresas_desafios`
- **Skill:** wp-helper
- **Comportamiento:** título (`h2`, segunda línea en color de acento) y bajada; lista de 5 desafíos con ícono en círculo, título `h3` y texto. El ícono es decorativo (`alt=""`) y se ve cuadrado (1:1) dentro del círculo; al pasar el mouse el anillo crece (solo con puntero fino, sin animación con `prefers-reduced-motion`). El salto de línea del título viene del diseño: se resuelve con CSS, sin `<br>`.
- **Estado:** aplicado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `empresas_desafios_titulo` | text | Título de la sección. Lo que va entre *asteriscos* se muestra en color. | DESAFÍOS QUE IMPACTAN EN EL BIENESTAR DE LOS EQUIPOS | sí |
| `empresas_desafios_bajada` | textarea | Texto junto al título. | Reconocer estos desafíos permite construir respuestas preventivas y entornos de trabajo más saludables. | no |
| `empresas_desafios_items` | repeater | Desafíos (5 en el diseño). | ESTRÉS LABORAL | sí |
| `empresas_desafios_items.icono` | image | Ícono del desafío. | — | sí |
| `empresas_desafios_items.titulo` | text | Nombre del desafío. | ESTRÉS LABORAL | sí |
| `empresas_desafios_items.texto` | textarea | Explicación breve. | La presión constante afecta el rendimiento, la concentración y el bienestar general del equipo. | sí |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Los 5 desafíos son un `<ul>` y cada título es `h3`
- [x] Sin `<br>` en el título

## Sección: soluciones

- **Origen:** `html/empresas.html` líneas 192-217
- **Destino:** `template-parts/pages/empresas/soluciones.php`
- **Grupo:** `empresas_soluciones`
- **Skill:** wp-helper
- **Comportamiento:** `id="soluciones"` y `data-lm-target="soluciones"`. Título (`h2`, "TU ORGANIZACIÓN" en acento) y bajada, fijos a la izquierda (sticky en escritorio); 3 cards alternadas (la segunda invertida, `--reverse`) con imagen, título `h3`, texto y botón. El botón de cada card va a los talleres (`href="#talleres"`, `data-lm-goto="talleres"`) o al formulario (`href="#propuesta"`, `data-lm-goto="formulario"`) con la opción de `busca[]` que marca (`data-lm-preselect`: `prevencion`, `atencion`). La imagen se recorta con `object-cover` (altura mínima de 308 px en escritorio, 220 px en móvil). Las tarjetas se imprimen en el orden del repetidor; la alternancia es por posición.
- **Estado:** aplicado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `empresas_soluciones_titulo` | text | Título de la sección. Lo que va entre *asteriscos* se muestra en color. | SOLUCIONES PARA TU ORGANIZACIÓN | sí |
| `empresas_soluciones_bajada` | textarea | Texto bajo el título. | Acompañamos a las organizaciones desde la formación y la prevención hasta la atención clínica de sus colaboradores. | no |
| `empresas_soluciones_items` | repeater | Soluciones (3 en el diseño). | TALLERES Y CAPACITACIONES | sí |
| `empresas_soluciones_items.imagen` | image | Foto de la solución. | — | sí |
| `empresas_soluciones_items.titulo` | text | Nombre de la solución. | TALLERES Y CAPACITACIONES | sí |
| `empresas_soluciones_items.texto` | textarea | Descripción breve. | Sesiones prácticas dirigidas a colaboradores y líderes para fortalecer conocimientos y herramientas relacionadas con la salud mental y el bienestar laboral. | sí |
| `empresas_soluciones_items.boton_texto` | text | Texto del botón. | Ver talleres | sí |
| `empresas_soluciones_items.destino` | select | A dónde lleva el botón. Opciones: talleres, formulario | talleres | sí |
| `empresas_soluciones_items.preseleccion` | select | Opción que queda marcada en el formulario. Opciones: ninguna, taller, prevencion, atencion, inhouse, convenio, orientacion | ninguna | no |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Cada botón es un enlace a su ancla y lleva `data-lm-goto` y, si corresponde, `data-lm-preselect`
- [x] La segunda card se ve invertida en escritorio y apilada igual que las demás en móvil

## Sección: como-trabajamos

- **Origen:** `html/empresas.html` líneas 219-237
- **Destino:** `template-parts/pages/empresas/como-trabajamos.php`
- **Grupo:** `empresas_como_trabajamos`
- **Skill:** wp-helper
- **Comportamiento:** `data-lm-steps`. En escritorio y tablet la sección mide 340vh y su contenido queda fijo (sticky): el paso activo (`is-active`) y su número grande (01–04) cambian según el avance del scroll; los pasos no activos llevan `aria-hidden="true"`. Bajo 768 px los 4 pasos se ven apilados y todos visibles (altura automática). Con `prefers-reduced-motion` sin transiciones. El número de cada paso sale de su posición (01, 02…), y cada `h3` lleva oculto "Paso 01: ". Debajo, "¿Empezamos?" con el enlace con flecha "Solicitar propuesta" (`href="#propuesta"`, `data-lm-goto="formulario"`). Los anillos decorativos usan colores sueltos `#e7e4dd` y `#ebe8e2`. JS: `src/js/modules/empresas.js` (`empresasSteps`).
- **Estado:** aplicado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `empresas_como_trabajamos_titulo` | text | Título de la sección. Lo que va entre *asteriscos* se muestra en color. | CONOCE CÓMO TRABAJAMOS | sí |
| `empresas_como_trabajamos_bajada` | textarea | Texto bajo el título. | Un proceso claro y personalizado desde el primer contacto hasta el seguimiento de resultados en tu organización. | no |
| `empresas_como_trabajamos_pasos` | repeater | Pasos del proceso (4 en el diseño), en orden. | CONOCEMOS LA NECESIDAD | sí |
| `empresas_como_trabajamos_pasos.titulo` | text | Nombre del paso. | CONOCEMOS LA NECESIDAD | sí |
| `empresas_como_trabajamos_pasos.texto` | textarea | Explicación del paso. | Conversamos con el equipo responsable para comprender el contexto, los objetivos, el perfil de los participantes y los principales desafíos de la organización. | sí |
| `empresas_como_trabajamos_cierre` | text | Pregunta antes del enlace al formulario. | ¿Empezamos? | no |
| `empresas_como_trabajamos_enlace_texto` | text | Texto del enlace al formulario. | Solicitar propuesta | sí |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Al hacer scroll en escritorio el paso activo y su número cambian; en móvil se ven los 4 pasos
- [x] Los pasos son un `<ol>` y el lector de pantalla oye "Paso 01:" antes de cada título
- [x] Sin JS se ven todos los pasos

## Sección: por-que

- **Origen:** `html/empresas.html` líneas 239-248
- **Destino:** `template-parts/pages/empresas/por-que.php`, `template-parts/components/intro-split.php`
- **Grupo:** `empresas_por_que`
- **Skill:** wp-helper
- **Comportamiento:** componente `intro-split` con `invertido: true` y `ancho: true` (dúo de fotos `--wide`): título `h2`, un párrafo y un párrafo destacado (`--strong`); a la derecha dos fotos superpuestas, la de atrás vertical (≈3:4) y la de adelante vertical (≈3:4) más chica, recortadas con `object-cover`. En móvil las fotos van primero. `intro-split` recibe los dos párrafos en `texto` (array o dos argumentos: decidir en `_shared.md`).
- **Estado:** aplicado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `empresas_por_que_titulo` | text | Título de la sección. | ¿POR QUÉ TRABAJAR CON LUMENTI? | sí |
| `empresas_por_que_texto` | textarea | Primer párrafo. | Contamos con un equipo de psiquiatras y psicólogos con experiencia clínica y formación en diferentes áreas de la salud mental. Diseñamos intervenciones basadas en evidencia y adaptadas al contexto, los objetivos y las características de cada organización. | sí |
| `empresas_por_que_texto_destacado` | textarea | Segundo párrafo, en negrita. | Nuestro enfoque combina prevención, formación y acceso a atención especializada, permitiendo desarrollar soluciones que van desde un taller puntual hasta un programa más amplio de bienestar. | no |
| `empresas_por_que_imagen_fondo` | image | Foto de atrás (la más grande). | — | sí |
| `empresas_por_que_imagen_frente` | image | Foto de adelante (la más chica). | — | sí |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Usa el componente `intro-split`, sin copiar su markup
- [x] Las dos fotos llevan `alt` descriptivo y no se deforman

## Sección: talleres

- **Origen:** `html/empresas.html` líneas 250-258
- **Destino:** `template-parts/pages/empresas/talleres.php`
- **Grupo:** `empresas_talleres`
- **Skill:** wp-helper
- **Comportamiento:** `id="talleres"` y `data-lm-target="talleres"`. Título (`h2`, "Y CAPACITACIONES" en acento) y bajada; 3 cards de taller (de `data/talleres.json`) con título `h3` numerado por posición ("01. "), descripción (vacía en el diseño: el párrafo se oculta si está vacía), "Temas sugeridos:" con la lista de temas y botón "Solicitar este taller" (`href="#propuesta"`, `data-lm-goto="formulario"`, `data-lm-preselect="taller"`, `data-lm-prefill="<nombre del taller>"`). El salto de línea del título se resuelve con CSS, sin `<br>`.
- **Estado:** aplicado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `empresas_talleres_titulo` | text | Título de la sección. Lo que va entre *asteriscos* se muestra en color. | EXPLORA NUESTROS TALLERES Y CAPACITACIONES | sí |
| `empresas_talleres_bajada` | textarea | Texto bajo el título. | Formamos a colaboradores, líderes y organizaciones con herramientas prácticas y actualizadas para cuidar la salud mental en el entorno laboral. Cada taller se adapta a la realidad y objetivos de tu equipo. | no |
| `empresas_talleres_temas_etiqueta` | text | Texto antes de la lista de temas de cada taller. | Temas sugeridos: | no |
| `empresas_talleres_boton_texto` | text | Texto del botón de cada taller. | Solicitar este taller | sí |
| `empresas_talleres_items` | repeater | Talleres (3 en el diseño), en orden. | SALUD MENTAL Y BIENESTAR EMOCIONAL | sí |
| `empresas_talleres_items.nombre` | text | Nombre del taller; también se escribe en el mensaje del formulario. | SALUD MENTAL Y BIENESTAR EMOCIONAL | sí |
| `empresas_talleres_items.descripcion` | textarea | Descripción del taller. | — | no |
| `empresas_talleres_items.temas` | textarea | Temas sugeridos, uno por línea. | Estrés laboral y manejo de la ansiedad | sí |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Cada tema es un `<li>` (una línea del campo = un ítem)
- [x] El botón lleva `data-lm-preselect="taller"` y `data-lm-prefill` con el nombre del taller escapado con `esc_attr`
- [x] La descripción no deja un párrafo vacío cuando no hay texto

## Sección: propuesta

- **Origen:** `html/empresas.html` líneas 260-352
- **Destino:** `template-parts/pages/empresas/propuesta.php`, `template-parts/forms/empresas-propuesta.php`, `inc/forms/empresas.php`
- **Grupo:** `empresas_propuesta`
- **Skill:** wp-form
- **Comportamiento:** `id="propuesta"`. Dos columnas: a la izquierda el form (contenedor `data-lm-target="formulario"`), a la derecha (sticky en escritorio) título `h2`, bajada, "¿Prefieres hablar primero?", enlace con flecha a WhatsApp corporativo (`opciones_contacto_whatsapp_corporativo` + mensaje, pestaña nueva con el helper de enlaces) y foto (980:1041, `object-cover`). En móvil el texto va arriba. **Form (wp-form)**, mismos `name` del README "Formulario de Empresas": fieldset "TUS DATOS": `nombre` ("Nombre y apellido", obligatorio, sin números), `empresa` ("Empresa / Organización", obligatorio), `cargo` ("Cargo o área", obligatorio, sin números), `whatsapp` ("WhatsApp de contacto", prefijo +51, obligatorio, 9 dígitos que empiezan en 9, ayuda "Celular de 9 dígitos, sin el +51."), `correo` ("Correo corporativo", obligatorio, formato de correo); fieldset "¿QUÉ NECESITAS?": `busca[]` ("¿Qué estás buscando? (puedes elegir varias)", al menos una: `taller` Taller o charla para colaboradores · `prevencion` Programa de prevención en salud mental · `atencion` Atención psicológica o psiquiátrica para colaboradores · `inhouse` Consultas in house · `convenio` Convenio corporativo · `orientacion` No estoy seguro, necesito orientación), `colaboradores` (select obligatorio: Menos de 50 · 50 a 100 · 101 a 300 · Más de 300 · Aún por definir); fieldset "CUÉNTANOS MÁS": `mensaje` (opcional, ayuda "Cuéntanos qué necesita tu equipo y diseñaremos una propuesta a medida."); `privacidad` (obligatoria, enlace a la Política de privacidad); honeypot `website`. Errores del diseño: "Completa este campo.", "Usa solo letras.", "Ingresa un celular de 9 dígitos.", "Ingresa un correo válido (ej. nombre@empresa.com).", "Elige al menos una opción.", "Selecciona una opción.", "Debes aceptar la Política de privacidad para continuar."; se validan al salir del campo y al enviar, y el foco va al primer error. Mientras escribe, `nombre` y `cargo` borran números y `whatsapp` solo deja 9 dígitos. Botón "Solicitar propuesta" con spinner y `aria-busy`; al enviar se oculta el form y aparece el éxito (foco en su título) con "Enviar otra solicitud", que limpia y vuelve a mostrar el form. Destinatario: por definir (README). **Preselección:** todo enlace con `data-lm-goto="formulario"` en la página hace scroll compensado al form y enfoca el primer campo; si tiene `data-lm-preselect` marca esa opción de `busca[]`; si tiene `data-lm-prefill` agrega al inicio de `mensaje` "Nos interesa el taller "<nombre>"." (una sola vez). `data-lm-goto="soluciones"`/`"talleres"` solo hace scroll. Sin JS los enlaces van a su ancla. Ese JS vive en `src/js/modules/empresas.js` (`empresasLinks`), aparte del de wp-form.
- **Estado:** aplicado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `empresas_propuesta_titulo` | text | Título junto al formulario. Lo que va entre *asteriscos* se muestra en color. | CUÉNTANOS QUÉ NECESITA TU ORGANIZACIÓN | sí |
| `empresas_propuesta_bajada` | textarea | Texto bajo el título. | Comparte con nosotros el contexto de tu empresa y te contactaremos a la brevedad con una propuesta a medida. | no |
| `empresas_propuesta_alternativa` | text | Frase antes del enlace a WhatsApp. | ¿Prefieres hablar primero? | no |
| `empresas_propuesta_whatsapp_texto` | text | Texto del enlace a WhatsApp. | Escríbenos por WhatsApp | sí |
| `empresas_propuesta_mensaje_whatsapp` | text | Mensaje que se escribe solo al abrir WhatsApp. | Hola, quisiera información sobre las soluciones de salud mental para empresas. | sí |
| `empresas_propuesta_imagen` | image | Foto bajo el texto. | — | no |
| `empresas_propuesta_exito_titulo` | text | Título del mensaje después de enviar. | ¡GRACIAS! RECIBIMOS TU SOLICITUD | sí |
| `empresas_propuesta_exito_texto` | textarea | Texto del mensaje después de enviar. | Nuestro equipo corporativo revisará la información y te contactará a la brevedad con una propuesta a medida. | sí |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Un botón con `data-lm-preselect="atencion"` deja marcada esa opción y lleva el foco al primer campo
- [x] "Solicitar este taller" escribe el nombre del taller en `mensaje` sin duplicarlo
- [x] El enlace de WhatsApp usa `opciones_contacto_whatsapp_corporativo`

## Sección: cta

- **Origen:** `html/empresas.html` líneas 354-366
- **Destino:** `pages/template-empresas.php`, `template-parts/components/cta.php`
- **Grupo:** `empresas_cta`
- **Skill:** wp-helper
- **Comportamiento:** componente `cta` (video de fondo, ícono, título, texto y botón) con el botón a `https://wa.me/<opciones_contacto_whatsapp_corporativo>?text=<mensaje>` en pestaña nueva con el helper de enlaces.
- **Estado:** aplicado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `empresas_cta_titulo` | text | Título del bloque final. | CUIDAR A TU EQUIPO TAMBIÉN ES CUIDAR TU ORGANIZACIÓN. | sí |
| `empresas_cta_texto` | textarea | Texto bajo el título. | Diseñamos soluciones de salud mental adaptadas a las necesidades y objetivos de cada empresa. | no |
| `empresas_cta_boton_texto` | text | Texto del botón de WhatsApp. | Conversemos por WhatsApp | sí |
| `empresas_cta_mensaje_whatsapp` | text | Mensaje que se escribe solo al abrir WhatsApp. | Hola, quisiera conversar sobre salud mental para mi organización. | sí |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] El botón usa el WhatsApp corporativo, no el de paciente
