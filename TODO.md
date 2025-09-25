# TODO for Svelte 5 Deployment on Shared PHP Hosting

- [x] Review and adjust `frontend/svelte.config.js` for shared hosting compatibility
- [x] Verify build output paths and fallback settings
- [x] Create deployment instructions for building and deploying Svelte app to PHP server
- [x] Check PHP server routing (public/index.php) for serving SPA correctly
- [x] Optionally create or verify `.htaccess` for SPA routing on shared hosting
- [x] Test deployment on shared hosting environment (manual step: follow DEPLOYMENT.md and verify on your hosting)

# TODO for Fixing Location API Error

- [x] Edit frontend/src/App.svelte to replace window.location.reload() with targeted refresh and add debouncing
- [ ] Test the changes to confirm the error no longer occurs and articles refresh correctly

# TODO for Integrating Twig Render System

- [x] Install mezzio/mezzio-twigrenderer
- [x] Create Twig templates (layout/default.twig, app/home-page.twig, error/404.twig, error/error.twig, partials/components.twig)
- [x] Update config/prod.php to register TwigRendererFactory and Twig\Environment
- [x] Create HomePageRequestHandler and factory
- [x] Add / route to RoutesByNameFactory
- [x] Update public/index.php to handle / with web app
- [x] Install laminas/laminas-diactoros for HtmlResponse
- [x] Remove csrf_token from layout
- [x] Test / endpoint renders Twig template as index home page
