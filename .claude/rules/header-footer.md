---
paths:
  - "header.php"
  - "footer.php"
  - "template-parts/header/**"
  - "template-parts/footer/**"
  - "inc/menu.php"
  - "inc/ajustes.php"
  - "inc/crear-menus.php"
  - "inc/setup.php"
  - "src/js/header.js"
---

# Header, footer y datos globales

- Menús (Apariencia → Menús): `primary` (navbar), `footer-servicios`, `footer-explora`, `legal`. En `primary`, un ítem con hijos abre un mega menú: hijos sin nietos = tarjetas (imagen destacada de la página enlazada + "Descripción" del ítem); hijos con nietos = columnas. Árbol: `lumenti_menu_arbol()` (`inc/menu.php`). "Qué tratamos" es automático: un ítem del archivo de Condiciones (Menús → Condiciones) cuyas columnas son las áreas y sus enlaces las condiciones (`lumenti_menu_condiciones()`, `inc/condiciones.php`); no se le cargan hijos a mano. El nombre de cada menú del footer es el título de su columna.
- Datos globales en la página de ACF Pro "Ajustes del sitio": la página se registra en `inc/ajustes.php` y sus campos están en `acf-json/group_lumenti_ajustes.json`. Léelos con `lumenti_ajuste()`, `lumenti_whatsapp_url()`, `lumenti_redes()`; nunca con `get_field()` directo en las vistas. Sin ACF devuelven vacío y el elemento no se imprime.
- `lumenti_whatsapp_url()` acepta el número escrito de cualquier forma y antepone 51 a un celular peruano de 9 dígitos. `lumenti_redes()` saca el ícono del dominio del enlace (corrige la red mal elegida) y descarta enlaces sin dominio.
- Logo de la navbar: Personalizar → Identidad del sitio (`custom-logo`). Logo blanco del footer: Ajustes del sitio.
- Íconos: SVG en `assets/icons/` (fuera de `src/`, se suben al servidor), impresos con `lumenti_icon('nombre', 'size-5')`.
- El botón flotante de WhatsApp se desactiva por plantilla con `add_filter('lumenti_mostrar_fab', '__return_false')`.
- Footer: 2 columnas hasta 1439 px y las 4 del diseño desde 1440 (`min-[90rem]:`).
