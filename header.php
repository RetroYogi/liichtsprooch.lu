<?php
// Detect if we're building static site or serving dynamically
$isStatic = defined('BUILD_DIR');

// Set URL patterns based on context
$homeUrl = $isStatic ? '/' : '/index.php';
$aboutUrl = $isStatic ? '/about/' : '/about.php';
$rssUrl = $isStatic ? '/rss.xml' : '/rss.php';
$articleUrlPattern = $isStatic ? '/artikel/%s/' : '/artikel/%s';
?>
<!DOCTYPE html>
<html lang="lb-LU">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo htmlspecialchars($metaDescription ?? SITE_DESCRIPTION); ?>">
    <meta name="keywords" content="<?php echo htmlspecialchars($metaKeywords ?? SITE_KEYWORDS); ?>">
    <meta name="robots" content="<?php echo $robots ?? 'index, follow'; ?>">
    <?php if (isset($articleAuthor)): ?>
    <meta name="author" content="<?php echo htmlspecialchars($articleAuthor); ?>">
    <?php endif; ?>

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="<?php echo $ogType ?? 'website'; ?>">
    <meta property="og:title" content="<?php echo htmlspecialchars($pageTitle ?? SITE_TITLE); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($metaDescription ?? SITE_DESCRIPTION); ?>">
    <meta property="og:url" content="<?php echo htmlspecialchars($canonicalUrl ?? SITE_URL); ?>">
    <?php if (isset($articleDate)): ?>
    <meta property="article:published_time" content="<?php echo $articleDate; ?>">
    <?php endif; ?>
    <?php if (isset($articleAuthor)): ?>
    <meta property="article:author" content="<?php echo htmlspecialchars($articleAuthor); ?>">
    <?php endif; ?>
    <?php if (isset($articleCategory)): ?>
    <meta property="article:section" content="<?php echo htmlspecialchars($articleCategory); ?>">
    <?php endif; ?>

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:title" content="<?php echo htmlspecialchars($pageTitle ?? SITE_TITLE); ?>">
    <meta property="twitter:description" content="<?php echo htmlspecialchars($metaDescription ?? SITE_DESCRIPTION); ?>">

    <!-- Canonical URL -->
    <link rel="canonical" href="<?php echo htmlspecialchars($canonicalUrl ?? SITE_URL); ?>">

    <title><?php echo htmlspecialchars($pageTitle ?? SITE_TITLE); ?></title>

    <!-- Favicons -->
    <link rel="icon" type="image/x-icon" href="/assets/favicon/favicon.ico">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/favicon/favicon-16x16.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/favicon/favicon-32x32.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/assets/favicon/android-chrome-192x192.png">
    <link rel="icon" type="image/png" sizes="512x512" href="/assets/favicon/android-chrome-512x512.png">
    <link rel="manifest" href="/assets/favicon/site.webmanifest">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&family=Unbounded:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="/assets/styles.css">

    <!-- RSS Feed -->
    <link rel="alternate" type="application/rss+xml" title="<?php echo SITE_TITLE; ?> RSS Feed" href="<?php echo $rssUrl; ?>">

    <!-- JSON-LD Schema for SEO -->
    <script type="application/ld+json">
    <?php
    if (($ogType ?? 'website') === 'article' && isset($articleDate)) {
        // Article schema for individual article pages
        $schema = [
            "@context" => "https://schema.org",
            "@type" => "NewsArticle",
            "headline" => $pageTitle ?? SITE_TITLE,
            "description" => $metaDescription ?? SITE_DESCRIPTION,
            "datePublished" => $articleDate,
            "dateModified" => $articleDate,
            "author" => [
                "@type" => "Organization",
                "name" => $articleAuthor ?? "Liicht Sprooch Team"
            ],
            "publisher" => [
                "@type" => "Organization",
                "name" => SITE_TITLE,
                "url" => SITE_URL
            ],
            "inLanguage" => "lb-LU",
            "keywords" => $metaKeywords ?? SITE_KEYWORDS
        ];

        if (isset($articleCategory)) {
            $schema["articleSection"] = $articleCategory;
        }

        if (isset($readingTimeMinutes)) {
            $schema["timeRequired"] = "PT" . $readingTimeMinutes . "M";
        }

        echo json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    } else {
        // WebSite schema for homepage and other pages
        $schema = [
            "@context" => "https://schema.org",
            "@type" => "WebSite",
            "name" => SITE_TITLE,
            "url" => $canonicalUrl ?? SITE_URL,
            "description" => $metaDescription ?? SITE_DESCRIPTION,
            "inLanguage" => ["lb-LU", "de-LU", "fr-LU"],
            "keywords" => $metaKeywords ?? SITE_KEYWORDS,
            "about" => [
                "@type" => "Thing",
                "name" => "Liicht Sprooch",
                "alternateName" => ["Leichte Sprache", "FALC", "Easy-to-Read"],
                "description" => "Informationen über Leichte Sprache in Luxemburg"
            ]
        ];

        echo json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }
    ?>
    </script>

    <!-- Matomo Tag Manager -->
    <script>
    var _mtm = window._mtm = window._mtm || [];
    _mtm.push({'mtm.startTime': (new Date().getTime()), 'event': 'mtm.Start'});
    (function() {
        var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
        g.async=true; g.src='https://matomo.key4.lu/js/container_UTtrYL1R.js'; s.parentNode.insertBefore(g,s);
    })();
    </script>
    <!-- End Matomo Tag Manager -->
</head>
<body>
    <!-- Navigation -->
    <nav class="main-nav" role="navigation" aria-label="Haaptnavigatioun">
        <div class="nav-container">
            <a href="<?php echo $homeUrl; ?>" class="nav-logo">
                <img src="/assets/ls-logo.png" alt="LS Logo" class="logo-image">
                <span class="logo-text">Liicht Sprooch</span>
            </a>

            <button class="nav-toggle" aria-expanded="false" aria-controls="nav-menu" aria-label="Navigatiounsmenü opcn oder zoumaachen">
                <span class="hamburger"></span>
            </button>

            <ul class="nav-menu" id="nav-menu">
                <li><a href="<?php echo $homeUrl; ?>" <?php echo ($currentPage ?? '') === 'home' ? 'class="active"' : ''; ?>>Startsäit</a></li>
                <li class="nav-dropdown">
                    <button class="nav-dropdown-toggle" aria-expanded="false" aria-controls="dropdown-artikelen">
                        Artikelen <span class="dropdown-arrow">▼</span>
                    </button>
                    <ul class="nav-dropdown-menu" id="dropdown-artikelen">
                        <?php foreach ($categories as $cat => $desc): ?>
                        <li class="nav-dropdown-category">
                            <strong><?php echo htmlspecialchars($cat); ?></strong>
                            <ul class="nav-dropdown-articles">
                                <?php
                                $catArticles = getArticlesByCategory($cat);
                                foreach ($catArticles as $a):
                                ?>
                                <li><a href="<?php echo sprintf($articleUrlPattern, urlencode($a['slug'])); ?>"><?php echo htmlspecialchars($a['title']); ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
                <li><a href="<?php echo $aboutUrl; ?>" <?php echo ($currentPage ?? '') === 'about' ? 'class="active"' : ''; ?>>Iwwer dës Säit</a></li>
            </ul>
        </div>
    </nav>
