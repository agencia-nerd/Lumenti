// Filtros de Especialistas: tipo, edad, qué atiende, idiomas y buscador (nombre, condición y sinónimos).
// URL: ?tipo=psiquiatras|psicologos&edad=<slug>&atiende=<slug>&idiomas=<slug>&q=pánico (se lee al cargar y se sincroniza).
// Contador, chips de filtros activos y estado vacío. Los datos viven en data-* de cada card;
// los sinónimos, en data-lm-sinonimos del <form> (JSON).
import { normalize as norm, prefersReducedMotion } from './utils.js';

const TIPO = { psiquiatras: 'psiquiatra', psicologos: 'psicologo' };
const TIPO_LABEL = { psiquiatras: 'Médicos psiquiatras', psicologos: 'Psicólogos' };
// Parámetro de la URL → atributo data-* de la card.
const CARD_KEY = { edad: 'poblacion', atiende: 'atiende', idiomas: 'idiomas' };
const SELECTS = Object.keys(CARD_KEY);
const EMPTY = { tipo: '', edad: '', atiende: '', idiomas: '', q: '' };
const SVG_NS = 'http://www.w3.org/2000/svg';
const X_PATH = 'M205.66,194.34a8,8,0,0,1-11.32,11.32L128,139.31,61.66,205.66a8,8,0,0,1-11.32-11.32L116.69,128,50.34,61.66A8,8,0,0,1,61.66,50.34L128,116.69l66.34-66.35a8,8,0,0,1,11.32,11.32L139.31,128Z';

function readSynonyms(form) {
    try {
        const data = JSON.parse(form?.dataset.lmSinonimos || 'null');
        if (Array.isArray(data)) return data;
        return Array.isArray(data?.grupos) ? data.grupos : [];
    } catch {
        return [];
    }
}

// Chip de filtro activo: clona <template data-lm-chip-template> si existe; si no, lo arma con el ícono ×.
function makeChip(tpl, label, onClear) {
    let btn = tpl?.content.firstElementChild?.cloneNode(true);
    if (btn) {
        const text = btn.querySelector('[data-lm-chip-label]') || btn.querySelector('span');
        if (text) text.textContent = label;
        else btn.prepend(label);
    } else {
        btn = document.createElement('button');
        btn.className = 'lm-filter-chip';
        const span = document.createElement('span');
        span.textContent = label;
        const svg = document.createElementNS(SVG_NS, 'svg');
        svg.setAttribute('aria-hidden', 'true');
        svg.setAttribute('width', '14');
        svg.setAttribute('height', '14');
        svg.setAttribute('viewBox', '0 0 256 256');
        svg.setAttribute('fill', 'currentColor');
        const path = document.createElementNS(SVG_NS, 'path');
        path.setAttribute('d', X_PATH);
        svg.append(path);
        btn.append(span, svg);
    }
    btn.type = 'button';
    btn.setAttribute('aria-label', `Quitar filtro ${label}`);
    btn.addEventListener('click', onClear);
    return btn;
}

export function specialistsFilter() {
    const root = document.querySelector('[data-lm-specialists]');
    if (!root) return;
    const cards = [...root.querySelectorAll('[data-lm-specialist]')];
    // Tipo: radios name="tipo" (tema) o botones [data-lm-filter-tipo] (diseño).
    const radios = [...root.querySelectorAll('input[type="radio"][name="tipo"]')];
    const tabs = [...root.querySelectorAll('[data-lm-filter-tipo]')];
    const sel = Object.fromEntries(SELECTS.map((k) => [k, root.querySelector(`[data-lm-filter="${k}"]`)]));
    const search = root.querySelector('[data-lm-filter="q"]');
    const form = root.querySelector('form[data-lm-sinonimos]') || search?.form || root.querySelector('form');
    const count = root.querySelector('[data-lm-count-results]');
    const chips = root.querySelector('[data-lm-active-filters]');
    const chipsWrap = root.querySelector('[data-lm-active-wrap]');
    const chipTpl = root.querySelector('template[data-lm-chip-template]');
    const empty = root.querySelector('[data-lm-empty]');
    const syn = readSynonyms(form);

    // Textos de las opciones de cada select (para los chips y la búsqueda por condición).
    const names = {};
    SELECTS.forEach((k) => {
        names[k] = {};
        if (sel[k]) [...sel[k].options].forEach((o) => { if (o.value) names[k][o.value] = o.textContent.trim(); });
    });
    const tipoLabel = (v) => {
        const r = radios.find((x) => x.value === v);
        const t = tabs.find((x) => x.dataset.lmFilterTipo === v);
        return (r?.labels?.[0] || t)?.textContent.trim() || TIPO_LABEL[v] || v;
    };

    const state = { ...EMPTY };
    const p = new URLSearchParams(location.search);
    if (TIPO[p.get('tipo')]) state.tipo = p.get('tipo');
    ['edad', 'atiende', 'idiomas', 'q'].forEach((k) => { if (p.get(k)) state[k] = p.get(k); });
    // ?atiende= puede traer el slug de la condición en vez del valor de la opción (option[data-slug]).
    if (state.atiende && !names.atiende[state.atiende] && sel.atiende) {
        const o = [...sel.atiende.options].find((x) => x.dataset.slug === state.atiende);
        if (o) state.atiende = o.value;
    }

    const list = (s) => (s || '').split('|');
    const synKeys = (q) => {
        const nq = norm(q);
        let keys = [];
        if (nq.length < 3) return keys;
        syn.forEach((g) => {
            const hit = norm(g.grupo).includes(nq) || (g.palabras || []).some((w) => {
                const nw = norm(w);
                return nw.includes(nq) || nq.includes(nw);
            });
            if (hit) keys = keys.concat(g.claves_que_trata || []);
        });
        Object.entries(names.atiende).forEach(([k, label]) => { if (norm(label).includes(nq)) keys.push(k); });
        return keys;
    };
    const matches = (c, keys) => {
        const d = c.dataset;
        if (state.tipo && d.tipo !== TIPO[state.tipo]) return false;
        if (SELECTS.some((k) => state[k] && !list(d[CARD_KEY[k]]).includes(state[k]))) return false;
        if (state.q) {
            const byName = norm(d.nombre).includes(norm(state.q));
            const byCond = keys.some((k) => list(d.atiende).includes(k));
            if (!byName && !byCond) return false;
        }
        return true;
    };
    const writeUrl = () => {
        const u = new URLSearchParams();
        Object.keys(state).forEach((k) => { if (state[k]) u.set(k, state[k]); });
        const qs = u.toString();
        try { history.replaceState(null, '', location.pathname + (qs ? `?${qs}` : '') + location.hash); } catch { /* sin history */ }
    };

    function apply(animate) {
        tabs.forEach((t) => t.setAttribute('aria-selected', t.dataset.lmFilterTipo === state.tipo ? 'true' : 'false'));
        radios.forEach((r) => { r.checked = r.value === state.tipo; });
        SELECTS.forEach((k) => {
            if (!sel[k]) return;
            sel[k].value = state[k];
            sel[k].classList.toggle('is-filled', !!state[k]);
        });
        if (search && search.value !== state.q) search.value = state.q;
        const keys = synKeys(state.q);
        const anim = animate && !prefersReducedMotion();
        let n = 0;
        cards.forEach((c) => {
            const li = c.closest('li') || c;
            const ok = matches(c, keys);
            li.hidden = !ok;
            if (!ok) return;
            li.style.setProperty('--lm-i', Math.min(n, 8));
            li.classList.remove('is-entering');
            if (anim) {
                void li.offsetWidth;
                li.classList.add('is-entering');
            }
            n++;
        });
        if (count) count.textContent = n === 1 ? '1 especialista' : `${n} especialistas`;
        if (empty) empty.hidden = n > 0;
        if (chips) {
            const out = [];
            if (state.tipo) out.push(makeChip(chipTpl, tipoLabel(state.tipo), () => set({ tipo: '' })));
            if (state.q) out.push(makeChip(chipTpl, `“${state.q}”`, () => set({ q: '' })));
            SELECTS.forEach((k) => {
                if (state[k]) out.push(makeChip(chipTpl, names[k][state[k]] || state[k], () => set({ [k]: '' })));
            });
            chips.replaceChildren(...out);
            if (chipsWrap) chipsWrap.hidden = !out.length;
        }
        writeUrl();
    }
    function set(patch) {
        Object.assign(state, patch);
        apply(true);
    }

    tabs.forEach((t, i) => {
        t.addEventListener('click', () => set({ tipo: t.dataset.lmFilterTipo }));
        t.addEventListener('keydown', (e) => {
            if (e.key !== 'ArrowRight' && e.key !== 'ArrowLeft') return;
            e.preventDefault();
            const next = tabs[(i + (e.key === 'ArrowRight' ? 1 : -1) + tabs.length) % tabs.length];
            next.focus();
            next.click();
        });
    });
    // Los radios ya se recorren con las flechas (nativo) y disparan change.
    radios.forEach((r) => r.addEventListener('change', () => { if (r.checked) set({ tipo: r.value }); }));
    SELECTS.forEach((k) => sel[k]?.addEventListener('change', () => set({ [k]: sel[k].value })));
    let qt = 0;
    search?.addEventListener('input', () => {
        clearTimeout(qt);
        qt = setTimeout(() => set({ q: search.value.trim() }), 180);
    });
    // Con JS el form no recarga: "Aplicar" y Enter filtran en el momento.
    form?.addEventListener('submit', (e) => {
        e.preventDefault();
        clearTimeout(qt);
        if (search) set({ q: search.value.trim() });
    });
    root.querySelectorAll('[data-lm-clear-filters]').forEach((b) => b.addEventListener('click', (e) => {
        e.preventDefault();
        set({ ...EMPTY });
    }));
    apply(false);
}
