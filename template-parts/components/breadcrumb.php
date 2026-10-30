<?php
defined('ABSPATH') || exit;

/*
 * Breadcrumb (.lm-breadcrumb). Diseño: css/components.css §6.
 *
 * $args:
 *   items   (array, sí)  [['texto' => 'Servicios'], ['texto' => 'Psiquiatría']]; `url` opcional. Un ítem sin url
 *                        es un <span> (ej. "Servicios"); el último es la página actual (aria-current="page", sin enlace).
 *   inicio  (bool)  antepone "Inicio" con el ícono de casa, enlazado a la portada. Por defecto true.
 *   clase   (string)  clases extra del <nav>.
 */

$lumenti_items = array_values(array_filter((array) ($args['items'] ?? []), static fn($i) => is_array($i) && trim((string) ($i['texto'] ?? '')) !== ''));
if ($args['inicio'] ?? true) {
    array_unshift($lumenti_items, ['texto' => __('Inicio', 'lumenti'), 'url' => home_url('/'), 'inicio' => true]);
}
if (!$lumenti_items) {
    return;
}
$lumenti_ultimo = count($lumenti_items) - 1;
?>
<nav class="<?= esc_attr(trim('lm-breadcrumb ' . (string) ($args['clase'] ?? ''))) ?>" aria-label="<?= esc_attr__('Ruta de navegación', 'lumenti') ?>">
    <ol class="lm-breadcrumb__list">
        <?php foreach ($lumenti_items as $lumenti_i => $lumenti_item) : ?>
            <?php if ($lumenti_i > 0) : ?>
                <li class="lm-breadcrumb__sep" aria-hidden="true">/</li>
            <?php endif; ?>
            <?php if ($lumenti_i === $lumenti_ultimo) : ?>
                <li class="lm-breadcrumb__current" aria-current="page"><?= esc_html($lumenti_item['texto']) ?></li>
            <?php elseif (!empty($lumenti_item['url'])) : ?>
                <li><a class="lm-breadcrumb__link" href="<?= esc_url($lumenti_item['url']) ?>"><?php if (!empty($lumenti_item['inicio'])) : ?><svg aria-hidden="true" width="16" height="16" viewBox="0 0 256 256" fill="currentColor"><path d="M219.31,108.68l-80-80a16,16,0,0,0-22.62,0l-80,80A15.87,15.87,0,0,0,32,120v96a8,8,0,0,0,8,8h64a8,8,0,0,0,8-8V160h32v56a8,8,0,0,0,8,8h64a8,8,0,0,0,8-8V120A15.87,15.87,0,0,0,219.31,108.68ZM208,208H160V152a8,8,0,0,0-8-8H104a8,8,0,0,0-8,8v56H48V120l80-80,80,80Z"/></svg><?php endif; ?><?= esc_html($lumenti_item['texto']) ?></a></li>
            <?php else : ?>
                <li><span class="lm-breadcrumb__link"><?= esc_html($lumenti_item['texto']) ?></span></li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ol>
</nav>
