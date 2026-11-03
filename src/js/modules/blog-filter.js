// Blog: los filtros, el buscador y la paginación los maneja wp-query (src/js/modules/query.js), que cambia las
// zonas data-query sin recargar. Aquí solo la entrada escalonada de las cards nuevas (is-entering, --lm-i)
// después de cada cambio, como en el diseño. Sin animación con prefers-reduced-motion.
import { prefersReducedMotion } from './utils.js';

export function blogFilter() {
    if (!document.querySelector('[data-lm-blog]')) return;
    document.addEventListener('wp-query:update', () => {
        if (prefersReducedMotion()) return;
        document.querySelectorAll('[data-lm-blog-grid] > .lm-blog__item').forEach((li, i) => {
            li.style.setProperty('--lm-i', i);
            li.classList.add('is-entering');
        });
    });
}
