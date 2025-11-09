# Liicht Sprooch zu Lëtzebuerg

A static website about Easy Language (Liicht Sprooch) in Luxembourg, built for GitHub Pages with automatic deployment.

🌐 **Live Site:** https://liichtsprooch.lu

---

## Quick Start

### For Content Contributors

**Add or edit an article:**
1. Edit markdown file on GitHub.com (or clone locally)
2. Update `config.php` with article metadata
3. Commit and push
4. Wait 2 minutes - automatically deployed!

No software installation needed. See **[COLLABORATION_INSTRUCTIONS.md](COLLABORATION_INSTRUCTIONS.md)** for details.

### For Developers

```bash
# Clone repository
git clone https://github.com/USERNAME/liichtsprooch.git
cd liichtsprooch

# Build static site locally
php build.php

# Preview
cd docs && php -S localhost:8000
```

Visit http://localhost:8000

---

## How It Works

```
Edit markdown → Push to GitHub → GitHub Actions runs build.php → Deploys to GitHub Pages
```

**Nobody needs to run `php build.php` manually.** GitHub Actions does it automatically on every push.

---

## Project Structure

```
liichtsprooch/
├── Source Files (edit these):
│   ├── config.php              # Article metadata
│   ├── build.php               # Static site generator
│   ├── templates/              # HTML templates
│   └── assets/
│       ├── styles.css          # Styles
│       └── artikelen/          # Markdown articles
│
└── Generated Files (auto-created):
    └── docs/                   # GitHub Pages serves this
        ├── index.html
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

---

## Features

- ✅ **Static HTML** - Fast, secure, no server-side processing
- ✅ **Path-like URLs** - `/artikel/slug-name/` (SEO-friendly)
- ✅ **Auto-deployment** - GitHub Actions builds on every push
- ✅ **Markdown articles** - Easy to write and edit
- ✅ **Responsive** - Mobile-first design
- ✅ **WCAG 2.1 AA** - Fully accessible
- ✅ **RSS feed** - Automatic generation
- ✅ **No database** - File-based content

---

## Documentation

- **[HOW_TO_EDIT.md](HOW_TO_EDIT.md)** - How to add/edit articles (start here!)
- **[DEPLOY.md](DEPLOY.md)** - Deployment guide for GitHub Pages
- **[HTML_EMBEDS.md](HTML_EMBEDS.md)** - Embed videos, tables in articles
- **[SECURITY.md](SECURITY.md)** - Security features

---

## Technologies

- **Static Site Generator:** PHP (build-time only)
- **Markdown Parser:** Parsedown 1.8.0
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

See **[NEXT_STEPS.txt](NEXT_STEPS.txt)** for complete instructions.

**Quick version:**
1. Push to GitHub
2. Enable GitHub Pages (serve from `/docs`)
3. Enable GitHub Actions (write permissions)
4. Done!

Updates deploy automatically in 2 minutes.

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
