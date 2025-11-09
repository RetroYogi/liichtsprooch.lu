# How to Edit the Website

## Simple Rule: Edit and Push. That's It.

GitHub automatically builds and deploys your changes. You never need to run `php build.php` manually.

---

## Method 1: Edit on GitHub.com (Easiest)

**No software installation needed. Works from any device.**

### Add a New Article

1. Go to your repository on GitHub
2. Click `assets/artikelen/`
3. Click **"Add file"** → **"Create new file"**
4. Name it: `Your Article Title.md`
5. Write your article in Markdown
6. Click **"Commit changes"**
7. Click `config.php`
8. Click the **pencil icon** to edit
9. Add your article info to the list:
   ```php
   [
       'slug' => 'your-article-slug',
       'title' => 'Your Article Title',
       'description' => 'Short description for SEO',
       'category' => 'Organisatiounen',
       'date' => '2025-01-15',
       'markdown_file' => '/assets/artikelen/Your Article Title.md',
       'author' => 'Your Name'
   ],
   ```
10. Click **"Commit changes"**

**That's it!** Wait 2 minutes and your article is live.

### Fix a Typo

1. Click the file you want to edit
2. Click the **pencil icon**
3. Make your change
4. Click **"Commit changes"**

Done! Auto-deploys in 2 minutes.

---

## Method 2: Edit with Git (For Developers)

```bash
# Clone repository (first time only)
git clone https://github.com/USERNAME/liichtsprooch.git
cd liichtsprooch

# Create your article
vim "assets/artikelen/New Article.md"

# Update config
vim config.php

# Commit and push
git add .
git commit -m "Add article: New Article"
git push

# Done! Auto-deploys in 2 minutes
```

**Note:** You do NOT need to run `php build.php`. GitHub does it automatically.

---

## Categories

Choose from these categories in `config.php`:

- `Organisatiounen` - Organizations
- `Reegelen & Praxis` - Rules & Practice  
- `Ressourcen` - Resources
- `Technologie` - Technology

---

## What Happens Automatically

```
You edit and push
       ↓
GitHub Actions runs
       ↓
Builds the site
       ↓
Deploys to GitHub Pages
       ↓
Live in 2 minutes
```

Check progress: Repository → **Actions** tab

---

## Collaboration

**Multiple people can edit simultaneously.** GitHub handles it.

- Edit different articles → No problem
- Edit same article → Use Pull Requests
- Quick fixes → Commit directly to main

To add collaborators:
Repository → Settings → Collaborators → Add people

---

## That's All You Need to Know

1. Edit markdown files
2. Update `config.php` 
3. Push to GitHub
4. Wait 2 minutes

GitHub handles the rest automatically.
