/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './templates/**/*.twig', // Twig šablóny
    './frontend/src/**/*.svelte', // Svelte komponenty
    './resources/js/**/*.svelte', // Existujúce Svelte
  ],
  safelist: [
    // Dynamické triedy z Twigu
    'alert-success', 'alert-error', 'alert-warning',
    'bg-green-100', 'text-green-800',
    'bg-red-100', 'text-red-800',
    'bg-yellow-100', 'text-yellow-800',
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}
