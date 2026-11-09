<?php
defined('ABSPATH') || exit;

/*
 * Etiquetas de campos más claras que las que arma wp-acf (que las saca del nombre: "Teléfono citas").
 * Código propio del proyecto: no toca la skill ni el JSON generado; solo cambia el texto que ve el cliente en el
 * admin. Renombrar los campos perdería los valores guardados, por eso se cambia la etiqueta y no el nombre.
 *
 * Ajustes del sitio → Contacto (specs/opciones.md): cada teléfono del pie con su mensaje ("Central de citas", que es
 * el WhatsApp principal del sitio, "Atención al paciente", "Empresas"), el correo y la dirección.
 */

// Nombre completo del campo (el de la tabla del spec) => etiqueta. La clave ACF sale de ese nombre (lumenti_acf_key).
function lumenti_campos_etiquetas(): array
{
    return [
        'opciones_contacto_telefono_citas'       => __('Central de citas (WhatsApp principal): número', 'lumenti'),
        'opciones_contacto_mensaje_citas'        => __('Central de citas (WhatsApp principal): mensaje', 'lumenti'),
        'opciones_contacto_telefono_paciente'    => __('Atención al paciente: número', 'lumenti'),
        'opciones_contacto_mensaje_paciente'     => __('Atención al paciente: mensaje', 'lumenti'),
        'opciones_contacto_telefono_corporativo' => __('Empresas: número', 'lumenti'),
        'opciones_contacto_mensaje_corporativo'  => __('Empresas: mensaje', 'lumenti'),
        'opciones_contacto_correo'               => __('Correo de contacto', 'lumenti'),
        'opciones_contacto_direccion'            => __('Dirección del consultorio', 'lumenti'),
    ];
}

add_action('acf/init', function () {
    if (!function_exists('lumenti_acf_key')) {
        return;
    }
    foreach (lumenti_campos_etiquetas() as $nombre => $etiqueta) {
        add_filter('acf/load_field/key=' . lumenti_acf_key($nombre), static function (array $field) use ($etiqueta): array {
            $field['label'] = $etiqueta;
            return $field;
        });
    }
});
