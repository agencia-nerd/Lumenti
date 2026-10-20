// Servicios (portada): círculo "Saber más" que sigue al mouse sobre las tarjetas, con un
// retraso suave. Solo con mouse y sin movimiento reducido; si no, quedan la flecha y el cursor normal.
// Estilos en servicios.css: [data-cursor] en la sección, [data-visible] en el círculo.

const MOVIMIENTO_REDUCIDO = window.matchMedia('(prefers-reduced-motion: reduce)');
const MOUSE = window.matchMedia('(hover: hover) and (pointer: fine)');

export function initServicios() {
    const seccion = document.querySelector('[data-servicios]');
    const cursor = seccion?.querySelector('[data-servicios-cursor]');
    if (!cursor || !MOUSE.matches || MOVIMIENTO_REDUCIDO.matches) return;

    seccion.setAttribute('data-cursor', '');

    const pos = { x: 0, y: 0, destinoX: 0, destinoY: 0 };
    let dentro = false;
    let paso = 0;

    const pintar = () => {
        cursor.style.setProperty('--cursor-x', `${pos.x.toFixed(1)}px`);
        cursor.style.setProperty('--cursor-y', `${pos.y.toFixed(1)}px`);
    };

    // Se acerca un 16 % por cuadro; al salir sigue hasta llegar y se detiene.
    const avanzar = () => {
        pos.x += (pos.destinoX - pos.x) * 0.16;
        pos.y += (pos.destinoY - pos.y) * 0.16;
        pintar();
        const quieto = Math.abs(pos.destinoX - pos.x) < 0.3 && Math.abs(pos.destinoY - pos.y) < 0.3;
        paso = dentro || !quieto ? requestAnimationFrame(avanzar) : 0;
    };

    seccion.addEventListener('pointermove', (e) => {
        if (e.pointerType !== 'mouse') return;
        pos.destinoX = e.clientX;
        pos.destinoY = e.clientY;
        if (!dentro) {
            dentro = true;
            if (!paso) {
                pos.x = pos.destinoX; // aparece donde está el mouse, sin cruzar la pantalla
                pos.y = pos.destinoY;
            }
            cursor.setAttribute('data-visible', '');
        }
        if (!paso) paso = requestAnimationFrame(avanzar);
    });

    seccion.addEventListener('pointerleave', () => {
        dentro = false;
        cursor.removeAttribute('data-visible');
    });
}
