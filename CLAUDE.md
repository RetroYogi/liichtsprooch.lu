# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is a documentation and website project for **Liicht Sprooch zu Lëtzebuerg** (Easy Language in Luxembourg). The project contains:

1. A static website for GitHub Pages promoting and explaining Liicht Sprooch (Easy Language) in Luxembourg
2. Research materials and information about Liicht Sprooch from various sources
3. Articles written in Luxembourgish for the liichtsprooch.lu website

**Language Context:** All content is primarily in Luxembourgish (Lëtzebuergesch), with references to German (Leichte Sprache) and French (FALC - Facile à lire et à comprendre). Liicht Sprooch is a simplified form of language designed to help people with reading or comprehension difficulties.

**Deployment:** The website is built as static HTML using a build script and deployed to GitHub Pages with automatic building via GitHub Actions.

## Repository Structure

```
/
├── liichtsprooch.lu/                # Git repository (deployed to GitHub Pages)
│   ├── Source Files (edit these):
│   │   ├── config.php               # Article metadata & site configuration
│   │   ├── build.php                # Static site generator script
│   │   ├── templates/               # HTML templates for generation
│   │   ├── assets/
│   │   │   ├── styles.css           # Modern CSS with WCAG compliance
│   │   │   └── artikelen/           # Markdown article files
│   │   └── .github/workflows/       # GitHub Actions for auto-build
│   │
│   ├── Generated Files (auto-created by build.php):
│   │   └── docs/                    # Static HTML (GitHub Pages serves this)
│   │       ├── index.html
│   │       ├── artikel/
│   │       │   └── slug/index.html  # Path-like URLs
│   │       ├── assets/              # Copied from source
│   │       ├── rss.xml
│   │       └── CNAME                # Custom domain config
│   │
│   └── Documentation (for contributors, visible on GitHub):
│       ├── README.md                # Main repository documentation
│       ├── START_HERE.md            # Entry point for new contributors
│       ├── HOW_TO_EDIT.md           # Instructions for content editors
│       ├── HTML_EMBEDS.md           # How to embed HTML in articles
│       └── SECURITY.md              # Security documentation
│
├── Owner Documentation (private, not in Git):
│   ├── DEPLOY.md                    # Initial deployment instructions
│   ├── NEXT_STEPS.txt               # Quick deployment steps
│   └── SECURITY-FIXES-2025-01-09.md # Historical security fixes record
│
├── liichtsprooch.lu website old/    # Original Gamma-generated website (archived)
│   ├── index.html                   # Legacy bloated HTML (386KB)
│   └── assets/                      # Legacy assets (18MB)
│
└── Information about Liicht Sprooch/ # Research and reference materials
    └── [Various .md files with background research]
```

**Note:** The `liichtsprooch.lu/` folder is now a Git repository pushed to GitHub. When the user refers to "the website", they mean the `liichtsprooch.lu/` folder (previously called "liichtsprooch.lu website new/").

## Website Architecture

### Current Website ("liichtsprooch.lu/")

A static site generator that builds HTML for GitHub Pages deployment:

**Key Technical Features:**
- **Static HTML Generation:** PHP build script generates all pages at build-time
- **Path-like URLs:** `/artikel/slug-name/` using directories with `index.html` files
- **GitHub Pages Compatible:** No server-side PHP required in production
- **Automatic Deployment:** GitHub Actions builds site on every push
- **Semantic HTML5:** Proper structure with `<main>`, `<section>`, `<article>`, `<footer>` elements
- **WCAG 2.1 AA Compliant:** Tested color contrast, keyboard navigation, screen reader support
- **Responsive Design:** Mobile-first approach with breakpoints at 640px (tablet), 1024px (desktop)
- **Modern CSS:** Uses CSS Grid, Flexbox, custom properties, `clamp()` for fluid typography

**Design System:**
- Primary Accent: `#26A688` (Teal/Green)
- Text Color: `#333F70` (Dark Blue)
- Background: `#ffffff` (White)
- Light Background: `#f8f9fa`
- Headings: Unbounded (Google Fonts)
- Body: Open Sans (Google Fonts)
- Base font size: 16px
- Line height: 1.7 (body), 1.3 (headings)

**Build Process:**
- Source: Markdown articles in `assets/artikelen/`
- Build: `php build.php` generates static HTML in `docs/`
- Deploy: GitHub Actions automatically runs build on push
- Hosting: GitHub Pages serves from `docs/` folder
- Total generated size: 2.8 MB (31 files)

### Running the Website Locally

```bash
# Build the static site
cd liichtsprooch.lu
php build.php

# Preview locally
cd docs
php -S localhost:8000

# Visit http://localhost:8000 in your browser
```

**Note:** PHP 7.4+ is only needed for building, not for production (GitHub Pages serves static HTML).

## Content Guidelines

When working with content in this repository:

1. **Language:** Content is in Luxembourgish. Be aware of special characters: ä, ë, é, ü, etc.
2. **Terminology Consistency:**
   - Luxembourgish: Liicht Sprooch
   - German: Leichte Sprache
   - French: FALC (Facile à lire et à comprendre)
3. **Key Organizations:**
   - Klaro - Official center for Liicht Sprooch (part of APEMH)
   - CDI (Centre de Documentation et d'Information sur le handicap)
   - Atelier Isie - Workshop for Liicht Sprooch
   - Accessilingua - Language accessibility service

## Editing the Website

**The user typically refers to "liichtsprooch.lu/" when they say "the website".**

### For Content (Articles)

Edit markdown files and metadata, then the site auto-rebuilds:

1. **Add/Edit Articles:** Edit markdown files in `assets/artikelen/`
2. **Update Metadata:** Edit `config.php` to add article info
3. **Build Site:** Run `php build.php` OR push to GitHub (auto-builds via GitHub Actions)
4. **Generated Output:** Static HTML appears in `docs/` folder

### For Design/Layout

1. **Templates:** Edit files in `templates/` folder
2. **Styles:** Edit `assets/styles.css`
3. **Build Script:** Modify `build.php` if needed
4. **Images:** Add to `assets/` (auto-copied to `docs/assets/` during build)

### Collaboration Workflow

**Simple:** Anyone can edit markdown files on GitHub.com and push changes. GitHub Actions automatically:
1. Runs `php build.php`
2. Generates `docs/` folder
3. Commits and deploys to GitHub Pages
4. Site is live in 2 minutes

**Nobody needs PHP installed to contribute articles.**

**Accessibility Requirements When Editing:**
- Maintain WCAG 2.1 AA compliance
- Keep color contrast ratios for text (#333F70 on #ffffff)
- Ensure all interactive elements are keyboard accessible
- Use semantic HTML elements
- Provide alt text for images (or `role="presentation"` for decorative images)
- Test with `prefers-reduced-motion` and `prefers-contrast: high`

## Common Tasks

### Adding a New Article

**Step 1:** Create the Markdown file in `/assets/artikelen/`:

```bash
cd "/assets/artikelen/"
# Create your new article as a .md file (e.g., "Neien Artikel.md")
```

**Step 2:** Add article metadata to `config.php`:

```php
[
    'slug' => 'neien-artikel',
    'title' => 'Your Article Title',
    'description' => 'SEO-optimized description (150-160 characters)',
    'category' => 'Organisatiounen', // or other category
    'date' => '2025-01-XX',
    'markdown_file' => '/assets/artikelen/Neien Artikel.md',
    'author' => 'Liicht Sprooch Team'
],
```

The article will automatically appear:
- In the navigation dropdown (under its category)
- On the homepage (if it's among the 6 most recent)
- In the RSS feed

### Rebuilding the Site

```bash
# After editing any source files, rebuild:
cd liichtsprooch.lu
php build.php

# This regenerates the docs/ folder with updated static HTML
```

### Modifying Website Content

```bash
# Edit the homepage template
open liichtsprooch.lu/templates/homepage-content.php

# Edit article configuration
open liichtsprooch.lu/config.php

# Edit styles
open liichtsprooch.lu/assets/styles.css

# After any changes, rebuild:
php build.php
```

### Adding New Visual Assets

```bash
# Add images to assets folder
cp new-image.png liichtsprooch.lu/assets/

# Optimize images before adding (recommended)
# Use tools like ImageOptim, TinyPNG, or similar

# Rebuild to copy to docs/
php build.php
```

## Important Notes

- **GitHub Pages Ready:** Built for deployment to GitHub Pages with automatic builds
- **Static Site Generator:** PHP build script (build-time only, not needed in production)
- **No Database:** All content is file-based (Markdown articles)
- **Parsedown Library:** Uses Parsedown (open-source) to convert Markdown to HTML during build
- **Minimal JavaScript:** Only uses JavaScript for mobile navigation menu (progressive enhancement)
- **GitHub Actions:** Automatically builds and deploys on every push to GitHub
- **Path-like URLs:** `/artikel/slug-name/` using directory structure with `index.html` files
- **Legacy Code:** The "old" website folder is kept for reference but should not be modified
- **Print-Friendly:** The CSS includes print styles for physical document generation
- **RSS Feed:** Automatically generated at `/rss.xml` with the 20 most recent articles

## Website Architecture (Static Site Structure)

### File Structure
```
liichtsprooch.lu/
├── Source Files (edit these):
│   ├── config.php              # Article metadata & site config
│   ├── build.php               # Static site generator script
│   ├── Parsedown.php           # Markdown parser (v1.7.4)
│   ├── HtmlEmbed.php           # HTML embed handler
│   ├── templates/              # HTML templates
│   │   ├── static-header.php
│   │   ├── static-footer.php
│   │   ├── homepage-content.php
│   │   └── article-content.php
│   ├── assets/
│   │   ├── styles.css          # Main stylesheet
│   │   ├── artikelen/          # Markdown article source files
│   │   └── *.png, *.svg        # Images and icons
│   └── .github/workflows/
│       └── build-and-deploy.yml # GitHub Actions auto-build
│
├── Documentation (for contributors):
│   ├── README.md               # Main repository documentation
│   ├── START_HERE.md           # Entry point for new contributors
│   ├── HOW_TO_EDIT.md          # Instructions for content editors
│   ├── HTML_EMBEDS.md          # How to embed HTML in articles
│   └── SECURITY.md             # Security documentation
│
└── Generated Files (auto-created by build.php):
    └── docs/                   # GitHub Pages serves this folder
        ├── index.html
        ├── artikel/
        │   └── slug/index.html # Each article in own directory
        ├── assets/             # Copied from source
        ├── rss.xml
        ├── 404.html
        └── CNAME               # Custom domain configuration
```

### How It Works

1. **Build Process (`build.php`):**
   - Reads all articles from `config.php`
   - Processes Markdown files using Parsedown
   - Generates static HTML using templates
   - Creates directory structure with `index.html` files for path-like URLs
   - Copies all assets to `docs/` folder
   - Generates RSS feed as static XML file

2. **GitHub Actions Workflow:**
   - Triggers on push when source files change
   - Runs `php build.php` automatically
   - Commits generated `docs/` folder
   - GitHub Pages deploys from `docs/` folder
   - Site is live in 2 minutes

3. **URL Structure:**
   - Homepage: `/` → `docs/index.html`
   - Articles: `/artikel/slug-name/` → `docs/artikel/slug-name/index.html`
   - RSS Feed: `/rss.xml` → `docs/rss.xml`
   - No query strings, no server-side processing needed

4. **Templates:**
   - Separate PHP template files generate each page type
   - Templates include navigation, metadata, article content
   - All PHP code runs at build-time, not runtime

## Responsive Breakpoints

When modifying layouts, use these breakpoints consistently:

- Mobile: < 640px (1 column layouts)
- Small Tablet: 640px (2 column layouts)
- Tablet: 768px
- Desktop: 1024px (3-4 column layouts)
- Wide Desktop: 1200px (max-width container)

## Accessibility Testing Checklist

When making changes to the website:

- [ ] Test keyboard navigation (Tab, Shift+Tab, Enter, Space)
- [ ] Verify focus indicators are visible on all interactive elements
- [ ] Check color contrast with WebAIM Contrast Checker
- [ ] Test with screen reader (VoiceOver on macOS)
- [ ] Verify responsive design on mobile, tablet, desktop
- [ ] Test with `prefers-reduced-motion: reduce`
- [ ] Validate HTML with W3C Validator (test generated HTML in `docs/`)
- [ ] Check proper heading hierarchy (h1 → h2 → h3)

## Documentation Files

### In Git Repository (liichtsprooch.lu/ - visible on GitHub)
These files are for contributors and are checked into the repository:
- **README.md** - Main repository documentation for all users
- **START_HERE.md** - Entry point for new contributors
- **COLLABORATION_INSTRUCTIONS.md** - Instructions for content editors (non-technical)
- **HTML_EMBEDS.md** - How to safely embed HTML/videos in articles
- **SECURITY.md** - Security documentation (public-facing)

### Outside Git (root folder - private)
These files are for the project owner only and NOT checked into Git:
- **DEPLOY.md** - Initial deployment instructions for GitHub Pages setup
- **NEXT_STEPS.txt** - Quick deployment steps for initial setup
- **SECURITY-FIXES-2025-01-09.md** - Historical record of security fixes applied

## Additional Context

- When the user asks to work on "a website" or "the website", they mean **"liichtsprooch.lu/"** (the Git repository)
- You may use images from `liichtsprooch.lu website old/assets/` in the new website
- The build script is PHP-based, but NO SQL database is used - all content is file-based
- The content of the website is written in Luxembourgish, with some terms and quotes in other languages
- After editing source files, remind the user to run `php build.php` to regenerate the static site
- When deployed to GitHub, GitHub Actions automatically runs the build script on every push
- The repository is now initialized with Git and pushed to GitHub