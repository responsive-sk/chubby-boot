import { mount } from 'svelte';

type ComponentMap = Record<string, () => Promise<any>>;

/**
 * Unified Component Registry
 * Dynamically imports and mounts Svelte components from the new structure
 */
export class ComponentRegistry {
  private static components: ComponentMap = {
    // Islands - Interactive components
    ...import.meta.glob('../components/islands/*.svelte'),
    
    // UI - Presentational components  
    ...import.meta.glob('../components/ui/*.svelte'),
    
    // Layout - Structural components
    ...import.meta.glob('../components/layout/*.svelte'),
    
    // Sections - Composite sections
    ...import.meta.glob('../components/sections/*.svelte'),
    
    // Pages - Top-level views
    ...import.meta.glob('../pages/*.svelte'),
  };

  /**
   * Initialize all elements with data-component attribute
   */
  static async initIslands(): Promise<void> {
    console.log('[ComponentRegistry] Initializing islands...');
    
    const elements = document.querySelectorAll<HTMLElement>('[data-component]');
    console.log(`[ComponentRegistry] Found ${elements.length} components to mount`);
    
    for (const element of elements) {
      await this.mountComponent(element);
    }
  }

  /**
   * Mount a single component
   */
  static async mountComponent(element: HTMLElement): Promise<void> {
    const componentName = element.dataset.component;
    if (!componentName) return;

    console.log(`[ComponentRegistry] Mounting component: ${componentName}`);

    const loader = this.findComponent(componentName);
    if (!loader) {
      console.warn(`[ComponentRegistry] Component "${componentName}" not found`);
      return;
    }

    try {
      const module = await loader();
      const props = element.dataset.props ? JSON.parse(element.dataset.props) : {};
      
      mount(module.default, {
        target: element,
        props
      });
      
      console.log(`[ComponentRegistry] Component "${componentName}" mounted successfully`);
    } catch (error) {
      console.error(`[ComponentRegistry] Failed to mount "${componentName}":`, error);
    }
  }

  /**
   * Find component loader by name
   */
  private static findComponent(name: string): (() => Promise<any>) | undefined {
    // Try different path patterns
    const patterns = [
      `../components/islands/${name}.svelte`,
      `../components/ui/${name}.svelte`, 
      `../components/layout/${name}.svelte`,
      `../components/sections/${name}.svelte`,
      `../pages/${name}.svelte`
    ];

    for (const pattern of patterns) {
      if (this.components[pattern]) {
        return this.components[pattern];
      }
    }

    return undefined;
  }
}

// Auto-initialize on DOM ready
if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', () => ComponentRegistry.initIslands());
} else {
  ComponentRegistry.initIslands();
}

// Re-initialize after HTMX swaps
document.body.addEventListener('htmx:afterSwap', () => ComponentRegistry.initIslands());

// Add CSRF token to HTMX requests
document.addEventListener('htmx:configRequest', (event: any) => {
  const csrfMeta = document.querySelector('meta[name="csrf-token"]');
  const csrfToken = csrfMeta?.getAttribute('content');

  if (csrfToken && !['get', 'head', 'options'].includes(event.detail.verb.toLowerCase())) {
    event.detail.headers['X-CSRF-Token'] = csrfToken;
  }
});
