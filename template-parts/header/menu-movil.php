<?php
/**
 * Menú móvil y tablet (<1200): mismos ítems que el menú de escritorio. Los ítems con hijos
 * son acordeones (uno abierto a la vez); al final, redes sociales y botón de WhatsApp.
 *
 * $args: menu (árbol de lumenti_menu_arbol), whatsapp (URL o ''), item_color (callable).
 */

$lumenti_redes = lumenti_redes();
$lumenti_link_movil = static function (WP_Post $item, string $class) {
    $attrs = lumenti_link_attrs(lumenti_menu_link($item), [
        'class'   => $class,
        'current' => lumenti_menu_es_actual($item),
    ]);

    return $attrs !== ''
        ? '<a' . $attrs . '>' . esc_html($item->title) . '</a>'
        : '<span class="' . esc_attr($class) . '">' . esc_html($item->title) . '</span>';
};
?>
<div id="menu-movil" class="absolute inset-x-0 top-full z-10 flex h-[calc(100dvh-var(--spacing-nav))] animate-menu-entra flex-col overflow-y-auto overscroll-contain bg-fondo-alt px-4 pb-[calc(24px+env(safe-area-inset-bottom,0px))] xl:hidden" hidden data-menu-panel>
    <ul>
        <?php foreach ($args['menu'] as $lumenti_item) : ?>
            <li class="border-t border-borde-frio last:border-b">
                <?php if ($lumenti_item->children) : ?>
                    <button type="button" class="group flex min-h-15 w-full cursor-pointer items-center justify-between text-left text-[19px] <?php echo esc_attr(($args['item_color'])($lumenti_item)); ?>" aria-expanded="false" aria-controls="movil-sub-<?php echo (int) $lumenti_item->ID; ?>" data-acordeon-trigger>
                        <?php echo esc_html($lumenti_item->title); ?>
                        <?php echo lumenti_icon('chevron', 'size-5 transition-transform duration-400 ease-suave group-aria-expanded:rotate-180'); ?>
                    </button>
                    <div id="movil-sub-<?php echo (int) $lumenti_item->ID; ?>" class="grid grid-rows-[0fr] transition-[grid-template-rows] duration-500 ease-suave data-open:grid-rows-[1fr]" inert data-acordeon-panel>
                        <div class="overflow-hidden">
                            <?php if (lumenti_menu_tipo($lumenti_item) === 'tarjetas') : ?>
                                <ul class="flex flex-col pb-3 pl-4">
                                    <?php foreach ($lumenti_item->children as $lumenti_child) : ?>
                                        <li><?php echo $lumenti_link_movil($lumenti_child, 'flex min-h-11 items-center text-[17px] text-cuerpo-2 hover:text-ui'); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php else : ?>
                                <div class="flex flex-col gap-9 pt-3 pb-7 pl-4">
                                    <?php foreach ($lumenti_item->children as $lumenti_group) : ?>
                                        <div>
                                            <p class="mb-2.5 text-sm tracking-[0.08em] text-primario uppercase"><?php echo esc_html($lumenti_group->title); ?></p>
                                            <ul class="flex flex-col">
                                                <?php foreach ($lumenti_group->children as $lumenti_child) : ?>
                                                    <li><?php echo $lumenti_link_movil($lumenti_child, 'flex min-h-12 items-center text-[17px] text-cuerpo-2 hover:text-ui'); ?></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php else : ?>
                    <?php echo $lumenti_link_movil($lumenti_item, 'flex min-h-15 items-center text-[19px] hover:text-ui ' . ($args['item_color'])($lumenti_item)); ?>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>

    <div class="mt-auto">
        <?php if ($lumenti_redes) : ?>
            <div class="flex flex-col gap-3.5 pt-14 pb-1">
                <p class="text-sm tracking-[0.08em] text-primario uppercase"><?php esc_html_e('Síguenos', 'lumenti'); ?></p>
                <ul class="flex flex-wrap gap-2.5">
                    <?php foreach ($lumenti_redes as $lumenti_red) : ?>
                        <li>
                            <a<?php echo lumenti_link_attrs(['url' => $lumenti_red['url'], 'target' => '_blank'], [
                                'class' => 'icono-tile icono-tile-claro',
                                'label' => sprintf(__('%s (se abre en una pestaña nueva)', 'lumenti'), $lumenti_red['nombre']),
                            ]); ?>>
                                <?php echo lumenti_icon($lumenti_red['red'], 'size-[22px]'); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php if ($args['whatsapp'] !== '') : ?>
            <div class="sticky bottom-0 -mx-4 bg-fondo-alt px-4 pt-5">
                <a<?php echo lumenti_link_attrs(['url' => $args['whatsapp'], 'target' => '_blank'], ['class' => 'btn btn-primario w-full [--btn-fs:1.1875rem] [--btn-h:4rem]']); ?>>
                    WhatsApp
                    <?php echo lumenti_icon('whatsapp', 'size-[18px]'); ?>
                    <span class="sr-only">(<?php esc_html_e('se abre en una pestaña nueva', 'lumenti'); ?>)</span>
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>
