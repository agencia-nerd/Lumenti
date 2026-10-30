<?php
defined('ABSPATH') || exit;

/*
 * Psiquiatría · cita (specs/psiquiatria.md → cita). Grupo ACF: psiquiatria_cita.
 * Tarjeta central con 4 globos en posiciones fijas (--a a --d) y dos fichas decorativas (corazón y manos).
 */

$lumenti_cita = [
    'titulo' => '¿CÓMO ES UNA CITA POR PSIQUIATRÍA EN LUMENTI?',
    'texto' => 'Desde la primera consulta realizamos una evaluación clínica integral para comprender qué está ocurriendo, cómo ha evolucionado y de qué manera está impactando en tu vida. Cada atención se adapta al motivo de consulta y a la situación de la persona.',
    'globos' => [
        ['texto' => 'Mirada integral'],
        ['texto' => 'Atención personalizada'],
        ['texto' => 'Espacio confidencial'],
        ['texto' => 'Acompañamiento cercano'],
    ],
];

// Posiciones del diseño: solo hay lugar para 4 globos.
$lumenti_posiciones = ['a', 'b', 'c', 'd'];
$lumenti_globos = array_slice(array_values(array_filter($lumenti_cita['globos'], static fn($g) => trim((string) ($g['texto'] ?? '')) !== '')), 0, count($lumenti_posiciones));

if ($lumenti_cita['titulo'] === '') {
    return;
}
?>
<section class="lm-service-section" aria-labelledby="lm-cita">
    <div class="lm-service-visit">
        <?php foreach ($lumenti_globos as $lumenti_i => $lumenti_globo) : ?>
            <span class="lm-service-visit__chip lm-service-visit__chip--<?= esc_attr($lumenti_posiciones[$lumenti_i]) ?>"><?= esc_html($lumenti_globo['texto']) ?></span>
        <?php endforeach; ?>
        <span class="lm-service-visit__tile lm-service-visit__tile--heart" aria-hidden="true"><svg width="60" height="60" viewBox="0 0 256 256" fill="currentColor"><path d="M178,40c-20.65,0-38.73,8.88-50,23.89C116.73,48.88,98.65,40,78,40a62.07,62.07,0,0,0-62,62c0,70,103.79,126.66,108.21,129a8,8,0,0,0,7.58,0C136.21,228.66,240,172,240,102A62.07,62.07,0,0,0,178,40ZM128,214.8C109.74,204.16,32,155.69,32,102A46.06,46.06,0,0,1,78,56c19.45,0,35.78,10.36,42.6,27a8,8,0,0,0,14.8,0c6.82-16.67,23.15-27,42.6-27a46.06,46.06,0,0,1,46,46C224,155.61,146.24,204.15,128,214.8Z"/></svg></span>
        <span class="lm-service-visit__tile lm-service-visit__tile--hands" aria-hidden="true"><span class="lm-service-visit__tile-icon"></span></span>
        <div class="lm-service-visit__card">
            <h2 class="lm-service-visit__title" id="lm-cita"><?= esc_html($lumenti_cita['titulo']) ?></h2>
            <?php if ($lumenti_cita['texto'] !== '') : ?>
                <p class="lm-service-visit__text"><?= esc_html($lumenti_cita['texto']) ?></p>
            <?php endif; ?>
        </div>
    </div>
</section>
