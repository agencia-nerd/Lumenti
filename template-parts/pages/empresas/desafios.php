<?php
defined('ABSPATH') || exit;

/*
 * Empresas → desafios (specs/empresas.md). Grupo ACF: Empresas → empresas_desafios.
 * Título con la segunda parte en color (*marcador*), bajada y 5 desafíos con ícono decorativo.
 * El salto de línea del diseño (<br>) no se escribe: va por CSS.
 */

$lumenti_desafios = [
    'titulo' => "DESAFÍOS QUE IMPACTAN EN EL
*BIENESTAR DE LOS EQUIPOS*",
    'bajada' => 'Reconocer estos desafíos permite construir respuestas preventivas y entornos de trabajo más saludables.',
    'items' => [
        ['icono' => 'assets/img/emp-ic-estres.webp', 'titulo' => 'ESTRÉS LABORAL', 'texto' => 'La presión constante afecta el rendimiento, la concentración y el bienestar general del equipo.'],
        ['icono' => 'assets/img/emp-ic-conflictos.webp', 'titulo' => 'CONFLICTOS INTERPERSONALES', 'texto' => 'La tensión entre personas o equipos impacta directamente en los resultados y el clima de trabajo.'],
        ['icono' => 'assets/img/emp-ic-ausentismo.webp', 'titulo' => 'AUSENTISMO Y PRESENTISMO', 'texto' => 'Los problemas de salud mental generan ausencias o presencia sin productividad real.'],
        ['icono' => 'assets/img/emp-ic-burnout.webp', 'titulo' => 'BURNOUT Y AGOTAMIENTO', 'texto' => 'El agotamiento crónico reduce la motivación y aumenta el riesgo de baja y rotación del talento.'],
        ['icono' => 'assets/img/emp-ic-comunicacion.webp', 'titulo' => 'COMUNICACIÓN Y EQUIPOS', 'texto' => 'Las dificultades interpersonales y la falta de comunicación deterioran el clima laboral.'],
    ],
];
?>
<section class="lm-emp-challenges" aria-labelledby="lm-emp-des">
    <div class="lm-emp-challenges__header">
        <?php get_template_part('template-parts/components/section-title', null, [
            'titulo' => $lumenti_desafios['titulo'],
            'id' => 'lm-emp-des',
            'texto' => $lumenti_desafios['bajada'],
            'texto_clase' => 'lm-emp-challenges__intro',
        ]); ?>
    </div>
    <ul class="lm-emp-challenges__list">
        <?php foreach ($lumenti_desafios['items'] as $lumenti_item) : ?>
            <li class="lm-emp-challenges__item">
                <span class="lm-emp-challenges__badge" aria-hidden="true"><span class="lm-emp-challenges__core"><?= lumenti_theme_image($lumenti_item['icono'], ['class' => 'lm-emp-challenges__icon', 'alt' => '', 'width' => 96, 'height' => 96, 'size' => 'thumbnail']) ?></span></span>
                <h3 class="lm-emp-challenges__title"><?= esc_html($lumenti_item['titulo']) ?></h3>
                <p class="lm-emp-challenges__text"><?= esc_html($lumenti_item['texto']) ?></p>
            </li>
        <?php endforeach; ?>
    </ul>
</section>
