<?php
/**
 * Navbar: barra fija arriba, menú de escritorio con mega menús (≥1200) y menú móvil (<1200).
 * Ítems: Apariencia → Menús → "Menú principal". Logo: Personalizar → Identidad del sitio.
 * El comportamiento (abrir, cerrar, teclado) está en src/js/header.js.
 */

$lumenti_menu = lumenti_menu_arbol('primary');
$lumenti_whatsapp = lumenti_whatsapp_url();

// Color del ítem según si es la página actual (o la contiene).
$lumenti_item_color = static fn(WP_Post $item): string => $item->is_current
    ? 'text-ui font-medium'
    : 'text-cuerpo-2';
?>
<header class="sticky top-[var(--wp-admin--admin-bar--height,0px)] z-20" data-navbar>
    <span class="pointer-events-none fixed inset-0 bg-ui/10 opacity-0 transition-opacity duration-500 data-open:pointer-events-auto data-open:opacity-100 max-xl:hidden" aria-hidden="true" data-nav-backdrop></span>

    <nav class="relative z-10 bg-fondo-alt" aria-label="<?php esc_attr_e('Principal', 'lumenti'); ?>">
        <div class="relative z-20 grid h-nav grid-cols-[1fr_auto_1fr] items-center bg-fondo-alt pr-2.5 pl-5 md:pr-7.5 md:pl-10 xl:px-gutter-nav">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="flex w-fit" rel="home" aria-label="<?php echo esc_attr(sprintf(__('%s — Inicio', 'lumenti'), get_bloginfo('name'))); ?>">
                <?php
                $lumenti_logo = lumenti_image(get_theme_mod('custom_logo'), [
                    'class'   => 'h-auto w-[132px] md:w-[150px] xl:w-[166px]',
                    'alt'     => '',
                    'loading' => 'eager',
                ]);
                if ($lumenti_logo !== '') {
                    echo $lumenti_logo;
                } else {
                    echo '<span class="font-titulo text-titulo-lg text-titulo">' . esc_html(get_bloginfo('name')) . '</span>';
                }
                ?>
            </a>

            <?php if ($lumenti_menu) : ?>
                <ul class="hidden items-center gap-3 xl:flex">
                    <?php foreach ($lumenti_menu as $lumenti_item) : ?>
                        <?php if ($lumenti_item->children) : ?>
                            <li data-mega-li>
                                <button type="button" id="mega-btn-<?php echo (int) $lumenti_item->ID; ?>" class="group flex h-12 cursor-pointer items-center gap-2 rounded-sm px-4 leading-6 transition-[color,background-color] duration-300 hover:text-ui aria-expanded:bg-primario/7 aria-expanded:text-primario <?php echo esc_attr($lumenti_item_color($lumenti_item)); ?>" aria-expanded="false" aria-controls="mega-<?php echo (int) $lumenti_item->ID; ?>" data-mega-trigger>
                                    <?php echo esc_html($lumenti_item->title); ?>
                                    <?php echo lumenti_icon('chevron', 'size-4 transition-transform duration-400 ease-suave group-aria-expanded:rotate-180'); ?>
                                </button>
                            </li>
                        <?php else : ?>
                            <li data-mega-plain>
                                <?php
                                $lumenti_attrs = lumenti_link_attrs(lumenti_menu_link($lumenti_item), [
                                    'class'   => 'flex h-12 items-center px-3.5 leading-6 transition-colors duration-200 hover:text-ui ' . $lumenti_item_color($lumenti_item),
                                    'current' => lumenti_menu_es_actual($lumenti_item),
                                ]);
                                ?>
                                <?php if ($lumenti_attrs !== '') : ?>
                                    <a<?php echo $lumenti_attrs; ?>><?php echo esc_html($lumenti_item->title); ?></a>
                                <?php else : ?>
                                    <span class="flex h-12 items-center px-3.5 leading-6 text-cuerpo-2"><?php echo esc_html($lumenti_item->title); ?></span>
                                <?php endif; ?>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <div class="col-start-3 flex items-center justify-self-end" data-mega-plain>
                <?php if ($lumenti_whatsapp !== '') : ?>
                    <div class="hidden xl:block">
                        <a href="<?php echo esc_url($lumenti_whatsapp); ?>" class="btn btn-primario" target="_blank" rel="noopener noreferrer">
                            WhatsApp
                            <?php echo lumenti_icon('whatsapp', 'size-[18px]'); ?>
                            <span class="sr-only">(<?php esc_html_e('se abre en una pestaña nueva', 'lumenti'); ?>)</span>
                        </a>
                    </div>
                <?php endif; ?>

                <?php if ($lumenti_menu) : ?>
                    <button type="button" class="group grid size-11 cursor-pointer place-items-center text-ui xl:hidden" aria-expanded="false" aria-controls="menu-movil" aria-label="<?php esc_attr_e('Abrir menú', 'lumenti'); ?>" data-label-abrir="<?php esc_attr_e('Abrir menú', 'lumenti'); ?>" data-label-cerrar="<?php esc_attr_e('Cerrar menú', 'lumenti'); ?>" data-menu-toggle>
                        <?php echo lumenti_icon('menu', 'size-6 group-aria-expanded:hidden'); ?>
                        <?php echo lumenti_icon('cerrar', 'hidden size-6 group-aria-expanded:block'); ?>
                    </button>
                <?php endif; ?>
            </div>
        </div>

        <?php
        foreach ($lumenti_menu as $lumenti_item) {
            if ($lumenti_item->children) {
                get_template_part('template-parts/header/mega-' . lumenti_menu_tipo($lumenti_item), null, [
                    'item'     => $lumenti_item,
                    'whatsapp' => $lumenti_whatsapp,
                ]);
            }
        }

        if ($lumenti_menu) {
            get_template_part('template-parts/header/menu-movil', null, [
                'menu'       => $lumenti_menu,
                'whatsapp'   => $lumenti_whatsapp,
                'item_color' => $lumenti_item_color,
            ]);
        }
        ?>
    </nav>
</header>
