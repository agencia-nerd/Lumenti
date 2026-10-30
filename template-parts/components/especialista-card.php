<?php
defined('ABSPATH') || exit;

/*
 * Card de especialista (.lm-card-especialista). Diseño: html/partials/card-especialista.html, css/components.css §10.
 * Imprime solo el <article>: el <li> que lo envuelve es de la sección (listado o carrusel).
 *
 * $args:
 *   nombre           (string, sí)  nombre corto, ej. 'Dra. Mariela Linares' (se muestra en mayúsculas).
 *   url              (string, sí)  ficha del especialista.
 *   cargo            (string)  etiqueta principal (ej. 'Médica psiquiatra').
 *   cargo_destacado  (string)  segunda etiqueta (ej. 'Directora médica de Lumenti').
 *   foto             ('assets/img/esp/x.webp' | imagen ACF | ID)  cuadrada; decorativa (alt="").
 *   tipo             (psiquiatra | psicologo)  data-tipo, para las pills del carrusel y el filtro.
 *   poblacion        (array de textos)
 *   atiende          (array)  textos, o ['texto' => 'Depresión', 'clave' => 'dep'] (la clave va a data-atiende).
 *   visibles         (int)  chips de "Qué atiende" visibles; el resto va al popover "+N". Por defecto 6.
 *   idiomas          (array de textos)
 *   whatsapp         (string)  mensaje de "Agenda tu cita"; vacío = "Hola, quisiera agendar una cita con la Dra./el Dr. {nombre}."
 *   whatsapp_contexto (paciente | corporativo)  por defecto paciente.
 *   nivel            (h2 | h3)  h2 en el listado, h3 en carruseles. Por defecto h2.
 */

$lumenti_nombre = trim((string) ($args['nombre'] ?? ''));
$lumenti_url = (string) ($args['url'] ?? '');
if ($lumenti_nombre === '') {
    return;
}
$lumenti_nivel = ($args['nivel'] ?? '') === 'h3' ? 'h3' : 'h2';
$lumenti_cargo = (string) ($args['cargo'] ?? '');
$lumenti_destacado = (string) ($args['cargo_destacado'] ?? '');
$lumenti_tipo = (string) ($args['tipo'] ?? '');
$lumenti_poblacion = array_values(array_filter(array_map('strval', (array) ($args['poblacion'] ?? []))));
$lumenti_idiomas = array_values(array_filter(array_map('strval', (array) ($args['idiomas'] ?? []))));
$lumenti_visibles = max(0, (int) ($args['visibles'] ?? 6));

$lumenti_atiende = [];
foreach ((array) ($args['atiende'] ?? []) as $lumenti_a) {
    $lumenti_texto = is_array($lumenti_a) ? (string) ($lumenti_a['texto'] ?? '') : (string) $lumenti_a;
    if ($lumenti_texto !== '') {
        $lumenti_atiende[] = ['texto' => $lumenti_texto, 'clave' => is_array($lumenti_a) ? (string) ($lumenti_a['clave'] ?? '') : ''];
    }
}
$lumenti_total = count($lumenti_atiende);
$lumenti_extra = max(0, $lumenti_total - $lumenti_visibles);
$lumenti_claves = array_filter(array_column($lumenti_atiende, 'clave'));

$lumenti_mensaje = (string) ($args['whatsapp'] ?? '');
if ($lumenti_mensaje === '') {
    $lumenti_articulo = preg_match('/^Dra\.?\s/i', $lumenti_nombre) ? 'la ' : (preg_match('/^Dr\.?\s/i', $lumenti_nombre) ? 'el ' : '');
    $lumenti_mensaje = sprintf(__('Hola, quisiera agendar una cita con %s.', 'lumenti'), $lumenti_articulo . $lumenti_nombre);
}
$lumenti_contexto = ($args['whatsapp_contexto'] ?? '') === 'corporativo' ? 'corporativo' : 'paciente';
$lumenti_foto = lumenti_theme_image($args['foto'] ?? '', ['class' => 'lm-card-especialista__photo', 'alt' => '', 'width' => 600, 'height' => 600, 'size' => 'medium_large']);
?>
<article class="lm-card-especialista" data-lm-specialist data-tipo="<?= esc_attr($lumenti_tipo) ?>" data-nombre="<?= esc_attr($lumenti_nombre) ?>" data-poblacion="<?= esc_attr(implode('|', $lumenti_poblacion)) ?>" data-atiende="<?= esc_attr(implode('|', $lumenti_claves)) ?>" data-idiomas="<?= esc_attr(implode('|', $lumenti_idiomas)) ?>">
    <div class="lm-card-especialista__head">
        <?php if ($lumenti_foto !== '') : ?>
            <a class="lm-card-especialista__avatar" href="<?= esc_url($lumenti_url) ?>" tabindex="-1" aria-hidden="true"><?= $lumenti_foto ?></a>
        <?php endif; ?>
        <div class="lm-card-especialista__identity">
            <<?= $lumenti_nivel ?> class="lm-card-especialista__name"><a class="lm-card-especialista__name-link" href="<?= esc_url($lumenti_url) ?>"><?= esc_html(mb_strtoupper($lumenti_nombre, 'UTF-8')) ?></a></<?= $lumenti_nivel ?>>
            <?php if ($lumenti_cargo !== '' || $lumenti_destacado !== '') : ?>
                <div class="lm-card-especialista__tags"><?php if ($lumenti_cargo !== '') : ?><span class="lm-card-especialista__tag lm-card-especialista__tag--role"><?= esc_html($lumenti_cargo) ?></span><?php endif; ?><?php if ($lumenti_destacado !== '') : ?><span class="lm-card-especialista__tag"><?= esc_html($lumenti_destacado) ?></span><?php endif; ?></div>
            <?php endif; ?>
        </div>
    </div>
    <span class="lm-card-especialista__divider" aria-hidden="true"></span>
    <div class="lm-card-especialista__details">
        <?php if ($lumenti_poblacion) : ?>
            <p class="lm-card-especialista__label"><svg class="lm-card-especialista__label-icon" aria-hidden="true" width="16" height="16" viewBox="0 0 256 256" fill="currentColor"><path d="M230.92,212c-15.23-26.33-38.7-45.21-66.09-54.16a72,72,0,1,0-73.66,0C63.78,166.78,40.31,185.66,25.08,212a8,8,0,1,0,13.85,8c18.84-32.56,52.14-52,89.07-52s70.23,19.44,89.07,52a8,8,0,1,0,13.85-8ZM72,96a56,56,0,1,1,56,56A56.06,56.06,0,0,1,72,96Z"/></svg><?= esc_html__('Población', 'lumenti') ?></p>
            <ul class="lm-card-especialista__chips">
                <?php foreach ($lumenti_poblacion as $lumenti_p) : ?>
                    <li class="lm-card-especialista__chip"><?= esc_html($lumenti_p) ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        <?php if ($lumenti_atiende) : ?>
            <p class="lm-card-especialista__label"><svg class="lm-card-especialista__label-icon" aria-hidden="true" width="16" height="16" viewBox="0 0 256 256" fill="currentColor"><path d="M80,64a8,8,0,0,1,8-8H216a8,8,0,0,1,0,16H88A8,8,0,0,1,80,64Zm136,56H88a8,8,0,0,0,0,16H216a8,8,0,0,0,0-16Zm0,64H88a8,8,0,0,0,0,16H216a8,8,0,0,0,0-16ZM44,52A12,12,0,1,0,56,64,12,12,0,0,0,44,52Zm0,64a12,12,0,1,0,12,12A12,12,0,0,0,44,116Zm0,64a12,12,0,1,0,12,12A12,12,0,0,0,44,180Z"/></svg><?= esc_html__('Qué atiende', 'lumenti') ?></p>
            <ul class="lm-card-especialista__chips">
                <?php foreach ($lumenti_atiende as $lumenti_i => $lumenti_a) : ?>
                    <li class="lm-card-especialista__chip<?= $lumenti_i >= $lumenti_visibles ? ' lm-card-especialista__chip--extra' : '' ?>"><?= esc_html($lumenti_a['texto']) ?></li>
                <?php endforeach; ?>
                <?php if ($lumenti_extra > 0) : ?>
                    <li class="lm-card-especialista__more-item"><button class="lm-card-especialista__more" type="button" aria-expanded="false" aria-label="<?= esc_attr(sprintf(__('Ver todo lo que atiende (%d)', 'lumenti'), $lumenti_total)) ?>" data-lm-chips-more>+<?= (int) $lumenti_extra ?></button><span class="lm-card-especialista__tip" role="tooltip"><span class="lm-card-especialista__tip-title"><?= esc_html(sprintf(_n('ATIENDE %d CONDICIÓN', 'ATIENDE %d CONDICIONES', $lumenti_total, 'lumenti'), $lumenti_total)) ?></span><span class="lm-card-especialista__tip-list"><?php foreach ($lumenti_atiende as $lumenti_a) : ?><span class="lm-card-especialista__tip-item"><?= esc_html($lumenti_a['texto']) ?></span><?php endforeach; ?></span></span></li>
                <?php endif; ?>
            </ul>
        <?php endif; ?>
        <?php if ($lumenti_idiomas) : ?>
            <p class="lm-card-especialista__langs"><strong><?= esc_html__('Idiomas:', 'lumenti') ?></strong> <?= esc_html(implode(' · ', $lumenti_idiomas)) ?></p>
        <?php endif; ?>
    </div>
    <div class="lm-card-especialista__foot">
        <div class="lm-card-especialista__actions">
            <?php
            get_template_part('template-parts/components/boton', null, [
                'texto' => __('Ver perfil', 'lumenti'),
                'url' => $lumenti_url,
                'variante' => 'secondary',
                'tamano' => 'md',
            ]);
            get_template_part('template-parts/components/boton', null, [
                'texto' => __('Agenda tu cita', 'lumenti'),
                'whatsapp' => $lumenti_contexto,
                'mensaje' => $lumenti_mensaje,
                'tamano' => 'md',
                'icono' => 'flecha',
            ]);
            ?>
        </div>
    </div>
</article>
