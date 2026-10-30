<?php
/*
 * Cabecera del sitio (specs/opciones.md → cabecera, redes). Logo de Personalizar > Identidad del sitio,
 * logo blanco y textos de Ajustes del sitio (opciones_cabecera, opciones_redes), menús `principal`,
 * `servicios` y `tratamos` (Apariencia > Menús). En `principal`, los elementos con la clase
 * lm-mega-servicios / lm-mega-tratamos abren su mega menú.
 */
defined('ABSPATH') || exit;

$lumenti_cab = get_field('opciones_cabecera', 'option') ?: [];
$lumenti_redes = get_field('opciones_redes', 'option') ?: [];

$lumenti_wa = [
    'url' => lumenti_whatsapp_url('paciente', (string) ($lumenti_cab['mensaje_whatsapp'] ?? '')),
    'title' => (string) ($lumenti_cab['boton_texto'] ?? ''),
    'target' => '_blank',
];
// El botón flotante usa el número de la página (Empresas: corporativo; su mensaje pasa a ACF con Empresas).
$lumenti_wa_fab = lumenti_whatsapp_context() === 'corporativo'
    ? lumenti_whatsapp_url('corporativo', 'Hola, quisiera información sobre las soluciones de salud mental para empresas.')
    : $lumenti_wa['url'];

$lumenti_principal = lumenti_menu_tree('principal');
$lumenti_servicios = lumenti_menu_tree('servicios');
$lumenti_tratamos = lumenti_menu_tree('tratamos');

// Mega menú de un elemento del menú principal ('servicios', 'tratamos' o '').
$lumenti_mega = static function (array $item): string {
    foreach (['servicios', 'tratamos'] as $mega) {
        if (in_array('lm-mega-' . $mega, $item['clases'], true)) {
            return $mega;
        }
    }

    return '';
};

// Redes con enlace; en el menú móvil solo Instagram, Facebook, LinkedIn y TikTok (como el diseño).
$lumenti_redes_nombres = ['x' => 'X', 'facebook' => 'Facebook', 'instagram' => 'Instagram', 'youtube' => 'YouTube', 'linkedin' => 'LinkedIn', 'tiktok' => 'TikTok'];
$lumenti_redes_movil = array_filter(
    (array) ($lumenti_redes['items'] ?? []),
    static fn($red) => !empty($red['enlace']) && in_array($red['red'] ?? '', ['instagram', 'facebook', 'linkedin', 'tiktok'], true)
);

$lumenti_logo = (int) get_theme_mod('custom_logo');
$lumenti_ayuda_texto = (string) ($lumenti_cab['ayuda_texto'] ?? '');
$lumenti_ayuda_enlace = (string) ($lumenti_cab['ayuda_enlace'] ?? '');

$lumenti_caret = '<svg class="lm-nav__caret" aria-hidden="true" width="16" height="16" viewBox="0 0 256 256" fill="currentColor"><path d="M213.66,101.66l-80,80a8,8,0,0,1-11.32,0l-80-80A8,8,0,0,1,53.66,90.34L128,164.69l74.34-74.35a8,8,0,0,1,11.32,11.32Z"/></svg>';
$lumenti_caret_m = '<svg aria-hidden="true" width="20" height="20" viewBox="0 0 256 256" fill="currentColor"><path d="M213.66,101.66l-80,80a8,8,0,0,1-11.32,0l-80-80A8,8,0,0,1,53.66,90.34L128,164.69l74.34-74.35a8,8,0,0,1,11.32,11.32Z"/></svg>';
$lumenti_flecha = '<svg aria-hidden="true" width="16" height="16" viewBox="0 0 256 256" fill="currentColor"><path d="M221.66,133.66l-72,72a8,8,0,0,1-11.32-11.32L196.69,136H40a8,8,0,0,1,0-16H196.69L138.34,61.66a8,8,0,0,1,11.32-11.32l72,72A8,8,0,0,1,221.66,133.66Z"/></svg>';
$lumenti_nueva = '<span class="sr-only"> (' . esc_html__('se abre en una pestaña nueva', 'lumenti') . ')</span>';

// Pie de cada mega menú: texto de ayuda y enlace de contacto (opciones_cabecera_ayuda_*).
$lumenti_mega_pie = static function () use ($lumenti_ayuda_texto, $lumenti_ayuda_enlace, $lumenti_wa, $lumenti_flecha, $lumenti_nueva) {
    if ($lumenti_ayuda_texto === '' && $lumenti_ayuda_enlace === '') {
        return;
    }
    ?>
    <p class="lm-megamenu__foot"><?= esc_html($lumenti_ayuda_texto) ?><?php if ($lumenti_ayuda_enlace !== '' && $lumenti_wa['url'] !== '') : ?><a<?= lumenti_link_attrs($lumenti_wa, ['class' => 'lm-link-arrow']) ?>><?= esc_html($lumenti_ayuda_enlace) ?><?= $lumenti_nueva ?><?= $lumenti_flecha // phpcs:ignore -- SVG fijo ?></a><?php endif; ?></p>
    <?php
};

// Botón de la cabecera y del menú móvil (opciones_cabecera_boton_texto).
$lumenti_wa_boton = static function (string $clase) use ($lumenti_wa, $lumenti_nueva) {
    if ($lumenti_wa['url'] === '' || $lumenti_wa['title'] === '') {
        return;
    }
    ?>
    <a<?= lumenti_link_attrs($lumenti_wa, ['class' => $clase]) ?>><?= esc_html($lumenti_wa['title']) ?><?= $lumenti_nueva ?><span class="lm-btn__icon lm-icon--whatsapp" aria-hidden="true"></span></a>
    <?php
};
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?><?= lumenti_whatsapp_context() === 'corporativo' ? ' data-lm-wa-context="empresas"' : '' ?>>
    <?php wp_body_open(); ?>
    <a class="sr-only focus:not-sr-only" href="#main-content"><?php esc_html_e('Saltar al contenido', 'lumenti'); ?></a>

    <header class="lm-header" data-lm-navbar>
        <span class="lm-header__backdrop" aria-hidden="true"></span>
        <nav class="lm-nav" aria-label="<?php esc_attr_e('Principal', 'lumenti'); ?>">
            <div class="lm-nav__bar">
                <a class="lm-nav__logo" href="<?= esc_url(home_url('/')) ?>" aria-label="<?= esc_attr(get_bloginfo('name')) ?>" data-lm-mm-plain>
                    <?= lumenti_image($lumenti_logo, ['class' => 'lm-nav__logo-img lm-nav__logo-img--light', 'alt' => get_bloginfo('name'), 'loading' => 'eager', 'fetchpriority' => 'auto']) ?>
                    <?= lumenti_image($lumenti_cab['logo_alternativo'] ?? null, ['class' => 'lm-nav__logo-img lm-nav__logo-img--dark', 'alt' => '', 'loading' => 'eager', 'fetchpriority' => 'auto']) ?>
                </a>

                <ul class="lm-nav__menu">
                    <?php foreach ($lumenti_principal as $lumenti_item) : ?>
                        <?php $lumenti_m = $lumenti_mega($lumenti_item); ?>
                        <?php if ($lumenti_m !== '') : ?>
                            <li class="lm-nav__item"><button class="lm-nav__trigger" type="button" aria-expanded="false" aria-controls="lm-mm-<?= esc_attr($lumenti_m) ?>" data-lm-mm-trigger><?= esc_html($lumenti_item['titulo']) ?><?= $lumenti_caret // phpcs:ignore -- SVG fijo ?></button></li>
                        <?php else : ?>
                            <li class="lm-nav__item" data-lm-mm-plain><a<?= lumenti_link_attrs(lumenti_menu_link($lumenti_item), ['class' => 'lm-nav__link']) ?><?= $lumenti_item['actual'] ? ' aria-current="page"' : '' ?>><?= esc_html($lumenti_item['titulo']) ?></a></li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>

                <div class="lm-nav__actions" data-lm-mm-plain>
                    <?php $lumenti_wa_boton('lm-btn lm-btn--primary lm-nav__cta'); ?>
                    <button class="lm-nav__burger" type="button" aria-expanded="false" aria-controls="lm-mobile-menu" aria-label="<?php esc_attr_e('Abrir menú', 'lumenti'); ?>" data-lm-burger>
                        <svg class="lm-nav__burger-open" aria-hidden="true" width="24" height="24" viewBox="0 0 256 256" fill="currentColor"><path d="M224,128a8,8,0,0,1-8,8H40a8,8,0,0,1,0-16H216A8,8,0,0,1,224,128ZM40,72H216a8,8,0,0,0,0-16H40a8,8,0,0,0,0,16ZM216,184H40a8,8,0,0,0,0,16H216a8,8,0,0,0,0-16Z"/></svg>
                        <svg class="lm-nav__burger-close" aria-hidden="true" width="24" height="24" viewBox="0 0 256 256" fill="currentColor"><path d="M205.66,194.34a8,8,0,0,1-11.32,11.32L128,139.31,61.66,205.66a8,8,0,0,1-11.32-11.32L116.69,128,50.34,61.66A8,8,0,0,1,61.66,50.34L128,116.69l66.34-66.35a8,8,0,0,1,11.32,11.32L139.31,128Z"/></svg>
                    </button>
                </div>
            </div>

            <div class="lm-megamenu" id="lm-mm-servicios" role="region" aria-label="<?php esc_attr_e('Servicios', 'lumenti'); ?>">
                <ul class="lm-megamenu__cards">
                    <?php foreach ($lumenti_servicios as $lumenti_item) : ?>
                        <li class="lm-megamenu__stagger">
                            <?php get_template_part('template-parts/components/mm-card', null, [
                                'titulo' => mb_strtoupper($lumenti_item['titulo']),
                                'texto' => $lumenti_item['descripcion'],
                                'imagen' => $lumenti_item['pagina'] ? (int) get_post_thumbnail_id($lumenti_item['pagina']) : 0,
                                'url' => $lumenti_item['url'],
                                'externo' => $lumenti_item['externo'],
                            ]); ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <?php $lumenti_mega_pie(); ?>
            </div>

            <div class="lm-megamenu" id="lm-mm-tratamos" role="region" aria-label="<?php esc_attr_e('Qué tratamos', 'lumenti'); ?>">
                <div class="lm-megamenu__cols">
                    <?php foreach ($lumenti_tratamos as $lumenti_grupo) : ?>
                        <div class="lm-megamenu__stagger">
                            <p class="lm-megamenu__col-title"><?= esc_html($lumenti_grupo['titulo']) ?></p>
                            <ul class="lm-megamenu__list">
                                <?php foreach ($lumenti_grupo['hijos'] as $lumenti_item) : ?>
                                    <li><a<?= lumenti_link_attrs(lumenti_menu_link($lumenti_item), ['class' => 'lm-megamenu__link']) ?><?= $lumenti_item['actual'] ? ' aria-current="page"' : '' ?>><?= esc_html($lumenti_item['titulo']) ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endforeach; ?>
                    <?php
                    if (!empty($lumenti_cab['tratamos_titulo']) && $lumenti_wa['url'] !== '') {
                        get_template_part('template-parts/components/mm-card', null, [
                            'titulo' => $lumenti_cab['tratamos_titulo'],
                            'cta' => $lumenti_ayuda_enlace,
                            'imagen' => $lumenti_cab['tratamos_imagen'] ?? 0,
                            'ancho' => 1250,
                            'alto' => 770,
                            'url' => $lumenti_wa['url'],
                            'externo' => true,
                            'alta' => true,
                        ]);
                    }
                    ?>
                </div>
                <?php $lumenti_mega_pie(); ?>
            </div>

            <div class="lm-mobile-menu" id="lm-mobile-menu" hidden>
                <?php
                $lumenti_ultimo = null;
                foreach ($lumenti_principal as $lumenti_i => $lumenti_item) {
                    if ($lumenti_mega($lumenti_item) === '') {
                        $lumenti_ultimo = $lumenti_i;
                    }
                }
                ?>
                <?php foreach ($lumenti_principal as $lumenti_i => $lumenti_item) : ?>
                    <?php $lumenti_m = $lumenti_mega($lumenti_item); ?>
                    <?php if ($lumenti_m === '') : ?>
                        <a<?= lumenti_link_attrs(lumenti_menu_link($lumenti_item), ['class' => 'lm-mobile-menu__link' . ($lumenti_i === $lumenti_ultimo ? ' lm-mobile-menu__link--last' : '')]) ?><?= $lumenti_item['actual'] ? ' aria-current="page"' : '' ?>><?= esc_html($lumenti_item['titulo']) ?></a>
                    <?php else : ?>
                        <button class="lm-mobile-menu__toggle" type="button" aria-expanded="false" aria-controls="lm-msub-<?= esc_attr($lumenti_m) ?>" data-lm-sub-toggle><?= esc_html($lumenti_item['titulo']) ?><?= $lumenti_caret_m // phpcs:ignore -- SVG fijo ?></button>
                        <div class="lm-mobile-menu__sub" id="lm-msub-<?= esc_attr($lumenti_m) ?>">
                            <div class="lm-mobile-menu__sub-inner">
                                <?php if ($lumenti_m === 'servicios') : ?>
                                    <div class="lm-mobile-menu__sub-list">
                                        <?php foreach ($lumenti_servicios as $lumenti_sub) : ?>
                                            <a<?= lumenti_link_attrs(lumenti_menu_link($lumenti_sub), ['class' => 'lm-mobile-menu__sub-link']) ?>><?= esc_html($lumenti_sub['titulo']) ?></a>
                                        <?php endforeach; ?>
                                    </div>
                                <?php else : ?>
                                    <div class="lm-mobile-menu__sub-list lm-mobile-menu__sub-list--groups">
                                        <?php foreach ($lumenti_tratamos as $lumenti_grupo) : ?>
                                            <div>
                                                <p class="lm-mobile-menu__sub-head"><?= esc_html($lumenti_grupo['titulo']) ?></p>
                                                <?php foreach ($lumenti_grupo['hijos'] as $lumenti_sub) : ?>
                                                    <a<?= lumenti_link_attrs(lumenti_menu_link($lumenti_sub), ['class' => 'lm-mobile-menu__sub-link']) ?>><?= esc_html($lumenti_sub['titulo']) ?></a>
                                                <?php endforeach; ?>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>

                <?php if ($lumenti_redes_movil) : ?>
                    <div class="lm-mobile-menu__social">
                        <p class="lm-mobile-menu__social-title"><?php esc_html_e('SÍGUENOS', 'lumenti'); ?></p>
                        <ul class="lm-mobile-menu__social-list">
                            <?php foreach ($lumenti_redes_movil as $lumenti_red) : ?>
                                <li><?php get_template_part('template-parts/components/icon-tile', null, [
                                    'icono' => $lumenti_red['red'] . '-logo',
                                    'url' => $lumenti_red['enlace'],
                                    'etiqueta' => $lumenti_redes_nombres[$lumenti_red['red']] ?? '',
                                    'variante' => ['light', 'sm'],
                                    'nueva' => true,
                                ]); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <div class="lm-mobile-menu__cta"><?php $lumenti_wa_boton('lm-btn lm-btn--primary'); ?></div>
            </div>
        </nav>
        <?php if ($lumenti_wa_fab !== '') : ?>
            <a<?= lumenti_link_attrs(['url' => $lumenti_wa_fab, 'target' => '_blank'], ['class' => 'lm-fab', 'label' => __('Escríbenos por WhatsApp (se abre en una pestaña nueva)', 'lumenti')]) ?> data-lm-fab><span class="lm-fab__icon" aria-hidden="true"></span></a>
        <?php endif; ?>
    </header>
