# START HERE

Welcome to the Liicht Sprooch website repository!

---

## What is this?

A static website about Easy Language (Liicht Sprooch) in Luxembourg.

- **URL:** https://liichtsprooch.lu
- **Hosting:** GitHub Pages (free)
- **Auto-deployment:** GitHub Actions (automatic builds)

---

## I want to...

### Add or edit an article
→ Read **[HOW_TO_EDIT.md](HOW_TO_EDIT.md)**

### Deploy to GitHub Pages
→ Read **[README.md](README.md)** - Deployment section

### Understand the project
→ Read **[README.md](README.md)**

### Embed videos or tables
→ Read **[HTML_EMBEDS.md](HTML_EMBEDS.md)**

### Security information
→ Read **[SECURITY.md](SECURITY.md)**

---

## Quick Overview

**For Content Editors:**
- Edit markdown files on GitHub.com
- No software installation needed
- Changes auto-deploy in 2 minutes

**For Developers:**
- Clone repository
- Run `php build.php` to generate static site
- Push to GitHub - auto-deploys

---

## Files You Need to Know

| File | Purpose |
|------|---------|
| `assets/artikelen/` | Markdown articles (edit these!) |
| `config.php` | Article metadata |
| `header.php` | Navigation (works for dynamic + static) |
| `footer.php` | Footer (works for dynamic + static) |
| `build.php` | Static site generator |
| `docs/` | Generated site (auto-created) |
| `.github/workflows/` | GitHub Actions (auto-build) |

---

## How It Works

```
Edit markdown → Push → GitHub Actions builds → Deploys → Live!
```

Everything happens automatically. You just edit and push.

---

## Need Help?

1. Check the documentation files above
2. Email: liichtsprooch@mailo.lu
3. Create an Issue in the repository

---

**Start with [HOW_TO_EDIT.md](HOW_TO_EDIT.md) to add your first article!**
