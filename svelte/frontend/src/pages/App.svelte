<script lang="ts">
  import { onMount, onDestroy } from 'svelte';
  import { Header, Footer, ArticleCard, AddToCart } from '$components';
  // import TailwindHero from '$components/ui';
  import { cartStore, addToCart } from '$stores';
  import { userStore } from '$stores';
  import { formatPrice } from '$utils/formatters';

  // Svelte 5 reactivity
  let count = $state(0);
  let user = $derived($userStore);

  // Sample article data for ArticleCard
  const sampleArticle = {
    title: 'Začnite s moderným PHP vývojom',
    slug: 'zacnite-s-modernym-php-vyvojom',
    excerpt: 'Objavte výhody Mezzio frameworku v kombinácii so Svelte pre vytvorenie rýchlych a SEO-friendly webových aplikácií.',
    content: 'Tento článok vás prevedie základmi moderného PHP vývoja...',
    image: 'https://images.unsplash.com/photo-1555949963-aa79dcee981c?w=400&h=200&fit=crop',
    category: 'PHP',
    author: 'Daniel',
    published_at: '2024-01-15T10:00:00Z'
  };

  // Handle key press to dismiss modal
  function handleKeyPress(event: KeyboardEvent) {
    const modal = document.getElementById('htmx-modal');
    if (modal && modal.style.display !== 'none') {
      modal.style.display = 'none';
    }
  }

  // Set up key event listener
  onMount(() => {
    window.addEventListener('keydown', handleKeyPress);
  });

  // Clean up event listener
  onDestroy(() => {
    window.removeEventListener('keydown', handleKeyPress);
  });
</script>

<Header />
<main>
  <TailwindHero />

  <h1>Vitajte, {user?.name || 'užívateľ'}!</h1>

  <!-- Container for the grid to control width -->
  <div class="max-w-6xl mx-auto px-4">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
      <!-- ArticleCard in the grid -->
      <div class="col-span-1 md:col-span-2 lg:col-span-3">
        <ArticleCard article={sampleArticle} />
      </div>
      <!-- Product cards can be added here -->
    </div>
  </div>

  <!-- Tlačidlo pre manuálne načítanie HTMX obsahu -->
  <div class="mt-8 text-center">
    <!-- @ts-ignore -->
    <button
      class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 transition-colors"
      hx-get="/api/latest-content"
      hx-target="#htmx-content-area"
      hx-indicator="#htmx-modal"
    >
      Načítať dynamický obsah cez HTMX
    </button>
  </div>

  <!-- HTMX kontajner pre dynamický obsah -->
  <!-- @ts-ignore -->
  <div id="htmx-content-area" class="mt-4">
    <!-- Obsah sa sem načíta cez HTMX -->
  </div>

  <!-- HTMX Loading Modal -->
  <!-- @ts-ignore -->
  <div id="htmx-modal" class="htmx-indicator fixed inset-0 z-50 flex items-center justify-center" style="display: none;">
    <div class="absolute inset-0 bg-black bg-opacity-50"></div>
    <div class="relative bg-white rounded-lg p-8 max-w-md mx-4 shadow-xl">
      <div class="text-center">
        <div class="htmx-spinner mx-auto mb-4"></div>
        <h3 class="text-lg font-semibold text-gray-900 mb-2">Načítavam obsah...</h3>
        <p class="text-gray-600 mb-4">Prosím počkajte, obsah sa načítava cez HTMX.</p>
        <p class="text-sm text-gray-500">Stlačte ľubovoľnú klávesu pre pokračovanie...</p>
      </div>
    </div>
  </div>

  <AddToCart />
</main>
<Footer />
