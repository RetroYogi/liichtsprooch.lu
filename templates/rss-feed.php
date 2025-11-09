<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<rss version="2.0"
     xmlns:atom="http://www.w3.org/2005/Atom"
     xmlns:dc="http://purl.org/dc/elements/1.1/">
    <channel>
        <title><?php echo htmlspecialchars(SITE_TITLE); ?></title>
        <link><?php echo htmlspecialchars(SITE_URL); ?></link>
        <description><?php echo htmlspecialchars(SITE_DESCRIPTION); ?></description>
        <language>lb</language>
        <atom:link href="<?php echo htmlspecialchars(SITE_URL); ?>/rss.xml" rel="self" type="application/rss+xml"/>
        <lastBuildDate><?php echo date('r'); ?></lastBuildDate>

        <?php foreach ($articles as $article): ?>
        <item>
            <title><?php echo htmlspecialchars($article['title']); ?></title>
            <link><?php echo htmlspecialchars(SITE_URL . '/artikel/' . $article['slug'] . '/'); ?></link>
            <guid isPermaLink="true"><?php echo htmlspecialchars(SITE_URL . '/artikel/' . $article['slug'] . '/'); ?></guid>
            <description><?php echo htmlspecialchars($article['description']); ?></description>
            <dc:creator><?php echo htmlspecialchars($article['author']); ?></dc:creator>
            <category><?php echo htmlspecialchars($article['category']); ?></category>
            <pubDate><?php echo date('r', strtotime($article['date'])); ?></pubDate>
        </item>
        <?php endforeach; ?>
    </channel>
</rss>
