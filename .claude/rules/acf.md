---
paths:
  - "acf-json/**"
  - "inc/ajustes.php"
---

# Campos ACF

- Los grupos se manejan con **JSON sincronizado**: viven en `acf-json/` (uno por grupo) y se editan en ACF → Grupos de campos, que reescribe el JSON al guardar. No los registres por PHP (`acf_add_local_field_group`) ni crees `acf.php`. No crees grupos nuevos por iniciativa propia: pregúntame antes.
- Un JSON nuevo o modificado por código aparece en ACF → Grupos de campos como "Sincronización disponible": hay que sincronizarlo antes de editarlo en el admin. Si lo editas por código, sube `modified` (timestamp actual) y conserva `key` y `name` de los campos, para no perder lo ya cargado.
- Un grupo por sección de página, titulado "<Página> · <Sección>" (ej. "Inicio · Hero"), sin pestañas, con `menu_order` según el orden visual. "Ajustes del sitio" es la excepción: datos globales con pestañas.
- Ayudas de los campos: una línea, clara y directa (ej. "Ej.: Integral"). Sin máximos de caracteres y sin límites de imagen (formato, medidas o peso), ni en el campo ni en el texto. Si el texto usa un helper (`*asteriscos*` = verde), se menciona de forma breve.
- Repetidores: layout `row`, sin `collapsed`; numeración y orden automáticos (se arrastran).
- Etiquetas simples para una clienta sin conocimientos técnicos ("Título", "Texto", "Botón", "Foto").
