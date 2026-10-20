<?php
/**
 * CTA final (componente compartido): caja oscura con video o imagen de fondo, ícono, título,
 * texto y botón. Va al final de las páginas que lo usan, justo antes del footer.
 * Campos: grupo "CTA final" (acf-json/group_lumenti_cta.json), que aparece en cada página donde
 * se usa; cada página guarda su propio contenido. Para sumarlo a otra página, agrega su regla de
 * ubicación al grupo y llama:
 *
 *     get_template_part('template-parts/sections/components/cta');
 *
 * $args (opcional): post_id (por defecto, el de la página actual).
 * Arco que se aplana al bajar y video: src/js/sections/components/cta.js + src/css/sections/components/cta.css.
 */

if (!function_exists('get_field')) {
    return;
}

$lumenti_id = (int) ($args['post_id'] ?? get_queried_object_id());
$lumenti_titulo = trim((string) get_field('cta_titulo', $lumenti_id));
if ($lumenti_titulo === '') {
    return;
}
$lumenti_texto = trim((string) get_field('cta_texto', $lumenti_id));

// Botón: sin enlace válido → WhatsApp; sin texto → "Escríbenos por WhatsApp".
$lumenti_boton = is_array(get_field('cta_boton', $lumenti_id)) ? get_field('cta_boton', $lumenti_id) : [];
if (trim((string) ($lumenti_boton['title'] ?? '')) === '') {
    $lumenti_boton['title'] = __('Escríbenos por WhatsApp', 'lumenti');
}
if (!lumenti_link_data($lumenti_boton) && lumenti_whatsapp_url() !== '') {
    $lumenti_boton['url'] = lumenti_whatsapp_url();
    $lumenti_boton['target'] = '_blank';
}
$lumenti_boton_data = lumenti_link_data($lumenti_boton);
$lumenti_es_whatsapp = $lumenti_boton_data && str_contains((string) wp_parse_url($lumenti_boton_data['url'], PHP_URL_HOST), 'wa.me');

// Fondo: un solo archivo, foto o video (se decide por el tipo del archivo subido).
$lumenti_fondo = (int) get_field('cta_fondo', $lumenti_id);
$lumenti_tipo = $lumenti_fondo ? (string) get_post_mime_type($lumenti_fondo) : '';
$lumenti_video = str_starts_with($lumenti_tipo, 'video/') ? (string) wp_get_attachment_url($lumenti_fondo) : '';
$lumenti_foto = str_starts_with($lumenti_tipo, 'image/')
    ? lumenti_image($lumenti_fondo, ['alt' => '', 'class' => 'absolute inset-0 -z-20 size-full object-cover'])
    : '';
$lumenti_uid = 'lumenti-cta-' . $lumenti_id;
?>
<section class="cta relative bg-[linear-gradient(var(--color-fondo)_50%,var(--color-primario-700)_50%)]" aria-labelledby="<?php echo esc_attr($lumenti_uid); ?>" data-cta>
    <div class="cta-caja relative isolate flex flex-col items-center justify-center overflow-hidden rounded-b-[18px] bg-[#2b2722] text-center text-white" data-cta-caja>
        <?php echo $lumenti_foto; ?>
        <?php if ($lumenti_video !== '') : ?>
            <video class="absolute inset-0 -z-20 size-full object-cover" src="<?php echo esc_url($lumenti_video); ?>" muted loop playsinline preload="metadata" aria-hidden="true" data-cta-video></video>
        <?php endif; ?>
        <span class="absolute inset-0 -z-10 bg-[radial-gradient(ellipse_60%_55%_at_50%_52%,rgb(10_14_16/0.62)_0%,rgb(10_14_16/0.5)_60%,rgb(10_14_16/0.42)_100%)]" aria-hidden="true"></span>

        <span class="grid size-20 place-items-center rounded-full border-[1.5px] border-white/85" aria-hidden="true">
            <?php echo lumenti_icon('cerebro', 'block h-auto w-[42px]'); ?>
        </span>
        <h2 id="<?php echo esc_attr($lumenti_uid); ?>" class="mt-12 max-w-[1000px] text-h2 text-balance break-words text-white uppercase" data-reveal><?php echo esc_html($lumenti_titulo); ?></h2>
        <?php if ($lumenti_texto !== '') : ?>
            <p class="mt-1 max-w-lead leading-[1.7] text-balance break-words"><?php echo esc_html($lumenti_texto); ?></p>
        <?php endif; ?>
        <?php if ($lumenti_boton_data && $lumenti_boton_data['title'] !== '') : ?>
            <a<?php echo lumenti_link_attrs($lumenti_boton, ['class' => 'btn btn-primario mt-9']); ?>>
                <?php echo esc_html($lumenti_boton_data['title']); ?>
                <?php echo lumenti_icon($lumenti_es_whatsapp ? 'whatsapp' : 'flecha', 'size-5 flex-none'); ?>
                <?php if ($lumenti_boton_data['blank']) : ?>
                    <span class="sr-only"><?php esc_html_e('(se abre en una pestaña nueva)', 'lumenti'); ?></span>
                <?php endif; ?>
            </a>
        <?php endif; ?>
    </div>
</section>
