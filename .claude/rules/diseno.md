---
paths:
  - "src/css/**"
  - "**/*.php"
---

# Diseño: tokens y componentes (Tailwind 4)

- CSS en `src/css/`: `input.css` (solo imports), `fonts.css`, `theme.css` (tokens `@theme`), `base.css` (`@layer base`), `components.css` (`@utility`), `sections/<página>/<sección>.css` (estilos propios de una sección).
- Las paletas y escalas por defecto de Tailwind están desactivadas (colores, `text-*`, sombras, breakpoints). Usa solo los tokens de `theme.css`; no escribas hex ni px arbitrarios (`bg-[#…]`, `text-[22px]`) si existe un token. Una variable nueva y reutilizable va en `theme.css`.
- Breakpoints: `md` 768 (tablet), `lg` 1024 (desktop de páginas), `xl` 1200 (nav, footer, grillas de 3–4 columnas).
- Fuentes: `font-sans` (DM Sans 400/500/600, por defecto) y `font-titulo` (Abenda, solo 400). `h1`–`h6` ya salen en Abenda y color `titulo`.
- Tipografía: un solo rol por texto, ya responsivo; no agregues `md:`/`lg:` de tamaño.
  - Títulos: `text-display-1` (H1 hero), `text-display-2` (H1 de listados: Blog, Legal, Especialistas), `text-h1-detalle` (H1 de artículo, especialista, 404), `text-h2` (sección), `text-h3`, `text-h4`, `text-titulo-lg|md|sm|xs` (cards).
  - Texto: `text-statement`, `text-lead` (intro), `text-body-lg` (artículo), `text-body` (16), `text-sm` (15), `text-caption` (14), `text-micro` (13), `text-overline` (13, mayúsculas), `text-badge` (11), `text-quote`, `text-stat`. Textos largos: `leading-prosa`.
- Colores: fondos `fondo`, `fondo-alt`, `fondo-suave`; texto `titulo` (títulos), `ui` (nav, labels, breadcrumb actual), `cuerpo` (párrafos), `cuerpo-2` (secundario), `tenue` (meta), `sutil`; marca `primario` (+ `-50` `-200` `-400` `-600` `-700` `-800` `-900`); sobre oscuro `inverso`, `inverso-2`; bordes `borde`, `divisor`, `borde-frio`; acento `dorado`, `cafe`, `dorado-bg`, `dorado-texto`; estados `error`, `error-inverso`, `valido`.
- Espaciado: `py-seccion-sm|seccion|seccion-lg|seccion-xl` (padding vertical de sección), `px-gutter` (margen lateral), `px-gutter-nav`, `h-nav` / `top-nav` (alto de la navbar). Anchos: `max-w-site` (1600), `-prosa`, `-titulo`, `-lead`, `-texto`, `-corto`.
- Radios: `rounded-sm` (chips, inputs), `rounded-md` (cards, imágenes), `rounded-lg` (botones), `rounded-full` (píldoras, círculos). Sombras: `shadow-sm|md|lg|flotante`. Foco de campos: `ring-3 ring-primario/12`.
- Movimiento: `ease-suave` (por defecto), `ease-desliza`, `ease-cortina`; `animate-subir` (texto dentro de una línea con `overflow-hidden`), `animate-aparecer`, `animate-nav-entra`, `animate-revelar`, `animate-pop`, `animate-girar`, `animate-llenar`. Respeta `prefers-reduced-motion` (ya lo hace `base.css`).
- Componentes: `contenedor` (1600 + gutter), `btn` + `btn-primario|tonal|neutro|inverso` y `btn-sm` (alto mínimo, el texto largo salta de línea), `eyebrow` (con `text-primario` o `text-inverso-2`), `chip` + `chip-dorado|neutro`, `campo` (input/select/textarea, error con `aria-invalid="true"`), `icono-tile` (+ `icono-tile-claro`).
- Textos que escribe la clienta: nunca `whitespace-nowrap` en títulos o botones; deben poder saltar de línea.
