<?php
/**
 * "¿Cómo podemos ayudarte?" (portada): título, texto y una tarjeta por condición que lleva a su página.
 * El ancla #que-tratamos la usan el footer y la redirección de /condiciones/.
 * Campos: grupo "Inicio · Cómo podemos ayudarte" (acf-json/group_lumenti_inicio_ayuda.json).
 * Condiciones: tipo de contenido `condicion` (inc/condiciones.php); campo vacío = todas en su orden.
 * Hover y "Saber más": src/css/sections/home/ayuda.css. "Ver más" en celular: src/js/ver-mas.js.
 */

if (!function_exists('get_field')) {
    return;
}

$lumenti_elegidas = array_filter(array_map('intval', (array) get_field('ayuda_condiciones', false, false)));
$lumenti_condiciones = get_posts([
    'post_type'      => 'condicion',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'post__in'       => $lumenti_elegidas,
    'orderby'        => $lumenti_elegidas ? 'post__in' : ['menu_order' => 'ASC', 'title' => 'ASC'],
]);
if (!$lumenti_condiciones) {
    return;
}

$lumenti_titulo = trim((string) get_field('ayuda_titulo'));
$lumenti_texto = trim((string) get_field('ayuda_texto'));
$lumenti_saber_mas = trim((string) get_field('ayuda_saber_mas')) ?: __('Saber más', 'lumenti');

// Ícono de las tarjetas: el subido (como máscara, toma el color del texto) o el del tema.
$lumenti_icono_data = lumenti_image_data(get_field('ayuda_icono'), 'thumbnail');
$lumenti_icono = $lumenti_icono_data
    ? '<span class="ayuda-icono ayuda-icono-mascara" style="' . esc_attr('--icono: url("' . esc_url($lumenti_icono_data['url']) . '")') . '" aria-hidden="true"></span>'
    : lumenti_icon('trastorno', 'ayuda-icono');
?>
<section id="que-tratamos" class="scroll-mt-24 px-gutter pt-seccion pb-seccion-lg" <?php echo $lumenti_titulo !== '' ? 'aria-labelledby="lumenti-ayuda-titulo"' : 'aria-label="' . esc_attr__('Qué tratamos', 'lumenti') . '"'; ?> data-ayuda data-ver-mas data-inicial="6" data-paso="6">
    <?php if ($lumenti_titulo !== '' || $lumenti_texto !== '') : ?>
        <div class="mx-auto flex max-w-titulo flex-col items-center text-center" data-reveal>
            <?php if ($lumenti_titulo !== '') : ?>
                <h2 id="lumenti-ayuda-titulo" class="text-h2 text-balance break-words uppercase"><?php echo esc_html($lumenti_titulo); ?></h2>
            <?php endif; ?>
            <?php if ($lumenti_texto !== '') : ?>
                <p class="mt-1 max-w-lead leading-[1.7] text-balance break-words text-cuerpo-2"><?php echo esc_html($lumenti_texto); ?></p>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <ul id="lumenti-ayuda-lista" class="mx-auto grid max-w-site grid-cols-2 gap-2 <?php echo ($lumenti_titulo !== '' || $lumenti_texto !== '') ? 'mt-12 lg:mt-[clamp(48px,3.75vw,72px)]' : ''; ?> min-[68.75rem]:grid-cols-3">
        <?php foreach ($lumenti_condiciones as $lumenti_i => $lumenti_condicion) : ?>
            <li class="flex" style="--reveal-i: <?php echo (int) ($lumenti_i % 3); ?>" data-reveal data-ver-mas-item>
                <a href="<?php echo esc_url(get_permalink($lumenti_condicion)); ?>" class="ayuda-tarjeta" data-ayuda-tarjeta>
                    <span class="ayuda-relleno" aria-hidden="true"></span>
                    <span class="ayuda-textos">
                        <span class="ayuda-nombre font-titulo text-balance break-words uppercase"><?php echo esc_html(get_the_title($lumenti_condicion)); ?></span>
                        <span class="ayuda-mas" aria-hidden="true">
                            <span><?php echo esc_html($lumenti_saber_mas); ?><?php echo lumenti_icon('flecha', 'size-4.5 flex-none'); ?></span>
                        </span>
                    </span>
                    <?php echo $lumenti_icono; ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>

    <?php if (count($lumenti_condiciones) > 6) : ?>
        <div class="mt-6 flex justify-center md:hidden" hidden data-ver-mas-wrap>
            <button type="button" class="btn btn-tonal" aria-controls="lumenti-ayuda-lista" aria-expanded="false" data-ver-mas-boton data-texto-mas="<?php esc_attr_e('Ver más', 'lumenti'); ?>" data-texto-menos="<?php esc_attr_e('Ver menos', 'lumenti'); ?>">
                <span data-ver-mas-texto><?php esc_html_e('Ver más', 'lumenti'); ?></span>
                <?php echo lumenti_icon('chevron', 'ver-mas-flecha size-4.5 flex-none'); ?>
            </button>
        </div>
    <?php endif; ?>
</section>
