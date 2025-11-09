# Liicht Sprooch zu Lëtzebuerg

A static website about Easy Language (Liicht Sprooch) in Luxembourg, built for GitHub Pages with automatic deployment.

🌐 **Live Site:** https://liichtsprooch.lu

---

## For Content Editors

**Want to add or edit an article?** Read **[HOW_TO_EDIT.md](HOW_TO_EDIT.md)**

**TL;DR:**
1. Edit markdown file on GitHub.com
2. Commit changes
3. Wait 2 minutes - automatically deployed!

No software installation needed. Works from any device.

---

## For Developers

### Quick Start

```bash
# Clone repository
git clone https://github.com/USERNAME/liichtsprooch.git
cd liichtsprooch

# Build static site
php build.php

# Preview locally
cd docs
php -S localhost:8000
```

Visit: http://localhost:8000

### Project Structure

```
liichtsprooch/
├── Source Files (edit these):
│   ├── config.php              # Article metadata
│   ├── build.php               # Static site generator
│   ├── header.php              # Shared header (dynamic + static)
│   ├── footer.php              # Shared footer (dynamic + static)
│   ├── about.php               # About page
│   ├── templates/              # Page content templates
│   │   ├── homepage-content.php
│   │   ├── article-content.php
│   │   └── rss-feed.php
│   └── assets/
│       ├── styles.css          # Styles
│       └── artikelen/          # Markdown articles
│
└── Generated Files (auto-created):
    └── docs/                   # GitHub Pages serves this
        ├── index.html
        ├── about/index.html
        ├── artikel/
        │   └── slug/index.html
        ├── assets/
        ├── rss.xml
        └── CNAME
```

### How It Works

```
Edit markdown → Push to GitHub → GitHub Actions runs build.php → Deploys
```

**Nobody needs to run `php build.php` manually.** GitHub Actions does it automatically.

### Template System

The site uses **unified templates** that work for both dynamic PHP and static HTML:

- `header.php` and `footer.php` auto-detect context (BUILD_DIR constant)
- URLs automatically adjust:
  - **Dynamic PHP**: `/index.php`, `/about.php`, `/artikel/slug`
  - **Static HTML**: `/`, `/about/`, `/artikel/slug/`
- **Single source of truth** - Edit once, works everywhere
- Changes to navigation/footer automatically update both versions

**Why?** No duplicate templates = no confusion, guaranteed consistency.

---

## Features

- ✅ **Static HTML** - Fast, secure, works on GitHub Pages
- ✅ **Path-like URLs** - `/artikel/slug-name/` (no query strings)
- ✅ **Markdown articles** - Easy to write and edit
- ✅ **Auto-deployment** - GitHub Actions builds automatically
- ✅ **Responsive** - Mobile-first design
- ✅ **SEO optimized** - Meta tags, Open Graph, RSS feed
- ✅ **WCAG 2.1 AA** - Fully accessible
- ✅ **No database** - Just files and Git

---

## Documentation

- **[START_HERE.md](START_HERE.md)** - Quick overview (start here!)
- **[HOW_TO_EDIT.md](HOW_TO_EDIT.md)** - How to add/edit articles
- **[HTML_EMBEDS.md](HTML_EMBEDS.md)** - Embed videos, tables in articles
- **[SECURITY.md](SECURITY.md)** - Security features

---

## Technologies

- **Static Site Generator:** PHP (build-time only)
- **Content:** Markdown (Parsedown 1.8.0)
- **Hosting:** GitHub Pages (free)
- **Deployment:** GitHub Actions (automatic)
- **Frontend:** Vanilla JavaScript, Modern CSS

---

## Design System

- **Primary Accent:** `#26A688` (Teal/Green)
- **Text:** `#333F70` (Dark Blue)
- **Background:** `#ffffff` (White)
- **Typography:** Open Sans (body), Unbounded (headings)

---

## Deployment

**Quick Setup:**
1. Push to GitHub
2. Go to Settings → Pages → Source: Deploy from a branch → Branch: `main` → Folder: `/docs`
3. Go to Settings → Actions → General → Workflow permissions: Read and write permissions
4. Done!

Updates deploy automatically in 2 minutes after each push to `main`.

---

## Statistics

- **Articles:** 8
- **Categories:** 4
- **Total size:** 2.8 MB (generated)
- **Build time:** ~1 second

---

## License

Content: © Liicht Sprooch zu Lëtzebuerg Info-Site
Code: Open source

---

## Contact

Email: liichtsprooch@mailo.lu

---

## Contributing

1. Fork the repository
2. Create a feature branch
3. Edit markdown files in `assets/artikelen/`
4. Update `config.php` with article metadata
5. Push and create Pull Request
6. GitHub Actions auto-builds on merge

See **[HOW_TO_EDIT.md](HOW_TO_EDIT.md)** for details.
