// Hero de la portada: carrusel con pestañas (ARIA tabs), avance automático y pausa.
// El avance lo marca la barra de progreso: al terminar su animación pasa a la siguiente.

const MOVIMIENTO_REDUCIDO = window.matchMedia('(prefers-reduced-motion: reduce)');

// Reparte las palabras del sello en partes iguales del círculo (r = 59).
// Si no entran (muchas palabras o muy largas), achica la letra hasta que quepan con aire.
function ajustarAnillo(svg) {
    const paths = [...svg.querySelectorAll('textPath')];
    if (!paths.length) return;

    const circulo = 2 * Math.PI * 59;
    const texto = svg.querySelector('text');
    const medir = () => paths.map((p) => p.getComputedTextLength());
    let largos = medir();
    const total = largos.reduce((a, b) => a + b, 0);
    const maximo = circulo * 0.8; // deja al menos 20 % del círculo como separación
    if (total > maximo) {
        texto.setAttribute('font-size', ((14 * maximo) / total).toFixed(2));
        largos = medir();
    }

    const espacio = (circulo - largos.reduce((a, b) => a + b, 0)) / paths.length;
    let pos = espacio / 2;
    paths.forEach((p, i) => {
        p.setAttribute('startOffset', pos.toFixed(1));
        pos += largos[i] + espacio;
    });
}

function carrusel(hero) {
    const tabs = [...hero.querySelectorAll('[data-hero-tab]')];
    if (tabs.length < 2) return;

    const paneles = [...hero.querySelectorAll('[data-hero-panel]')];
    const numeros = [...hero.querySelectorAll('[data-hero-numero]')];
    const fotos = [...hero.querySelectorAll('[data-hero-foto]')];
    const textos = hero.querySelector('[data-hero-textos]');
    const pausa = hero.querySelector('[data-hero-pausa]');
    const relleno = (i) => tabs[i].querySelector('[data-hero-fill]');

    let actual = 0;
    let pausadoPorUsuario = false;
    let encima = false;
    let conFoco = false;
    let pendiente = false; // la barra terminó mientras estaba en pausa: avanza al reanudar

    function aplicarPausa() {
        const pausado = MOVIMIENTO_REDUCIDO.matches || pausadoPorUsuario || encima || conFoco || document.hidden;
        hero.toggleAttribute('data-pausado', pausado);
        if (!pausado && pendiente) {
            pendiente = false;
            ir((actual + 1) % tabs.length);
        }
    }

    function reiniciarProgreso(i) {
        pendiente = false;
        tabs.forEach((_, j) => relleno(j).classList.remove('animate-llenar'));
        void relleno(i).offsetWidth; // fuerza el reinicio de la animación
        relleno(i).classList.add('animate-llenar');
    }

    function ir(i, enfocar = false) {
        if (i === actual) {
            reiniciarProgreso(i);
            return;
        }

        const anterior = actual;
        actual = i;
        const fase = (j) => (j === i ? 'in' : j === anterior ? 'out' : 'oculta');

        paneles.forEach((el, j) => (el.dataset.fase = fase(j)));
        numeros.forEach((el, j) => (el.dataset.fase = fase(j)));
        fotos.forEach((el, j) => {
            el.dataset.fase = fase(j);
            if (j === i) el.dataset.ken = el.dataset.ken === '1' ? '0' : '1';
        });
        paneles.forEach((el, j) => {
            el.inert = j !== i;
            if (j === i) el.removeAttribute('aria-hidden');
            else el.setAttribute('aria-hidden', 'true');
        });
        tabs.forEach((tab, j) => {
            tab.setAttribute('aria-selected', String(j === i));
            tab.tabIndex = j === i ? 0 : -1;
        });

        if (enfocar) tabs[i].focus();
        reiniciarProgreso(i);
    }

    tabs.forEach((tab, j) => {
        tab.addEventListener('click', () => ir(j));
        tab.addEventListener('keydown', (e) => {
            const destino = {
                ArrowRight: (j + 1) % tabs.length,
                ArrowLeft: (j - 1 + tabs.length) % tabs.length,
                Home: 0,
                End: tabs.length - 1,
            }[e.key];
            if (destino === undefined) return;
            e.preventDefault();
            ir(destino, true);
        });
    });

    hero.addEventListener('animationend', (e) => {
        if (e.target !== relleno(actual) || e.animationName !== 'llenar') return;
        if (hero.hasAttribute('data-pausado')) pendiente = true;
        else ir((actual + 1) % tabs.length);
    });

    // Pausa mientras el mouse o el foco están sobre el contenido (no sobre pestañas ni botón de pausa).
    textos?.addEventListener('mouseenter', () => {
        encima = true;
        aplicarPausa();
    });
    textos?.addEventListener('mouseleave', () => {
        encima = false;
        aplicarPausa();
    });
    textos?.addEventListener('focusin', () => {
        conFoco = true;
        aplicarPausa();
    });
    textos?.addEventListener('focusout', (e) => {
        conFoco = textos.contains(e.relatedTarget);
        aplicarPausa();
    });
    document.addEventListener('visibilitychange', aplicarPausa);

    // Con movimiento reducido no hay avance automático ni botón de pausa.
    if (pausa) {
        pausa.hidden = MOVIMIENTO_REDUCIDO.matches;
        pausa.addEventListener('click', () => {
            pausadoPorUsuario = !pausadoPorUsuario;
            pausa.setAttribute('aria-label', pausadoPorUsuario ? pausa.dataset.labelReanudar : pausa.dataset.labelPausar);
            pausa.querySelector('[data-icono="pausa"]').hidden = pausadoPorUsuario;
            pausa.querySelector('[data-icono="play"]').hidden = !pausadoPorUsuario;
            aplicarPausa();
        });
    }

    aplicarPausa();
}

export function initHero() {
    const hero = document.querySelector('[data-hero]');
    if (!hero) return;

    carrusel(hero);

    const anillo = hero.querySelector('[data-hero-anillo]');
    if (anillo) document.fonts.ready.then(() => ajustarAnillo(anillo));
}
