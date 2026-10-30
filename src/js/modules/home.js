// Portada: preloader, hero slider, cifras animadas, abanico "Sobre Lumenti" e imágenes de "Psicología para el día a día".
import { prefersReducedMotion } from './utils.js';

const html = document.documentElement;
const PRE_KEY = 'lmPreSeen';

// Preloader: una vez por sesión. Mientras está activo, el hero espera (html sin .lm-go).
// Corre en todas las páginas: sin preloader solo libera el hero (.lm-go).
export function preloader() {
    const pre = document.querySelector('[data-lm-preloader]');
    let seen = false;
    try { seen = sessionStorage.getItem(PRE_KEY) === '1'; } catch { /* sin storage */ }
    if (!pre || seen || prefersReducedMotion()) {
        pre?.remove();
        html.classList.add('lm-go');
        return;
    }
    html.classList.add('lm-pre-on');
    pre.hidden = false;
    setTimeout(() => pre.classList.add('is-ready'), 60);
    setTimeout(() => {
        pre.classList.add('is-leaving');
        html.classList.add('lm-go');
    }, 1900);
    setTimeout(() => {
        pre.remove();
        html.classList.remove('lm-pre-on');
        try { sessionStorage.setItem(PRE_KEY, '1'); } catch { /* sin storage */ }
    }, 2700);
}

// Hero: slides con pestañas, autoavance cada 6 s, pausa con hover/foco en el CTA. Arranca con .lm-go.
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
    if (!texts.length) return;
    const ken = texts.map(() => 0);
    let cur = 0;
    let t0 = 0;
    let left = DUR;
    let timer = 0;
    let paused = false;

    const phase = (list, i, prev) => {
        list.forEach((el, k) => {
            el.classList.remove('is-active', 'is-in', 'is-out', 'is-hidden');
            el.classList.add(k === i ? (prev == null ? 'is-active' : 'is-in') : (k === prev ? 'is-out' : 'is-hidden'));
            if (el.hasAttribute('data-lm-hero-text')) el.setAttribute('aria-hidden', k === i ? 'false' : 'true');
        });
    };
    const schedule = () => {
        clearTimeout(timer);
        if (paused || reduce) return;
        t0 = Date.now();
        timer = setTimeout(() => show((cur + 1) % texts.length), left);
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
    const pause = (on) => {
        paused = on;
        hero.classList.toggle('is-paused', on);
        if (on) {
            clearTimeout(timer);
            left = Math.max(0, left - (Date.now() - t0));
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
    q('[data-lm-hero-pause]').forEach((a) => {
        a.addEventListener('mouseenter', () => pause(true));
        a.addEventListener('mouseleave', () => pause(false));
        a.addEventListener('focus', () => pause(true));
        a.addEventListener('blur', () => pause(false));
    });

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
