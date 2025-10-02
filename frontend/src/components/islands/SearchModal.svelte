<script>
  import { onMount } from 'svelte';
  
  let { isOpen, searchQuery, onClose, onSearch } = $props();
  let searchInput = $state(); // ✅ Pridané $state
  
  function handleSubmit(event) {
    event.preventDefault();
    onSearch?.(searchQuery);
  }
  
  function handleOverlayClick(event) {
    if (event.target === event.currentTarget) {
      onClose?.();
    }
  }
  
  function handleKeydown(event) {
    if (event.key === 'Escape') {
      onClose?.();
    }
  }
  
  onMount(() => {
    if (isOpen && searchInput) {
      searchInput.focus();
    }
  });
</script>

{#if isOpen}
  <div 
    class="search-overlay" 
    onclick={handleOverlayClick} 
    onkeydown={handleKeydown}
    role="dialog"
    aria-modal="true"
    aria-label="Search dialog"
    tabindex="0"
  >
    <div class="search-modal" role="document">
      <form onsubmit={handleSubmit} class="search-form">
        <div class="search-input-container">
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
          <input
            type="search"
            placeholder="Search..."
            class="search-input"
            bind:value={searchQuery}
            bind:this={searchInput}
            aria-label="Search input"
          />
          <button 
            type="button" 
            onclick={onClose} 
            class="search-close"
            aria-label="Close search"
          >
            <svg 
              width="20" 
              height="20" 
              viewBox="0 0 24 24" 
              fill="none" 
              stroke="currentColor" 
              stroke-width="2"
              aria-hidden="true"
            >
              <path d="M18 6L6 18M6 6l12 12"/>
            </svg>
          </button>
        </div>
      </form>
    </div>
  </div>
{/if}

<style>
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
  }
  
  .search-input {
    flex: 1;
    border: none;
    outline: none;
    font-size: 1.125rem;
  }
  
  .search-close {
    background: none;
    border: none;
    color: #6b7280;
    cursor: pointer;
    padding: 0.25rem;
  }
</style>