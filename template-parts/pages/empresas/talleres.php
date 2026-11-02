<?php
defined('ABSPATH') || exit;

/*
 * Empresas → talleres (specs/empresas.md). Grupo ACF: Empresas → empresas_talleres (data/talleres.json).
 * Ancla #talleres (data-lm-target). Título numerado por posición, temas = una línea del campo por <li>.
 * El botón de cada taller marca busca[]=taller y escribe el nombre del taller en `mensaje` (empresas.js).
 * El salto de línea del diseño (<br>) no se escribe: va por CSS.
 */

$lumenti_talleres = get_field('empresas_talleres') ?: [];
$lumenti_items = (array) ($lumenti_talleres['items'] ?? []);
$lumenti_temas_etiqueta = (string) ($lumenti_talleres['temas_etiqueta'] ?? '');
?>
<section class="lm-emp-workshops lm-emp-anchor" id="talleres" data-lm-target="talleres" aria-labelledby="lm-emp-tal">
    <div class="lm-emp-workshops__header">
        <?php get_template_part('template-parts/components/section-title', null, [
            'titulo' => (string) ($lumenti_talleres['titulo'] ?? ''),
            'id' => 'lm-emp-tal',
            'texto' => (string) ($lumenti_talleres['bajada'] ?? ''),
            'texto_clase' => 'lm-emp-workshops__lead',
        ]); ?>
    </div>
    <?php if ($lumenti_items) : ?>
    <ul class="lm-emp-workshops__list">
        <?php foreach ($lumenti_items as $lumenti_i => $lumenti_taller) :
            $lumenti_temas = array_values(array_filter(array_map('trim', preg_split('/\R/', (string) ($lumenti_taller['temas'] ?? '')))));
            ?>
            <li>
                <article class="lm-emp-workshop">
                    <h3 class="lm-emp-workshop__title"><?= esc_html(sprintf('%02d. %s', $lumenti_i + 1, (string) ($lumenti_taller['nombre'] ?? ''))) ?></h3>
                    <?php if (trim((string) ($lumenti_taller['descripcion'] ?? '')) !== '') : ?>
                        <p class="lm-emp-workshop__desc"><?= lumenti_highlight((string) $lumenti_taller['descripcion']) ?></p>
                    <?php endif; ?>
                    <?php if ($lumenti_temas) : ?>
                        <?php if ($lumenti_temas_etiqueta !== '') : ?>
                            <p class="lm-emp-workshop__topics-label"><?= esc_html($lumenti_temas_etiqueta) ?></p>
                        <?php endif; ?>
                        <ul class="lm-emp-workshop__topics">
                            <?php foreach ($lumenti_temas as $lumenti_tema) : ?>
                                <li class="lm-emp-workshop__topic"><?= esc_html($lumenti_tema) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                    <div class="lm-emp-workshop__action">
                        <?php get_template_part('template-parts/components/boton', null, [
                            'texto' => __('Solicitar este taller', 'lumenti'),
                            'url' => '#propuesta',
                            'tamano' => 'md',
                            'icono' => 'flecha',
                            'atributos' => [
                                'data-lm-goto' => 'formulario',
                                'data-lm-preselect' => 'taller',
                                'data-lm-prefill' => (string) ($lumenti_taller['nombre'] ?? ''),
                            ],
                        ]); ?>
                    </div>
                </article>
            </li>
        <?php endforeach; ?>
    </ul>
    <?php endif; ?>
</section>
