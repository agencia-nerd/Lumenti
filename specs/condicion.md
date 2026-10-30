# Página: Condición

- **Resumen:** Página de una condición de salud mental (depresión, ansiedad, TDAH…): qué es, sus señales, cómo la aborda Lumenti y qué especialistas la atienden. El visitante se informa y pide orientación o agenda por WhatsApp.
- **Fuente:** `html/condicion.html`
- **Plantilla:** `single-condicion.php`
- **Tipo:** detalle
- **Contenido:** condicion
- **Secciones (en orden):** hero, imagen, senales, nota, tipos, abordaje, especialistas, cta
- **Skills usadas:** wp-helper
- **Grupo ACF:** Condición
- **Ubicación:** tipo de contenido = condicion
- **Padre:** ninguno
- **Notas de página:**
  - Ejemplo del diseño: Depresión. Las 16 condiciones (`data/condiciones.json`) usan esta plantilla; los bloques opcionales se ven en `html/_preview-condicion-bloques.html`.
  - Propio de WordPress (no es campo): el título ("Depresión"), que se usa en el breadcrumb, en el título SEO y como `{condicion}` en los mensajes. No usa imagen destacada ni el contenido del editor. Sin archivo: `single-condicion.php` solamente.
  - `h1`: el título del hero ("LA DEPRESIÓN TIENE TRATAMIENTO"). Título SEO del diseño: "Depresión — Lumenti". Sin meta descripción en el diseño (se propone la bajada del hero).
  - Orden de los bloques: `tipos` con variante `comparativa` se imprime antes de `senales` (Psicosis, Trauma); con `tabla` o `tarjetas`, después de `nota` (Ansiedad, Bipolar, TCA).
  - `<main id="main-content" class="lm-cond" data-lm-condition="<slug>">`. CSS: `css/especialistas.css` (cards) y `css/condicion.css` → `src/css/pages/condicion.css`. JS: `js/condition-filter.js` → `src/js/modules/condition-filter.js` (ajuste del `h1` y pills del carrusel) y el acordeón de wp-accordion.
  - Los títulos de "Especialistas que pueden ayudarte" son iguales en todas las condiciones: texto fijo en la plantilla, no campos.
  - El campo "grupo del menú" de `_shared.md` no se crea: el grupo de cada condición en el mega menú "Qué tratamos" lo da el menú `tratamos` (elemento padre).
  - `clave` de `_shared.md` pasa a ser `condicion_especialistas_que_trata` (el término de `que_trata` de la condición), que es lo que une condición, especialistas y filtros.
- **Estado:** aplicado

## Sección: hero

- **Origen:** `html/condicion.html` líneas 153-177
- **Destino:** `template-parts/pages/condicion/hero.php`, `template-parts/components/page-hero.php`, `template-parts/components/breadcrumb.php`
- **Grupo:** `condicion_hero`
- **Skill:** ninguna
- **Comportamiento:** componente `page-hero` con su fondo decorativo de 5 capas SVG (`psiq-bg-1…5.svg`) y breadcrumb Inicio › Qué tratamos (`/#que-tratamos` de la portada) › título de la condición. El título va en 2 o 3 líneas, una por renglón del campo, cada una con máscara animada; la primera en verde (`--accent`). Si una línea no cabe, el módulo reduce el tamaño con `--lm-h1-scale` (`data-lm-fit-title`). A la derecha la nota corta; debajo la etiqueta con punto y la bajada. La nota se oculta si está vacía.
- **Estado:** aplicado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `condicion_hero_etiqueta` | text | Texto pequeño con punto sobre la bajada, normalmente el nombre de la condición. | DEPRESIÓN | sí |
| `condicion_hero_titulo` | textarea | Título principal, una línea por renglón (2 o 3). La primera línea va en verde. | LA DEPRESIÓN TIENE TRATAMIENTO | sí |
| `condicion_hero_nota` | text | Frase corta junto al título. | Atención presencial y virtual para cada etapa de la vida. | no |
| `condicion_hero_bajada` | textarea | Párrafo que explica la condición, bajo el título. | La depresión puede afectar el ánimo, la energía, el sueño, la concentración y la capacidad de disfrutar las actividades cotidianas. No es falta de voluntad ni una tristeza pasajera: con una evaluación adecuada y un tratamiento personalizado, es posible reducir los síntomas y recuperar el bienestar. | sí |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Cada renglón del título es una línea del `h1`, la primera en verde, y ninguna se corta en 320 px (ajuste de `--lm-h1-scale`)
- [x] Sin nota no queda un párrafo vacío

## Sección: imagen

- **Origen:** `html/condicion.html` líneas 180-182, `html/_preview-condicion-bloques.html` líneas 44-49 (leyenda)
- **Destino:** `template-parts/pages/condicion/imagen.php`
- **Grupo:** `condicion_imagen`
- **Skill:** wp-helper
- **Comportamiento:** foto principal a todo el ancho del contenedor, proporción 2392:999 con `object-cover` (4:3 en móvil), `loading="eager"` y `fetchpriority="high"`. El `alt` es el de la imagen en la biblioteca de medios. Leyenda opcional sobre la imagen (`<figcaption>` con título y texto), solo si tiene texto (ej.: Personalidad). Valor suelto: fondo de carga `#d8d2c8`.
- **Estado:** aplicado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `condicion_imagen_foto` | image | Foto principal de la condición, bajo el hero. Se recorta a 2392:999 en escritorio y a 4:3 en móvil (centrada). | — | sí |
| `condicion_imagen_leyenda_titulo` | text | Título de la leyenda sobre la foto (ej. "¿DE QUÉ TRASTORNOS HABLAMOS?"). Si está vacío no hay leyenda. | — | no |
| `condicion_imagen_leyenda_texto` | textarea | Texto de la leyenda sobre la foto. | — | no |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] La foto pasa por `lumenti_image()` con `loading="eager"` y cambia a 4:3 bajo 768 px sin deformarse
- [x] La leyenda solo se imprime cuando tiene texto

## Sección: senales

- **Origen:** `html/condicion.html` líneas 185-230, `html/_preview-condicion-bloques.html` líneas 22-25 (destacado y pie) y 50-80 (por grupos)
- **Destino:** `template-parts/pages/condicion/senales.php`
- **Grupo:** `condicion_senales`
- **Skill:** ninguna
- **Comportamiento:** título (`h2`) e intro; destacado opcional antes de la lista (caja verde clara centrada, ej. TDAH); lista de señales en grilla, cada una con punto, título y texto; pie opcional después de la lista. Las señales pueden ir en grupos con título (ej. Bipolar: "DURANTE LA MANÍA O HIPOMANÍA"); con un solo grupo sin título se ve como Depresión. wp-accordion: en escritorio todo abierto y el título no parece botón; bajo 768 px cada lista es un acordeón, uno abierto a la vez, el primero abierto. Encabezados: con grupos, el título del grupo es `h3` y el de cada señal `h4` (el diseño repite `h3`). **Decisión 2026-10-30:** sin acordeón; la lista se lee abierta en todos los anchos.
- **Estado:** aplicado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `condicion_senales_titulo` | text | Título de la sección de señales. | SEÑALES Y SÍNTOMAS FRECUENTES | sí |
| `condicion_senales_intro` | textarea | Párrafo bajo el título. | La depresión puede manifestarse de distintas maneras. Presentar uno o varios de estos signos no confirma por sí solo un diagnóstico, pero puede indicar que es momento de buscar orientación profesional. | sí |
| `condicion_senales_destacado` | textarea | Frase destacada en una caja antes de la lista (ej. TDAH). Si está vacía no se muestra. | — | no |
| `condicion_senales_grupos` | repeater | Grupos de señales. Normalmente uno sin título; varios con título cuando la condición los separa (ej. Bipolar) | — | sí |
| `condicion_senales_grupos.titulo` | text | Título del grupo. Vacío si hay un solo grupo. | — | no |
| `condicion_senales_grupos.items` | repeater | Señales del grupo, en orden (8 en el ejemplo) | — | sí |
| `condicion_senales_grupos.items.titulo` | text | Nombre de la señal. | ÁNIMO BAJO PERSISTENTE | sí |
| `condicion_senales_grupos.items.texto` | textarea | Explicación de la señal. | Un estado de tristeza, vacío o desesperanza que se mantiene la mayor parte del día y durante casi todos los días. | sí |
| `condicion_senales_pie` | textarea | Texto gris después de la lista (ej. TDAH). Si está vacío no se muestra. | — | no |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Las señales se leen abiertas en todos los anchos (sin acordeón: decisión del 2026-10-30, el diseño las plegaba bajo 768 px)
- [x] Destacado, títulos de grupo y pie solo se imprimen cuando tienen texto
- [x] Con grupos, los encabezados quedan `h2` › `h3` › `h4`

## Sección: nota

- **Origen:** `html/_preview-condicion-bloques.html` líneas 17-21
- **Destino:** `template-parts/pages/condicion/nota.php`
- **Grupo:** `condicion_nota`
- **Skill:** ninguna
- **Comportamiento:** bloque opcional "nota dorada" (`<aside class="lm-cond-note" aria-label="Nota">`): ícono dorado, título opcional y texto, sobre fondo dorado claro. Se imprime solo si el texto tiene contenido, al final de la sección `senales` (ej.: Bipolar, TDAH, TDPM con título). Depresión no lo tiene: en el ejemplo no se imprime. Valores sueltos: fondo `#f3ead9`, texto `#6b5233`.
- **Estado:** aplicado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `condicion_nota_titulo` | text | Título de la nota dorada (ej. TDPM). Opcional. | — | no |
| `condicion_nota_texto` | textarea | Texto de la nota dorada que aclara algo importante de la condición. Si está vacío, la nota no se muestra. | — | no |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Sin texto no se imprime nada; sin título el texto va solo
- [x] El ícono es decorativo (`aria-hidden="true"`)

## Sección: tipos

- **Origen:** `html/_preview-condicion-bloques.html` líneas 26-43
- **Destino:** `template-parts/pages/condicion/tipos.php`
- **Grupo:** `condicion_tipos`
- **Skill:** ninguna
- **Comportamiento:** bloque opcional "bloque extra" (`.lm-cond-types`) con tres variantes: `tabla` (lista `<dl>` de dos columnas título/texto: Bipolar, TCA), `tarjetas` (`<ul>` de tarjetas con `h3`: Ansiedad) y `comparativa` (`<dl>` lado a lado, se imprime antes de `senales` con `--before`: Psicosis, Trauma). Título (`h2`), intro opcional y los ítems. Si la variante está vacía no se imprime. Depresión no lo tiene: la plantilla se maqueta con los ejemplos de la vista previa y en Depresión no se muestra.
- **Estado:** aplicado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `condicion_tipos_variante` | select | Cómo se muestra el bloque de tipos. Opciones: tabla, tarjetas, comparativa. Vacío = sin bloque. La comparativa va antes de las señales | — | no |
| `condicion_tipos_titulo` | text | Título del bloque (ej. "TRASTORNOS DE ANSIEDAD MÁS FRECUENTES"). | — | no |
| `condicion_tipos_intro` | textarea | Párrafo bajo el título. Opcional. | — | no |
| `condicion_tipos_items` | repeater | Tipos o conceptos que se explican (2 a 6 en los ejemplos) | — | no |
| `condicion_tipos_items.titulo` | text | Nombre del tipo. | — | sí |
| `condicion_tipos_items.texto` | textarea | Explicación del tipo. | — | sí |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Un solo template part con las tres variantes por modificador (`--tabla`, `--tarjetas`, `--comparativa`)
- [x] La variante `comparativa` se imprime antes de `senales` y las otras después de `nota`
- [x] Sin variante no se imprime nada

## Sección: abordaje

- **Origen:** `html/condicion.html` líneas 233-249
- **Destino:** `template-parts/pages/condicion/abordaje.php`
- **Grupo:** `condicion_abordaje`
- **Skill:** ninguna
- **Comportamiento:** sección oscura (`data-lm-nav-tone="dark"`: el header cambia a tono oscuro encima) con título claro (`h2`), intro y una lista ordenada de pasos (título `h3` y texto en párrafos). wp-accordion: en escritorio todo abierto; bajo 768 px acordeón, uno abierto a la vez, el primero abierto. La intro se oculta si está vacía. **Decisión 2026-10-30:** sin acordeón; los pasos se leen abiertos en todos los anchos.
- **Estado:** aplicado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `condicion_abordaje_titulo` | text | Título de la sección de abordaje. | ¿CÓMO ABORDAMOS LA DEPRESIÓN? | sí |
| `condicion_abordaje_intro` | textarea | Párrafo bajo el título. | Un enfoque integral, personalizado y con acompañamiento en cada etapa, respaldado por evidencia clínica. | no |
| `condicion_abordaje_items` | repeater | Pasos del abordaje, en orden (3 en el ejemplo) | — | sí |
| `condicion_abordaje_items.titulo` | text | Nombre del paso. | EVALUACIÓN INTEGRAL | sí |
| `condicion_abordaje_items.texto` | textarea | Explicación del paso; cada salto de línea doble es un párrafo. | Como punto de partida, en Lumenti solemos recomendar una evaluación por Psiquiatría, especialmente cuando los síntomas son persistentes, intensos o afectan el funcionamiento cotidiano. Durante esta valoración buscamos comprender los síntomas, su evolución y el impacto que están teniendo en tu vida. También revisamos antecedentes, tratamientos previos y otros factores médicos, emocionales o del entorno que puedan estar influyendo, con el objetivo de descartar posibles causas médicas y orientar el plan de tratamiento más adecuado. | sí |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Los pasos se leen abiertos en todos los anchos (sin acordeón: decisión del 2026-10-30, el diseño los plegaba bajo 768 px)
- [x] Encima de la sección el header usa el tono oscuro

## Sección: especialistas

- **Origen:** `html/condicion.html` líneas 252-887
- **Destino:** `template-parts/pages/condicion/especialistas.php`, `template-parts/components/specialists-carousel.php`, `template-parts/components/especialista-card.php`
- **Grupo:** `condicion_especialistas`
- **Skill:** ninguna
- **Comportamiento:** componente `specialists-carousel` con `filtro: true` y las 13 cards de ejemplo del diseño (arrays fijos con `especialista-card`, nombre en `h3`; sin consulta en esta etapa). Textos fijos: "ESPECIALISTAS QUE PUEDEN AYUDARTE" ("AYUDARTE" en verde) e intro "Un equipo humano listo para acompañarte." Pills Todos / Médicos psiquiatras / Psicólogos que filtran el carrusel en el navegador (sin recargar, no son filtros de wp-query); flechas Anterior/Siguiente (se ocultan en los extremos), scroll con teclado. Enlace "Ver todos los especialistas" al archivo de especialistas con `?atiende=<slug del término>` y, si hay pill elegida, `&tipo=<slug>`. Botón de cada card = Acción de `_shared.md` (WhatsApp con "Hola, quisiera agendar una cita con {nombre}."). Con la consulta (wp-query) se listan los especialistas con el término de `condicion_especialistas_que_trata`, psiquiatras primero y luego por `especialista_perfil_orden`.
- **Estado:** aplicado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `condicion_especialistas_que_trata` | taxonomy | Término de "Qué trata" que corresponde a esta condición. Con él se listan sus especialistas, se arma "Ver todos" y los perfiles enlazan a esta página. Un solo término | — | sí |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Las cards salen de `especialista-card` dentro de `specialists-carousel`; no hay `WP_Query` en la sección
- [x] Las pills son botones con `aria-pressed` o radios, cambian el carrusel y el enlace "Ver todos" lleva `atiende` (y `tipo` si hay pill elegida)
- [x] El carrusel se mueve con las flechas y con el teclado, y el scroll suave se desactiva con `prefers-reduced-motion`

## Sección: cta

- **Origen:** `html/condicion.html` líneas 890-901
- **Destino:** `template-parts/pages/condicion/cta.php`, `template-parts/components/cta.php`
- **Grupo:** `condicion_cta`
- **Skill:** wp-helper
- **Comportamiento:** componente `cta` con la variante `--condicion` (fondo partido arena/verde), el video del mar y la insignia del cerebro (fijos, iguales al resto del sitio). Botón de WhatsApp a `opciones_contacto_whatsapp_paciente` con el mensaje del campo; si el campo está vacío, la Acción de `_shared.md`: "Hola, quisiera orientación sobre {condicion}.". El enlace pasa por el helper de enlaces (pestaña nueva con `rel` y aviso).
- **Estado:** aplicado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `condicion_cta_titulo` | text | Título del cierre de la página. | NO TIENES QUE ATRAVESAR LA DEPRESIÓN SIN APOYO. | sí |
| `condicion_cta_texto` | textarea | Texto bajo el título. | Escríbenos y te orientaremos para encontrar la atención más adecuada para ti. | sí |
| `condicion_cta_boton` | text | Texto del botón de WhatsApp. | Solicitar orientación por WhatsApp | sí |
| `condicion_cta_mensaje` | text | Mensaje que se escribe solo al abrir WhatsApp desde el botón. Si está vacío se usa "Hola, quisiera orientación sobre {condición}.". | Hola, quisiera información sobre el tratamiento de la depresión. | no |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] El botón abre `wa.me/<número de opciones>` con el mensaje de la condición
- [x] El video es decorativo, sin sonido, y no se reproduce con `prefers-reduced-motion`
