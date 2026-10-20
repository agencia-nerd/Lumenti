// "Psicología para el día a día" (portada): al pasar el mouse o enfocar un tema, su foto se descubre
// sobre la anterior. Los temas sin foto dejan la que está. Estilos en psicologia.css.

export function initPsicologia() {
    const seccion = document.querySelector('[data-psico]');
    const marco = seccion?.querySelector('[data-psico-fotos]');
    if (!marco) return;

    const fotos = new Map([...marco.querySelectorAll('[data-psico-foto]')].map((f) => [f.dataset.psicoFoto, f]));
    let activa = marco.querySelector('[data-estado="activo"]');

    const mostrar = (i) => {
        const nueva = fotos.get(i);
        if (!nueva || nueva === activa) return;

        fotos.forEach((f) => {
            if (f !== activa) f.removeAttribute('data-estado');
            f.removeAttribute('data-entra');
        });
        activa?.setAttribute('data-estado', 'previa');
        nueva.setAttribute('data-estado', 'activo');
        nueva.setAttribute('data-entra', '');
        activa = nueva;
    };

    seccion.querySelectorAll('[data-psico-tema]').forEach((tema) => {
        const i = tema.dataset.psicoTema;
        tema.addEventListener('mouseenter', () => mostrar(i));
        tema.addEventListener('focus', () => mostrar(i));
    });

    // El acercamiento lento empieza después de cargar, para que la primera foto no salte.
    setTimeout(() => marco.setAttribute('data-zoom', ''), 300);
}
