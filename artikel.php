<?php
/**
 * Article display page
 * Reads markdown files and displays them as HTML
 */

require_once 'config.php';
require_once 'Parsedown.php';
require_once 'security.php';
require_once 'security-headers.php';
require_once 'HtmlEmbed.php';

// Configure secure session and set security headers
configureSecureSession();
setSecurityHeaders(true);  // Article page with embeds

// Check for suspicious bots
if (isSuspiciousBot()) {
    logSecurityEvent('Suspicious bot detected', 'warning');
    header('HTTP/1.0 403 Forbidden');
    die('Access denied.');
}

// Rate limiting (60 requests per minute)
if (!checkRateLimit(60, 60)) {
    logSecurityEvent('Rate limit exceeded', 'warning');
    header('HTTP/1.0 429 Too Many Requests');
    die('Rate limit exceeded. Please try again later.');
}

// Get article slug from URL and sanitize
$slug = isset($_GET['a']) ? trim($_GET['a']) : null;

// Validate slug format (only lowercase letters, numbers, and hyphens)
if ($slug && !preg_match('/^[a-z0-9-]+$/', $slug)) {
    logSecurityEvent('Invalid slug format: ' . $slug, 'warning');
    header('HTTP/1.0 400 Bad Request');
    die('Invalid article identifier.');
}

if (!$slug) {
    header('Location: index.php');
    exit;
}

// Get article data - this validates slug against whitelist
$article = getArticle($slug);

if (!$article) {
    header('HTTP/1.0 404 Not Found');
    die('Artikel net fonnt.');
}

// Use realpath to prevent path traversal attacks
$markdownFile = __DIR__ . '/' . $article['markdown_file'];
$realMarkdownFile = realpath($markdownFile);
$baseDir = realpath(__DIR__);

// Verify the file is within the expected directory
// Use DIRECTORY_SEPARATOR to ensure path comparison works correctly on all platforms
if (!$realMarkdownFile || strpos($realMarkdownFile, $baseDir . DIRECTORY_SEPARATOR) !== 0) {
    logSecurityEvent('Path traversal attempt or file not in base directory: ' . $article['markdown_file'], 'error');
    header('HTTP/1.0 404 Not Found');
    die('Artikel net fonnt.');
}

if (!file_exists($realMarkdownFile)) {
    header('HTTP/1.0 404 Not Found');
    die('Artikel net fonnt.');
}

$markdownContent = file_get_contents($realMarkdownFile);

// Process HTML embeds first (extract them before markdown processing)
$embedResult = HtmlEmbed::process($markdownContent);
$markdownContent = $embedResult['markdown'];
$htmlEmbeds = $embedResult['embeds'];

// Remove the first H1 heading from markdown (since we display title in header)
// This removes lines starting with # (H1 in markdown)
$lines = explode("\n", $markdownContent);
$contentLines = [];
$foundFirstH1 = false;

foreach ($lines as $line) {
    // Skip the first H1 heading (starts with # but not ## or ###)
    if (!$foundFirstH1 && preg_match('/^#\s+/', $line) && !preg_match('/^#{2,}/', $line)) {
        $foundFirstH1 = true;
        continue; // Skip this line
    }
    $contentLines[] = $line;
}

$markdownContent = implode("\n", $contentLines);

// Initialize Parsedown with security settings
$Parsedown = new Parsedown();
$Parsedown->setSafeMode(true); // Prevent XSS by escaping HTML in markdown
$Parsedown->setMarkupEscaped(true); // Escape HTML entities
$htmlContent = $Parsedown->text($markdownContent);

// Restore HTML embeds after markdown processing
$htmlContent = HtmlEmbed::restore($htmlContent, $htmlEmbeds);

// Set up variables for header template
$pageTitle = $article['title'] . ' | ' . SITE_TITLE;
$metaDescription = $article['description'];
$canonicalUrl = SITE_URL . '/artikel/' . $slug;
$ogType = 'article';
$articleAuthor = $article['author'];
$articleDate = $article['date'];
$articleCategory = $article['category'];

// Get other articles from same category for "related articles"
$relatedArticles = getArticlesByCategory($article['category']);
$relatedArticles = array_filter($relatedArticles, function($a) use ($slug) {
    return $a['slug'] !== $slug;
});
$relatedArticles = array_slice($relatedArticles, 0, 3);

// Include header template
include 'header.php';
?>

    <!-- Main Container -->
    <main id="main-content">
        <!-- Breadcrumb -->
        <nav class="breadcrumb" aria-label="Breadcrumb">
            <a href="/index.php">Startsäit</a> /
            <span><?php echo htmlspecialchars($article['category']); ?></span> /
            <span aria-current="page"><?php echo htmlspecialchars($article['title']); ?></span>
        </nav>

        <!-- Article -->
        <article class="article-content">
            <header class="article-header">
                <div class="article-meta">
                    <span class="article-category"><?php echo htmlspecialchars($article['category']); ?></span>
                    <time class="article-date" datetime="<?php echo $article['date']; ?>">
                        <?php echo formatDateLB($article['date']); ?>
                    </time>
                </div>
                <h1><?php echo htmlspecialchars($article['title']); ?></h1>
            </header>

            <div class="article-body">
                <?php echo $htmlContent; ?>
            </div>

            <footer class="article-footer">
                <div class="article-share">
                    <strong>Deelt dësen Artikel:</strong>
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode($canonicalUrl); ?>" target="_blank" rel="noopener" aria-label="Op Facebook deelen">Facebook</a>
                    <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode($canonicalUrl); ?>&text=<?php echo urlencode($article['title']); ?>" target="_blank" rel="noopener" aria-label="Op Twitter deelen">Twitter</a>
                    <a href="mailto:?subject=<?php echo urlencode($article['title']); ?>&body=<?php echo urlencode($canonicalUrl); ?>" aria-label="Per E-Mail deelen">E-Mail</a>
                </div>
            </footer>
        </article>

        <!-- Related Articles -->
        <?php if (!empty($relatedArticles)): ?>
        <aside class="related-articles" aria-labelledby="related-heading">
            <h2 id="related-heading">Méi Artikelen aus "<?php echo htmlspecialchars($article['category']); ?>"</h2>
            <div class="related-grid">
                <?php foreach ($relatedArticles as $related): ?>
                <article class="related-card">
                    <h3><a href="artikel/<?php echo urlencode($related['slug']); ?>"><?php echo htmlspecialchars($related['title']); ?></a></h3>
                    <p><?php echo htmlspecialchars($related['description']); ?></p>
                    <time datetime="<?php echo $related['date']; ?>"><?php echo formatDateLB($related['date']); ?></time>
                </article>
                <?php endforeach; ?>
            </div>
        </aside>
        <?php endif; ?>

        <!-- Back to Home -->
        <div class="back-to-home">
            <a href="/index.php" class="button-primary">← Zréck op d'Haaptsäit</a>
        </div>
    </main>

<?php include 'footer.php'; ?>
