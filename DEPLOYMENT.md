# Deployment Guide for Svelte 5 on Shared PHP Hosting

This guide outlines the steps to build and deploy your Svelte 5 frontend application on a shared PHP hosting server.

## Prerequisites

- Node.js and npm/pnpm installed on your local machine
- Access to your shared PHP hosting server (FTP/SFTP or file manager)
- PHP server configured to serve files from the `public/` directory

## Build Steps

1. Navigate to the frontend directory:
   ```bash
   cd frontend
   ```

2. Install dependencies (if not already done):
   ```bash
   pnpm install
   ```

3. Build the Svelte application:
   ```bash
   pnpm run build
   ```

   This will generate static files in the `../public/build` directory.

## Deployment Steps

1. Upload the contents of the `public/` directory to your shared hosting's web root directory (usually `public_html/` or `www/`).

2. Ensure the following files are uploaded:
   - `public/index.php` (handles routing and serves static files)
   - `public/build/` directory (contains the built Svelte app)
   - Any other files in `public/` (e.g., `router.php` if present)

3. If your hosting supports `.htaccess` files, create or upload the following `.htaccess` file in the web root to enable SPA routing:

   ```
   RewriteEngine On
   RewriteBase /

   # Handle API routes
   RewriteRule ^api/(.*)$ - [L]

   # Handle static assets
   RewriteRule ^build/(.*)$ - [L]

   # Route everything else to index.php for SPA
   RewriteRule ^(.*)$ index.php [QSA,L]
   ```

## Verification

1. Access your website URL in a browser.
2. The Svelte app should load, and client-side routing should work.
3. API calls should be handled by your PHP backend (routes starting with `/api`).

## Troubleshooting

- If the app doesn't load, check that `public/build/index.html` exists and is accessible.
- For routing issues, ensure the `.htaccess` file is uploaded and enabled on your hosting.
- If assets don't load, verify the paths in `svelte.config.js` match your hosting setup.

## Notes

- The current configuration uses `@sveltejs/adapter-static` for static site generation.
- Prerendering is enabled for all routes to improve SEO and performance.
- The app is configured to work at the root path (`base: ''`). If deploying to a subdirectory, update the `base` path in `svelte.config.js`.
