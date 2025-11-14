# Collaboration Instructions

## Simple Rule: Edit and Push. That's It.

GitHub automatically builds and deploys your changes in ~2 minutes. You never need to run `php build.php` manually.

---

## Edit on GitHub.com

### Add a New Article

1. Go to your repository on GitHub
2. Click `assets/artikelen/`
3. Click **"Add file"** → **"Create new file"**
4. Name it: `Your Article Title.md`
5. Write your article in Markdown
6. Click **"Commit changes"**
7. Click `config.php`
8. Click the **pencil icon** to edit
9. Add your article info to the list (including SEO metadata):
   ```php
   [
       'slug' => 'your-article-slug',
       'title' => 'Your Article Title',
       'description' => 'Short description for SEO (informative, not commercial)',
       'category' => 'Organisatiounen',
       'date' => '2025-01-15',
       'markdown_file' => '/assets/artikelen/Your Article Title.md',
       'author' => 'Your Name',
       'keywords' => 'keyword1, keyword2, German keyword, Luxembourgish keyword',
       'reading_time_minutes' => 5,
       'image' => '/assets/ls-logo.png'  // Optional: defaults to site logo if not specified
   ],
   ```
10. Click **"Commit changes"**

**That's it!**

### Edit an Existing Article

1. Click the file you want to edit in `assets/artikelen/`
2. Click the **pencil icon**
3. Make your change and follow the rules of the markdown format
4. Click **"Commit changes"**

---

## Categories

Choose from these categories in `config.php`:

- `Organisatiounen` - Organizations
- `Reegelen & Praxis` - Rules & Practice  
- `Ressourcen` - Resources
- `Technologie` - Technology

---

## Collaboration

**Multiple people can edit simultaneously.** GitHub handles it.

- Edit different articles → No problem
- Edit same article → Use Pull Requests
- Quick fixes → Commit directly to main

To add collaborators:
Repository → Settings → Collaborators → Add people

---

## Managing SEO Metadata

All SEO metadata is stored in `config.php` for easy management and updates.

### Site-Wide SEO Settings

Edit these constants in `config.php` (lines 10-11):

```php
define('SITE_DESCRIPTION', 'Main site description in Luxembourgish with some German text');
define('SITE_KEYWORDS', 'Liicht Sprooch, Leichte Sprache, FALC, Easy-to-Read, ...');
```

**Guidelines:**
- Use **informative tone** (not commercial/sales language)
- Include **Luxembourgish terms first**, then German equivalents
- Keep description under 160 characters for best Google display
- Keywords: 8-12 relevant terms, comma-separated

---

### Article SEO Metadata

Each article in `config.php` should include these fields:

```php
[
    'slug' => 'article-url-slug',
    'title' => 'Article Title',
    'description' => 'SEO meta-description (150-160 characters)',
    'category' => 'Organisatiounen',
    'date' => '2025-01-15',
    'markdown_file' => '/assets/artikelen/Article.md',
    'author' => 'Author Name',
    'keywords' => 'Luxembourgish term, German term, another keyword, ...',
    'reading_time_minutes' => 5,
    'image' => '/assets/ls-logo.png'  // Optional: use site logo or custom image
]
```

#### Field Explanations

**Required Fields:**
- `slug` - URL-friendly identifier (lowercase, hyphens only)
- `title` - Full article title (shown in browser tab)
- `description` - SEO meta-description (150-160 chars, informative tone)
- `category` - One of the 4 categories (see below)
- `date` - Publication date (YYYY-MM-DD format)
- `markdown_file` - Path to markdown file
- `author` - Author name or "Liicht Sprooch Team"

**SEO Fields:**
- `keywords` - 5-10 relevant search terms (Luxembourgish + German)
- `reading_time_minutes` - Estimated reading time (helps with SEO schema)
- `image` - Social media preview image (optional, defaults to `/assets/ls-logo.png` if not specified)

---

### SEO Best Practices

#### Writing Meta Descriptions
✅ **Good:**
```
Entdeckt Klaro, den offizielle Kompetenzzentrum fir Liicht Sprooch zu Lëtzebuerg.
Léiert wéi Klaro funktionéiert a firwat si wichteg fir Inclusioun sinn.
```

❌ **Bad (too commercial):**
```
Elo kaafen! Déi beschten Reegelen zur Liichter Sprooch zu Lëtzebuerg!
```

#### Writing Keywords

**Format:** Luxembourgish first, then German if needed, comma-separated

✅ **Good:**
```
'keywords' => 'Klaro, Kompetenzzentrum, Liicht Sprooch, Leichte Sprache Luxemburg,
               Inclusion, Barrierefreiheit, FALC, Easy-to-Read'
```

**Tips:**
- Mix Luxembourgish and German terms (helps to find content in search engines)
- Use natural phrases people actually search for
- Include organization/concept names mentioned in article
- 5-10 keywords is optimal

#### Reading Time

Estimate based on word count:
- Short article (500 words) ≈ 3-4 minutes
- Medium article (1000 words) ≈ 5-6 minutes
- Long article (1500+ words) ≈ 7-10 minutes

This helps search engines understand content depth.

---

### What Gets Generated Automatically

When you update `config.php`, the build process automatically creates:

1. **HTML Meta Tags**
   - `<meta name="description">`
   - `<meta name="keywords">`
   - `<meta name="author">`
   - `<meta name="robots">`

2. **Open Graph Tags** (for Facebook/social sharing)
   - Title, description, URL, type
   - Article metadata (date, author, section)

3. **Twitter Card Tags**
   - Summary card with title and description

4. **JSON-LD Schema** (for Google rich snippets)
   - Articles: NewsArticle schema with reading time
   - Pages: WebSite schema with multilingual support

5. **Canonical URLs**
   - Prevents duplicate content issues

---

### Updating Existing Article SEO

To improve SEO for an existing article:

1. Go to `config.php` on GitHub
2. Click the **pencil icon** to edit
3. Find your article in the `$articles` array
4. Update the `description` and/or `keywords` fields
5. Optionally update `reading_time_minutes`
6. Click **"Commit changes"**

Example update:
```php
// Before
'description' => 'Short description',
'keywords' => 'Klaro, Liicht Sprooch',

// After (improved)
'description' => 'Entdeckt Klaro, den offizielle Kompetenzzentrum fir Liicht Sprooch.
                  Léiert wéi Klaro funktionéiert a firwat si wichteg fir Inclusioun sinn.',
'keywords' => 'Klaro, Kompetenzzentrum, Liicht Sprooch, Leichte Sprache Luxemburg,
               Inclusion, Barrierefreiheit, FALC',
```

---

### Multilingual SEO (Luxembourgish + German)

**Why add German terms?**
Luxembourg is trilingual (Luxembourgish, French, German). Adding German search terms helps German speakers find your content without violating SEO rules.

**How to do it:**
1. Write primary content in Luxembourgish
2. Add German equivalents in keywords
3. Include some German phrases in descriptions when natural
4. Tag language properly (already done: `lb-LU`, `de-LU`, `fr-LU`)

**Example:**
```php
'description' => 'Iwwer dës Informatiounssäit zu Liichter Sprooch zu Lëtzebuerg.
                  Über diese Informationsseite zu Leichter Sprache in Luxemburg.',
'keywords' => 'Liicht Sprooch, Leichte Sprache, FALC, Luxemburg, Lëtzebuerg,
               Inklusion, Barrierefreiheit, Inclusion',
```

---

### Testing Your SEO Changes

After updating SEO metadata:

1. **Wait 2 minutes** for GitHub Actions to deploy
2. **View page source** of your article:
   - Right-click page → "View Page Source"
   - Look for `<meta name="description">` and `<meta name="keywords">`
   - Check JSON-LD schema (search for `application/ld+json`)

3. **Test with Google tools:**
   - [Rich Results Test](https://search.google.com/test/rich-results)
   - Paste your article URL
   - Verify NewsArticle schema is detected

4. **Social media preview:**
   - [Facebook Sharing Debugger](https://developers.facebook.com/tools/debug/)
   - Check if Open Graph tags display correctly

---

## That's All You Need to Know

1. Edit markdown files
2. Update `config.php` (including SEO metadata)
3. Push to GitHub
4. Wait 2 minutes

GitHub handles the rest automatically.
