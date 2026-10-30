// Reveal al hacer scroll, smooth scroll con interpolación y ancla compensada por el navbar.
import { prefersReducedMotion, scrollToElement, smoothState } from './utils.js';

// [data-lm-reveal="up|img"]; [data-lm-reveal-group] revela a todos juntos. Sin JS el contenido queda visible.
export function reveal() {
    const els = [...document.querySelectorAll('[data-lm-reveal]')];
    if (!els.length) return;
    if (prefersReducedMotion() || !('IntersectionObserver' in window)) {
        els.forEach((el) => el.classList.add('is-revealed'));
        return;
    }
    // Lo que ya está en pantalla se muestra sin transición.
    const vh = window.innerHeight;
    els.forEach((el) => {
        if (el.getBoundingClientRect().top < vh * 0.92) {
            el.classList.add('is-revealed', 'is-instant');
            requestAnimationFrame(() => el.classList.remove('is-instant'));
        }
    });
    const io = new IntersectionObserver((entries) => {
        entries.filter((e) => e.isIntersecting).forEach(({ target }, k) => {
            if (!target.hasAttribute('data-lm-reveal-group')) target.style.setProperty('--lm-reveal-delay', `${k * 110}ms`);
            target.classList.add('is-revealed');
            io.unobserve(target);
        });
    }, { rootMargin: '0px 0px -8% 0px' });
    els.forEach((el) => { if (!el.classList.contains('is-revealed')) io.observe(el); });
}

// Solo con puntero fino y sin movimiento reducido.
export function smoothScroll() {
    if (prefersReducedMotion() || !window.matchMedia('(pointer: fine)').matches || smoothState.current) return;
    const S = smoothState.current = { cur: window.scrollY, target: window.scrollY, raf: 0 };
    const max = () => document.documentElement.scrollHeight - window.innerHeight;
    const scrollsInside = (el) => {
        for (let n = el; n && n !== document.body && n.nodeType === 1; n = n.parentElement) {
            const cs = getComputedStyle(n);
            if (/(auto|scroll)/.test(cs.overflowY) && n.scrollHeight > n.clientHeight + 1) return true;
        }
        return false;
    };
    const step = () => {
        S.cur += (S.target - S.cur) * 0.12;
        if (Math.abs(S.target - S.cur) < 0.5) S.cur = S.target;
        window.scrollTo(0, S.cur);
        S.raf = S.cur === S.target ? 0 : requestAnimationFrame(step);
    };
    window.addEventListener('wheel', (e) => {
        if (e.ctrlKey || scrollsInside(e.target) || document.documentElement.classList.contains('lm-menu-open')) return;
        e.preventDefault();
        if (!S.raf) S.cur = window.scrollY;
        S.target = Math.max(0, Math.min(max(), S.target + e.deltaY * (e.deltaMode === 1 ? 40 : 1)));
        if (!S.raf) S.raf = requestAnimationFrame(step);
    }, { passive: false });
    window.addEventListener('scroll', () => { if (!S.raf) S.cur = S.target = window.scrollY; }, { passive: true });
}

// Ancla con compensación del navbar y resaltado breve (ej. /psicologia/#evaluaciones).
export function hashTarget() {
    if (!location.hash) return;
    const el = document.getElementById(decodeURIComponent(location.hash.slice(1)));
    if (!el) return;
    setTimeout(() => {
        scrollToElement(el);
        el.classList.add('is-highlighted');
        setTimeout(() => el.classList.remove('is-highlighted'), 2200);
    }, 300);
}
