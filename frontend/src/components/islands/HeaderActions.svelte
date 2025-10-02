<script>
  let mobileMenuOpen = $state(false);
  let searchModalOpen = $state(false);
  
  // Funkcie na ovládanie
  function toggleSearch() {
    searchModalOpen = !searchModalOpen;
    
    if (searchModalOpen) {
      // Dispatch custom event pre SearchModal
      document.dispatchEvent(new CustomEvent('openSearchModal'));
    } else {
      document.dispatchEvent(new CustomEvent('closeSearchModal'));
    }
  }
  
  function toggleMobileMenu() {
    mobileMenuOpen = !mobileMenuOpen;
    
    if (mobileMenuOpen) {
      // Dispatch custom event pre MobileMenu
      document.dispatchEvent(new CustomEvent('openMobileMenu'));
    } else {
      document.dispatchEvent(new CustomEvent('closeMobileMenu'));
    }
  }
  
  // Zatvoriť mobile menu pri kliknutí mimo (voliteľné)
  function handleClickOutside(event) {
    // Implementácia click outside ak je potrebná
  }
</script>

<div class="header-actions">
  <!-- Search Toggle -->
  <button 
    class="action-btn" 
    onclick={toggleSearch} 
    aria-label="Search"
    aria-expanded={searchModalOpen}
  >
    <svg 
      width="20" 
      height="20" 
      viewBox="0 0 24 24" 
      fill="none" 
      stroke="currentColor"
      aria-hidden="true"
    >
      <circle cx="11" cy="11" r="8"/>
      <path d="m21 21-4.35-4.35"/>
    </svg>
  </button>
  
  <!-- Mobile Menu Toggle -->
  <button 
    class="action-btn mobile-menu-toggle" 
    onclick={toggleMobileMenu} 
    aria-label="Menu"
    aria-expanded={mobileMenuOpen}
  >
    <div class="hamburger {mobileMenuOpen ? 'open' : ''}">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </button>
</div>

<style>
  .header-actions {
    display: flex;
    align-items: center;
    gap: 1rem;
  }
  
  .action-btn {
    background: none;
    border: none;
    color: white;
    padding: 0.5rem;
    border-radius: 0.375rem;
    cursor: pointer;
    transition: background-color 0.2s;
  }
  
  .action-btn:hover {
    background: rgba(255, 255, 255, 0.1);
  }
  
  .hamburger {
    display: flex;
    flex-direction: column;
    gap: 3px;
  }
  
  .hamburger span {
    width: 20px;
    height: 2px;
    background: currentColor;
    transition: transform 0.3s;
  }
  
  .hamburger.open span:nth-child(1) {
    transform: rotate(45deg) translate(5px, 5px);
  }
  
  .hamburger.open span:nth-child(2) {
    opacity: 0;
  }
  
  .hamburger.open span:nth-child(3) {
    transform: rotate(-45deg) translate(7px, -6px);
  }
</style>