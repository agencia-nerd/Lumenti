# Página: Inicio

- **Resumen:** Portada de Lumenti: presenta el consultorio de psiquiatría y psicología, sus servicios y las condiciones que trata, y lleva al visitante a agendar una cita por WhatsApp o a explorar servicios, condiciones y el blog.
- **Fuente:** `html/home.html`
- **Plantilla:** `front-page.php`
- **Tipo:** estática
- **Contenido:** ninguno
- **Secciones (en orden):** hero, cifras, sobre, servicios, ayuda, diario, evaluaciones, testimonios, blog, cta
- **Skills usadas:** wp-helper (imágenes, enlaces y texto resaltado de sobre)
- **Grupo ACF:** Inicio
- **Ubicación:** página de inicio (front page)
- **Padre:** ninguno
- **Notas de página:**
  - `h1`: el título del primer slide del hero ("SALUD MENTAL INTEGRAL PARA CADA ETAPA DE LA VIDA"); los demás slides usan `h2`.
  - Título SEO "Lumenti — Salud mental integral para cada etapa de la vida" (lo arma WordPress o el plugin SEO).
  - Meta descripción del diseño: "Consultorio especializado en psiquiatría y psicología para niños, adolescentes y adultos, con atención presencial y virtual en Santiago de Surco." (va al plugin SEO; el tema no imprime metas).
  - Preloader (`html/home.html` líneas 15-16): logo de Identidad del sitio + punto animado, se muestra una sola vez por sesión (`sessionStorage`), dura ~2,7 s y libera el hero al terminar (clase `lm-go` en `<html>`). Se imprime en `front-page.php` antes del contenido y vive en `src/js/modules/preloader.js`; con `prefers-reduced-motion` o sin JS no aparece. Skill: ninguna.
  - La imagen del primer slide se precarga (`<link rel="preload" as="image">` desde `wp_head`, solo en la portada).
  - La sección diario (y su bloque evaluaciones) lleva `data-lm-nav-tone="dark"`: el header cambia a tono oscuro encima.
  - Reveal al hacer scroll (`data-lm-reveal`) lo maneja el módulo común de `main.js`.
  - Los botones de WhatsApp de toda la página usan `opciones_contacto_telefono_paciente` y el mensaje de cada sección.
  - `css/home.css` del diseño se porta a `src/css/pages/home.css`.
- **Estado:** aplicado

## Sección: hero

- **Origen:** `html/home.html` líneas 155-202
- **Destino:** `template-parts/pages/home/hero.php`
- **Grupo:** `home_hero`
- **Skill:** ninguna
- **Comportamiento:** slider de 2 slides con pestañas (`role="tablist"`): cada slide cambia texto, imagen (efecto ken burns) y número grande (01, 02); avanza solo cada 6 s con una barra de progreso en la pestaña activa, se pausa con hover o foco en el botón, flechas izquierda/derecha mueven entre pestañas y no avanza solo con `prefers-reduced-motion`. Arranca cuando termina el preloader. JS en `src/js/modules/hero-slider.js` (ganchos `data-lm-hero-*`). El número de la pestaña ("01.") y el número grande salen del orden del slide. El botón abre WhatsApp a `opciones_contacto_telefono_paciente` con el mensaje del slide (sin mensaje, abre el chat vacío) en pestaña nueva. Sello giratorio decorativo (`aria-hidden`) con 3 palabras sobre un círculo SVG y el ícono `badge-icon.svg` del tema. Imagen del primer slide `loading="eager"` y `fetchpriority="high"`; las demás también `eager` porque entran sin scroll.
- **Estado:** aplicado
- **ACF:** conectado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `home_hero_slides` | repeater | Slides del hero, en orden (2 en el diseño). El título del primero es el `h1` de la página | — | sí |
| `home_hero_slides.pestana` | text | Nombre de la pestaña del slide; el número se agrega solo. | INTEGRAL | sí |
| `home_hero_slides.titulo_linea_1` | text | Primera línea del título. | SALUD MENTAL | sí |
| `home_hero_slides.titulo_linea_2` | text | Segunda línea del título. | INTEGRAL PARA CADA | no |
| `home_hero_slides.titulo_linea_3` | text | Tercera línea del título, en color de acento. | ETAPA DE LA VIDA | no |
| `home_hero_slides.bajada` | textarea | Texto bajo el título. | Consultorio especializado en psiquiatría y psicología para niños, adolescentes y adultos, con atención presencial y virtual. | sí |
| `home_hero_slides.boton_texto` | text | Texto del botón de WhatsApp. | Agenda tu cita | sí |
| `home_hero_slides.boton_mensaje` | text | Mensaje que se escribe solo al abrir WhatsApp. Vacío abre el chat sin mensaje. | — | no |
| `home_hero_slides.imagen` | image | Imagen del slide, a la derecha (arriba en móvil). Se recorta para llenar el bloque. | — | sí |
| `home_hero_sello_palabra_1` | text | Primera palabra del sello giratorio. | ACOMPAÑAMOS | no |
| `home_hero_sello_palabra_2` | text | Segunda palabra del sello giratorio. | ESCUCHAMOS | no |
| `home_hero_sello_palabra_3` | text | Tercera palabra del sello giratorio. | TRANSFORMAMOS | no |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Las pestañas cambian el slide con clic y con flechas del teclado, y `aria-selected` / `tabindex` se actualizan
- [x] El avance automático se pausa con hover o foco en el botón y no corre con `prefers-reduced-motion`
- [x] Solo el primer slide tiene `h1`; los slides ocultos tienen `aria-hidden="true"`
- [x] La imagen del primer slide carga con `loading="eager"` y `fetchpriority="high"`

## Sección: cifras

- **Origen:** `html/home.html` líneas 203-223
- **Destino:** `template-parts/pages/home/cifras.php`
- **Grupo:** `home_cifras`
- **Skill:** ninguna
- **Comportamiento:** fila de cifras separadas por divisores (se apilan en móvil). Al entrar en pantalla cada valor cuenta desde 0 hasta su número en 1,8 s, conservando prefijo, sufijo y separador de miles (`+3,000`); con `prefers-reduced-motion` o sin JS se ve el valor final. JS en `src/js/modules/count-up.js` (gancho `data-lm-count`, que la plantilla llena con el mismo valor).
- **Estado:** aplicado
- **ACF:** conectado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `home_cifras_items` | repeater | Cifras de la franja, en orden (3 en el diseño) | — | sí |
| `home_cifras_items.valor` | text | Cifra tal como se muestra; puede llevar signos (+3,000). La animación cuenta hasta el número. | +3,000 | sí |
| `home_cifras_items.etiqueta` | text | Qué mide la cifra. | Pacientes atendidos | sí |
| `home_cifras_items.nota` | text | Aclaración bajo la etiqueta. | En atención presencial y online | no |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] El número final que se ve después de la animación es igual al texto del campo
- [x] Sin JS o con `prefers-reduced-motion` se muestra el valor final sin animar

## Sección: sobre

- **Origen:** `html/home.html` líneas 224-236
- **Destino:** `template-parts/pages/home/sobre.php`
- **Grupo:** `home_sobre`
- **Skill:** wp-helper
- **Comportamiento:** texto grande con una parte resaltada en otro color (marcadores del helper de texto de `wp-helper`; hoy `<span class="lm-home-sobre__highlight">`). A la derecha, abanico de 3 piezas: foto principal, foto de fondo y card con el logo blanco (`opciones_cabecera_logo_alternativo`); el abanico se abre cuando un tercio de la foto principal está en pantalla (`src/js/modules/fan.js`, gancho `data-lm-fan`) y queda abierto con `prefers-reduced-motion`. Las fotos se recortan con `aspect-ratio` 440/540 y `object-cover`.
- **Estado:** aplicado
- **ACF:** conectado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `home_sobre_etiqueta` | text | Texto pequeño sobre el párrafo. | UN EQUIPO CON ENFOQUE INTEGRAL | no |
| `home_sobre_texto` | textarea | Párrafo principal. Marca entre los marcadores del helper de texto la parte que va en color. | En Lumenti creemos que cada historia merece ser escuchada y comprendida. Por eso, te acompañamos con una atención cercana, personalizada y basada en evidencia, respetando tu proceso y avanzando contigo hacia un mayor bienestar. | sí |
| `home_sobre_imagen_principal` | image | Foto al frente del abanico. | — | sí |
| `home_sobre_imagen_secundaria` | image | Foto detrás, inclinada. | — | sí |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] La parte marcada del texto se muestra en el color de acento, como en el diseño
- [x] El abanico se abre al hacer scroll y queda abierto con `prefers-reduced-motion`

## Sección: servicios

- **Origen:** `html/home.html` líneas 237-268
- **Destino:** `template-parts/pages/home/servicios.php`
- **Grupo:** `home_servicios`
- **Skill:** wp-helper
- **Comportamiento:** 4 cards enlazadas en grilla de 2 columnas (1 en móvil), cada una con foto de fondo, ícono en recuadro y título; la descripción se despliega en hover/foco. Las dos últimas cards no llevan el degradado oscuro (`lm-home-servicios__img--wide`). La sección no tiene título visible: `aria-label="Servicios"`; los títulos de card son `h3` sin `h2` previo en el diseño, se pasan a `h2` (mismo tamaño por clase) para no saltar niveles. Alto de card `clamp(420px, 31.25vw, 600px)` (valor suelto del diseño, se conserva).
- **Estado:** aplicado
- **ACF:** conectado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `home_servicios_items` | repeater | Cards de servicios, en orden (4 en el diseño) | — | sí |
| `home_servicios_items.titulo` | text | Nombre del servicio. | PSIQUIATRÍA | sí |
| `home_servicios_items.descripcion` | text | Frase que aparece al pasar el cursor. | Evaluación, diagnóstico y tratamiento integral. | no |
| `home_servicios_items.enlace` | link | Página del servicio a la que lleva la card. | — | sí |
| `home_servicios_items.imagen` | image | Foto de fondo de la card. Se recorta para llenarla. | — | sí |
| `home_servicios_items.icono` | image | Ícono del recuadro, en SVG blanco. | — | no |
| `home_servicios_items.sin_degradado` | true_false | Quita el degradado oscuro sobre la foto (las dos últimas cards del diseño) | — | no |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Cada card es un solo `<a>` con su título como nombre accesible y la descripción se muestra también con foco de teclado
- [x] Los enlaces apuntan a las páginas de Psiquiatría, Psicología, Informes y Empresas del tema

## Sección: ayuda

- **Origen:** `html/home.html` líneas 269-293
- **Destino:** `template-parts/pages/home/ayuda.php`
- **Grupo:** `home_ayuda`
- **Skill:** ninguna
- **Comportamiento:** grilla de 16 cards de condición (nombre en mayúsculas, "Saber más" con flecha e ícono decorativo por CSS), cada una enlaza a su página de condición. Lleva `id="que-tratamos"` (ancla del menú). En móvil muestra 6 y un botón "Ver más" (`aria-expanded`, `aria-controls`) despliega el resto (`src/js/modules/ver-mas.js`, gancho `data-lm-more`; lo comparte con diario). Por ahora las cards son fijas en la plantilla; al pasar a ACF salen de la relación con el CPT `condicion` (título y enlace de cada condición). **Cards de muestra:** hasta conectar Condición, las 16 cards son de muestra (`inc/muestras/home-ayuda.php`); al conectarla se decide si salen de una relación con las condiciones.
- **Estado:** aplicado
- **ACF:** conectado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `home_ayuda_titulo` | text | Título de la sección. | ¿CÓMO PODEMOS AYUDARTE? | sí |
| `home_ayuda_bajada` | textarea | Texto bajo el título. | Brindamos orientación, evaluación, tratamiento y acompañamiento en distintas áreas de la salud mental, según la etapa de vida y situación de cada persona. | no |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] En móvil se ven 6 cards y "Ver más" muestra las demás; en escritorio el botón no aparece
- [x] Cada card enlaza a la página de su condición (`single-condicion.php`), no a `condicion.html?c=`

## Sección: diario

- **Origen:** `html/home.html` líneas 294-326
- **Destino:** `template-parts/pages/home/diario.php`
- **Grupo:** `home_diario`
- **Skill:** ninguna
- **Comportamiento:** sección oscura (`data-lm-nav-tone="dark"`). A la izquierda un marco 3:4 con una imagen por ítem; a la derecha etiqueta, título, bajada y lista de 9 ítems (título, descripción e ícono de flecha). Al pasar el cursor o el foco por un ítem cambia la imagen del marco con transición (`src/js/modules/diario.js`, ganchos `data-lm-daily-*`); solo la imagen activa tiene `alt`, las demás `aria-hidden`. Todos los ítems llevan a la página de Psicología. En móvil muestra 5 y "Ver más" despliega el resto (mismo módulo que ayuda). Esta plantilla incluye la parte `evaluaciones` dentro de su `<section>`.
- **Estado:** aplicado
- **ACF:** conectado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `home_diario_etiqueta` | text | Texto pequeño sobre el título. | ACOMPAÑAMIENTO PSICOLÓGICO | no |
| `home_diario_titulo` | textarea | Título de la sección. Cada línea es un renglón del título. | PSICOLOGÍA PARA EL DÍA A DÍA | sí |
| `home_diario_bajada` | textarea | Texto bajo el título. | No necesitas un diagnóstico para pedir apoyo. Nuestros psicólogos te acompañan en los desafíos cotidianos que afectan tu bienestar emocional. | no |
| `home_diario_enlace` | link | Página a la que llevan todos los ítems de la lista. | — | sí |
| `home_diario_items` | repeater | Temas de la lista, en orden (9 en el diseño) | — | sí |
| `home_diario_items.titulo` | text | Nombre del tema. | Regulación emocional | sí |
| `home_diario_items.descripcion` | text | Frase bajo el nombre. | Aprende a reconocer y manejar lo que sientes para vivir tu día con más calma. | sí |
| `home_diario_items.imagen` | image | Foto que aparece en el marco al pasar por el tema. Se recorta a 3:4. | — | sí |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Hover y foco de teclado en un ítem cambian la imagen del marco; sin JS se ve la primera imagen
- [x] En móvil se ven 5 ítems y "Ver más" muestra los demás

## Sección: evaluaciones

- **Origen:** `html/home.html` líneas 327-337
- **Destino:** `template-parts/pages/home/evaluaciones.php`
- **Grupo:** `home_evaluaciones`
- **Skill:** ninguna
- **Comportamiento:** no es un modal: `lm-home-diario__evaluaciones-overlay` es solo un degradado decorativo (`aria-hidden`) sobre la foto, que oscurece el lado del texto (horizontal en escritorio, vertical en móvil). Es una franja fija dentro de la sección diario: foto a la derecha (56 % del ancho, abajo-arriba en móvil), título `h3`, texto y botón que abre WhatsApp a `opciones_contacto_telefono_paciente` con el mensaje del campo, en pestaña nueva. Degradado `#242424` y alto `clamp(420px, 27.5vw, 528px)`: valores sueltos del diseño, se conservan.
- **Estado:** aplicado
- **ACF:** conectado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `home_evaluaciones_titulo` | text | Título de la franja. | EVALUACIONES PSICOLÓGICAS CON RESPALDO PROFESIONAL | sí |
| `home_evaluaciones_texto` | textarea | Texto bajo el título. | Procesos especializados para conocer aspectos emocionales, cognitivos, conductuales o vocacionales, mediante una valoración profesional e instrumentos psicológicos seleccionados según cada caso. | no |
| `home_evaluaciones_boton_texto` | text | Texto del botón de WhatsApp. | Quiero mi evaluación | sí |
| `home_evaluaciones_boton_mensaje` | text | Mensaje que se escribe solo al abrir WhatsApp. | Hola, quisiera información sobre una evaluación psicológica. | no |
| `home_evaluaciones_imagen` | image | Foto de la franja. Se recorta para llenar el lado derecho. | — | sí |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] El texto se lee sobre el degradado en escritorio y en móvil, sin tapar la foto en el lado derecho
- [x] El botón abre WhatsApp con el mensaje del campo codificado en la URL

## Sección: testimonios

- **Origen:** `html/home.html` líneas 339-460
- **Destino:** `template-parts/pages/home/testimonios.php`
- **Grupo:** `home_testimonios`
- **Skill:** ninguna
- **Comportamiento:** carrusel de testimonios (una card a la vez) con flechas Anterior/Siguiente y un punto por testimonio; se mueve con las flechas del teclado cuando el escenario tiene foco (`tabindex="0"`, `aria-roledescription="carrusel"`), las cards ocultas tienen `aria-hidden`, y sin animación con `prefers-reduced-motion`. JS en `src/js/modules/carousel.js` (ganchos `data-lm-carousel-*`). Cada card: cita (`blockquote`), estrellas doradas, nombre y fuente. Los testimonios van en el grupo de Inicio y no en opciones: hoy solo se muestran en la portada (`data/testimonios.json` dice "en el carrusel del Home"); si otra página los usa, se mueven a "Ajustes del sitio" sin cambiar los subcampos. Por ahora los 9 testimonios son fijos en la plantilla.
- **Estado:** aplicado
- **ACF:** conectado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `home_testimonios_titulo` | textarea | Título de la sección. Cada línea es un renglón del título. | LO QUE DICEN NUESTROS CLIENTES | sí |
| `home_testimonios_bajada` | textarea | Texto bajo el título. | Experiencias de personas que confiaron en nosotros para cuidar su salud mental. | no |
| `home_testimonios_items` | repeater | Testimonios del carrusel, en orden (9 en el diseño) | — | sí |
| `home_testimonios_items.texto` | textarea | Lo que dijo la persona, sin comillas (se agregan solas). | En Lumenti he encontrado profesionales muy capacitados y principalmente humanos. Me gusta que toda la coordinación es muy eficiente. | sí |
| `home_testimonios_items.nombre` | text | Nombre como se muestra (nombre e inicial). | Luz del Pilar S. | sí |
| `home_testimonios_items.fuente` | text | De dónde viene la reseña. | Google Reviews | no |
| `home_testimonios_items.estrellas` | number | Estrellas de la reseña, de 1 a 5. El diseño muestra 5 | 5 | no |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Flechas, puntos y teclado mueven el carrusel; el punto activo tiene `aria-current` o `aria-pressed`
- [x] Hay un punto por testimonio aunque cambie la cantidad
- [x] Las estrellas son decorativas (`aria-hidden`) y su número se anuncia como texto oculto ("5 de 5 estrellas")

## Sección: blog

- **Origen:** `html/home.html` líneas 461-495
- **Destino:** `template-parts/pages/home/blog.php`, `template-parts/components/blog-card.php`
- **Grupo:** `home_blog`
- **Skill:** wp-helper
- **Comportamiento:** título, bajada y botón secundario "Explora nuestro blog" a la página de entradas; debajo 4 artículos con el componente `blog-card` (imagen, categoría, título `h3`, "Leer más"). Por ahora los 4 artículos son fijos en la plantilla (los de `html/home.html`); al conectar, salen de la relación con entradas (título, enlace, imagen destacada y primera categoría de cada una). **Cards de muestra:** hasta conectar Blog, las 4 cards son de muestra (`inc/muestras/home-blog.php`); al conectarlo se decide relación o últimas entradas.
- **Estado:** aplicado
- **ACF:** conectado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `home_blog_titulo` | text | Título de la sección. | NUESTROS ARTÍCULOS PARA EL BIENESTAR | sí |
| `home_blog_bajada` | textarea | Texto bajo el título. | Artículos escritos por nuestros especialistas sobre salud mental, tratamientos y bienestar. Contenido claro, basado en evidencia y pensado para ti. | no |
| `home_blog_boton` | link | Botón al blog: texto y destino | Explora nuestro blog | no |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Las 4 cards usan `template-parts/components/blog-card.php` con `$args`, sin markup propio de card en la sección
- [x] El botón y las cards apuntan a la página de entradas y a los artículos del tema, no a `blog.html`

## Sección: cta

- **Origen:** `html/home.html` líneas 496-507
- **Destino:** `template-parts/pages/home/cta.php`, `template-parts/components/cta.php`
- **Grupo:** `home_cta`
- **Skill:** ninguna
- **Comportamiento:** usa el componente `cta`: caja con video de fondo en bucle, silenciado y decorativo (`aria-hidden`), capa oscura, sello con `icon-cerebro.svg`, título, texto y botón de WhatsApp a `opciones_contacto_telefono_paciente` en pestaña nueva. El video se reproduce solo cuando la caja está en pantalla y no se reproduce con `prefers-reduced-motion` (se ve el póster). La sección de la página solo pasa sus `$args` al componente.
- **Estado:** aplicado
- **ACF:** conectado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `home_cta_titulo` | text | Título del cierre. | DAR EL PRIMER PASO TAMBIÉN ES UNA FORMA DE CUIDARTE | sí |
| `home_cta_texto` | textarea | Texto bajo el título. | Encuentra en Lumenti una atención profesional, cercana y pensada para ti. | no |
| `home_cta_boton_texto` | text | Texto del botón de WhatsApp. | Escríbenos por WhatsApp | sí |
| `home_cta_boton_mensaje` | text | Mensaje que se escribe solo al abrir WhatsApp. Vacío abre el chat sin mensaje. | — | no |
| `home_cta_video` | file | Video de fondo en MP4, sin sonido. | — | no |
| `home_cta_poster` | image | Imagen que se ve mientras carga el video o si no se reproduce. | — | no |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] La sección llama a `template-parts/components/cta.php` con `$args`, sin copiar su markup
- [x] El video no se reproduce con `prefers-reduced-motion` y no tiene controles ni sonido
