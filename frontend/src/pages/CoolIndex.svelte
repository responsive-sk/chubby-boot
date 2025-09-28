<script lang="ts">
  export let title: string = 'Mezzio + Svelte | Modern PHP Frontend'
  export let description: string = 'A modern, SEO-friendly landing page powered by Mezzio, Svelte, HTMX and Tailwind CSS.'
  const seo = (window as any).__SEO__ ?? { title, description }
</script>

<svelte:head>
  <title>{seo.title}</title>
  <meta name="description" content={seo.description} />
</svelte:head>

<section class="relative isolate overflow-hidden">
  <!-- Hero -->
  <div class="relative mx-auto max-w-6xl px-4 py-24 sm:py-32">
    <div class="mx-auto max-w-2xl text-center">
      <h1 class="text-4xl font-bold tracking-tight sm:text-6xl">{seo.title}</h1>
      <p class="mt-6 text-lg leading-8 text-white/70">{seo.description}</p>
      <div class="mt-10 flex items-center justify-center gap-x-6">
        <a href="/" class="rounded-md bg-emerald-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-emerald-500">Home</a>
        <a href="/api/ping" class="text-sm font-semibold leading-6">Ping API →</a>
      </div>
    </div>
  </div>

  <!-- Feature grid -->
  <div class="mx-auto max-w-6xl px-4 pb-24 grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="rounded-lg border border-white/10 bg-white/5 p-6">
      <h3 class="font-semibold mb-2">Server-first</h3>
      <p class="text-sm text-white/70">Mezzio serves full HTML for SEO, and Svelte hydrates interactivity where needed.</p>
    </div>
    <div class="rounded-lg border border-white/10 bg-white/5 p-6">
      <h3 class="font-semibold mb-2">Fast builds</h3>
      <p class="text-sm text-white/70">Vite bundles to public/build; Twig resolves assets in production without a dev server.</p>
    </div>
    <div class="rounded-lg border border-white/10 bg-white/5 p-6">
      <h3 class="font-semibold mb-2">Progressive enhancement</h3>
      <p class="text-sm text-white/70">HTMX sprinkles dynamic HTML swaps; Svelte handles more complex UI islands.</p>
    </div>
  </div>
</section>
