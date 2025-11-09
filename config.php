<?php
/**
 * Configuration file for Liicht Sprooch website
 * This file contains all article metadata and navigation structure
 */

// Site configuration
define('SITE_TITLE', 'Liicht Sprooch Info-Site');
define('SITE_URL', 'https://liichtsprooch.lu'); // Update with your actual domain
define('SITE_DESCRIPTION', 'Informatiounen iwwer Liicht Sprooch zu Lëtzebuerg - Facile à lire et à comprendre (FALC) - Leichte Sprache');

// Articles configuration
// Each article has: slug, title, description (for SEO), category, date, markdown_file
$articles = [
    [
        'slug' => 'klaro-am-detail',
        'title' => 'Klaro am Detail - Wéi d\'Kompetenzzentrum funktionéiert',
        'description' => 'Entdeckt Klaro, den offizielle Kompetenzzentrum fir Liicht Sprooch zu Lëtzebuerg. Léiert wéi Klaro funktionéiert, wou se sinn, a firwat si esou wichteg fir Inclusioun am Land sinn.',
        'category' => 'Organisatiounen',
        'date' => '2025-01-15',
        'markdown_file' => '/assets/artikelen/Klaro am Detail.md',
        'author' => 'Liicht Sprooch Team'
    ],
    [
        'slug' => 'wei-schreiwe-mer-a-liichter-sprooch',
        'title' => 'Wéi schreiwe mer a Liichter Sprooch? Eng praktesch Uleedung',
        'description' => 'Eng komplett Uleedung fir Texter a Liichter Sprooch ze schreiwen. Léiert déi wichtegst Reegelen, Beispiller aus der Praxis, a wéi een Texter validéiert kritt.',
        'category' => 'Reegelen & Praxis',
        'date' => '2025-01-14',
        'markdown_file' => '/assets/artikelen/Wei schreiwe mer a Liichter Sprooch.md',
        'author' => 'Liicht Sprooch Team'
    ],
    [
        'slug' => 'atelier-isie',
        'title' => 'Atelier Isie - Experte mat intellektueller Beanträchtegung validéieren Texter',
        'description' => 'Den Atelier Isie ass e mobillen Atelier wou jonk Leit mat intellektueller Beanträchtegung Texter a Liichter Sprooch validéieren. Entdeckt hir wichteg Roll fir Qualitéit a Inclusioun.',
        'category' => 'Organisatiounen',
        'date' => '2025-01-13',
        'markdown_file' => '/assets/artikelen/Atelier Isie.md',
        'author' => 'Liicht Sprooch Team'
    ],
    [
        'slug' => 'falc-vs-leichte-sprache-vs-liicht-sprooch',
        'title' => 'FALC vs Leichte Sprache vs Liicht Sprooch - D\'Méisproochegkeet zu Lëtzebuerg',
        'description' => 'Firwat brauch Lëtzebuerg Liicht Sprooch a verschiddene Sproochen? En Iwwerbléck iwwer FALC, Leichte Sprache a Liicht Sprooch an der lëtzebuerger Méisproochegkeet.',
        'category' => 'Reegelen & Praxis',
        'date' => '2025-01-12',
        'markdown_file' => '/assets/artikelen/FALC vs Leichte Sprache vs Liicht Sprooch.md',
        'author' => 'Liicht Sprooch Team'
    ],
    [
        'slug' => 'wou-fanne-mer-liicht-sprooch',
        'title' => 'Wou fanne mer Liicht Sprooch? Konkret Beispiller',
        'description' => 'Entdeckt wou Dir Liicht Sprooch zu Lëtzebuerg fannt: op Guichet.lu, Infocrise.lu, beim ZPB, bei der Mediation Scolaire a vill méi. Konkret Beispiller aus dem Alldag.',
        'category' => 'Ressourcen',
        'date' => '2025-01-11',
        'markdown_file' => '/assets/artikelen/Wou fanne mer Liicht Sprooch.md',
        'author' => 'Liicht Sprooch Team'
    ],
    [
        'slug' => 'accessilingua',
        'title' => 'Accessilingua - Kënschtlech Intelligenz fir Liicht Sprooch',
        'description' => 'Wéi kann Kënschtlech Intelligenz d\'Produktioun vu Texter a Liichter Sprooch beschleunegen? Entdeckt den Accessilingua Projet, säi Potenzial an seng Limiten.',
        'category' => 'Technologie',
        'date' => '2025-01-10',
        'markdown_file' => '/assets/artikelen/Accessilingua.md',
        'author' => 'Liicht Sprooch Team'
    ],
    [
        'slug' => 'den-cdi',
        'title' => 'CDI - En anere Player am Beräich Liicht Sprooch',
        'description' => 'Niewent Klaro gëtt et de Service Leichte Sprache vum CDI, deen sech besonnesch op de Bildungsberäich konzentréiert. Entdeckt säin Roll a säi Service.',
        'category' => 'Organisatiounen',
        'date' => '2025-01-09',
        'markdown_file' => '/assets/artikelen/Den CDI.md',
        'author' => 'Liicht Sprooch Team'
    ],
    [
        'slug' => 'den-easy-to-read-logo',
        'title' => 'Den Easy-to-Read Logo - Wéi kritt een et?',
        'description' => 'Wéi kritt een den Easy-to-Read Logo vun Inclusion Europe? Entdeckt de Validatiounsprozess, d\'Reegelen a firwat de Logo esou wichteg ass fir Qualitéit.',
        'category' => 'Reegelen & Praxis',
        'date' => '2025-01-08',
        'markdown_file' => '/assets/artikelen/Den Easy-to-Read Logo.md',
        'author' => 'Liicht Sprooch Team'
    ]
];

// Navigation categories (for dropdown menu)
$categories = [
    'Organisatiounen' => 'Organisatiounen déi mat Liichter Sprooch schaffen',
    'Reegelen & Praxis' => 'Wéi een a Liichter Sprooch schreift',
    'Ressourcen' => 'Wou een Liicht Sprooch fënnt',
    'Technologie' => 'Innovatiounen am Beräich Liicht Sprooch'
];

/**
 * Get article by slug
 * @param string $slug Article slug (validated against whitelist)
 * @return array|null Article data or null if not found
 */
function getArticle($slug) {
    global $articles;

    // Validate slug format for security
    if (!is_string($slug) || !preg_match('/^[a-z0-9-]+$/', $slug)) {
        return null;
    }

    foreach ($articles as $article) {
        if ($article['slug'] === $slug) {
            return $article;
        }
    }
    return null;
}

/**
 * Get articles by category
 * @param string $category Category name
 * @return array Array of articles in the category
 */
function getArticlesByCategory($category) {
    global $articles, $categories;

    // Validate category exists in whitelist
    if (!is_string($category) || !isset($categories[$category])) {
        return [];
    }

    $filtered = [];
    foreach ($articles as $article) {
        if ($article['category'] === $category) {
            $filtered[] = $article;
        }
    }
    return $filtered;
}

/**
 * Get all articles sorted by date (newest first)
 */
function getAllArticles() {
    global $articles;
    usort($articles, function($a, $b) {
        return strtotime($b['date']) - strtotime($a['date']);
    });
    return $articles;
}

/**
 * Get recent articles (for RSS feed)
 */
function getRecentArticles($limit = 10) {
    $all = getAllArticles();
    return array_slice($all, 0, $limit);
}

/**
 * Format date in Luxembourgish
 */
function formatDateLB($date) {
    $months = [
        1 => 'Januar', 2 => 'Februar', 3 => 'Mäerz', 4 => 'Abrëll',
        5 => 'Mee', 6 => 'Juni', 7 => 'Juli', 8 => 'August',
        9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Dezember'
    ];

    $timestamp = strtotime($date);
    $day = date('j', $timestamp);
    $month = $months[(int)date('n', $timestamp)];
    $year = date('Y', $timestamp);

    return "$day. $month $year";
}
