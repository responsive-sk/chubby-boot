import { writable } from 'svelte/store';

// Global app state
export const appStore = writable({
  loading: false,
  error: null,
  theme: 'light'
});
