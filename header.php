<?php
/*
 * Cabecera del sitio (specs/opciones.md → cabecera). Textos, enlaces y menús fijos del diseño hasta el paso ACF:
 * logo de Identidad del sitio, menús `principal`, `servicios` y `tratamos`, campos opciones_cabecera_*.
 */
defined('ABSPATH') || exit;

$lumenti_wa_mensaje = 'Hola, quisiera agendar una cita.';
$lumenti_wa = ['url' => lumenti_whatsapp_url('paciente', $lumenti_wa_mensaje), 'title' => 'WhatsApp', 'target' => '_blank'];
// El botón flotante usa el número de la página (Empresas: corporativo).
$lumenti_wa_fab = lumenti_whatsapp_context() === 'corporativo'
    ? lumenti_whatsapp_url('corporativo', 'Hola, quisiera información sobre las soluciones de salud mental para empresas.')
    : $lumenti_wa['url'];

$lumenti_caret = '<svg class="lm-nav__caret" aria-hidden="true" width="16" height="16" viewBox="0 0 256 256" fill="currentColor"><path d="M213.66,101.66l-80,80a8,8,0,0,1-11.32,0l-80-80A8,8,0,0,1,53.66,90.34L128,164.69l74.34-74.35a8,8,0,0,1,11.32,11.32Z"/></svg>';
$lumenti_caret_m = '<svg aria-hidden="true" width="20" height="20" viewBox="0 0 256 256" fill="currentColor"><path d="M213.66,101.66l-80,80a8,8,0,0,1-11.32,0l-80-80A8,8,0,0,1,53.66,90.34L128,164.69l74.34-74.35a8,8,0,0,1,11.32,11.32Z"/></svg>';
$lumenti_flecha = '<svg aria-hidden="true" width="16" height="16" viewBox="0 0 256 256" fill="currentColor"><path d="M221.66,133.66l-72,72a8,8,0,0,1-11.32-11.32L196.69,136H40a8,8,0,0,1,0-16H196.69L138.34,61.66a8,8,0,0,1,11.32-11.32l72,72A8,8,0,0,1,221.66,133.66Z"/></svg>';

// Menú `servicios` (cards del mega menú).
$lumenti_servicios = [
    ['titulo' => 'PSIQUIATRÍA', 'corto' => 'Psiquiatría', 'texto' => 'Evaluación, diagnóstico y tratamiento integral.', 'imagen' => 'assets/img/mm-psiquiatria.webp', 'url' => home_url('/psiquiatria/')],
    ['titulo' => 'PSICOLOGÍA', 'corto' => 'Psicología', 'texto' => 'Psicoterapia y evaluaciones psicológicas basadas en evidencia.', 'imagen' => 'assets/img/mm-psicologia.webp', 'url' => home_url('/psicologia/')],
    ['titulo' => 'EMPRESAS', 'corto' => 'Empresas', 'texto' => 'Talleres y programas de salud mental para organizaciones.', 'imagen' => 'assets/img/mm-empresas.webp', 'url' => home_url('/empresas/')],
    ['titulo' => 'INFORMES Y CERTIFICADOS', 'corto' => 'Informes y certificados', 'texto' => 'Documentos clínicos elaborados previa evaluación profesional.', 'imagen' => 'assets/img/mm-informes.webp', 'url' => home_url('/informes/')],
];

// Menú `tratamos`: grupos (elementos padre) con sus condiciones.
$lumenti_tratamos = [
    'ESTADO DEL ÁNIMO' => [
        'depresion' => 'Depresión',
        'bipolar' => 'Trastorno bipolar',
        'personalidad' => 'Trastornos de la personalidad',
        'tdc' => 'Trastorno dismórfico corporal',
        'tdpm' => 'Trastorno disfórico premenstrual',
    ],
    'ANSIEDAD Y TRAUMA' => [
        'ansiedad' => 'Trastornos de ansiedad',
        'trauma' => 'Trauma y estrés postraumático (TEPT)',
        'toc' => 'Trastorno obsesivo compulsivo (TOC)',
        'adicciones' => 'Adicciones',
    ],
    'OTRAS CONDICIONES' => [
        'tca' => 'Trastornos de la conducta alimentaria (TCA)',
        'sueno' => 'Alteraciones del sueño',
        'psicosis' => 'Psicosis y esquizofrenia',
        'perinatal' => 'Salud mental perinatal',
        'tdah' => 'TDAH: evaluación y tratamiento',
        'autismo' => 'Autismo (TEA): acompañamiento clínico',
        'tlp' => 'Trastorno límite de la personalidad (TLP)',
    ],
];

// Menú `principal` (los dos con mega menú van como botón).
$lumenti_principal = [
    'inicio' => ['Inicio', home_url('/')],
    'servicios' => ['Servicios', null],
    'tratamos' => ['Qué tratamos', null],
    'especialistas' => ['Especialistas', home_url('/especialistas/')],
    'empresas' => ['Empresas', home_url('/empresas/')],
    'blog' => ['Blog', home_url('/blog/')],
];

// Redes del menú móvil (opciones_redes_items; URLs pendientes del cliente).
$lumenti_redes_movil = ['instagram-logo' => 'Instagram', 'facebook-logo' => 'Facebook', 'linkedin-logo' => 'LinkedIn', 'tiktok-logo' => 'TikTok'];
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
        <nav class="lm-nav" aria-label="Principal">
            <div class="lm-nav__bar">
                <a class="lm-nav__logo" href="<?= esc_url(home_url('/')) ?>" aria-label="Lumenti — Inicio" data-lm-mm-plain>
                    <img class="lm-nav__logo-img lm-nav__logo-img--light" src="<?= esc_url(get_theme_file_uri('assets/img/logo.svg')) ?>" alt="Lumenti" width="144" height="23">
                    <img class="lm-nav__logo-img lm-nav__logo-img--dark" src="<?= esc_url(get_theme_file_uri('assets/img/logo-white.svg')) ?>" alt="" aria-hidden="true" width="144" height="23">
                </a>

                <ul class="lm-nav__menu">
                    <?php foreach ($lumenti_principal as $key => [$texto, $url]) : ?>
                        <?php if ($url) : ?>
                            <li class="lm-nav__item" data-lm-mm-plain><a class="lm-nav__link" href="<?= esc_url($url) ?>" data-lm-nav-key="<?= esc_attr($key) ?>"<?= lumenti_nav_current($key) // phpcs:ignore -- atributo fijo ?>><?= esc_html($texto) ?></a></li>
                        <?php else : ?>
                            <li class="lm-nav__item"><button class="lm-nav__trigger" type="button" aria-expanded="false" aria-controls="lm-mm-<?= esc_attr($key) ?>" data-lm-mm-trigger data-lm-nav-key="<?= esc_attr($key) ?>"><?= esc_html($texto) ?><?= $lumenti_caret // phpcs:ignore -- SVG fijo ?></button></li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>

                <div class="lm-nav__actions" data-lm-mm-plain>
                    <a<?= lumenti_link_attrs($lumenti_wa, ['class' => 'lm-btn lm-btn--primary lm-nav__cta']) ?>>WhatsApp<span class="lm-btn__icon lm-icon--whatsapp" aria-hidden="true"></span></a>
                    <button class="lm-nav__burger" type="button" aria-expanded="false" aria-controls="lm-mobile-menu" aria-label="Abrir menú" data-lm-burger>
                        <svg class="lm-nav__burger-open" aria-hidden="true" width="24" height="24" viewBox="0 0 256 256" fill="currentColor"><path d="M224,128a8,8,0,0,1-8,8H40a8,8,0,0,1,0-16H216A8,8,0,0,1,224,128ZM40,72H216a8,8,0,0,0,0-16H40a8,8,0,0,0,0,16ZM216,184H40a8,8,0,0,0,0,16H216a8,8,0,0,0,0-16Z"/></svg>
                        <svg class="lm-nav__burger-close" aria-hidden="true" width="24" height="24" viewBox="0 0 256 256" fill="currentColor"><path d="M205.66,194.34a8,8,0,0,1-11.32,11.32L128,139.31,61.66,205.66a8,8,0,0,1-11.32-11.32L116.69,128,50.34,61.66A8,8,0,0,1,61.66,50.34L128,116.69l66.34-66.35a8,8,0,0,1,11.32,11.32L139.31,128Z"/></svg>
                    </button>
                </div>
            </div>

            <div class="lm-megamenu" id="lm-mm-servicios" role="region" aria-label="Servicios">
                <ul class="lm-megamenu__cards">
                    <?php foreach ($lumenti_servicios as $servicio) : ?>
                        <li class="lm-megamenu__stagger">
                            <?php get_template_part('template-parts/components/mm-card', null, $servicio); ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <p class="lm-megamenu__foot">¿No sabes cuál elegir?<a<?= lumenti_link_attrs($lumenti_wa, ['class' => 'lm-link-arrow']) ?>>Contáctanos<?= $lumenti_flecha // phpcs:ignore -- SVG fijo ?></a></p>
            </div>

            <div class="lm-megamenu" id="lm-mm-tratamos" role="region" aria-label="Qué tratamos">
                <div class="lm-megamenu__cols">
                    <?php foreach ($lumenti_tratamos as $grupo => $condiciones) : ?>
                        <div class="lm-megamenu__stagger">
                            <p class="lm-megamenu__col-title"><?= esc_html($grupo) ?></p>
                            <ul class="lm-megamenu__list">
                                <?php foreach ($condiciones as $slug => $nombre) : ?>
                                    <li><a class="lm-megamenu__link" href="<?= esc_url(home_url('/condicion/' . $slug . '/')) ?>"><?= esc_html($nombre) ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endforeach; ?>
                    <?php
                    get_template_part('template-parts/components/mm-card', null, [
                        'titulo' => '¿NO SABES QUÉ CONDICIÓN TE AFECTA?',
                        'cta' => 'Contáctanos',
                        'imagen' => 'assets/img/mm-tratamos.webp',
                        'ancho' => 1250,
                        'alto' => 770,
                        'url' => $lumenti_wa['url'],
                        'externo' => true,
                        'alta' => true,
                    ]);
                    ?>
                </div>
                <p class="lm-megamenu__foot">¿No sabes cuál elegir?<a<?= lumenti_link_attrs($lumenti_wa, ['class' => 'lm-link-arrow']) ?>>Contáctanos<?= $lumenti_flecha // phpcs:ignore -- SVG fijo ?></a></p>
            </div>

            <div class="lm-mobile-menu" id="lm-mobile-menu" hidden>
                <a class="lm-mobile-menu__link" href="<?= esc_url(home_url('/')) ?>" data-lm-nav-key="inicio"<?= lumenti_nav_current('inicio') // phpcs:ignore ?>>Inicio</a>

                <button class="lm-mobile-menu__toggle" type="button" aria-expanded="false" aria-controls="lm-msub-servicios" data-lm-sub-toggle data-lm-nav-key="servicios">Servicios<?= $lumenti_caret_m // phpcs:ignore -- SVG fijo ?></button>
                <div class="lm-mobile-menu__sub" id="lm-msub-servicios">
                    <div class="lm-mobile-menu__sub-inner">
                        <div class="lm-mobile-menu__sub-list">
                            <?php foreach ($lumenti_servicios as $servicio) : ?>
                                <a class="lm-mobile-menu__sub-link" href="<?= esc_url($servicio['url']) ?>"><?= esc_html($servicio['corto']) ?></a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <button class="lm-mobile-menu__toggle" type="button" aria-expanded="false" aria-controls="lm-msub-tratamos" data-lm-sub-toggle data-lm-nav-key="tratamos">Qué tratamos<?= $lumenti_caret_m // phpcs:ignore -- SVG fijo ?></button>
                <div class="lm-mobile-menu__sub" id="lm-msub-tratamos">
                    <div class="lm-mobile-menu__sub-inner">
                        <div class="lm-mobile-menu__sub-list lm-mobile-menu__sub-list--groups">
                            <?php foreach ($lumenti_tratamos as $grupo => $condiciones) : ?>
                                <div>
                                    <p class="lm-mobile-menu__sub-head"><?= esc_html($grupo) ?></p>
                                    <?php foreach ($condiciones as $slug => $nombre) : ?>
                                        <a class="lm-mobile-menu__sub-link" href="<?= esc_url(home_url('/condicion/' . $slug . '/')) ?>"><?= esc_html($nombre) ?></a>
                                    <?php endforeach; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <a class="lm-mobile-menu__link" href="<?= esc_url(home_url('/especialistas/')) ?>" data-lm-nav-key="especialistas"<?= lumenti_nav_current('especialistas') // phpcs:ignore ?>>Especialistas</a>
                <a class="lm-mobile-menu__link" href="<?= esc_url(home_url('/empresas/')) ?>" data-lm-nav-key="empresas"<?= lumenti_nav_current('empresas') // phpcs:ignore ?>>Empresas</a>
                <a class="lm-mobile-menu__link lm-mobile-menu__link--last" href="<?= esc_url(home_url('/blog/')) ?>" data-lm-nav-key="blog"<?= lumenti_nav_current('blog') // phpcs:ignore ?>>Blog</a>

                <div class="lm-mobile-menu__social">
                    <p class="lm-mobile-menu__social-title">SÍGUENOS</p>
                    <ul class="lm-mobile-menu__social-list">
                        <?php foreach ($lumenti_redes_movil as $icono => $red) : ?>
                            <?php // URLs de redes pendientes del cliente: el diseño trae href="#". ?>
                            <li><?php get_template_part('template-parts/components/icon-tile', null, ['icono' => $icono, 'url' => '#', 'etiqueta' => $red, 'variante' => ['light', 'sm']]); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="lm-mobile-menu__cta"><a<?= lumenti_link_attrs($lumenti_wa, ['class' => 'lm-btn lm-btn--primary']) ?>>WhatsApp<span class="lm-btn__icon lm-icon--whatsapp" aria-hidden="true"></span></a></div>
            </div>
        </nav>
        <a<?= lumenti_link_attrs(['url' => $lumenti_wa_fab, 'target' => '_blank'], ['class' => 'lm-fab', 'label' => 'Escríbenos por WhatsApp']) ?> data-lm-fab><span class="lm-fab__icon" aria-hidden="true"></span></a>
    </header>
