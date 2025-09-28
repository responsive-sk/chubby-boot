import { vitePreprocess } from "@sveltejs/vite-plugin-svelte";

export default {
  preprocess: vitePreprocess(),
  compilerOptions: {
    // Svelte 5 specific options
    // enableSourcemap: true,
    dev: process.env.NODE_ENV !== 'production'
  }
};