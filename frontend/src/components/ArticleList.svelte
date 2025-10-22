<script lang="ts">
  import type { Article } from '../types/article';
  import ArticleCard from './ArticleCard.svelte';

  export let articles: Article[];
  export let emptyMessage: string = 'No articles found.';
</script>

<div id="articles-list" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
  {#each articles as article (article.id)}
    <ArticleCard {article} />
  {:else}
    <div class="col-span-3 text-center py-8">
      <p class="text-gray-500">{emptyMessage}</p>
    </div>
  {/each}
</div>
