---
paths:
  - "template-parts/sections/home/ayuda.php"
  - "src/css/sections/home/ayuda.css"
  - "acf-json/group_lumenti_inicio_ayuda.json"
  - "acf-json/group_lumenti_area.json"
  - "inc/condiciones.php"
  - "inc/crear-condiciones.php"
---

# Home · Cómo podemos ayudarte (condiciones)

- Condiciones = CPT `condicion` (`/condiciones/<slug>/`, título + imagen destacada + Orden) con taxonomía `area` (casillas; orden de columnas en el campo "Orden", grupo "Áreas"). Registro y helpers en `inc/condiciones.php`: `lumenti_condiciones_por_area()` (sin área → grupo "Otras condiciones"). `/condiciones/` redirige a `/#que-tratamos`.
- `inc/crear-condiciones.php` crea las 3 áreas y las 16 condiciones del prototipo (orden del navbar en `menu_order`), llena el orden de la portada si está vacío y pasa el "Qué tratamos" manual del menú a automático. Una vez (opción `lumenti_condiciones_creadas`); no pisa nada existente.
- Campos: grupo "Inicio · Cómo podemos ayudarte": `ayuda_titulo` (`h2`), `ayuda_texto`, `ayuda_condiciones` (relationship, orden arrastrando; vacío = todas por `menu_order`), `ayuda_icono` (máscara con el color del texto; vacío = `assets/icons/trastorno.svg`), `ayuda_saber_mas`. Sin condiciones publicadas, no se imprime.
- `id="que-tratamos"` en la sección (ancla del footer y de la redirección), con `scroll-mt-24`.
- Tarjeta: con mouse el nombre va centrado y al pasar/enfocar sube, aparece "Saber más" y un círculo `primario` la rellena; en táctil ya está abierta. 2 columnas, 3 desde 1100 px.
- Celular: "Ver más" con el módulo común `ver-mas.js` (`data-inicial="6" data-paso="6"`), botón `btn btn-tonal`.
