// Testimonios (portada): mazo de tarjetas. La actual va al centro; las vecinas se corren y giran a
// los lados (hasta 2 por lado) y el resto queda fuera de pantalla. Flechas, puntos, arrastre y
// flechas del teclado. Las tarjetas que no están al frente quedan ocultas para lectores de pantalla.
// Medidas y posiciones como variables CSS; colores y capas por data-pos / data-dist (testimonios.css).

const SALTO_MS = 820; // lo que tarda una tarjeta en salir; antes no cambia de lado por detrás

// Ancho de tarjeta, corrimientos (dx), bajadas (dy) y giros (r) para la 1.ª y 2.ª vecina, según pantalla.
function medidas(w) {
    let cw, dx, dy, r;
    if (w >= 1024) {
        cw = Math.min(589, Math.max(420, w * 0.3068));
        dx = [cw * 0.613, cw * 1.117];
        dy = [cw * 0.165, cw * 0.363];
        r = [5, 7.5];
    } else if (w >= 768) {
        cw = Math.min(520, w * 0.6);
        dx = [w * 0.36, w * 0.68];
        dy = [56, 120];
        r = [5, 7.5];
    } else {
        cw = w * 0.84;
        dx = [w * 0.66, w * 1.3];
        dy = [28, 64];
        r = [4, 6];
    }
    // Fuera de pantalla: más allá del borde, más abajo y más girada.
    dx.push(Math.max(dx[1] + cw * 0.5, w / 2 + cw * 0.75));
    dy.push(dy[1] * 1.4);
    r.push(r[1] + 2.5);
    return { cw, dx: [0, ...dx], dy: [0, ...dy], r: [0, ...r] };
}

function carrusel(raiz) {
    const escena = raiz.querySelector('[data-testimonios-escena]');
    const tarjetas = [...escena.querySelectorAll('[data-testimonio]')];
    const puntos = [...raiz.querySelectorAll('[data-testimonios-punto]')];
    const n = tarjetas.length;
    if (n < 2) return;

    let actual = 0;
    let m = null;
    let intervalo = 0;
    let despertar = 0;
    const lado = new Array(n).fill(null); // lado por el que salió cada tarjeta que está fuera
    const fueraDesde = new Array(n).fill(0);

    // Distancia con signo de la tarjeta i a la actual, por el camino más corto.
    const posicion = (i) => {
        let p = (((i - actual) % n) + n) % n;
        if (p > n / 2) p -= n;
        return p;
    };

    // Ancho según la pantalla y alto según la tarjeta con más texto.
    const medir = () => {
        m = medidas(document.documentElement.clientWidth);
        escena.style.setProperty('--card-w', `${m.cw.toFixed(0)}px`);
        escena.style.setProperty('--card-h', '0px');
        const alto = Math.max(m.cw * 0.596, ...tarjetas.map((t) => t.offsetHeight));
        escena.style.setProperty('--card-h', `${Math.ceil(alto)}px`);
        escena.style.setProperty('--escena-h', `${Math.ceil(alto + m.dy[2] + m.cw * 0.14)}px`);
    };

    const pintar = () => {
        const ahora = performance.now();
        tarjetas.forEach((t, i) => {
            const p = posicion(i);
            const a = Math.min(3, Math.abs(p));
            let s = Math.sign(p);
            let salto = false;

            if (a >= 3) {
                if (lado[i] === null) {
                    lado[i] = s;
                    fueraDesde[i] = ahora;
                } else if (s !== lado[i]) {
                    // Ya estaba fuera y ahora le toca el otro lado: cruza sin animar, pero solo
                    // cuando terminó de salir (si no, se vería pasar por detrás).
                    const falta = SALTO_MS - (ahora - fueraDesde[i]);
                    if (falta <= 0) {
                        lado[i] = s;
                        salto = true;
                    } else {
                        s = lado[i];
                        clearTimeout(despertar);
                        despertar = setTimeout(pintar, falta + 20);
                    }
                }
            } else {
                lado[i] = null;
            }

            t.toggleAttribute('data-salto', salto);
            t.style.setProperty('--tx', `${(a === 0 ? 0 : s * m.dx[a]).toFixed(1)}px`);
            t.style.setProperty('--ty', `${m.dy[a].toFixed(1)}px`);
            t.style.setProperty('--rot', `${s * m.r[a]}deg`);
            t.dataset.pos = String(Math.max(-2, Math.min(2, a === 0 ? 0 : s * a)));
            t.dataset.dist = String(a);
            t.toggleAttribute('inert', a !== 0);
            t.setAttribute('aria-hidden', String(a !== 0));
        });
        puntos.forEach((b, i) => (i === actual ? b.setAttribute('aria-current', 'true') : b.removeAttribute('aria-current')));
    };

    const paso = (dir) => {
        actual = (((actual + dir) % n) + n) % n;
        pintar();
    };

    // Hacia una tarjeta lejana avanza de a una (260 ms entre cada una) por el camino más corto.
    const ir = (destino) => {
        clearInterval(intervalo);
        let d = (((destino % n) + n) % n) - actual;
        if (d > n / 2) d -= n;
        if (d < -n / 2) d += n;
        if (!d) return;
        const dir = Math.sign(d);
        let quedan = Math.abs(d) - 1;
        paso(dir);
        if (quedan > 0) {
            intervalo = setInterval(() => {
                paso(dir);
                if (--quedan <= 0) clearInterval(intervalo);
            }, 260);
        }
    };

    raiz.querySelector('[data-testimonios-anterior]')?.addEventListener('click', () => ir(actual - 1));
    raiz.querySelector('[data-testimonios-siguiente]')?.addEventListener('click', () => ir(actual + 1));
    puntos.forEach((b, i) => b.addEventListener('click', () => ir(i)));

    raiz.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowLeft') ir(actual - 1);
        if (e.key === 'ArrowRight') ir(actual + 1);
    });

    // Arrastre: más de 40 px hacia un lado cambia de tarjeta.
    let inicioX = null;
    escena.addEventListener('pointerdown', (e) => {
        inicioX = e.clientX;
    });
    escena.addEventListener('pointerup', (e) => {
        if (inicioX === null) return;
        const dx = e.clientX - inicioX;
        inicioX = null;
        if (Math.abs(dx) > 40) ir(actual + (dx < 0 ? 1 : -1));
    });
    escena.addEventListener('pointercancel', () => {
        inicioX = null;
    });

    escena.setAttribute('data-listo', '');
    raiz.querySelectorAll('[data-testimonios-controles], [data-testimonios-puntos]').forEach((el) => (el.hidden = false));
    medir();
    // Al montar, todas llegan a su sitio sin animar.
    tarjetas.forEach((t) => t.setAttribute('data-salto', ''));
    pintar();
    requestAnimationFrame(() => requestAnimationFrame(() => tarjetas.forEach((t) => t.removeAttribute('data-salto'))));

    let espera = 0;
    window.addEventListener('resize', () => {
        cancelAnimationFrame(espera);
        espera = requestAnimationFrame(() => {
            medir();
            pintar();
        });
    });
    document.fonts?.ready.then(() => {
        medir();
        pintar();
    });
}

export function initTestimonios() {
    document.querySelectorAll('[data-testimonios]').forEach(carrusel);
}
