<?php
/**
 * Footer: Contacto y Síguenos salen de Ajustes del sitio; Servicios, Explora y los enlaces
 * legales de Apariencia → Menús (el nombre de cada menú es el título de su columna).
 */

$lumenti_tel_paciente = (string) lumenti_ajuste('contacto_telefono_paciente');
$lumenti_tel_corporativo = (string) lumenti_ajuste('contacto_telefono_corporativo');
$lumenti_correo = (string) lumenti_ajuste('contacto_correo');
$lumenti_direccion = (string) lumenti_ajuste('contacto_direccion');
$lumenti_mapa = (string) lumenti_ajuste('contacto_mapa');
$lumenti_redes = lumenti_redes();
$lumenti_copyright = lumenti_copyright();
$lumenti_titulo_col = 'font-titulo text-[1.5rem] leading-[1.2] tracking-[0.01em] text-white';
$lumenti_link_col = 'text-inverso transition-colors duration-200 hover:text-white';

// Fila de contacto: mosaico con ícono + texto; enlazada si el enlace es válido.
$lumenti_fila = static function (string $icon, string $icon_size, string $html, $link) {
    $attrs = lumenti_link_attrs($link, ['class' => 'flex items-center gap-3 text-inverso transition-colors duration-200 hover:text-white']);
    $tile = '<span class="icono-tile">' . lumenti_icon($icon, $icon_size) . '</span>';
    $blank = ($link['target'] ?? '') === '_blank' && $attrs !== ''
        ? '<span class="sr-only">(' . esc_html__('se abre en una pestaña nueva', 'lumenti') . ')</span>'
        : '';

    return $attrs !== ''
        ? '<a' . $attrs . '>' . $tile . '<span class="[overflow-wrap:anywhere]">' . $html . '</span>' . $blank . '</a>'
        : '<span class="flex items-center gap-3">' . $tile . '<span>' . $html . '</span></span>';
};

$lumenti_columnas = array_filter([
    'footer-servicios' => lumenti_menu_arbol('footer-servicios'),
    'footer-explora'   => lumenti_menu_arbol('footer-explora'),
]);
$lumenti_legal = lumenti_menu_arbol('legal');
$lumenti_hay_contacto = $lumenti_tel_paciente . $lumenti_tel_corporativo . $lumenti_correo . $lumenti_direccion !== '';
?>
<footer class="bg-primario-700 text-inverso">
    <div class="contenedor pt-14 pb-14 md:pt-18 xl:py-20">
        <div class="grid grid-cols-1 gap-x-8 gap-y-12 md:grid-cols-2 xl:grid-cols-[minmax(0,1fr)_minmax(0,313px)_minmax(0,279px)_auto] xl:gap-0">
            <?php if ($lumenti_hay_contacto) : ?>
                <div class="md:col-span-full xl:col-span-1">
                    <h2 class="<?php echo esc_attr($lumenti_titulo_col); ?>"><?php esc_html_e('Contacto', 'lumenti'); ?></h2>
                    <ul class="mt-9 flex flex-col gap-4">
                        <?php if ($lumenti_tel_paciente !== '') : ?>
                            <li><?php echo $lumenti_fila('calendar-dots', 'size-6', '<strong class="font-semibold text-inverso">' . esc_html__('Atención al paciente:', 'lumenti') . '</strong> ' . esc_html($lumenti_tel_paciente), ['url' => 'tel:' . $lumenti_tel_paciente]); ?></li>
                        <?php endif; ?>
                        <?php if ($lumenti_tel_corporativo !== '') : ?>
                            <li><?php echo $lumenti_fila('chat-circle-dots', 'size-6', '<strong class="font-semibold text-inverso">' . esc_html__('Atención corporativa:', 'lumenti') . '</strong> ' . esc_html($lumenti_tel_corporativo), ['url' => 'tel:' . $lumenti_tel_corporativo]); ?></li>
                        <?php endif; ?>
                        <?php if ($lumenti_correo !== '') : ?>
                            <li><?php echo $lumenti_fila('envelope-simple', 'size-5', esc_html($lumenti_correo), ['url' => 'mailto:' . $lumenti_correo]); ?></li>
                        <?php endif; ?>
                        <?php if ($lumenti_direccion !== '') : ?>
                            <li><?php echo $lumenti_fila('map-pin', 'size-6', esc_html($lumenti_direccion), ['url' => $lumenti_mapa, 'target' => '_blank']); ?></li>
                        <?php endif; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <?php foreach ($lumenti_columnas as $lumenti_location => $lumenti_items) : ?>
                <?php $lumenti_nombre = lumenti_menu_nombre($lumenti_location); ?>
                <nav aria-label="<?php echo esc_attr($lumenti_nombre); ?>">
                    <h2 class="<?php echo esc_attr($lumenti_titulo_col); ?>"><?php echo esc_html($lumenti_nombre); ?></h2>
                    <ul class="mt-9 flex flex-col gap-[23px]">
                        <?php foreach ($lumenti_items as $lumenti_item) : ?>
                            <li>
                                <?php
                                $lumenti_html = lumenti_link(lumenti_menu_link($lumenti_item), [
                                    'class'   => $lumenti_link_col,
                                    'current' => lumenti_menu_es_actual($lumenti_item),
                                ]);
                                echo $lumenti_html !== '' ? $lumenti_html : '<span>' . esc_html($lumenti_item->title) . '</span>';
                                ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </nav>
            <?php endforeach; ?>

            <?php if ($lumenti_redes) : ?>
                <div>
                    <h2 class="<?php echo esc_attr($lumenti_titulo_col); ?>"><?php esc_html_e('Síguenos', 'lumenti'); ?></h2>
                    <ul class="mt-8 grid grid-cols-[repeat(3,3rem)] gap-4">
                        <?php foreach ($lumenti_redes as $lumenti_red) : ?>
                            <li>
                                <a<?php echo lumenti_link_attrs(['url' => $lumenti_red['url'], 'target' => '_blank'], [
                                    'class' => 'icono-tile',
                                    'label' => sprintf(__('%s (se abre en una pestaña nueva)', 'lumenti'), $lumenti_red['nombre']),
                                ]); ?>>
                                    <?php echo lumenti_icon($lumenti_red['red'], 'size-[22px]'); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
        </div>

        <a href="<?php echo esc_url(home_url('/')); ?>" class="mt-18 block w-full max-w-[864px] text-white hover:text-white xl:mt-[110px]" rel="home" aria-label="<?php echo esc_attr(sprintf(__('%s — Inicio', 'lumenti'), get_bloginfo('name'))); ?>">
            <?php
            $lumenti_logo = lumenti_image(lumenti_ajuste('footer_logo'), ['class' => 'h-auto w-full', 'alt' => '']);
            echo $lumenti_logo !== ''
                ? $lumenti_logo
                : '<span class="font-titulo text-[clamp(3rem,8vw,7.5rem)] leading-none">' . esc_html(get_bloginfo('name')) . '</span>';
            ?>
        </a>
    </div>

    <?php if ($lumenti_copyright !== '' || $lumenti_legal) : ?>
        <div class="bg-primario-900">
            <div class="contenedor flex min-h-[59px] flex-wrap items-center justify-between gap-x-8 gap-y-3 py-4 max-xl:pb-[calc(88px+env(safe-area-inset-bottom,0px))]">
                <?php if ($lumenti_copyright !== '') : ?>
                    <p class="text-white"><?php echo esc_html($lumenti_copyright); ?></p>
                <?php endif; ?>
                <?php if ($lumenti_legal) : ?>
                    <nav aria-label="<?php esc_attr_e('Legal', 'lumenti'); ?>">
                        <ul class="flex flex-wrap gap-x-8 gap-y-3">
                            <?php foreach ($lumenti_legal as $lumenti_item) : ?>
                                <li>
                                    <?php
                                    $lumenti_html = lumenti_link(lumenti_menu_link($lumenti_item), [
                                        'class'   => 'text-white transition-colors duration-200 hover:text-inverso',
                                        'current' => lumenti_menu_es_actual($lumenti_item),
                                    ]);
                                    echo $lumenti_html !== '' ? $lumenti_html : '<span class="text-white">' . esc_html($lumenti_item->title) . '</span>';
                                    ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </nav>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
</footer>
