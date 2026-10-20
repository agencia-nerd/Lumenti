// CTA final (componente compartido): el borde de arriba de la caja es un arco que se aplana a medida
// que la sección entra en pantalla, y el video de fondo corre solo mientras se ve.
// Estilos en cta.css: --cta-r y data-arco / data-plano en la caja.

const MOVIMIENTO_REDUCIDO = window.matchMedia('(prefers-reduced-motion: reduce)');

// Altura máxima del arco (px) según el ancho de pantalla.
const alturaArco = (w) => (w >= 1024 ? Math.min(170, w * 0.0885) : w >= 768 ? 72 : 40);

// Radio del círculo que pasa por las dos esquinas de arriba y baja `s` px en el centro.
const radio = (w, s) => (w * w) / 4 / (2 * s) + s / 2;

function arco(seccion, caja) {
    let objetivo = 1;
    let actual = null;
    let paso = 0;
    let medida = 0;

    const aplicar = () => {
        const s = alturaArco(window.innerWidth) * actual;
        caja.toggleAttribute('data-plano', s < 0.5);
        if (s >= 0.5) caja.style.setProperty('--cta-r', `${radio(Math.min(caja.offsetWidth, 1920), s).toFixed(1)}px`);
    };

    // Se acerca un 10 % por cuadro al valor del scroll.
    const avanzar = () => {
        paso = 0;
        actual += (objetivo - actual) * 0.1;
        if (Math.abs(objetivo - actual) < 0.001) actual = objetivo;
        aplicar();
        if (actual !== objetivo) paso = requestAnimationFrame(avanzar);
    };

    // 1 = arco completo (aún abajo) → 0 = recta (ya subió un 70 % de la pantalla).
    const medir = () => {
        medida = 0;
        const alto = window.innerHeight;
        const p = Math.max(0, Math.min(1, (alto * 0.95 - seccion.getBoundingClientRect().top) / (alto * 0.7)));
        objetivo = 1 - p * p * (3 - 2 * p);
        if (actual === null) {
            actual = objetivo;
            aplicar();
        }
        if (!paso) paso = requestAnimationFrame(avanzar);
    };

    const alMover = () => {
        if (!medida) medida = requestAnimationFrame(medir);
    };

    caja.setAttribute('data-arco', '');
    window.addEventListener('scroll', alMover, { passive: true });
    window.addEventListener('resize', alMover);
    medir();
}

// El video corre solo cuando la sección está a la vista (y nunca con movimiento reducido).
function video(seccion, el) {
    if (MOVIMIENTO_REDUCIDO.matches) return;
    new IntersectionObserver(([e]) => {
        if (e.isIntersecting) el.play().catch(() => {});
        else el.pause();
    }).observe(seccion);
}

export function initCta() {
    document.querySelectorAll('[data-cta]').forEach((seccion) => {
        const caja = seccion.querySelector('[data-cta-caja]');
        if (!MOVIMIENTO_REDUCIDO.matches) arco(seccion, caja);
        const el = seccion.querySelector('[data-cta-video]');
        if (el) video(seccion, el);
    });
}
