# Página: Especialista

- **Resumen:** Perfil de un médico psiquiatra o psicólogo: a quién atiende, qué trata, su historia, su frase y su formación. El visitante conoce al especialista y agenda por WhatsApp.
- **Fuente:** `html/especialista-detalle.html`
- **Plantilla:** `single-especialista.php`
- **Tipo:** detalle
- **Contenido:** especialista
- **Secciones (en orden):** perfil, resumen, sobre, frase, formacion, actualizacion, barra
- **Skills usadas:** wp-helper
- **Grupo ACF:** Especialista
- **Ubicación:** tipo de contenido = especialista
- **Padre:** ninguno
- **Notas de página:**
  - Ejemplo del diseño: Dra. Mariela Linares. Cada especialista usa esta plantilla.
  - Propios de WordPress (no son campos): el título (nombre completo, "Dra. Mariela Linares Linares", para el admin y la búsqueda del listado) y la imagen destacada (foto 600 × 600 px, 1:1, recortada en círculo). Las taxonomías `tipo_especialista`, `poblacion`, `que_trata`, `idioma` y `modalidad` se asignan en el editor y no son campos.
  - El contenido del editor no se usa: la biografía es el campo `especialista_sobre_biografia`, como dice `_shared.md`.
  - `h1`: el nombre corto ("DRA. MARIELA LINARES"), impreso desde el campo y pasado a mayúsculas con CSS. Título SEO del diseño: "Dra. Mariela Linares — Lumenti" (nombre corto). Meta descripción: el inicio de la biografía (el diseño la recorta a ~155 caracteres).
  - Los rótulos de la plantilla ("Población", "Qué trata", "Modalidad", "Idiomas", "SOBRE MÍ", "FORMACIÓN DESTACADA", "Agendar por WhatsApp") son iguales en todos los perfiles: texto fijo, no campos.
  - `<main id="main-content" class="lm-profile" data-lm-profile>` con el adorno `lm-profile__deco`. Las secciones `resumen` (columna lateral, sticky desde 1200 px) y `sobre`, `frase`, `formacion`, `actualizacion` (columna principal) van dentro de `<div class="lm-profile__body">` que arma `single-especialista.php`; bajo 1200 px la lateral pasa arriba.
  - CSS: `css/especialistas.css` (parte de perfil) → `src/css/pages/especialistas.css`. JS: `js/especialista.js` → `src/js/modules/especialista.js` (carrusel de formación y barra fija).
  - En el diseño la barra fija queda fuera de `<main>`, después del pie; en el tema va al final de `<main id="main-content">` (es `position: fixed`, no cambia el aspecto).
  - El botón flotante de WhatsApp del header se oculta en esta página (`hidden` en el diseño): la barra fija lo reemplaza.
- **Estado:** aplicado

## Sección: perfil

- **Origen:** `html/especialista-detalle.html` líneas 152-175
- **Destino:** `template-parts/pages/especialista/perfil.php`, `template-parts/components/breadcrumb.php`
- **Grupo:** `especialista_perfil`
- **Skill:** wp-helper
- **Comportamiento:** breadcrumb (Inicio › Especialistas › nombre corto) y cabecera del perfil: foto (imagen destacada, círculo con halo `#cfdfe1`, `fetchpriority="high"`, `loading="eager"`, `alt` "Foto de {nombre corto}"), nombre corto en `h1`, cargo como etiqueta dorada, cargo destacado y colegiatura debajo, y el botón "Agendar por WhatsApp" (`data-lm-profile-cta`) = Acción de `_shared.md`: WhatsApp a `opciones_contacto_telefono_paciente` con "Hola, quisiera agendar una cita con {nombre}." (el diseño antepone "la"/"el" a "Dra."/"Dr."), armado con el helper de enlaces. El cargo destacado se oculta si está vacío. `especialista_perfil_orden` no se ve: ordena el listado y el carrusel de condición. Foto: 340 px de ancho máximo (200 px tablet, 168 px móvil). Valor suelto: halo `#cfdfe1`.
- **Estado:** aplicado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `especialista_perfil_nombre_corto` | text | Nombre con el que se muestra al especialista (con Dr./Dra.): título del perfil, cards, barra fija y mensaje de WhatsApp. | Dra. Mariela Linares | sí |
| `especialista_perfil_cargo` | text | Profesión del especialista. Se muestra como etiqueta dorada bajo el nombre y en las cards. | Médica psiquiatra | sí |
| `especialista_perfil_cargo_destacado` | text | Cargo adicional en Lumenti, si lo tiene. Se muestra bajo la etiqueta y como segunda etiqueta en las cards. | Directora Médica de Lumenti | no |
| `especialista_perfil_colegiaturas` | repeater | Números de colegiatura (CMP, RNE, C.Ps.P.), uno por fila. Se muestran en una línea. | — | sí |
| `especialista_perfil_colegiaturas.registro` | text | Registro con su sigla. Ej.: CMP 080939 | CMP 080939 | sí |
| `especialista_perfil_orden` | number | Posición del especialista en el listado y en los carruseles (1 = primero). Los psiquiatras van antes que los psicólogos | — | sí |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] El nombre corto es el único `h1` y la foto carga de inmediato (`loading="eager"`, `fetchpriority="high"`)
- [x] El botón abre `wa.me/<número de opciones>` con el mensaje que nombra al especialista
- [x] Sin cargo destacado no queda un `span` vacío

## Sección: resumen

- **Origen:** `html/especialista-detalle.html` líneas 178-192
- **Destino:** `template-parts/pages/especialista/resumen.php`
- **Grupo:** `especialista_resumen`
- **Skill:** ninguna
- **Comportamiento:** columna lateral (`<aside aria-label="Resumen">`, sticky bajo el header desde 1200 px). Panel 1: chips de "Población" (términos de `poblacion`; si hay nota de adultos, el chip "Adultos" la añade entre paréntesis, ej. "Adultos (hasta 22 años)") y de "Qué trata" (términos de `que_trata`; el chip es enlace a la condición cuando existe una `condicion` con ese término en `condicion_especialistas_que_trata`, si no es texto). Panel de enfoques: chips con los enfoques, oculto si no hay (el diseño no lo dibuja porque el ejemplo no tiene; se arma con el mismo `lm-profile__panel` + chips, por confirmar con el diseño). Panel dividido: "Modalidad" (términos de `modalidad`) e "Idiomas" (términos de `idioma`) unidos con " · ".
- **Estado:** aplicado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `especialista_resumen_nota_adultos` | text | Aclaración de edad para la población "Adultos", si la tiene. Se muestra junto al chip (ej. "hasta 22 años"). | — | no |
| `especialista_resumen_enfoques` | repeater | Enfoques terapéuticos del especialista, en el orden en que se muestran como chips. Si no hay, el panel no se muestra | — | no |
| `especialista_resumen_enfoques.nombre` | text | Nombre del enfoque. | — | sí |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Los chips de "Qué trata" con página de condición son enlaces y los demás son texto
- [x] El panel de enfoques no se imprime si el repetidor está vacío
- [x] Desde 1200 px la columna queda fija al hacer scroll; debajo pasa arriba del contenido

## Sección: sobre

- **Origen:** `html/especialista-detalle.html` líneas 195-199
- **Destino:** `template-parts/pages/especialista/sobre.php`
- **Grupo:** `especialista_sobre`
- **Skill:** ninguna
- **Comportamiento:** título fijo "SOBRE MÍ" (`h2`) y la biografía en párrafos con el estilo `lm-lead`. La biografía se imprime con `wp_kses_post`.
- **Estado:** aplicado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `especialista_sobre_biografia` | wysiwyg | Biografía del especialista en párrafos. Se muestra en "Sobre mí" y su inicio sirve de meta descripción. | Mariela es médica psiquiatra y miembro de la Asociación de Psiquiatría Peruana. Su trayectoria integra la práctica clínica, la docencia y la divulgación científica aplicada, participando como conferencista, capacitadora e invitada en medios para acercar la psiquiatría a distintas audiencias con claridad, empatía y sensibilidad humana. | sí |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Cada párrafo de la biografía sale como `<p>` con el estilo del diseño

## Sección: frase

- **Origen:** `html/especialista-detalle.html` líneas 202-209
- **Destino:** `template-parts/pages/especialista/frase.php`
- **Grupo:** `especialista_frase`
- **Skill:** wp-helper
- **Comportamiento:** `<figure>` verde con comillas grandes, la frase en `<blockquote>` y el pie "— {nombre corto}" + rol. Con foto (`--photo`) va en dos columnas 47/53 y la foto a la derecha (`object-cover`); sin foto el bloque verde ocupa todo el ancho. Bajo 1024 px la foto pasa debajo del texto (alto mínimo 280 px). Toda la sección se oculta si no hay frase. Valor suelto: comillas `#3b7a86`.
- **Estado:** aplicado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `especialista_frase_texto` | textarea | Frase del especialista sobre su forma de trabajar. Si está vacía, el bloque no se muestra. | Creo en una psiquiatría que escucha la historia de cada persona con profundidad y respeto. Acompañar no es solo tratar síntomas, sino ayudar a comprender, aceptar y construir una vida con mayor bienestar, sentido y humanidad. | no |
| `especialista_frase_rol` | text | Rol que se muestra bajo el nombre, al pie de la frase. | Médica Psiquiatra · Directora Médica | no |
| `especialista_frase_foto` | image | Foto del especialista (por ejemplo, escribiendo) junto a la frase. Sin foto, la frase ocupa todo el ancho. | — | no |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Sin foto se usa la variante a ancho completo; sin frase no se imprime nada
- [x] La foto pasa por `lumenti_image()` con `loading="lazy"` y `object-cover`

## Sección: formacion

- **Origen:** `html/especialista-detalle.html` líneas 211-231
- **Destino:** `template-parts/pages/especialista/formacion.php`
- **Grupo:** `especialista_formacion`
- **Skill:** ninguna
- **Comportamiento:** título fijo "FORMACIÓN DESTACADA" (`h2`) con flechas Anterior/Siguiente (`<button>`, se desactivan en los extremos) y un carrusel horizontal con scroll (`tabindex="0"`, flechas del teclado). Cada tarjeta: número de orden con dos cifras ("01", decorativo), ícono `formacion.svg`, título e institución. Degradado a la derecha. En móvil cada tarjeta ocupa el 78 % del ancho. El orden es el del repetidor (el del cliente). La sección se oculta si no hay ítems.
- **Estado:** aplicado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `especialista_formacion_items` | repeater | Formación destacada, en el orden en que se muestra (6 en el ejemplo) | — | no |
| `especialista_formacion_items.titulo` | text | Título o grado obtenido. | Especialidad en Psiquiatría | sí |
| `especialista_formacion_items.institucion` | text | Institución donde se formó. | Universidad Nacional Mayor de San Marcos / Hospital Hermilio Valdizán | sí |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] El carrusel se mueve con las flechas y con el teclado, y el scroll suave se desactiva con `prefers-reduced-motion`
- [x] Los números de las tarjetas salen del índice del repetidor (01, 02…)

## Sección: actualizacion

- **Origen:** `html/especialista-detalle.html` líneas 233-239
- **Destino:** `template-parts/pages/especialista/actualizacion.php`
- **Grupo:** ninguno
- **Skill:** ninguna
- **Comportamiento:** banner dorado igual en todos los perfiles: imagen `formacion-banner.webp` a la derecha (62 % del ancho; en móvil arriba al 60 % del alto con degradado), título "FORMACIÓN EN CONSTANTE ACTUALIZACIÓN" (`h2`) y el texto "Los especialistas actualizan su formación de forma continua. Esta sección resume los hitos más relevantes." Texto e imagen fijos en la plantilla (imagen en `assets/img/esp/`). Valor suelto: degradado `#8c6a45`.
- **Estado:** aplicado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] La imagen es decorativa (`alt=""`) y se recorta sin deformarse en móvil

## Sección: barra

- **Origen:** `html/especialista-detalle.html` líneas 303-308
- **Destino:** `template-parts/pages/especialista/barra.php`
- **Grupo:** ninguno
- **Skill:** ninguna
- **Comportamiento:** barra blanca fija abajo (`data-lm-profile-bar`) con foto mini (48 px), nombre corto y cargo, y el mismo botón "Agendar por WhatsApp" del perfil. Aparece cuando el botón del perfil sale de pantalla hacia arriba y se oculta al llegar al pie (`IntersectionObserver`); oculta lleva `aria-hidden="true"` y el botón `tabindex="-1"`. En móvil solo se ve el botón a todo el ancho. Reutiliza los campos de `perfil`.
- **Estado:** aplicado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Oculta no recibe foco; visible, el botón es alcanzable con Tab
- [x] La transición se desactiva con `prefers-reduced-motion`
