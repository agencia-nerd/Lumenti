<?php
defined('ABSPATH') || exit;

/*
 * Especialista · perfil (specs/especialista.md → perfil). Grupo ACF: especialista_perfil.
 * Breadcrumb y cabecera del perfil: foto (imagen destacada de WordPress), nombre corto en h1, cargo,
 * cargo destacado, colegiaturas y el botón de WhatsApp (data-lm-profile-cta, lo observa la barra fija).
 * El orden no es un campo: se arrastra en Especialistas > Ordenar (inc/especialistas-orden.php).
 */

$lumenti_perfil = get_field('especialista_perfil') ?: [];
$lumenti_nombre = trim((string) ($lumenti_perfil['nombre_corto'] ?? ''));
$lumenti_cargo = (string) ($lumenti_perfil['cargo'] ?? '');
$lumenti_cargo_destacado = (string) ($lumenti_perfil['cargo_destacado'] ?? '');
$lumenti_colegiaturas = array_values(array_filter(array_map(
    static fn($fila) => trim((string) ($fila['registro'] ?? '')),
    (array) ($lumenti_perfil['colegiaturas'] ?? [])
)));

$lumenti_wa = lumenti_link_attrs(
    ['url' => lumenti_especialista_whatsapp($lumenti_nombre), 'target' => '_blank'],
    ['class' => 'lm-btn lm-btn--primary lm-profile__cta']
);

get_template_part('template-parts/components/breadcrumb', null, [
    'items' => [
        ['texto' => post_type_archive_title('', false) ?: __('Especialistas', 'lumenti'), 'url' => (string) get_post_type_archive_link('especialista')],
        ['texto' => $lumenti_nombre],
    ],
]);
?>
<section class="lm-profile__hero" aria-labelledby="lm-profile-name">
    <?php if (has_post_thumbnail()) : ?>
        <div class="lm-profile__avatar"><span class="lm-profile__avatar-halo" aria-hidden="true"></span><?= lumenti_image(get_post_thumbnail_id(), [
            'class' => 'lm-profile__photo',
            'alt' => $lumenti_nombre !== '' ? sprintf(__('Foto de %s', 'lumenti'), $lumenti_nombre) : null,
            'loading' => 'eager',
            'fetchpriority' => 'high',
            'size' => 'medium_large',
        ]) ?></div>
    <?php endif; ?>
    <div class="lm-profile__identity">
        <h1 class="lm-profile__name" id="lm-profile-name"><?= esc_html(mb_strtoupper($lumenti_nombre, 'UTF-8')) ?></h1>
        <?php if ($lumenti_cargo !== '') : ?>
            <span class="lm-card-especialista__tag lm-card-especialista__tag--role lm-profile__role"><?= esc_html($lumenti_cargo) ?></span>
        <?php endif; ?>
        <?php if ($lumenti_cargo_destacado !== '' || $lumenti_colegiaturas) : ?>
            <p class="lm-profile__meta"><?php if ($lumenti_cargo_destacado !== '') : ?><span class="lm-profile__cargo"><?= esc_html($lumenti_cargo_destacado) ?></span><?php endif; ?><?php if ($lumenti_colegiaturas) : ?><span class="lm-profile__creds"><?= esc_html(implode(' | ', $lumenti_colegiaturas)) ?></span><?php endif; ?></p>
        <?php endif; ?>
        <?php if ($lumenti_wa !== '') : ?>
            <a<?= $lumenti_wa ?> data-lm-profile-cta><?= esc_html__('Agendar por WhatsApp', 'lumenti') ?><span class="sr-only"> (<?= esc_html__('se abre en una pestaña nueva', 'lumenti') ?>)</span><span class="lm-btn__icon lm-icon--whatsapp" aria-hidden="true"></span></a>
        <?php endif; ?>
    </div>
</section>
