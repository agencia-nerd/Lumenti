<?php
/**
 * Sobre Lumenti (portada): antetítulo, frase y una tarjeta con el logo de la que salen dos fotos
 * en abanico al hacer scroll.
 * Campos: grupo "Inicio · Sobre Lumenti" (acf-json/group_lumenti_inicio_sobre.json).
 * Abanico: src/js/sections/home/sobre.js + src/css/sections/home/sobre.css.
 */

if (!function_exists('get_field')) {
    return;
}

$lumenti_antetitulo = trim((string) get_field('sobre_antetitulo'));
$lumenti_texto = trim((string) get_field('sobre_texto'));

// Foto izquierda y derecha; una sin imagen (vacía o borrada) no se imprime.
$lumenti_fotos = array_filter([
    'izq' => lumenti_image(get_field('sobre_foto_1'), ['class' => 'absolute inset-[6%] z-1 size-[88%] rounded-sm object-cover']),
    'der' => lumenti_image(get_field('sobre_foto_2'), ['class' => 'absolute inset-[6%] z-1 size-[88%] rounded-sm object-cover']),
]);

if ($lumenti_antetitulo === '' && $lumenti_texto === '' && !$lumenti_fotos) {
    return;
}

// Logo de la tarjeta: el propio de la sección o, si queda vacío, el logo blanco del pie de página.
$lumenti_logo_campo = get_field('sobre_logo') ?: lumenti_ajuste('footer_logo');
$lumenti_logo_data = lumenti_image_data($lumenti_logo_campo);
$lumenti_logo = lumenti_image($lumenti_logo_campo, [
    'class' => 'block h-auto w-[62%]',
    'alt' => ($lumenti_logo_data['alt'] ?? '') ?: get_bloginfo('name'),
]);
?>
<section class="flex flex-col items-center overflow-x-clip pt-seccion pb-seccion-lg text-center" <?php echo $lumenti_antetitulo !== '' ? 'aria-labelledby="lumenti-sobre-titulo"' : ''; ?>>
    <?php if ($lumenti_antetitulo !== '' || $lumenti_texto !== '') : ?>
        <div class="flex w-full max-w-prosa min-w-0 flex-col items-center px-5" data-reveal>
            <?php if ($lumenti_antetitulo !== '') : ?>
                <h2 id="lumenti-sobre-titulo" class="eyebrow text-primario uppercase"><?php echo esc_html($lumenti_antetitulo); ?></h2>
            <?php endif; ?>
            <?php if ($lumenti_texto !== '') : ?>
                <p class="text-statement text-balance break-words text-titulo<?php echo $lumenti_antetitulo !== '' ? ' mt-5' : ''; ?>"><?php echo lumenti_highlight($lumenti_texto); ?></p>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <div class="relative mt-10 aspect-[440/540] w-[clamp(150px,20vw,384px)] md:mt-14 lg:mt-18" data-sobre-abanico>
        <?php foreach ($lumenti_fotos as $lumenti_lado => $lumenti_foto) : ?>
            <?php // La foto va envuelta para que el abanico (transform) no choque con las clases de la imagen. ?>
            <div class="absolute inset-0" data-sobre-foto="<?php echo esc_attr($lumenti_lado); ?>">
                <?php echo $lumenti_foto; ?>
            </div>
        <?php endforeach; ?>
        <div class="absolute inset-0 z-2 grid place-items-center rounded-sm bg-primario">
            <?php echo $lumenti_logo; ?>
        </div>
    </div>
</section>
