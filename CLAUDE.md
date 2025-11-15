# CLAUDE.md

Technical documentation for developers working with the Liicht Sprooch website codebase.

## Architecture

**Hybrid PHP/Static System:**
- Source files are PHP (index.php, artikel.php, about.php, etc.)
- `build.php` generates static HTML to `docs/` folder
- GitHub Pages serves static HTML from `docs/`
- GitHub Actions auto-builds on every push to main

**Why Hybrid?**
- Development: Dynamic PHP for local testing
- Production: Static HTML for GitHub Pages (no server-side PHP needed)
- CI/CD: Automatic builds via GitHub Actions

## Repository Structure

```
liichtsprooch.lu/
├── Source Files (PHP):
│   ├── index.php                # Homepage (dynamic)
│   ├── artikel.php              # Article page (dynamic)
│   ├── about.php                # About page (dynamic)
│   ├── rss.php                  # RSS feed (dynamic)
│   ├── config.php               # Article metadata & site config
│   ├── build.php                # Static site generator script
│   ├── Parsedown.php            # Markdown parser (v1.7.4)
│   ├── HtmlEmbed.php            # Safe HTML embed handler
│   ├── security.php             # Rate limiting, bot detection
│   ├── security-headers.php     # CSP, HSTS, session config
│   ├── header.php               # Shared header template
│   ├── footer.php               # Shared footer template
│   ├── templates/
│   │   ├── homepage-content.php
│   │   ├── article-content.php
│   │   ├── about-content.php
│   │   └── rss-feed.php
│   ├── api/
│   │   └── get-articles.php     # AJAX pagination endpoint (dev only)
│   ├── assets/
│   │   ├── styles.css           # Main stylesheet
│   │   ├── articles-pagination.js  # Client-side pagination
│   │   ├── artikelen/           # Markdown source files
│   │   └── *.png, *.svg         # Images
│   ├── .github/workflows/
│   │   └── build-and-deploy.yml # GitHub Actions workflow
│   └── CNAME                    # Custom domain
│
├── Generated Files (Static HTML):
│   └── docs/                    # GitHub Pages root
│       ├── index.html
│       ├── artikel/
│       │   └── {slug}/index.html
│       ├── about/index.html
│       ├── assets/              # Copied from source
│       ├── articles.json        # For client-side pagination
│       ├── rss.xml
│       ├── sitemap.xml
│       ├── 404.html
│       └── CNAME
│
└── Documentation (for contributors):
    ├── README.md                # Main repository docs
    ├── CLAUDE.md                # This file (dev docs)
    ├── START_HERE.md            # Entry point
    ├── COLLABORATION_INSTRUCTIONS.md  # For non-technical contributors
    ├── HTML_EMBEDS.md           # Embed system docs
    └── SECURITY.md              # Security documentation
```

## Build Process

### Local Development

```bash
# Edit source files (PHP, markdown, templates)
vim assets/artikelen/article.md
vim config.php

# Build static site
php build.php

# Preview locally (serves PHP version)
php -S localhost:8000

# Or preview static build
cd docs && php -S localhost:8000
```

### Production Deployment

**Automatic (recommended):**
```bash
git add .
git commit -m "Update article"
git push origin main
# GitHub Actions runs build.php automatically
# Site deployed to GitHub Pages in ~2 minutes
```

**Manual build (if needed):**
```bash
php build.php
git add docs/
git commit -m "Rebuild static site"
git push
```

## Key Technical Features

### Security System

**Files:** `security.php`, `security-headers.php`

- **CSP (Content Security Policy):** Different policies for article pages (embeds allowed) vs other pages
- **Rate Limiting:** File-based (60 req/min), persists across sessions
- **Bot Detection:** Blocks suspicious user agents
- **Path Traversal Protection:** `realpath()` validation
- **XSS Prevention:** Parsedown safe mode, HTML escaping
- **Session Security:** HttpOnly, SameSite=Strict, regeneration, 30min timeout
- **HSTS:** Enforced on HTTPS

### HTML Embed System

**File:** `HtmlEmbed.php`

Safe iframe embedding for videos (YouTube, Vimeo, etc.):
- Whitelist-based domain validation
- Placeholder system for markdown processing
- CSP integration

**Usage in markdown:**
```markdown
[EMBED]
<iframe src="https://www.youtube.com/embed/VIDEO_ID"></iframe>
[/EMBED]
```

### AJAX Pagination

**Files:** `assets/articles-pagination.js`, `docs/articles.json`

- Responsive: 1 article (mobile) / 2 (tablet) / 3 (desktop)
- Client-side rendering from cached JSON
- Swipe support for mobile
- Keyboard navigation (arrow keys)
- WCAG compliant (ARIA, screen reader announcements)
- No auto-scroll (better UX)

### Article Configuration

**File:** `config.php`

Each article has:
```php
[
    'slug' => 'url-slug',
    'title' => 'Article Title',
    'description' => 'SEO description (150-160 chars)',
    'category' => 'Category Name',
    'date' => 'YYYY-MM-DD',
    'markdown_file' => '/assets/artikelen/File.md',
    'author' => 'Author Name',
    'keywords' => 'SEO, keywords, comma-separated',
    'reading_time_minutes' => 5,
    'image' => '/assets/image.png'  // Optional
]
```

## Design System

**Typography:**
- Headings: Unbounded (Google Fonts)
- Body: Open Sans (Google Fonts)
- Base: 16px, Line height: 1.7 (body), 1.3 (headings)
- Fluid typography: `clamp()` for responsive sizing

**Colors:**
```css
--primary: #26A688;      /* Teal/Green accent */
--text: #333F70;         /* Dark blue text */
--background: #ffffff;
--light-bg: #f8f9fa;
```

**Breakpoints:**
```css
Mobile:  < 640px    (1 column)
Tablet:  640-1023px (2 columns)
Desktop: ≥ 1024px   (3 columns)
```

**WCAG 2.1 AA Compliance:**
- Color contrast ratios tested
- Keyboard navigation
- Screen reader support
- `prefers-reduced-motion` support
- `prefers-contrast: high` support

## Common Development Tasks

### Add New Article

1. Create markdown file: `assets/artikelen/article-name.md`
2. Add metadata to `config.php`
3. Build: `php build.php` (or push to GitHub)

### Modify Templates

1. Edit: `templates/*.php` or `header.php` / `footer.php`
2. Rebuild: `php build.php`
3. Test: Check both PHP version (`php -S`) and static build (`docs/`)

### Update Styles

1. Edit: `assets/styles.css`
2. Rebuild: `php build.php` (copies to `docs/assets/`)
3. Test responsive design at all breakpoints

### Add New Page

1. Create PHP source: `new-page.php`
2. Add to navigation: `header.php`
3. Add build function to `build.php`
4. Update sitemap generation

### Security Updates

**Rate Limiting:**
- Adjust limits in `artikel.php`: `checkRateLimit(60, 60)`
- Rate limit files stored in `logs/rate_limit/`

**CSP Policy:**
- Modify in `security-headers.php`
- Different policies for article pages vs others

**Trusted Embed Domains:**
- Update whitelist in `HtmlEmbed.php`

## Deployment Configuration

### GitHub Actions

**File:** `.github/workflows/build-and-deploy.yml`

**Triggers:**
- Push to main branch (when source files change)
- Pull request to main
- Manual trigger (workflow_dispatch)

**Process:**
1. Checkout repository
2. Setup PHP 8.1
3. Run `php build.php`
4. Upload `docs/` as artifact
5. Deploy to GitHub Pages

### GitHub Pages Settings

- **Source:** Deploy from artifact (not branch)
- **Custom Domain:** liichtsprooch.lu (configured in CNAME)
- **Enforce HTTPS:** Enabled

## Dependencies

**PHP (build-time only):**
- PHP 7.4+ (8.1 recommended)
- No Composer dependencies
- Libraries included: Parsedown.php (v1.7.4)

**Runtime (GitHub Pages):**
- Pure static HTML/CSS/JavaScript
- No server-side processing
- No database

**External Resources:**
- Google Fonts (Unbounded, Open Sans)
- Embedded iframes (YouTube, Vimeo, etc. - whitelisted)

## Language Context

**Content Language:** Luxembourgish (Lëtzebuergesch)

**Special Characters:** ä, ë, é, ü (ensure UTF-8 encoding)

**Key Terms:**
- Luxembourgish: Liicht Sprooch
- German: Leichte Sprache
- French: FALC (Facile à lire et à comprendre)

**Organizations:**
- Klaro - Official center (part of APEMH)
- CDI - Documentation center
- Atelier Isie - Validation workshop

## Testing Checklist

Before committing major changes:

**Build:**
- [ ] `php build.php` runs without errors
- [ ] All articles generate properly
- [ ] No broken links in navigation

**Security:**
- [ ] No new XSS vulnerabilities
- [ ] Path traversal protection intact
- [ ] CSP headers appropriate

**Accessibility:**
- [ ] Keyboard navigation works
- [ ] Focus indicators visible
- [ ] Color contrast meets WCAG AA
- [ ] Screen reader compatibility
- [ ] Valid HTML (W3C validator)

**Responsive:**
- [ ] Mobile (< 640px)
- [ ] Tablet (640-1023px)
- [ ] Desktop (≥ 1024px)
- [ ] Pagination adapts correctly

**Performance:**
- [ ] Images optimized
- [ ] No JavaScript errors in console
- [ ] Fast load times

## Troubleshooting

**Build fails:**
- Check PHP version (7.4+)
- Verify markdown files exist
- Check `config.php` syntax

**Articles not showing:**
- Verify metadata in `config.php`
- Check markdown file path
- Rebuild with `php build.php`

**Pagination broken:**
- Check `articles.json` generated
- Verify JavaScript console for errors
- Test with different screen sizes

**Security errors:**
- Check rate limit files in `logs/rate_limit/`
- Verify CSP headers not blocking resources
- Test with different browsers

## Git Workflow

**Branches:**
- `main` - Production (auto-deploys to GitHub Pages)
- `claude/*` - Feature branches (created by Claude Code)

**Commit Message Format:**
```
<type>: <description>

Examples:
feat: Add new article about Klaro
fix: Fix pagination on mobile
docs: Update CLAUDE.md
style: Improve responsive layout
security: Update CSP headers
```

**Before Pushing:**
1. Test locally (`php -S localhost:8000`)
2. Build static site (`php build.php`)
3. Review changes in `docs/`
4. Commit both source and generated files (or let GitHub Actions handle it)

## Performance Metrics

**Current build output:**
- Total files: ~31
- Total size: ~2.8 MB (including images)
- Build time: < 5 seconds
- Deployment time: ~2 minutes (GitHub Actions)

## Additional Resources

- [Parsedown Documentation](https://parsedown.org/)
- [GitHub Pages Documentation](https://docs.github.com/pages)
- [WCAG 2.1 Guidelines](https://www.w3.org/WAI/WCAG21/quickref/)
- [Content Security Policy Reference](https://developer.mozilla.org/en-US/docs/Web/HTTP/CSP)
