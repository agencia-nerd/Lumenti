<?php
defined('ABSPATH') || exit;

/*
 * Psicología · servicios: marcado de la sección (specs/psicologia.md → servicios). Los datos los prepara servicios.php.
 * La tarjeta con `ancla` imprime ese id; hashTarget (src/js/modules/scroll.js) la baja bajo el navbar y la resalta.
 *
 * $args: titulo (con *marcador*), items (titulo, texto, texto_destacado, lista (una por línea), boton_texto,
 *        mensaje_whatsapp, ancla).
 */

$lumenti_items = array_filter((array) ($args['items'] ?? []), static fn($i) => is_array($i) && trim((string) ($i['titulo'] ?? '')) !== '');
if (!$lumenti_items || empty($args['titulo'])) {
    return;
}
?>
<section class="lm-service-section" aria-labelledby="lm-serv-psi">
    <?php get_template_part('template-parts/components/section-title', null, [
        'titulo' => $args['titulo'],
        'id' => 'lm-serv-psi',
        'centrado' => true,
    ]); ?>
    <div class="lm-service-cards">
        <?php foreach ($lumenti_items as $lumenti_item) :
            $lumenti_ancla = sanitize_title((string) ($lumenti_item['ancla'] ?? ''));
            $lumenti_texto = trim((string) ($lumenti_item['texto'] ?? ''));
            $lumenti_destacado = trim((string) ($lumenti_item['texto_destacado'] ?? ''));
            $lumenti_lista = array_values(array_filter(array_map('trim', preg_split('/\R/', (string) ($lumenti_item['lista'] ?? '')))));
            $lumenti_boton = trim((string) ($lumenti_item['boton_texto'] ?? ''));
            ?>
            <article class="lm-service-card"<?php if ($lumenti_ancla !== '') : ?> id="<?= esc_attr($lumenti_ancla) ?>"<?php endif; ?>>
                <h3 class="lm-service-card__title"><?= esc_html($lumenti_item['titulo']) ?></h3>
                <?php if ($lumenti_texto !== '') : ?>
                    <p class="lm-service-card__text"><?= esc_html($lumenti_texto) ?></p>
                <?php endif; ?>
                <?php if ($lumenti_destacado !== '') : ?>
                    <p class="lm-service-card__text lm-service-card__text--strong"><?= esc_html($lumenti_destacado) ?></p>
                <?php endif; ?>
                <?php if ($lumenti_lista) : ?>
                    <ul class="lm-service-card__list">
                        <?php foreach ($lumenti_lista as $lumenti_li) : ?>
                            <li class="lm-service-card__item"><?= esc_html($lumenti_li) ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
                <?php if ($lumenti_boton !== '') : ?>
                    <div class="lm-service-card__actions">
                        <?php get_template_part('template-parts/components/boton', null, [
                            'texto' => $lumenti_boton,
                            'variante' => 'primary',
                            'tamano' => 'md',
                            'icono' => 'whatsapp',
                            'whatsapp' => 'paciente',
                            'mensaje' => (string) ($lumenti_item['mensaje_whatsapp'] ?? ''),
                        ]); ?>
                    </div>
                <?php endif; ?>
            </article>
        <?php endforeach; ?>
    </div>
</section>
