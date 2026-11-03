// Portada: preloader, hero slider, cifras animadas, abanico "Sobre Lumenti" e imágenes de "Psicología para el día a día".
import { prefersReducedMotion } from './utils.js';

const html = document.documentElement;
const PRE_KEY = 'lmPreSeen';

// Preloader (una vez por sesión), como en el diseño: aparece el cerebro, se desplaza, entra la palabra, el círculo
// verde cubre la pantalla y un anillo se abre desde el centro dejando ver el hero. Mientras dura, el hero espera
// (html sin .lm-go). Corre en todas las páginas: sin preloader solo libera el hero (.lm-go).
const EASE_OUT = 'cubic-bezier(.2,.8,.2,1)';
const EASE_IO = 'cubic-bezier(.65,0,.35,1)';

const animate = (el, frames, opts) => el.animate(frames, { fill: 'forwards', easing: EASE_OUT, ...opts });

// Apertura: una máscara radial deja un agujero que crece desde el centro y un anillo verde marca su borde.
function openPreloader(pre, finish) {
    const brain = pre.querySelector('[data-lm-pre-brain]');
    const ring = pre.querySelector('[data-lm-pre-ring]');
    const W = window.innerWidth;
    const H = window.innerHeight;
    const cx = W / 2;
    const cy = H / 2;
    const r0 = brain.getBoundingClientRect().width / 2;
    const r1 = Math.hypot(cx, cy) + 4;
    const t0 = performance.now();
    const DUR = 850;
    const ease = (t) => (t < 0.5 ? 4 * t * t * t : 1 - Math.pow(-2 * t + 2, 3) / 2);
    html.classList.add('lm-go');
    ring.style.opacity = '1';
    const step = (now) => {
        const t = Math.min(1, (now - t0) / DUR);
        const r = r0 + (r1 - r0) * ease(t);
        const mask = `radial-gradient(circle at ${cx}px ${cy}px, transparent ${r.toFixed(1)}px, #000 ${(r + 1).toFixed(1)}px)`;
        pre.style.webkitMaskImage = mask;
        pre.style.maskImage = mask;
        ring.style.width = ring.style.height = `${(2 * r).toFixed(1)}px`;
        ring.style.transform = `translate(${(cx - r).toFixed(1)}px,${(cy - r).toFixed(1)}px)`;
        ring.style.opacity = String(1 - Math.max(0, (t - 0.55) / 0.45));
        if (t < 1) requestAnimationFrame(step);
        else finish();
    };
    step(t0);
}

export function preloader() {
    const pre = document.querySelector('[data-lm-preloader]');
    let seen = false;
    try { seen = sessionStorage.getItem(PRE_KEY) === '1'; } catch { /* sin storage */ }
    if (!pre || seen || prefersReducedMotion() || !pre.animate) {
        pre?.remove();
        html.classList.add('lm-go');
        return;
    }
    try { sessionStorage.setItem(PRE_KEY, '1'); } catch { /* sin storage */ }
    pre.hidden = false;
    html.classList.add('lm-pre-on');
    const brain = pre.querySelector('[data-lm-pre-brain]');
    const word = pre.querySelector('[data-lm-pre-word]');
    const row = pre.querySelector('[data-lm-pre-row]');
    const green = pre.querySelector('[data-lm-pre-fill]');
    // El cerebro empieza centrado en la pantalla (desplazado hacia la derecha del lugar que ocupa en el logo).
    const rb = row.getBoundingClientRect();
    const bb = brain.getBoundingClientRect();
    const off = (rb.left + rb.width / 2) - (bb.left + bb.width / 2);
    let done = false;
    const finish = () => {
        if (done) return;
        done = true;
        html.classList.remove('lm-pre-on');
        html.classList.add('lm-go');
        pre.remove();
    };
    animate(brain, [{ opacity: 0, transform: `translateX(${off}px) scale(.86)` }, { opacity: 1, transform: `translateX(${off}px) scale(1)` }], { duration: 500, delay: 40 });
    animate(brain, [{ transform: `translateX(${off}px)` }, { transform: 'none' }], { duration: 650, delay: 550, easing: EASE_IO });
    animate(word, [{ clipPath: 'inset(0 100% 0 0)', transform: 'translateX(-10px)' }, { clipPath: 'inset(0 0% 0 0)', transform: 'none' }], { duration: 550, delay: 1150 });
    const t = 1850;
    animate(green, [{ transform: 'translate(-50%, -50%) scale(0)' }, { transform: 'translate(-50%, -50%) scale(1)' }], { duration: 700, delay: t, easing: EASE_IO });
    [brain, word].forEach((el) => {
        animate(el, [{ backgroundColor: getComputedStyle(el).backgroundColor }, { backgroundColor: '#ffffff' }], { duration: 360, delay: t + 220, easing: 'linear' });
    });
    setTimeout(() => html.classList.add('lm-go'), t - 250);
    setTimeout(() => openPreloader(pre, finish), t + 1150);
    setTimeout(finish, t + 1150 + 1500); // red de seguridad
}

// Hero: slides con pestañas y autoavance cada 6 s. Arranca con .lm-go.
// Pausa (WCAG 2.2.2): el botón [data-lm-hero-toggle] detiene o reanuda el avance; el hover sobre el hero lo pausa
// mientras dura y el foco de teclado dentro del hero lo detiene hasta que se pulse reanudar (patrón WAI-ARIA).
// Con movimiento reducido no hay avance automático y el botón queda oculto.
export function heroSlider() {
    const hero = document.querySelector('[data-lm-hero]');
    if (!hero) return;
    const DUR = 6000;
    const reduce = prefersReducedMotion();
    const q = (s) => [...hero.querySelectorAll(s)];
    const texts = q('[data-lm-hero-text]');
    const imgs = q('[data-lm-hero-img]');
    const nums = q('[data-lm-hero-num]');
    const tabs = q('[data-lm-hero-tab]');
    const toggle = hero.querySelector('[data-lm-hero-toggle]');
    if (!texts.length) return;
    const ken = texts.map(() => 0);
    let cur = 0;
    let t0 = 0;
    let left = DUR;
    let timer = 0;
    let paused = false;
    let stopped = false; // detenido por el usuario (botón o foco)
    let hovered = false; // pausa temporal mientras el mouse está sobre el hero

    const phase = (list, i, prev) => {
        list.forEach((el, k) => {
            el.classList.remove('is-active', 'is-in', 'is-out', 'is-hidden');
            el.classList.add(k === i ? (prev == null ? 'is-active' : 'is-in') : (k === prev ? 'is-out' : 'is-hidden'));
            if (el.hasAttribute('data-lm-hero-text')) {
                el.setAttribute('aria-hidden', k === i ? 'false' : 'true');
                // Fuera del slide visible nada recibe foco (el botón del slide oculto seguía en el orden de Tab).
                el.inert = k !== i;
            }
        });
    };
    const schedule = () => {
        clearTimeout(timer);
        timer = 0;
        if (paused || reduce) return;
        t0 = Date.now();
        timer = setTimeout(() => {
            timer = 0;
            show((cur + 1) % texts.length);
        }, left);
    };
    const restart = () => {
        tabs.forEach((t, k) => {
            const f = t.querySelector('[data-lm-hero-fill]');
            if (!f) return;
            f.classList.remove('is-filling');
            void f.offsetWidth;
            if (k === cur) f.classList.add('is-filling');
        });
        left = DUR;
        schedule();
    };
    function show(i) {
        if (i === cur) {
            restart();
            return;
        }
        const prev = cur;
        cur = i;
        ken[i] = 1 - ken[i];
        [texts, imgs, nums].forEach((l) => phase(l, i, prev));
        imgs.forEach((el, k) => el.classList.toggle('is-ken-b', k === i && ken[i] === 1));
        tabs.forEach((t, k) => {
            t.setAttribute('aria-selected', k === i ? 'true' : 'false');
            t.tabIndex = k === i ? 0 : -1;
        });
        restart();
    }
    // Recalcula la pausa: guarda el tiempo que le quedaba al slide y lo retoma al reanudar.
    const sync = () => {
        const on = stopped || hovered;
        if (toggle) toggle.setAttribute('aria-pressed', stopped ? 'true' : 'false');
        if (on === paused) return;
        paused = on;
        hero.classList.toggle('is-paused', on);
        if (on) {
            if (timer) {
                clearTimeout(timer);
                timer = 0;
                left = Math.max(0, left - (Date.now() - t0));
            }
        } else schedule();
    };

    tabs.forEach((t, k) => {
        t.addEventListener('click', () => show(k));
        t.addEventListener('keydown', (e) => {
            if (e.key !== 'ArrowRight' && e.key !== 'ArrowLeft') return;
            e.preventDefault();
            const n = (k + (e.key === 'ArrowRight' ? 1 : -1) + tabs.length) % tabs.length;
            show(n);
            tabs[n].focus();
        });
        t.tabIndex = k === 0 ? 0 : -1;
    });
    if (!reduce && texts.length > 1) {
        if (toggle) {
            toggle.hidden = false;
            toggle.addEventListener('click', () => {
                stopped = !stopped;
                sync();
            });
        }
        // Hover en cualquier parte del hero (solo mouse). Sobre el botón no cuenta: al pulsar "reanudar" con el
        // mouse encima, el avance tiene que arrancar en el momento.
        if (window.matchMedia('(hover: hover) and (pointer: fine)').matches) {
            hero.addEventListener('mouseover', (e) => {
                hovered = !(toggle && toggle.contains(e.target));
                sync();
            });
            hero.addEventListener('mouseleave', () => {
                hovered = false;
                sync();
            });
        }
        // Foco dentro del hero (pestañas, CTA): se detiene hasta que se pulse reanudar.
        hero.addEventListener('focusin', (e) => {
            if (toggle && toggle.contains(e.target)) return;
            stopped = true;
            sync();
        });
    }

    if (html.classList.contains('lm-go')) restart();
    else {
        new MutationObserver((m, o) => {
            if (!html.classList.contains('lm-go')) return;
            o.disconnect();
            restart();
        }).observe(html, { attributes: true, attributeFilter: ['class'] });
    }
}

// Cifras: cuentan desde 0 al entrar en pantalla (prefijo, sufijo y separador de miles: "+3,000").
export function countUp() {
    const els = [...document.querySelectorAll('[data-lm-count]')];
    if (!els.length || !('IntersectionObserver' in window) || prefersReducedMotion()) return;
    const parse = (s) => {
        const m = String(s).match(/^(\D*)([\d,]+)(.*)$/);
        return m ? { pre: m[1], n: parseInt(m[2].replace(/,/g, ''), 10), post: m[3], sep: m[2].includes(',') } : null;
    };
    const items = els.map((el) => ({ el, v: parse(el.dataset.lmCount) })).filter((it) => it.v);
    if (!items.length) return;
    items.forEach(({ el, v }) => { el.textContent = `${v.pre}0${v.post}`; });
    const io = new IntersectionObserver((entries) => {
        if (!entries.some((e) => e.isIntersecting)) return;
        io.disconnect();
        const t0 = performance.now();
        const step = (now) => {
            const p = Math.min(1, (now - t0) / 1800);
            const ease = 1 - Math.pow(1 - p, 3);
            items.forEach(({ el, v }) => {
                const x = Math.round(v.n * ease);
                el.textContent = v.pre + (v.sep ? x.toLocaleString('en-US') : x) + v.post;
            });
            if (p < 1) requestAnimationFrame(step);
        };
        step(t0);
    }, { threshold: 0.4 });
    io.observe(els[0].closest('section') || els[0]);
}

// Abanico: se abre cuando se ve un tercio de la pieza principal y se cierra al salir. Con movimiento reducido queda abierto.
export function fan() {
    const root = document.querySelector('[data-lm-fan]');
    if (!root) return;
    if (prefersReducedMotion() || !('IntersectionObserver' in window)) {
        root.classList.add('is-open');
        return;
    }
    const main = root.querySelector('[data-lm-fan-main]') || root;
    new IntersectionObserver((entries) => {
        entries.forEach((e) => root.classList.toggle('is-open', e.intersectionRatio >= 0.33));
    }, { threshold: [0, 0.33] }).observe(main);
}

// Servicios: cursor circular "SABER MÁS" con un punto que gira, que sigue al mouse con un leve retraso.
// Solo con mouse (puntero fino y hover); en táctil se quita y se ven la flecha y las descripciones (CSS).
export function serviceCursor() {
    const zone = document.querySelector('[data-lm-cursor-zone]');
    const cursor = document.querySelector('[data-lm-cursor]');
    if (!zone || !cursor || !window.matchMedia('(hover: hover) and (pointer: fine)').matches) {
        cursor?.remove();
        return;
    }
    zone.classList.add('has-cursor');
    const pos = { x: -300, y: -300, tx: -300, ty: -300, on: false, running: false };
    const loop = () => {
        pos.x += (pos.tx - pos.x) * 0.16;
        pos.y += (pos.ty - pos.y) * 0.16;
        cursor.style.transform = `translate3d(${pos.x.toFixed(1)}px,${pos.y.toFixed(1)}px,0)`;
        if (pos.on || Math.abs(pos.tx - pos.x) > 0.3 || Math.abs(pos.ty - pos.y) > 0.3) requestAnimationFrame(loop);
        else pos.running = false;
    };
    zone.addEventListener('mousemove', (e) => {
        pos.tx = e.clientX;
        pos.ty = e.clientY;
        if (!pos.on) {
            pos.on = true;
            if (!pos.running) {
                pos.x = pos.tx;
                pos.y = pos.ty;
            }
            cursor.classList.add('is-visible');
        }
        if (!pos.running) {
            pos.running = true;
            requestAnimationFrame(loop);
        }
    });
    zone.addEventListener('mouseleave', () => {
        pos.on = false;
        cursor.classList.remove('is-visible');
    });
}

// Psicología para el día a día: la imagen del marco cambia con hover o foco en cada opción.
export function daily() {
    const root = document.querySelector('[data-lm-daily]');
    if (!root) return;
    const imgs = [...root.querySelectorAll('[data-lm-daily-img]')];
    let cur = 0;
    const set = (i) => {
        if (i === cur || !imgs[i]) return;
        imgs.forEach((im, k) => {
            im.classList.remove('is-active', 'is-prev', 'is-hidden');
            im.classList.add(k === i ? 'is-active' : (k === cur ? 'is-prev' : 'is-hidden'));
        });
        cur = i;
    };
    root.querySelectorAll('[data-lm-daily-opt]').forEach((a) => {
        const i = Number(a.dataset.lmDailyOpt);
        a.addEventListener('mouseenter', () => set(i));
        a.addEventListener('focus', () => set(i));
    });
}
