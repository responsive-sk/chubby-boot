<script>
  let { 
    title = "Welcome to Our Platform",
    subtitle = "Build amazing experiences with modern web technologies",
    ctaText = "Get Started",
    ctaLink = "/get-started"
  } = $props();
</script>

<section class="hero-section">
  <div class="hero-content">
    <h1 class="hero-title">{title}</h1>
    <p class="hero-subtitle">{subtitle}</p>
    
    <div class="hero-actions">
      <a href={ctaLink} class="hero-cta">
        {ctaText}
      </a>
    </div>
  </div>
</section>

<style>
  .hero-section {
    min-height: 80vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
    color: white;
    text-align: center;
    padding: 4rem 2rem;
  }
  
  .hero-title {
    font-size: 3.5rem;
    font-weight: 800;
    margin-bottom: 1.5rem;
    line-height: 1.2;
  }
  
  .hero-subtitle {
    font-size: 1.25rem;
    margin-bottom: 2.5rem;
    opacity: 0.9;
    max-width: 600px;
    line-height: 1.6;
  }
  
  .hero-cta {
    display: inline-block;
    padding: 0.75rem 2rem;
    background: #6366f1;
    color: white;
    text-decoration: none;
    border-radius: 0.5rem;
    font-weight: 600;
    transition: background-color 0.3s ease;
  }
  
  .hero-cta:hover {
    background: #5b5cdd;
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