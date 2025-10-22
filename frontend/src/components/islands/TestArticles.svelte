<script lang="ts">
  import ArticleList from '../ArticleList.svelte';
  import type { Article } from '../../types/article';

  // Mock data for testing
  const articles: Article[] = [
    {
      id: '1',
      createdAt: '2023-01-01T00:00:00Z',
      updatedAt: null,
      title: 'Sample Article 1',
      content: 'This is a sample article content. It has more than 150 characters to test the truncation feature. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
      tag: 'sample',
      image: null,
      category: { id: '1', name: 'Tech', image: null }
    },
    {
      id: '2',
      createdAt: '2023-01-02T00:00:00Z',
      updatedAt: null,
      title: 'Sample Article 2',
      content: 'Another sample article with shorter content.',
      tag: null,
      image: 'https://via.placeholder.com/400x200',
      category: null
    },
    {
      id: '3',
      createdAt: '2023-01-03T00:00:00Z',
      updatedAt: null,
      title: 'Sample Article 3',
      content: 'This article has a very long content that will definitely be truncated because it exceeds the 150 character limit for the snippet display. We want to ensure that the ellipsis is added correctly and the layout remains intact.',
      tag: 'long',
      image: null,
      category: { id: '2', name: 'News', image: null }
    }
  ];
</script>

<div class="container mx-auto py-8">
  <h1 class="text-2xl font-bold mb-6">Article Cards Template Test</h1>
  <ArticleList {articles} />
</div>
