# Página: Ajustes del sitio

- **Resumen:** Datos que se repiten en todas las páginas: logo alternativo, botón de WhatsApp de la cabecera, contacto, redes y textos del pie.
- **Fuente:** `html/partials/header.html`
- **Plantilla:** `header.php`
- **Tipo:** global
- **Contenido:** ninguno
- **Secciones (en orden):** cabecera, contacto, redes, pie, formularios
- **Skills usadas:** wp-helper
- **Grupo ACF:** Ajustes del sitio
- **Ubicación:** página de opciones: Ajustes del sitio
- **Padre:** ninguno
- **Notas de página:**
  - El logo principal y el ícono del sitio vienen de Identidad del sitio; no son campos.
  - Los menús (`principal`, `servicios`, `tratamos`, `pie_explora`, `legal`) son menús de WordPress, ver "Menús" en `_shared.md`.
  - El pie (`html/partials/footer.html`) también lee esta página.
  - Banner de cookies: pendiente del cliente, fuera de esta importación.
- **Estado:** aplicado

## Sección: cabecera

- **Origen:** `html/partials/header.html` líneas 1-136
- **Destino:** `header.php`, `template-parts/components/mm-card.php`
- **Grupo:** `opciones_cabecera`
- **Skill:** wp-helper
- **Comportamiento:** header sticky que cambia a tono oscuro sobre secciones `[data-lm-nav-tone="dark"]` (muestra el logo alternativo); mega menús por hover y teclado; menú móvil a pantalla completa bajo 1200 px; botón flotante de WhatsApp bajo 1200 px. El número del botón sale de `opciones_contacto_whatsapp_paciente` (o del corporativo con `data-lm-wa-context="empresas"`). El logo principal viene de Identidad del sitio; los enlaces de los menús, de las ubicaciones `principal`, `servicios` y `tratamos`.
- **Estado:** aplicado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `opciones_cabecera_logo_alternativo` | image | Versión blanca del logo. Se usa en la cabecera sobre fondos oscuros y en el pie. | — | sí |
| `opciones_cabecera_boton_texto` | text | Texto del botón de WhatsApp de la cabecera y del menú móvil. | WhatsApp | sí |
| `opciones_cabecera_mensaje_whatsapp` | text | Mensaje que se escribe solo al abrir WhatsApp desde la cabecera, los mega menús y el botón flotante. | Hola, quisiera agendar una cita. | sí |
| `opciones_cabecera_ayuda_texto` | text | Texto al pie de los mega menús, antes del enlace de contacto. | ¿No sabes cuál elegir? | no |
| `opciones_cabecera_ayuda_enlace` | text | Texto del enlace al pie de los mega menús (abre WhatsApp). | Contáctanos | no |
| `opciones_cabecera_tratamos_titulo` | text | Título de la card con imagen del mega menú "Qué tratamos". | ¿NO SABES QUÉ CONDICIÓN TE AFECTA? | no |
| `opciones_cabecera_tratamos_imagen` | image | Imagen de la card del mega menú "Qué tratamos". | — | no |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Mega menús abren con hover y con teclado (Enter/Escape) y `aria-expanded` cambia
- [x] El menú móvil atrapa el foco y se cierra con Escape
- [x] El ítem actual tiene `aria-current="page"`

## Sección: contacto

- **Origen:** `html/partials/footer.html` líneas 5-13
- **Destino:** `footer.php`
- **Grupo:** `opciones_contacto`
- **Skill:** ninguna
- **Comportamiento:** cada dato es un enlace (`tel:`, `mailto:`, Google Maps en pestaña nueva) con su ícono en recuadro. Los números de WhatsApp los leen los botones de todo el sitio (paciente) y de Empresas (corporativo).
- **Estado:** aplicado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `opciones_contacto_telefono_paciente` | text | Teléfono de atención al paciente, tal como se muestra. | +51 939 033 999 | sí |
| `opciones_contacto_whatsapp_paciente` | text | Número de WhatsApp de atención al paciente, solo dígitos con código de país. Lo usan los botones de todo el sitio | 51939033999 | sí |
| `opciones_contacto_telefono_corporativo` | text | Teléfono de atención corporativa, tal como se muestra. | +51 942 901 535 | sí |
| `opciones_contacto_whatsapp_corporativo` | text | Número de WhatsApp corporativo, solo dígitos con código de país. Lo usa la página Empresas | 51942901535 | sí |
| `opciones_contacto_correo` | email | Correo de contacto del pie | contacto@lumentisaludmental.com | sí |
| `opciones_contacto_direccion` | text | Dirección del consultorio. Abre Google Maps. | C. Los Antares 320, Santiago de Surco 15038 | sí |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Los enlaces `tel:` y `mailto:` se arman desde los mismos textos

## Sección: redes

- **Origen:** `html/partials/footer.html` líneas 33-45, `html/partials/header.html` líneas 121-130
- **Destino:** `footer.php`, `header.php`, `template-parts/components/icon-tile.php`
- **Grupo:** `opciones_redes`
- **Skill:** wp-helper
- **Comportamiento:** lista de íconos en recuadro con círculo de hover; en el pie se muestran todas las redes y en el menú móvil solo Instagram, Facebook, LinkedIn y TikTok. Las URLs están pendientes del cliente (hoy `#`): una red sin enlace no se muestra.
- **Estado:** aplicado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `opciones_redes_titulo` | text | Título de la columna de redes en el pie y en el menú móvil. | SÍGUENOS | no |
| `opciones_redes_items` | repeater | Redes sociales, en el orden en que se muestran (6 en el diseño) | — | no |
| `opciones_redes_items.red` | select | Red social; define el ícono. Opciones: x, facebook, instagram, youtube, linkedin, tiktok | X | sí |
| `opciones_redes_items.enlace` | url | Dirección del perfil | — | sí |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Cada ícono tiene `aria-label` con el nombre de la red

## Sección: pie

- **Origen:** `html/partials/footer.html` líneas 1-58
- **Destino:** `footer.php`
- **Grupo:** `opciones_pie`
- **Skill:** ninguna
- **Comportamiento:** cuatro columnas (contacto, menú `servicios`, menú `pie_explora`, redes), el logo blanco grande (`opciones_cabecera_logo_alternativo`) y la barra inferior con el copyright y el menú `legal`. El año del copyright se calcula al pasar a ACF.
- **Estado:** aplicado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `opciones_pie_contacto_titulo` | text | Título de la columna de contacto. | CONTACTO | no |
| `opciones_pie_servicios_titulo` | text | Título de la columna del menú de servicios. | SERVICIOS | no |
| `opciones_pie_explora_titulo` | text | Título de la columna del menú Explora. | EXPLORA | no |
| `opciones_pie_copyright` | text | Texto de derechos de la barra inferior, después del año. | Lumenti · Todos los derechos reservados. | sí |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] En móvil las columnas se apilan como en el diseño

## Sección: formularios

- **Origen:** `html/empresas.html` (formulario de propuesta), `html/blog.html` (newsletter)
- **Destino:** `inc/forms-extras.php`, `inc/forms/empresas.php`, `inc/forms/newsletter.php`
- **Grupo:** `opciones_formularios`
- **Skill:** wp-form
- **Comportamiento:** cada formulario tiene su propia lista de correos destinatarios (uno o varios). `lumenti_form_recipients('<form>')` la lee de esta página; si está vacía, el envío llega al correo de administración de WordPress. No se guardan envíos en el admin. Mientras el campo no exista, los forms usan el correo de administración.
- **Estado:** aplicado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `opciones_formularios_empresas_correos` | repeater | Correos que reciben las solicitudes del formulario de Empresas. Puedes agregar varios. | — | no |
| `opciones_formularios_empresas_correos.correo` | email | Correo destinatario. | — | sí |
| `opciones_formularios_newsletter_correos` | repeater | Correos que reciben las suscripciones al newsletter del blog. Puedes agregar varios. | — | no |
| `opciones_formularios_newsletter_correos.correo` | email | Correo destinatario. | — | sí |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Cada formulario lee solo su lista; sin correos usa el de administración
