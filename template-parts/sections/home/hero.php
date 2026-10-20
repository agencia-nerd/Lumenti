<?php
/**
 * Hero de la portada: carrusel de diapositivas (título, texto, botón y foto) con pestañas,
 * barra de progreso, botón de pausa y sello giratorio.
 * Campos: grupo "Inicio · Hero" (acf-json/group_lumenti_inicio.json).
 * Comportamiento: src/js/sections/home/hero.js. Fases y barridos: src/css/sections/home/hero.css.
 */

if (!function_exists('get_field')) {
    return;
}

// Solo diapositivas con título.
$lumenti_slides = array_values(array_filter(
    (array) get_field('hero_diapositivas'),
    static fn($s): bool => is_array($s) && trim((string) ($s['titulo'] ?? '')) !== ''
));
if (!$lumenti_slides) {
    return;
}

$lumenti_total = count($lumenti_slides);
$lumenti_ms = 6000; // tiempo de cada diapositiva
$lumenti_palabras = array_values(array_filter(array_map(
    static fn($p): string => mb_strtoupper(trim($p)),
    explode(',', (string) get_field('hero_sello_palabras'))
)));
$lumenti_whatsapp = lumenti_whatsapp_url();
$lumenti_nueva_pestana = '<span class="sr-only">(' . esc_html__('se abre en una pestaña nueva', 'lumenti') . ')</span>';

// Fase inicial: la primera se ve sin animar, el resto oculta.
$lumenti_fase = static fn(int $i): string => $i === 0 ? 'estatica' : 'oculta';
$lumenti_num = static fn(int $i): string => str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT);
?>
<section class="relative mt-8 grid grid-cols-1 [grid-template-areas:'texto'_'foto'_'tabs'] md:mt-12 lg:mt-0 lg:min-h-[max(540px,calc(100svh-var(--spacing-nav)))] lg:grid-cols-[minmax(0,52fr)_minmax(0,48fr)] lg:grid-rows-[1fr_auto] lg:[grid-template-areas:'texto_foto'_'tabs_foto']" aria-roledescription="carrusel" aria-label="<?php esc_attr_e('Destacados', 'lumenti'); ?>" style="--llenar-ms: <?php echo (int) $lumenti_ms; ?>ms" data-hero>

    <?php foreach ($lumenti_slides as $lumenti_i => $lumenti_slide) : ?>
        <span class="pointer-events-none absolute top-[calc(100%+26px-clamp(56px,8vh,88px))] right-[58.6%] z-0 -mt-[0.74em] hidden font-titulo text-[min(11.5vw,220px)] leading-[1.2] tracking-[0.02em] text-divisor select-none lg:block" aria-hidden="true" data-hero-texto data-hero-numero data-fase="<?php echo esc_attr($lumenti_fase($lumenti_i)); ?>"><?php echo esc_html($lumenti_num($lumenti_i)); ?></span>
    <?php endforeach; ?>

    <div class="relative z-10 grid px-gutter [grid-area:texto] lg:pt-[calc(clamp(32px,13.75vh,148.5px)+19px)] lg:pr-[clamp(24px,3vw,48px)] lg:pl-[clamp(24px,5.2vw,100px)]" data-hero-textos>
        <?php foreach ($lumenti_slides as $lumenti_i => $lumenti_slide) : ?>
            <?php
            $lumenti_tag = $lumenti_i === 0 ? 'h1' : 'h2';
            $lumenti_lineas = array_values(array_filter(array_map('trim', preg_split('/\R/', (string) $lumenti_slide['titulo']))));
            // Botón: sin enlace válido → WhatsApp; sin texto → "Agenda tu cita". Respeta lo que sí escribió.
            $lumenti_boton = is_array($lumenti_slide['boton'] ?? null) ? $lumenti_slide['boton'] : [];
            if (trim((string) ($lumenti_boton['title'] ?? '')) === '') {
                $lumenti_boton['title'] = __('Agenda tu cita', 'lumenti');
            }
            if (!lumenti_link_data($lumenti_boton) && $lumenti_whatsapp !== '') {
                $lumenti_boton['url'] = $lumenti_whatsapp;
                $lumenti_boton['target'] = '_blank';
            }
            $lumenti_boton_data = lumenti_link_data($lumenti_boton);
            ?>
            <div id="hero-panel-<?php echo (int) $lumenti_i; ?>" class="flex flex-col items-center text-center [grid-area:1/1] md:items-start md:text-left" <?php echo $lumenti_total > 1 ? 'role="tabpanel" aria-labelledby="hero-tab-' . (int) $lumenti_i . '"' : ''; ?> <?php echo $lumenti_i > 0 ? 'inert aria-hidden="true"' : ''; ?> data-hero-texto data-hero-panel data-fase="<?php echo esc_attr($lumenti_fase($lumenti_i)); ?>">
                <<?php echo $lumenti_tag; ?> class="font-titulo text-[clamp(30px,7.6vw,56px)] leading-[1.1364] tracking-[-0.01em] text-titulo lg:text-[clamp(36px,3.6vw,80px)]">
                    <?php foreach ($lumenti_lineas as $lumenti_l => $lumenti_linea) : ?>
                        <span class="-mt-[0.18em] block overflow-hidden pt-[0.18em]">
                            <span class="block animate-subir" style="animation-delay: <?php echo 150 + $lumenti_l * 110; ?>ms"><?php echo lumenti_highlight($lumenti_linea); ?></span>
                        </span>
                    <?php endforeach; ?>
                </<?php echo $lumenti_tag; ?>>

                <?php if (trim((string) ($lumenti_slide['texto'] ?? '')) !== '') : ?>
                    <div class="mt-[5px] overflow-hidden">
                        <p class="max-w-titulo animate-subir text-lead leading-[1.61] text-pretty text-cuerpo" style="animation-delay: 480ms"><?php echo esc_html($lumenti_slide['texto']); ?></p>
                    </div>
                <?php endif; ?>

                <?php if ($lumenti_boton_data && $lumenti_boton_data['title'] !== '') : ?>
                    <div class="mt-10 overflow-hidden">
                        <a<?php echo lumenti_link_attrs($lumenti_boton, ['class' => 'btn btn-primario animate-subir [--btn-h:58px]']); ?> style="animation-delay: 600ms">
                            <?php echo esc_html($lumenti_boton_data['title']); ?>
                            <?php echo lumenti_icon('caret', 'size-[18px] flex-none'); ?>
                            <?php echo $lumenti_boton_data['blank'] ? $lumenti_nueva_pestana : ''; ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="relative z-10 mx-5 mt-10 grid grid-rows-[minmax(0,1fr)] [grid-area:foto] md:mx-10 lg:m-0">
        <div class="grid h-full animate-revelar grid-rows-[minmax(0,1fr)] [grid-area:1/1]" style="animation-delay: 80ms">
            <?php foreach ($lumenti_slides as $lumenti_i => $lumenti_slide) : ?>
                <div class="relative aspect-[968/900] h-full overflow-hidden rounded-lg bg-primario-200 [grid-area:1/1] lg:aspect-auto lg:rounded-none" data-hero-foto data-fase="<?php echo esc_attr($lumenti_fase($lumenti_i)); ?>" data-ken="0">
                    <?php
                    echo lumenti_image($lumenti_slide['imagen'] ?? null, [
                        'size'          => 'large',
                        'class'         => 'block size-full object-cover',
                        'loading'       => $lumenti_i === 0 ? 'eager' : 'lazy',
                        'fetchpriority' => $lumenti_i === 0 ? 'high' : '',
                        'sizes'         => '(min-width: 1024px) 48vw, 100vw',
                    ]);
                    ?>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="absolute top-0 left-[calc(100%-64px)] z-20 grid aspect-square w-[100px] -translate-x-1/2 -translate-y-1/2 animate-pop place-items-center rounded-full bg-dorado text-cafe md:left-[calc(100%-96px)] md:w-32 lg:top-[74%] lg:left-0 lg:w-[clamp(112px,8.3333vw,160px)]" style="animation-delay: 1100ms" aria-hidden="true">
            <?php if ($lumenti_palabras) : ?>
                <svg viewBox="0 0 160 160" class="block size-full animate-girar [grid-area:1/1]" data-hero-anillo>
                    <defs>
                        <path id="hero-anillo" d="M80,80 m-59,0 a59,59 0 1,1 118,0 a59,59 0 1,1 -118,0" />
                    </defs>
                    <text fill="currentColor" font-family="Abenda, serif" font-size="14" letter-spacing="0.3">
                        <?php foreach ($lumenti_palabras as $lumenti_p => $lumenti_palabra) : ?>
                            <textPath href="#hero-anillo" startOffset="<?php echo round(10 + $lumenti_p * 370.7 / count($lumenti_palabras), 1); ?>"><?php echo esc_html($lumenti_palabra); ?></textPath>
                        <?php endforeach; ?>
                    </text>
                </svg>
            <?php endif; ?>
            <?php echo lumenti_icon('badge-cerebro', 'h-auto w-[37.5%] [grid-area:1/1]'); ?>
        </div>
    </div>

    <?php if ($lumenti_total > 1) : ?>
        <div class="relative z-10 flex items-end gap-2 self-end overflow-hidden pt-8 pr-5 pl-5 [grid-area:tabs] md:pr-10 md:pl-10 lg:pt-10 lg:pr-[clamp(24px,3vw,48px)] lg:pb-[clamp(56px,8vh,88px)] lg:pl-[clamp(24px,5.2vw,100px)]">
            <div class="flex flex-1 gap-2 lg:flex-none" role="tablist" aria-label="<?php esc_attr_e('Áreas', 'lumenti'); ?>">
                <?php foreach ($lumenti_slides as $lumenti_i => $lumenti_slide) : ?>
                    <?php $lumenti_pestana = trim((string) ($lumenti_slide['pestana'] ?? '')); ?>
                    <button type="button" id="hero-tab-<?php echo (int) $lumenti_i; ?>" class="flex flex-1 animate-subir cursor-pointer flex-col gap-2 text-center text-caption font-semibold text-sutil uppercase transition-colors duration-300 aria-selected:text-primario lg:w-[clamp(140px,9.375vw,180px)] lg:flex-none lg:text-left" role="tab" aria-selected="<?php echo $lumenti_i === 0 ? 'true' : 'false'; ?>" aria-controls="hero-panel-<?php echo (int) $lumenti_i; ?>" tabindex="<?php echo $lumenti_i === 0 ? '0' : '-1'; ?>" style="animation-delay: 750ms" data-hero-tab>
                        <span><?php echo esc_html($lumenti_num($lumenti_i) . '.' . ($lumenti_pestana !== '' ? ' ' . $lumenti_pestana : '')); ?></span>
                        <span class="relative block h-[3px] w-full overflow-hidden bg-borde-frio">
                            <span class="absolute inset-0 origin-left bg-primario [transform:scaleX(0)] <?php echo $lumenti_i === 0 ? 'animate-llenar' : ''; ?>" data-hero-fill></span>
                        </span>
                    </button>
                <?php endforeach; ?>
            </div>

            <button type="button" class="grid size-8 flex-none animate-subir cursor-pointer place-items-center rounded-full text-cuerpo-2 transition-colors duration-200 hover:text-primario" style="animation-delay: 750ms" aria-label="<?php esc_attr_e('Pausar carrusel', 'lumenti'); ?>" data-label-pausar="<?php esc_attr_e('Pausar carrusel', 'lumenti'); ?>" data-label-reanudar="<?php esc_attr_e('Reanudar carrusel', 'lumenti'); ?>" data-hero-pausa>
                <span data-icono="pausa"><?php echo lumenti_icon('pausa', 'size-4'); ?></span>
                <span data-icono="play" hidden><?php echo lumenti_icon('play', 'size-4'); ?></span>
            </button>
        </div>
    <?php endif; ?>
</section>
