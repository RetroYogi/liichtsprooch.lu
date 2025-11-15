<?php
/**
 * Router for PHP Built-in Server
 *
 * This router script enables the PHP built-in server to behave like GitHub Pages,
 * serving index.html files for directory requests and handling 404s properly.
 *
 * Usage:
 *   cd docs
 *   php -S localhost:8000 router.php
 *
 * This makes URLs like /artikel/klaro-am-detail work correctly by serving
 * /artikel/klaro-am-detail/index.html
 */

// Get the requested URI and remove query string
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = urldecode($uri);

// Security: Prevent directory traversal
if (strpos($uri, '..') !== false) {
    http_response_code(400);
    echo '400 Bad Request';
    return false;
}

// Build the file path
$filePath = __DIR__ . $uri;

// If it's a directory, try to serve index.html
if (is_dir($filePath)) {
    // Remove trailing slash for consistency
    $uri = rtrim($uri, '/');
    $filePath = rtrim($filePath, '/');

    $indexPath = $filePath . '/index.html';

    if (file_exists($indexPath)) {
        // Serve the index.html file
        $mimeType = 'text/html';
        header('Content-Type: ' . $mimeType);
        readfile($indexPath);
        return true;
    }
}

// If it's a file, let PHP's built-in server handle it
if (is_file($filePath)) {
    return false; // Let the built-in server serve the file
}

// If path doesn't exist, try adding .html extension
if (!file_exists($filePath) && !is_dir($filePath)) {
    $htmlPath = $filePath . '.html';
    if (file_exists($htmlPath)) {
        header('Content-Type: text/html');
        readfile($htmlPath);
        return true;
    }
}

// 404 - Not Found
http_response_code(404);
$notFoundPath = __DIR__ . '/404.html';
if (file_exists($notFoundPath)) {
    readfile($notFoundPath);
} else {
    echo '404 Not Found';
}
return true;
