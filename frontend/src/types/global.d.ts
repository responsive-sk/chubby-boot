declare global {
  // HTMX events
  interface Document {
    addEventListener(type: 'htmx:afterSwap', listener: (event: CustomEvent) => void): void;
    addEventListener(type: 'htmx:afterSettle', listener: (event: CustomEvent) => void): void;
  }

  // Svelte island contract
  interface HTMLElement {
    __svelte_component?: any;
  }
}

export {};
