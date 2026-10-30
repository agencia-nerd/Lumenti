// Páginas legales: índice lateral con anclas compensadas por el navbar y sección activa al hacer scroll.
import { navOffset, scrollToElement } from './utils.js';

export function legalToc() {
    const toc = document.querySelector('[data-lm-legal-toc]');
    if (!toc) return;
    const links = [...toc.querySelectorAll('a[href^="#"]')];
    if (!links.length) return;
    const secs = links.map((a) => document.getElementById(decodeURIComponent(a.getAttribute('href').slice(1))));
    links.forEach((a, i) => {
        a.addEventListener('click', (e) => {
            const s = secs[i];
            if (!s) return;
            e.preventDefault();
            scrollToElement(s, { extra: 32 });
            try { history.replaceState(null, '', `${location.pathname}${location.search}#${s.id}`); } catch { /* sin history */ }
        });
    });
    const sync = () => {
        const y = navOffset(32) + 8;
        let cur = 0;
        secs.forEach((s, i) => { if (s && s.getBoundingClientRect().top <= y) cur = i; });
        links.forEach((a, i) => {
            if (i === cur) a.setAttribute('aria-current', 'true');
            else a.removeAttribute('aria-current');
        });
    };
    window.addEventListener('scroll', sync, { passive: true });
    sync();
}
