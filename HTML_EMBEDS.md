# HTML Embeds in Markdown

Guide for safely embedding HTML content (videos, audio, tables) in markdown articles.

## Overview

The website supports **secure HTML embeds** using a special fence syntax. All HTML is:
- ✅ Validated against a whitelist of allowed tags
- ✅ Checked for malicious attributes and URLs
- ✅ Restricted to trusted domains for iframes
- ✅ Sanitized to prevent XSS attacks

**Last Updated:** 2025-01-09 (after security enhancements)

## Syntax

To embed HTML in a markdown file, use the `:::html` fence blocks:

```markdown
:::html
<div>Your HTML content here</div>
:::
```

**Important**:
- The opening `:::html` and closing `:::` must be on their own lines
- There must be a newline after `:::html` and before `:::`
- The HTML inside will be validated for security

## Examples

### Video Embed (Vimeo)

```markdown
:::html
<div style="padding:56.25% 0 0 0;position:relative;margin:2rem 0;">
    <iframe src="https://player.vimeo.com/video/928723104"
            frameborder="0"
            allow="autoplay; fullscreen; picture-in-picture; clipboard-write; encrypted-media; web-share"
            referrerpolicy="strict-origin-when-cross-origin"
            style="position:absolute;top:0;left:0;width:100%;height:100%;"
            title="Video Title">
    </iframe>
</div>
:::
```

**Note:** The Vimeo player API script (`<script src="https://player.vimeo.com/api/player.js">`) is **not needed** for basic video playback and is **not allowed** for security reasons. The iframe alone is sufficient.

### Video Embed (YouTube)

```markdown
:::html
<div style="padding:56.25% 0 0 0;position:relative;margin:2rem 0;">
    <iframe src="https://www.youtube.com/embed/VIDEO_ID"
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen
            style="position:absolute;top:0;left:0;width:100%;height:100%;"
            title="Video Title">
    </iframe>
</div>
:::
```

### Audio Embed

```markdown
:::html
<audio controls style="width:100%;">
    <source src="https://example.com/audio.mp3" type="audio/mpeg">
    Äre Browser ënnerstëtzt keen Audio-Element.
</audio>
:::
```

### Complex Table

```markdown
:::html
<table class="data-table" style="width:100%;border-collapse:collapse;">
    <thead>
        <tr>
            <th style="border:1px solid #ddd;padding:8px;">Column 1</th>
            <th style="border:1px solid #ddd;padding:8px;">Column 2</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td style="border:1px solid #ddd;padding:8px;">Data 1</td>
            <td style="border:1px solid #ddd;padding:8px;">Data 2</td>
        </tr>
    </tbody>
</table>
:::
```

### Figure with Caption

```markdown
:::html
<figure style="margin:2rem 0;text-align:center;">
    <blockquote cite="https://example.com">
        "This is a quote from an important source."
    </blockquote>
    <figcaption style="font-style:italic;color:#666;margin-top:0.5rem;">
        — Author Name
    </figcaption>
</figure>
:::
```

## Security Features

### Allowed HTML Tags

Only the following tags are permitted:

**Structure & Layout:**
- `<div>`, `<figure>`, `<figcaption>`, `<blockquote>`, `<cite>`

**Media:**
- `<iframe>` (only from whitelisted domains - see below)
- `<video>`, `<audio>`

**Tables:**
- `<table>`, `<thead>`, `<tbody>`, `<tfoot>`, `<tr>`, `<th>`, `<td>`, `<caption>`

**⚠️ NOT ALLOWED:**
- ❌ `<script>` tags (removed for security - 2025-01-09)
- ❌ `<form>`, `<input>`, `<button>` (form elements)
- ❌ `<object>`, `<embed>`, `<applet>` (plugins)
- ❌ `<link>`, `<meta>`, `<style>` (external resources)

### Allowed Attributes

Each tag has specific allowed attributes. Common ones include:
- `class`, `id`, `style` (with validation)
- `src`, `href` (with URL validation)
- `width`, `height`
- `title`, `alt`
- `allow`, `allowfullscreen`, `frameborder` (for iframes)
- ARIA attributes: `role`, `aria-label`, `aria-labelledby`

### Trusted Domains

**Video/Media Platforms:**
- `player.vimeo.com`
- `youtube.com`, `www.youtube.com`, `www.youtube-nocookie.com`
- `open.spotify.com`
- `w.soundcloud.com`

**Social Media:**
- `platform.twitter.com`
- `www.facebook.com`

**Maps:**
- `maps.google.com`, `www.google.com`

**Note:** CDN domains are listed but `<script>` tags are no longer allowed for security reasons (as of 2025-01-09).

### Blocked Content

The following will cause the embed to fail validation:

❌ **Dangerous Tags:**
- `<script>` (all script tags blocked as of 2025-01-09)
- `<object>`, `<embed>`, `<applet>`
- `<form>`, `<input>`, `<button>`
- `<link>`, `<meta>`, `<style>`

❌ **Dangerous Attributes:**
- `onclick`, `onerror`, `onload` (any `on*` event handlers)
- Unvalidated `src` URLs
- `href` with `javascript:` protocol

❌ **Dangerous CSS:**
- `javascript:` in styles
- `expression()` (old IE vulnerability)
- `@import` rules

❌ **Dangerous URLs:**
- `javascript:` protocol
- `data:` URLs in iframes/scripts
- URLs from non-whitelisted domains (for iframes/scripts)

## Validation Process

1. **Extraction**: HTML blocks are extracted from markdown before processing
2. **Parsing**: HTML is parsed using PHP's DOMDocument
3. **Validation**: Each element and attribute is checked against whitelists
4. **URL Checking**: All URLs are validated for protocol and domain
5. **Style Validation**: CSS in `style` attributes is checked for malicious content
6. **Restoration**: Validated HTML is inserted back into the rendered content

If any validation step fails, the embed will be replaced with:
```
[Ugültegen HTML Embed - Sécherheetsvalidatioun feelgeschloen]
```

## Adding New Trusted Domains

If you need to embed content from a domain not in the whitelist:

**Option 1:** Use the API (in `config.php` or similar):
```php
HtmlEmbed::addTrustedDomain('example.com');
```

**Option 2:** Edit `HtmlEmbed.php` directly:
```php
// Line 47-60 in HtmlEmbed.php
private static $trustedDomains = [
    'player.vimeo.com',
    'www.youtube.com',
    // ... add your domain here
    'your-domain.com',
];
```

## Adding New Allowed Tags

⚠️ **Use with caution** - only add safe, presentational tags.

**Option 1:** Use the API:
```php
HtmlEmbed::addAllowedTag('span', ['class', 'style', 'id']);
```

**Option 2:** Edit `HtmlEmbed.php` directly:
```php
// Line 13-33 in HtmlEmbed.php
private static $allowedTags = [
    'div' => ['class', 'id', 'style', 'role'],
    // ... add your tag here
    'span' => ['class', 'style', 'id'],
];
```

**⚠️ Security Warning:** Do NOT add `<script>`, `<object>`, `<embed>`, or form elements.

## Best Practices

1. **Keep it Simple**: Use HTML embeds only when markdown syntax isn't sufficient
2. **Accessibility**: Always include `title` attributes for iframes, `alt` for images
3. **Responsive Design**: Use relative sizing (percentages, `clamp()`) rather than fixed pixels
4. **Test Thoroughly**: Always preview your article after adding HTML embeds
5. **Minimal Inline Styles**: Prefer CSS classes over inline styles when possible

## Troubleshooting

### Embed Not Showing Up

1. **Check the syntax**: Ensure `:::html` and `:::` are on their own lines
2. **Check for errors**: Look for the error message in the rendered article
3. **Validate HTML**: Make sure your HTML is well-formed
4. **Check domain**: Verify the domain is in the trusted list
5. **Check tags**: Ensure all tags are in the allowed list

### Video Not Playing

1. **Check iframe src**: Ensure the URL is correct and from a trusted domain
2. **Check allow attribute**: Include necessary permissions (e.g., `allow="autoplay; fullscreen"`)
3. **Check browser console**: Look for Content Security Policy errors

### Style Not Applying

1. **Inline styles only**: External stylesheets won't work
2. **No dangerous CSS**: Avoid `expression()`, `@import`, `javascript:`
3. **Use allowed properties**: Stick to safe CSS properties

## Examples in Production

See `assets/artikelen/Atelier Isie.md` for a real-world example of a Vimeo video embed.

## Security Notes

**Multi-Layer Protection:**
- ✅ All HTML is sanitized before rendering
- ✅ Parsedown's safe mode enabled (escapes HTML in markdown)
- ✅ Whitelist-based tag and attribute validation
- ✅ URL protocol and domain validation
- ✅ CSS injection prevention in `style` attributes
- ✅ Event handlers (`onclick`, etc.) completely blocked
- ✅ `<script>` tags blocked (as of 2025-01-09)
- ✅ Security validation failures logged

**Why No Script Tags?**

Script tags were removed in the 2025-01-09 security update because:
1. Even whitelisted CDNs can be compromised
2. No Subresource Integrity (SRI) checks were in place
3. Videos and embeds work fine without them
4. Reduces XSS attack surface significantly

**For Advanced Scripting:**

If you absolutely need JavaScript for a feature:
1. Add it directly to `header.php` or `footer.php`
2. Use SRI hashes for external scripts
3. Include it in the Content Security Policy
4. Do NOT add it through markdown embeds

For security details, see [SECURITY.md](SECURITY.md).

---

**Last Updated:** 2025-01-09
**Security Level:** High (post-security-enhancement)
