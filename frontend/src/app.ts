// frontend/src/app.ts
import './styles/app.css';
import { mount } from 'svelte';

console.log('🚀 Boson PHP Svelte app starting...');

async function initializeApp() {
    try {
        console.log('🔧 Importing Hero component...');
        
        // Import Hero component
        const Hero = await import('./components/layout/Hero.svelte');
        console.log('✅ Hero component imported successfully');
        
        // Mount Hero component
        const heroRoot = document.getElementById('svelte-hero');
        if (heroRoot) {
            console.log('🎯 Found hero root element');
            
            mount(Hero.default, {
                target: heroRoot,
                props: {
                    title: "Go Native. Stay PHP.",
                    subtitle: "Turn your PHP project into cross-platform, compact, fast, native applications for Windows, Linux and macOS.",
                    primaryButton: { text: 'Try For Free', url: '/docs/latest/installation' },
                    secondaryButton: { text: 'Download Now', url: '/download' }
                }
            });
            
            console.log('✅ Hero component mounted successfully!');
        } else {
            console.error('❌ Hero root element not found');
        }
        
    } catch (error) {
        console.error('❌ Error initializing Svelte app:', error);
        
        // Fallback: Show error message
        const heroRoot = document.getElementById('svelte-hero');
        if (heroRoot) {
            heroRoot.innerHTML = `
                <div style="background: #667eea; color: white; padding: 4rem; text-align: center;">
                    <h1>Go Native. Stay PHP.</h1>
                    <p>Turn your PHP project into cross-platform native applications</p>
                    <div style="margin-top: 2rem;">
                        <a href="/docs/latest/installation" style="background: white; color: #667eea; padding: 1rem 2rem; border-radius: 4px; text-decoration: none; margin: 0 0.5rem;">
                            Try For Free
                        </a>
                        <a href="/download" style="border: 2px solid white; color: white; padding: 1rem 2rem; border-radius: 4px; text-decoration: none; margin: 0 0.5rem;">
                            Download Now
                        </a>
                    </div>
                </div>
            `;
        }
    }
}

// Start the app when DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initializeApp);
} else {
    initializeApp();
}

console.log('📋 Svelte app script loaded');