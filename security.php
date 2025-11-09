<?php
/**
 * Security Helper Functions
 * Additional security utilities for the website
 */

/**
 * File-based rate limiting to prevent abuse
 * More robust than session-based as it persists across sessions and server restarts
 * @param int $limit Maximum requests per time window
 * @param int $window Time window in seconds
 * @return bool True if request is allowed, false if rate limit exceeded
 */
function checkRateLimit($limit = 60, $window = 60) {
    $ip = getClientIP();
    $rateDir = __DIR__ . '/logs/rate_limit';
    $rateFile = $rateDir . '/' . md5($ip) . '.json';
    $now = time();

    // Create directory if it doesn't exist
    if (!is_dir($rateDir)) {
        mkdir($rateDir, 0750, true);
    }

    // Read existing rate limit data
    $data = [];
    if (file_exists($rateFile)) {
        $content = file_get_contents($rateFile);
        if ($content !== false) {
            $data = json_decode($content, true) ?? [];
        }
    }

    // Clean old entries (outside the time window)
    $data = array_filter($data, function($timestamp) use ($now, $window) {
        return ($now - $timestamp) < $window;
    });

    // Check if limit exceeded
    if (count($data) >= $limit) {
        return false;
    }

    // Add current request timestamp
    $data[] = $now;

    // Save updated data with file locking
    file_put_contents($rateFile, json_encode($data), LOCK_EX);

    // Cleanup old rate limit files (once per 100 requests randomly)
    if (rand(1, 100) === 1) {
        cleanupRateLimitFiles($rateDir, $window);
    }

    return true;
}

/**
 * Cleanup old rate limit files to prevent disk space issues
 * @param string $rateDir Rate limit directory
 * @param int $window Time window in seconds
 */
function cleanupRateLimitFiles($rateDir, $window) {
    $now = time();
    $files = glob($rateDir . '/*.json');

    if ($files === false) {
        return;
    }

    foreach ($files as $file) {
        // Delete files older than 2x the window period
        if (is_file($file) && (filemtime($file) < $now - ($window * 2))) {
            @unlink($file);
        }
    }
}

/**
 * Get client IP address (handles proxies)
 * @return string Client IP address
 */
function getClientIP() {
    $ip = '';

    // Check for proxy headers (in order of preference)
    $headers = [
        'HTTP_CF_CONNECTING_IP', // Cloudflare
        'HTTP_X_FORWARDED_FOR',  // Standard proxy header
        'HTTP_X_REAL_IP',        // Nginx proxy
        'REMOTE_ADDR'            // Direct connection
    ];

    foreach ($headers as $header) {
        if (!empty($_SERVER[$header])) {
            // Handle multiple IPs in X-Forwarded-For (take first one)
            $ip = trim(explode(',', $_SERVER[$header])[0]);

            // Validate IP
            if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
                return $ip;
            }
        }
    }

    // Fallback to REMOTE_ADDR
    return $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
}

/**
 * Sanitize output for HTML display
 * @param string $text Text to sanitize
 * @return string Sanitized text
 */
function escapeHtml($text) {
    return htmlspecialchars($text, ENT_QUOTES | ENT_HTML5, 'UTF-8');
}

/**
 * Sanitize URL for safe output
 * @param string $url URL to sanitize
 * @return string Sanitized URL
 */
function escapeUrl($url) {
    // Only allow http, https, and mailto protocols
    $parsed = parse_url($url);
    if (isset($parsed['scheme']) && !in_array($parsed['scheme'], ['http', 'https', 'mailto'])) {
        return '';
    }
    return htmlspecialchars($url, ENT_QUOTES | ENT_HTML5, 'UTF-8');
}

/**
 * Log security events (for monitoring)
 * @param string $message Event message
 * @param string $level Severity level (info, warning, error)
 */
function logSecurityEvent($message, $level = 'warning') {
    $logFile = __DIR__ . '/logs/security.log';
    $logDir = dirname($logFile);
    $maxSize = 10 * 1024 * 1024; // 10MB max log file size

    // Create log directory if it doesn't exist
    if (!is_dir($logDir)) {
        mkdir($logDir, 0750, true);
    }

    // Rotate log file if it's too large
    if (file_exists($logFile) && filesize($logFile) > $maxSize) {
        rename($logFile, $logFile . '.' . date('Y-m-d-His'));
    }

    $timestamp = date('Y-m-d H:i:s');
    $ip = getClientIP();

    // Truncate and sanitize User-Agent to prevent log injection
    $userAgent = substr($_SERVER['HTTP_USER_AGENT'] ?? 'Unknown', 0, 200);
    $userAgent = str_replace(["\n", "\r", "\t"], ' ', $userAgent);

    // Truncate and sanitize URI to prevent log injection
    $requestUri = substr($_SERVER['REQUEST_URI'] ?? 'Unknown', 0, 200);
    $requestUri = str_replace(["\n", "\r", "\t"], ' ', $requestUri);

    // Sanitize message to prevent log injection
    $message = str_replace(["\n", "\r", "\t"], ' ', $message);

    $logEntry = sprintf(
        "[%s] [%s] IP: %s | UA: %s | URI: %s | Message: %s\n",
        $timestamp,
        strtoupper($level),
        $ip,
        $userAgent,
        $requestUri,
        $message
    );

    // Write to log file with proper error handling
    if (file_put_contents($logFile, $logEntry, FILE_APPEND | LOCK_EX) === false) {
        // Fallback to system error log if file write fails
        error_log("Failed to write security log: $message");
    }
}

/**
 * Check if request appears to be from a bot
 * @return bool True if bot detected
 */
function isSuspiciousBot() {
    $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';

    // Common malicious bot patterns
    $botPatterns = [
        '/python-requests/i',
        '/curl\//i',
        '/wget/i',
        '/libwww/i',
        '/scanner/i',
        '/nikto/i',
        '/sqlmap/i',
        '/masscan/i',
        '/nmap/i'
    ];

    foreach ($botPatterns as $pattern) {
        if (preg_match($pattern, $userAgent)) {
            return true;
        }
    }

    return false;
}

/**
 * Validate and sanitize file paths
 * @param string $path File path to validate
 * @param string $baseDir Base directory (default: current directory)
 * @return string|false Sanitized real path or false if invalid
 */
function validateFilePath($path, $baseDir = __DIR__) {
    $realPath = realpath($baseDir . '/' . $path);
    $realBaseDir = realpath($baseDir);

    // Ensure file exists and is within base directory
    if ($realPath === false || strpos($realPath, $realBaseDir) !== 0) {
        return false;
    }

    return $realPath;
}
