# Local Testing Guide

This folder contains the static build of the Liicht Sprooch website for GitHub Pages.

## Testing Locally

To test the static site locally with proper URL routing (matching GitHub Pages behavior):

```bash
cd docs
php -S localhost:8000 router.php
```

Then visit:
- Homepage: http://localhost:8000
- Articles: http://localhost:8000/artikel/klaro-am-detail
- About: http://localhost:8000/about

### Why the router?

GitHub Pages automatically serves `index.html` files for directory requests. The PHP built-in server doesn't do this by default. The `router.php` script replicates GitHub Pages' behavior locally.

### Without the router

If you run `php -S localhost:8000` without the router script, you'll need to access URLs with trailing slashes or explicit `/index.html`:
- http://localhost:8000/artikel/klaro-am-detail/ (with slash)
- http://localhost:8000/artikel/klaro-am-detail/index.html (explicit)

## Note

The router.php file is only for local development and is not used on GitHub Pages.
