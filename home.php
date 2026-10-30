<?php

/**
 * Blog: página de entradas (Ajustes → Lectura → "Página de entradas"). Spec: specs/blog.md.
 * category.php reutiliza esta plantilla (las secciones cambian con is_category()).
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="main-content">
    <div class="lm-blog" data-lm-blog>
        <?php get_template_part('template-parts/pages/blog/encabezado'); ?>
        <section class="lm-blog__content" aria-label="<?= esc_attr__('Artículos', 'lumenti') ?>">
            <?php
            get_template_part('template-parts/pages/blog/filtros');
            get_template_part('template-parts/pages/blog/destacado');
            get_template_part('template-parts/pages/blog/resultados');
            get_template_part('template-parts/pages/blog/paginacion');
            ?>
        </section>
    </div>
    <?php
    // Blog → cta (grupo ACF blog_cta). El form del newsletter es de wp-form: template-parts/forms/newsletter.php.
    get_template_part('template-parts/components/cta', null, [
        'id' => 'lm-cta-blog',
        'titulo' => 'MANTENTE AL DÍA CON NUESTRO CONTENIDO.',
        'texto' => 'Artículos sobre salud mental escritos por nuestros especialistas. Novedades, recursos y contenido educativo, directo a tu correo y sin spam.',
        'newsletter' => true,
        'form' => [
            'email_label' => 'Correo electrónico',
            'email_placeholder' => 'Tu correo electrónico',
            'email_error' => 'Ingresa un correo válido.',
            'privacidad_texto' => 'Acepto la Política de privacidad y recibir contenidos de Lumenti por correo.',
            'privacidad_enlace_texto' => 'Política de privacidad',
            'privacidad_url' => home_url('/politica-de-privacidad/'),
            'privacidad_error' => 'Debes aceptar la Política de privacidad.',
            'boton' => 'Suscribirme',
            'exito' => '¡Listo! Te suscribiste. Pronto recibirás nuestros artículos en tu correo.',
            'honeypot_label' => 'No completar',
        ],
    ]);
    ?>
</main>

<?php
get_footer();
