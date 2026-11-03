<?php
defined('ABSPATH') || exit;

/*
 * Carga inicial propia de Lumenti, lo que el motor de wp-acf (inc/acf/runner.php) no cubre:
 * - Las dos páginas legales (una plantilla, dos páginas) y la página de entradas del blog.
 * - Especialistas (después de su carga de wp-acf): la foto destacada (assets/img/esp/<id>.webp). La URL y los
 *   slugs de los términos los arma WordPress (con el nombre completo y el nombre del término).
 * - Términos y condiciones: su documento ('terminos' de inc/acf/seed/politica-de-privacidad.php); Privacidad
 *   la carga wp-acf.
 * - Condiciones (después de su carga de wp-acf): el slug de cada una (/condicion/<id>/) y su término de que_trata
 *   (campo condicion_especialistas_que_trata de inc/campos-extra.php), desde inc/acf/seed/condicion.php.
 * - Blog (después de su carga de wp-acf): los enlaces /blog/<slug>/ y /blog/categoria/<tema>/ (inc/blog.php), el
 *   slug y la imagen destacada de cada artículo (assets/img/blog/<id>.webp), el artículo destacado del blog y los
 *   4 artículos del Inicio del diseño (campos de inc/campos-extra.php).
 * - Mensajes de WhatsApp de Ajustes del sitio → Contacto, copiados una vez desde el campo anterior de Cabecera.
 * - Mega menú Servicios: la "Descripción" de cada elemento del menú `servicios` (bajada de la card) y la
 *   imagen destacada de cada página de servicio (imagen de la card).
 * Corre una vez por paso (marcador en opciones), después de la carga de wp-acf: nunca pisa lo editado.
 */

const LUMENTI_CARGA_EXTRA_MARCADOR = 'lumenti_carga_extra';

const LUMENTI_SERVICIOS_MEGA = [
    'psiquiatria' => ['descripcion' => 'Evaluación, diagnóstico y tratamiento integral.', 'imagen' => 'assets/img/mm-psiquiatria.webp'],
    'psicologia'  => ['descripcion' => 'Psicoterapia y evaluaciones psicológicas basadas en evidencia.', 'imagen' => 'assets/img/mm-psicologia.webp'],
    'empresas'    => ['descripcion' => 'Talleres y programas de salud mental para organizaciones.', 'imagen' => 'assets/img/mm-empresas.webp'],
    'informes-y-certificados' => ['descripcion' => 'Documentos clínicos elaborados previa evaluación profesional.', 'imagen' => 'assets/img/mm-informes.webp'],
];

// Crea una página si no existe (por slug) y devuelve su ID.
function lumenti_carga_pagina(string $slug, string $titulo, string $plantilla = ''): int
{
    $page = get_page_by_path($slug);
    if ($page) {
        return (int) $page->ID;
    }
    $id = wp_insert_post(['post_type' => 'page', 'post_status' => 'publish', 'post_title' => $titulo, 'post_name' => $slug], true);
    if (is_wp_error($id)) {
        return 0;
    }
    if ($plantilla !== '') {
        update_post_meta($id, '_wp_page_template', $plantilla);
    }

    return (int) $id;
}

function lumenti_carga_extra(): void
{
    $hecho = (array) get_option(LUMENTI_CARGA_EXTRA_MARCADOR, []);

    if (empty($hecho['paginas'])) {
        lumenti_carga_pagina('politica-de-privacidad', 'Política de privacidad', 'pages/template-legal.php');
        lumenti_carga_pagina('terminos-y-condiciones', 'Términos y condiciones', 'pages/template-legal.php');
        $blog = lumenti_carga_pagina('blog', 'Blog');
        if ($blog && !get_option('page_for_posts')) {
            update_option('page_for_posts', $blog);
        }
        $hecho['paginas'] = 1;
    }

    // Necesita las páginas y el menú que crea wp-acf: si aún no están, se reintenta en la próxima visita al admin.
    $ubicaciones = get_nav_menu_locations();
    if (empty($hecho['servicios']) && !empty($ubicaciones['servicios']) && function_exists('lumenti_acf_attachment')) {
        $items = wp_get_nav_menu_items((int) $ubicaciones['servicios']) ?: [];
        foreach (LUMENTI_SERVICIOS_MEGA as $slug => $datos) {
            $page = get_page_by_path($slug);
            if (!$page) {
                continue;
            }
            if (!has_post_thumbnail($page)) {
                $imagen = lumenti_acf_attachment($datos['imagen']);
                if ($imagen) {
                    set_post_thumbnail($page, $imagen);
                }
            }
            foreach ($items as $item) {
                if ((int) $item->object_id === (int) $page->ID && trim((string) $item->description) === '') {
                    wp_update_post(['ID' => $item->ID, 'post_content' => $datos['descripcion']]);
                }
            }
        }
        $hecho['servicios'] = 1;
    }

    if (empty($hecho['especialistas'])) {
        $hecho['especialistas'] = lumenti_carga_especialistas() ? 1 : 0;
    }

    if (empty($hecho['terminos'])) {
        $hecho['terminos'] = lumenti_carga_terminos() ? 1 : 0;
    }

    if (empty($hecho['condiciones'])) {
        $hecho['condiciones'] = lumenti_carga_condiciones() ? 1 : 0;
    }

    if (empty($hecho['enlaces'])) {
        lumenti_blog_enlaces();
        $hecho['enlaces'] = 1;
    }

    if (empty($hecho['blog'])) {
        $hecho['blog'] = lumenti_carga_blog() ? 1 : 0;
    }

    if (empty($hecho['referencias'])) {
        $hecho['referencias'] = lumenti_carga_referencias() ? 1 : 0;
    }

    if (empty($hecho['whatsapp'])) {
        $hecho['whatsapp'] = lumenti_carga_whatsapp() ? 1 : 0;
    }

    update_option(LUMENTI_CARGA_EXTRA_MARCADOR, $hecho, false);
}

/*
 * Términos y condiciones (specs/politica-de-privacidad.md): usa la plantilla y el grupo de Política de privacidad.
 * wp-acf solo carga Privacidad (su página); aquí 'terminos' de inc/acf/seed/politica-de-privacidad.php va a
 * /terminos-y-condiciones/ con la función de carga del motor (marca por página y grupo: nunca pisa lo editado).
 * Devuelve false si aún falta algo (se reintenta en la próxima visita al admin).
 */
function lumenti_carga_terminos(): bool
{
    $page = get_page_by_path('terminos-y-condiciones');
    if (!$page || !function_exists('lumenti_acf_seed_fields') || !function_exists('update_field')) {
        return false;
    }
    $seed = require get_theme_file_path('inc/acf/seed/politica-de-privacidad.php');
    lumenti_acf_seed_fields((array) ($seed['terminos'] ?? []), (int) $page->ID, []);
    return true;
}

// Foto destacada de los especialistas que creó la carga de wp-acf, solo si aún no tienen una (no pisa lo editado).
// Devuelve false si aún no están (se reintenta en la próxima visita al admin).
function lumenti_carga_especialistas(): bool
{
    if (!post_type_exists('especialista') || !function_exists('lumenti_acf_attachment')) {
        return false;
    }
    $posts = get_posts([
        'post_type'      => 'especialista',
        'post_status'    => 'any',
        'posts_per_page' => -1,
        'meta_key'       => '_lumenti_seed_id',
    ]);
    if (!$posts) {
        return false;
    }

    foreach ($posts as $post) {
        $id = sanitize_title((string) get_post_meta($post->ID, '_lumenti_seed_id', true));
        if ($id === '') {
            continue;
        }
        if (!has_post_thumbnail($post)) {
            $foto = lumenti_acf_attachment('assets/img/esp/' . $id . '.webp');
            if ($foto) {
                set_post_thumbnail($post, $foto);
            }
        }
    }

    return true;
}
/*
 * Condiciones que creó la carga de wp-acf: el slug del post es su id ('depresion' → /condicion/depresion/; WordPress
 * lo armaría con el título) y su término de que_trata es el 'que_trata' del seed. Corre una sola vez y cada
 * valor solo se pone si está vacío o es el que puso WordPress: no pisa lo editado.
 * Devuelve false si aún faltan las condiciones o los términos (se reintenta en la próxima visita al admin).
 */
function lumenti_carga_condiciones(): bool
{
    if (!post_type_exists('condicion') || !function_exists('update_field') || !function_exists('lumenti_acf_key')) {
        return false;
    }
    $seed = require get_theme_file_path('inc/acf/seed/condicion.php');
    $listo = true;

    foreach ((array) ($seed['items'] ?? []) as $item) {
        $id = sanitize_title((string) ($item['id'] ?? ''));
        $posts = $id === '' ? [] : get_posts([
            'post_type'      => 'condicion',
            'post_status'    => 'any',
            'posts_per_page' => 1,
            'meta_key'       => '_lumenti_seed_id',
            'meta_value'     => $id,
        ]);
        if (!$posts) {
            $listo = false;
            continue;
        }
        $post = $posts[0];

        if ($post->post_name !== $id && $post->post_name === sanitize_title($post->post_title)) {
            wp_update_post(['ID' => $post->ID, 'post_name' => $id]);
        }

        if (!lumenti_condicion_termino($post)) {
            $term = get_term_by('name', (string) ($item['que_trata'] ?? ''), 'que_trata');
            if ($term) {
                // Por el campo grupo (clave del JSON): así se guarda como condicion_especialistas_que_trata.
                update_field(lumenti_acf_key('condicion_especialistas'), ['que_trata' => (int) $term->term_id], $post->ID);
            } else {
                $listo = false;
            }
        }
    }

    return $listo;
}

// Artículos del Inicio en el diseño (home.html), por su id.
const LUMENTI_BLOG_INICIO = ['antidepresivo-para-toda-la-vida', 'como-se-diagnostica-el-tdah', 'tratamiento-trastorno-limite-de-la-personalidad', 'ansiedad-en-ninos'];
const LUMENTI_BLOG_DESTACADO = 'tratamiento-trastorno-limite-de-la-personalidad';

/*
 * Artículos que creó la carga de wp-acf (inc/acf/seed/articulo.php): slug = id (WordPress lo armaría con el título) e
 * imagen destacada; luego el destacado del blog y los artículos del Inicio, cada uno solo si está vacío.
 * Devuelve false si aún faltan los artículos (se reintenta en la próxima visita al admin).
 */
function lumenti_carga_blog(): bool
{
    if (!function_exists('update_field') || !function_exists('lumenti_acf_attachment') || !function_exists('lumenti_acf_key')) {
        return false;
    }
    $seed = require get_theme_file_path('inc/acf/seed/articulo.php');
    $ids = [];

    foreach ((array) ($seed['items'] ?? []) as $item) {
        $id = sanitize_title((string) ($item['id'] ?? ''));
        $posts = $id === '' ? [] : get_posts([
            'post_type'      => 'post',
            'post_status'    => 'any',
            'posts_per_page' => 1,
            'meta_key'       => '_lumenti_seed_id',
            'meta_value'     => $id,
        ]);
        if (!$posts) {
            return false;
        }
        $post = $posts[0];
        $ids[$id] = (int) $post->ID;

        if ($post->post_name !== $id && $post->post_name === sanitize_title($post->post_title)) {
            wp_update_post(['ID' => $post->ID, 'post_name' => $id]);
        }
        if (!has_post_thumbnail($post)) {
            $imagen = lumenti_acf_attachment('assets/img/blog/' . $id . '.webp');
            if ($imagen) {
                set_post_thumbnail($post, $imagen);
            }
        }
    }

    // Por el campo grupo (clave del JSON), así se guardan como blog_destacado_articulo / home_blog_seleccion.
    $destacado = (array) (get_field('blog_destacado', 'option') ?: []);
    if (empty($destacado['articulo']) && isset($ids[LUMENTI_BLOG_DESTACADO])) {
        update_field(lumenti_acf_key('blog_destacado'), array_merge($destacado, ['articulo' => $ids[LUMENTI_BLOG_DESTACADO]]), 'option');
    }
    $inicio = (int) get_option('page_on_front');
    $home = $inicio ? (array) (get_field('home_blog', $inicio) ?: []) : [];
    if ($inicio && empty($home['seleccion'])) {
        $seleccion = array_values(array_filter(array_map(static fn($i) => $ids[$i] ?? 0, LUMENTI_BLOG_INICIO)));
        update_field(lumenti_acf_key('home_blog'), array_merge($home, ['seleccion' => $seleccion]), $inicio);
    }

    return true;
}

/*
 * Referencias de los artículos (2026-11-03): antes eran un párrafo con la clase lm-article__ref dentro del contenido;
 * ahora son el campo articulo_contenido_referencias (lo carga wp-acf desde inc/acf/seed/articulo.php). En las
 * entradas ya cargadas se quita ese párrafo del contenido para que no salga dos veces; si el campo está vacío, el
 * texto pasa al campo. Corre una sola vez.
 */
function lumenti_carga_referencias(): bool
{
    if (!function_exists('update_field') || !function_exists('lumenti_acf_key')) {
        return false;
    }
    $patron = '#\s*<!-- wp:paragraph \{"className":"lm-article__ref"\} -->\s*<p class="lm-article__ref">(.*?)</p>\s*<!-- /wp:paragraph -->#s';
    $posts = get_posts(['post_type' => 'post', 'post_status' => 'any', 'posts_per_page' => -1, 's' => 'lm-article__ref']);
    foreach ($posts as $post) {
        if (!preg_match_all($patron, (string) $post->post_content, $m)) {
            continue;
        }
        $grupo = (array) (get_field('articulo_contenido', $post->ID) ?: []);
        if (trim((string) ($grupo['referencias'] ?? '')) === '') {
            $texto = implode("\n", array_map(static fn($t) => html_entity_decode(wp_strip_all_tags($t), ENT_QUOTES | ENT_HTML5, 'UTF-8'), $m[1]));
            update_field(lumenti_acf_key('articulo_contenido'), array_merge($grupo, ['referencias' => $texto]), $post->ID);
        }
        wp_update_post(['ID' => $post->ID, 'post_content' => wp_slash(trim((string) preg_replace($patron, '', (string) $post->post_content)))]);
    }
    return true;
}

/*
 * Mensajes de WhatsApp (2026-11-03): pasaron de Ajustes del sitio → Cabecera (mensaje_whatsapp) a Contacto, uno por
 * número (mensaje_paciente, mensaje_corporativo). En un sitio ya cargado wp-acf no vuelve a cargar opciones_contacto,
 * así que aquí se completan una vez: el de paciente con lo que había en el campo viejo y el corporativo con el texto
 * que antes estaba fijo en header.php. Solo si están vacíos: nunca pisa lo editado.
 */
function lumenti_carga_whatsapp(): bool
{
    if (!function_exists('update_field') || !function_exists('lumenti_acf_key')) {
        return false;
    }
    $grupo = (array) (get_field('opciones_contacto', 'option') ?: []);
    $cambios = [];
    if (trim((string) ($grupo['mensaje_paciente'] ?? '')) === '') {
        $anterior = trim((string) get_option('options_opciones_cabecera_mensaje_whatsapp', ''));
        $cambios['mensaje_paciente'] = $anterior !== '' ? $anterior : 'Hola, quisiera agendar una cita.';
    }
    if (trim((string) ($grupo['mensaje_corporativo'] ?? '')) === '') {
        $cambios['mensaje_corporativo'] = 'Hola, quisiera información sobre las soluciones de salud mental para empresas.';
    }
    if ($cambios) {
        update_field(lumenti_acf_key('opciones_contacto'), array_merge($grupo, $cambios), 'option');
    }
    return true;
}

// Después de la carga de wp-acf al activar el tema (prioridad 10) y, si quedó algo pendiente, en el admin.
add_action('after_switch_theme', 'lumenti_carga_extra', 20);
add_action('admin_init', function () {
    $hecho = (array) get_option(LUMENTI_CARGA_EXTRA_MARCADOR, []);
    if (empty($hecho['paginas']) || empty($hecho['servicios']) || empty($hecho['especialistas']) || empty($hecho['terminos']) || empty($hecho['condiciones'])
        || empty($hecho['enlaces']) || empty($hecho['blog']) || empty($hecho['referencias']) || empty($hecho['whatsapp'])) {
        lumenti_carga_extra();
    }
});
