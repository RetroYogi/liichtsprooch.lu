# Security Documentation

This document outlines the security measures implemented in the Liicht Sprooch website.

## Security Measures Implemented

### 1. Input Validation & Sanitization

#### Article Slug Validation (artikel.php)
- **Protection**: Prevents path traversal and injection attacks
- **Implementation**:
  - Regex validation: Only allows `[a-z0-9-]+` characters
  - Whitelist validation: Slug must exist in config.php articles array
  - Input trimming and sanitization
- **Location**: `artikel.php:38-42`, `config.php:102-116`

#### Path Traversal Prevention (artikel.php)
- **Protection**: Prevents reading files outside the web root
- **Implementation**:
  - Uses `realpath()` to resolve the actual file path
  - Validates that resolved path starts with the base directory
  - Double-checks file existence within safe boundaries
- **Location**: `artikel.php:56-65`

#### Category Validation (config.php)
- **Protection**: Prevents category injection attacks
- **Implementation**: Validates category against whitelist in `$categories` array
- **Location**: `config.php:123-138`

### 2. Cross-Site Scripting (XSS) Prevention

#### Parsedown Security Mode
- **Protection**: Prevents XSS through markdown content
- **Implementation**:
  - `setSafeMode(true)`: Escapes HTML in markdown
  - `setMarkupEscaped(true)`: Escapes HTML entities
- **Location**: `artikel.php:75-77`

#### HTML Output Escaping
- **Protection**: Prevents XSS in dynamic content
- **Implementation**: All user data is escaped with `htmlspecialchars()` using:
  - `ENT_QUOTES`: Escapes both single and double quotes
  - `ENT_HTML5`: Uses HTML5 entities
  - `UTF-8` charset
- **Locations**: Throughout all PHP files (index.php, artikel.php, rss.php)

#### Helper Functions
- `escapeHtml()`: Standard HTML escaping
- `escapeUrl()`: URL-specific escaping with protocol validation
- **Location**: `security.php:82-99`

### 3. Security Headers

#### HTTP Security Headers
All pages send the following headers via centralized `security-headers.php`:

```
X-Frame-Options: SAMEORIGIN
X-Content-Type-Options: nosniff
X-XSS-Protection: 1; mode=block
Referrer-Policy: strict-origin-when-cross-origin
Permissions-Policy: geolocation=(), microphone=(), camera=()
Strict-Transport-Security: max-age=31536000; includeSubDomains (HTTPS only)
```

- **Protection**: Prevents clickjacking, MIME sniffing, XSS, referrer leaks, and enforces HTTPS
- **Location**: `security-headers.php:45-55`

#### Content Security Policy (CSP)
- **Protection**: Restricts resource loading to prevent XSS and data injection
- **Implementation**: PHP headers via `security-headers.php`
- **Policy**:
  - `default-src 'self'`: Only load resources from same origin
  - `script-src 'self' 'unsafe-inline'`: Allows inline scripts (for mobile menu)
  - `style-src 'self' 'unsafe-inline' https://fonts.googleapis.com`: Allows styles
  - `font-src 'self' https://fonts.gstatic.com`: Google Fonts
  - `frame-src`: Dynamically allows whitelisted domains (Vimeo, YouTube, etc.)
  - Article pages have more permissive CSP for embeds
  - Non-article pages have strict CSP
- **Location**: `security-headers.php:58-85`

### 4. Rate Limiting

#### Request Rate Limiting
- **Protection**: Prevents abuse, DoS attacks, and brute force attempts
- **Implementation**:
  - **File-based tracking** of requests per IP (more robust than session-based)
  - Persists across sessions and server restarts
  - Default: 60 requests per 60 seconds
  - Configurable limits per endpoint
  - Automatic cleanup of old entries
  - Uses JSON files with file locking for thread safety
- **Location**: `security.php:14-77`, `artikel.php:28-32`

### 5. Bot Detection & Blocking

#### Malicious Bot Detection
- **Protection**: Blocks automated scanners and malicious bots
- **Implementation**:
  - User-Agent pattern matching
  - Blocks common security scanners (sqlmap, nikto, nmap, etc.)
  - Blocks automated tools (curl, wget, python-requests)
  - Logs suspicious access attempts
- **Location**: `security.php:122-144`, `artikel.php:21-25`

### 6. Security Logging

#### Event Logging System
- **Protection**: Monitors and tracks security events for analysis
- **Implementation**:
  - Logs security violations to `logs/security.log`
  - Captures: timestamp, severity, IP, User-Agent, URI, message
  - Automatic log directory creation with restricted permissions (0750)
  - Thread-safe file writing with locks
  - **Automatic log rotation** at 10MB to prevent disk space issues
  - **Log injection prevention**: Truncates and sanitizes all logged data
  - User-Agent and URI limited to 200 characters
  - Newlines, carriage returns, and tabs stripped from all fields
  - Proper error handling with fallback to system error log
- **Location**: `security.php:106-150`

#### Logged Events
- Invalid slug attempts
- Rate limit violations
- Suspicious bot access
- Path traversal attempts (via .htaccess)
- SQL injection attempts (via .htaccess)

### 7. Server-Level Protection (.htaccess)

#### Directory & File Access Control
```apache
Options -Indexes                    # Disable directory listing
Deny access to: .htaccess, .git, config.php, .env, .md files
```

#### Malicious Request Blocking
Blocks requests containing:
- SQL injection patterns (UNION, SELECT, DROP, etc.)
- Path traversal patterns (../, %2e%2e)
- Base64 encoding in URLs
- PHP code injection attempts (<script>, GLOBALS, _REQUEST)

#### PHP Security Settings
```apache
display_errors: Off
expose_php: Off
session.cookie_httponly: 1
session.cookie_secure: 1
session.cookie_samesite: Strict
```

**Location**: `.htaccess:10-67`

### 8. Session Security

#### Secure Session Configuration
- **HttpOnly cookies**: Prevents JavaScript access to session cookies
- **Secure flag**: Ensures cookies only sent over HTTPS (when HTTPS is detected)
- **SameSite: Strict**: Prevents CSRF attacks
- **Strict mode**: Rejects uninitialized session IDs
- **Use only cookies**: Prevents session ID in URL parameters
- **Session fixation protection**: Regenerates session ID on first use
- **Session timeout**: 30 minutes of inactivity
- **Location**: `security-headers.php:10-35`

### 9. IP Address Handling

#### Proxy-Aware IP Detection
- **Protection**: Correctly identifies client IP even behind proxies/CDN
- **Implementation**:
  - Checks multiple headers in order: CF-Connecting-IP, X-Forwarded-For, X-Real-IP, REMOTE_ADDR
  - Validates IPs (excludes private/reserved ranges)
  - Handles multiple IPs in X-Forwarded-For
- **Location**: `security.php:44-73`

## Security Best Practices

### For Deployment

1. **HTTPS Only**: Always serve the site over HTTPS
   - Update `session.cookie_secure` requires HTTPS
   - CSP and security headers work best with HTTPS

2. **File Permissions**:
   ```bash
   chmod 644 *.php *.md
   chmod 755 assets/
   chmod 750 logs/
   chmod 600 config.php  # Most sensitive file
   ```

3. **Hide .htaccess Rules**:
   - Keep `.htaccess` and `.md` files blocked from public access
   - Ensure `.git` directory is not in web root

4. **Monitor Logs**:
   - Regularly check `logs/security.log` for suspicious activity
   - Set up log rotation to prevent disk space issues
   - Consider alerting for repeated violations from same IP

5. **Update Dependencies**:
   - Keep Parsedown library updated: https://github.com/erusev/parsedown
   - Monitor for security advisories

6. **Remove Debug Output**:
   - Ensure `display_errors` is OFF in production
   - Remove any `var_dump()`, `print_r()` calls
   - Use proper error logging instead

### For Content Management

1. **Markdown Files**:
   - All markdown files are processed through Parsedown's safe mode
   - HTML in markdown is automatically escaped
   - If you need to embed HTML (like videos), do it in PHP templates, not markdown

2. **Adding New Articles**:
   - Only add articles through `config.php`
   - Validate all article metadata
   - Use URL-safe slugs (lowercase, numbers, hyphens only)

3. **File Uploads** (if added in future):
   - Validate file types (whitelist)
   - Check file size limits
   - Rename files on upload
   - Store outside web root if possible
   - Scan for malware

## Vulnerability Disclosure

If you discover a security vulnerability, please report it to:
- **Email**: [Your security contact email]
- **PGP Key**: [If applicable]

**Please DO NOT** create public GitHub issues for security vulnerabilities.

## Security Checklist

- [x] Input validation on all user inputs
- [x] Path traversal prevention (with DIRECTORY_SEPARATOR)
- [x] XSS protection via output escaping
- [x] Parsedown safe mode enabled
- [x] **Script tag support removed from HtmlEmbed** (Critical fix - 2025-01-09)
- [x] Security headers (X-Frame-Options, CSP, Permissions-Policy, etc.)
- [x] **Content Security Policy implemented** (High priority fix - 2025-01-09)
- [x] **File-based rate limiting** (Improved from session-based - 2025-01-09)
- [x] Bot detection and blocking
- [x] **Security event logging with rotation and injection prevention** (Improved - 2025-01-09)
- [x] **Comprehensive session security** (HttpOnly, Secure, SameSite, fixation protection, timeout - 2025-01-09)
- [x] SQL injection blocking (preventive, no DB used)
- [x] PHP error disclosure prevented
- [x] Server information hiding
- [x] **HSTS header** (when HTTPS detected - 2025-01-09)
- [ ] HTTPS enforcement (requires server configuration)
- [ ] Automated security scanning (optional)
- [ ] Penetration testing (optional)

## Testing Security

### Manual Testing

1. **Path Traversal Test**:
   ```
   artikel.php?a=../../../etc/passwd
   artikel.php?a=....//....//etc/passwd
   ```
   Expected: 400 Bad Request or 404 Not Found

2. **XSS Test**:
   Add malicious markdown to article:
   ```markdown
   <script>alert('XSS')</script>
   ```
   Expected: Script tags are escaped

3. **Rate Limit Test**:
   ```bash
   for i in {1..65}; do curl http://localhost:8000/artikel.php?a=klaro-am-detail; done
   ```
   Expected: 429 Too Many Requests after 60 requests

4. **Bot Detection Test**:
   ```bash
   curl -A "sqlmap/1.0" http://localhost:8000/artikel.php?a=klaro-am-detail
   ```
   Expected: 403 Forbidden

### Automated Testing Tools

- **OWASP ZAP**: Web application security scanner
- **Nikto**: Web server scanner
- **Mozilla Observatory**: Security header checker

## Compliance

This implementation follows:
- **OWASP Top 10** (2021) best practices
- **CWE** (Common Weakness Enumeration) mitigations
- **WCAG 2.1 AA** accessibility standards (not security, but implemented)

## Updates & Maintenance

**Last Security Review**: 2025-01-09
**Last Security Fixes Applied**: 2025-01-09
**Next Scheduled Review**: 2025-04-09 (quarterly)

### Recent Security Improvements (2025-01-09)

1. **Removed script tag support** from HtmlEmbed.php to eliminate XSS risk
2. **Implemented Content Security Policy** headers for all pages
3. **Enhanced session security** with fixation protection, timeout, and comprehensive flags
4. **Upgraded rate limiting** from session-based to file-based for better persistence
5. **Improved logging** with automatic rotation, size limits, and injection prevention
6. **Added HSTS header** for HTTPS enforcement
7. **Created centralized security configuration** in `security-headers.php`

---

**Remember**: Security is an ongoing process, not a one-time implementation. Regularly review and update security measures as new threats emerge.
