<script>
  import { onMount } from 'svelte';
  import type { HeaderProps, NavigationItem } from '$types/ui';
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
  }: HeaderProps = $props();

  let mobileMenuOpen = $state(false);
  let searchOpen = $state(false);

  function toggleMobileMenu() {
    mobileMenuOpen = !mobileMenuOpen;
  }

  function toggleSearch() {
    searchOpen = !searchOpen;
  }

  function closeSearch() {
    searchOpen = false;
  }

  function handleSearch(query: string) {
    if (query) {
      window.location.href = `/search?q=${encodeURIComponent(query)}`;
    }
  }

  function handleMobileMenuClose() {
    mobileMenuOpen = false;
  }

  onMount(() => {
    // Close mobile menu when clicking outside
    function handleClickOutside(event: MouseEvent) {
      if (mobileMenuOpen && !(event.target as Element)?.closest('.mobile-menu-container')) {
        mobileMenuOpen = false;
      }
    }

    document.addEventListener('click', handleClickOutside);

    return () => {
      document.removeEventListener('click', handleClickOutside);
    };
  });
</script>

<header class="header svelte-component">
  <div class="container">
    <!-- Logo -->
    <Logo />

    <!-- Desktop Navigation -->
    <Navigation {navigation} {currentRoute} />

    <!-- Search & Mobile Menu Actions -->
    <HeaderActions
      {mobileMenuOpen}
      onSearchToggle={toggleSearch}
      onMobileMenuToggle={toggleMobileMenu}
    />
  </div>

  <!-- Mobile Navigation -->
  <MobileMenu
    {isOpen: mobileMenuOpen}
    {navigation}
    {currentRoute}
    onClose={handleMobileMenuClose}
    onNavClick={() => {}} <!-- Navigation handled by href */
  />

  <!-- Search Overlay -->
  <SearchForm
    isOpen={searchOpen}
    {searchQuery}
    onClose={closeSearch}
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
      padding: 0 1rem;
    }
  }
</style>
