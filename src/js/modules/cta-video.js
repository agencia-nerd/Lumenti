// CTA final ([data-lm-cta]), como en el diseño:
// - Video: se reproduce mientras la sección se ve y se pausa al salir. Con movimiento reducido (o sin
//   IntersectionObserver) no arranca solo y queda el primer cuadro. El navegador solo deja autoplay en mudo y playsinline.
// - Curva: el borde superior de .lm-cta__box es un arco (clip-path circle) que se aplana a medida que la sección sube
//   en pantalla. Con movimiento reducido el arco sigue el scroll sin suavizado.
import { prefersReducedMotion } from './utils.js';

// Alto máximo del arco según el ancho (escritorio, tablet, móvil).
const arcMax = () => {
    const w = window.innerWidth;
    if (w >= 1024) return Math.min(170, w * 0.0885);
    return w >= 768 ? 72 : 40;
};

// Círculo que pasa por las dos esquinas de arriba y baja `s` px en el centro: radio = (w²/4 + s²) / 2s.
const clipFor = (w, s) => {
    if (!w || s < 0.5) return 'none';
    const r = (w * w / 4 + s * s) / (2 * s);
    return `circle(${r.toFixed(1)}px at 50% ${r.toFixed(1)}px)`;
};

function curve(sec) {
    const box = sec.querySelector('.lm-cta__box');
    if (!box) return;
    let target = 1;
    let eased = null;
    let raf = 0;
    const paint = () => {
        raf = 0;
        eased += (target - eased) * 0.1;
        if (Math.abs(target - eased) < 0.001) eased = target;
        box.style.clipPath = clipFor(box.offsetWidth, arcMax() * eased);
        if (eased !== target) raf = requestAnimationFrame(paint);
    };
    // 1 = arco completo (la sección recién entra abajo); 0 = plano (subió el 70 % de la pantalla).
    const measure = () => {
        const vh = window.innerHeight;
        const top = sec.getBoundingClientRect().top;
        const p = Math.max(0, Math.min(1, (vh * 0.95 - top) / (vh * 0.7)));
        target = 1 - p * p * (3 - 2 * p);
        if (eased == null || prefersReducedMotion()) eased = target;
        if (!raf) raf = requestAnimationFrame(paint);
    };
    window.addEventListener('scroll', measure, { passive: true });
    window.addEventListener('resize', measure);
    measure();
}

function video(sec) {
    const el = sec.querySelector('video.lm-cta__video');
    if (!el) return;
    el.muted = true;
    el.loop = true;
    el.playsInline = true;
    if (!('IntersectionObserver' in window)) return;
    new IntersectionObserver((entries) => {
        entries.forEach(({ isIntersecting }) => {
            if (isIntersecting && !prefersReducedMotion()) el.play().catch(() => {});
            else el.pause();
        });
    }, { threshold: 0.15 }).observe(el);
}

export function ctaVideo() {
    document.querySelectorAll('[data-lm-cta]').forEach((sec) => {
        video(sec);
        curve(sec);
    });
}
