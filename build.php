#!/usr/bin/env php
<?php
/**
 * Static Site Generator for Liicht Sprooch
 *
 * This script generates a static HTML version of the site for GitHub Pages.
 * Run this script whenever you add/update articles or content.
 *
 * Usage: php build.php
 */

// Configuration
define('BUILD_DIR', __DIR__ . '/docs');
define('SOURCE_DIR', __DIR__);

echo "🚀 Building static site for GitHub Pages...\n\n";

// Include required files
require_once SOURCE_DIR . '/config.php';
require_once SOURCE_DIR . '/Parsedown.php';
require_once SOURCE_DIR . '/HtmlEmbed.php';

// Clean and create build directory
if (file_exists(BUILD_DIR)) {
    deleteDirectory(BUILD_DIR);
    echo "✓ Cleaned old build directory\n";
}
mkdir(BUILD_DIR, 0755, true);
echo "✓ Created build directory: docs/\n";

// Copy assets
copyDirectory(SOURCE_DIR . '/assets', BUILD_DIR . '/assets');
echo "✓ Copied assets/\n";

// Generate homepage
generateHomepage();
echo "✓ Generated homepage (index.html)\n";

// Generate article pages
$articles = getAllArticles();
$articleCount = 0;
foreach ($articles as $article) {
    generateArticlePage($article);
    $articleCount++;
}
echo "✓ Generated $articleCount article pages\n";

// Generate RSS feed
generateRSSFeed();
echo "✓ Generated RSS feed (rss.xml)\n";

// Generate 404 page
generate404Page();
echo "✓ Generated 404 page\n";

// Copy CNAME file if it exists
if (file_exists(SOURCE_DIR . '/CNAME')) {
    copy(SOURCE_DIR . '/CNAME', BUILD_DIR . '/CNAME');
    echo "✓ Copied CNAME file\n";
}

echo "\n✅ Build complete! Site generated in docs/\n";
echo "📝 Total files: " . countFiles(BUILD_DIR) . "\n";
echo "\n📌 Next steps:\n";
echo "   1. Review the generated files in docs/\n";
echo "   2. Commit and push to GitHub\n";
echo "   3. Configure GitHub Pages to serve from /docs folder\n\n";

// ============================================================================
// Helper Functions
// ============================================================================

/**
 * Generate the homepage
 */
function generateHomepage() {
    global $categories;
    $recentArticles = getRecentArticles(6);
    $currentPage = 'home';
    $pageTitle = SITE_TITLE;
    $metaDescription = SITE_DESCRIPTION;
    $canonicalUrl = SITE_URL;
    $ogType = 'website';

    ob_start();
    include SOURCE_DIR . '/templates/static-header.php';
    include SOURCE_DIR . '/templates/homepage-content.php';
    include SOURCE_DIR . '/templates/static-footer.php';
    $html = ob_get_clean();

    // Write to build directory
    file_put_contents(BUILD_DIR . '/index.html', $html);
}

/**
 * Generate an article page
 */
function generateArticlePage($article) {
    global $Parsedown, $categories;

    // Read and process markdown
    $markdownFile = SOURCE_DIR . $article['markdown_file'];
    if (!file_exists($markdownFile)) {
        echo "⚠️  Warning: Markdown file not found: {$markdownFile}\n";
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
    $relatedArticles = getArticlesByCategory($article['category']);
    $relatedArticles = array_filter($relatedArticles, function($a) use ($article) {
        return $a['slug'] !== $article['slug'];
    });
    $relatedArticles = array_slice($relatedArticles, 0, 3);

    // Set up page variables
    $pageTitle = $article['title'] . ' | ' . SITE_TITLE;
    $metaDescription = $article['description'];
    $canonicalUrl = SITE_URL . '/artikel/' . $article['slug'];
    $ogType = 'article';
    $articleAuthor = $article['author'];
    $articleDate = $article['date'];
    $articleCategory = $article['category'];

    // Generate HTML
    ob_start();
    include SOURCE_DIR . '/templates/static-header.php';
    include SOURCE_DIR . '/templates/article-content.php';
    include SOURCE_DIR . '/templates/static-footer.php';
    $html = ob_get_clean();

    // Create directory structure
    $articleDir = BUILD_DIR . '/artikel/' . $article['slug'];
    if (!file_exists($articleDir)) {
        mkdir($articleDir, 0755, true);
    }

    // Write file
    file_put_contents($articleDir . '/index.html', $html);
}

/**
 * Generate RSS feed
 */
function generateRSSFeed() {
    $articles = getRecentArticles(20);

    ob_start();
    include SOURCE_DIR . '/templates/rss-feed.php';
    $rss = ob_get_clean();

    file_put_contents(BUILD_DIR . '/rss.xml', $rss);
}

/**
 * Generate 404 page
 */
function generate404Page() {
    global $categories;
    $pageTitle = 'Säit net fonnt | ' . SITE_TITLE;
    $metaDescription = 'Déi gefrot Säit gouf net fonnt.';

    ob_start();
    include SOURCE_DIR . '/templates/static-header.php';
    ?>
    <main id="main-content">
        <section class="content-section" style="text-align: center; padding: 4rem 1rem;">
            <h1>404 - Säit net fonnt</h1>
            <p>Leider gouf déi gefrot Säit net fonnt.</p>
            <p><a href="/" class="button-primary">← Zréck op d'Haaptsäit</a></p>
        </section>
    </main>
    <?php
    include SOURCE_DIR . '/templates/static-footer.php';
    $html = ob_get_clean();

    file_put_contents(BUILD_DIR . '/404.html', $html);
}

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
