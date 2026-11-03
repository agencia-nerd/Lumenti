// Card de especialista: "+N" de "Qué atiende".
// - Desktop (mouse, desde 768 px, fuera de carruseles): popover. Se ve con hover o foco (CSS) y el clic lo deja
//   abierto o lo cierra (.is-open + aria-expanded). Escape lo cierra aunque el cursor o el foco sigan encima
//   (WCAG 1.4.13); un clic fuera también.
// - Táctil, bajo 768 px o en carruseles: el clic despliega la lista dentro de la card (.is-expanded) y el botón
//   pasa a "Ver menos" (el popover quedaría recortado por la pista del carrusel).
// La lista completa está enlazada al botón con aria-describedby (especialista-card.php).
import { labelNode } from './ver-mas.js';

const OPEN = 'is-open';
const DISMISSED = 'is-dismissed';
let globalsBound = false;

const items = () => document.querySelectorAll('.lm-card-especialista__more-item');

function setOpen(item, on) {
    item.classList.toggle(OPEN, on);
    item.querySelector('[data-lm-chips-more]')?.setAttribute('aria-expanded', on ? 'true' : 'false');
}

// Escape y clic fuera: una sola vez para todas las cards (wp-query vuelve a llamar a cardEspecialista).
function bindGlobals() {
    if (globalsBound) return;
    globalsBound = true;
    document.addEventListener('keydown', (e) => {
        if (e.key !== 'Escape') return;
        items().forEach((item) => {
            if (item.classList.contains(OPEN)) setOpen(item, false);
            // Oculta también el popover que se ve por hover o foco, hasta que el cursor o el foco salgan.
            if (item.matches(':hover') || item.contains(document.activeElement)) item.classList.add(DISMISSED);
        });
    });
    document.addEventListener('click', (e) => {
        items().forEach((item) => {
            if (item.classList.contains(OPEN) && !item.contains(e.target)) setOpen(item, false);
        });
    });
}

export function cardEspecialista() {
    const btns = document.querySelectorAll('[data-lm-chips-more]');
    if (!btns.length) return;
    bindGlobals();
    const touch = !window.matchMedia('(hover: hover) and (pointer: fine)').matches;
    btns.forEach((btn) => {
        // Se vuelve a llamar cuando wp-query cambia las cards: solo se preparan las nuevas.
        if (btn.dataset.lmBound) return;
        btn.dataset.lmBound = '1';
        const list = btn.closest('[data-lm-chips], .lm-card-especialista__chips');
        const item = btn.closest('.lm-card-especialista__more-item');
        if (!list) return;
        const label = labelNode(btn);
        const more = label ? label.nodeValue : '';
        const inCarousel = !!btn.closest('.lm-specialists-carousel__track');
        const popover = () => !touch && !inCarousel && window.innerWidth >= 768;
        // Con mouse el clic no deja el foco pegado: el popover se controla con el clic, no con el foco.
        btn.addEventListener('mousedown', (e) => { if (popover()) e.preventDefault(); });
        btn.addEventListener('click', () => {
            if (popover()) {
                if (!item) return;
                item.classList.remove(DISMISSED);
                setOpen(item, !item.classList.contains(OPEN));
                return;
            }
            const on = !list.classList.contains('is-expanded');
            list.classList.toggle('is-expanded', on);
            btn.setAttribute('aria-expanded', on ? 'true' : 'false');
            if (label) label.nodeValue = on ? 'Ver menos' : more;
        });
        if (item) {
            item.addEventListener('mouseleave', () => item.classList.remove(DISMISSED));
            btn.addEventListener('blur', () => item.classList.remove(DISMISSED));
        }
    });
}
