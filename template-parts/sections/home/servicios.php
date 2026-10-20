<?php
/**
 * Servicios de la portada: tarjetas que llevan a la página de cada servicio. La foto es la imagen
 * destacada de esa página (la misma que usa el mega menú); no se carga aparte en la home.
 * El ancho sale del orden: los dos primeros a todo el ancho y el resto de a dos (si el último
 * queda solo, también a todo el ancho).
 * Campos: grupo "Inicio · Servicios" (acf-json/group_lumenti_inicio_servicios.json).
 * Cursor "Saber más": src/js/sections/home/servicios.js. Hover y descripción: src/css/sections/home/servicios.css.
 */

if (!function_exists('get_field')) {
    return;
}

// Solo servicios con una página publicada; el título vacío cae al de la página.
$lumenti_servicios = [];
foreach ((array) get_field('servicios_items') as $lumenti_fila) {
    $lumenti_pagina = is_array($lumenti_fila) ? (int) ($lumenti_fila['pagina'] ?? 0) : 0;
    if (!$lumenti_pagina || get_post_status($lumenti_pagina) !== 'publish') {
        continue;
    }

    $lumenti_titulo = trim((string) ($lumenti_fila['titulo'] ?? '')) ?: get_the_title($lumenti_pagina);
    $lumenti_servicios[] = [
        'url'         => get_permalink($lumenti_pagina),
        'titulo'      => $lumenti_titulo,
        'descripcion' => trim((string) ($lumenti_fila['descripcion'] ?? '')),
        'foto'        => get_post_thumbnail_id($lumenti_pagina),
    ];
}
if (!$lumenti_servicios) {
    return;
}

$lumenti_total = count($lumenti_servicios);
$lumenti_cursor = trim((string) get_field('servicios_cursor')) ?: __('Saber más', 'lumenti');
?>
<section class="relative grid grid-cols-1 md:grid-cols-2" aria-labelledby="lumenti-servicios-titulo" data-servicios>
    <h2 id="lumenti-servicios-titulo" class="sr-only"><?php esc_html_e('Servicios', 'lumenti'); ?></h2>

    <?php foreach ($lumenti_servicios as $lumenti_i => $lumenti_servicio) : ?>
        <?php $lumenti_ancho = $lumenti_i < 2 || ($lumenti_i === $lumenti_total - 1 && ($lumenti_total - 2) % 2 === 1); ?>
        <a href="<?php echo esc_url($lumenti_servicio['url']); ?>" class="relative isolate block h-[360px] overflow-hidden bg-primario-900 text-white hover:text-white md:h-[420px] lg:h-[clamp(420px,31.25vw,600px)]<?php echo $lumenti_ancho ? ' md:col-span-2' : ''; ?>" data-servicio>
            <?php
            // Decorativa: el enlace se lee por su título.
            echo lumenti_image($lumenti_servicio['foto'], [
                'alt'   => '',
                'sizes' => $lumenti_ancho ? '100vw' : '(min-width: 768px) 50vw, 100vw',
                'class' => 'servicio-foto absolute inset-0 -z-20 size-full object-cover',
            ]);
            ?>
            <span class="absolute inset-0 -z-10 bg-[linear-gradient(to_top,rgb(18_22_28/0.74)_0%,rgb(18_22_28/0.38)_42%,rgb(18_22_28/0.16)_100%)]" aria-hidden="true"></span>
            <span class="servicio-flecha absolute top-4 right-4 grid size-11 place-items-center rounded-md border border-white/55 bg-white/14 backdrop-blur-md" aria-hidden="true">
                <?php echo lumenti_icon('flecha-diagonal', 'size-5'); ?>
            </span>

            <div class="absolute bottom-[clamp(32px,2.7vw,52px)] left-1/2 flex w-[min(88%,480px)] -translate-x-1/2 flex-col items-center text-center">
                <h3 class="text-h3 text-balance break-words text-white uppercase"><?php echo esc_html($lumenti_servicio['titulo']); ?></h3>
                <?php if ($lumenti_servicio['descripcion'] !== '') : ?>
                    <span class="servicio-desc">
                        <span class="block pt-1.5 leading-6 text-balance break-words"><?php echo esc_html($lumenti_servicio['descripcion']); ?></span>
                    </span>
                <?php endif; ?>
            </div>
        </a>
    <?php endforeach; ?>

    <div class="servicios-cursor" aria-hidden="true" data-servicios-cursor>
        <span class="servicios-cursor-circulo">
            <span class="max-w-[80%] text-center leading-6 tracking-[0.04em] uppercase"><?php echo esc_html($lumenti_cursor); ?></span>
            <span class="servicios-cursor-orbita animate-girar"><span></span></span>
        </span>
    </div>
</section>
