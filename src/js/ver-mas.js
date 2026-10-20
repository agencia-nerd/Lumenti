// "Ver más / Ver menos" en celular para listas largas (estilos en components.css).
// En el contenedor [data-ver-mas]: data-inicial (cuántos se ven al cargar) y data-paso (cuántos suma
// cada clic; 0 = todos de una). Ítems [data-ver-mas-item]; botón [data-ver-mas-boton] con
// data-texto-mas / data-texto-menos y su texto en [data-ver-mas-texto], dentro de [data-ver-mas-wrap] (hidden).
// Con todos a la vista, "Ver menos" vuelve al inicio y sube al contenedor. Sin JS se ven todos.

const MOVIMIENTO_REDUCIDO = window.matchMedia('(prefers-reduced-motion: reduce)');

function verMas(lista) {
    const boton = lista.querySelector('[data-ver-mas-boton]');
    const items = [...lista.querySelectorAll('[data-ver-mas-item]')];
    const inicial = parseInt(lista.dataset.inicial, 10) || 6;
    const paso = parseInt(lista.dataset.paso, 10) || items.length;
    if (!boton || items.length <= inicial) return;

    const texto = boton.querySelector('[data-ver-mas-texto]');
    let visibles = inicial;

    const mostrar = (n, desde = n) => {
        visibles = Math.min(n, items.length);
        const todo = visibles >= items.length;
        items.forEach((item, i) => {
            item.toggleAttribute('data-oculta', i >= visibles);
            const entra = i >= desde && i < visibles;
            item.toggleAttribute('data-entra', entra);
            if (entra) item.style.setProperty('--entra-delay', `${(i - desde) * 60}ms`);
        });
        boton.toggleAttribute('data-todo', todo);
        boton.setAttribute('aria-expanded', String(todo));
        texto.textContent = todo ? boton.dataset.textoMenos : boton.dataset.textoMas;
    };

    boton.addEventListener('click', () => {
        if (visibles >= items.length) {
            mostrar(inicial);
            const nav = document.querySelector('[data-navbar]')?.offsetHeight ?? 0;
            const arriba = lista.getBoundingClientRect().top + window.scrollY - nav;
            window.scrollTo({ top: arriba, behavior: MOVIMIENTO_REDUCIDO.matches ? 'auto' : 'smooth' });
            return;
        }
        const antes = visibles;
        mostrar(visibles + paso, antes);
        // El foco pasa al primer ítem nuevo, para seguir leyendo desde ahí con teclado.
        items[antes]?.querySelector('a, button, [tabindex]')?.focus({ preventScroll: true });
    });

    mostrar(inicial);
    boton.closest('[data-ver-mas-wrap]').hidden = false;
}

export function initVerMas() {
    document.querySelectorAll('[data-ver-mas]').forEach(verMas);
}
