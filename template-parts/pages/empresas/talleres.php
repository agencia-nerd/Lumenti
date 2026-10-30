<?php
defined('ABSPATH') || exit;

/*
 * Empresas → talleres (specs/empresas.md). Grupo ACF: Empresas → empresas_talleres (data/talleres.json).
 * Ancla #talleres (data-lm-target). Título numerado por posición, temas = una línea del campo por <li>.
 * "Solicitar este taller" marca busca[]=taller y escribe el nombre del taller en `mensaje` (empresas.js).
 * El salto de línea del diseño (<br>) no se escribe: va por CSS.
 */

$lumenti_talleres = [
    'titulo' => "EXPLORA NUESTROS
TALLERES *Y CAPACITACIONES*",
    'bajada' => 'Formamos a colaboradores, líderes y organizaciones con herramientas prácticas y actualizadas para cuidar la salud mental en el entorno laboral. Cada taller se adapta a la realidad y objetivos de tu equipo.',
    'temas_etiqueta' => 'Temas sugeridos:',
    'boton_texto' => 'Solicitar este taller',
    'items' => [
        [
            'nombre' => 'SALUD MENTAL Y BIENESTAR EMOCIONAL',
            'descripcion' => '',
            'temas' => 'Estrés laboral y manejo de la ansiedad
Burnout: prevención, señales de alerta y recuperación
Regulación emocional en contextos de alta exigencia
Autocuidado y bienestar mental en el trabajo
Sueño, descanso y hábitos saludables
Cómo pedir ayuda y acompañar a otros sin estigma',
        ],
        [
            'nombre' => 'LIDERAZGO Y EQUIPOS SALUDABLES',
            'descripcion' => '',
            'temas' => 'Liderazgo saludable y gestión emocional
Cómo acompañar a un colaborador en dificultad
Comunicación empática y conversaciones difíciles
Clima laboral y relaciones saludables
Prevención del desgaste en líderes
Herramientas para equipos en contextos de presión o cambio',
        ],
        [
            'nombre' => 'PREVENCIÓN Y RESPUESTA TEMPRANA',
            'descripcion' => '',
            'temas' => 'Señales de alerta en salud mental
Primeros auxilios psicológicos en el entorno laboral
Prevención del burnout y desgaste emocional
Manejo inicial de crisis emocionales
Prevención del suicidio desde una mirada responsable
Rutas de derivación y acompañamiento interno',
        ],
    ],
];
?>
<section class="lm-emp-workshops lm-emp-anchor" id="talleres" data-lm-target="talleres" aria-labelledby="lm-emp-tal">
    <div class="lm-emp-workshops__header">
        <?php get_template_part('template-parts/components/section-title', null, [
            'titulo' => $lumenti_talleres['titulo'],
            'id' => 'lm-emp-tal',
            'texto' => $lumenti_talleres['bajada'],
            'texto_clase' => 'lm-emp-workshops__lead',
        ]); ?>
    </div>
    <ul class="lm-emp-workshops__list">
        <?php foreach ($lumenti_talleres['items'] as $lumenti_i => $lumenti_taller) :
            $lumenti_temas = array_values(array_filter(array_map('trim', preg_split('/\R/', (string) $lumenti_taller['temas']))));
            ?>
            <li>
                <article class="lm-emp-workshop">
                    <h3 class="lm-emp-workshop__title"><?= esc_html(sprintf('%02d. %s', $lumenti_i + 1, $lumenti_taller['nombre'])) ?></h3>
                    <?php if (trim((string) $lumenti_taller['descripcion']) !== '') : ?>
                        <p class="lm-emp-workshop__desc"><?= esc_html($lumenti_taller['descripcion']) ?></p>
                    <?php endif; ?>
                    <?php if ($lumenti_temas) : ?>
                        <?php if ($lumenti_talleres['temas_etiqueta'] !== '') : ?>
                            <p class="lm-emp-workshop__topics-label"><?= esc_html($lumenti_talleres['temas_etiqueta']) ?></p>
                        <?php endif; ?>
                        <ul class="lm-emp-workshop__topics">
                            <?php foreach ($lumenti_temas as $lumenti_tema) : ?>
                                <li class="lm-emp-workshop__topic"><?= esc_html($lumenti_tema) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                    <div class="lm-emp-workshop__action">
                        <?php get_template_part('template-parts/components/boton', null, [
                            'texto' => $lumenti_talleres['boton_texto'],
                            'url' => '#propuesta',
                            'tamano' => 'md',
                            'icono' => 'flecha',
                            'atributos' => [
                                'data-lm-goto' => 'formulario',
                                'data-lm-preselect' => 'taller',
                                'data-lm-prefill' => $lumenti_taller['nombre'],
                            ],
                        ]); ?>
                    </div>
                </article>
            </li>
        <?php endforeach; ?>
    </ul>
</section>
