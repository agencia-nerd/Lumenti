// Entrada al hacer scroll para [data-reveal] (estilos en components.css).
// Solo esconde lo que al cargar está fuera de pantalla; lo visible no se anima.

export function initReveal() {
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

    const limite = window.innerHeight * 0.9;
    const pendientes = [...document.querySelectorAll('[data-reveal]')].filter(
        (el) => el.getBoundingClientRect().top >= limite
    );
    if (!pendientes.length) return;

    pendientes.forEach((el) => el.setAttribute('data-reveal-pendiente', ''));

    const observer = new IntersectionObserver(
        (entries) => {
            // Los que aparecen en el mismo momento entran escalonados, 110 ms entre cada uno.
            entries
                .filter((e) => e.isIntersecting)
                .forEach((e, k) => {
                    e.target.style.setProperty('--reveal-delay', `${k * 110}ms`);
                    e.target.removeAttribute('data-reveal-pendiente');
                    observer.unobserve(e.target);
                });
        },
        { rootMargin: '0px 0px -8% 0px' }
    );

    pendientes.forEach((el) => observer.observe(el));
}
