<?php
/*
 * Pie del sitio (specs/opciones.md → contacto, redes, pie). Textos y enlaces fijos del diseño hasta el paso ACF:
 * campos opciones_contacto_*, opciones_redes_*, opciones_pie_*; menús `servicios`, `pie_explora` y `legal`.
 */
defined('ABSPATH') || exit;

$lumenti_contacto = [
    ['icono' => 'calendar-dots', 'url' => 'tel:+51939033999', 'etiqueta' => 'Atención al paciente:', 'texto' => '+51 939 033 999', 'telefono' => true],
    ['icono' => 'chat-circle-dots', 'url' => 'tel:+51942901535', 'etiqueta' => 'Atención corporativa:', 'texto' => '+51 942 901 535', 'telefono' => true],
    ['icono' => 'envelope-simple', 'url' => 'mailto:contacto@lumentisaludmental.com', 'etiqueta' => '', 'texto' => 'contacto@lumentisaludmental.com'],
    ['icono' => 'map-pin', 'url' => 'https://maps.google.com/?q=C.+Los+Antares+320,+Santiago+de+Surco+15038', 'etiqueta' => '', 'texto' => 'C. Los Antares 320, Santiago de Surco 15038', 'externo' => true],
];

$lumenti_pie_servicios = [
    ['Psiquiatría', home_url('/psiquiatria/')],
    ['Psicología', home_url('/psicologia/')],
    ['Informes y certificados', home_url('/informes/')],
    ['Empresas', home_url('/empresas/')],
    ['Evaluaciones psicológicas', home_url('/psicologia/#evaluaciones')],
];

$lumenti_pie_explora = [
    ['Especialistas', home_url('/especialistas/')],
    ['Qué tratamos', home_url('/#que-tratamos')],
    ['Blog', home_url('/blog/')],
    ['Preguntas frecuentes', home_url('/preguntas-frecuentes/')],
];

// URLs de redes pendientes del cliente: el diseño trae href="#".
$lumenti_redes = ['x-logo' => 'X', 'facebook-logo' => 'Facebook', 'instagram-logo' => 'Instagram', 'youtube-logo' => 'YouTube', 'linkedin-logo' => 'LinkedIn', 'tiktok-logo' => 'TikTok'];
?>
    <footer class="lm-footer">
        <div class="lm-footer__main">
            <div class="lm-footer__grid">
                <div class="lm-footer__col lm-footer__col--contact">
                    <h2 class="lm-footer__title">CONTACTO</h2>
                    <ul class="lm-footer__contact">
                        <?php foreach ($lumenti_contacto as $dato) : ?>
                            <?php
                            $clase = 'lm-footer__contact-link' . (!empty($dato['telefono']) ? ' lm-footer__contact-link--phone' : '');
                            $enlace = ['url' => $dato['url'], 'target' => !empty($dato['externo']) ? '_blank' : ''];
                            ?>
                            <li>
                                <a<?= lumenti_link_attrs($enlace, ['class' => $clase]) ?>>
                                    <?php get_template_part('template-parts/components/icon-tile', null, ['icono' => $dato['icono']]); ?>
                                    <span><?php if ($dato['etiqueta'] !== '') : ?><strong><?= esc_html($dato['etiqueta']) ?></strong> <?php endif; ?><?= esc_html($dato['texto']) ?></span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <nav class="lm-footer__col" aria-label="Servicios">
                    <h2 class="lm-footer__title">SERVICIOS</h2>
                    <ul class="lm-footer__list">
                        <?php foreach ($lumenti_pie_servicios as [$texto, $url]) : ?>
                            <li><a class="lm-footer__link" href="<?= esc_url($url) ?>"><?= esc_html($texto) ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </nav>

                <nav class="lm-footer__col" aria-label="Explora">
                    <h2 class="lm-footer__title">EXPLORA</h2>
                    <ul class="lm-footer__list">
                        <?php foreach ($lumenti_pie_explora as [$texto, $url]) : ?>
                            <li><a class="lm-footer__link" href="<?= esc_url($url) ?>"><?= esc_html($texto) ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </nav>

                <div class="lm-footer__col">
                    <h2 class="lm-footer__title">SÍGUENOS</h2>
                    <ul class="lm-footer__social">
                        <?php foreach ($lumenti_redes as $icono => $red) : ?>
                            <li><?php get_template_part('template-parts/components/icon-tile', null, ['icono' => $icono, 'url' => '#', 'etiqueta' => $red, 'variante' => 'sm']); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <a class="lm-footer__brand" href="<?= esc_url(home_url('/')) ?>" aria-label="Lumenti — Inicio"><img src="<?= esc_url(get_theme_file_uri('assets/img/logo-white.svg')) ?>" alt="Lumenti" width="864" height="139" loading="lazy"></a>
        </div>
        <div class="lm-footer__bar">
            <div class="lm-footer__bar-inner">
                <p>© <?= esc_html(wp_date('Y')) ?> Lumenti · Todos los derechos reservados.</p>
                <nav class="lm-footer__legal" aria-label="Legal">
                    <a class="lm-footer__legal-link" href="<?= esc_url(home_url('/politica-de-privacidad/')) ?>">Política de privacidad</a>
                    <a class="lm-footer__legal-link" href="<?= esc_url(home_url('/terminos-y-condiciones/')) ?>">Términos y condiciones</a>
                    <a<?= lumenti_link_attrs(['url' => 'https://reclamovirtual.pe/reclamar/lumenti/libro', 'target' => '_blank'], ['class' => 'lm-footer__legal-link']) ?>>Libro de reclamaciones</a>
                </nav>
            </div>
        </div>
    </footer>
    <?php wp_footer(); ?>
</body>

</html>
