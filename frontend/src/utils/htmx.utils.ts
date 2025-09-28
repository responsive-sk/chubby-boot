declare const htmx: any;

export function htmxTrigger(eventName: string, detail: any = {}) {
  document.dispatchEvent(new CustomEvent(`htmx:${eventName}`, { detail }));
}

export function htmxLoad(url: string, target: string) {
  htmx.ajax('GET', url, { target, swap: 'innerHTML' });
}

export function setupHtmxGlobalEvents() {
  // CSRF pre všetky requests
  document.addEventListener('htmx:configRequest', (event) => {
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    if (csrfToken) {
      event.detail.headers['X-CSRF-Token'] = csrfToken;
    }
  });
}
