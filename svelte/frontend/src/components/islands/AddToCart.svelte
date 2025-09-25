<script>
  export let productId = '';
  let isLoading = false;
  let isAdded = false;

  async function addToCart() {
    isLoading = true;
    try {
      const response = await fetch('/api/cart/add', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ productId })
      });
      if (response.ok) {
        isAdded = true;
        // Notify other components
        window.dispatchEvent(new CustomEvent('cart:updated'));
      }
    } catch (error) {
      console.error('Failed to add to cart:', error);
    } finally {
      isLoading = false;
    }
  }
</script>

<button
  on:click={addToCart}
  disabled={isLoading || isAdded}
  class="px-4 py-2 rounded transition-all {isAdded ? 'bg-green-500 text-white' : 'bg-blue-500 text-white hover:bg-blue-600'} {isLoading ? 'opacity-50 cursor-not-allowed' : ''}"
>
  {#if isLoading}
    <span class="animate-pulse">Pridávam...</span>
  {:else if isAdded}
    ✓ Pridané
  {:else}
    Pridať do košíka
  {/if}
</button>
