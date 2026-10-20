// Números que cuentan desde 0 al aparecer: [data-contador] con el valor final como texto
// (ej. "+3,000"). Conserva prefijo, sufijo y separador de miles.

const DURACION = 1800;

function partes(texto) {
    const m = texto.match(/^(\D*)(\d[\d.,]*)(.*)$/s);
    if (!m) return null;

    const [, prefijo, numero, sufijo] = m;
    const separador = (numero.match(/[.,](?=\d{3}(\D|$))/) || [''])[0];
    // Decimales ("4.5") o más números después ("24/7"): se dejan fijos, sin contar.
    if (/\d/.test(sufijo) || !/^\d+$/.test(numero.split(separador || ' ').join(''))) return null;
    const valor = parseInt(numero.replace(/\D/g, ''), 10);

    return { prefijo, sufijo, separador, valor };
}

function formatear(n, separador) {
    const s = String(n);
    return separador ? s.replace(/\B(?=(\d{3})+(?!\d))/g, separador) : s;
}

function contar(el, p) {
    const inicio = performance.now();
    const paso = (ahora) => {
        const t = Math.min(1, (ahora - inicio) / DURACION);
        const avance = 1 - Math.pow(1 - t, 3); // ease-out cúbico
        el.textContent = p.prefijo + formatear(Math.round(p.valor * avance), p.separador) + p.sufijo;
        if (t < 1) requestAnimationFrame(paso);
    };
    requestAnimationFrame(paso);
}

export function initContador() {
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

    const contadores = [...document.querySelectorAll('[data-contador]')]
        .map((el) => ({ el, p: partes(el.textContent.trim()) }))
        .filter(({ p }) => p && p.valor > 0);
    if (!contadores.length) return;

    const porElemento = new Map();
    contadores.forEach(({ el, p }) => {
        el.textContent = p.prefijo + '0' + p.sufijo;
        porElemento.set(el, p);
    });

    const observer = new IntersectionObserver(
        (entries) => {
            entries
                .filter((e) => e.isIntersecting)
                .forEach((e) => {
                    observer.unobserve(e.target);
                    contar(e.target, porElemento.get(e.target));
                });
        },
        { threshold: 0.4 }
    );

    contadores.forEach(({ el }) => observer.observe(el));
}
