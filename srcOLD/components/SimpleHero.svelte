<!-- frontend/src/components/SimpleHero.svelte -->
<script>
    export let title = "Test Title";
    export let subtitle = "Test Subtitle";
</script>

<div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 4rem; text-align: center;">
    <h1 style="font-size: 3rem; margin-bottom: 1rem;">{title}</h1>
    <p style="font-size: 1.25rem; margin-bottom: 2rem;">{subtitle}</p>
    <button style="background: white; color: #667eea; padding: 1rem 2rem; border: none; border-radius: 4px; font-size: 1rem;">
        Test Button
    </button>
</div>

<style>
    div {
        min-height: 50vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
</style>