// htmx.d.ts
declare global {
  interface HTMLElement {
    __svelte_component?: any;
  }

  // HTMX attributes for all elements
  interface HTMLElement {
    'hx-get'?: string;
    'hx-post'?: string;
    'hx-put'?: string;
    'hx-patch'?: string;
    'hx-delete'?: string;
    'hx-target'?: string;
    'hx-swap'?: string;
    'hx-trigger'?: string;
    'hx-indicator'?: string;
    'hx-boost'?: string;
    'hx-push-url'?: string;
    'hx-select'?: string;
    'hx-select-oob'?: string;
    'hx-swap-oob'?: string;
    'hx-confirm'?: string;
    'hx-disable'?: string;
    'hx-disabled-elt'?: string;
    'hx-encoding'?: string;
    'hx-headers'?: string;
    'hx-history'?: string;
    'hx-history-elt'?: string;
    'hx-include'?: string;
    'hx-params'?: string;
    'hx-preserve'?: string;
    'hx-prompt'?: string;
    'hx-queue'?: string;
    'hx-replace-url'?: string;
    'hx-request'?: string;
    'hx-sync'?: string;
    'hx-validate'?: string;
    'hx-vars'?: string;
    'hx-vals'?: string;
  }

  // HTMX events
  interface Document {
    addEventListener(type: 'htmx:afterSwap', listener: (event: CustomEvent) => void): void;
    addEventListener(type: 'htmx:afterSettle', listener: (event: CustomEvent) => void): void;
    addEventListener(type: 'htmx:configRequest', listener: (event: CustomEvent) => void): void;
  }
}

export {};
