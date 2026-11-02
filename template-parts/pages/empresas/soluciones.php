<?php
defined('ABSPATH') || exit;

/*
 * Empresas → soluciones (specs/empresas.md). Grupo ACF: Empresas → empresas_soluciones.
 * Ancla #soluciones (data-lm-target). 3 cards; la de posición par va invertida (--reverse).
 * Botón: destino talleres (#talleres) o formulario (#propuesta) con la opción de busca[] a marcar (data-lm-preselect).
 */

$lumenti_soluciones = get_field('empresas_soluciones') ?: [];
$lumenti_bajada = (string) ($lumenti_soluciones['bajada'] ?? '');

// destino → ancla de la página.
$lumenti_anclas = ['talleres' => '#talleres', 'formulario' => '#propuesta'];
?>
<section class="lm-emp-solutions lm-emp-anchor" id="soluciones" data-lm-target="soluciones" aria-labelledby="lm-emp-sol">
    <div class="lm-emp-solutions__inner">
        <div class="lm-emp-solutions__intro">
            <h2 class="lm-section-title" id="lm-emp-sol"><?= lumenti_highlight((string) ($lumenti_soluciones['titulo'] ?? '')) ?></h2>
            <?php if ($lumenti_bajada !== '') : ?>
                <p class="lm-emp-solutions__lead"><?= lumenti_highlight($lumenti_bajada) ?></p>
            <?php endif; ?>
        </div>
        <div class="lm-emp-solutions__list">
            <?php foreach ((array) ($lumenti_soluciones['items'] ?? []) as $lumenti_i => $lumenti_item) :
                $lumenti_destino = isset($lumenti_anclas[$lumenti_item['destino'] ?? '']) ? $lumenti_item['destino'] : 'formulario';
                $lumenti_atributos = ['data-lm-goto' => $lumenti_destino];
                if ($lumenti_destino === 'formulario' && !in_array((string) ($lumenti_item['preseleccion'] ?? ''), ['', 'ninguna'], true)) {
                    $lumenti_atributos['data-lm-preselect'] = $lumenti_item['preseleccion'];
                }
                ?>
                <article class="lm-emp-solution<?= $lumenti_i % 2 === 1 ? ' lm-emp-solution--reverse' : '' ?>">
                    <div class="lm-emp-solution__media"><?= lumenti_theme_image($lumenti_item['imagen'] ?? null, ['class' => 'lm-emp-solution__img', 'size' => 'large', 'alt_fallback' => (string) ($lumenti_item['titulo'] ?? '')]) ?></div>
                    <div class="lm-emp-solution__body">
                        <h3 class="lm-emp-solution__title"><?= esc_html((string) ($lumenti_item['titulo'] ?? '')) ?></h3>
                        <p class="lm-emp-solution__text"><?= lumenti_highlight((string) ($lumenti_item['texto'] ?? '')) ?></p>
                        <div class="lm-emp-solution__action">
                            <?php get_template_part('template-parts/components/boton', null, [
                                'texto' => (string) ($lumenti_item['boton_texto'] ?? ''),
                                'url' => $lumenti_anclas[$lumenti_destino],
                                'tamano' => 'md',
                                'icono' => 'flecha',
                                'atributos' => $lumenti_atributos,
                            ]); ?>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
