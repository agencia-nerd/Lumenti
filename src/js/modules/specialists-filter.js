// Listado de Especialistas: los filtros, el buscador y la URL los resuelve wp-query (src/js/modules/query.js,
// sin recargar). Aquí, después de cada actualización (evento wp-query:update): la entrada escalonada de las
// cards del diseño (is-entering, --lm-i; sin ella con prefers-reduced-motion) y el "+N" de las cards nuevas.
import { prefersReducedMotion } from './utils.js';
import { cardEspecialista } from './card-especialista.js';

export function specialistsFilter() {
    const root = document.querySelector('[data-lm-specialists]');
    if (!root) return;
    const seen = (scope) => scope.querySelectorAll('.lm-specialists__item').forEach((li) => { li.dataset.lmSeen = '1'; });
    seen(root);
    document.addEventListener('wp-query:update', () => {
        cardEspecialista();
        const nuevas = root.querySelectorAll('.lm-specialists__item:not([data-lm-seen])');
        seen(root);
        if (prefersReducedMotion()) return;
        // Solo las cards nuevas: al filtrar, todas; con "Ver más", las que se sumaron.
        nuevas.forEach((li, i) => {
            li.style.setProperty('--lm-i', Math.min(i, 8));
            li.classList.add('is-entering');
        });
    });
}
