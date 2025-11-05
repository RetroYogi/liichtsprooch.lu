# Liichtsprooch.lu - Downloaded Website

This repository contains a local copy of the website https://liichtsprooch.lu

## Structure

- `Liicht Sprooch zu Lëtzebuerg.html` - Main HTML file
- `Liicht Sprooch zu Lëtzebuerg_files/` - Assets directory containing CSS and JavaScript files

## Viewing Locally

To view the website locally:
1. Open `Liicht Sprooch zu Lëtzebuerg.html` in a web browser
2. All local assets (CSS, JavaScript) are properly linked and will load correctly

## Deployment to New Domain

To deploy this website to a new domain:
1. Upload all files maintaining the directory structure
2. Ensure `Liicht Sprooch zu Lëtzebuerg_files/` is in the same directory as the HTML file
3. The website uses relative paths, so it will work on any domain

## Notes

- All JavaScript and CSS files that originally had `.download` extensions have been renamed to their proper extensions (`.js`, `.css`)
- HTML references have been updated to use the corrected filenames
- External images (from gamma.app, googleusercontent.com, etc.) are still referenced via absolute URLs
  - These images will load when online
  - For a fully offline version, these images would need to be manually downloaded and referenced locally
- The website uses relative paths (`./Liicht Sprooch zu Lëtzebuerg_files/...`) making it portable across domains

## Assets Included

- JavaScript files: 16 files (React framework, app bundles, polyfills, etc.)
- CSS files: 3 files (styles and fonts)
- Google Fonts: 3 font files (referenced via relative paths)

## External Resources

The following external resources are still loaded via absolute URLs:
- Images from gamma.app CDN
- Images from Google User Content
- Image proxy services (imgproxy.gamma.app)

If you need these resources available offline, they would need to be downloaded separately and the HTML updated accordingly.
