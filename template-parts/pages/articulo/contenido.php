<?php
defined('ABSPATH') || exit;

/*
 * Artículo → contenido (specs/articulo.md). Sin grupo ACF.
 * Cuerpo de la entrada de ejemplo del diseño, con sus clases (lm-article__p, __h2, __list, __li), hasta que
 * se cambie por the_content(). Etiquetas (post_tag) como texto plano; el bloque no se imprime sin etiquetas.
 * Cierra el <article> que abre cabecera.php.
 */

$lumenti_etiquetas = ['TDAH', 'Diagnóstico', 'Psiquiatría'];

// Bloques del editor: ['p', texto], ['h2', texto], ['ul', [ítems]].
$lumenti_bloques = [
    ['p', 'Una de las dudas más frecuentes sobre el trastorno por déficit de atención e hiperactividad (TDAH) es si existe algún examen que permita confirmarlo de manera objetiva.'],
    ['p', 'La respuesta es no.'],
    ['p', 'Actualmente, el diagnóstico del TDAH es clínico. Esto significa que no existe una prueba de sangre, resonancia magnética, tomografía, electroencefalograma o biomarcador capaz de confirmar o descartar el diagnóstico por sí solo.'],
    ['p', 'La herramienta con mayor respaldo científico continúa siendo una evaluación clínica realizada por un psiquiatra.'],
    ['h2', '¿Qué se evalúa durante la consulta?'],
    ['p', 'El diagnóstico no se basa únicamente en la presencia de problemas de atención.'],
    ['p', 'Durante la evaluación, el psiquiatra realiza una historia clínica detallada para comprender aspectos como:'],
    ['ul', [
        'Los síntomas de inatención, impulsividad e hiperactividad.',
        'La edad en la que comenzaron.',
        'Cómo han evolucionado a lo largo de la vida.',
        'El impacto que tienen en los estudios, el trabajo, las relaciones y otras áreas importantes del funcionamiento diario.',
    ]],
    ['p', 'Además, se exploran antecedentes médicos, psicológicos y familiares que puedan aportar información relevante.'],
    ['h2', '¿Por qué es importante descartar otras causas?'],
    ['p', 'Muchas condiciones pueden generar síntomas parecidos al TDAH.'],
    ['p', 'Por ejemplo, una persona con ansiedad, depresión o problemas de sueño puede experimentar dificultades para concentrarse, olvidos frecuentes o sensación de dispersión mental.'],
    ['p', 'Por eso, parte fundamental del proceso consiste en evaluar y descartar factores como:'],
    ['ul', [
        'Trastornos de ansiedad.',
        'Depresión.',
        'Alteraciones del sueño.',
        'Estrés crónico o burnout.',
        'Consumo de sustancias.',
        'Efectos secundarios de medicamentos.',
        'Condiciones médicas que puedan afectar la atención o el rendimiento cognitivo.',
    ]],
    ['p', 'Este paso es esencial para evitar diagnósticos incorrectos y definir el tratamiento más adecuado.'],
    ['h2', '¿Qué papel tienen los cuestionarios y escalas?'],
    ['p', 'Durante la evaluación suelen utilizarse cuestionarios y escalas validadas científicamente.'],
    ['p', 'Estas herramientas ayudan a:'],
    ['ul', [
        'Medir la intensidad de los síntomas.',
        'Identificar patrones de funcionamiento.',
        'Complementar la información obtenida en la entrevista clínica.',
    ]],
    ['p', 'Sin embargo, es importante aclarar que ninguna escala diagnostica TDAH por sí sola.'],
    ['p', 'Los resultados siempre deben interpretarse dentro del contexto clínico de cada paciente y nunca sustituyen la evaluación realizada por el psiquiatra.'],
    ['h2', '¿También se evalúan los hábitos y el estilo de vida?'],
    ['p', 'Sí. La atención y el rendimiento cognitivo están influenciados por muchos factores que van más allá del TDAH.'],
    ['p', 'Por ello, suele explorarse:'],
    ['ul', [
        'La calidad del sueño.',
        'Los niveles de estrés.',
        'Los hábitos de alimentación y actividad física.',
        'La organización del tiempo.',
        'Las rutinas diarias.',
        'Las estrategias de estudio o trabajo.',
    ]],
    ['p', 'Comprender estos aspectos permite tener una visión más completa de lo que está ocurriendo.'],
    ['h2', '¿Qué criterios deben cumplirse para diagnosticar TDAH?'],
    ['p', 'Para que el diagnóstico sea válido, los síntomas deben cumplir ciertas características.'],
    ['p', 'Entre ellas:'],
    ['ul', [
        'Ser persistentes en el tiempo.',
        'Haber estado presentes durante años y no aparecer únicamente en una etapa puntual.',
        'Manifestarse en más de un contexto (por ejemplo, trabajo, estudios, hogar o relaciones).',
        'Generar dificultades significativas en la vida cotidiana.',
    ]],
    ['p', 'No basta con distraerse ocasionalmente o sentirse desorganizado en momentos de estrés.'],
    ['h2', '¿Cuántas consultas se necesitan?'],
    ['p', 'La duración del proceso puede variar según cada caso. En algunas personas, la información obtenida durante una primera consulta es suficiente para establecer el diagnóstico.'],
    ['p', 'En otras, puede ser necesario completar el proceso en aproximadamente dos sesiones para revisar cuestionarios, antecedentes y aclarar aspectos clínicos relevantes.'],
    ['p', 'Cuando se requieren varias consultas, lo habitual es que exista un intervalo de una a dos semanas entre ellas.'],
    ['h2', '¿Qué ocurre después del diagnóstico?'],
    ['p', 'Una vez integrada toda la información, el psiquiatra plantea un plan de tratamiento individualizado.'],
    ['p', 'Dependiendo de las necesidades de cada persona, este puede incluir:'],
    ['ul', [
        'Psicoeducación sobre el TDAH.',
        'Psicoterapia.',
        'Estrategias de organización y manejo del tiempo.',
        'Intervenciones sobre hábitos y estilo de vida.',
        'Medicación, cuando está indicada.',
    ]],
    ['h2', '¿Las pruebas neuropsicológicas diagnostican TDAH?'],
    ['p', 'Las evaluaciones neuropsicológicas pueden aportar información valiosa en determinadas situaciones, especialmente cuando existen dudas diagnósticas complejas o cuando se desea profundizar en aspectos específicos del funcionamiento cognitivo.'],
    ['p', 'Sin embargo, es importante destacar que estas pruebas no reemplazan el diagnóstico clínico.'],
    ['p', 'Su función es complementar la evaluación realizada por el psiquiatra, no sustituirla.'],
    ['h2', 'Una mirada integral al diagnóstico'],
    ['p', 'El TDAH es una condición compleja que requiere una evaluación cuidadosa y personalizada. Más que buscar una prueba única que entregue una respuesta inmediata, el objetivo es comprender cómo funcionan los síntomas, cuál es su impacto real en la vida de la persona y qué factores pueden estar influyendo en ellos.'],
    ['p', 'Por eso, el diagnóstico del TDAH sigue siendo, ante todo, un proceso clínico que integra la historia de vida, los síntomas, el funcionamiento diario y el contexto individual de cada paciente.'],
];
?>
    <div class="lm-article__body">
        <?php foreach ($lumenti_bloques as [$lumenti_tipo, $lumenti_valor]) : ?>
            <?php if ($lumenti_tipo === 'h2') : ?>
                <h2 class="lm-article__h2"><?= esc_html($lumenti_valor) ?></h2>
            <?php elseif ($lumenti_tipo === 'ul') : ?>
                <ul class="lm-article__list"><?php foreach ((array) $lumenti_valor as $lumenti_li) : ?><li class="lm-article__li"><?= esc_html($lumenti_li) ?></li><?php endforeach; ?></ul>
            <?php else : ?>
                <p class="lm-article__p"><?= esc_html($lumenti_valor) ?></p>
            <?php endif; ?>
        <?php endforeach; ?>
        <?php if ($lumenti_etiquetas) : ?>
            <div class="lm-article__tags"><p class="lm-article__tags-label"><?= esc_html__('ETIQUETAS', 'lumenti') ?></p><ul class="lm-article__tag-list"><?php foreach ($lumenti_etiquetas as $lumenti_tag) : ?><li class="lm-article__tag"><?= esc_html($lumenti_tag) ?></li><?php endforeach; ?></ul></div>
        <?php endif; ?>
    </div>
</article>
