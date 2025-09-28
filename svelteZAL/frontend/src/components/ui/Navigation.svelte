<script>
  import type { NavigationItem } from '$types/ui';

  interface Props {
    navigation: NavigationItem[];
    currentRoute: string;
    isMobile?: boolean;
    onNavClick?: (route: string) => void;
  }

  let { navigation, currentRoute, isMobile = false, onNavClick }: Props = $props();

  const baseClasses = isMobile
    ? 'mobile-nav'
    : 'desktop-nav';

  const linkClasses = isMobile
    ? 'mobile-nav-link'
    : 'nav-link';
</script>

<nav class={baseClasses}>
  {#each navigation as item}
    <a
      href={item.href}
      class={`${linkClasses} ${currentRoute === item.route ? 'active' : ''}`}
      onclick={() => onNavClick?.(item.route)}
    >
      {item.name}
    </a>
  {/each}
</nav>

<style>
  .desktop-nav {
    display: flex;
    align-items: center;
    gap: 2rem;
  }

  .nav-link {
    color: rgba(255, 255, 255, 0.8);
    text-decoration: none;
    font-weight: 500;
    transition: color 0.2s ease;
    position: relative;
  }

  .nav-link:hover,
  .nav-link.active {
    color: #ffffff;
  }

  .nav-link.active::after {
    content: '';
    position: absolute;
    bottom: -8px;
    left: 0;
    right: 0;
    height: 2px;
    background: #ffffff;
    border-radius: 1px;
  }

  .mobile-nav {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
    display: flex;
    flex-direction: column;
    gap: 1rem;
  }

  .mobile-nav-link {
    color: rgba(255, 255, 255, 0.8);
    text-decoration: none;
    font-weight: 500;
    padding: 0.75rem 0;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    transition: color 0.2s ease;
  }

  .mobile-nav-link:hover,
  .mobile-nav-link.active {
    color: #ffffff;
  }

  @media (max-width: 768px) {
    .desktop-nav {
      display: none;
    }
  }
</style>
