<!DOCTYPE html>
<html lang="lb">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo htmlspecialchars($metaDescription ?? SITE_DESCRIPTION); ?>">
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
    <link rel="alternate" type="application/rss+xml" title="<?php echo SITE_TITLE; ?> RSS Feed" href="/rss.xml">

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
            <a href="/" class="nav-logo">
                <img src="/assets/ls-logo.png" alt="LS Logo" class="logo-image">
                <span class="logo-text">Liicht Sprooch</span>
            </a>

            <button class="nav-toggle" aria-expanded="false" aria-controls="nav-menu" aria-label="Navigatiounsmenü opcn oder zoumaachen">
                <span class="hamburger"></span>
            </button>

            <ul class="nav-menu" id="nav-menu">
                <li><a href="/" <?php echo ($currentPage ?? '') === 'home' ? 'class="active"' : ''; ?>>Startsäit</a></li>
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
                                <li><a href="/artikel/<?php echo urlencode($a['slug']); ?>/"><?php echo htmlspecialchars($a['title']); ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
                <li><a href="/about/" <?php echo ($currentPage ?? '') === 'about' ? 'class="active"' : ''; ?>>Iwwer eis</a></li>
            </ul>
        </div>
    </nav>
