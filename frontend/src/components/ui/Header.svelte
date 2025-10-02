<script>
  import { onMount } from 'svelte'
  
  export let currentRoute = ''
  export let searchQuery = ''
  
  let mobileMenuOpen = false
  let searchOpen = false
  let searchInput
  
  const navigation = [
    { name: 'Home', href: '/', route: 'home' },
    { name: 'Articles', href: '/articles', route: 'articles' },
    { name: 'Docs', href: '/docs/latest', route: 'docs' },
    { name: 'Download', href: '/download', route: 'download' },
    { name: 'About', href: '/about', route: 'about' }
  ]
  
  function toggleMobileMenu() {
    mobileMenuOpen = !mobileMenuOpen
  }
  
  function toggleSearch() {
    searchOpen = !searchOpen
    if (searchOpen) {
      setTimeout(() => searchInput?.focus(), 100)
    }
  }
  
  function closeSearch() {
    searchOpen = false
  }
  
  function handleSearchSubmit(event) {
    event.preventDefault()
    const formData = new FormData(event.target)
    const query = formData.get('q')
    if (query) {
      window.location.href = `/search?q=${encodeURIComponent(query)}`
    }
  }
  
  function handleSearchKeydown(event) {
    if (event.key === 'Escape') {
      closeSearch()
    }
  }
  
  onMount(() => {
    // Close mobile menu when clicking outside
    function handleClickOutside(event) {
      if (mobileMenuOpen && !event.target.closest('.mobile-menu-container')) {
        mobileMenuOpen = false
      }
    }
    
    document.addEventListener('click', handleClickOutside)
    
    return () => {
      document.removeEventListener('click', handleClickOutside)
    }
  })
</script>

<header class="header svelte-component">
  <div class="container">
    <!-- Desktop Navigation -->
    <nav class="desktop-nav">
      {#each navigation as item}
        <a 
          href={item.href} 
          class="nav-link"
          class:active={currentRoute === item.route}
        >
          {item.name}
        </a>
      {/each}
    </nav>
    
    <!-- Search & Mobile Menu -->
    <div class="header-actions">
      <!-- Search Button -->
      <button 
        class="search-toggle btn-ghost"
        on:click={toggleSearch}
        aria-label="Toggle search"
      >
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
          <circle cx="11" cy="11" r="8"/>
          <path d="m21 21-4.35-4.35"/>
        </svg>
      </button>
      
      <!-- Mobile Menu Button -->
      <button 
        class="mobile-menu-toggle btn-ghost"
        on:click={toggleMobileMenu}
        aria-label="Toggle mobile menu"
      >
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
          {#if mobileMenuOpen}
            <path d="M18 6L6 18M6 6l12 12"/>
          {:else}
            <path d="M3 12h18M3 6h18M3 18h18"/>
          {/if}
        </svg>
      </button>
    </div>
  </div>
  
  <!-- Mobile Navigation -->
  {#if mobileMenuOpen}
    <div 
      class="mobile-menu mobile-menu-container svelte-slide"
      role="dialog"
      aria-modal="true"
      aria-label="Mobile menu"
      tabindex="0"
    >
      <nav class="mobile-nav">
        {#each navigation as item}
          <a 
            href={item.href} 
            class="mobile-nav-link"
            class:active={currentRoute === item.route}
            on:click={() => mobileMenuOpen = false}
          >
            {item.name}
          </a>
        {/each}
      </nav>
    </div>
  {/if}
  
  <!-- Search Overlay -->
  {#if searchOpen}
    <div 
      class="search-overlay svelte-fade" 
      on:click={closeSearch}
      on:keydown={handleSearchKeydown}
      role="dialog"
      aria-modal="true"
      aria-label="Search dialog"
      tabindex="0"
    >
      <div class="search-modal" role="document">
        <form on:submit={handleSearchSubmit} class="search-form">
          <div class="search-input-container">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
              <circle cx="11" cy="11" r="8"/>
              <path d="m21 21-4.35-4.35"/>
            </svg>
            <input
              type="search"
              name="q"
              placeholder="Search articles..."
              bind:value={searchQuery}
              bind:this={searchInput}
              aria-label="Search input"
            />
            <button 
              type="button" 
              on:click={closeSearch} 
              class="search-close"
              aria-label="Close search"
            >
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                <path d="M18 6L6 18M6 6l12 12"/>
              </svg>
            </button>
          </div>
        </form>
      </div>
    </div>
  {/if}
</header>

<style>
  .header {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    height: 100px;
    background: rgba(26, 32, 44, 0.95);
    backdrop-filter: blur(10px);
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    z-index: 100;
    transition: all 0.3s ease;
  }
  
  .container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
  }
  
  .desktop-nav {
    display: flex;
    align-items: center;
    gap: 2rem;
  }
  
  .nav-link {
    color: rgba(255, 255, 255, 0.8);
    text-decoration: none;
    font-weight: 500;
    transition: color 0.2s ease;
    position: relative;
  }
  
  .nav-link:hover,
  .nav-link.active {
    color: #ffffff;
  }
  
  .nav-link.active::after {
    content: '';
    position: absolute;
    bottom: -8px;
    left: 0;
    right: 0;
    height: 2px;
    background: #ffffff;
    border-radius: 1px;
  }
  
  .header-actions {
    display: flex;
    align-items: center;
    gap: 1rem;
  }
  
  .btn-ghost {
    background: none;
    border: none;
    color: rgba(255, 255, 255, 0.8);
    padding: 0.5rem;
    border-radius: 0.5rem;
    cursor: pointer;
    transition: all 0.2s ease;
  }
  
  .btn-ghost:hover {
    color: #ffffff;
    background: rgba(255, 255, 255, 0.1);
  }
  
  .mobile-menu-toggle {
    display: none;
  }
  
  .mobile-menu {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: rgba(26, 32, 44, 0.98);
    backdrop-filter: blur(10px);
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    padding: 1rem 0;
  }
  
  .mobile-nav {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
    display: flex;
    flex-direction: column;
    gap: 1rem;
  }
  
  .mobile-nav-link {
    color: rgba(255, 255, 255, 0.8);
    text-decoration: none;
    font-weight: 500;
    padding: 0.75rem 0;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    transition: color 0.2s ease;
  }
  
  .mobile-nav-link:hover,
  .mobile-nav-link.active {
    color: #ffffff;
  }
  
  .search-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(4px);
    z-index: 200;
    display: flex;
    align-items: flex-start;
    justify-content: center;
    padding-top: 10vh;
  }
  
  .search-modal {
    background: white;
    border-radius: 0.5rem;
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 600px;
    margin: 0 2rem;
  }
  
  .search-form {
    padding: 1.5rem;
  }
  
  .search-input-container {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem 1.5rem;
    border: 2px solid #e5e7eb;
    border-radius: 0.375rem;
    background: white;
    transition: border-color 0.2s ease;
  }
  
  .search-input-container:focus-within {
    border-color: #2563eb;
  }
  
  .search-close {
    background: none;
    border: none;
    color: #6b7280;
    cursor: pointer;
    padding: 0.25rem;
    border-radius: 0.5rem;
    transition: color 0.2s ease;
  }
  
  .search-close:hover {
    color: #374151;
  }
  
  @media (max-width: 768px) {
    .desktop-nav {
      display: none;
    }
    
    .mobile-menu-toggle {
      display: block;
    }
    
    .container {
      padding: 0 1rem;
    }
  }
</style>