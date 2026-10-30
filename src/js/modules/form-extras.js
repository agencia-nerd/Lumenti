// Extras de wp-form propios de Lumenti (el motor modules/form.js no se edita). Ver inc/forms-extras.php.
// - Grupos de casillas: las opciones marcadas de `<key>[]` se copian al campo oculto `<key>` del motor.
// - Panel de éxito del diseño: al enviar, el form se oculta y se muestra [data-lm-success-panel].

function parseExtras(form) {
    try {
        return JSON.parse(form.dataset.lmFormExtras || '{}');
    } catch {
        return {};
    }
}

// Copia las casillas marcadas al campo del motor (sus etiquetas, separadas por el separador del servidor).
function syncGroups(form, { grupos = {}, separador = ' | ' }) {
    Object.keys(grupos).forEach((key) => {
        const target = form.elements.namedItem(key);
        if (!target) return;
        const chosen = [...form.querySelectorAll(`input[name="${CSS.escape(key)}[]"]:checked`)].map((input) => input.dataset.label || input.value);
        target.value = chosen.join(separador);
        // Si el motor ya marcaba el error, se revalida al corregir (escucha "input" en el campo).
        if (target.getAttribute('aria-invalid') === 'true') target.dispatchEvent(new Event('input', { bubbles: true }));
    });
}

export function formExtras() {
    const forms = document.querySelectorAll('form[data-form]');
    if (!forms.length) return;

    forms.forEach((form) => {
        const extras = parseExtras(form);

        if (extras.grupos && Object.keys(extras.grupos).length) {
            form.addEventListener('change', (event) => {
                if (event.target.name?.endsWith('[]')) syncGroups(form, extras);
            });
            // empresas.js marca casillas sin disparar "change": se sincroniza justo antes del envío.
            form.addEventListener('reset', () => setTimeout(() => syncGroups(form, extras), 0));
        }

        const panel = form.dataset.lmSuccessPanel && document.getElementById(form.dataset.lmSuccessPanel);
        if (panel) {
            form.addEventListener('wp-form:success', () => {
                form.hidden = true;
                panel.hidden = false;
                (panel.querySelector('[tabindex="-1"]') || panel).focus();
            });
        }
    });

    // Fase de captura en document: corre antes que el listener de envío del motor (en el form).
    document.addEventListener('submit', (event) => {
        const form = event.target;
        if (form instanceof HTMLFormElement && form.matches('form[data-form][data-lm-form-extras]')) {
            syncGroups(form, parseExtras(form));
        }
    }, true);

    // "Enviar otra solicitud": vuelve a mostrar el form.
    document.querySelectorAll('[data-lm-form-reset]').forEach((button) => {
        button.addEventListener('click', () => {
            const form = document.querySelector(`form[data-form="${CSS.escape(button.dataset.lmFormReset)}"]`);
            const panel = button.closest('[hidden], .lm-form-success') || button.parentElement;
            if (!form) return;
            panel.hidden = true;
            form.hidden = false;
            form.querySelector('input:not([type="hidden"]):not([hidden]), select, textarea')?.focus();
        });
    });
}
