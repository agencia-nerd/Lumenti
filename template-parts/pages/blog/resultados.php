<?php
defined('ABSPATH') || exit;

/*
 * Blog → resultados (specs/blog.md). Grupo ACF: Blog → blog_resultados.
 * Contador (data-query="total"), grilla (data-query="resultados") con las 14 entradas de ejemplo del diseño
 * (componente blog-card, variante listing) y mensaje vacío. wp-query cambia el array por el loop.
 * El JS (blog-filter.js) filtra por data-cat (slug de la categoría) y data-text, y pagina de a 6.
 */

$lumenti_resultados = [
    'vacio' => 'No encontramos artículos con ese criterio. Prueba con otra categoría o palabra.',
];

$lumenti_entradas = [
    [
        'slug' => 'como-se-diagnostica-el-tdah',
        'titulo' => '¿Cómo se diagnostica el TDAH?',
        'categoria' => 'Neurodivergencias',
        'lectura' => 4,
        'bajada' => 'Una de las dudas más frecuentes sobre el trastorno por déficit de atención e hiperactividad (TDAH) es si existe algún examen que permita confirmarlo de manera objetiva.',
        'etiquetas' => 'TDAH Diagnóstico Psiquiatría',
    ],
    [
        'slug' => 'fluoxetina-pastilla-de-la-felicidad',
        'titulo' => 'Fluoxetina: ¿realmente es la “pastilla de la felicidad”?',
        'categoria' => 'Tratamientos y evaluaciones',
        'lectura' => 3,
        'bajada' => 'Pocas medicaciones en psiquiatría han sido tan conocidas como la fluoxetina. Desde su lanzamiento a finales de los años 80 bajo el nombre comercial Prozac®, este medicamento se convirtió rápidamente en uno de los antidepresivos más prescritos del mundo y en un fenómeno cultural que trascendió la medicina.',
        'etiquetas' => 'Antidepresivos Fluoxetina Depresión',
    ],
    [
        'slug' => 'ansiedad-en-ninos',
        'titulo' => 'La ansiedad en niños no siempre se ve como ansiedad',
        'categoria' => 'Salud mental',
        'lectura' => 3,
        'bajada' => 'Cuando pensamos en ansiedad infantil, solemos imaginar a un niño preocupado, temeroso o nervioso. Sin embargo, en la práctica clínica, la ansiedad no siempre se manifiesta de esa manera.',
        'etiquetas' => 'Ansiedad Niños Psiquiatría infantil',
    ],
    [
        'slug' => 'sertralina-5-mitos',
        'titulo' => 'Sertralina: 5 mitos que vale la pena aclarar',
        'categoria' => 'Tratamientos y evaluaciones',
        'lectura' => 3,
        'bajada' => 'La sertralina es uno de los antidepresivos más utilizados en el mundo para tratar trastornos como la depresión, la ansiedad, el trastorno obsesivo-compulsivo (TOC), el trastorno de pánico y otras condiciones de salud mental.',
        'etiquetas' => 'Antidepresivos Sertralina Ansiedad',
    ],
    [
        'slug' => 'alcohol-y-salud-mental',
        'titulo' => '5 razones por las que el alcohol puede afectar tu salud mental',
        'categoria' => 'Bienestar, relaciones y trabajo',
        'lectura' => 3,
        'bajada' => 'El consumo de alcohol forma parte de muchas reuniones sociales y celebraciones. Sin embargo, aunque suele percibirse como una forma de relajarse o desconectarse del estrés, sus efectos sobre la salud mental son más complejos de lo que muchas personas imaginan.',
        'etiquetas' => 'Alcohol Hábitos Salud mental',
    ],
    [
        'slug' => 'antidepresivo-para-toda-la-vida',
        'titulo' => '¿Voy a tomar el antidepresivo para toda la vida?',
        'categoria' => 'Tratamientos y evaluaciones',
        'lectura' => 3,
        'bajada' => 'Una de las preguntas más frecuentes cuando una persona recibe una receta de fluoxetina, sertralina u otro antidepresivo es: “¿Voy a tener que tomar esto para siempre?”',
        'etiquetas' => 'Antidepresivos Tratamiento Depresión',
    ],
    [
        'slug' => 'desvenlafaxina',
        'titulo' => 'Desvenlafaxina: ¿en qué casos puede indicarse?',
        'categoria' => 'Tratamientos y evaluaciones',
        'lectura' => 3,
        'bajada' => 'La desvenlafaxina es un antidepresivo de primera línea perteneciente al grupo de los inhibidores de la recaptación de serotonina y noradrenalina (IRSN). Su mecanismo de acción consiste en aumentar la disponibilidad de estos dos neurotransmisores, que participan en la regulación del estado de ánimo, la energía, la motivación y la respuesta al estrés.',
        'etiquetas' => 'Psiquiatría Antidepresivos Desvenlafaxina Depresión Ansiedad',
    ],
    [
        'slug' => 'rabietas-en-ninos',
        'titulo' => '¿Hasta cuándo una rabieta es normal en un niño?',
        'categoria' => 'Salud mental',
        'lectura' => 3,
        'bajada' => 'Las rabietas forman parte del desarrollo infantil. Durante los primeros años de vida, los niños todavía están aprendiendo a identificar, expresar y regular sus emociones.',
        'etiquetas' => 'Niños Rabietas Psiquiatría infantil',
    ],
    [
        'slug' => 'deterioro-cognitivo-adultos-mayores',
        'titulo' => 'Deterioro cognitivo en adultos mayores: no todo olvido es Alzheimer',
        'categoria' => 'Salud mental',
        'lectura' => 3,
        'bajada' => 'Es común que muchas personas se preocupen cuando un familiar mayor comienza a olvidar nombres, pierde objetos con más frecuencia o necesita más tiempo para aprender algo nuevo. Sin embargo, es importante saber que no todo olvido significa Alzheimer ni tampoco existe algo llamado "demencia senil" como diagnóstico médico.',
        'etiquetas' => 'Adulto mayor Memoria Deterioro cognitivo',
    ],
    [
        'slug' => 'esquizofrenia-tratamiento-a-tiempo',
        'titulo' => 'Esquizofrenia: ¿por qué el tratamiento a tiempo puede marcar una gran diferencia?',
        'categoria' => 'Salud mental',
        'lectura' => 3,
        'bajada' => 'La esquizofrenia es un trastorno mental complejo que suele estar rodeado de mitos, miedo y desinformación. Aunque puede afectar profundamente la forma en que una persona piensa, percibe la realidad y se relaciona con los demás, es importante recordar que muchas personas con esquizofrenia pueden llevar una vida estable y funcional cuando reciben un diagnóstico y tratamiento adecuados.',
        'etiquetas' => 'Esquizofrenia Psicosis',
    ],
    [
        'slug' => 'tdah-y-medicacion',
        'titulo' => 'TDAH y medicación: ¿realmente todos la necesitan?',
        'categoria' => 'Neurodivergencias',
        'lectura' => 3,
        'bajada' => 'Recibir un diagnóstico de trastorno por déficit de atención e hiperactividad (TDAH) suele generar muchas preguntas. Una de las más frecuentes es si la medicación será necesaria o si existen otras alternativas para manejar los síntomas.',
        'etiquetas' => 'TDAH Medicación Psiquiatría',
    ],
    [
        'slug' => 'trastorno-bipolar',
        'titulo' => 'Trastorno bipolar: mucho más que cambios de humor',
        'categoria' => 'Salud mental',
        'lectura' => 3,
        'bajada' => 'Es común escuchar que alguien es bipolar porque cambia de ánimo varias veces en un día. Sin embargo, esta idea no refleja lo que realmente ocurre en el trastorno bipolar.',
        'etiquetas' => 'Trastorno bipolar Estado de ánimo',
    ],
    [
        'slug' => 'terapia-de-aceptacion-y-compromiso',
        'titulo' => 'Terapia de Aceptación y Compromiso (ACT): aprender a vivir mejor, incluso cuando hay malestar',
        'categoria' => 'Tratamientos y evaluaciones',
        'lectura' => 3,
        'bajada' => 'Muchas personas llegan a terapia esperando dejar de sentir ansiedad, tristeza, miedo o pensamientos incómodos. Y aunque aliviar el sufrimiento es un objetivo importante, algunas terapias modernas proponen una pregunta diferente:',
        'etiquetas' => 'Psicoterapia ACT',
    ],
    [
        'slug' => 'terapia-cognitivo-conductual',
        'titulo' => 'Terapia Cognitivo Conductual (TCC): cuando aprender a pensar diferente puede ayudarte a sentirte mejor',
        'categoria' => 'Tratamientos y evaluaciones',
        'lectura' => 3,
        'bajada' => 'Muchas personas creen que las emociones aparecen de la nada. Que la ansiedad, la tristeza o el miedo simplemente ocurren y no hay mucho que hacer al respecto.',
        'etiquetas' => 'Psicoterapia TCC',
    ],
];

// En category.php solo las entradas de esa categoría (y sin el destacado).
$lumenti_destacado = !is_category();
if (is_category()) {
    $lumenti_term = get_queried_object();
    $lumenti_slug = $lumenti_term instanceof WP_Term ? $lumenti_term->slug : '';
    $lumenti_entradas = array_values(array_filter($lumenti_entradas, static fn($e) => sanitize_title($e['categoria']) === $lumenti_slug));
}

$lumenti_por_pagina = 6;
$lumenti_total = count($lumenti_entradas) + ($lumenti_destacado ? 1 : 0);
$lumenti_visibles = min($lumenti_por_pagina, count($lumenti_entradas)) + ($lumenti_destacado ? 1 : 0);
?>
<p class="lm-blog__count" aria-live="polite" data-lm-blog-count data-query="total"><?= esc_html(sprintf(__('Mostrando %1$d de %2$d entradas', 'lumenti'), $lumenti_visibles, $lumenti_total)) ?></p>
<ul class="lm-blog__grid" data-lm-blog-grid data-query="resultados">
    <?php foreach ($lumenti_entradas as $lumenti_e) : ?>
        <li class="lm-blog__item" data-lm-blog-item data-cat="<?= esc_attr(sanitize_title($lumenti_e['categoria'])) ?>" data-text="<?= esc_attr(trim($lumenti_e['titulo'] . ' ' . $lumenti_e['bajada'] . ' ' . $lumenti_e['etiquetas'])) ?>">
            <?php get_template_part('template-parts/components/blog-card', null, [
                'titulo' => $lumenti_e['titulo'],
                'url' => home_url('/' . $lumenti_e['slug'] . '/'),
                'imagen' => 'assets/img/blog/' . $lumenti_e['slug'] . '.webp',
                'categoria' => $lumenti_e['categoria'],
                'lectura' => $lumenti_e['lectura'],
                'bajada' => $lumenti_e['bajada'],
                'variante' => 'listing',
            ]); ?>
        </li>
    <?php endforeach; ?>
</ul>
<p class="lm-blog__empty lm-lead" role="status" data-lm-blog-empty<?= $lumenti_entradas ? ' hidden' : '' ?>><?= esc_html($lumenti_resultados['vacio']) ?></p>
