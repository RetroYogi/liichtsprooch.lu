<?php
/**
 * Security Headers and Session Configuration
 * Centralized security header management for all pages
 */

/**
 * Configure secure session settings
 */
function configureSecureSession() {
    // Only configure if session hasn't started yet
    if (session_status() === PHP_SESSION_NONE) {
        // Session security settings
        ini_set('session.cookie_httponly', 1);  // Prevent JavaScript access
        ini_set('session.cookie_samesite', 'Strict');  // CSRF protection
        ini_set('session.use_strict_mode', 1);  // Reject uninitialized session IDs
        ini_set('session.use_only_cookies', 1);  // Only use cookies, not URL params

        // Only enable secure flag if using HTTPS
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
            ini_set('session.cookie_secure', 1);
        }

        session_start();

        // Session fixation protection
        if (!isset($_SESSION['initiated'])) {
            session_regenerate_id(true);
            $_SESSION['initiated'] = true;
            $_SESSION['created'] = time();
        }

        // Session timeout (30 minutes of inactivity)
        if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 1800)) {
            session_unset();
            session_destroy();
            session_start();
            $_SESSION['initiated'] = true;
            $_SESSION['created'] = time();
        }
        $_SESSION['last_activity'] = time();
    }
}

/**
 * Set security headers for all pages
 * @param bool $isArticlePage Whether this is an article page (affects CSP)
 */
function setSecurityHeaders($isArticlePage = false) {
    // Basic security headers
    header('X-Frame-Options: SAMEORIGIN');
    header('X-Content-Type-Options: nosniff');
    header('X-XSS-Protection: 1; mode=block');
    header('Referrer-Policy: strict-origin-when-cross-origin');
    header('Permissions-Policy: geolocation=(), microphone=(), camera=()');

    // HSTS - only if using HTTPS
    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
        header('Strict-Transport-Security: max-age=31536000; includeSubDomains');
    }

    // Content Security Policy
    if ($isArticlePage) {
        // More permissive CSP for article pages with embeds
        require_once 'HtmlEmbed.php';
        $trustedDomains = HtmlEmbed::getTrustedDomains();

        $frameSrc = implode(' ', array_map(function($d) {
            return "https://$d";
        }, $trustedDomains));

        header("Content-Security-Policy: " .
            "default-src 'self'; " .
            "script-src 'self' 'unsafe-inline' https://fonts.googleapis.com; " .
            "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; " .
            "font-src 'self' https://fonts.gstatic.com; " .
            "img-src 'self' data: https:; " .
            "frame-src $frameSrc; " .
            "object-src 'none'; " .
            "base-uri 'self'; " .
            "form-action 'self';"
        );
    } else {
        // Strict CSP for non-article pages
        header("Content-Security-Policy: " .
            "default-src 'self'; " .
            "script-src 'self' 'unsafe-inline'; " .
            "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; " .
            "font-src 'self' https://fonts.gstatic.com; " .
            "img-src 'self' data: https:; " .
            "frame-src 'none'; " .
            "object-src 'none'; " .
            "base-uri 'self'; " .
            "form-action 'self';"
        );
    }
}
