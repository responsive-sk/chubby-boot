<script lang="ts">
  import type { Article } from '../types/article';

  export let article: Article;
</script>

<div class="border rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300">
  {#if article.image}
    <img src={article.image} alt={article.title} class="w-full h-48 object-cover" />
  {/if}
  <div class="p-6">
    <h3 class="text-xl font-semibold mb-2">{article.title}</h3>
    <p class="text-gray-600 mb-4">
      {article.content.length > 150 ? article.content.slice(0, 150) + '...' : article.content}
    </p>
    {#if article.category}
      <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">
        {article.category.name}
      </span>
    {/if}
  </div>
</div>
