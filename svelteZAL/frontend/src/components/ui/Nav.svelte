<script lang="ts">
  import { Book, Wrench, Activity } from 'lucide-svelte';
</script>

<nav class="bg-gray-900 text-white">
  <div class="mx-auto max-w-6xl px-4 py-3 flex items-center justify-between">
    <a href="/" class="flex items-center gap-2 font-semibold tracking-tight">
      <span class="inline-block w-6 h-6 rounded bg-emerald-500"></span>
      <span>Mezzio</span>
    </a>
    <ul class="flex items-center gap-6 text-sm">
      <li>
        <a href="https://docs.mezzio.dev/mezzio" target="_blank" class="flex items-center gap-2 hover:text-emerald-400">
          <Book size={18} />
          <span>Docs</span>
        </a>
      </li>
      <li>
        <a href="https://github.com/mezzio/mezzio" target="_blank" class="flex items-center gap-2 hover:text-emerald-400">
          <Wrench size={18} />
          <span>Contribute</span>
        </a>
      </li>
      <li>
        <a href="/api/ping" class="flex items-center gap-2 hover:text-emerald-400">
          <Activity size={18} />
          <span>Ping Test</span>
        </a>
      </li>
    </ul>
  </div>
</nav>
