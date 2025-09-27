<script>
  import type { MobileMenuProps } from '$types/ui';
  import Navigation from './Navigation.svelte';

  let { isOpen, navigation, currentRoute, onClose, onNavClick }: MobileMenuProps = $props();
</script>

{#if isOpen}
  <div class="mobile-menu mobile-menu-container svelte-slide">
    <Navigation
      {navigation}
      {currentRoute}
      isMobile={true}
      onNavClick={(route) => {
        onNavClick(route);
        onClose();
      }}
    />
  </div>
{/if}

<style>
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

  .mobile-menu-container {
    /* Additional container styles if needed */
  }

  .svelte-slide {
    /* Slide animation styles - you can add transition classes here */
  }
</style>
