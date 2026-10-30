// Entrada de JS del tema: cada módulo se inicializa solo si su componente existe en la página.
import { navbar } from './modules/navbar.js';
import { reveal, smoothScroll, hashTarget } from './modules/scroll.js';
import { preloader, heroSlider, countUp, fan, daily } from './modules/home.js';
import { verMas } from './modules/ver-mas.js';
import { carousel } from './modules/carousel.js';
import { cardEspecialista } from './modules/card-especialista.js';
import { specialistsFilter } from './modules/specialists-filter.js';
import { profile } from './modules/especialista.js';
import { fitTitle, conditionFilter } from './modules/condition-filter.js';
import { blogFilter } from './modules/blog-filter.js';
import { legalToc } from './modules/legal.js';
import { empresasLinks, empresasSteps } from './modules/empresas.js';
import { formExtras } from './modules/form-extras.js';

document.documentElement.classList.add('lm-js');

// Orden del diseño. preloader corre siempre: sin preloader solo agrega .lm-go (libera el hero).
const modules = {
    navbar,
    reveal,
    smoothScroll,
    hashTarget,
    preloader,
    heroSlider,
    countUp,
    fan,
    daily,
    verMas,
    carousel,
    cardEspecialista,
    specialistsFilter,
    profile,
    fitTitle,
    conditionFilter,
    blogFilter,
    legalToc,
    empresasLinks,
    empresasSteps,
    formExtras,
};

function init() {
    for (const [name, fn] of Object.entries(modules)) {
        try {
            fn();
        } catch (err) {
            console.warn(`[lumenti] ${name}`, err);
        }
    }
}

if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', init);
else init();

if (document.querySelector('form[data-form]')) {
    import('./modules/form.js').then(({ initForms }) => initForms()).catch(console.error);
}

if (document.querySelector('[data-accordion]')) {
    import('./modules/accordion.js').then(({ initAccordions }) => initAccordions()).catch(console.error);
}
