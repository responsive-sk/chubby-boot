import { writable } from 'svelte/store';

interface UIState {
  modalOpen: boolean;
  modalContent: string | null;
  theme: 'light' | 'dark';
  sidebarOpen: boolean;
}

// UI state (modals, theme)
export const uiStore = writable<UIState>({
  modalOpen: false,
  modalContent: null,
  theme: 'light',
  sidebarOpen: false
});

export function openModal(content: string) {
  uiStore.update(ui => ({ ...ui, modalOpen: true, modalContent: content }));
}

export function closeModal() {
  uiStore.update(ui => ({ ...ui, modalOpen: false, modalContent: null }));
}

export function toggleTheme() {
  uiStore.update(ui => ({ ...ui, theme: ui.theme === 'light' ? 'dark' : 'light' }));
}

export function toggleSidebar() {
  uiStore.update(ui => ({ ...ui, sidebarOpen: !ui.sidebarOpen }));
}
