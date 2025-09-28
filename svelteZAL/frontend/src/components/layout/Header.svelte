<script>
  import { onMount } from 'svelte';
  import { useToggle, useSearch, useClickOutside } from '$composables';
  import Logo from './Logo.svelte';
  import Navigation from './Navigation.svelte';
  import HeaderActions from './HeaderActions.svelte';
  import MobileMenu from './MobileMenu.svelte';
  import SearchForm from './SearchForm.svelte';

  let {
    currentRoute = '',
    searchQuery = '',
    navigation = [
      { name: 'Home', href: '/', route: 'home' },
      { name: 'Articles', href: '/articles', route: 'articles' },
      { name: 'Docs', href: '/docs/latest', route: 'docs' },
      { name: 'Download', href: '/download', route: 'download' },
      { name: 'About', href: '/about', route: 'about' }
    ]
  } = $props();

  // Use composables for cleaner state management
  const mobileMenu = useToggle(false);
  const searchModal = useSearch(searchQuery);
  const mobileMenuRef = useClickOutside(() => mobileMenu.setFalse());

  function handleMobileMenuClose() {
    mobileMenu.setFalse();
  }

  function handleSearch(query: string) {
    if (query) {
      window.location.href = `/search?q=${encodeURIComponent(query)}`;
    }
  }

  onMount(() => {
    // The click outside handler is already set up by useClickOutside
  });
</script>

<header class="header svelte-component" bind:this={mobileMenuRef.element}>
  <div class="container">
    <!-- Logo -->
    <Logo />

    <!-- Desktop Navigation -->
    <Navigation {navigation} {currentRoute} />

    <!-- Search & Mobile Menu Actions -->
    <HeaderActions
      mobileMenuOpen={mobileMenu.value}
      onSearchToggle={searchModal.toggle}
      onMobileMenuToggle={mobileMenu.toggle}
    />
  </div>

  <!-- Mobile Navigation -->
  <MobileMenu
    isOpen={mobileMenu.value}
    {navigation}
    {currentRoute}
    onClose={handleMobileMenuClose}
    onNavClick={() => {}} <!-- Navigation handled by href -->
  />

  <!-- Search Overlay -->
  <SearchForm
    isOpen={searchModal.isOpen}
    searchQuery={searchModal.query}
    onClose={searchModal.close}
    onSearch={handleSearch}
  />
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
  @media (max-width: 768px) {
    .container {
      padding: 0 1.5rem;
    }
  }
</style>
