// Navbar: mega menús de escritorio, menú móvil y botón flotante de WhatsApp.
// El estado abierto se marca con data-open (los estilos están en components.css).

const ESCRITORIO = window.matchMedia('(min-width: 75rem)');

function abrir(el, abierto) {
    el.toggleAttribute('data-open', abierto);
    el.inert = !abierto;
}

function megaMenus(navbar) {
    const nav = navbar.querySelector('nav');
    const backdrop = navbar.querySelector('[data-nav-backdrop]');
    const triggers = [...navbar.querySelectorAll('[data-mega-trigger]')];
    if (!nav || !triggers.length) return;

    const panelDe = (trigger) => document.getElementById(trigger.getAttribute('aria-controls'));
    let actual = null;
    let scrollAlAbrir = 0;
    let timer = 0;

    const programar = (fn, ms) => {
        clearTimeout(timer);
        timer = setTimeout(fn, ms);
    };

    function mostrar(trigger) {
        clearTimeout(timer);
        if (actual === trigger) return;
        if (actual) ocultarPanel(actual);
        actual = trigger;
        trigger.setAttribute('aria-expanded', 'true');
        abrir(panelDe(trigger), true);
        backdrop?.toggleAttribute('data-open', true);
        scrollAlAbrir = window.scrollY;
    }

    function ocultarPanel(trigger) {
        trigger.setAttribute('aria-expanded', 'false');
        abrir(panelDe(trigger), false);
    }

    function cerrar({ foco = false } = {}) {
        clearTimeout(timer);
        if (!actual) return;
        const trigger = actual;
        ocultarPanel(trigger);
        actual = null;
        backdrop?.toggleAttribute('data-open', false);
        if (foco) trigger.focus();
    }

    // Hover con intención: abrir tras 90 ms (o al instante si ya hay otro abierto).
    triggers.forEach((trigger) => {
        const li = trigger.closest('[data-mega-li]');
        li?.addEventListener('mouseenter', () => {
            if (actual) mostrar(trigger);
            else programar(() => mostrar(trigger), 90);
        });
        trigger.addEventListener('click', () => (actual === trigger ? cerrar() : mostrar(trigger)));
    });

    // Pasar por un ítem sin mega menú cierra el abierto.
    navbar.querySelectorAll('[data-mega-plain]').forEach((el) => {
        el.addEventListener('mouseenter', () => (actual ? programar(cerrar, 120) : clearTimeout(timer)));
    });

    navbar.querySelectorAll('[data-mega-panel]').forEach((panel) => {
        panel.addEventListener('mouseenter', () => clearTimeout(timer));
    });

    nav.addEventListener('mouseleave', () => programar(cerrar, 220));
    nav.addEventListener('mouseenter', () => actual && clearTimeout(timer));

    nav.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && actual) cerrar({ foco: true });
    });

    // Foco fuera del nav (Tab) cierra el panel.
    nav.addEventListener('focusout', (e) => {
        if (actual && !nav.contains(e.relatedTarget)) cerrar();
    });

    backdrop?.addEventListener('click', () => cerrar());

    window.addEventListener(
        'scroll',
        () => {
            if (actual && Math.abs(window.scrollY - scrollAlAbrir) > 120) cerrar();
        },
        { passive: true }
    );

    ESCRITORIO.addEventListener('change', () => cerrar());
}

function menuMovil(navbar) {
    const toggle = navbar.querySelector('[data-menu-toggle]');
    const panel = navbar.querySelector('[data-menu-panel]');
    if (!toggle || !panel) return;

    const fab = document.querySelector('[data-fab]');
    const acordeones = [...panel.querySelectorAll('[data-acordeon-trigger]')];

    function set(abierto) {
        toggle.setAttribute('aria-expanded', String(abierto));
        toggle.setAttribute('aria-label', abierto ? toggle.dataset.labelCerrar : toggle.dataset.labelAbrir);
        panel.hidden = !abierto;
        document.documentElement.style.overflow = abierto ? 'hidden' : '';
        fab?.toggleAttribute('data-oculto', abierto);
    }

    toggle.addEventListener('click', () => set(toggle.getAttribute('aria-expanded') !== 'true'));

    panel.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            set(false);
            toggle.focus();
        }
    });

    // Acordeones: uno abierto a la vez.
    acordeones.forEach((trigger) => {
        trigger.addEventListener('click', () => {
            const abrirEste = trigger.getAttribute('aria-expanded') !== 'true';
            acordeones.forEach((t) => {
                const abierto = t === trigger && abrirEste;
                t.setAttribute('aria-expanded', String(abierto));
                abrir(document.getElementById(t.getAttribute('aria-controls')), abierto);
            });
        });
    });

    ESCRITORIO.addEventListener('change', (e) => e.matches && set(false));
}

// El botón flotante se esconde mientras se escribe en un campo (no tapa el teclado).
function fabWhatsapp() {
    const fab = document.querySelector('[data-fab]');
    if (!fab) return;

    const esCampo = (el) => el instanceof HTMLElement && el.matches('input, select, textarea, [contenteditable]');
    document.addEventListener('focusin', (e) => esCampo(e.target) && fab.toggleAttribute('data-oculto', true));
    document.addEventListener('focusout', (e) => esCampo(e.target) && fab.toggleAttribute('data-oculto', false));
}

export function initHeader() {
    const navbar = document.querySelector('[data-navbar]');
    if (navbar) {
        megaMenus(navbar);
        menuMovil(navbar);
    }
    fabWhatsapp();
}
