<?php
/**
 * AJAX API Endpoint for fetching paginated articles
 * Returns articles in JSON format for client-side rendering
 */

header('Content-Type: application/json');
header('Cache-Control: no-cache, must-revalidate');

require_once '../config.php';
require_once '../security.php';

// Validate AJAX request
if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) ||
    strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest') {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid request']);
    exit;
}

// Get pagination parameters
$offset = isset($_GET['offset']) ? max(0, intval($_GET['offset'])) : 0;
$limit = isset($_GET['limit']) ? min(10, max(1, intval($_GET['limit']))) : 3;

// Get all articles
$allArticles = getAllArticles();
$totalArticles = count($allArticles);

// Slice articles for current page
$articles = array_slice($allArticles, $offset, $limit);

// Prepare response
$response = [
    'success' => true,
    'articles' => [],
    'pagination' => [
        'offset' => $offset,
        'limit' => $limit,
        'total' => $totalArticles,
        'hasNext' => ($offset + $limit) < $totalArticles,
        'hasPrev' => $offset > 0
    ]
];

// Format articles for output
foreach ($articles as $article) {
    $response['articles'][] = [
        'slug' => $article['slug'],
        'title' => $article['title'],
        'description' => $article['description'],
        'category' => $article['category'],
        'date' => $article['date'],
        'dateFormatted' => formatDateLB($article['date']),
        'url' => '/artikel/' . urlencode($article['slug']) . '/'
    ];
}

echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
