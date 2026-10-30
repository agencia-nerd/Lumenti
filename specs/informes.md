# Página: Informes y certificados

- **Resumen:** Explica qué informes y certificados clínicos emite Lumenti, su respaldo y validez, y lista los tipos de documento por especialidad. El visitante escribe por WhatsApp para pedir orientación sobre el documento que necesita.
- **Fuente:** `html/informes.html`
- **Plantilla:** `pages/template-informes.php`
- **Tipo:** estática
- **Contenido:** ninguno
- **Secciones (en orden):** hero, intro, tipos, cta
- **Skills usadas:** wp-helper (intro)
- **Grupo ACF:** Informes y certificados
- **Ubicación:** plantilla pages/template-informes.php
- **Padre:** ninguno
- **Notas de página:**
  - `h1` en el hero: "INFORMES Y CERTIFICADOS CLÍNICOS" (dos líneas, la primera en `--color-brand`).
  - Título SEO del diseño: "Informes y certificados — Lumenti" (el menú y el breadcrumb dicen "Informes y certificados"). El diseño no trae meta descripción.
  - Contenido de `data/informes.json`: los tipos de documento por grupo (sección tipos) y el aviso de validez (sección intro).
  - Comparte estructura y hoja `css/servicios.css` con Psiquiatría y Psicología (`src/css/pages/servicios.css`). Hero, intro y CTA son componentes compartidos; solo "tipos" es propia de esta página. No tiene carrusel de especialistas.
  - `<main id="main-content" class="lm-service">`; el `<body>` lleva `lm-page lm-page--informes` (vía `body_class`).
  - En el header, "Servicios" y el ítem "Informes y certificados" del mega menú van con `aria-current="page"`.
  - El diseño carga `specialists-filter.js` y `condition-filter.js` aunque la página no los usa: no se cargan aquí.
  - El WhatsApp usa `opciones_contacto_whatsapp_paciente` (`opciones.md`).
- **Estado:** aplicado

<!-- Una sección por bloque, con el formato de references/formato-spec.md -->

## Sección: hero

- **Origen:** `html/informes.html` líneas 152-176
- **Destino:** `pages/template-informes.php`, `template-parts/pages/informes/hero.php`, `template-parts/components/page-hero.php`, `template-parts/components/breadcrumb.php`
- **Grupo:** `informes_hero`
- **Skill:** ninguna
- **Comportamiento:** mismo componente `page-hero` (`variante` `service`) que Psiquiatría y Psicología, con el mismo fondo decorativo de 5 capas SVG (`psiq-bg-1…5.svg`) y las mismas animaciones, apagadas con `prefers-reduced-motion`. Breadcrumb Inicio › Servicios (sin enlace) › Informes y certificados. `h1` en dos líneas: `titulo_destacado` (verde) y `titulo`. Usa los argumentos nuevos `titulo_destacado` y `nota` de `page-hero`. Nota y etiqueta se ocultan si están vacías.
- **Estado:** aplicado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `informes_hero_titulo_destacado` | text | Primera línea del título principal, en verde. | INFORMES Y | sí |
| `informes_hero_titulo` | text | Segunda línea del título principal. | CERTIFICADOS CLÍNICOS | sí |
| `informes_hero_nota` | text | Frase corta junto al título. | Atención presencial y virtual para cada etapa de la vida. | no |
| `informes_hero_etiqueta` | text | Etiqueta con punto sobre la bajada. | SOBRE EL SERVICIO | no |
| `informes_hero_bajada` | textarea | Párrafo de presentación del servicio, bajo el título. | Elaboramos informes y certificados clínicos respaldados por una evaluación profesional. Cada documento se emite de acuerdo con su finalidad, el criterio del especialista y la información clínica disponible. | sí |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] El `h1` muestra las dos líneas y solo la primera va en `--color-brand`
- [x] Las 5 capas del fondo son decorativas (`alt=""`, `aria-hidden`) y no llevan `loading="lazy"`
- [x] El último ítem del breadcrumb dice "Informes y certificados" y lleva `aria-current="page"`

## Sección: intro

- **Origen:** `html/informes.html` líneas 179-195
- **Destino:** `pages/template-informes.php`, `template-parts/pages/informes/intro.php`, `template-parts/components/intro-split.php`, `template-parts/components/section-title.php`
- **Grupo:** `informes_intro`
- **Skill:** wp-helper
- **Comportamiento:** componente `intro-split` con `.lm-photo-duo`. Título con la parte en verde vía `lumenti_highlight` (marcador propuesto `*`). Tres párrafos normales (sin destacado) y, debajo, el aviso de validez (`.lm-service-notice`, `role="note"`, círculo verde con "!" decorativo): necesita el argumento nuevo `aviso` en `intro-split`; se oculta si está vacío. El texto se guarda en un solo campo y cada línea en blanco separa un párrafo. Valores sueltos del aviso: fondo `#e6e7e6` (único uso), texto 15px con interlineado 1.7. Fotos con `lumenti_image()`, `loading="lazy"`, `object-cover` dentro de la caja `aspect-ratio: 349 / 339`. Nota: el tercer párrafo repite palabra por palabra el aviso; se mantiene como en el diseño hasta que el cliente decida.
- **Estado:** aplicado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `informes_intro_titulo` | text | Título de la sección. Encierra entre asteriscos la parte en verde. | RESPALDO CLÍNICO Y *VALIDEZ DOCUMENTAL* | sí |
| `informes_intro_texto` | textarea | Párrafos bajo el título; deja una línea en blanco entre párrafos (3 en el diseño). | Los informes y certificados son documentos clínicos emitidos y firmados por profesionales de la salud colegiados, a partir de una evaluación profesional. Incluyen los datos del especialista responsable y quedan registrados en la historia clínica del paciente. Su contenido responde a los hallazgos clínicos y al propósito para el cual fueron solicitados. Por ello, no pueden emitirse sin una evaluación previa ni incorporar información que no cuente con sustento clínico suficiente. La aceptación, vigencia, formato y requisitos específicos dependen de la institución que recibirá el documento. Recomendamos consultar previamente estas condiciones con el empleador, centro educativo, aseguradora, notaría u otra entidad solicitante. | sí |
| `informes_intro_aviso` | textarea | Aviso destacado con el ícono "!" bajo los párrafos. | La aceptación, vigencia, formato y requisitos específicos dependen de la institución que recibirá el documento. Recomendamos consultar previamente estas condiciones con el empleador, centro educativo, aseguradora, notaría u otra entidad solicitante. | no |
| `informes_intro_imagen_principal` | image | Foto vertical de atrás, arriba a la derecha (en el diseño: especialista conversando con un paciente). Se recorta para llenar su caja. | — | sí |
| `informes_intro_imagen_secundaria` | image | Foto vertical de adelante, abajo a la izquierda (en el diseño: médico redactando un documento). Se recorta para llenar su caja. | — | sí |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] "VALIDEZ DOCUMENTAL" sale en `--color-brand` y los asteriscos no se imprimen
- [x] Cada párrafo del campo sale en su propio `<p>`
- [x] El aviso lleva `role="note"`, su "!" es `aria-hidden` y desaparece por completo si el campo está vacío
- [x] Las fotos se superponen como en el diseño y se recortan sin deformarse en móvil

## Sección: tipos

- **Origen:** `html/informes.html` líneas 198-214
- **Destino:** `template-parts/pages/informes/tipos.php`
- **Grupo:** `informes_tipos`
- **Skill:** ninguna
- **Comportamiento:** título centrado (`section-title` centrado, sin parte en verde) y una tarjeta blanca por grupo (`article` con `h3` en verde, 13px, tracking 0.12em: valores sueltos). Dentro, una lista de definiciones `<dl>`: nombre del documento (`dt`, tipografía display) y descripción (`dd`) en dos columnas 5:9 con separador; en móvil se apilan. Contenido inicial de `data/informes.json` (3 grupos: General 1, Psiquiatría 3, Psicología 2). Un grupo sin documentos no se muestra. La sección va sin padding superior (`lm-service-section--flush`).
- **Estado:** aplicado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `informes_tipos_titulo` | text | Título de la sección. | TIPOS DE DOCUMENTOS | sí |
| `informes_tipos_grupos` | repeater | Grupos de documentos por especialidad (3 en el diseño: General, Psiquiatría, Psicología) | — | sí |
| `informes_tipos_grupos.grupo` | text | Nombre del grupo, en verde sobre su lista. | GENERAL | sí |
| `informes_tipos_grupos.documentos` | repeater | Documentos del grupo (1 a 3 en el diseño) | — | sí |
| `informes_tipos_grupos.documentos.nombre` | text | Nombre del documento. | CONSTANCIA DE ATENCIÓN | sí |
| `informes_tipos_grupos.documentos.descripcion` | textarea | Para qué sirve el documento y qué requiere. | Documento que confirma que una persona recibió atención en Lumenti en una fecha determinada. | sí |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Cada grupo es un `article` con su `h3` y los documentos son `dt`/`dd` dentro de un `dl`
- [x] Se muestran los 3 grupos y los 6 documentos de `data/informes.json`, en ese orden
- [x] En móvil nombre y descripción se apilan en una columna
- [x] El último documento de cada grupo no lleva línea separadora

## Sección: cta

- **Origen:** `html/informes.html` líneas 217-228
- **Destino:** `pages/template-informes.php`, `template-parts/pages/informes/cta.php`, `template-parts/components/cta.php`, `template-parts/components/boton.php`
- **Grupo:** `informes_cta`
- **Skill:** ninguna
- **Comportamiento:** componente `cta` (video, insignia y overlay propios del componente). El botón abre WhatsApp con `opciones_contacto_whatsapp_paciente` y el mensaje del campo, con ícono de WhatsApp. El texto se oculta si está vacío.
- **Estado:** aplicado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `informes_cta_titulo` | text | Título del bloque final. | ¿NECESITAS UN CERTIFICADO O INFORME CLÍNICO? | sí |
| `informes_cta_texto` | textarea | Frase bajo el título. | Cuéntanos para qué entidad o finalidad lo necesitas y te orientaremos sobre el documento, la evaluación y los requisitos correspondientes. | no |
| `informes_cta_boton_texto` | text | Texto del botón de WhatsApp. | Escríbenos por WhatsApp | sí |
| `informes_cta_mensaje_whatsapp` | text | Mensaje que se escribe solo al abrir WhatsApp desde el botón. | Hola, quisiera información sobre informes y certificados. | sí |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] El botón abre `wa.me/<número de opciones>` con el mensaje codificado en la URL
