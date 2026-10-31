// "Ver más": el botón [data-lm-more-btn] (aria-controls → lista [data-lm-more]) muestra u oculta el resto de ítems.
// La lista recibe .is-expanded; el texto del botón alterna con data-lm-more-less (por defecto "Ver menos").
// Al plegar, la página vuelve al inicio de la sección del botón.
import { scrollToElement } from './utils.js';

/** Primer nodo de texto con contenido del botón (el ícono va después). */
export function labelNode(btn) {
    return [...btn.childNodes].find((n) => n.nodeType === Node.TEXT_NODE && n.nodeValue.trim()) || null;
}

export function verMas() {
    const btns = document.querySelectorAll('[data-lm-more-btn][aria-controls]');
    if (!btns.length) return;
    btns.forEach((btn) => {
        const list = document.getElementById(btn.getAttribute('aria-controls'));
        if (!list) return;
        const label = labelNode(btn);
        const more = label ? label.nodeValue : '';
        const less = btn.dataset.lmMoreLess || 'Ver menos';
        btn.addEventListener('click', () => {
            const on = btn.getAttribute('aria-expanded') !== 'true';
            btn.setAttribute('aria-expanded', on ? 'true' : 'false');
            list.classList.toggle('is-expanded', on);
            if (label) label.nodeValue = on ? less : more;
            if (!on) scrollToElement(btn.closest('section'), { extra: 0 });
        });
    });
}
