<?php
defined('ABSPATH') || exit;

/*
 * Empresas → desafios (specs/empresas.md). Grupo ACF: Empresas → empresas_desafios.
 * Título con la segunda parte en color (*marcador*), bajada y desafíos con ícono decorativo (alt vacío).
 */

$lumenti_desafios = get_field('empresas_desafios') ?: [];
$lumenti_items = (array) ($lumenti_desafios['items'] ?? []);
?>
<section class="lm-emp-challenges" aria-labelledby="lm-emp-des">
    <div class="lm-emp-challenges__header">
        <?php get_template_part('template-parts/components/section-title', null, [
            'titulo' => (string) ($lumenti_desafios['titulo'] ?? ''),
            'id' => 'lm-emp-des',
            'texto' => (string) ($lumenti_desafios['bajada'] ?? ''),
            'texto_clase' => 'lm-emp-challenges__intro',
        ]); ?>
    </div>
    <?php if ($lumenti_items) : ?>
        <ul class="lm-emp-challenges__list">
            <?php foreach ($lumenti_items as $lumenti_item) : ?>
                <li class="lm-emp-challenges__item">
                    <span class="lm-emp-challenges__badge" aria-hidden="true"><span class="lm-emp-challenges__core"><?= lumenti_theme_image($lumenti_item['icono'] ?? null, ['class' => 'lm-emp-challenges__icon', 'alt' => '', 'size' => 'thumbnail']) ?></span></span>
                    <h3 class="lm-emp-challenges__title"><?= esc_html((string) ($lumenti_item['titulo'] ?? '')) ?></h3>
                    <?php if ((string) ($lumenti_item['texto'] ?? '') !== '') : ?>
                        <p class="lm-emp-challenges__text"><?= lumenti_highlight((string) $lumenti_item['texto']) ?></p>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</section>
