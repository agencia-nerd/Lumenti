<?php
/**
 * "Psicología para el día a día" (portada): foto que cambia al pasar por cada tema, lista de temas
 * que llevan todos a una misma página, y franja de evaluaciones con botón.
 * Campos: grupo "Inicio · Psicología para el día a día" (acf-json/group_lumenti_inicio_psicologia.json).
 * Cambio de foto: src/js/sections/home/psicologia.js. Estilos: src/css/sections/home/psicologia.css.
 * "Ver más" en celular: src/js/ver-mas.js (5 y luego todos).
 */

if (!function_exists('get_field')) {
    return;
}

$lumenti_temas = array_values(array_filter(
    (array) get_field('psico_temas'),
    static fn($t): bool => is_array($t) && trim((string) ($t['titulo'] ?? '')) !== ''
));

$lumenti_antetitulo = trim((string) get_field('psico_antetitulo'));
$lumenti_lineas = array_values(array_filter(array_map('trim', preg_split('/\R/', (string) get_field('psico_titulo')))));
$lumenti_texto = trim((string) get_field('psico_texto'));

// Franja de evaluaciones: sin título ni texto no se muestra. Botón sin enlace → WhatsApp.
$lumenti_banda_titulo = trim((string) get_field('psico_banda_titulo'));
$lumenti_banda_texto = trim((string) get_field('psico_banda_texto'));
$lumenti_banda = $lumenti_banda_titulo !== '' || $lumenti_banda_texto !== '';
$lumenti_banda_foto = lumenti_image(get_field('psico_banda_imagen'), [
    'class' => 'absolute top-0 right-0 -z-20 h-[280px] w-full object-cover object-[50%_22%] lg:h-full lg:w-[56%]',
]);
$lumenti_boton = is_array(get_field('psico_banda_boton')) ? get_field('psico_banda_boton') : [];
if (trim((string) ($lumenti_boton['title'] ?? '')) === '') {
    $lumenti_boton['title'] = __('Quiero mi evaluación', 'lumenti');
}
if (!lumenti_link_data($lumenti_boton) && lumenti_whatsapp_url() !== '') {
    $lumenti_boton['url'] = lumenti_whatsapp_url();
    $lumenti_boton['target'] = '_blank';
}

if (!$lumenti_temas && !$lumenti_lineas && !$lumenti_banda) {
    return;
}

// Todos los temas llevan a la misma página; sin página publicada, la lista no enlaza.
$lumenti_pagina = (int) get_field('psico_pagina');
$lumenti_url = $lumenti_pagina && get_post_status($lumenti_pagina) === 'publish' ? get_permalink($lumenti_pagina) : '';

// Una foto por tema (los temas sin foto dejan la anterior). Decorativas: acompañan a la lista.
$lumenti_fotos = [];
foreach ($lumenti_temas as $lumenti_i => $lumenti_tema) {
    $lumenti_foto = lumenti_image($lumenti_tema['imagen'] ?? null, [
        'size'  => 'large',
        'alt'   => '',
        'class' => 'psico-foto',
    ]);
    if ($lumenti_foto !== '') {
        $lumenti_fotos[$lumenti_i] = $lumenti_foto;
    }
}
$lumenti_primera = array_key_first($lumenti_fotos);
?>
<section class="bg-primario-700 px-gutter pt-seccion <?php echo $lumenti_banda ? '' : 'pb-seccion-lg'; ?>" <?php echo $lumenti_lineas ? 'aria-labelledby="lumenti-psico-titulo"' : ''; ?> data-psico>
    <?php if ($lumenti_temas || $lumenti_lineas) : ?>
        <div class="mx-auto grid max-w-site items-start gap-10 <?php echo $lumenti_fotos ? 'lg:grid-cols-[minmax(0,40fr)_minmax(0,60fr)] lg:gap-[clamp(40px,5.8vw,112px)]' : ''; ?>">
            <?php if ($lumenti_fotos) : ?>
                <div class="lg:sticky lg:top-[calc(var(--spacing-nav)+40px)]" data-reveal="img">
                    <div class="relative aspect-[532/462] overflow-hidden rounded-md bg-primario-800 lg:aspect-[3/4]" aria-hidden="true" data-psico-fotos>
                        <?php foreach ($lumenti_fotos as $lumenti_i => $lumenti_foto) : ?>
                            <?php
                            // El atributo va en la <img>: el estado lo cambia psicologia.js.
                            $lumenti_estado = $lumenti_i === $lumenti_primera ? ' data-estado="activo"' : '';
                            echo preg_replace('/^<img\b/', '<img data-psico-foto="' . (int) $lumenti_i . '"' . $lumenti_estado, $lumenti_foto, 1);
                            ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>

            <div class="text-center md:text-left">
                <?php if ($lumenti_antetitulo !== '') : ?>
                    <p class="eyebrow mb-7 text-inverso-2 uppercase" data-reveal><?php echo esc_html($lumenti_antetitulo); ?></p>
                <?php endif; ?>
                <?php if ($lumenti_lineas) : ?>
                    <h2 id="lumenti-psico-titulo" class="text-h2 break-words text-white uppercase" data-reveal>
                        <?php foreach ($lumenti_lineas as $lumenti_linea) : ?>
                            <span class="block"><?php echo esc_html($lumenti_linea); ?></span>
                        <?php endforeach; ?>
                    </h2>
                <?php endif; ?>
                <?php if ($lumenti_texto !== '') : ?>
                    <p class="mx-auto mt-1 max-w-lead leading-[1.7] text-pretty break-words text-borde-frio md:mx-0"><?php echo esc_html($lumenti_texto); ?></p>
                <?php endif; ?>

                <?php if ($lumenti_temas) : ?>
                    <div data-ver-mas data-inicial="5" data-paso="0">
                        <ul id="lumenti-psico-lista" class="mt-[clamp(56px,3.75vw,72px)] border-b border-primario-400 text-left">
                            <?php foreach ($lumenti_temas as $lumenti_i => $lumenti_tema) : ?>
                                <?php $lumenti_tag = $lumenti_url !== '' ? 'a' : 'div'; ?>
                                <li style="--reveal-i: <?php echo (int) min($lumenti_i, 4); ?>" data-reveal data-ver-mas-item>
                                    <<?php echo $lumenti_tag; ?><?php echo $lumenti_url !== '' ? ' href="' . esc_url($lumenti_url) . '"' : ''; ?> class="psico-tema" data-psico-tema="<?php echo (int) $lumenti_i; ?>">
                                        <span class="psico-relleno" aria-hidden="true"></span>
                                        <span class="text-[1.25rem] leading-7 font-medium text-balance break-words text-white"><?php echo esc_html($lumenti_tema['titulo']); ?></span>
                                        <?php if (trim((string) ($lumenti_tema['texto'] ?? '')) !== '') : ?>
                                            <span class="psico-tema-texto leading-[1.6] text-pretty break-words text-inverso"><?php echo esc_html($lumenti_tema['texto']); ?></span>
                                        <?php endif; ?>
                                        <?php if ($lumenti_url !== '') : ?>
                                            <span class="psico-tema-flecha" aria-hidden="true"><?php echo lumenti_icon('flecha', 'size-4.5'); ?></span>
                                        <?php endif; ?>
                                    </<?php echo $lumenti_tag; ?>>
                                </li>
                            <?php endforeach; ?>
                        </ul>

                        <?php if (count($lumenti_temas) > 5) : ?>
                            <div class="mt-6 flex justify-center md:hidden" hidden data-ver-mas-wrap>
                                <button type="button" class="btn btn-inverso" aria-controls="lumenti-psico-lista" aria-expanded="false" data-ver-mas-boton data-texto-mas="<?php esc_attr_e('Ver más', 'lumenti'); ?>" data-texto-menos="<?php esc_attr_e('Ver menos', 'lumenti'); ?>">
                                    <span data-ver-mas-texto><?php esc_html_e('Ver más', 'lumenti'); ?></span>
                                    <?php echo lumenti_icon('chevron', 'ver-mas-flecha size-4.5 flex-none'); ?>
                                </button>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>

    <?php if ($lumenti_banda) : ?>
        <div class="psico-banda relative isolate -mx-gutter flex items-center overflow-hidden bg-[#242424] lg:min-h-[clamp(420px,27.5vw,528px)] <?php echo ($lumenti_temas || $lumenti_lineas) ? 'mt-[clamp(80px,6.25vw,120px)]' : ''; ?><?php echo $lumenti_banda_foto !== '' ? ' psico-banda-con-foto' : ''; ?>">
            <?php echo $lumenti_banda_foto; ?>
            <?php if ($lumenti_banda_foto !== '') : ?>
                <span class="psico-banda-degradado absolute inset-0 -z-10" aria-hidden="true"></span>
            <?php endif; ?>
            <div class="psico-banda-contenido mx-auto w-full max-w-[1920px]">
                <div class="flex max-w-[620px] flex-col items-center text-center md:items-start md:text-left lg:max-w-[clamp(620px,42vw,820px)]" data-reveal>
                    <?php if ($lumenti_banda_titulo !== '') : ?>
                        <h3 class="psico-banda-titulo text-balance break-words text-white uppercase"><?php echo esc_html($lumenti_banda_titulo); ?></h3>
                    <?php endif; ?>
                    <?php if ($lumenti_banda_texto !== '') : ?>
                        <p class="mt-4 leading-[1.8] text-pretty break-words text-primario-200"><?php echo esc_html($lumenti_banda_texto); ?></p>
                    <?php endif; ?>
                    <?php $lumenti_boton_data = lumenti_link_data($lumenti_boton); ?>
                    <?php if ($lumenti_boton_data && $lumenti_boton_data['title'] !== '') : ?>
                        <a<?php echo lumenti_link_attrs($lumenti_boton, ['class' => 'btn btn-primario mt-9']); ?>>
                            <?php echo esc_html($lumenti_boton_data['title']); ?>
                            <?php echo lumenti_icon('flecha', 'size-4.5 flex-none'); ?>
                            <?php if ($lumenti_boton_data['blank']) : ?>
                                <span class="sr-only"><?php esc_html_e('(se abre en una pestaña nueva)', 'lumenti'); ?></span>
                            <?php endif; ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
</section>
