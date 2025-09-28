/// <reference types="vite/client" />

declare module '$components' {
  export { default as Header } from '../components/layout/Header.svelte';
  export { default as Footer } from '../components/ui/Footer.svelte';
  export { default as ArticleCard } from '../components/ui/ArticleCard.svelte';
  export { default as AddToCart } from '../components/islands/AddToCart.svelte';
}

declare module '$stores' {
  export { appStore } from '../stores/app.store';
  export { cartStore, addToCart, removeFromCart } from '../stores/cart.store';
  export { userStore, login, logout } from '../stores/user.store';
  export { uiStore, openModal, closeModal, toggleTheme, toggleSidebar } from '../stores/ui.store';
}

declare module '$utils/formatters' {
  export { formatPrice, formatDate } from '../utils/formatters';
}
