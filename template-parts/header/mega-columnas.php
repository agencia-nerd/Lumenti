<?php
/**
 * Mega menú de columnas (ej. "Qué tratamos"): cada hijo es el título de una columna y sus
 * hijos son los enlaces. A la derecha, la tarjeta de Ajustes del sitio → Tarjeta del menú.
 *
 * $args: item (WP_Post con children), whatsapp (URL o '').
 */

$lumenti_item = $args['item'];

// Tarjeta: sin título no se muestra; sin enlace válido lleva a WhatsApp; sin texto, "Contáctanos".
$lumenti_promo_titulo = trim((string) lumenti_ajuste('promo_titulo'));
$lumenti_promo_link = is_array(lumenti_ajuste('promo_enlace')) ? lumenti_ajuste('promo_enlace') : [];
if (trim((string) ($lumenti_promo_link['title'] ?? '')) === '') {
    $lumenti_promo_link['title'] = __('Contáctanos', 'lumenti');
}
if (!lumenti_link_data($lumenti_promo_link) && $args['whatsapp'] !== '') {
    $lumenti_promo_link['url'] = $args['whatsapp'];
    $lumenti_promo_link['target'] = '_blank';
}
$lumenti_promo_data = lumenti_link_data($lumenti_promo_link);
$lumenti_cols = count($lumenti_item->children);
?>
<div id="mega-<?php echo (int) $lumenti_item->ID; ?>" class="mega-panel absolute inset-x-0 top-full z-10 hidden bg-white shadow-lg xl:block" role="region" aria-labelledby="mega-btn-<?php echo (int) $lumenti_item->ID; ?>" inert data-mega-panel>
    <div class="grid gap-[clamp(24px,2vw,40px)] px-gutter-nav py-[clamp(28px,2.2vw,44px)]" style="grid-template-columns: repeat(<?php echo (int) $lumenti_cols; ?>, minmax(0, 1fr))<?php echo $lumenti_promo_titulo !== '' ? ' minmax(0, 1.05fr)' : ''; ?>;">
        <?php foreach ($lumenti_item->children as $lumenti_i => $lumenti_group) : ?>
            <div class="mega-item" style="--i: <?php echo (int) $lumenti_i; ?>">
                <p class="font-titulo text-titulo-lg text-primario uppercase"><?php echo esc_html($lumenti_group->title); ?></p>
                <ul class="mt-7 flex flex-col gap-1">
                    <?php foreach ($lumenti_group->children as $lumenti_link) : ?>
                        <li>
                            <?php
                            echo lumenti_link(lumenti_menu_link($lumenti_link), [
                                'class'   => 'inline-flex min-h-11 items-center leading-[22px] text-ui transition-[color,translate] duration-300 ease-suave hover:translate-x-1 hover:text-primario',
                                'current' => lumenti_menu_es_actual($lumenti_link),
                            ]);
                            ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endforeach; ?>

        <?php if ($lumenti_promo_titulo !== '') : ?>
            <?php $lumenti_tag = $lumenti_promo_data ? 'a' : 'div'; ?>
            <div class="mega-item" style="--i: <?php echo (int) $lumenti_cols + 1; ?>">
                <<?php echo $lumenti_tag; ?><?php echo $lumenti_promo_data ? lumenti_link_attrs($lumenti_promo_link) : ''; ?> class="group relative isolate flex h-full min-h-[clamp(360px,24vw,470px)] flex-col justify-end overflow-hidden rounded-md bg-[#151211] text-white hover:text-white">
                    <?php
                    echo lumenti_image(lumenti_ajuste('promo_imagen'), [
                        'size'  => 'medium_large',
                        'alt'   => '',
                        'class' => 'absolute inset-x-0 top-0 -z-20 h-[76%] w-full origin-[50%_40%] object-cover object-[50%_40%] transition-transform duration-900 ease-suave group-hover:scale-105',
                    ]);
                    ?>
                    <span class="absolute inset-0 -z-10 bg-[linear-gradient(180deg,rgb(21_18_17/0)_30%,rgb(21_18_17/0.6)_58%,#151211_78%)]" aria-hidden="true"></span>
                    <span class="block px-7 pb-8">
                        <span class="block font-titulo text-titulo-lg text-balance uppercase"><?php echo esc_html($lumenti_promo_titulo); ?></span>
                        <?php if ($lumenti_promo_data && $lumenti_promo_data['title'] !== '') : ?>
                            <span class="mt-3.5 inline-flex items-center gap-1.5 font-semibold">
                                <?php echo esc_html($lumenti_promo_data['title']); ?>
                                <?php echo lumenti_icon('flecha', 'size-4 transition-transform duration-300 ease-suave group-hover:translate-x-1'); ?>
                            </span>
                        <?php endif; ?>
                        <?php if ($lumenti_promo_data && $lumenti_promo_data['blank']) : ?>
                            <span class="sr-only">(<?php esc_html_e('se abre en una pestaña nueva', 'lumenti'); ?>)</span>
                        <?php endif; ?>
                    </span>
                </<?php echo $lumenti_tag; ?>>
            </div>
        <?php endif; ?>
    </div>

    <?php get_template_part('template-parts/header/mega-pie', null, ['whatsapp' => $args['whatsapp']]); ?>
</div>
