<script>
  import { onMount } from 'svelte';
  
  let { 
    message = "Loading amazing experience...",
    showProgress = true,
    storageKey = "app_first_visit"
  } = $props();
  
  let progress = $state(0);
  let isVisible = $state(false);
  let isFirstVisit = $state(true);
  
  onMount(() => {
    // Skontrolovať či je to prvá návšteva
    const hasVisited = localStorage.getItem(storageKey);
    
    if (!hasVisited) {
      isVisible = true;
      isFirstVisit = true;
      
      // Spustiť načítavanie
      const interval = setInterval(() => {
        if (progress < 100) {
          progress += Math.random() * 15;
          if (progress > 100) progress = 100;
        } else {
          clearInterval(interval);
          
          // Označiť ako navštívené a skryť loader
          localStorage.setItem(storageKey, 'true');
          setTimeout(() => {
            isVisible = false;
          }, 500);
        }
      }, 200);
      
      return () => clearInterval(interval);
    } else {
      isFirstVisit = false;
    }
  });
</script>

{#if isVisible}
  <div class="page-loader">
    <!-- Animated background -->
    <div class="loader-bg">
      <div class="particle particle-1"></div>
      <div class="particle particle-2"></div>
      <div class="particle particle-3"></div>
    </div>
    
    <!-- Content -->
    <div class="loader-content">
      <div class="loader-icon">
        <div class="logo-shape">
          <div class="inner-glow"></div>
        </div>
      </div>
      
      <p class="loader-message">
        {#if isFirstVisit}
          {message}
        {:else}
          Welcome back!
        {/if}
      </p>
      
      {#if showProgress}
        <div class="progress-container">
          <div class="progress-bar">
            <div 
              class="progress-fill" 
              style="width: {progress}%"
            ></div>
          </div>
          <span class="progress-text">{Math.round(progress)}%</span>
        </div>
      {/if}
    </div>
  </div>
{/if}

<style>
  .page-loader {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: #0f172a;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999;
    transition: opacity 0.5s ease;
  }
  
  .loader-bg {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
  }
  
  .particle {
    position: absolute;
    border-radius: 50%;
    background: linear-gradient(135deg, #6366f1, #8b5cf6);
    animation: float 6s infinite ease-in-out;
  }
  
  .particle-1 {
    width: 100px;
    height: 100px;
    top: 20%;
    left: 10%;
    animation-delay: 0s;
    opacity: 0.3;
  }
  
  .particle-2 {
    width: 150px;
    height: 150px;
    top: 60%;
    right: 10%;
    animation-delay: 2s;
    opacity: 0.2;
  }
  
  .particle-3 {
    width: 80px;
    height: 80px;
    bottom: 20%;
    left: 20%;
    animation-delay: 4s;
    opacity: 0.4;
  }
  
  @keyframes float {
    0%, 100% {
      transform: translateY(0) rotate(0deg);
    }
    33% {
      transform: translateY(-20px) rotate(120deg);
    }
    66% {
      transform: translateY(10px) rotate(240deg);
    }
  }
  
  .loader-content {
    text-align: center;
    z-index: 10;
  }
  
  .loader-icon {
    margin-bottom: 2rem;
  }
  
  .logo-shape {
    width: 80px;
    height: 80px;
    margin: 0 auto;
    background: linear-gradient(135deg, #6366f1, #8b5cf6);
    border-radius: 20px;
    position: relative;
    animation: pulse 2s infinite ease-in-out;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  
  .inner-glow {
    width: 40px;
    height: 40px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 10px;
    animation: glow 2s infinite alternate;
  }
  
  @keyframes pulse {
    0%, 100% {
      transform: scale(1);
      box-shadow: 0 0 20px rgba(99, 102, 241, 0.4);
    }
    50% {
      transform: scale(1.1);
      box-shadow: 0 0 30px rgba(99, 102, 241, 0.6);
    }
  }
  
  @keyframes glow {
    0% {
      opacity: 0.3;
    }
    100% {
      opacity: 0.7;
    }
  }
  
  .loader-message {
    color: white;
    font-size: 1.125rem;
    margin-bottom: 2rem;
    opacity: 0.9;
  }
  
  .progress-container {
    display: flex;
    align-items: center;
    gap: 1rem;
    max-width: 300px;
    margin: 0 auto;
  }
  
  .progress-bar {
    flex: 1;
    height: 4px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 2px;
    overflow: hidden;
  }
  
  .progress-fill {
    height: 100%;
    background: linear-gradient(90deg, #6366f1, #8b5cf6);
    border-radius: 2px;
    transition: width 0.3s ease;
  }
  
  .progress-text {
    color: white;
    font-size: 0.875rem;
    font-weight: 600;
    min-width: 40px;
  }
</style>
