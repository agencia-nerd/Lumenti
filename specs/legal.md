# Página: Legal

- **Resumen:** Plantilla de los textos legales del sitio: muestra un documento (Política de privacidad o Términos y condiciones) con un índice lateral para saltar entre sus secciones. Quien la visita la consulta o llega desde el pie y los formularios.
- **Fuente:** `html/legal.html`
- **Plantilla:** `pages/template-legal.php`
- **Tipo:** estática
- **Contenido:** ninguno
- **Secciones (en orden):** cabecera, documento
- **Skills usadas:** ninguna
- **Grupo ACF:** Legal
- **Ubicación:** plantilla pages/template-legal.php
- **Padre:** ninguno
- **Notas de página:**
  - Una plantilla para dos páginas de WordPress: "Política de privacidad" (`data/legal-privacidad.json`) y "Términos y condiciones" (`data/legal-terminos.json`). Cada página guarda su propio contenido en este grupo; las dos se enlazan desde el menú `legal`.
  - Se elimina el cambio de documento por `?d=` (`L.legalDoc` de `js/legal.js`) y el cambio de `document.title`: cada página es una URL propia y el título lo pone WordPress.
  - `h1`: el título de la página de WordPress (no es un campo); el diseño lo escribe en mayúsculas, se agrega `uppercase` al `h1`.
  - Título SEO "Política de privacidad — Lumenti" / "Términos y condiciones — Lumenti"; el diseño no trae meta descripción.
  - Hasta el paso ACF, la plantilla elige el texto fijo de cada documento por el slug de la página (`politica-de-privacidad` / `terminos-y-condiciones`).
  - Textos del cliente con errores a confirmar (se cargan tal cual): en privacidad, el título de la sección V incluye el primer párrafo ("V. Encargados del tratamiento… Podemos tratar datos a través de…"); en términos, la sección X repite el título de la IX ("Derechos de autor, propiedad intelectual y bases de datos") aunque trata de responsabilidad.
  - `css/pages.css` del diseño (bloques `.lm-legal-head` y `.lm-legal`) se porta a `src/css/pages/legal.css`.
- **Estado:** aplicado

## Sección: cabecera

- **Origen:** `html/legal.html` líneas 154-163
- **Destino:** `template-parts/pages/legal/cabecera.php`, `template-parts/components/breadcrumb.php`
- **Grupo:** `legal_cabecera`
- **Skill:** ninguna
- **Comportamiento:** breadcrumb con el componente `breadcrumb` (Inicio › título de la página), `h1` con el título de la página de WordPress y debajo "Última actualización: " seguido de la fecha del campo. El texto "Última actualización:" es fijo de la plantilla. La misma fecha se repite al pie del documento.
- **Estado:** aplicado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `legal_cabecera_actualizado` | text | Fecha de la última actualización del documento, tal como se lee. Se muestra bajo el título y al final del texto. | 01 de junio de 2026 | sí |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] El `h1` y el último ítem del breadcrumb muestran el título de la página que se está viendo
- [x] La fecha aparece igual bajo el título y al pie del documento

## Sección: documento

- **Origen:** `html/legal.html` líneas 164-185
- **Destino:** `template-parts/pages/legal/documento.php`
- **Grupo:** `legal_documento`
- **Skill:** ninguna
- **Comportamiento:** dos columnas desde 1024 px: índice lateral fijo al hacer scroll ("EN ESTA PÁGINA", lista numerada de enlaces) y el texto. Cada sección del repeater es un `<section>` con `h2` (el diseño escribe el título en mayúsculas; se guarda como en el índice y se agrega `uppercase` al `h2`) y su contenido (párrafos, listas y subtítulos `h3` del editor, con las clases `lm-legal__p`, `lm-legal__list`, `lm-legal__li` aplicadas por CSS al contenido). El índice se arma con los títulos de las mismas secciones; los ids son `seccion-1`, `seccion-2`… Al hacer clic en el índice baja a la sección compensando el alto del header y actualiza el `#` de la URL; al hacer scroll marca la sección actual con `aria-current="true"` en su enlace. JS en `src/js/modules/legal-indice.js` (gancho `data-lm-legal-toc`), sin la parte de `?d=`; con `prefers-reduced-motion` el salto es sin animación y sin JS los enlaces de ancla siguen funcionando. Al final, "Última actualización: " con `legal_cabecera_actualizado`. En móvil el índice va arriba del texto como en el diseño.
- **Estado:** aplicado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `legal_documento_indice_titulo` | text | Título del índice lateral. | EN ESTA PÁGINA | no |
| `legal_documento_secciones` | repeater | Secciones del documento, en orden (11 en privacidad, 14 en términos). Cada una aparece en el índice | — | sí |
| `legal_documento_secciones.titulo` | text | Título de la sección; también es el texto del índice. | I. Uso autorizado de datos personales | sí |
| `legal_documento_secciones.contenido` | wysiwyg | Texto de la sección: párrafos, listas y subtítulos | En Renova Mentis S.A.C., en adelante Lumenti, tratamos datos personales obtenidos física o digitalmente y a los que accedemos legítimamente, incluyendo los que generamos durante la prestación de los servicios. | sí |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] El índice tiene un enlace por sección del repeater y cada uno lleva a su `<section>` sin quedar tapado por el header
- [x] Al hacer scroll, el enlace de la sección visible tiene `aria-current="true"` y cambia de estilo
- [x] Cada página muestra solo su documento; no queda código de `?d=` ni documentos ocultos con `hidden`
- [x] Listas y párrafos del editor se ven con el mismo estilo que el diseño
