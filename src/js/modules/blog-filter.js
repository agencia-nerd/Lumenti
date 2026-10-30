// Blog: filtro por categoría (pills), buscador y paginación de 6 en el navegador, sin saltos de scroll.
// Cada card lleva data-cat y data-text; el destacado se oculta cuando hay filtro o búsqueda. URL: ?categoria=<valor>.
import { normalize as norm, prefersReducedMotion } from './utils.js';

const PER = 6;

// Flecha anterior/siguiente: botón (disabled) o enlace (aria-disabled + hidden).
function setDisabled(el, on) {
    if (!el) return;
    if ('disabled' in el) el.disabled = on;
    else {
        el.toggleAttribute('aria-disabled', on);
        el.hidden = on;
    }
}

export function blogFilter() {
    const root = document.querySelector('[data-lm-blog]');
    if (!root) return;
    const pills = [...root.querySelectorAll('[data-lm-blog-cat]')];
    const items = [...root.querySelectorAll('[data-lm-blog-item]')];
    const featured = root.querySelector('[data-lm-blog-featured]');
    const search = root.querySelector('[data-lm-blog-search]');
    const count = root.querySelector('[data-lm-blog-count]');
    const empty = root.querySelector('[data-lm-blog-empty]');
    const pager = root.querySelector('[data-lm-blog-pager]');
    const pages = root.querySelector('[data-lm-blog-pages]');
    const prev = root.querySelector('[data-lm-blog-prev]');
    const next = root.querySelector('[data-lm-blog-next]');
    const grid = root.querySelector('[data-lm-blog-grid]');
    const state = { cat: new URLSearchParams(location.search).get('categoria') || '', q: '', page: 1 };

    function render(animate) {
        const nq = norm(state.q);
        const list = items.filter((li) => (!state.cat || li.dataset.cat === state.cat) && (!nq || norm(li.dataset.text).includes(nq)));
        const showFeat = !!featured && !state.cat && !nq;
        if (featured) featured.hidden = !showFeat;
        const total = Math.max(1, Math.ceil(list.length / PER));
        state.page = Math.min(state.page, total);
        const from = (state.page - 1) * PER;
        const vis = list.slice(from, from + PER);
        const anim = animate && !prefersReducedMotion();
        items.forEach((li) => {
            li.hidden = !vis.includes(li);
            li.classList.remove('is-entering');
        });
        vis.forEach((li, i) => {
            li.style.setProperty('--lm-i', i);
            if (anim) {
                void li.offsetWidth;
                li.classList.add('is-entering');
            }
        });
        const shown = vis.length + (showFeat ? 1 : 0);
        const all = items.length + (featured ? 1 : 0);
        if (count) count.textContent = `Mostrando ${shown} de ${state.cat || nq ? list.length : all} entradas`;
        if (empty) empty.hidden = list.length > 0;
        pills.forEach((b) => b.setAttribute('aria-pressed', b.dataset.lmBlogCat === state.cat ? 'true' : 'false'));
        if (pager) {
            pager.hidden = total < 2;
            if (pages) {
                const btns = [];
                for (let n = 1; n <= total; n++) {
                    const b = document.createElement('button');
                    b.type = 'button';
                    b.className = 'lm-blog__page';
                    b.textContent = String(n);
                    b.setAttribute('aria-label', `Página ${n}`);
                    if (n === state.page) b.setAttribute('aria-current', 'page');
                    b.addEventListener('click', () => go(n));
                    btns.push(b);
                }
                pages.replaceChildren(...btns);
            }
            setDisabled(prev, state.page <= 1);
            setDisabled(next, state.page >= total);
        }
    }
    // Cambiar de página mantiene la posición del usuario relativa a la grilla (no salta).
    function go(n) {
        const before = grid ? grid.getBoundingClientRect().top : 0;
        state.page = n;
        render(true);
        if (!grid) return;
        const after = grid.getBoundingClientRect().top;
        if (after !== before) window.scrollBy(0, after - before);
    }

    pills.forEach((b) => b.addEventListener('click', (e) => {
        e.preventDefault();
        state.cat = b.dataset.lmBlogCat;
        state.page = 1;
        render(true);
    }));
    let t = 0;
    search?.addEventListener('input', () => {
        clearTimeout(t);
        t = setTimeout(() => {
            state.q = search.value;
            state.page = 1;
            render(true);
        }, 180);
    });
    // Si los filtros van en un <form>, Enter filtra sin recargar.
    search?.form?.addEventListener('submit', (e) => {
        e.preventDefault();
        clearTimeout(t);
        state.q = search.value;
        state.page = 1;
        render(true);
    });
    prev?.addEventListener('click', (e) => {
        e.preventDefault();
        go(state.page - 1);
    });
    next?.addEventListener('click', (e) => {
        e.preventDefault();
        go(state.page + 1);
    });
    render(false);
}
