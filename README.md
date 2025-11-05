# Liichtsprooch.lu - Downloaded Website

This repository contains a local copy of the website https://liichtsprooch.lu with all essential assets downloaded and working offline.

**🌐 Live Site:** Once GitHub Pages is enabled, this site will be available at:
`https://retroyogi.github.io/liichtsprooch.lu/`

## Structure

```
/
├── Liicht Sprooch zu Lëtzebuerg.html   # Main HTML file
├── assets/                               # All assets (JS, CSS, images)
│   ├── *.js                             # 16 JavaScript files
│   ├── *.css                            # 3 CSS files
│   ├── css2, css2(1), css2(2)          # Google Fonts
│   ├── *.png                            # Content images
│   ├── *.svg                            # Icons
│   └── *.ico                            # Favicons
├── README.md                            # This file
├── EXTERNAL_RESOURCES.md                # Detailed list of external resources
└── images_to_download.txt               # List of image URLs (reference)
```

## Viewing Locally

To view the website locally:
1. Open `Liicht Sprooch zu Lëtzebuerg.html` in a web browser
2. All essential assets load from the local `assets/` folder
3. Works completely offline (except for optional theme background images)

## GitHub Pages Deployment

This repository is ready for GitHub Pages! To enable:

1. **Merge the Pull Request** (if not already merged):
   - Go to the GitHub repository
   - Navigate to "Pull requests"
   - Merge the pull request to `main` branch

2. **Enable GitHub Pages**:
   - Go to repository Settings → Pages
   - Under "Source", select branch: `main`
   - Keep folder as `/ (root)`
   - Click "Save"

3. **Access Your Site**:
   - Wait 1-2 minutes for deployment
   - Visit: `https://retroyogi.github.io/liichtsprooch.lu/`
   - The site will load `index.html` automatically

## Deployment to Other Hosting

To deploy this website to any other hosting service:
1. Upload all files maintaining the directory structure
2. Ensure `assets/` folder is in the same directory as the HTML file
3. The website uses relative paths (`./assets/...`), so it works on any domain
4. No configuration changes needed!

## What's Included

### Local Assets (36 files)
All essential resources are now local and work offline:

**JavaScript (16 files):**
- React framework and core bundles
- Application logic and components
- Polyfills and webpack runtime

**CSS & Fonts (6 files):**
- 3 CSS stylesheets
- 3 Google Fonts files (Open Sans, Unbounded)

**Images & Icons (14 files):**
- ✓ Main content images (3 generated PNG images)
- ✓ External content images (4 PNG images from klaro.lu, etc.)
- ✓ UI icons (4 SVG icons: arrow, chart, star, user)
- ✓ Favicons (3 favicons from external sites)

### External Resources (Optional)

**Theme Background Images (37 images):**
- Seafoam theme backgrounds remain as external URLs
- Load from CDN when online
- Not essential for website functionality
- Can be downloaded separately if needed (see `EXTERNAL_RESOURCES.md`)

**External Links:**
- Navigation links to external websites (klaro.lu, apemh.lu, etc.)
- These are intentional links and should remain external

## Changes Made

1. **Fixed File Extensions**
   - Renamed all `.download` files to proper extensions (`.js`, `.css`)

2. **Consolidated Assets**
   - Merged `Liicht Sprooch zu Lëtzebuerg_files/` and `downloaded_assets/` into single `assets/` folder
   - Cleaner structure, easier deployment

3. **Updated HTML References**
   - Changed 25 folder path references to `./assets/`
   - Replaced 28 absolute URLs with relative paths to local files
   - All local assets now load from `./assets/` directory

4. **Made Website Portable**
   - Uses relative paths throughout
   - Works locally without internet
   - Can be deployed to any domain without modifications

## File Size

- Total repository size: ~14 MB
- HTML file: 398 KB
- Assets folder: ~14 MB (mostly JavaScript bundles)

## Browser Compatibility

The website uses modern web technologies:
- React (JavaScript framework)
- CSS3 with custom properties
- SVG icons
- Google Fonts

Works in all modern browsers (Chrome, Firefox, Safari, Edge).

## Additional Documentation

- `EXTERNAL_RESOURCES.md` - Detailed categorization of all external resources
- `images_to_download.txt` - List of image URLs organized by priority

## License

Original content from https://liichtsprooch.lu - downloaded for archival/local use.
