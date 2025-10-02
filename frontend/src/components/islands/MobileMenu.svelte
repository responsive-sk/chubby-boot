<script>
  import Navigation from '../ui/Navigation.svelte';

  let { 
    navigation = []
  } = $props();
  
  let isOpen = $state(false);
  
  function openMenu() {
    isOpen = true;
  }
  
  function closeMenu() {
    isOpen = false;
  }
  
  function handleNavClick() {
    closeMenu();
  }
  
  // Event listeners pre komunikáciu s HeaderActions
  $effect(() => {
    function handleOpenMobileMenu() {
      openMenu();
    }
    
    function handleCloseMobileMenu() {
      closeMenu();
    }
    
    document.addEventListener('openMobileMenu', handleOpenMobileMenu);
    document.addEventListener('closeMobileMenu', handleCloseMobileMenu);
    
    return () => {
      document.removeEventListener('openMobileMenu', handleOpenMobileMenu);
      document.removeEventListener('closeMobileMenu', handleCloseMobileMenu);
    };
  });
  
  // Zatvoriť menu pri Escape key
  function handleKeydown(event) {
    if (event.key === 'Escape') {
      closeMenu();
    }
  }
  
  // Export funkcií
  $inspect({ openMenu, closeMenu });
</script>

{#if isOpen}
  <div 
    class="mobile-menu" 
    onkeydown={handleKeydown}
    role="dialog"
    aria-modal="true"
    aria-label="Mobile menu"
    tabindex="0"
  >
    <Navigation
      {navigation}
      currentRoute={window.location.pathname}
      isMobile={true}
      onNavClick={handleNavClick}
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
    z-index: 100;
  }
</style>