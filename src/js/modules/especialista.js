// Perfil de especialista: carrusel "Formación destacada" y barra fija de agenda.
import { prefersReducedMotion } from './utils.js';

export function profile() {
    const root = document.querySelector('[data-lm-profile]');
    if (!root) return;

    // Carrusel: flechas deshabilitadas en los extremos, flechas del teclado con foco en la lista.
    const track = root.querySelector('[data-lm-track-list]');
    const prev = root.querySelector('[data-lm-track-prev]');
    const next = root.querySelector('[data-lm-track-next]');
    if (track) {
        const upd = () => {
            const max = track.scrollWidth - track.clientWidth - 2;
            if (prev) prev.disabled = track.scrollLeft <= 2;
            if (next) next.disabled = track.scrollLeft >= max;
        };
        const step = (d) => {
            const c = track.querySelector('li');
            track.scrollBy({ left: d * ((c ? c.offsetWidth : 300) + 8), behavior: prefersReducedMotion() ? 'auto' : 'smooth' });
        };
        prev?.addEventListener('click', () => step(-1));
        next?.addEventListener('click', () => step(1));
        track.addEventListener('scroll', upd, { passive: true });
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
        window.addEventListener('resize', upd);
        upd();
    }

    // Barra fija: aparece cuando el CTA del perfil sale por arriba y se oculta al llegar al pie.
    const bar = document.querySelector('[data-lm-profile-bar]');
    const cta = root.querySelector('[data-lm-profile-cta]');
    const foot = document.querySelector('[data-lm-footer], .lm-footer');
    if (!bar || !cta || !('IntersectionObserver' in window)) return;
    const btn = bar.querySelector('a');
    let ctaOut = false;
    let footIn = false;
    const sync = () => {
        const on = ctaOut && !footIn;
        bar.classList.toggle('is-visible', on);
        bar.setAttribute('aria-hidden', on ? 'false' : 'true');
        if (btn) btn.tabIndex = on ? 0 : -1;
    };
    new IntersectionObserver(([e]) => {
        ctaOut = !e.isIntersecting && e.boundingClientRect.top < 0;
        sync();
    }).observe(cta);
    if (foot) {
        new IntersectionObserver(([e]) => {
            footIn = e.isIntersecting;
            sync();
        }).observe(foot);
    }
}
