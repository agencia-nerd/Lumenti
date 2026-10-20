---
paths:
  - "template-parts/sections/home/metricas.php"
  - "acf-json/group_lumenti_inicio_metricas.json"
---

# Home · Métricas

- Campos: grupo "Inicio · Métricas" (`acf-json/group_lumenti_inicio_metricas.json`): repetidor `metricas_cifras` (`numero`, `titulo`, `texto`).
- El número se escribe tal cual se ve (`+3,000`, `98%`); lleva `data-contador` + `aria-hidden` y el valor final en un `sr-only`. Cifras sin número no se muestran; sin cifras, no se imprime la sección.
- Divisores entre cifras: línea corta horizontal en celular, vertical desde `md`.
