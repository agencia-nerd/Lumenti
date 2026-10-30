<?php
defined('ABSPATH') || exit;

/*
 * Empresas → soluciones (specs/empresas.md). Grupo ACF: Empresas → empresas_soluciones.
 * Ancla #soluciones (data-lm-target). 3 cards; la de posición par va invertida (--reverse).
 * Botón: destino talleres (#talleres) o formulario (#propuesta) con la opción de busca[] a marcar (data-lm-preselect).
 */

$lumenti_soluciones = [
    'titulo' => 'SOLUCIONES PARA *TU ORGANIZACIÓN*',
    'bajada' => 'Acompañamos a las organizaciones desde la formación y la prevención hasta la atención clínica de sus colaboradores.',
    'items' => [
        [
            'imagen' => ['ruta' => 'assets/img/emp-talleres.webp', 'ancho' => 640, 'alto' => 616, 'alt' => 'Profesional tomando notas durante una sesión'],
            'titulo' => 'TALLERES Y CAPACITACIONES',
            'texto' => 'Sesiones prácticas dirigidas a colaboradores y líderes para fortalecer conocimientos y herramientas relacionadas con la salud mental y el bienestar laboral.',
            'boton_texto' => 'Ver talleres',
            'destino' => 'talleres',
            'preseleccion' => 'ninguna',
        ],
        [
            'imagen' => ['ruta' => 'assets/img/emp-programas.webp', 'ancho' => 640, 'alto' => 616, 'alt' => 'Equipo de trabajo celebrando un logro'],
            'titulo' => 'PROGRAMAS DE PREVENCIÓN Y BIENESTAR',
            'texto' => 'Intervenciones desarrolladas en varias etapas para abordar objetivos específicos, fortalecer factores protectores y promover una cultura organizacional más saludable.',
            'boton_texto' => 'Solicitar propuesta',
            'destino' => 'formulario',
            'preseleccion' => 'prevencion',
        ],
        [
            'imagen' => ['ruta' => 'assets/img/emp-atencion.webp', 'ancho' => 640, 'alto' => 616, 'alt' => 'Médico redactando una receta en consulta'],
            'titulo' => 'ATENCIÓN CLÍNICA PARA COLABORADORES',
            'texto' => 'Facilitamos el acceso a consultas de psiquiatría y psicología para colaboradores que requieran atención profesional, de manera presencial o virtual.',
            'boton_texto' => 'Solicitar propuesta',
            'destino' => 'formulario',
            'preseleccion' => 'atencion',
        ],
    ],
];

// destino → ancla de la página.
$lumenti_anclas = ['talleres' => '#talleres', 'formulario' => '#propuesta'];
?>
<section class="lm-emp-solutions lm-emp-anchor" id="soluciones" data-lm-target="soluciones" aria-labelledby="lm-emp-sol">
    <div class="lm-emp-solutions__inner">
        <div class="lm-emp-solutions__intro">
            <h2 class="lm-section-title" id="lm-emp-sol"><?= lumenti_highlight($lumenti_soluciones['titulo']) ?></h2>
            <?php if ($lumenti_soluciones['bajada'] !== '') : ?>
                <p class="lm-emp-solutions__lead"><?= esc_html($lumenti_soluciones['bajada']) ?></p>
            <?php endif; ?>
        </div>
        <div class="lm-emp-solutions__list">
            <?php foreach ($lumenti_soluciones['items'] as $lumenti_i => $lumenti_item) :
                $lumenti_destino = isset($lumenti_anclas[$lumenti_item['destino']]) ? $lumenti_item['destino'] : 'formulario';
                $lumenti_atributos = ['data-lm-goto' => $lumenti_destino];
                if ($lumenti_destino === 'formulario' && $lumenti_item['preseleccion'] !== '' && $lumenti_item['preseleccion'] !== 'ninguna') {
                    $lumenti_atributos['data-lm-preselect'] = $lumenti_item['preseleccion'];
                }
                ?>
                <article class="lm-emp-solution<?= $lumenti_i % 2 === 1 ? ' lm-emp-solution--reverse' : '' ?>">
                    <div class="lm-emp-solution__media"><?= lumenti_theme_image($lumenti_item['imagen'], ['class' => 'lm-emp-solution__img', 'size' => 'large']) ?></div>
                    <div class="lm-emp-solution__body">
                        <h3 class="lm-emp-solution__title"><?= esc_html($lumenti_item['titulo']) ?></h3>
                        <p class="lm-emp-solution__text"><?= esc_html($lumenti_item['texto']) ?></p>
                        <div class="lm-emp-solution__action">
                            <?php get_template_part('template-parts/components/boton', null, [
                                'texto' => $lumenti_item['boton_texto'],
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
