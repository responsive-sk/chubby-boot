<script>
  import { onMount } from 'svelte';

  interface Props {
    isOpen: boolean;
    searchQuery: string;
    onClose: () => void;
    onSearch: (query: string) => void;
  }

  let { isOpen, searchQuery, onClose, onSearch }: Props = $props();
  let searchInput: HTMLInputElement;

  onMount(() => {
    if (isOpen && searchInput) {
      setTimeout(() => searchInput.focus(), 100);
    }
  });

  function handleSubmit(event: Event) {
    event.preventDefault();
    const formData = new FormData(event.target as HTMLFormElement);
    const query = formData.get('q') as string;
    if (query) {
      onSearch(query);
    }
  }

  function handleOverlayClick(event: MouseEvent) {
    if (event.target === event.currentTarget) {
      onClose();
    }
  }

  function handleKeydown(event: KeyboardEvent) {
    if (event.key === 'Escape') {
      onClose();
    }
  }
</script>

{#if isOpen}
  <div class="search-overlay" onclick={handleOverlayClick} on:keydown={handleKeydown}>
    <div class="search-modal" onclick={(e) => e.stopPropagation()}>
      <form on:submit={handleSubmit} class="search-form">
        <div class="search-input-container">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="11" cy="11" r="8"/>
            <path d="m21 21-4.35-4.35"/>
          </svg>
          <input
            bind:this={searchInput}
            type="search"
            name="q"
            placeholder="Search articles, docs..."
            class="search-input"
            value={searchQuery}
          />
          <button type="button" onclick={onClose} class="search-close">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
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
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-lg);
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
    border: 2px solid var(--border);
    border-radius: var(--radius-md);
    background: var(--bg-primary);
    transition: border-color 0.2s ease;
  }

  .search-input-container:focus-within {
    border-color: var(--primary);
  }

  .search-input {
    flex: 1;
    border: none;
    outline: none;
    font-size: 1.125rem;
    background: transparent;
    color: var(--text-primary);
  }

  .search-input::placeholder {
    color: var(--text-muted);
  }

  .search-close {
    background: none;
    border: none;
    color: var(--text-secondary);
    cursor: pointer;
    padding: 0.25rem;
    border-radius: var(--radius);
    transition: color 0.2s ease;
  }

  .search-close:hover {
    color: var(--text-primary);
  }
</style>
