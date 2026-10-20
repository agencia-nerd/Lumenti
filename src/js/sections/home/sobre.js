// Sobre Lumenti (portada): abre las fotos en abanico según el scroll (estilos en sobre.css).
// El avance va de 0 a 1 mientras la tarjeta sube por la pantalla y lo sigue con un retraso suave.

const MOVIMIENTO_REDUCIDO = window.matchMedia('(prefers-reduced-motion: reduce)');

export function initSobre() {
    const abanico = document.querySelector('[data-sobre-abanico]');
    if (!abanico || !abanico.querySelector('[data-sobre-foto]') || MOVIMIENTO_REDUCIDO.matches) return;

    let objetivo = 0;
    let actual = null;
    let medida = 0;
    let paso = 0;
    let antes = 0;

    // Empieza cuando un tercio de la tarjeta asoma y termina con su centro al 55 % de la pantalla.
    const medir = () => {
        medida = 0;
        const alto = window.innerHeight;
        const r = abanico.getBoundingClientRect();
        const inicio = alto - r.height / 3;
        const fin = alto * 0.55 - r.height / 2;
        const p = Math.min(1, Math.max(0, (inicio - r.top) / (inicio - fin)));
        objetivo = 1 - (1 - p) ** 4;
        if (actual === null) actual = objetivo; // al cargar a media página, ya llega en su sitio
        if (!paso) {
            antes = performance.now();
            paso = requestAnimationFrame(avanzar);
        }
    };

    // Acerca el valor un 2.8 % por cuadro de 60 fps, igual en pantallas de 120 Hz.
    const avanzar = (ahora) => {
        paso = 0;
        const factor = 1 - (1 - 0.028) ** (Math.max(0, ahora - antes) / (1000 / 60));
        antes = ahora;
        actual += (objetivo - actual) * factor;
        if (Math.abs(objetivo - actual) < 0.0005) actual = objetivo;
        abanico.style.setProperty('--abanico', actual.toFixed(4));
        if (actual !== objetivo) paso = requestAnimationFrame(avanzar);
    };

    const alMover = () => {
        if (!medida) medida = requestAnimationFrame(medir);
    };

    window.addEventListener('scroll', alMover, { passive: true });
    window.addEventListener('resize', alMover);
    medir();
}
