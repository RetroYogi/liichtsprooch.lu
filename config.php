<?php
/**
 * Configuration file for Liicht Sprooch website
 * This file contains all article metadata and navigation structure
 */

// Site configuration
define('SITE_TITLE', 'Liicht Sprooch Info-Site');
define('SITE_URL', 'https://liichtsprooch.lu'); // Update with your actual domain
define('SITE_DESCRIPTION', 'Informatiounen iwwer Liicht Sprooch zu Lëtzebuerg - Facile à lire et à comprendre (FALC) - Leichte Sprache - Easy-to-Read. Entdeckt wéi een a Liichter Sprooch schreift, wou een se fënnt, a firwat se wichteg ass fir Inclusioun. Informationen über Leichte Sprache in Luxemburg.');
define('SITE_KEYWORDS', 'Liicht Sprooch, Leichte Sprache, FALC, Easy-to-Read, Luxemburg, Lëtzebuerg, Inklusion, Barrierefreiheit, Inclusion, Accessibilité, Klaro, Atelier Isie, einfache Sprache');

// Articles configuration
// Each article has: slug, title, description (for SEO), category, date, markdown_file, author, keywords, reading_time_minutes, image
$articles = [
    [
        'slug' => 'wei-schreiwe-mer-a-liichter-sprooch',
        'title' => 'Wéi schreiwe mer a Liichter Sprooch? Eng praktesch Uleedung',
        'description' => 'Eng komplett Uleedung fir Texter a Liichter Sprooch ze schreiwen. Léiert déi wichtegst Reegelen, Beispiller aus der Praxis, a wéi een Texter validéiert kritt.',
        'category' => 'Reegelen & Praxis',
        'date' => '2025-11-09',
        'markdown_file' => '/assets/artikelen/Wei schreiwe mer a Liichter Sprooch.md',
        'author' => 'Liicht Sprooch Team',
        'keywords' => 'Liicht Sprooch schreiwen, Leichte Sprache schreiben, FALC Regeln, Easy-to-Read, Validatioun, Texter a Liichter Sprooch, Anleitung Leichte Sprache, Regeln, Praxis',
        'reading_time_minutes' => 8,
        'image' => '/assets/ls-logo.png'
    ],
    [
        'slug' => 'projet-starter-pack',
        'title' => 'Projet Starter Pack - D\'APEMH gewënnt de Prix de l\'inclusion numérique',
        'description' => 'D\'APEMH gewënnt de Prix de l\'inclusion numérique fir hire Projet Starter Pack - eng innovativ Basis-Formatioun fir digital Kompetenzen a Liichter Sprooch op Lëtzebuergesch. Entdeckt wéi digital Inklusioun a Liicht Sprooch zesummeschaffen.',
        'category' => 'Organisatiounen',
        'date' => '2025-05-27',
        'markdown_file' => '/assets/artikelen/Projet_Starter_Pack.md',
        'author' => 'Liicht Sprooch Team',
        'keywords' => 'Projet Starter Pack, APEMH, Prix inclusion numérique, digital Inklusioun, Liicht Sprooch Lëtzebuergesch, Léierplattform, digitale Kompetenze, Formatioun, lern-plattform.lu, Barrierefreiheit',
        'reading_time_minutes' => 6,
        'image' => '/assets/ls-logo.png'
    ],
    [
        'slug' => 'klaro-am-detail',
        'title' => 'Klaro am Detail - Wéi d\'Kompetenzzentrum funktionéiert',
        'description' => 'Entdeckt Klaro, den offizielle Kompetenzzentrum fir Liicht Sprooch zu Lëtzebuerg. Léiert wéi Klaro funktionéiert, wou se sinn, a firwat si esou wichteg fir Inclusioun am Land sinn.',
        'category' => 'Organisatiounen',
        'date' => '2025-05-02',
        'markdown_file' => '/assets/artikelen/Klaro am Detail.md',
        'author' => 'Liicht Sprooch Team',
        'keywords' => 'Klaro, Kompetenzzentrum, Liicht Sprooch, Lëtzebuerg, Inclusion, Leichte Sprache Luxemburg, Kompetenzzentrum Leichte Sprache, FALC, Barrierefreiheit',
        'reading_time_minutes' => 5,
        'image' => '/assets/ls-logo.png'
    ],
    [
        'slug' => 'atelier-isie',
        'title' => 'Atelier Isie - Experte mat intellektueller Beanträchtegung validéieren Texter',
        'description' => 'Den Atelier Isie ass e mobillen Atelier wou jonk Leit mat intellektueller Beanträchtegung Texter a Liichter Sprooch validéieren. Entdeckt hir wichteg Roll fir Qualitéit a Inclusioun.',
        'category' => 'Organisatiounen',
        'date' => '2025-05-02',
        'markdown_file' => '/assets/artikelen/Atelier Isie.md',
        'author' => 'Liicht Sprooch Team',
        'keywords' => 'Atelier Isie, Validatioun, intellektuell Beanträchtegung, Liicht Sprooch, Prüfgruppe, Validierung Leichte Sprache, Experten, Inklusion, Barrierefreiheit',
        'reading_time_minutes' => 4,
        'image' => '/assets/ls-logo.png'
    ],
    [
        'slug' => 'falc-vs-leichte-sprache-vs-liicht-sprooch',
        'title' => 'FALC vs Leichte Sprache vs Liicht Sprooch - D\'Méisproochegkeet zu Lëtzebuerg',
        'description' => 'Firwat brauch Lëtzebuerg Liicht Sprooch a verschiddene Sproochen? En Iwwerbléck iwwer FALC, Leichte Sprache a Liicht Sprooch an der lëtzebuerger Méisproochegkeet.',
        'category' => 'Reegelen & Praxis',
        'date' => '2025-01-12',
        'markdown_file' => '/assets/artikelen/FALC vs Leichte Sprache vs Liicht Sprooch.md',
        'author' => 'Liicht Sprooch Team',
        'keywords' => 'FALC, Leichte Sprache, Liicht Sprooch, Easy-to-Read, Méisproochegkeet, Mehrsprachigkeit Luxemburg, Unterschiede, Vergleich, Lëtzebuerg',
        'reading_time_minutes' => 6,
        'image' => '/assets/ls-logo.png'
    ],
    [
        'slug' => 'wou-fanne-mer-liicht-sprooch',
        'title' => 'Wou fanne mer Liicht Sprooch? Konkret Beispiller',
        'description' => 'Entdeckt wou Dir Liicht Sprooch zu Lëtzebuerg fannt: op Guichet.lu, Infocrise.lu, beim ZPB, bei der Mediation Scolaire a vill méi. Konkret Beispiller aus dem Alldag.',
        'category' => 'Ressourcen',
        'date' => '2025-01-11',
        'markdown_file' => '/assets/artikelen/Wou fanne mer Liicht Sprooch.md',
        'author' => 'Liicht Sprooch Team',
        'keywords' => 'Liicht Sprooch Beispiller, Guichet.lu, Infocrise, ZPB, Ressourcen, Leichte Sprache Luxemburg finden, Beispiele, Mediation Scolaire, Lëtzebuerg',
        'reading_time_minutes' => 5,
        'image' => '/assets/ls-logo.png'
    ],
    [
        'slug' => 'accessilingua',
        'title' => 'Accessilingua - Kënschtlech Intelligenz fir Liicht Sprooch',
        'description' => 'Wéi kann Kënschtlech Intelligenz d\'Produktioun vu Texter a Liichter Sprooch beschleunegen? Entdeckt den Accessilingua Projet, säi Potenzial an seng Limiten.',
        'category' => 'Technologie',
        'date' => '2025-01-10',
        'markdown_file' => '/assets/artikelen/Accessilingua.md',
        'author' => 'Liicht Sprooch Team',
        'keywords' => 'Accessilingua, AI, Kënschtlech Intelligenz, Künstliche Intelligenz, Liicht Sprooch, Technologie, Automation, Leichte Sprache Software, KI',
        'reading_time_minutes' => 6,
        'image' => '/assets/ls-logo.png'
    ],
    [
        'slug' => 'cap-falc-innovatioun-aus-frankraich',
        'title' => 'Cap FALC - Innovatioun aus Frankräich fir méi Liicht Sprooch',
        'description' => 'Entdeckt Cap FALC, den innovativen Tool aus Frankräich deen Kënschtlech Intelligenz a Participatioun kombinéiert. Wéi d\'UNAPEI e Tool entwéckelt huet deen vu Leit mat Beanträchtegung selwer gebaut gouf.',
        'category' => 'Technologie',
        'date' => '2025-11-15',
        'markdown_file' => '/assets/artikelen/Cap_FALC_-_Innovatioun_aus_Frankraich.md',
        'author' => 'Liicht Sprooch Team',
        'keywords' => 'Cap FALC, UNAPEI, KI, Kënschtlech Intelligenz, FALC, Frankräich, Participatioun, Transcriptioun, Meta AI, INRIA, Kollaboratioun, Tool',
        'reading_time_minutes' => 7,
        'image' => '/assets/Cap-FALC-laptop.webp'
    ],
    [
        'slug' => 'cap-falc-a-accessilingua-verglach',
        'title' => 'Cap FALC a Accessilingua - Zwee Weeër an dat selwecht Zil',
        'description' => 'E Verglach tëschent Cap FALC aus Frankräich an Accessilingua aus Lëtzebuerg. Zwou Tools déi Kënschtlech Intelligenz benotzen, mä mat ënnerschiddlechen Approchen a Philosophien.',
        'category' => 'Technologie',
        'date' => '2025-11-15',
        'markdown_file' => '/assets/artikelen/Cap_FALC_a_Accessilingua_Verglach.md',
        'author' => 'Liicht Sprooch Team',
        'keywords' => 'Cap FALC, Accessilingua, Verglach, Comparaison, KI, UNAPEI, GovTech Lab, Lëtzebuerg, Frankräich, Participatioun, Technologie, FALC',
        'reading_time_minutes' => 6,
        'image' => '/assets/Cap-FALC-laptop.webp'
    ],
    [
        'slug' => 'den-cdi',
        'title' => 'CDI - En anere Player am Beräich Liicht Sprooch',
        'description' => 'Niewent Klaro gëtt et de Service Leichte Sprache vum CDI, deen sech besonnesch op de Bildungsberäich konzentréiert. Entdeckt säin Roll a säi Service.',
        'category' => 'Organisatiounen',
        'date' => '2025-01-09',
        'markdown_file' => '/assets/artikelen/Den CDI.md',
        'author' => 'Liicht Sprooch Team',
        'keywords' => 'CDI, Service Leichte Sprache, Bildung, Liicht Sprooch, Lëtzebuerg, Bildungsbereich, Leichte Sprache Bildung, Organisatiounen',
        'reading_time_minutes' => 4,
        'image' => '/assets/ls-logo.png'
    ],
    [
        'slug' => 'den-easy-to-read-logo',
        'title' => 'Den Easy-to-Read Logo - Wéi kritt een et?',
        'description' => 'Wéi kritt een den Easy-to-Read Logo vun Inclusion Europe? Entdeckt de Validatiounsprozess, d\'Reegelen a firwat de Logo esou wichteg ass fir Qualitéit.',
        'category' => 'Reegelen & Praxis',
        'date' => '2025-01-08',
        'markdown_file' => '/assets/artikelen/Den Easy-to-Read Logo.md',
        'author' => 'Liicht Sprooch Team',
        'keywords' => 'Easy-to-Read Logo, Inclusion Europe, Validatioun, Qualitéit, Zertifizierung, FALC, Liicht Sprooch, Logo beantragen, Gütesiegel',
        'reading_time_minutes' => 5,
        'image' => '/assets/ls-logo.png'
    ],
    [
        'slug' => 'accessibel-walen',
        'title' => 'Accessibel Walen fir jiddereen - Wéi Liicht Sprooch d\'Demokratie stäerkt',
        'description' => 'Wéi mécht Lëtzebuerg Walen accessibel fir jiddereen? Entdeckt d\'Roll vun Liichter Sprooch bei Walinformatiounen, taktile Walmodeller, Transportservicer a vill méi. Demokratie braucht Accessibilitéit.',
        'category' => 'Ressourcen',
        'date' => '2023-10-18',
        'markdown_file' => '/assets/artikelen/Accessibel_Walen.md',
        'author' => 'Liicht Sprooch Team',
        'keywords' => 'Accessibel Walen, Walrecht, Demokratie, Liicht Sprooch, Barrierefreiheit, Check Politik, ZPB, Elections, Inclusion, Adapto, UN-BRK, Walinformatiounen',
        'reading_time_minutes' => 8,
        'image' => '/assets/ls-logo.png'
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

/**
 * Format date to ISO 8601 with Luxembourg timezone (CET/CEST)
 * @param string $date Date in YYYY-MM-DD format
 * @return string ISO 8601 datetime string with timezone
 */
function formatDateISO8601($date) {
    // Luxembourg timezone (CET = UTC+1, CEST = UTC+2 during DST)
    $dateTime = new DateTime($date, new DateTimeZone('Europe/Luxembourg'));
    // Set time to noon to avoid any midnight issues
    $dateTime->setTime(12, 0, 0);
    return $dateTime->format('c'); // ISO 8601 format with timezone
}
