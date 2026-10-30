// Header: mega menús (hover + teclado), menú móvil, tono oscuro sobre secciones y botón flotante de WhatsApp.
export function navbar() {
    const header = document.querySelector('[data-lm-navbar]');
    if (!header) return;
    const fine = window.matchMedia('(hover: hover) and (pointer: fine)');
    const triggers = header.querySelectorAll('[data-lm-mm-trigger]');
    const burger = header.querySelector('[data-lm-burger]');
    const menu = burger && document.getElementById(burger.getAttribute('aria-controls'));
    let openId = null;
    let openT = 0;
    let closeT = 0;

    const panelOf = (btn) => document.getElementById(btn.getAttribute('aria-controls'));
    const setTab = (panel, on) => panel.querySelectorAll('a, button').forEach((el) => { el.tabIndex = on ? 0 : -1; });

    function openMM(id) {
        clearTimeout(closeT);
        triggers.forEach((b) => {
            const on = b.getAttribute('aria-controls') === id;
            const p = panelOf(b);
            if (!p) return;
            b.setAttribute('aria-expanded', on ? 'true' : 'false');
            p.classList.toggle('is-open', on);
            setTab(p, on);
        });
        openId = id;
        header.classList.toggle('is-mm-open', !!id);
    }
    const closeMM = () => { clearTimeout(openT); openMM(null); };
    const closeSoon = () => { clearTimeout(openT); clearTimeout(closeT); closeT = setTimeout(closeMM, 160); };

    function toggleMenu(on) {
        if (!burger || !menu) return;
        burger.setAttribute('aria-expanded', on ? 'true' : 'false');
        burger.setAttribute('aria-label', on ? 'Cerrar menú' : 'Abrir menú');
        menu.hidden = !on;
        document.documentElement.classList.toggle('lm-menu-open', on);
    }

    triggers.forEach((b) => {
        const id = b.getAttribute('aria-controls');
        const p = panelOf(b);
        if (p) setTab(p, false);
        b.addEventListener('click', () => openMM(openId === id ? null : id));
        b.addEventListener('mouseenter', () => {
            if (!fine.matches) return;
            clearTimeout(openT);
            clearTimeout(closeT);
            openT = setTimeout(() => openMM(id), 90);
        });
        if (p) p.addEventListener('mouseenter', () => clearTimeout(closeT));
    });
    header.querySelectorAll('[data-lm-mm-plain]').forEach((el) => el.addEventListener('mouseenter', () => { if (openId) closeSoon(); }));
    header.querySelector('.lm-nav')?.addEventListener('mouseleave', () => { if (fine.matches) closeSoon(); });
    header.querySelector('.lm-header__backdrop')?.addEventListener('click', closeMM);

    document.addEventListener('keydown', (e) => {
        if (e.key !== 'Escape') return;
        if (openId) {
            const t = header.querySelector(`[aria-controls="${openId}"]`);
            closeMM();
            t?.focus();
        }
        if (burger?.getAttribute('aria-expanded') === 'true') {
            toggleMenu(false);
            burger.focus();
        }
    });
    header.addEventListener('focusout', () => {
        setTimeout(() => { if (openId && !header.contains(document.activeElement)) closeMM(); }, 0);
    });

    burger?.addEventListener('click', () => toggleMenu(burger.getAttribute('aria-expanded') !== 'true'));

    // Con el menú móvil abierto, Tab recorre solo el botón de cerrar y los enlaces del menú.
    document.addEventListener('keydown', (e) => {
        if (e.key !== 'Tab' || !menu || menu.hidden) return;
        const focusables = [burger, ...menu.querySelectorAll('a[href], button:not([disabled])')]
            .filter((el) => el.offsetParent !== null || el === burger);
        const first = focusables[0];
        const last = focusables[focusables.length - 1];
        if (e.shiftKey && document.activeElement === first) {
            e.preventDefault();
            last.focus();
        } else if (!e.shiftKey && document.activeElement === last) {
            e.preventDefault();
            first.focus();
        } else if (!focusables.includes(document.activeElement)) {
            e.preventDefault();
            first.focus();
        }
    });
    header.querySelectorAll('[data-lm-sub-toggle]').forEach((t) => {
        t.addEventListener('click', () => {
            const on = t.getAttribute('aria-expanded') !== 'true';
            t.setAttribute('aria-expanded', on ? 'true' : 'false');
            document.getElementById(t.getAttribute('aria-controls'))?.classList.toggle('is-open', on);
        });
    });
    window.addEventListener('resize', () => {
        if (window.innerWidth >= 1200) toggleMenu(false);
        else if (openId) closeMM();
    });

    // Tono oscuro sobre secciones [data-lm-nav-tone="dark"].
    const darkSecs = document.querySelectorAll('[data-lm-nav-tone="dark"]');
    const tone = () => {
        const y = header.getBoundingClientRect().bottom - 1;
        const dark = [...darkSecs].some((s) => {
            const r = s.getBoundingClientRect();
            return r.top <= y && r.bottom > y;
        });
        header.classList.toggle('lm-header--dark', dark);
    };
    if (darkSecs.length) {
        window.addEventListener('scroll', tone, { passive: true });
        tone();
    }

    // FAB: se oculta mientras se escribe en un formulario. Su número lo imprime header.php según la página.
    const fab = document.querySelector('[data-lm-fab]');
    if (fab) {
        const isField = (el) => el?.matches?.('input, select, textarea');
        document.addEventListener('focusin', (e) => { if (isField(e.target)) fab.classList.add('is-hidden'); });
        document.addEventListener('focusout', () => {
            setTimeout(() => { if (!isField(document.activeElement)) fab.classList.remove('is-hidden'); }, 50);
        });
    }
}
