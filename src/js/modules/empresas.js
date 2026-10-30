// Empresas: enlaces internos con preselección en el formulario y pasos de "Cómo trabajamos".
// Botones: data-lm-goto="formulario|soluciones|talleres" → [data-lm-target="<mismo valor>"];
// al formulario pueden sumar data-lm-preselect="prevencion|atencion|taller" y data-lm-prefill="Nombre del taller".
// El envío y la validación del formulario son de wp-form.
import { scrollToElement } from './utils.js';

export function empresasLinks() {
    const links = document.querySelectorAll('[data-lm-goto]');
    if (!links.length) return;
    // El form de propuesta: [data-lm-proposal-form] o el primer <form> dentro del destino "formulario".
    const formOf = () => document.querySelector('[data-lm-proposal-form]')
        || document.querySelector('[data-lm-target="formulario"] form, form[data-lm-target="formulario"]');
    links.forEach((b) => {
        b.addEventListener('click', (e) => {
            const target = document.querySelector(`[data-lm-target="${CSS.escape(b.dataset.lmGoto)}"]`);
            if (!target) return;
            e.preventDefault();
            const form = formOf();
            const pre = b.dataset.lmPreselect;
            const fill = b.dataset.lmPrefill;
            if (form && pre) {
                const cb = form.querySelector(`input[name="busca[]"][value="${CSS.escape(pre)}"]`);
                if (cb) {
                    cb.checked = true;
                    cb.dispatchEvent(new Event('change', { bubbles: true }));
                }
            }
            if (form && fill) {
                const ta = form.querySelector('[name="mensaje"]');
                if (ta && !ta.value.includes(fill)) ta.value = `Nos interesa el taller "${fill}".${ta.value ? `\n${ta.value}` : ''}`;
            }
            scrollToElement(target, {
                after: () => {
                    const isForm = target.matches('form, [data-lm-target="formulario"]');
                    const first = isForm && target.querySelector('input:not([type="hidden"]):not([tabindex="-1"])');
                    if (first) first.focus({ preventScroll: true });
                },
            });
        });
    });
}

// Pasos: la sección mide 340vh y su contenido es sticky; el paso activo depende del scroll (desktop/tablet).
// Bajo 768 px todos los pasos quedan visibles.
export function empresasSteps() {
    const root = document.querySelector('[data-lm-steps]');
    if (!root) return;
    const items = root.querySelectorAll('[data-lm-step]');
    const nums = root.querySelectorAll('[data-lm-step-num]');
    if (!items.length) return;
    const mq = window.matchMedia('(max-width: 767px)');
    let cur = -1;
    const set = (i) => {
        if (i === cur) return;
        cur = i;
        items.forEach((el, k) => {
            el.classList.toggle('is-active', k === i);
            el.setAttribute('aria-hidden', k === i || mq.matches ? 'false' : 'true');
        });
        nums.forEach((el, k) => el.classList.toggle('is-active', k === i));
    };
    const onScroll = () => {
        if (mq.matches) {
            items.forEach((el) => el.setAttribute('aria-hidden', 'false'));
            return;
        }
        const r = root.getBoundingClientRect();
        const total = root.offsetHeight - window.innerHeight;
        const p = total > 0 ? Math.min(0.999, Math.max(0, -r.top / total)) : 0;
        set(Math.floor(p * items.length));
    };
    window.addEventListener('scroll', onScroll, { passive: true });
    window.addEventListener('resize', () => {
        cur = -1;
        onScroll();
    });
    set(0);
    onScroll();
}
