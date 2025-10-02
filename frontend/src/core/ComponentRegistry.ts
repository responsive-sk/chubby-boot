import { mount } from 'svelte';

type ComponentMap = Record<string, () => Promise<any>>;

export class ComponentRegistry {
  // ONLY islands for interactive enhancements
  private static components: ComponentMap = {
    ...import.meta.glob('../components/islands/*.svelte'),
  };

  static async initIslands(): Promise<void> {
    console.log('[ComponentRegistry] 🔄 Enhancing interactive islands...');
    
    const elements = document.querySelectorAll<HTMLElement>('[data-component]');
    console.log(`[ComponentRegistry] 📦 Found ${elements.length} islands to enhance`);
    
    for (const element of elements) {
      await this.mountComponent(element);
    }
  }

  static async mountComponent(element: HTMLElement): Promise<void> {
    const componentName = element.dataset.component;
    if (!componentName) return;

    console.log(`[ComponentRegistry] 🎯 Enhancing: "${componentName}"`);

    const loader = this.components[`../components/islands/${componentName}.svelte`];
    if (!loader) {
      console.warn(`[ComponentRegistry] ❌ Island "${componentName}" not found`);
      return;
    }

    try {
      const module = await loader();
      const props = element.dataset.props ? JSON.parse(element.dataset.props) : {};
      
      mount(module.default, {
        target: element,
        props
      });
      
      console.log(`[ComponentRegistry] ✅ "${componentName}" enhanced successfully`);
    } catch (error) {
      console.error(`[ComponentRegistry] ❌ Failed to enhance "${componentName}":`, error);
    }
  }
}

// Auto-initialize
if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', () => ComponentRegistry.initIslands());
} else {
  ComponentRegistry.initIslands();
}

// Re-initialize after HTMX swaps
document.body.addEventListener('htmx:afterSwap', () => ComponentRegistry.initIslands());

// CSRF for HTMX
document.addEventListener('htmx:configRequest', (event: any) => {
  const csrfMeta = document.querySelector('meta[name="csrf-token"]');
  const csrfToken = csrfMeta?.getAttribute('content');

  if (csrfToken && !['get', 'head', 'options'].includes(event.detail.verb.toLowerCase())) {
    event.detail.headers['X-CSRF-Token'] = csrfToken;
  }
});