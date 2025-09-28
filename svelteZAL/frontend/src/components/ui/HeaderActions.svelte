<script>
  let { onSearchToggle, onMobileMenuToggle, mobileMenuOpen } = $props();
</script>

<div class="header-actions">
  <!-- Search Button -->
  <button 
    class="search-toggle btn-ghost"
    onclick={onSearchToggle}
    aria-label="Toggle search"
  >
    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
      <circle cx="11" cy="11" r="8"/>
      <path d="m21 21-4.35-4.35"/>
    </svg>
  </button>
  
  <!-- Mobile Menu Button -->
  <button 
    class="mobile-menu-toggle btn-ghost"
    onclick={onMobileMenuToggle}
    aria-label="Toggle mobile menu"
  >
    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
      {#if mobileMenuOpen}
        <path d="M18 6L6 18M6 6l12 12"/>
      {:else}
        <path d="M3 12h18M3 6h18M3 18h18"/>
      {/if}
    </svg>
  </button>
</div>

<style>
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
    border-radius: var(--radius);
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
  
  @media (max-width: 768px) {
    .mobile-menu-toggle {
      display: block;
    }
  }
</style>
