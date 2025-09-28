// frontend/src/lib/boot/islands.ts

import { mount } from 'svelte';

type ComponentMap = Record<string, () => Promise<any>>;

/**
 * Dynamicky importuje všetky Svelte komponenty z priečinka islands a pages
 * (Vite ich zabalí do JS chunkov pri builde)
 */
const components: ComponentMap = {
  ...import.meta.glob('../components/islands/*.svelte'),
  ...import.meta.glob('../../pages/*.svelte'),
};

/**
 * Inicializuje všetky elementy s data-component
 */
export function initIslands(): void {
  console.log('[Svelte Islands] initIslands called');
  document.querySelectorAll<HTMLElement>('[data-component]').forEach(async (el) => {
    const name = el.dataset.component;
    console.log('[Svelte Islands] Found element with data-component:', name);
    if (!name) return;

    const possiblePaths = [`../components/islands/${name}.svelte`, `../../pages/${name}.svelte`];
    console.log('[Svelte Islands] Possible paths:', possiblePaths);
    const loader = possiblePaths.map(p => components[p]).find(Boolean);
    console.log('[Svelte Islands] Loader found:', !!loader);

    if (!loader) {
      console.warn(`[Svelte Islands] Komponenta "${name}" sa nenašla v islands alebo pages.`);
      return;
    }

    try {
      console.log('[Svelte Islands] Loading module for:', name);
      const module = await loader();
      const props = el.dataset.props ? JSON.parse(el.dataset.props) : {};
      console.log('[Svelte Islands] Mounting component:', name, 'with props:', props);

      mount(module.default, {
        target: el,
        props
      });
      console.log('[Svelte Islands] Component mounted:', name);
    } catch (err) {
      console.error(`[Svelte Islands] Nepodarilo sa mountnúť "${name}":`, err);
    }
  });
}

// Add CSRF token to all HTMX POST/PUT/DELETE requests
document.addEventListener('htmx:configRequest', (event: any) => {
    const csrfMeta = document.querySelector('meta[name="csrf-token"]');
    const csrfToken = csrfMeta?.getAttribute('content');

    if (csrfToken && !['get', 'head', 'options'].includes(event.detail.verb.toLowerCase())) {
        event.detail.headers['X-CSRF-Token'] = csrfToken;
    }
});

// Spustí sa pri načítaní DOM
document.addEventListener('DOMContentLoaded', initIslands);

// Podpora pre HTMX – rehydratácia po výmene časti DOM
document.body.addEventListener('htmx:afterSwap', initIslands);
