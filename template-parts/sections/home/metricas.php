<?php
/**
 * Métricas de la portada ("Lumenti en cifras"): números que cuentan desde 0 al aparecer.
 * Campos: grupo "Inicio · Métricas" (acf-json/group_lumenti_inicio_metricas.json).
 * Conteo: src/js/contador.js. Entrada al hacer scroll: src/js/reveal.js.
 */

if (!function_exists('get_field')) {
    return;
}

$lumenti_cifras = array_values(array_filter(
    (array) get_field('metricas_cifras'),
    static fn($c): bool => is_array($c) && trim((string) ($c['numero'] ?? '')) !== ''
));
if (!$lumenti_cifras) {
    return;
}
?>
<section class="bg-fondo-suave px-5 pt-14 pb-16 md:px-10 md:pt-18 md:pb-20 lg:px-[clamp(24px,5.2vw,100px)] lg:pt-24 lg:pb-25" aria-label="<?php esc_attr_e('Lumenti en cifras', 'lumenti'); ?>">
    <div class="mx-auto flex max-w-[1536px] flex-col items-center gap-8 md:flex-row md:items-stretch md:justify-between">
        <?php foreach ($lumenti_cifras as $lumenti_i => $lumenti_cifra) : ?>
            <?php if ($lumenti_i > 0) : ?>
                <span class="h-px w-16 flex-none bg-borde-frio md:mt-1 md:h-auto md:w-px md:self-stretch" aria-hidden="true"></span>
            <?php endif; ?>

            <div class="flex max-w-[340px] min-w-0 flex-1 flex-col items-center text-center" style="--reveal-i: <?php echo (int) $lumenti_i; ?>" data-reveal>
                <span class="font-titulo text-stat whitespace-nowrap text-titulo tabular-nums">
                    <span aria-hidden="true" data-contador><?php echo esc_html(trim($lumenti_cifra['numero'])); ?></span>
                    <span class="sr-only"><?php echo esc_html(trim($lumenti_cifra['numero'])); ?></span>
                </span>
                <?php if (trim((string) ($lumenti_cifra['titulo'] ?? '')) !== '') : ?>
                    <span class="mt-1 leading-6 text-primario-700"><?php echo esc_html($lumenti_cifra['titulo']); ?></span>
                <?php endif; ?>
                <?php if (trim((string) ($lumenti_cifra['texto'] ?? '')) !== '') : ?>
                    <span class="mt-2 leading-6 text-balance text-cuerpo"><?php echo esc_html($lumenti_cifra['texto']); ?></span>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</section>
