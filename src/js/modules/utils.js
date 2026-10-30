// Utilidades compartidas por los módulos: movimiento reducido, búsqueda sin tildes y scroll compensado por el navbar.
const NAV_SELECTOR = '[data-lm-navbar]';
const reduceQuery = window.matchMedia('(prefers-reduced-motion: reduce)');

// Estado del smooth scroll (lo crea scroll.js); scrollToElement lo sincroniza.
export const smoothState = { current: null };

export function prefersReducedMotion() {
    return reduceQuery.matches;
}

/** Texto sin tildes y en minúsculas, para búsquedas. */
export function normalize(text) {
    return String(text || '').normalize('NFD').replace(/[̀-ͯ]/g, '').toLowerCase().trim();
}

/** Alto actual del navbar fijo + margen extra. */
export function navOffset(extra = 24) {
    const nav = document.querySelector(NAV_SELECTOR);
    return (nav ? nav.offsetHeight : 0) + extra;
}

/** Scroll suave hasta un elemento, compensando el navbar. `after` se ejecuta al terminar. */
export function scrollToElement(el, { extra, after } = {}) {
    if (!el) return;
    const top = el.getBoundingClientRect().top + window.scrollY - navOffset(extra);
    if (smoothState.current) smoothState.current.target = smoothState.current.cur = window.scrollY;
    window.scrollTo({ top, behavior: prefersReducedMotion() ? 'auto' : 'smooth' });
    if (after) setTimeout(after, prefersReducedMotion() ? 0 : 650);
}
