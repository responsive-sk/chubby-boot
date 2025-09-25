import '../styles/app.css';
import { mount } from 'svelte';
import Welcome from '$pages/Welcome.svelte';
import TailwindHero from '$components/ui/TailwindHero.svelte';
import Header from '$components/layout/Header.svelte';

// Component registry for dynamic mounting
const componentRegistry: Record<string, any> = {
  Welcome,
  TailwindHero,
  Header,
};

// Mount components from Twig helper
function mountSvelteComponents() {
  const svelteElements = document.querySelectorAll('[data-component]');

  svelteElements.forEach((element) => {
    const componentName = element.getAttribute('data-component');
    const propsJson = element.getAttribute('data-props');

    if (componentName && componentRegistry[componentName]) {
      let props = {};
      if (propsJson) {
        try {
          props = JSON.parse(propsJson);
        } catch (e) {
          console.error('Invalid props JSON for component:', componentName, e);
        }
      }

      mount(componentRegistry[componentName], {
        target: element as HTMLElement,
        props,
      });
    }
  });
}

// Mount legacy hardcoded components (for backward compatibility)
function mountLegacyComponents() {
  // Mount hlavnú appku
  const appTarget = document.getElementById('svelte-app');
  if (appTarget) {
    mount(Welcome, {
      target: appTarget,
      props: {
        greeting: (window as any).__APP_GREETING__ ?? "HTMX PSR-15",
      },
    });
  }

  // Mount TailwindHero
  const heroTarget = document.getElementById('tailwind-hero');
  if (heroTarget) {
    mount(TailwindHero, {
      target: heroTarget,
    });
  }

  // Mount header
  const navRoot = document.getElementById('nav-root');
  if (navRoot) {
    const urlParams = new URLSearchParams(window.location.search);
    mount(Header, {
      target: navRoot,
      props: {
        currentRoute: window.location.pathname || "/",
        searchQuery: urlParams.get('q') || ""
      }
    });
  }
}

// Initialize mounting
mountSvelteComponents();
mountLegacyComponents();
