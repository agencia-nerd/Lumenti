// reCAPTCHA v3 de los forms con [data-lm-recaptcha] (código propio de Lumenti; el motor modules/form.js no se edita).
// Antes de que corra el motor, pide el token a Google y lo deja en la cookie `lumenti_recaptcha`, que viaja sola
// en el fetch del motor. El servidor la verifica en inc/recaptcha.php.

const COOKIE = 'lumenti_recaptcha';
let loading = null;

// Carga el script de Google una sola vez (al tocar el form, no al abrir la página).
function load(key) {
    if (!loading) {
        loading = new Promise((resolve, reject) => {
            const script = document.createElement('script');
            script.src = `https://www.google.com/recaptcha/api.js?render=${encodeURIComponent(key)}`;
            script.async = true;
            script.onload = () => window.grecaptcha.ready(resolve);
            script.onerror = () => {
                loading = null; // Se reintenta en el próximo envío.
                reject(new Error('reCAPTCHA no cargó'));
            };
            document.head.append(script);
        });
    }
    return loading;
}

async function getToken(key, action) {
    await load(key);
    return window.grecaptcha.execute(key, { action });
}

function setCookie(value) {
    const secure = window.location.protocol === 'https:' ? '; Secure' : '';
    document.cookie = `${COOKIE}=${encodeURIComponent(value)}; path=/; max-age=120; SameSite=Strict${secure}`;
}

export function recaptcha() {
    const forms = document.querySelectorAll('form[data-form][data-lm-recaptcha]');
    if (!forms.length) return;

    forms.forEach((form) => {
        const warm = () => load(form.dataset.lmRecaptcha).catch(() => {});
        form.addEventListener('focusin', warm, { once: true });
        form.addEventListener('pointerdown', warm, { once: true });
    });

    // Fase de captura en document: corre antes que el motor (y que form-extras.js).
    document.addEventListener('submit', async (event) => {
        const form = event.target;
        if (!(form instanceof HTMLFormElement) || !form.matches('form[data-form][data-lm-recaptcha]')) return;

        // Segunda pasada (ya con token) o el motor ya está enviando: sigue normal.
        if (form.dataset.lmRecaptchaPass === '1') {
            delete form.dataset.lmRecaptchaPass;
            return;
        }
        if (form.getAttribute('aria-busy') === 'true') return;

        event.preventDefault();
        event.stopImmediatePropagation();
        if (form.dataset.lmRecaptchaWaiting === '1') return;

        const submit = form.querySelector('[type="submit"]');
        form.dataset.lmRecaptchaWaiting = '1';
        if (submit) submit.disabled = true;

        try {
            setCookie(await getToken(form.dataset.lmRecaptcha, form.dataset.form));
        } catch (error) {
            // Sin token el servidor rechaza el envío y el motor muestra el mensaje en el form.
            console.warn('[lumenti] reCAPTCHA', error);
        } finally {
            delete form.dataset.lmRecaptchaWaiting;
            if (submit) submit.disabled = false;
        }

        form.dataset.lmRecaptchaPass = '1';
        form.requestSubmit();
    }, true);
}
