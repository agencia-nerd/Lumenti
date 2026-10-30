# Página: Especialistas

- **Resumen:** Directorio de los médicos psiquiatras y psicólogos de Lumenti. El visitante filtra por tipo, población, qué atiende e idioma, o busca por nombre o síntoma, y abre un perfil o agenda por WhatsApp.
- **Fuente:** `html/especialistas.html`
- **Plantilla:** `archive-especialista.php`
- **Tipo:** listado
- **Contenido:** especialista
- **Secciones (en orden):** encabezado, filtros, resultados, vacio
- **Skills usadas:** wp-helper
- **Grupo ACF:** Especialistas
- **Ubicación:** página de opciones: archivo de especialista
- **Padre:** ninguno
- **Notas de página:**
  - `h1`: "UN GRAN EQUIPO HUMANO PARA CUIDAR TU BIENESTAR" (en el encabezado). Título SEO del diseño: "Especialistas — Lumenti". Meta descripción: "Médicos psiquiatras y psicólogos de Lumenti."
  - `<main id="main-content" class="lm-specialists" data-lm-specialists>`; `<body class="lm-page lm-page--especialistas">`. CSS: `css/especialistas.css` → `src/css/pages/especialistas.css` (lo comparten especialista y condición). JS: `js/specialists-filter.js` → `src/js/modules/specialists-filter.js` (filtros) y `especialista-card.js` (popover "+N", lo usan todas las páginas con cards).
  - En el diseño las 13 cards están en el HTML y el JS filtra en el navegador sin recargar, sincroniza la URL con `history.replaceState` y no pagina. En esta etapa se imprimen las 13 cards de ejemplo con `especialista-card`; la consulta real (psiquiatras primero, luego por `especialista_perfil_orden`), los filtros y la búsqueda los conecta wp-query.
  - Nombres en la URL: el diseño usa `?poblacion=` e `?idioma=`, que chocan con las taxonomías `poblacion` e `idioma`; pasan a `?edad=` e `?idiomas=`. `?tipo=`, `?atiende=` y `?q=` se mantienen. Los enlaces de otras páginas (`?tipo=psiquiatras`, `?tipo=psicologos`, `?atiende=depresion`) usan los slugs de los términos.
  - Mala práctica: el diseño embebe los sinónimos del buscador en `<script type="application/json" id="lm-sinonimos">` (línea 834). En el tema no hay `<script>` inline: el archivo `data/sinonimos.json` se copia a `assets/data/sinonimos.json` (con las claves internas `dep`, `ans`… cambiadas por los slugs de `que_trata`), PHP lo lee para la búsqueda sin JS y lo imprime en el formulario como `data-lm-sinonimos="<?= esc_attr(wp_json_encode($sinonimos)) ?>"`; el módulo lo lee de `dataset`.
  - Mala práctica: los chips de "Filtros activos" se crean con `innerHTML`; el módulo los arma con `<template>` y `textContent`.
  - El título y la bajada entran con la animación de máscara del diseño (`lm-specialists__rise`, `__title-mask`); se desactiva con `prefers-reduced-motion`.
  - Las cards llevan su nombre en `h2` aquí (en el carrusel de condición y servicios, `h3`): el componente recibe el nivel.
  - Sin taxonomías con archivo propio: los términos se filtran en esta misma página por parámetro.
- **Al filtrar:** sin recargar
- **Paginación:** ninguna
- **Por página:** 100
- **Filtros en móvil:** igual
- **Estado:** aplicado

**Filtros**

| Filtro | Tipo | Fuente | Varios | Conteo | Vista |
|---|---|---|---|---|---|
| `tipo` | taxonomía | `tipo_especialista` | no | ninguno | segmentado (radios: Todos, Médicos psiquiatras, Psicólogos) |
| `edad` | taxonomía | `poblacion` | no | ninguno | select |
| `atiende` | taxonomía | `que_trata` | no | ninguno | select |
| `idiomas` | taxonomía | `idioma` | no | ninguno | select |
| `q` | búsqueda | título del especialista y términos de `que_trata` a través de los sinónimos de `assets/data/sinonimos.json` | — | — | campo |

## Sección: encabezado

- **Origen:** `html/especialistas.html` líneas 152-167
- **Destino:** `template-parts/pages/especialistas/encabezado.php`
- **Grupo:** `especialistas_encabezado`
- **Skill:** wp-helper
- **Comportamiento:** breadcrumb (componente `breadcrumb`: Inicio › Especialistas) y encabezado propio de la página (`.lm-specialists__header`, no es `page-hero`). El título va en dos líneas con máscara animada; "CUIDAR TU BIENESTAR" va en verde (`lm-specialists__title-accent`): la parte destacada se marca con el helper de texto de wp-helper (aún no instalado en el tema; hoy solo hay `images` y `links`). La bajada se oculta si está vacía.
- **Estado:** aplicado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `especialistas_encabezado_etiqueta` | text | Texto pequeño sobre el título, con punto. | NUESTROS ESPECIALISTAS | no |
| `especialistas_encabezado_titulo` | textarea | Título principal de la página, una línea por renglón. La parte en verde se marca con el helper de texto. | UN GRAN EQUIPO HUMANO PARA CUIDAR TU BIENESTAR | sí |
| `especialistas_encabezado_bajada` | textarea | Párrafo bajo el título. | Conoce a los especialistas en Lumenti: médicos psiquiatras y psicólogos que trabajan de forma coordinada para acompañarte en cada etapa de la vida. | no |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] El título es el único `h1` y conserva el salto de línea y la parte verde del diseño
- [x] Con `prefers-reduced-motion` el título y la bajada aparecen sin animación

## Sección: filtros

- **Origen:** `html/especialistas.html` líneas 169-189
- **Destino:** `template-parts/pages/especialistas/filtros.php`, `template-parts/components/filtros.php`
- **Grupo:** ninguno
- **Skill:** ninguna
- **Comportamiento:** un `<form method="get" action="<archivo de especialista>" data-query="filtros">` (nunca wp-form) con los nombres de la tabla "Filtros". El control segmentado (`tablist` de botones en el diseño) pasa a un grupo de radios `name="tipo"` con el aspecto de `.lm-segmented`, vía el componente `filtros` (`tipo: segmentado`); flechas izquierda/derecha cambian la opción. Buscador `type="search" name="q"` con `<label>` visible "Buscar" y placeholder "Buscar por nombre o condición…"; selects `edad` ("Todas las edades"), `atiende` ("Todas las áreas") e `idiomas` ("Cualquier idioma") con los términos de cada taxonomía como opciones (valor = slug; hoy las opciones del diseño, fijas). El formulario lleva `data-lm-sinonimos` con el JSON de sinónimos (ver notas). Debajo: "Filtros activos:" con un chip por filtro para quitarlo, botón "Limpiar filtros" y el total "13 especialistas" (`aria-live="polite"`, `data-query="total"`). Sin JS, un botón "Aplicar" (visible solo sin JS) envía el formulario. Textos de la interfaz fijos en la plantilla. Grilla de campos: 2,1fr + 3 columnas; en tablet el buscador ocupa la fila completa y en móvil todo va en una columna.
- **Estado:** aplicado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Es un `<form method="get" data-query="filtros">` y cada control tiene el `name` de la tabla "Filtros" (`tipo`, `edad`, `atiende`, `idiomas`, `q`)
- [x] El tipo es un grupo de radios con leyenda accesible ("Tipo de especialista") y se recorre con las flechas
- [x] No hay `<script>` inline: los sinónimos llegan en `data-lm-sinonimos`, escapados con `esc_attr(wp_json_encode())`
- [x] El total tiene `data-query="total"` y `aria-live="polite"`

## Sección: resultados

- **Origen:** `html/especialistas.html` líneas 191-821
- **Destino:** `template-parts/pages/especialistas/resultados.php`, `template-parts/components/especialista-card.php`
- **Grupo:** ninguno
- **Skill:** ninguna
- **Comportamiento:** `<ul class="lm-specialists__grid" data-query="resultados">` con las 13 cards de ejemplo del diseño, cada una con `especialista-card` y un array fijo (nombre corto, cargo, cargo destacado, foto, url del perfil, población, qué atiende, idiomas, tipo y nivel `h2`). Botón de cada card ("Agenda tu cita") = Acción de `_shared.md`: WhatsApp a `opciones_contacto_whatsapp_paciente` con "Hola, quisiera agendar una cita con {nombre}." (el diseño antepone "la"/"el" a "Dra."/"Dr.": "…con la Dra. Mariela Linares."), armado con el helper de enlaces. "Ver perfil" lleva al detalle. En "Qué atiende" se ven 6 chips y el resto en el popover "+N" (hover/foco en escritorio, tap expande la lista en táctil). 2 columnas desde 1024 px, 1 en móvil. Las cards entran con la animación escalonada del diseño (`is-entering`, `--lm-i`) al filtrar, sin ella con `prefers-reduced-motion`. El bloque `vacio` se imprime dentro del mismo contenedor `data-query="resultados"` para que wp-query lo reemplace junto con la lista.
- **Estado:** aplicado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Las 13 cards salen del componente `especialista-card` con `$args`; no hay `WP_Query` en la sección
- [x] La lista tiene `data-query="resultados"` y cada card es un `<li>`
- [x] El popover "+N" se abre con hover y con foco de teclado, y en táctil expande la lista con `aria-expanded`
- [x] El botón de WhatsApp de cada card abre `wa.me/<número de opciones>` con el mensaje que nombra al especialista

## Sección: vacio

- **Origen:** `html/especialistas.html` líneas 823-831
- **Destino:** `template-parts/pages/especialistas/vacio.php`
- **Grupo:** `especialistas_vacio`
- **Skill:** wp-helper
- **Comportamiento:** estado "sin resultados" (`role="status"`), oculto con `hidden` mientras haya cards. Ícono de persona, título, texto y dos botones: "Limpiar filtros" (enlace a la página sin parámetros; con JS limpia el formulario) y el botón suave de WhatsApp a `opciones_contacto_whatsapp_paciente` con el mensaje del campo. Se incluye dentro del contenedor `data-query="resultados"`.
- **Estado:** aplicado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `especialistas_vacio_titulo` | text | Título que aparece cuando ningún especialista coincide con los filtros. | NO ENCONTRAMOS ESPECIALISTAS | sí |
| `especialistas_vacio_texto` | textarea | Texto bajo el título del estado sin resultados. | Ningún especialista coincide con todos los filtros elegidos. Prueba quitando alguno o escríbenos y te ayudamos a encontrar al profesional adecuado. | sí |
| `especialistas_vacio_boton` | text | Texto del botón de WhatsApp del estado sin resultados. | Te ayudamos a elegir | sí |
| `especialistas_vacio_mensaje` | text | Mensaje que se escribe solo al abrir WhatsApp desde ese botón. | Hola, necesito ayuda para elegir un especialista. | sí |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Solo se muestra cuando el total es 0, y lo anuncia `role="status"`
- [x] "Limpiar filtros" funciona también sin JS (enlace a la página sin parámetros)
