<?php
defined('ABSPATH') || exit;

/*
 * Especialista · resumen (specs/especialista.md → resumen). Grupo ACF: especialista_resumen.
 * Columna lateral: Población y Qué trata (taxonomías poblacion y que_trata), enfoques (repetidor, oculto
 * si está vacío), Modalidad e Idiomas (taxonomías modalidad e idioma). Hoy, fijos del ejemplo del diseño.
 * Un chip de "Qué trata" es enlace solo si la condición tiene página (`condicion`); si no, texto.
 */

$lumenti_resumen = [
    'poblacion' => ['Adolescentes', 'Adultos', 'Adulto mayor'],
    'nota_adultos' => '',
    // texto + slug de la página de condición ('' = sin página).
    'que_trata' => [
        ['texto' => 'Depresión', 'condicion' => 'depresion'],
        ['texto' => 'Trastornos de ansiedad', 'condicion' => 'ansiedad'],
        ['texto' => 'Trauma y estrés postraumático (TEPT)', 'condicion' => 'trauma'],
        ['texto' => 'TDAH', 'condicion' => 'tdah'],
        ['texto' => 'Autismo (TEA)', 'condicion' => 'autismo'],
        ['texto' => 'Trastorno obsesivo compulsivo (TOC)', 'condicion' => 'toc'],
        ['texto' => 'Trastorno dismórfico corporal', 'condicion' => 'tdc'],
        ['texto' => 'Trastornos de la conducta alimentaria (TCA)', 'condicion' => 'tca'],
        ['texto' => 'Trastorno límite de la personalidad', 'condicion' => 'tlp'],
        ['texto' => 'Otros trastornos de la personalidad', 'condicion' => 'personalidad'],
        ['texto' => 'Alteraciones del sueño', 'condicion' => 'sueno'],
        ['texto' => 'Salud mental perinatal', 'condicion' => 'perinatal'],
        ['texto' => 'Trastorno disfórico premenstrual', 'condicion' => 'tdpm'],
        ['texto' => 'Trastorno bipolar', 'condicion' => 'bipolar'],
        ['texto' => 'Trastorno disociativo', 'condicion' => ''],
    ],
    'enfoques' => [],
    'modalidad' => ['Online', 'Presencial (Surco)'],
    'idiomas' => ['Español', 'Inglés', 'Portugués'],
];

$lumenti_poblacion = array_map(
    static fn($p) => ($p === 'Adultos' && $lumenti_resumen['nota_adultos'] !== '') ? sprintf('%s (%s)', $p, $lumenti_resumen['nota_adultos']) : $p,
    $lumenti_resumen['poblacion']
);
$lumenti_enfoques = array_filter(array_map(static fn($e) => is_array($e) ? (string) ($e['nombre'] ?? '') : (string) $e, (array) $lumenti_resumen['enfoques']));
?>
<aside class="lm-profile__side" aria-label="Resumen">
    <div class="lm-profile__panel">
        <?php if ($lumenti_poblacion) : ?>
            <p class="lm-profile__panel-label">Población</p>
            <ul class="lm-profile__chips"><?php foreach ($lumenti_poblacion as $lumenti_p) : ?><li class="lm-card-especialista__chip"><?= esc_html($lumenti_p) ?></li><?php endforeach; ?></ul>
        <?php endif; ?>
        <?php if ($lumenti_resumen['que_trata']) : ?>
            <p class="lm-profile__panel-label lm-profile__panel-label--spaced">Qué trata</p>
            <ul class="lm-profile__chips"><?php foreach ($lumenti_resumen['que_trata'] as $lumenti_t) : ?><li class="lm-card-especialista__chip lm-profile__chip"><?php if ($lumenti_t['condicion'] !== '') : ?><a class="lm-profile__chip-link" href="<?= esc_url(home_url('/condicion/' . $lumenti_t['condicion'] . '/')) ?>"><?= esc_html($lumenti_t['texto']) ?></a><?php else : ?><?= esc_html($lumenti_t['texto']) ?><?php endif; ?></li><?php endforeach; ?></ul>
        <?php endif; ?>
    </div>
    <?php if ($lumenti_enfoques) : ?>
        <div class="lm-profile__panel">
            <p class="lm-profile__panel-label">Enfoques</p>
            <ul class="lm-profile__chips"><?php foreach ($lumenti_enfoques as $lumenti_e) : ?><li class="lm-card-especialista__chip lm-profile__chip"><?= esc_html($lumenti_e) ?></li><?php endforeach; ?></ul>
        </div>
    <?php endif; ?>
    <?php if ($lumenti_resumen['modalidad'] || $lumenti_resumen['idiomas']) : ?>
        <div class="lm-profile__panel lm-profile__panel--split">
            <?php if ($lumenti_resumen['modalidad']) : ?>
                <div class="lm-profile__fact"><p class="lm-profile__panel-label">Modalidad</p><p class="lm-profile__fact-value"><?= esc_html(implode(' · ', $lumenti_resumen['modalidad'])) ?></p></div>
            <?php endif; ?>
            <?php if ($lumenti_resumen['idiomas']) : ?>
                <div class="lm-profile__fact"><p class="lm-profile__panel-label">Idiomas</p><p class="lm-profile__fact-value"><?= esc_html(implode(' · ', $lumenti_resumen['idiomas'])) ?></p></div>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</aside>
