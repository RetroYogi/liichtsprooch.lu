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
├── config.php              # Article metadata & site config
├── build.php               # Static site generator
├── templates/              # HTML templates
├── assets/
│   ├── styles.css          # Styles
│   └── artikelen/          # Markdown articles (edit these!)
├── docs/                   # Generated static site (GitHub Pages serves this)
└── .github/workflows/      # Auto-build configuration
```

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

- **[START_HERE.md](START_HERE.md)** - Quick overview and navigation
- **[COLLABORATION_INSTRUCTIONS.md](COLLABORATION_INSTRUCTIONS.md)** - How to add/edit articles
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

## Contributing

1. Fork the repository
2. Create a feature branch
3. Edit markdown files in `assets/artikelen/`
4. Update `config.php` with article metadata
5. Push and create Pull Request
6. GitHub Actions auto-builds on merge

See **[COLLABORATION_INSTRUCTIONS.md](COLLABORATION_INSTRUCTIONS.md)** for detailed instructions.

---

## License

Content: © Liicht Sprooch zu Lëtzebuerg Info-Site
Code: Open source

---

## Contact

Email: liichtsprooch@mailo.lu
