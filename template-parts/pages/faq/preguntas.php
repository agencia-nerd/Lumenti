<?php
defined('ABSPATH') || exit;

/*
 * Preguntas frecuentes · preguntas (specs/preguntas-frecuentes.md → preguntas; grupo ACF preguntas_frecuentes_preguntas;
 * Skill: wp-accordion). Contenido: get_field('preguntas_frecuentes_preguntas') → grupos (titulo, preguntas).
 * Esta sección imprime el contenedor y el título h2 de cada tema; la lista de preguntas la arma
 * template-parts/accordions/faq.php (wp-accordion, sobre <details>/<summary> con las clases lm-faq__*).
 *
 * $args que recibe el acordeón (uno por tema):
 *   items        [['pregunta' => '…', 'respuesta' => '…'], …]
 *   titulo_id    id del h2 del tema (aria-labelledby de la lista).
 *   grupo        nombre común a toda la página (una sola pregunta abierta a la vez en toda la página).
 *   abierta      índice de la pregunta abierta al cargar dentro de este tema (0 en el primero; null en los demás).
 *   inicio       número de la primera pregunta del tema (ids únicos en la página: lm-faq-q{n} / lm-faq-a{n}).
 *   nivel        nivel del encabezado de cada pregunta (h3, bajo el h2 del tema).
 *   mantener     true = como el diseño, no se puede cerrar la última abierta (data-lm-acc-keep); la skill decide.
 */

$lumenti_preguntas = get_field('preguntas_frecuentes_preguntas') ?: [];
$lumenti_grupos = (array) ($lumenti_preguntas['grupos'] ?? []);
$lumenti_acordeon = locate_template('template-parts/accordions/faq.php') !== '';
$lumenti_inicio = 0;
?>
<section class="lm-faq" aria-label="<?= esc_attr__('Preguntas frecuentes', 'lumenti') ?>">
    <div class="lm-faq__inner">
        <?php foreach ($lumenti_grupos as $lumenti_g => $lumenti_grupo) :
            if (empty($lumenti_grupo['preguntas']) || trim((string) ($lumenti_grupo['titulo'] ?? '')) === '') {
                continue;
            }
            $lumenti_titulo_id = 'lm-faq-g' . $lumenti_g;
        ?>
            <div class="lm-faq__group">
                <h2 class="lm-faq__group-title" id="<?= esc_attr($lumenti_titulo_id) ?>"><?= esc_html($lumenti_grupo['titulo']) ?></h2>
                <?php
                if ($lumenti_acordeon) {
                    get_template_part('template-parts/accordions/faq', null, [
                        'items' => $lumenti_grupo['preguntas'],
                        'titulo_id' => $lumenti_titulo_id,
                        'grupo' => 'lm-faq',
                        'abierta' => $lumenti_g === 0 ? 0 : null,
                        'inicio' => $lumenti_inicio,
                        'nivel' => 'h3',
                        'mantener' => true,
                    ]);
                }
                $lumenti_inicio += count($lumenti_grupo['preguntas']);
                ?>
            </div>
        <?php endforeach; ?>
    </div>
</section>
