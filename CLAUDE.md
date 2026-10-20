# Lumenti — tema WordPress

Stack: WordPress (Local WP) + Vite + Tailwind + pnpm + ACF Pro.

Reglas por tema en `.claude/rules/` (cada una se carga sola al tocar sus archivos): `diseno.md` (tokens y componentes CSS), `acf.md` (grupos y ayudas de campos), `secciones.md` (estructura de páginas y secciones), `home/` (portada: `000-home.md` general + un archivo por sección numerado en el orden de la página, ej. `010-hero.md`), `cta.md` (componente CTA final), `header-footer.md` (menús y Ajustes del sitio), `animaciones.md` (JS reutilizable).

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
- El contenido lo carga una clienta sin conocimientos técnicos: toda vista debe aguantar campos vacíos, textos largos, HTML pegado y enlaces mal escritos sin romperse ni desbordar la pantalla.

## Tailwind
- No agregues `@source`: Tailwind detecta las clases solo. Agrégalo únicamente si una ruta no se detecta.

## Comandos
- `pnpm dev`: inicia Vite con HMR (crea `hot` y lo borra al detenerse).
- `pnpm build`: genera `dist/` y `manifest.json`.

## Deploy
- No commitees `dist/` (está en `.gitignore`).
- Para publicar, detén el dev server, corre `pnpm build` y sube `dist/` más los PHP modificados, `acf-json/` y `assets/`.
- No subas al servidor `hot`, `node_modules/`, `src/`, `.claude/` ni archivos de config (`package.json`, `pnpm-*`, `vite.config.ts`, `CLAUDE.md`).

<!-- wp-helper:start -->
## Helpers (wp-helper 1.1.0)
- Los helpers viven en `inc/helpers/` y se cargan con `require_once` desde `functions.php`. No edites los archivos del motor: se actualizan desde la skill wp-helper.
- Un helper propio de este proyecto va en `inc/helpers/<nombre>.php` con el prefijo `lumenti_`, y también se carga desde `functions.php`.
- Toda imagen de un campo ACF pasa por `lumenti_image($campo, [...])` (devuelve el `<img>` o `''`) o por `lumenti_image_data($campo)` (`url`, `alt`, `width`, `height` o `null`). No uses `$campo['url']` ni `wp_get_attachment_image_url()` directo en las vistas. Usa `'loading' => 'eager'` en la imagen principal de la página.
- Un texto con partes de otro color se imprime con `lumenti_highlight($texto)`; ya sale escapado. Los marcadores y sus clases están en `inc/helpers/text-styles.php`: para sumar un estilo corre `install.mjs --add-style` de la skill wp-helper, no lo edites a mano.
- Todo enlace de un campo ACF (Link o URL) pasa por `lumenti_link($campo, [...])` (el `<a>` completo) o por `<a<?= lumenti_link_attrs($campo, [...]) ?>>` cuando el diseño lleva íconos u otros hijos. No escribas `target="_blank"`, `rel` ni `$campo['url']` a mano: el helper pone `rel`, descarta enlaces vacíos o inseguros y avisa de la pestaña nueva (clase `sr-only`).
<!-- wp-helper:end -->
