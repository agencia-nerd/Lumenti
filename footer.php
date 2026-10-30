<?php
/*
 * Pie del sitio (specs/opciones.md → contacto, redes). Datos de Ajustes del sitio (opciones_contacto,
 * opciones_redes, logo blanco de opciones_cabecera) y menús `pie_servicios`, `pie_explora` y `legal`
 * (Apariencia > Menús). Los títulos de las columnas y el copyright son fijos (no son campos).
 */
defined('ABSPATH') || exit;

$lumenti_contacto = get_field('opciones_contacto', 'option') ?: [];
$lumenti_redes = get_field('opciones_redes', 'option') ?: [];
$lumenti_cab = get_field('opciones_cabecera', 'option') ?: [];

$lumenti_tel = static fn(string $numero): string => 'tel:+' . preg_replace('/\D+/', '', $numero);
$lumenti_datos = array_filter([
    ['icono' => 'calendar-dots', 'url' => $lumenti_tel((string) ($lumenti_contacto['telefono_paciente'] ?? '')), 'etiqueta' => __('Atención al paciente:', 'lumenti'), 'texto' => (string) ($lumenti_contacto['telefono_paciente'] ?? ''), 'telefono' => true],
    ['icono' => 'chat-circle-dots', 'url' => $lumenti_tel((string) ($lumenti_contacto['telefono_corporativo'] ?? '')), 'etiqueta' => __('Atención corporativa:', 'lumenti'), 'texto' => (string) ($lumenti_contacto['telefono_corporativo'] ?? ''), 'telefono' => true],
    ['icono' => 'envelope-simple', 'url' => 'mailto:' . ($lumenti_contacto['correo'] ?? ''), 'etiqueta' => '', 'texto' => (string) ($lumenti_contacto['correo'] ?? '')],
    ['icono' => 'map-pin', 'url' => 'https://maps.google.com/?q=' . rawurlencode((string) ($lumenti_contacto['direccion'] ?? '')), 'etiqueta' => '', 'texto' => (string) ($lumenti_contacto['direccion'] ?? ''), 'externo' => true],
], static fn($dato) => $dato['texto'] !== '');

$lumenti_redes_nombres = ['x' => 'X', 'facebook' => 'Facebook', 'instagram' => 'Instagram', 'youtube' => 'YouTube', 'linkedin' => 'LinkedIn', 'tiktok' => 'TikTok'];
$lumenti_redes_items = array_filter((array) ($lumenti_redes['items'] ?? []), static fn($red) => !empty($red['enlace']));

$lumenti_columnas = [
    ['titulo' => __('SERVICIOS', 'lumenti'), 'menu' => lumenti_menu_tree('pie_servicios'), 'label' => __('Servicios', 'lumenti')],
    ['titulo' => __('EXPLORA', 'lumenti'), 'menu' => lumenti_menu_tree('pie_explora'), 'label' => __('Explora', 'lumenti')],
];
$lumenti_legal = lumenti_menu_tree('legal');
$lumenti_nueva = '<span class="sr-only"> (' . esc_html__('se abre en una pestaña nueva', 'lumenti') . ')</span>';
?>
    <footer class="lm-footer">
        <div class="lm-footer__main">
            <div class="lm-footer__grid">
                <div class="lm-footer__col lm-footer__col--contact">
                    <h2 class="lm-footer__title"><?php esc_html_e('CONTACTO', 'lumenti'); ?></h2>
                    <ul class="lm-footer__contact">
                        <?php foreach ($lumenti_datos as $lumenti_dato) : ?>
                            <?php $lumenti_clase = 'lm-footer__contact-link' . (!empty($lumenti_dato['telefono']) ? ' lm-footer__contact-link--phone' : ''); ?>
                            <li>
                                <a<?= lumenti_link_attrs(['url' => $lumenti_dato['url'], 'target' => !empty($lumenti_dato['externo']) ? '_blank' : ''], ['class' => $lumenti_clase]) ?>>
                                    <?php get_template_part('template-parts/components/icon-tile', null, ['icono' => $lumenti_dato['icono']]); ?>
                                    <span><?php if ($lumenti_dato['etiqueta'] !== '') : ?><strong><?= esc_html($lumenti_dato['etiqueta']) ?></strong> <?php endif; ?><?= esc_html($lumenti_dato['texto']) ?><?php if (!empty($lumenti_dato['externo'])) : ?><?= $lumenti_nueva ?><?php endif; ?></span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <?php foreach ($lumenti_columnas as $lumenti_col) : ?>
                    <?php if (!$lumenti_col['menu']) {
                        continue;
                    } ?>
                    <nav class="lm-footer__col" aria-label="<?= esc_attr($lumenti_col['label']) ?>">
                        <h2 class="lm-footer__title"><?= esc_html($lumenti_col['titulo']) ?></h2>
                        <ul class="lm-footer__list">
                            <?php foreach ($lumenti_col['menu'] as $lumenti_item) : ?>
                                <li><?= lumenti_link(lumenti_menu_link($lumenti_item), ['class' => 'lm-footer__link', 'current' => true]) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </nav>
                <?php endforeach; ?>

                <?php if ($lumenti_redes_items) : ?>
                    <div class="lm-footer__col">
                        <h2 class="lm-footer__title"><?php esc_html_e('SÍGUENOS', 'lumenti'); ?></h2>
                        <ul class="lm-footer__social">
                            <?php foreach ($lumenti_redes_items as $lumenti_red) : ?>
                                <li><?php get_template_part('template-parts/components/icon-tile', null, [
                                    'icono' => $lumenti_red['red'] . '-logo',
                                    'url' => $lumenti_red['enlace'],
                                    'etiqueta' => $lumenti_redes_nombres[$lumenti_red['red']] ?? '',
                                    'variante' => 'sm',
                                    'nueva' => true,
                                ]); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
            <?php $lumenti_logo_pie = lumenti_image($lumenti_cab['logo_alternativo'] ?? null, ['alt' => get_bloginfo('name')]); ?>
            <?php if ($lumenti_logo_pie !== '') : ?>
                <a class="lm-footer__brand" href="<?= esc_url(home_url('/')) ?>" aria-label="<?= esc_attr(get_bloginfo('name')) ?>"><?= $lumenti_logo_pie ?></a>
            <?php endif; ?>
        </div>
        <div class="lm-footer__bar">
            <div class="lm-footer__bar-inner">
                <p>© <?= esc_html(wp_date('Y')) ?> <?= esc_html(get_bloginfo('name')) ?> · <?php esc_html_e('Todos los derechos reservados.', 'lumenti'); ?></p>
                <?php if ($lumenti_legal) : ?>
                    <nav class="lm-footer__legal" aria-label="<?php esc_attr_e('Legal', 'lumenti'); ?>">
                        <?php foreach ($lumenti_legal as $lumenti_item) : ?>
                            <?= lumenti_link(lumenti_menu_link($lumenti_item), ['class' => 'lm-footer__legal-link', 'current' => true]) ?>
                        <?php endforeach; ?>
                    </nav>
                <?php endif; ?>
            </div>
        </div>
    </footer>
    <?php wp_footer(); ?>
</body>

</html>
