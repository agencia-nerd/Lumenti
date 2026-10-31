// Video del CTA final: se reproduce mientras la sección se ve y se pausa al salir. Con movimiento reducido (o sin
// IntersectionObserver) no arranca solo y queda el primer cuadro. El navegador solo deja autoplay con el video en mudo y playsinline.
import { prefersReducedMotion } from './utils.js';

export function ctaVideo() {
    const videos = document.querySelectorAll('[data-lm-cta] video.lm-cta__video');
    if (!videos.length || prefersReducedMotion() || !('IntersectionObserver' in window)) return;
    const io = new IntersectionObserver((entries) => {
        entries.forEach(({ target, isIntersecting }) => {
            if (isIntersecting) target.play().catch(() => {});
            else target.pause();
        });
    }, { threshold: 0.25 });
    videos.forEach((video) => io.observe(video));
}
