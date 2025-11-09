<?php
/**
 * RSS Feed Generator
 * Generates an RSS 2.0 feed for articles
 */

require_once 'config.php';

// Get recent articles
$articles = getRecentArticles(20);

// Set headers for RSS feed
header('Content-Type: application/rss+xml; charset=utf-8');
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');

// Generate RSS XML
echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
?>
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom" xmlns:dc="http://purl.org/dc/elements/1.1/">
    <channel>
        <title><?php echo htmlspecialchars(SITE_TITLE); ?></title>
        <link><?php echo htmlspecialchars(SITE_URL); ?></link>
        <description><?php echo htmlspecialchars(SITE_DESCRIPTION); ?></description>
        <language>lb</language>
        <lastBuildDate><?php echo date(DATE_RSS); ?></lastBuildDate>
        <atom:link href="<?php echo htmlspecialchars(SITE_URL . '/rss.php'); ?>" rel="self" type="application/rss+xml" />
        <generator>Liicht Sprooch Custom RSS Generator</generator>

        <?php foreach ($articles as $article): ?>
        <item>
            <title><?php echo htmlspecialchars($article['title']); ?></title>
            <link><?php echo htmlspecialchars(SITE_URL . '/artikel/' . $article['slug']); ?></link>
            <guid isPermaLink="true"><?php echo htmlspecialchars(SITE_URL . '/artikel/' . $article['slug']); ?></guid>
            <description><?php echo htmlspecialchars($article['description']); ?></description>
            <category><?php echo htmlspecialchars($article['category']); ?></category>
            <dc:creator><?php echo htmlspecialchars($article['author']); ?></dc:creator>
            <pubDate><?php echo date(DATE_RSS, strtotime($article['date'])); ?></pubDate>
        </item>
        <?php endforeach; ?>

    </channel>
</rss>
