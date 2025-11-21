#!/usr/bin/env php
<?php
/**
 * Multilingual Static Site Generator for Liicht Sprooch
 *
 * This script generates a static HTML version of the site for multiple languages.
 * Each language gets its own folder, and domain routing happens via Cloudflare.
 *
 * Usage: php build-multilingual.php
 */

// Configuration
define('BUILD_DIR', __DIR__ . '/docs');
define('SOURCE_DIR', __DIR__);

echo "Building multilingual static site...\n\n";

// Include required files
require_once SOURCE_DIR . '/config/languages.php';
require_once SOURCE_DIR . '/config/articles.php';
require_once SOURCE_DIR . '/Parsedown.php';
require_once SOURCE_DIR . '/HtmlEmbed.php';

// Get active languages (only build languages that have content)
$activeLanguages = ['lb']; // Start with just Luxembourgish
// Add other languages as they get content:
// $activeLanguages = ['lb', 'de', 'fr', 'en'];

// Clean and create build directory
if (file_exists(BUILD_DIR)) {
    deleteDirectory(BUILD_DIR);
    echo "Cleaned old build directory\n";
}
mkdir(BUILD_DIR, 0755, true);
echo "Created build directory: docs/\n";

// Copy shared assets
copyDirectory(SOURCE_DIR . '/assets', BUILD_DIR . '/assets');
echo "Copied shared assets/\n";

// Track statistics
$stats = [
    'languages' => 0,
    'articles' => 0,
    'pages' => 0
];

// Build each language
foreach ($activeLanguages as $lang) {
    echo "\n--- Building $lang ---\n";

    // Set current language
    setLanguage($lang);
    $langConfig = getLanguageConfig($lang);
    $siteConfig = getSiteConfig($lang);

    // Create language directory
    $langDir = BUILD_DIR . '/' . $lang;
    mkdir($langDir, 0755, true);

    // Generate homepage
    generateHomepage($lang, $langDir);
    echo "  Generated homepage\n";
    $stats['pages']++;

    // Generate article pages
    $articles = getAllArticles($lang);
    $articleCount = 0;
    foreach ($articles as $article) {
        generateArticlePage($article, $lang, $langDir);
        $articleCount++;
    }
    echo "  Generated $articleCount articles\n";
    $stats['articles'] += $articleCount;

    // Generate RSS feed
    generateRSSFeed($lang, $langDir);
    echo "  Generated RSS feed\n";

    // Generate articles JSON
    generateArticlesJSON($lang, $langDir);
    echo "  Generated articles JSON\n";

    // Generate 404 page
    generate404Page($lang, $langDir);
    echo "  Generated 404 page\n";
    $stats['pages']++;

    // Generate About page
    generateAboutPage($lang, $langDir);
    echo "  Generated About page\n";
    $stats['pages']++;

    // Generate sitemap
    generateSitemap($lang, $langDir);
    echo "  Generated sitemap\n";

    $stats['languages']++;
}

// Generate root redirect (redirects to default language)
generateRootRedirect();
echo "\nGenerated root redirect\n";

// Generate domain routing configuration
generateDomainRouting();
echo "Generated domain routing config\n";

// Copy necessary root files
if (file_exists(SOURCE_DIR . '/CNAME')) {
    // Don't copy CNAME - we'll handle multiple domains via Cloudflare
    echo "Note: CNAME not copied - use Cloudflare for domain routing\n";
}

echo "\n Build complete!\n";
echo "   Languages: {$stats['languages']}\n";
echo "   Articles: {$stats['articles']}\n";
echo "   Pages: {$stats['pages']}\n";
echo "   Total files: " . countFiles(BUILD_DIR) . "\n";
echo "\n Next steps:\n";
echo "   1. Review the generated files in docs/\n";
echo "   2. Push to GitHub\n";
echo "   3. Configure Cloudflare Pages with domain routing\n\n";

// ============================================================================
// Generator Functions
// ============================================================================

/**
 * Generate the homepage for a language
 */
function generateHomepage($lang, $langDir) {
    global $currentLanguage;

    $siteConfig = getSiteConfig($lang);
    $langConfig = getLanguageConfig($lang);
    $categories = getCategories($lang);
    $recentArticles = getAllArticles($lang);

    // Page variables
    $currentPage = 'home';
    $pageTitle = $siteConfig['title'];
    $metaDescription = $siteConfig['description'];
    $metaKeywords = $siteConfig['keywords'];
    $canonicalUrl = $siteConfig['url'];
    $ogType = 'website';
    $currentLanguage = $lang;

    ob_start();
    include SOURCE_DIR . '/header.php';
    include SOURCE_DIR . '/templates/homepage-content.php';
    include SOURCE_DIR . '/footer.php';
    $html = ob_get_clean();

    file_put_contents($langDir . '/index.html', $html);
}

/**
 * Generate an article page
 */
function generateArticlePage($article, $lang, $langDir) {
    global $Parsedown, $currentLanguage;

    $currentLanguage = $lang;
    $siteConfig = getSiteConfig($lang);
    $langConfig = getLanguageConfig($lang);

    // Read and process markdown
    $markdownFile = SOURCE_DIR . $article['markdown_file'];
    if (!file_exists($markdownFile)) {
        echo "  Warning: Markdown file not found: {$markdownFile}\n";
        return;
    }

    $markdownContent = file_get_contents($markdownFile);

    // Process HTML embeds
    $embedResult = HtmlEmbed::process($markdownContent);
    $markdownContent = $embedResult['markdown'];
    $htmlEmbeds = $embedResult['embeds'];

    // Remove first H1 heading
    $lines = explode("\n", $markdownContent);
    $contentLines = [];
    $foundFirstH1 = false;

    foreach ($lines as $line) {
        if (!$foundFirstH1 && preg_match('/^#\s+/', $line) && !preg_match('/^#{2,}/', $line)) {
            $foundFirstH1 = true;
            continue;
        }
        $contentLines[] = $line;
    }

    $markdownContent = implode("\n", $contentLines);

    // Initialize Parsedown
    if (!isset($Parsedown)) {
        $Parsedown = new Parsedown();
    }
    $Parsedown->setSafeMode(true);
    $Parsedown->setMarkupEscaped(true);
    $htmlContent = $Parsedown->text($markdownContent);

    // Restore HTML embeds
    $htmlContent = HtmlEmbed::restore($htmlContent, $htmlEmbeds);

    // Get related articles
    $relatedArticles = getArticlesByCategory($article['category'], $lang);
    $relatedArticles = array_filter($relatedArticles, function($a) use ($article) {
        return $a['slug'] !== $article['slug'];
    });
    $relatedArticles = array_values(array_slice($relatedArticles, 0, 3));

    // Set up page variables
    $pageTitle = $article['title'] . ' | ' . $siteConfig['title'];
    $metaDescription = $article['description'];
    $metaKeywords = $article['keywords'] ?? $siteConfig['keywords'];
    $articlePath = $langConfig['article_path'];
    $canonicalUrl = $siteConfig['url'] . '/' . $articlePath . '/' . $article['slug'];
    $ogType = 'article';
    $articleAuthor = $article['author'];
    $articleDate = $article['date'];
    $articleCategory = $article['category'];
    $articleImage = $article['image'] ?? '/assets/ls-logo.png';
    $readingTimeMinutes = $article['reading_time_minutes'] ?? null;
    $categories = getCategories($lang);

    // Generate HTML
    ob_start();
    include SOURCE_DIR . '/header.php';
    include SOURCE_DIR . '/templates/article-content.php';
    include SOURCE_DIR . '/footer.php';
    $html = ob_get_clean();

    // Create directory structure
    $articleDir = $langDir . '/' . $articlePath . '/' . $article['slug'];
    if (!file_exists($articleDir)) {
        mkdir($articleDir, 0755, true);
    }

    file_put_contents($articleDir . '/index.html', $html);
}

/**
 * Generate RSS feed for a language
 */
function generateRSSFeed($lang, $langDir) {
    global $currentLanguage;
    $currentLanguage = $lang;

    $articles = getRecentArticles(20, $lang);
    $siteConfig = getSiteConfig($lang);
    $langConfig = getLanguageConfig($lang);

    ob_start();
    include SOURCE_DIR . '/templates/rss-feed.php';
    $rss = ob_get_clean();

    file_put_contents($langDir . '/rss.xml', $rss);
}

/**
 * Generate articles JSON for AJAX pagination
 */
function generateArticlesJSON($lang, $langDir) {
    $articles = getAllArticles($lang);
    $langConfig = getLanguageConfig($lang);
    $articlePath = $langConfig['article_path'];

    $articlesData = array_map(function($article) use ($lang, $articlePath) {
        return [
            'slug' => $article['slug'],
            'title' => $article['title'],
            'description' => $article['description'],
            'category' => $article['category'],
            'date' => $article['date'],
            'dateFormatted' => formatDate($article['date'], $lang),
            'url' => '/' . $articlePath . '/' . urlencode($article['slug']) . '/'
        ];
    }, $articles);

    $json = json_encode($articlesData, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    file_put_contents($langDir . '/articles.json', $json);
}

/**
 * Generate 404 page for a language
 */
function generate404Page($lang, $langDir) {
    global $currentLanguage;
    $currentLanguage = $lang;

    $siteConfig = getSiteConfig($lang);
    $categories = getCategories($lang);

    $pageTitle = t('error_404_title', $lang) . ' | ' . $siteConfig['title'];
    $metaDescription = t('error_404_message', $lang);
    $metaKeywords = $siteConfig['keywords'];
    $robots = 'noindex, nofollow';

    ob_start();
    include SOURCE_DIR . '/header.php';
    ?>
    <main id="main-content">
        <section class="content-section" style="text-align: center; padding: 4rem 1rem;">
            <h1><?php echo t('error_404_title', $lang); ?></h1>
            <p><?php echo t('error_404_message', $lang); ?></p>
            <p><a href="/" class="button-primary"><?php echo t('error_404_back', $lang); ?></a></p>
        </section>
    </main>
    <?php
    include SOURCE_DIR . '/footer.php';
    $html = ob_get_clean();

    file_put_contents($langDir . '/404.html', $html);
}

/**
 * Generate About page for a language
 */
function generateAboutPage($lang, $langDir) {
    global $currentLanguage;
    $currentLanguage = $lang;

    $siteConfig = getSiteConfig($lang);
    $langConfig = getLanguageConfig($lang);
    $categories = getCategories($lang);

    $currentPage = 'about';
    $aboutPath = $langConfig['about_path'];
    $pageTitle = t('about_title', $lang) . ' - ' . $siteConfig['title'];
    $metaDescription = t('about_mission_text', $lang);
    $metaKeywords = $siteConfig['keywords'];
    $canonicalUrl = $siteConfig['url'] . '/' . $aboutPath . '/';
    $ogType = 'website';

    ob_start();
    include SOURCE_DIR . '/header.php';
    include SOURCE_DIR . '/templates/about-content.php';
    include SOURCE_DIR . '/footer.php';
    $html = ob_get_clean();

    // Create directory structure
    $aboutDir = $langDir . '/' . $aboutPath;
    if (!file_exists($aboutDir)) {
        mkdir($aboutDir, 0755, true);
    }

    file_put_contents($aboutDir . '/index.html', $html);
}

/**
 * Generate XML sitemap for a language
 */
function generateSitemap($lang, $langDir) {
    $articles = getAllArticles($lang);
    $siteConfig = getSiteConfig($lang);
    $langConfig = getLanguageConfig($lang);
    $articlePath = $langConfig['article_path'];
    $aboutPath = $langConfig['about_path'];

    $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

    // Homepage
    $xml .= "  <url>\n";
    $xml .= "    <loc>" . htmlspecialchars($siteConfig['url']) . "/</loc>\n";
    $xml .= "    <lastmod>" . date('c') . "</lastmod>\n";
    $xml .= "    <changefreq>weekly</changefreq>\n";
    $xml .= "    <priority>1.0</priority>\n";
    $xml .= "  </url>\n";

    // About page
    $xml .= "  <url>\n";
    $xml .= "    <loc>" . htmlspecialchars($siteConfig['url']) . "/" . $aboutPath . "/</loc>\n";
    $xml .= "    <lastmod>" . date('c') . "</lastmod>\n";
    $xml .= "    <changefreq>monthly</changefreq>\n";
    $xml .= "    <priority>0.8</priority>\n";
    $xml .= "  </url>\n";

    // Articles
    foreach ($articles as $article) {
        $xml .= "  <url>\n";
        $xml .= "    <loc>" . htmlspecialchars($siteConfig['url'] . '/' . $articlePath . '/' . $article['slug']) . "/</loc>\n";
        $xml .= "    <lastmod>" . htmlspecialchars(formatDateISO8601($article['date'])) . "</lastmod>\n";
        $xml .= "    <changefreq>monthly</changefreq>\n";
        $xml .= "    <priority>0.9</priority>\n";
        $xml .= "  </url>\n";
    }

    $xml .= '</urlset>';

    file_put_contents($langDir . '/sitemap.xml', $xml);
}

/**
 * Generate root redirect page
 */
function generateRootRedirect() {
    global $defaultLanguage;

    $html = '<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="0;url=/' . $defaultLanguage . '/">
    <title>Redirecting...</title>
    <script>window.location.href = "/' . $defaultLanguage . '/";</script>
</head>
<body>
    <p>Redirecting to <a href="/' . $defaultLanguage . '/">/' . $defaultLanguage . '/</a>...</p>
</body>
</html>';

    file_put_contents(BUILD_DIR . '/index.html', $html);
}

/**
 * Generate domain routing configuration for Cloudflare
 */
function generateDomainRouting() {
    global $languages;

    // Create _redirects file for Cloudflare Pages
    $redirects = "# Domain-based routing\n";
    $redirects .= "# These redirects route users to the correct language based on domain\n\n";

    foreach ($languages as $code => $config) {
        $domain = $config['domain'];
        // Cloudflare Pages uses _redirects for routing
        $redirects .= "# {$config['name']}: {$domain}\n";
    }

    $redirects .= "\n# Default: redirect root to default language\n";
    $redirects .= "/ /lb/ 302\n";

    file_put_contents(BUILD_DIR . '/_redirects', $redirects);

    // Create _headers file for security headers
    $headers = "/*\n";
    $headers .= "  X-Frame-Options: SAMEORIGIN\n";
    $headers .= "  X-Content-Type-Options: nosniff\n";
    $headers .= "  Referrer-Policy: strict-origin-when-cross-origin\n";

    file_put_contents(BUILD_DIR . '/_headers', $headers);
}

// ============================================================================
// Helper Functions
// ============================================================================

/**
 * Recursively copy directory
 */
function copyDirectory($src, $dst) {
    $dir = opendir($src);
    @mkdir($dst, 0755, true);

    while (($file = readdir($dir)) !== false) {
        if ($file != '.' && $file != '..') {
            if (is_dir($src . '/' . $file)) {
                // Skip artikelen directory (markdown source files)
                if ($file === 'artikelen') {
                    continue;
                }
                copyDirectory($src . '/' . $file, $dst . '/' . $file);
            } else {
                copy($src . '/' . $file, $dst . '/' . $file);
            }
        }
    }
    closedir($dir);
}

/**
 * Recursively delete directory
 */
function deleteDirectory($dir) {
    if (!file_exists($dir)) {
        return;
    }

    $files = array_diff(scandir($dir), ['.', '..']);
    foreach ($files as $file) {
        $path = $dir . '/' . $file;
        is_dir($path) ? deleteDirectory($path) : unlink($path);
    }
    rmdir($dir);
}

/**
 * Count files in directory
 */
function countFiles($dir) {
    $count = 0;
    $files = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS)
    );
    foreach ($files as $file) {
        $count++;
    }
    return $count;
}
