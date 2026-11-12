<?php
defined('ABSPATH') || exit;

/*
 * Orden de los especialistas sin campo: se guarda en menu_order de WordPress.
 * - Especialistas > Ordenar: una lista por tipo (Psiquiatras, Psicólogos…) que se ordena arrastrando con el
 *   mouse (jQuery UI Sortable de WordPress) y se guarda con un botón. Los psiquiatras siempre van antes que
 *   los psicólogos: por eso cada tipo se ordena por separado.
 * - Un especialista nuevo va primero en su tipo, solo (los de la carga de contenido inicial, al final).
 * - La lista del admin (Especialistas > Todos) sale en el mismo orden que la web.
 * - Una sola vez: pasa el antiguo campo ACF especialista_perfil_orden a menu_order y borra ese dato.
 * El orden lo leen lumenti_especialistas_ordenar() y lumenti_especialistas_orderby_sql() (inc/especialistas.php).
 */

const LUMENTI_ESPECIALISTAS_ORDEN_PAGINA = 'lumenti-especialistas-orden';

// Estados que se ordenan (los borradores también, así ya quedan en su lugar al publicarse).
function lumenti_especialistas_orden_estados(): array
{
    return ['publish', 'future', 'draft', 'pending', 'private'];
}

// ¿Lo está creando la carga de contenido inicial (lumenti_acf_seed, inc/acf/runner.php)?
function lumenti_especialistas_en_carga_inicial(): bool
{
    foreach (debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS) as $paso) {
        if (($paso['function'] ?? '') === 'lumenti_acf_seed') {
            return true;
        }
    }
    return false;
}

// Un especialista nuevo (o sin orden) va primero en su tipo: los demás bajan un puesto y él queda en 1.
// Los de la carga de contenido inicial van al final, uno tras otro, para respetar el orden del diseño.
add_filter('wp_insert_post_data', function (array $data): array {
    if (($data['post_type'] ?? '') !== 'especialista' || (int) ($data['menu_order'] ?? 0) !== 0
        || in_array($data['post_status'] ?? '', ['auto-draft', 'trash', 'inherit'], true)) {
        return $data;
    }
    global $wpdb;
    if (lumenti_especialistas_en_carga_inicial()) {
        $max = (int) $wpdb->get_var($wpdb->prepare("SELECT MAX(menu_order) FROM {$wpdb->posts} WHERE post_type = %s", 'especialista'));
        $data['menu_order'] = $max + 1;
        return $data;
    }
    $ids = $wpdb->get_col($wpdb->prepare("SELECT ID FROM {$wpdb->posts} WHERE post_type = %s AND menu_order > 0", 'especialista'));
    if ($ids) {
        $wpdb->query($wpdb->prepare("UPDATE {$wpdb->posts} SET menu_order = menu_order + 1 WHERE post_type = %s AND menu_order > 0", 'especialista'));
        array_map('clean_post_cache', array_map('intval', $ids));
    }
    $data['menu_order'] = 1;
    return $data;
});

// La lista del admin, en el orden de la web (salvo que se ordene por una columna).
add_filter('posts_orderby', function (string $orderby, WP_Query $query): string {
    if (!is_admin() || !$query->is_main_query() || $query->get('post_type') !== 'especialista' || !empty($_GET['orderby'])) {
        return $orderby;
    }
    global $pagenow;
    return $pagenow === 'edit.php' ? lumenti_especialistas_orderby_sql() : $orderby;
}, 10, 2);

// ---------- Migración del campo antiguo ----------

add_action('admin_init', function () {
    if (get_option('lumenti_especialistas_orden_v1') || !post_type_exists('especialista')) {
        return;
    }
    $posts = get_posts([
        'post_type'      => 'especialista',
        'post_status'    => lumenti_especialistas_orden_estados(),
        'posts_per_page' => -1,
        'no_found_rows'  => true,
    ]);
    $clave = [];
    foreach ($posts as $post) {
        $viejo = get_post_meta($post->ID, 'especialista_perfil_orden', true);
        $clave[$post->ID] = [
            lumenti_especialista_tipo_orden($post->ID),
            $viejo !== '' ? (float) $viejo : PHP_FLOAT_MAX,
            mb_strtolower($post->post_title, 'UTF-8'),
        ];
    }
    usort($posts, static fn($a, $b) => $clave[$a->ID] <=> $clave[$b->ID]);
    lumenti_especialistas_guardar_orden(wp_list_pluck($posts, 'ID'));
    foreach ($posts as $post) {
        delete_post_meta($post->ID, 'especialista_perfil_orden');
        delete_post_meta($post->ID, '_especialista_perfil_orden');
    }
    update_option('lumenti_especialistas_orden_v1', 1, false);
});

// Guarda menu_order = 1, 2, 3… en el orden dado (sin tocar la fecha de modificación).
function lumenti_especialistas_guardar_orden(array $ids): void
{
    global $wpdb;
    $n = 0;
    foreach ($ids as $id) {
        $id = (int) $id;
        if ($id <= 0 || get_post_type($id) !== 'especialista') {
            continue;
        }
        $wpdb->update($wpdb->posts, ['menu_order' => ++$n], ['ID' => $id], ['%d'], ['%d']);
        clean_post_cache($id);
    }
}

// ---------- Pantalla Especialistas > Ordenar ----------

add_action('admin_menu', function () {
    if (!post_type_exists('especialista')) {
        return;
    }
    $hook = add_submenu_page(
        'edit.php?post_type=especialista',
        __('Ordenar especialistas', 'lumenti'),
        __('Ordenar', 'lumenti'),
        'edit_others_posts',
        LUMENTI_ESPECIALISTAS_ORDEN_PAGINA,
        'lumenti_especialistas_orden_pantalla'
    );
    add_action('admin_print_scripts-' . $hook, 'lumenti_especialistas_orden_assets');
});

function lumenti_especialistas_orden_assets(): void
{
    wp_enqueue_script('jquery-ui-sortable');
    wp_add_inline_script('jquery-ui-sortable', <<<'JS'
jQuery(function ($) {
    var $form = $('.lumenti-orden-form');
    $('.lumenti-orden-lista').sortable({
        axis: 'y',
        placeholder: 'lumenti-orden-hueco',
        forcePlaceholderSize: true,
        update: function () { $form.addClass('is-dirty'); }
    });
    // Teclado: flechas arriba/abajo mueven el especialista con foco.
    $('.lumenti-orden-lista').on('keydown', '.lumenti-orden-item', function (e) {
        if (e.key !== 'ArrowUp' && e.key !== 'ArrowDown') { return; }
        e.preventDefault();
        var $li = $(this);
        if (e.key === 'ArrowUp' && $li.prev().length) { $li.insertBefore($li.prev()); }
        else if (e.key === 'ArrowDown' && $li.next().length) { $li.insertAfter($li.next()); }
        else { return; }
        $li.trigger('focus');
        $form.addClass('is-dirty');
    });
    $form.on('submit', function () { $form.removeClass('is-dirty'); });
    $(window).on('beforeunload', function () {
        if ($form.hasClass('is-dirty')) { return true; }
    });
});
JS);
    wp_register_style('lumenti-especialistas-orden', false);
    wp_enqueue_style('lumenti-especialistas-orden');
    wp_add_inline_style('lumenti-especialistas-orden', '
.lumenti-orden-grupo{max-width:640px;margin:24px 0}
.lumenti-orden-lista{margin:8px 0 0}
.lumenti-orden-item{display:flex;align-items:center;gap:10px;margin:0 0 6px;padding:10px 12px;background:#fff;border:1px solid #c3c4c7;border-radius:4px;cursor:move}
.lumenti-orden-item:focus{outline:2px solid #2271b1;outline-offset:1px}
.lumenti-orden-item .dashicons{color:#8c8f94}
.lumenti-orden-num{min-width:1.5em;color:#646970;font-variant-numeric:tabular-nums}
.lumenti-orden-estado{margin-left:auto;color:#646970;font-size:12px}
.lumenti-orden-hueco{height:42px;margin:0 0 6px;border:1px dashed #2271b1;border-radius:4px;background:#f0f6fc}
.lumenti-orden-lista{counter-reset:lumenti-orden}
.lumenti-orden-item .lumenti-orden-num::before{counter-increment:lumenti-orden;content:counter(lumenti-orden)}
');
}

// Grupos de la pantalla: [nombre del tipo => posts], en el orden de la web.
function lumenti_especialistas_orden_grupos(): array
{
    $posts = lumenti_especialistas_ordenar(get_posts([
        'post_type'      => 'especialista',
        'post_status'    => lumenti_especialistas_orden_estados(),
        'posts_per_page' => -1,
        'no_found_rows'  => true,
    ]));
    $nombres = [];
    $terms = get_terms(['taxonomy' => 'tipo_especialista', 'hide_empty' => false, 'orderby' => 'term_id']);
    foreach (is_array($terms) ? $terms : [] as $i => $term) {
        $nombres[$i] = $term->name;
    }
    $grupos = [];
    foreach ($posts as $post) {
        $tipo = lumenti_especialista_tipo_orden($post->ID);
        $grupos[$tipo === PHP_INT_MAX ? __('Sin tipo de especialista', 'lumenti') : ($nombres[$tipo] ?? '')][] = $post;
    }
    return $grupos;
}

function lumenti_especialistas_orden_pantalla(): void
{
    if (!current_user_can('edit_others_posts')) {
        return;
    }
    $estados = get_post_stati([], 'objects');
    ?>
    <div class="wrap">
        <h1><?php echo esc_html__('Ordenar especialistas', 'lumenti'); ?></h1>
        <?php if (!empty($_GET['guardado'])) : ?>
            <div class="notice notice-success is-dismissible"><p><?php echo esc_html__('Orden guardado.', 'lumenti'); ?></p></div>
        <?php endif; ?>
        <p><?php echo esc_html__('Arrastra cada especialista con el mouse (o selecciónalo y usa las flechas ↑ ↓ del teclado) y pulsa "Guardar orden". Este orden se usa en el listado de especialistas y en los carruseles. Los psiquiatras siempre aparecen antes que los psicólogos. Un especialista nuevo se agrega al principio de su lista.', 'lumenti'); ?></p>
        <form class="lumenti-orden-form" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
            <input type="hidden" name="action" value="lumenti_especialistas_orden">
            <?php wp_nonce_field('lumenti_especialistas_orden'); ?>
            <?php foreach (lumenti_especialistas_orden_grupos() as $nombre => $posts) : ?>
                <section class="lumenti-orden-grupo">
                    <h2><?php echo esc_html($nombre); ?></h2>
                    <ul class="lumenti-orden-lista">
                        <?php foreach ($posts as $post) : ?>
                            <li class="lumenti-orden-item" tabindex="0">
                                <span class="dashicons dashicons-menu" aria-hidden="true"></span>
                                <span class="lumenti-orden-num" aria-hidden="true"></span>
                                <span><?php echo esc_html(get_the_title($post) ?: __('(sin título)', 'lumenti')); ?></span>
                                <?php if ($post->post_status !== 'publish') : ?>
                                    <span class="lumenti-orden-estado"><?php echo esc_html($estados[$post->post_status]->label ?? $post->post_status); ?></span>
                                <?php endif; ?>
                                <input type="hidden" name="orden[]" value="<?php echo esc_attr((string) $post->ID); ?>">
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </section>
            <?php endforeach; ?>
            <?php submit_button(__('Guardar orden', 'lumenti')); ?>
        </form>
    </div>
    <?php
}

add_action('admin_post_lumenti_especialistas_orden', function () {
    if (!current_user_can('edit_others_posts')) {
        wp_die(esc_html__('No tienes permiso para ordenar los especialistas.', 'lumenti'), 403);
    }
    check_admin_referer('lumenti_especialistas_orden');
    $ids = array_map('intval', (array) wp_unslash($_POST['orden'] ?? []));
    lumenti_especialistas_guardar_orden(array_values(array_unique(array_filter($ids))));
    wp_safe_redirect(add_query_arg(
        ['post_type' => 'especialista', 'page' => LUMENTI_ESPECIALISTAS_ORDEN_PAGINA, 'guardado' => 1],
        admin_url('edit.php')
    ));
    exit;
});
