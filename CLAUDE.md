# Lumenti — tema WordPress

Stack: WordPress (Local WP) + Vite + Tailwind + pnpm.

## Paquetes (pnpm)
- Usa solo `pnpm`. Nunca `npm`, `yarn` ni `npx`; para ejecutar un paquete usa `pnpm dlx`.
- No bajes `minimumReleaseAge` en `pnpm-workspace.yaml`.
- No apruebes `allowBuilds` sin revisar antes el paquete y avisarme.

## PHP
- Empieza el nombre de toda función, hook y constante con el prefijo `lumenti_`. El text domain es `lumenti`.
- En `functions.php` solo escribe `require_once` de archivos de `inc/`.
- Pon el código nuevo en un archivo nuevo de `inc/`, y agrégalo a `functions.php`.
- Empieza todo archivo de `inc/` con `defined('ABSPATH') || exit;`.
- Escapa toda salida con `esc_html`, `esc_url` o `esc_attr`.
- Los grupos de campos ACF se manejan con **JSON sincronizado**: viven en `acf-json/` (uno por grupo) y se editan en ACF → Grupos de campos, que reescribe el JSON al guardar. No los registres por PHP (`acf_add_local_field_group`) ni crees `acf.php`. No crees grupos nuevos por iniciativa propia: pregúntame antes.
- Un JSON nuevo o modificado por código aparece en ACF → Grupos de campos como "Sincronización disponible": hay que sincronizarlo antes de editarlo en el admin.

## Páginas
- La portada es `front-page.php`: WordPress la usa sola para la página "Inicio" (fijada en Ajustes → Lectura). No tiene `Template Name` ni se elige en el admin. El tema crea "Inicio" al activarse (`inc/crear-inicio.php`).
- Crea cada otra página con diseño propio como `pages/template-<nombre>.php`, con `Template Name:` en la cabecera.
- Llama una sola vez a `get_header()` y a `get_footer()` en cada plantilla, y pon el contenido dentro de `<main id="main-content">`.
- Pon las secciones reutilizables en `template-parts/sections/`.

## Tailwind
- No agregues `@source`: Tailwind detecta las clases solo. Agrégalo únicamente si una ruta no se detecta.

## Diseño (tokens)
- CSS en `src/css/`: `input.css` (solo imports), `fonts.css`, `theme.css` (tokens `@theme`), `base.css` (`@layer base`), `components.css` (`@utility`).
- Las paletas y escalas por defecto de Tailwind están desactivadas (colores, `text-*`, sombras, breakpoints). Usa solo los tokens de `theme.css`; no escribas hex ni px arbitrarios (`bg-[#…]`, `text-[22px]`) si existe un token. Una variable nueva y reutilizable va en `theme.css`.
- Breakpoints: `md` 768 (tablet), `lg` 1024 (desktop de páginas), `xl` 1200 (nav, footer, grillas de 3–4 columnas).
- Fuentes: `font-sans` (DM Sans 400/500/600, por defecto) y `font-titulo` (Abenda, solo 400). `h1`–`h6` ya salen en Abenda y color `titulo`.
- Tipografía: un solo rol por texto, ya responsivo; no agregues `md:`/`lg:` de tamaño.
  - Títulos: `text-display-1` (H1 hero), `text-display-2` (H1 de listados: Blog, Legal, Especialistas), `text-h1-detalle` (H1 de artículo, especialista, 404), `text-h2` (sección), `text-h3`, `text-h4`, `text-titulo-lg|md|sm|xs` (cards).
  - Texto: `text-statement`, `text-lead` (intro), `text-body-lg` (artículo), `text-body` (16), `text-sm` (15), `text-caption` (14), `text-micro` (13), `text-overline` (13, mayúsculas), `text-badge` (11), `text-quote`, `text-stat`. Textos largos: `leading-prosa`.
- Colores: fondos `fondo`, `fondo-alt`, `fondo-suave`; texto `titulo` (títulos), `ui` (nav, labels, breadcrumb actual), `cuerpo` (párrafos), `cuerpo-2` (secundario), `tenue` (meta), `sutil`; marca `primario` (+ `-50` `-200` `-400` `-600` `-700` `-800` `-900`); sobre oscuro `inverso`, `inverso-2`; bordes `borde`, `divisor`, `borde-frio`; acento `dorado`, `cafe`, `dorado-bg`, `dorado-texto`; estados `error`, `error-inverso`, `valido`.
- Espaciado: `py-seccion-sm|seccion|seccion-lg|seccion-xl` (padding vertical de sección), `px-gutter` (margen lateral), `px-gutter-nav`, `h-nav` / `top-nav` (alto de la navbar). Anchos: `max-w-site` (1600), `-prosa`, `-titulo`, `-lead`, `-texto`, `-corto`.
- Radios: `rounded-sm` (chips, inputs), `rounded-md` (cards, imágenes), `rounded-lg` (botones), `rounded-full` (píldoras, círculos). Sombras: `shadow-sm|md|lg|flotante`. Foco de campos: `ring-3 ring-primario/12`.
- Movimiento: `ease-suave` (por defecto), `ease-desliza`, `ease-cortina`; `animate-subir` (texto dentro de una línea con `overflow-hidden`), `animate-aparecer`, `animate-nav-entra`. Respeta `prefers-reduced-motion` (ya lo hace `base.css`).
- Componentes: `contenedor` (1600 + gutter), `btn` + `btn-primario|tonal|neutro|inverso` y `btn-sm`, `eyebrow` (con `text-primario` o `text-inverso-2`), `chip` + `chip-dorado|neutro`, `campo` (input/select/textarea, error con `aria-invalid="true"`).

## Header, footer y datos globales
- Menús (Apariencia → Menús): `primary` (navbar), `footer-servicios`, `footer-explora`, `legal`. En `primary`, un ítem con hijos abre un mega menú: hijos sin nietos = tarjetas (imagen destacada de la página enlazada + "Descripción" del ítem); hijos con nietos = columnas. Árbol: `lumenti_menu_arbol()` (`inc/menu.php`).
- Datos globales en la página de ACF Pro "Ajustes del sitio": la página se registra en `inc/ajustes.php` y sus campos están en `acf-json/group_lumenti_ajustes.json`. Léelos con `lumenti_ajuste()`, `lumenti_whatsapp_url()`, `lumenti_redes()`; nunca con `get_field()` directo en las vistas. Sin ACF devuelven vacío y el elemento no se imprime.
- Íconos: SVG en `assets/icons/` (fuera de `src/`, se suben al servidor), impresos con `lumenti_icon('nombre', 'size-5')`.
- El botón flotante de WhatsApp se desactiva por plantilla con `add_filter('lumenti_mostrar_fab', '__return_false')`.

## Comandos
- `pnpm dev`: inicia Vite con HMR (crea `hot` y lo borra al detenerse).
- `pnpm build`: genera `dist/` y `manifest.json`.

## Deploy
- No commitees `dist/` (está en `.gitignore`).
- Para publicar, detén el dev server, corre `pnpm build` y sube `dist/` más los PHP modificados, `acf-json/` y `assets/`.
- No subas al servidor `hot`, `node_modules/`, `src/` ni archivos de config (`package.json`, `pnpm-*`, `vite.config.ts`, `CLAUDE.md`).

<!-- wp-helper:start -->
## Helpers (wp-helper 1.1.0)
- Los helpers viven en `inc/helpers/` y se cargan con `require_once` desde `functions.php`. No edites los archivos del motor: se actualizan desde la skill wp-helper.
- Un helper propio de este proyecto va en `inc/helpers/<nombre>.php` con el prefijo `lumenti_`, y también se carga desde `functions.php`.
- Toda imagen de un campo ACF pasa por `lumenti_image($campo, [...])` (devuelve el `<img>` o `''`) o por `lumenti_image_data($campo)` (`url`, `alt`, `width`, `height` o `null`). No uses `$campo['url']` ni `wp_get_attachment_image_url()` directo en las vistas. Usa `'loading' => 'eager'` en la imagen principal de la página.
- Un texto con partes de otro color se imprime con `lumenti_highlight($texto)`; ya sale escapado. Los marcadores y sus clases están en `inc/helpers/text-styles.php`: para sumar un estilo corre `install.mjs --add-style` de la skill wp-helper, no lo edites a mano.
- Todo enlace de un campo ACF (Link o URL) pasa por `lumenti_link($campo, [...])` (el `<a>` completo) o por `<a<?= lumenti_link_attrs($campo, [...]) ?>>` cuando el diseño lleva íconos u otros hijos. No escribas `target="_blank"`, `rel` ni `$campo['url']` a mano: el helper pone `rel`, descarta enlaces vacíos o inseguros y avisa de la pestaña nueva (clase `sr-only`).
<!-- wp-helper:end -->
