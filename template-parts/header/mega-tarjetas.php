<?php
/**
 * Mega menú de tarjetas (ej. "Servicios"): un ítem de menú con hijos sin nietos.
 * Cada tarjeta: título del ítem, "Descripción" del ítem (Apariencia → Menús → Opciones de
 * pantalla → Descripción) e imagen destacada de la página enlazada (sin imagen → fondo oscuro).
 *
 * $args: item (WP_Post con children), whatsapp (URL o '').
 */

$lumenti_item = $args['item'];
?>
<div id="mega-<?php echo (int) $lumenti_item->ID; ?>" class="mega-panel absolute inset-x-0 top-full z-10 hidden bg-white shadow-lg xl:block" role="region" aria-labelledby="mega-btn-<?php echo (int) $lumenti_item->ID; ?>" inert data-mega-panel>
    <div class="px-gutter-nav py-[clamp(28px,2.2vw,44px)]">
        <ul class="grid grid-cols-4 gap-4">
            <?php foreach ($lumenti_item->children as $lumenti_i => $lumenti_card) : ?>
                <?php
                $lumenti_attrs = lumenti_link_attrs(lumenti_menu_link($lumenti_card), [
                    'class' => 'group relative isolate flex aspect-[529/455] flex-col justify-end overflow-hidden rounded-md bg-[#151211] text-white hover:text-white',
                ]);
                $lumenti_tag = $lumenti_attrs !== '' ? 'a' : 'div';
                $lumenti_thumb = in_array($lumenti_card->type, ['post_type'], true)
                    ? get_post_thumbnail_id((int) $lumenti_card->object_id)
                    : 0;
                ?>
                <li class="mega-item" style="--i: <?php echo (int) $lumenti_i; ?>">
                    <<?php echo $lumenti_tag; ?><?php echo $lumenti_attrs !== '' ? $lumenti_attrs : ' class="relative isolate flex aspect-[529/455] flex-col justify-end overflow-hidden rounded-md bg-[#151211] text-white"'; ?>>
                        <?php
                        echo lumenti_image($lumenti_thumb, [
                            'size'  => 'medium_large',
                            'alt'   => '',
                            'class' => 'absolute inset-x-0 top-0 -z-20 h-[68%] w-full origin-[50%_40%] object-cover object-[50%_30%] transition-transform duration-900 ease-suave group-hover:scale-105',
                        ]);
                        ?>
                        <span class="absolute inset-0 -z-10 bg-[linear-gradient(180deg,rgb(21_18_17/0)_22%,rgb(21_18_17/0.55)_48%,#151211_68%)]" aria-hidden="true"></span>
                        <span class="block px-[clamp(20px,1.6vw,32px)] pb-[clamp(22px,1.8vw,34px)]">
                            <span class="flex items-center gap-2.5 font-titulo text-h4 uppercase">
                                <?php echo esc_html($lumenti_card->title); ?>
                                <?php echo lumenti_icon('flecha', 'size-[18px] flex-none transition-transform duration-400 ease-suave group-hover:translate-x-1'); ?>
                            </span>
                            <?php if (trim((string) $lumenti_card->description) !== '') : ?>
                                <span class="mt-2.5 block text-sm leading-[1.55] text-pretty text-white/80"><?php echo esc_html($lumenti_card->description); ?></span>
                            <?php endif; ?>
                        </span>
                    </<?php echo $lumenti_tag; ?>>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <?php get_template_part('template-parts/header/mega-pie', null, ['whatsapp' => $args['whatsapp']]); ?>
</div>
