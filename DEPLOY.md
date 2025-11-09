# Deployment Guide

Deploy this static site to GitHub Pages in 5 steps.

---

## Prerequisites

- Git installed
- GitHub account
- PHP 7.4+ (only for local testing)

---

## Step 1: Push to GitHub

```bash
cd "liichtsprooch.lu website new"

# Initialize Git
git init
git add .
git commit -m "Initial commit: Liicht Sprooch static site"

# Create repository on GitHub first, then:
git remote add origin https://github.com/USERNAME/liichtsprooch.git
git branch -M main
git push -u origin main
```

---

## Step 2: Enable GitHub Pages

1. Go to repository on GitHub
2. Click **Settings** → **Pages**
3. Under **Source**:
   - Branch: `main`
   - Folder: `/docs`
   - Click **Save**

Your site will be at: `https://USERNAME.github.io/liichtsprooch/`

Wait 1-2 minutes for first deployment.

---

## Step 3: Enable GitHub Actions

**This enables automatic building when collaborators edit files.**

1. Go to **Settings** → **Actions** → **General**
2. Under **Workflow permissions**:
   - Select: **Read and write permissions**
   - Check: **Allow GitHub Actions to create and approve pull requests**
3. Click **Save**

Done! Now anyone can edit markdown files and the site auto-builds.

---

## Step 4: Custom Domain (Optional)

If you own `liichtsprooch.lu`:

### A. Configure DNS

At your domain registrar, add these A records:

```
Type  Name  Value
A     @     185.199.108.153
A     @     185.199.109.153
A     @     185.199.110.153
A     @     185.199.111.153
```

### B. Configure GitHub Pages

1. Go to **Settings** → **Pages**
2. Under **Custom domain**: `liichtsprooch.lu`
3. Click **Save**
4. Wait for DNS check (up to 24 hours)
5. Enable **Enforce HTTPS**

The CNAME file is already included and will be copied to `/docs` during build.

---

## Step 5: Verify Deployment

1. Go to **Actions** tab
2. Check that workflows run successfully (green checkmark)
3. Visit your site URL
4. Test navigation and article pages

---

## How Auto-Deployment Works

```
Someone edits a markdown file
         ↓
Commits and pushes to GitHub
         ↓
GitHub Actions automatically runs
         ↓
Executes: php build.php
         ↓
Generates docs/ folder
         ↓
Commits generated files
         ↓
GitHub Pages deploys
         ↓
Site is live in 2 minutes
```

Check progress: Repository → **Actions** tab

---

## Updating the Site

After initial deployment, updates are automatic:

```bash
# Edit content
vim "assets/artikelen/New Article.md"
vim config.php

# Commit and push
git add .
git commit -m "Add new article"
git push

# Done! Auto-deploys in 2 minutes
```

**You don't need to run `php build.php`.** GitHub Actions does it automatically.

---

## Testing Locally

Before pushing to GitHub:

```bash
# Build the site
php build.php

# Start local server
cd docs
php -S localhost:8000

# Open browser
open http://localhost:8000
```

---

## Troubleshooting

### Site shows 404

- Check **Settings** → **Pages** shows `/docs` folder
- Wait 1-2 minutes for deployment
- Verify `docs/index.html` exists in repository

### GitHub Actions failing

- Go to **Actions** tab
- Click the failed workflow
- Read error logs
- Common issues:
  - Syntax error in `config.php`
  - Missing markdown file
  - Permissions not enabled (Step 3)

### Custom domain not working

- Verify DNS records are correct
- Wait up to 24 hours for DNS propagation
- Check `docs/CNAME` file exists
- Ensure DNS check shows green checkmark

### Assets not loading

- Links use absolute paths: `/assets/styles.css` ✅
- Not relative paths: `../assets/styles.css` ❌
- This is already configured correctly

---

## Repository Settings Summary

After deployment, verify these settings:

| Setting | Location | Value |
|---------|----------|-------|
| GitHub Pages Source | Settings → Pages | Branch: `main`, Folder: `/docs` |
| Workflow Permissions | Settings → Actions → General | Read and write permissions |
| Custom Domain | Settings → Pages | `liichtsprooch.lu` (optional) |
| Enforce HTTPS | Settings → Pages | Enabled |

---

## GitHub Actions Workflow

The workflow file is at `.github/workflows/build-and-deploy.yml`

**Triggers automatically when:**
- Markdown files in `assets/artikelen/` change
- `config.php` changes
- `build.php` changes
- Template files change
- `assets/styles.css` changes

**Can also trigger manually:**
- Go to **Actions** tab
- Select **Build and Deploy Static Site**
- Click **Run workflow**

---

## Next Steps After Deployment

1. **Add collaborators:** Settings → Collaborators → Add people
2. **Protect main branch (optional):** Settings → Branches → Add rule
3. **Enable Discussions (optional):** Settings → Features → Discussions
4. **Set up branch protection (optional):** Require PR reviews before merging

---

## Support

- Check the **Actions** tab for build logs
- Email: liichtsprooch@mailo.lu
- Create an Issue in the repository

---

## Quick Reference

**Deploy:**
```bash
git push
```

**Check status:**
Repository → Actions tab

**Add collaborator:**
Settings → Collaborators → Add people

**Custom domain:**
Settings → Pages → Custom domain

**Enable auto-build:**
Settings → Actions → General → Read and write permissions
