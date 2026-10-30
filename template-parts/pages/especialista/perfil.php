<?php
defined('ABSPATH') || exit;

/*
 * Especialista · perfil (specs/especialista.md → perfil). Grupo ACF: especialista_perfil.
 * Breadcrumb y cabecera del perfil: foto (imagen destacada de WordPress; si no hay, la del ejemplo),
 * nombre corto en h1, cargo, cargo destacado, colegiatura y el botón de WhatsApp (data-lm-profile-cta,
 * lo observa la barra fija). Datos fijos del ejemplo del diseño (Dra. Mariela Linares) hasta el paso ACF.
 */

$lumenti_perfil = [
    'nombre_corto' => 'Dra. Mariela Linares',
    'cargo' => 'Médica psiquiatra',
    'cargo_destacado' => 'Directora Médica de Lumenti',
    'colegiaturas' => ['CMP 080939', 'RNE 045256'], // Se muestran unidas con " | ".
    'foto' => 'assets/img/esp/mariela-linares.webp',
];

// Foto: imagen destacada del especialista (600 × 600) o la del ejemplo.
$lumenti_foto = has_post_thumbnail() ? get_post_thumbnail_id() : $lumenti_perfil['foto'];
$lumenti_nombre = $lumenti_perfil['nombre_corto'];

// "…con la Dra. X." / "…con el Dr. X." (Acción de _shared.md).
$lumenti_articulo = preg_match('/^Dra\.?\s/i', $lumenti_nombre) ? 'la ' : (preg_match('/^Dr\.?\s/i', $lumenti_nombre) ? 'el ' : '');
$lumenti_wa = lumenti_link_attrs(
    ['url' => lumenti_whatsapp_url('paciente', sprintf('Hola, quisiera agendar una cita con %s.', $lumenti_articulo . $lumenti_nombre)), 'target' => '_blank'],
    ['class' => 'lm-btn lm-btn--primary lm-profile__cta']
);

get_template_part('template-parts/components/breadcrumb', null, [
    'items' => [
        ['texto' => 'Especialistas', 'url' => home_url('/especialistas/')],
        ['texto' => $lumenti_nombre],
    ],
]);
?>
<section class="lm-profile__hero" aria-labelledby="lm-profile-name">
    <div class="lm-profile__avatar"><span class="lm-profile__avatar-halo" aria-hidden="true"></span><?= lumenti_theme_image($lumenti_foto, [
        'class' => 'lm-profile__photo',
        'alt' => sprintf('Foto de %s', $lumenti_nombre),
        'width' => 600,
        'height' => 600,
        'loading' => 'eager',
        'fetchpriority' => 'high',
        'size' => 'medium_large',
    ]) ?></div>
    <div class="lm-profile__identity">
        <h1 class="lm-profile__name" id="lm-profile-name"><?= esc_html(mb_strtoupper($lumenti_nombre, 'UTF-8')) ?></h1>
        <?php if ($lumenti_perfil['cargo'] !== '') : ?>
            <span class="lm-card-especialista__tag lm-card-especialista__tag--role lm-profile__role"><?= esc_html($lumenti_perfil['cargo']) ?></span>
        <?php endif; ?>
        <?php if ($lumenti_perfil['cargo_destacado'] !== '' || !empty($lumenti_perfil['colegiaturas'])) : ?>
            <p class="lm-profile__meta"><?php if ($lumenti_perfil['cargo_destacado'] !== '') : ?><span class="lm-profile__cargo"><?= esc_html($lumenti_perfil['cargo_destacado']) ?></span><?php endif; ?><?php if (!empty($lumenti_perfil['colegiaturas'])) : ?><span class="lm-profile__creds"><?= esc_html(implode(' | ', $lumenti_perfil['colegiaturas'])) ?></span><?php endif; ?></p>
        <?php endif; ?>
        <?php if ($lumenti_wa !== '') : ?>
            <a<?= $lumenti_wa ?> data-lm-profile-cta>Agendar por WhatsApp<span class="sr-only"> (<?= esc_html__('se abre en una pestaña nueva', 'lumenti') ?>)</span><span class="lm-btn__icon lm-icon--whatsapp" aria-hidden="true"></span></a>
        <?php endif; ?>
    </div>
</section>
