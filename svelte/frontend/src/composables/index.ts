// src/composables/useToggle.ts
export function useToggle(initialValue = false) {
  let value = $state(initialValue);

  const toggle = () => {
    value = !value;
  };

  const setTrue = () => {
    value = true;
  };

  const setFalse = () => {
    value = false;
  };

  return {
    value: readonly(value),
    toggle,
    setTrue,
    setFalse
  };
}

// src/composables/useLocalStorage.ts
export function useLocalStorage<T>(key: string, defaultValue: T) {
  // Get initial value from localStorage or use default
  const stored = typeof window !== 'undefined' ? localStorage.getItem(key) : null;
  let value = $state<T>(stored ? JSON.parse(stored) : defaultValue);

  // Sync with localStorage whenever value changes
  $effect(() => {
    if (typeof window !== 'undefined') {
      localStorage.setItem(key, JSON.stringify(value));
    }
  });

  const setValue = (newValue: T) => {
    value = newValue;
  };

  return {
    value: readonly(value),
    setValue
  };
}

// src/composables/useClickOutside.ts
export function useClickOutside(callback: (event: MouseEvent) => void) {
  let element = $state<HTMLElement | null>(null);

  const handleClick = (event: MouseEvent) => {
    if (element && !element.contains(event.target as Node)) {
      callback(event);
    }
  };

  $effect(() => {
    if (element) {
      document.addEventListener('click', handleClick);
      return () => document.removeEventListener('click', handleClick);
    }
  });

  return {
    element: readonly(element),
    setElement: (el: HTMLElement | null) => {
      element = el;
    }
  };
}

// src/composables/useSearch.ts
export function useSearch(initialQuery = '') {
  let query = $state(initialQuery);
  let isOpen = $state(false);
  let results = $state([]);
  let loading = $state(false);

  const open = () => {
    isOpen = true;
  };

  const close = () => {
    isOpen = false;
  };

  const toggle = () => {
    isOpen = !isOpen;
  };

  const setQuery = (newQuery: string) => {
    query = newQuery;
  };

  const search = async (searchQuery?: string) => {
    const searchTerm = searchQuery || query;
    if (!searchTerm.trim()) return;

    loading = true;
    try {
      // Replace with actual API call
      const response = await fetch(`/api/search?q=${encodeURIComponent(searchTerm)}`);
      const data = await response.json();
      results = data.results || [];
    } catch (error) {
      console.error('Search error:', error);
      results = [];
    } finally {
      loading = false;
    }
  };

  return {
    query: readonly(query),
    isOpen: readonly(isOpen),
    results: readonly(results),
    loading: readonly(loading),
    open,
    close,
    toggle,
    setQuery,
    search
  };
}

// src/composables/useAsyncData.ts
export function useAsyncData<T>(
  fetcher: () => Promise<T>,
  options: { immediate?: boolean } = {}
) {
  let data = $state<T | null>(null);
  let loading = $state(false);
  let error = $state<Error | null>(null);

  const { immediate = true } = options;

  const execute = async () => {
    loading = true;
    error = null;

    try {
      data = await fetcher();
    } catch (err) {
      error = err as Error;
      data = null;
    } finally {
      loading = false;
    }
  };

  if (immediate) {
    execute();
  }

  return {
    data: readonly(data),
    loading: readonly(loading),
    error: readonly(error),
    execute
  };
}

// src/composables/useDebounce.ts
export function useDebounce<T>(value: T, delay: number) {
  let debouncedValue = $state(value);

  let timeoutId: number;
  $effect(() => {
    clearTimeout(timeoutId);
    timeoutId = setTimeout(() => {
      debouncedValue = value;
    }, delay);
  });

  return readonly(debouncedValue);
}
