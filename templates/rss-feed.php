<?php
// Get site configuration for current language
$rss_siteConfig = function_exists('getSiteConfig') ? getSiteConfig() : [
    'title' => defined('SITE_TITLE') ? SITE_TITLE : 'Liicht Sprooch',
    'url' => defined('SITE_URL') ? SITE_URL : 'https://liichtsprooch.lu',
    'description' => defined('SITE_DESCRIPTION') ? SITE_DESCRIPTION : ''
];
$rss_langConfig = function_exists('getLanguageConfig') ? getLanguageConfig() : ['locale' => 'lb-LU', 'article_path' => 'artikel'];
$rss_langCode = function_exists('getCurrentLanguage') ? getCurrentLanguage() : 'lb';
$rss_articlePath = $rss_langConfig['article_path'];

echo '<?xml version="1.0" encoding="UTF-8"?>';
?>

<rss version="2.0"
     xmlns:atom="http://www.w3.org/2005/Atom"
     xmlns:dc="http://purl.org/dc/elements/1.1/">
    <channel>
        <title><?php echo htmlspecialchars($rss_siteConfig['title']); ?></title>
        <link><?php echo htmlspecialchars($rss_siteConfig['url']); ?></link>
        <description><?php echo htmlspecialchars($rss_siteConfig['description']); ?></description>
        <language><?php echo $rss_langCode; ?></language>
        <atom:link href="<?php echo htmlspecialchars($rss_siteConfig['url']); ?>/rss.xml" rel="self" type="application/rss+xml"/>
        <lastBuildDate><?php echo date('r'); ?></lastBuildDate>

        <?php foreach ($articles as $article): ?>
        <item>
            <title><?php echo htmlspecialchars($article['title']); ?></title>
            <link><?php echo htmlspecialchars($rss_siteConfig['url'] . '/' . $rss_articlePath . '/' . $article['slug'] . '/'); ?></link>
            <guid isPermaLink="true"><?php echo htmlspecialchars($rss_siteConfig['url'] . '/' . $rss_articlePath . '/' . $article['slug'] . '/'); ?></guid>
            <description><?php echo htmlspecialchars($article['description']); ?></description>
            <dc:creator><?php echo htmlspecialchars($article['author']); ?></dc:creator>
            <category><?php echo htmlspecialchars($article['category']); ?></category>
            <pubDate><?php echo date('r', strtotime($article['date'])); ?></pubDate>
        </item>
        <?php endforeach; ?>
    </channel>
</rss>
