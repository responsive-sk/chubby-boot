// vite.config.js
import { defineConfig } from 'vite'
import { svelte } from '@sveltejs/vite-plugin-svelte'
import path from 'path'

export default defineConfig({
  plugins: [svelte()],
  base: '/assets/',
  build: {
    outDir: "../public/assets",
    emptyOutDir: true,
    rollupOptions: {
      input: path.resolve(__dirname, 'src/app.ts'),
      output: {
        format: 'es',
        entryFileNames: '[name].js',
        chunkFileNames: '[name].js',
        assetFileNames: '[name][extname]'
      }
    }
  },
  resolve: {
    alias: {
      // Ensure these paths are correct
      '$components': path.resolve(__dirname, 'src/components'),
      '$stores': path.resolve(__dirname, 'src/stores'),
      '$utils': path.resolve(__dirname, 'src/utils')
    }
  }
})