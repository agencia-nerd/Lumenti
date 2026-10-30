// Condición y servicios: ajuste del título (fitTitle) y carrusel de especialistas con pills
// Todos / Médicos psiquiatras / Psicólogos, flechas y teclado. "Ver todos" se actualiza con el tipo elegido.
import { prefersReducedMotion } from './utils.js';

const TIPO = { psiquiatras: 'psiquiatra', psicologos: 'psicologo' };

// Título de condición: si una línea no cabe, reduce el tamaño (--lm-h1-scale) hasta que entre.
export function fitTitle() {
    const els = document.querySelectorAll('[data-lm-fit-title]');
    if (!els.length) return;
    const fit = () => {
        els.forEach((el) => {
            el.style.setProperty('--lm-h1-scale', '1');
            let r = 1;
            [...el.children].forEach((s) => {
                if (s.scrollWidth > s.clientWidth + 1) r = Math.min(r, s.clientWidth / s.scrollWidth);
            });
            if (r < 1) el.style.setProperty('--lm-h1-scale', (r * 0.985).toFixed(4));
        });
    };
    let t = 0;
    window.addEventListener('resize', () => {
        clearTimeout(t);
        t = setTimeout(fit, 120);
    });
    document.fonts?.ready?.then(fit);
    fit();
}

// Raíz: [data-lm-cond-specialists] (servicios) o [data-lm-specialists-carousel] (condición).
export function conditionFilter() {
    const roots = document.querySelectorAll('[data-lm-cond-specialists], [data-lm-specialists-carousel]');
    if (!roots.length) return;
    roots.forEach((root) => {
        const pills = [...root.querySelectorAll('[data-lm-cond-tipo]')];
        const track = root.querySelector('[data-lm-cond-track]');
        const items = [...root.querySelectorAll('[data-lm-specialist]')];
        const prev = root.querySelector('[data-lm-cond-prev]');
        const next = root.querySelector('[data-lm-cond-next]');
        const all = root.querySelector('[data-lm-cond-all]');
        const base = all ? all.getAttribute('href') : '';

        const arrows = () => {
            if (!track) return;
            const max = track.scrollWidth - track.clientWidth - 2;
            if (prev) prev.hidden = track.scrollLeft <= 2;
            if (next) next.hidden = track.scrollLeft >= max;
        };
        // "Ver todos" conserva sus parámetros (ej. ?atiende=depresion) y suma o quita ?tipo=.
        const allHref = (tipo) => {
            const url = new URL(base, location.href);
            if (tipo) url.searchParams.set('tipo', tipo);
            else url.searchParams.delete('tipo');
            return url.href;
        };
        const apply = (tipo) => {
            pills.forEach((p) => p.setAttribute('aria-pressed', p.dataset.lmCondTipo === tipo ? 'true' : 'false'));
            const anim = !prefersReducedMotion();
            let n = 0;
            items.forEach((c) => {
                const li = c.closest('li') || c;
                const ok = !tipo || c.dataset.tipo === TIPO[tipo];
                li.hidden = !ok;
                if (!ok) return;
                li.style.setProperty('--lm-i', Math.min(n, 4));
                li.classList.remove('is-entering');
                if (anim) {
                    void li.offsetWidth;
                    li.classList.add('is-entering');
                }
                n++;
            });
            if (all) all.setAttribute('href', allHref(tipo));
            if (track) track.scrollLeft = 0;
            arrows();
        };
        const step = (d) => {
            if (!track) return;
            const li = track.querySelector('li:not([hidden])');
            track.scrollBy({ left: d * ((li ? li.offsetWidth : 500) + 16), behavior: prefersReducedMotion() ? 'auto' : 'smooth' });
        };

        pills.forEach((p, i) => {
            p.addEventListener('click', () => apply(p.dataset.lmCondTipo));
            p.addEventListener('keydown', (e) => {
                if (e.key !== 'ArrowRight' && e.key !== 'ArrowLeft') return;
                e.preventDefault();
                const t = pills[(i + (e.key === 'ArrowRight' ? 1 : -1) + pills.length) % pills.length];
                t.focus();
                t.click();
            });
        });
        prev?.addEventListener('click', () => step(-1));
        next?.addEventListener('click', () => step(1));
        if (track) {
            track.addEventListener('scroll', arrows, { passive: true });
            track.addEventListener('keydown', (e) => {
                if (e.key === 'ArrowRight') {
                    e.preventDefault();
                    step(1);
                }
                if (e.key === 'ArrowLeft') {
                    e.preventDefault();
                    step(-1);
                }
            });
        }
        window.addEventListener('resize', arrows);
        arrows();
    });
}
