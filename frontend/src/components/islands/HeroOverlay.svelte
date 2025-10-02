<script>
  let { 
    title = "Welcome to Our Platform",
    subtitle = "Build amazing experiences with modern web technologies",
    ctaText = "Get Started",
    ctaLink = "/get-started"
  } = $props();
  
  let scrollProgress = $state(0);
  
  function handleScroll() {
    const scrolled = window.pageYOffset;
    const windowHeight = window.innerHeight;
    scrollProgress = Math.min(scrolled / windowHeight, 1);
  }
  
  $effect(() => {
    window.addEventListener('scroll', handleScroll);
    return () => window.removeEventListener('scroll', handleScroll);
  });
</script>

<div class="hero-overlay">
  <!-- Animated background -->
  <div 
    class="hero-bg" 
    style="opacity: {1 - scrollProgress * 0.5}; transform: scale({1 + scrollProgress * 0.1})"
  ></div>
  
  <!-- Content -->
  <div 
    class="hero-content" 
    style="opacity: {1 - scrollProgress}; transform: translateY({scrollProgress * 50}px)"
  >
    <h1 class="hero-title">{title}</h1>
    <p class="hero-subtitle">{subtitle}</p>
    
    <div class="hero-actions">
      <a 
        href={ctaLink} 
        class="hero-cta"
        onmouseenter={(e) => e.target.style.transform = 'scale(1.05)'}
        onmouseleave={(e) => e.target.style.transform = 'scale(1)'}
      >
        {ctaText}
      </a>
    </div>
  </div>
  
  <!-- Scroll indicator -->
  <div 
    class="scroll-indicator" 
    style="opacity: {1 - scrollProgress * 2}"
  >
    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor">
      <path d="M12 5v14M5 12l7 7 7-7"/>
    </svg>
  </div>
</div>

<style>
  .hero-overlay {
    position: relative;
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    color: white;
  }
  
  .hero-bg {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: 
      radial-gradient(ellipse at 20% 50%, rgba(120, 119, 198, 0.3) 0%, transparent 50%),
      radial-gradient(ellipse at 80% 20%, rgba(255, 119, 198, 0.2) 0%, transparent 50%),
      radial-gradient(ellipse at 40% 80%, rgba(120, 219, 255, 0.2) 0%, transparent 50%);
    background-color: #0f172a;
    transition: all 0.1s ease;
  }
  
  .hero-content {
    text-align: center;
    z-index: 10;
    transition: all 0.2s ease;
  }
  
  .hero-title {
    font-size: 3.5rem;
    font-weight: 800;
    margin-bottom: 1.5rem;
    background: linear-gradient(135deg, #ffffff 0%, #a5b4fc 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
  }
  
  .hero-subtitle {
    font-size: 1.25rem;
    margin-bottom: 2.5rem;
    opacity: 0.9;
    max-width: 600px;
  }
  
  .hero-cta {
    display: inline-block;
    padding: 0.75rem 2rem;
    background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
    color: white;
    text-decoration: none;
    border-radius: 0.5rem;
    font-weight: 600;
    transition: all 0.3s ease;
    box-shadow: 0 4px 14px 0 rgba(99, 102, 241, 0.3);
  }
  
  .hero-cta:hover {
    box-shadow: 0 6px 20px 0 rgba(99, 102, 241, 0.4);
    transform: scale(1.05);
  }
  
  .scroll-indicator {
    position: absolute;
    bottom: 2rem;
    left: 50%;
    transform: translateX(-50%);
    animation: bounce 2s infinite;
  }
  
  @keyframes bounce {
    0%, 20%, 50%, 80%, 100% {
      transform: translateX(-50%) translateY(0);
    }
    40% {
      transform: translateX(-50%) translateY(-10px);
    }
    60% {
      transform: translateX(-50%) translateY(-5px);
    }
  }
  
  @media (max-width: 768px) {
    .hero-title {
      font-size: 2.5rem;
    }
    
    .hero-subtitle {
      font-size: 1.125rem;
    }
  }
</style>