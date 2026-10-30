// Card de especialista: "+N" de "Qué atiende". En desktop el popover es CSS (hover/foco);
// en táctil o bajo 768 px un tap expande la lista (.is-expanded) y el botón pasa a "Ver menos".
import { labelNode } from './ver-mas.js';

export function cardEspecialista() {
    const btns = document.querySelectorAll('[data-lm-chips-more]');
    if (!btns.length) return;
    const touch = !window.matchMedia('(hover: hover) and (pointer: fine)').matches;
    btns.forEach((btn) => {
        const list = btn.closest('[data-lm-chips], .lm-card-especialista__chips');
        if (!list) return;
        const label = labelNode(btn);
        const more = label ? label.nodeValue : '';
        // En desktop el clic no deja el foco pegado (el popover se cierra al salir el cursor).
        btn.addEventListener('mousedown', (e) => { if (!touch) e.preventDefault(); });
        btn.addEventListener('click', () => {
            if (!touch && window.innerWidth >= 768) return;
            const on = !list.classList.contains('is-expanded');
            list.classList.toggle('is-expanded', on);
            btn.setAttribute('aria-expanded', on ? 'true' : 'false');
            if (label) label.nodeValue = on ? 'Ver menos' : more;
        });
    });
}
