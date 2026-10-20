<?php
/**
 * Testimonios (portada): carrusel de tarjetas apiladas como un mazo, con flechas, puntos y arrastre.
 * Campos: grupo "Inicio · Testimonios" (acf-json/group_lumenti_inicio_testimonios.json).
 * Carrusel: src/js/sections/home/testimonios.js. Estilos: src/css/sections/home/testimonios.css.
 * Sin JS las tarjetas se ven en lista, una debajo de otra.
 */

if (!function_exists('get_field')) {
    return;
}

$lumenti_testimonios = [];
foreach ((array) get_field('testimonios_items') as $lumenti_fila) {
    // Las comillas las pone el diseño: se quitan las que haya pegado la clienta.
    $lumenti_cita = is_array($lumenti_fila) ? trim((string) ($lumenti_fila['texto'] ?? ''), " \t\n\r\"'“”«»") : '';
    if ($lumenti_cita === '') {
        continue;
    }
    $lumenti_testimonios[] = [
        'cita'      => $lumenti_cita,
        'nombre'    => trim((string) ($lumenti_fila['nombre'] ?? '')),
        'fuente'    => trim((string) ($lumenti_fila['fuente'] ?? '')),
        'estrellas' => max(1, min(5, (int) ($lumenti_fila['estrellas'] ?? 5) ?: 5)),
    ];
}
if (!$lumenti_testimonios) {
    return;
}

$lumenti_total = count($lumenti_testimonios);
$lumenti_lineas = array_values(array_filter(array_map('trim', preg_split('/\R/', (string) get_field('testimonios_titulo')))));
$lumenti_texto = trim((string) get_field('testimonios_texto'));
?>
<section class="testimonios overflow-hidden px-gutter pt-seccion" <?php echo $lumenti_lineas ? 'aria-labelledby="lumenti-testimonios-titulo"' : 'aria-label="' . esc_attr__('Testimonios', 'lumenti') . '"'; ?>>
    <?php if ($lumenti_lineas || $lumenti_texto !== '') : ?>
        <div class="mx-auto flex max-w-titulo flex-col items-center text-center" data-reveal>
            <?php if ($lumenti_lineas) : ?>
                <h2 id="lumenti-testimonios-titulo" class="text-h2 break-words uppercase">
                    <?php foreach ($lumenti_lineas as $lumenti_linea) : ?>
                        <span class="block"><?php echo esc_html($lumenti_linea); ?></span>
                    <?php endforeach; ?>
                </h2>
            <?php endif; ?>
            <?php if ($lumenti_texto !== '') : ?>
                <p class="mt-1 max-w-lead leading-[1.7] text-balance break-words text-cuerpo"><?php echo esc_html($lumenti_texto); ?></p>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <div class="mt-12 lg:mt-[clamp(48px,3.75vw,72px)]" data-reveal data-testimonios>
        <div class="testimonios-escena" role="region" aria-roledescription="<?php esc_attr_e('carrusel', 'lumenti'); ?>" aria-label="<?php esc_attr_e('Testimonios', 'lumenti'); ?>" data-testimonios-escena>
            <?php foreach ($lumenti_testimonios as $lumenti_i => $lumenti_t) : ?>
                <figure class="testimonio" role="group" aria-roledescription="<?php esc_attr_e('testimonio', 'lumenti'); ?>" aria-label="<?php echo esc_attr(sprintf(__('%1$d de %2$d', 'lumenti'), $lumenti_i + 1, $lumenti_total)); ?>" data-testimonio>
                    <blockquote class="text-quote tracking-[0.01em] text-pretty break-words text-cuerpo">“<?php echo esc_html($lumenti_t['cita']); ?>”</blockquote>
                    <figcaption class="flex items-end justify-between gap-6">
                        <span class="flex min-w-0 flex-col items-start">
                            <span class="flex gap-1.5 text-dorado" role="img" aria-label="<?php echo esc_attr(sprintf(__('%d de 5 estrellas', 'lumenti'), $lumenti_t['estrellas'])); ?>">
                                <?php for ($lumenti_e = 0; $lumenti_e < $lumenti_t['estrellas']; $lumenti_e++) : ?>
                                    <?php echo lumenti_icon('estrella', 'size-4.5'); ?>
                                <?php endfor; ?>
                            </span>
                            <?php if ($lumenti_t['nombre'] !== '') : ?>
                                <span class="mt-3.5 leading-6 break-words text-titulo"><?php echo esc_html($lumenti_t['nombre']); ?></span>
                            <?php endif; ?>
                            <?php if ($lumenti_t['fuente'] !== '') : ?>
                                <span class="leading-6 break-words text-tenue"><?php echo esc_html($lumenti_t['fuente']); ?></span>
                            <?php endif; ?>
                        </span>
                        <span class="flex flex-[0_1_190px] flex-col gap-5 pb-3.5" aria-hidden="true">
                            <span class="h-px bg-[#ecddd2]"></span>
                            <span class="h-px bg-[#ecddd2]"></span>
                            <span class="h-px w-[56%] bg-[#ecddd2]"></span>
                        </span>
                    </figcaption>
                </figure>
            <?php endforeach; ?>
        </div>

        <?php if ($lumenti_total > 1) : ?>
            <div class="mt-8 flex justify-center gap-8" hidden data-testimonios-controles>
                <button type="button" class="btn btn-primario size-12 p-0 [--btn-h:3rem] [--btn-px:0] [--btn-radius:9999px]" aria-label="<?php esc_attr_e('Testimonio anterior', 'lumenti'); ?>" data-testimonios-anterior>
                    <?php echo lumenti_icon('flecha', 'size-5 rotate-180'); ?>
                </button>
                <button type="button" class="btn btn-primario size-12 p-0 [--btn-h:3rem] [--btn-px:0] [--btn-radius:9999px]" aria-label="<?php esc_attr_e('Testimonio siguiente', 'lumenti'); ?>" data-testimonios-siguiente>
                    <?php echo lumenti_icon('flecha', 'size-5'); ?>
                </button>
            </div>
            <div class="mt-10 flex flex-wrap justify-center gap-2.5" hidden data-testimonios-puntos>
                <?php for ($lumenti_i = 0; $lumenti_i < $lumenti_total; $lumenti_i++) : ?>
                    <button type="button" class="testimonios-punto" aria-label="<?php echo esc_attr(sprintf(__('Ir al testimonio %d', 'lumenti'), $lumenti_i + 1)); ?>" data-testimonios-punto="<?php echo (int) $lumenti_i; ?>"><span></span></button>
                <?php endfor; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
