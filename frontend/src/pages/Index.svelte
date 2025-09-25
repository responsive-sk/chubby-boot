<!-- frontend/src/pages/Index.svelte -->
<script>
  import { onMount } from 'svelte';
  import Header from '$components/layout/Header.svelte';
  import Hero from '$components/layout/Hero.svelte';  // ← Opravená cesta!
  
  // Jednoduchý Footer (vytvoríme)
  const Footer = () => {
    return `
      <footer style="background: #1a202c; color: white; padding: 2rem; text-align: center;">
        <p>&copy; 2024 Boson PHP. All rights reserved.</p>
      </footer>
    `;
  };

  let currentRoute = '/';
  let searchQuery = '';

  onMount(() => {
    console.log('Index page mounted');
  });
</script>

<div class="index-page">
  <!-- Header -->
  <Header {currentRoute} {searchQuery} />
  
  <!-- Main Content -->
  <main class="main-content">
    <!-- Hero Section -->
    <Hero 
      title="Go Native. Stay PHP."
      subtitle="Turn your PHP project into cross-platform, compact, fast, native applications for Windows, Linux and macOS."
      primaryButton={{ text: 'Try Hero For Free', url: '/docs/latest/installation' }}
      secondaryButton={{ text: 'Download Now', url: '/download' }}
    />
    
    <!-- Welcome Section -->
    <section class="welcome-section">
      <div class="container">
        <h2>Welcome to Boson PHP</h2>
        <p>Build amazing desktop applications with PHP</p>
      </div>
    </section>
  </main>

  <!-- Simple Footer -->
  {@html Footer()}
</div>

<style>
  .index-page {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
  }

  .main-content {
    flex: 1;
    margin-top: 100px;
  }

  .welcome-section {
    padding: 4rem 0;
    background: #f7fafc;
    text-align: center;
  }

  .container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
  }

  .welcome-section h2 {
    font-size: 2.5rem;
    color: #2d3748;
    margin-bottom: 1rem;
  }

  .welcome-section p {
    font-size: 1.125rem;
    color: #718096;
  }
</style>