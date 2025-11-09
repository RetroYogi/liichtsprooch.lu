<?php
/**
 * Safe HTML Embed Handler
 * Allows controlled HTML embeds in markdown with security safeguards
 */

class HtmlEmbed {

    /**
     * Whitelist of allowed HTML tags and their attributes
     * Only safe, presentational tags are allowed
     */
    private static $allowedTags = [
        'div' => ['class', 'id', 'style', 'role', 'aria-label', 'aria-labelledby'],
        'iframe' => ['src', 'width', 'height', 'frameborder', 'allow', 'allowfullscreen',
                     'style', 'title', 'referrerpolicy', 'loading'],
        'video' => ['src', 'width', 'height', 'controls', 'autoplay', 'loop', 'muted',
                    'poster', 'preload', 'class', 'style'],
        'audio' => ['src', 'controls', 'autoplay', 'loop', 'muted', 'preload', 'class'],
        // REMOVED: 'script' tag support - security risk even with domain whitelisting
        // If scripts are needed, add them directly in PHP templates, not through markdown
        'figure' => ['class', 'style'],
        'figcaption' => ['class', 'style'],
        'blockquote' => ['cite', 'class', 'style'],
        'cite' => ['class'],
        'table' => ['class', 'style', 'border', 'cellpadding', 'cellspacing'],
        'thead' => ['class', 'style'],
        'tbody' => ['class', 'style'],
        'tfoot' => ['class', 'style'],
        'tr' => ['class', 'style'],
        'th' => ['class', 'style', 'colspan', 'rowspan', 'scope'],
        'td' => ['class', 'style', 'colspan', 'rowspan'],
        'caption' => ['class', 'style'],
    ];

    /**
     * Whitelist of allowed URL protocols
     */
    private static $allowedProtocols = [
        'https',
        'http',
        'data', // For inline SVG/images
    ];

    /**
     * Whitelist of trusted domains for iframes and scripts
     */
    private static $trustedDomains = [
        'player.vimeo.com',
        'www.youtube.com',
        'youtube.com',
        'www.youtube-nocookie.com',
        'platform.twitter.com',
        'www.facebook.com',
        'open.spotify.com',
        'w.soundcloud.com',
        'maps.google.com',
        'www.google.com',
        'cdnjs.cloudflare.com',
        'cdn.jsdelivr.net',
        'unpkg.com',
    ];

    /**
     * Process markdown content and extract HTML embeds
     *
     * HTML embeds are defined using special fence blocks:
     * :::html
     * <div>Your HTML here</div>
     * :::
     *
     * @param string $markdown Raw markdown content
     * @return string Processed markdown with HTML embeds converted to placeholders
     */
    public static function process($markdown) {
        $embeds = [];
        $counter = 0;

        // Find all :::html blocks
        $pattern = '/:::html\s*\n(.*?)\n:::/s';

        $processed = preg_replace_callback($pattern, function($matches) use (&$embeds, &$counter) {
            $rawHtml = trim($matches[1]);

            // Sanitize the HTML
            $safeHtml = self::sanitizeHtml($rawHtml);

            if ($safeHtml === false) {
                // HTML failed validation, return error message
                return "\n\n**[Ugültegen HTML Embed - Sécherheetsvalidatioun feelgeschloen]**\n\n";
            }

            // Create placeholder
            $placeholder = "{{HTML_EMBED_$counter}}";
            $embeds[$placeholder] = $safeHtml;
            $counter++;

            return "\n\n$placeholder\n\n";
        }, $markdown);

        return ['markdown' => $processed, 'embeds' => $embeds];
    }

    /**
     * Restore HTML embeds in rendered content
     *
     * @param string $html Rendered HTML from markdown
     * @param array $embeds Array of placeholder => HTML mappings
     * @return string HTML with embeds restored
     */
    public static function restore($html, $embeds) {
        foreach ($embeds as $placeholder => $embed) {
            // Wrap in paragraph tags if not already in one
            $wrappedEmbed = '<div class="html-embed">' . $embed . '</div>';
            $html = str_replace("<p>$placeholder</p>", $wrappedEmbed, $html);
            $html = str_replace($placeholder, $wrappedEmbed, $html);
        }
        return $html;
    }

    /**
     * Sanitize HTML content
     *
     * @param string $html Raw HTML
     * @return string|false Sanitized HTML or false if validation failed
     */
    private static function sanitizeHtml($html) {
        // Load HTML into DOMDocument for parsing
        $dom = new DOMDocument();

        // Suppress warnings for malformed HTML
        libxml_use_internal_errors(true);

        // Wrap in a container to preserve structure
        // Use mb4 encoding prefix for UTF-8 support
        $wrappedHtml = '<!DOCTYPE html><html><head><meta charset="UTF-8"></head><body>' . $html . '</body></html>';
        $dom->loadHTML($wrappedHtml, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        libxml_clear_errors();

        // Get the body element
        $body = $dom->getElementsByTagName('body')->item(0);

        if (!$body) {
            return false;
        }

        // Validate all child elements
        foreach ($body->childNodes as $node) {
            if (!self::validateElement($node)) {
                return false;
            }
        }

        // Export cleaned HTML
        $cleaned = '';
        foreach ($body->childNodes as $node) {
            $cleaned .= $dom->saveHTML($node);
        }

        return trim($cleaned);
    }

    /**
     * Recursively validate DOM element
     *
     * @param DOMElement $element Element to validate
     * @return bool True if valid, false otherwise
     */
    private static function validateElement($element) {
        if ($element->nodeType === XML_TEXT_NODE) {
            return true;
        }

        if ($element->nodeType !== XML_ELEMENT_NODE) {
            return false;
        }

        $tagName = strtolower($element->tagName);

        // Check if tag is allowed
        if (!isset(self::$allowedTags[$tagName])) {
            return false;
        }

        $allowedAttrs = self::$allowedTags[$tagName];

        // Validate attributes
        if ($element->hasAttributes()) {
            foreach ($element->attributes as $attr) {
                $attrName = strtolower($attr->name);

                // Check if attribute is allowed for this tag
                if (!in_array($attrName, $allowedAttrs)) {
                    return false;
                }

                // Special validation for URLs (src, href)
                if (in_array($attrName, ['src', 'href'])) {
                    if (!self::validateUrl($attr->value, $tagName)) {
                        return false;
                    }
                }

                // Validate style attribute (prevent JavaScript)
                if ($attrName === 'style') {
                    if (!self::validateStyle($attr->value)) {
                        return false;
                    }
                }
            }
        }

        // Recursively validate child elements
        foreach ($element->childNodes as $child) {
            if (!self::validateElement($child)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Validate URL for safety
     *
     * @param string $url URL to validate
     * @param string $tagName Tag name (for domain checking)
     * @return bool True if valid, false otherwise
     */
    private static function validateUrl($url, $tagName) {
        // Parse URL
        $parsed = parse_url($url);

        if ($parsed === false) {
            return false;
        }

        // Check protocol
        if (isset($parsed['scheme'])) {
            if (!in_array(strtolower($parsed['scheme']), self::$allowedProtocols)) {
                return false;
            }

            // For iframe and script, check domain whitelist
            if (in_array($tagName, ['iframe', 'script']) && isset($parsed['host'])) {
                $host = strtolower($parsed['host']);
                $allowed = false;

                foreach (self::$trustedDomains as $trustedDomain) {
                    if ($host === $trustedDomain ||
                        substr($host, -(strlen($trustedDomain) + 1)) === '.' . $trustedDomain) {
                        $allowed = true;
                        break;
                    }
                }

                if (!$allowed) {
                    return false;
                }
            }
        }

        // Prevent javascript: urls
        if (stripos($url, 'javascript:') !== false) {
            return false;
        }

        // Prevent data: URLs except for trusted tags
        if (stripos($url, 'data:') === 0 && in_array($tagName, ['iframe', 'script'])) {
            return false;
        }

        return true;
    }

    /**
     * Validate CSS style attribute
     *
     * @param string $style CSS style string
     * @return bool True if valid, false otherwise
     */
    private static function validateStyle($style) {
        // Prevent JavaScript in styles
        if (stripos($style, 'javascript:') !== false) {
            return false;
        }

        // Prevent expression() (old IE vulnerability)
        if (stripos($style, 'expression') !== false) {
            return false;
        }

        // Prevent import (could load external malicious CSS)
        if (stripos($style, '@import') !== false) {
            return false;
        }

        return true;
    }

    /**
     * Get trusted domains (for CSP configuration)
     *
     * @return array List of trusted domains
     */
    public static function getTrustedDomains() {
        return self::$trustedDomains;
    }

    /**
     * Add a trusted domain to the whitelist
     *
     * @param string $domain Domain to add
     */
    public static function addTrustedDomain($domain) {
        if (!in_array($domain, self::$trustedDomains)) {
            self::$trustedDomains[] = $domain;
        }
    }

    /**
     * Add allowed tag with attributes
     *
     * @param string $tag Tag name
     * @param array $attributes Allowed attributes
     */
    public static function addAllowedTag($tag, $attributes = []) {
        self::$allowedTags[strtolower($tag)] = $attributes;
    }
}
