import { writable } from 'svelte/store';

interface User {
  id: string;
  name: string;
  email: string;
  isLoggedIn: boolean;
}

// User session
export const userStore = writable<User | null>(null);

export function login(user: User) {
  userStore.set({ ...user, isLoggedIn: true });
}

export function logout() {
  userStore.set(null);
}
