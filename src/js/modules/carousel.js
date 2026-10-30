// Carruseles [data-lm-carousel="<diseño>"] con dots, flechas, swipe y teclado.
// Uso: [data-lm-carousel] > [data-lm-carousel-stage] > [data-lm-carousel-item]; [data-lm-carousel-dot|prev|next].
// Diseños: "testimonials" (abanico con 5 posiciones visibles). Un valor desconocido usa el abanico.
import { prefersReducedMotion } from './utils.js';

// Fondo de cada posición visible (-2…2). Posición, giro y alto se calculan según el ancho, por eso van en style.
const PAL = { '-2': 'rgba(236,227,211,0.9)', '-1': 'rgba(231,230,232,0.86)', 0: '#ffffff', 1: 'rgba(194,212,214,0.86)', 2: 'rgba(240,231,222,0.9)' };
const EASE = 'transform 800ms cubic-bezier(.65,0,.25,1), background-color 800ms linear, box-shadow 800ms linear';

function geometry(w) {
    let cw, dx1, dx2, dy1, dy2, r1, r2;
    if (w >= 1024) {
        cw = Math.min(589, Math.max(420, w * 0.3068));
        [dx1, dx2, dy1, dy2, r1, r2] = [cw * 0.613, cw * 1.117, cw * 0.165, cw * 0.363, 5, 7.5];
    } else if (w >= 768) {
        cw = Math.min(520, w * 0.6);
        [dx1, dx2, dy1, dy2, r1, r2] = [w * 0.36, w * 0.68, 56, 120, 5, 7.5];
    } else {
        cw = w * 0.84;
        [dx1, dx2, dy1, dy2, r1, r2] = [w * 0.66, w * 1.3, 28, 64, 4, 6];
    }
    const dx3 = Math.max(dx2 + cw * 0.5, w / 2 + cw * 0.75);
    return { cw, dx: [0, dx1, dx2, dx3], dy: [0, dy1, dy2, dy2 * 1.4], r: [0, r1, r2, r2 + 2.5] };
}

// Abanico: la card activa al centro, dos a cada lado giradas y el resto fuera de escena.
function fanLayout(root) {
    const stage = root.querySelector('[data-lm-carousel-stage]');
    const items = [...root.querySelectorAll('[data-lm-carousel-item]')];
    const dots = [...root.querySelectorAll('[data-lm-carousel-dot]')];
    if (!stage || !items.length) return;
    const n = items.length;
    const side = [];
    let cur = 0;
    let iv = 0;

    const pos = (i) => {
        let p = ((i - cur) % n + n) % n;
        if (p > n / 2) p -= n;
        return p;
    };
    const render = () => {
        const g = geometry(window.innerWidth);
        const reduce = prefersReducedMotion();
        let maxH = 0;
        items.forEach((el) => { el.style.width = `${g.cw.toFixed(0)}px`; });
        items.forEach((el) => {
            el.style.minHeight = '';
            maxH = Math.max(maxH, el.offsetHeight);
        });
        const ch = Math.max(g.cw * 0.596, maxH);
        items.forEach((el, i) => {
            const p = pos(i);
            const a = Math.min(3, Math.abs(p));
            const s = Math.sign(p) || 1;
            let jump = false;
            // Una card que cruza de un lado al otro fuera de escena salta sin transición.
            if (a >= 3) {
                if (side[i] != null && side[i] !== s) jump = true;
                side[i] = s;
            } else side[i] = null;
            el.style.transition = jump || reduce ? 'none' : EASE;
            el.style.transform = `translate3d(calc(-50% + ${(a ? s * g.dx[a] : 0).toFixed(1)}px), ${g.dy[a].toFixed(1)}px, 0) rotate(${a ? s * g.r[a] : 0}deg)`;
            el.style.backgroundColor = PAL[Math.max(-2, Math.min(2, p))];
            el.style.zIndex = String(Math.max(1, 5 - a));
            el.style.boxShadow = a === 0 ? '0 12px 40px rgba(26,32,44,0.06)' : (a < 3 ? '0 8px 28px rgba(26,32,44,0.03)' : 'none');
            el.style.minHeight = `${ch.toFixed(0)}px`;
            el.setAttribute('aria-hidden', a ? 'true' : 'false');
        });
        stage.style.height = `${(ch + g.dy[2] + 40).toFixed(0)}px`;
        dots.forEach((d, i) => {
            if (i === cur) d.setAttribute('aria-current', 'true');
            else d.removeAttribute('aria-current');
            d.classList.toggle('is-active', i === cur);
        });
    };
    const step = (dir) => {
        cur = ((cur + dir) % n + n) % n;
        render();
    };
    // Va al ítem i por el camino más corto, de a un paso cada 260 ms.
    const go = (i) => {
        clearInterval(iv);
        const t = ((i % n) + n) % n;
        let d = t - cur;
        if (d > n / 2) d -= n;
        if (d < -n / 2) d += n;
        if (!d) return;
        const dir = Math.sign(d);
        let left = Math.abs(d) - 1;
        step(dir);
        if (left > 0) {
            iv = setInterval(() => {
                step(dir);
                if (--left <= 0) clearInterval(iv);
            }, 260);
        }
    };

    dots.forEach((d, i) => d.addEventListener('click', () => go(i)));
    root.querySelector('[data-lm-carousel-prev]')?.addEventListener('click', () => go(cur - 1));
    root.querySelector('[data-lm-carousel-next]')?.addEventListener('click', () => go(cur + 1));
    let x0 = null;
    stage.addEventListener('pointerdown', (e) => { x0 = e.clientX; });
    stage.addEventListener('pointerup', (e) => {
        if (x0 == null) return;
        const dx = e.clientX - x0;
        x0 = null;
        if (Math.abs(dx) > 40) go(cur + (dx < 0 ? 1 : -1));
    });
    stage.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowRight') {
            e.preventDefault();
            go(cur + 1);
        }
        if (e.key === 'ArrowLeft') {
            e.preventDefault();
            go(cur - 1);
        }
    });
    let rt = 0;
    window.addEventListener('resize', () => {
        clearTimeout(rt);
        rt = setTimeout(render, 120);
    });
    render();
}

const layouts = { testimonials: fanLayout };

export function carousel() {
    const roots = document.querySelectorAll('[data-lm-carousel]');
    if (!roots.length) return;
    roots.forEach((root) => (layouts[root.dataset.lmCarousel] || fanLayout)(root));
}
