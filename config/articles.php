<?php
/**
 * Multilingual Articles Configuration
 *
 * Each article has a unique ID and can have translations in multiple languages.
 * Articles are organized by ID, with each language version having its own metadata.
 */

// Include language configuration
require_once __DIR__ . '/languages.php';

/**
 * Articles configuration
 * Structure: article_id => [lang_code => article_data]
 */
$articles = [
    'wei-schreiwe-mer' => [
        'lb' => [
            'slug' => 'wei-schreiwe-mer-a-liichter-sprooch',
            'title' => 'Wéi schreiwe mer a Liichter Sprooch? Eng praktesch Uleedung',
            'description' => 'Eng komplett Uleedung fir Texter a Liichter Sprooch ze schreiwen. Léiert déi wichtegst Reegelen, Beispiller aus der Praxis, a wéi een Texter validéiert kritt.',
            'category' => 'Reegelen & Praxis',
            'date' => '2025-11-09',
            'markdown_file' => '/content/lb/artikelen/Wei schreiwe mer a Liichter Sprooch.md',
            'author' => 'Liicht Sprooch Team',
            'keywords' => 'Liicht Sprooch schreiwen, Leichte Sprache schreiben, FALC Regeln, Easy-to-Read, Validatioun',
            'reading_time_minutes' => 8,
            'image' => '/assets/ls-logo.png'
        ],
        'de' => [
            'slug' => 'wie-schreibt-man-leichte-sprache',
            'title' => 'Wie schreibt man in Leichter Sprache? Eine praktische Anleitung',
            'description' => 'Eine vollständige Anleitung zum Schreiben von Texten in Leichter Sprache. Lernen Sie die wichtigsten Regeln, Beispiele aus der Praxis, und wie man Texte validieren lässt.',
            'category' => 'Regeln & Praxis',
            'date' => '2025-11-09',
            'markdown_file' => '/content/de/artikelen/Wie-schreibt-man-Leichte-Sprache.md',
            'author' => 'Liicht Sprooch Team',
            'keywords' => 'Leichte Sprache schreiben, Regeln, Anleitung, Validierung, Prüfgruppe',
            'reading_time_minutes' => 8,
            'image' => '/assets/ls-logo.png'
        ],
        'fr' => [
            'slug' => 'comment-ecrire-en-falc',
            'title' => 'Comment écrire en FALC ? Un guide pratique',
            'description' => 'Un guide complet pour écrire des textes en FALC. Apprenez les règles essentielles, des exemples pratiques, et comment faire valider vos textes.',
            'category' => 'Règles & Pratique',
            'date' => '2025-11-09',
            'markdown_file' => '/content/fr/artikelen/Comment-ecrire-en-FALC.md',
            'author' => 'Liicht Sprooch Team',
            'keywords' => 'FALC écrire, règles, guide, validation, relecture',
            'reading_time_minutes' => 8,
            'image' => '/assets/ls-logo.png'
        ]
    ],

    'projet-starter-pack' => [
        'lb' => [
            'slug' => 'projet-starter-pack',
            'title' => 'Projet Starter Pack - D\'APEMH gewënnt de Prix de l\'inclusion numérique',
            'description' => 'D\'APEMH gewënnt de Prix de l\'inclusion numérique fir hire Projet Starter Pack - eng innovativ Basis-Formatioun fir digital Kompetenzen a Liichter Sprooch op Lëtzebuergesch.',
            'category' => 'Organisatiounen',
            'date' => '2025-05-27',
            'markdown_file' => '/content/lb/artikelen/Projet_Starter_Pack.md',
            'author' => 'Liicht Sprooch Team',
            'keywords' => 'Projet Starter Pack, APEMH, Prix inclusion numérique, digital Inklusioun',
            'reading_time_minutes' => 6,
            'image' => '/assets/ls-logo.png'
        ]
    ],

    'klaro-am-detail' => [
        'lb' => [
            'slug' => 'klaro-am-detail',
            'title' => 'Klaro am Detail - Wéi d\'Kompetenzzentrum funktionéiert',
            'description' => 'Entdeckt Klaro, den offizielle Kompetenzzentrum fir Liicht Sprooch zu Lëtzebuerg.',
            'category' => 'Organisatiounen',
            'date' => '2025-05-02',
            'markdown_file' => '/content/lb/artikelen/Klaro am Detail.md',
            'author' => 'Liicht Sprooch Team',
            'keywords' => 'Klaro, Kompetenzzentrum, Liicht Sprooch, Lëtzebuerg',
            'reading_time_minutes' => 5,
            'image' => '/assets/ls-logo.png'
        ]
    ],

    'atelier-isie' => [
        'lb' => [
            'slug' => 'atelier-isie',
            'title' => 'Atelier Isie - Experte mat intellektueller Beanträchtegung validéieren Texter',
            'description' => 'Den Atelier Isie ass e mobillen Atelier wou jonk Leit mat intellektueller Beanträchtegung Texter a Liichter Sprooch validéieren.',
            'category' => 'Organisatiounen',
            'date' => '2025-05-02',
            'markdown_file' => '/content/lb/artikelen/Atelier Isie.md',
            'author' => 'Liicht Sprooch Team',
            'keywords' => 'Atelier Isie, Validatioun, intellektuell Beanträchtegung',
            'reading_time_minutes' => 4,
            'image' => '/assets/ls-logo.png'
        ]
    ],

    'falc-vs-leichte-sprache' => [
        'lb' => [
            'slug' => 'falc-vs-leichte-sprache-vs-liicht-sprooch',
            'title' => 'FALC vs Leichte Sprache vs Liicht Sprooch - D\'Méisproochegkeet zu Lëtzebuerg',
            'description' => 'Firwat brauch Lëtzebuerg Liicht Sprooch a verschiddene Sproochen?',
            'category' => 'Reegelen & Praxis',
            'date' => '2025-01-12',
            'markdown_file' => '/content/lb/artikelen/FALC vs Leichte Sprache vs Liicht Sprooch.md',
            'author' => 'Liicht Sprooch Team',
            'keywords' => 'FALC, Leichte Sprache, Liicht Sprooch, Méisproochegkeet',
            'reading_time_minutes' => 6,
            'image' => '/assets/ls-logo.png'
        ]
    ],

    'wou-fanne-mer' => [
        'lb' => [
            'slug' => 'wou-fanne-mer-liicht-sprooch',
            'title' => 'Wou fanne mer Liicht Sprooch? Konkret Beispiller',
            'description' => 'Entdeckt wou Dir Liicht Sprooch zu Lëtzebuerg fannt.',
            'category' => 'Ressourcen',
            'date' => '2025-01-11',
            'markdown_file' => '/content/lb/artikelen/Wou fanne mer Liicht Sprooch.md',
            'author' => 'Liicht Sprooch Team',
            'keywords' => 'Liicht Sprooch Beispiller, Guichet.lu, Ressourcen',
            'reading_time_minutes' => 5,
            'image' => '/assets/ls-logo.png'
        ]
    ],

    'accessilingua' => [
        'lb' => [
            'slug' => 'accessilingua',
            'title' => 'Accessilingua - Kënschtlech Intelligenz fir Liicht Sprooch',
            'description' => 'Wéi kann Kënschtlech Intelligenz d\'Produktioun vu Texter a Liichter Sprooch beschleunegen?',
            'category' => 'Technologie',
            'date' => '2025-01-10',
            'markdown_file' => '/content/lb/artikelen/Accessilingua.md',
            'author' => 'Liicht Sprooch Team',
            'keywords' => 'Accessilingua, AI, Kënschtlech Intelligenz, Technologie',
            'reading_time_minutes' => 6,
            'image' => '/assets/ls-logo.png'
        ]
    ],

    'cap-falc' => [
        'lb' => [
            'slug' => 'cap-falc-innovatioun-aus-frankraich',
            'title' => 'Cap FALC - Innovatioun aus Frankräich fir méi Liicht Sprooch',
            'description' => 'Entdeckt Cap FALC, den innovativen Tool aus Frankräich.',
            'category' => 'Technologie',
            'date' => '2025-11-15',
            'markdown_file' => '/content/lb/artikelen/Cap_FALC_-_Innovatioun_aus_Frankraich.md',
            'author' => 'Liicht Sprooch Team',
            'keywords' => 'Cap FALC, UNAPEI, KI, FALC, Frankräich',
            'reading_time_minutes' => 7,
            'image' => '/assets/Cap-FALC-laptop.webp'
        ]
    ],

    'cap-falc-accessilingua-verglach' => [
        'lb' => [
            'slug' => 'cap-falc-a-accessilingua-verglach',
            'title' => 'Cap FALC a Accessilingua - Zwee Weeër an dat selwecht Zil',
            'description' => 'E Verglach tëschent Cap FALC aus Frankräich an Accessilingua aus Lëtzebuerg.',
            'category' => 'Technologie',
            'date' => '2025-11-15',
            'markdown_file' => '/content/lb/artikelen/Cap_FALC_a_Accessilingua_Verglach.md',
            'author' => 'Liicht Sprooch Team',
            'keywords' => 'Cap FALC, Accessilingua, Verglach, KI',
            'reading_time_minutes' => 6,
            'image' => '/assets/Cap-FALC-laptop.webp'
        ]
    ],

    'den-cdi' => [
        'lb' => [
            'slug' => 'den-cdi',
            'title' => 'CDI - En anere Player am Beräich Liicht Sprooch',
            'description' => 'Niewent Klaro gëtt et de Service Leichte Sprache vum CDI.',
            'category' => 'Organisatiounen',
            'date' => '2025-01-09',
            'markdown_file' => '/content/lb/artikelen/Den CDI.md',
            'author' => 'Liicht Sprooch Team',
            'keywords' => 'CDI, Service Leichte Sprache, Bildung',
            'reading_time_minutes' => 4,
            'image' => '/assets/ls-logo.png'
        ]
    ],

    'easy-to-read-logo' => [
        'lb' => [
            'slug' => 'den-easy-to-read-logo',
            'title' => 'Den Easy-to-Read Logo - Wéi kritt een et?',
            'description' => 'Wéi kritt een den Easy-to-Read Logo vun Inclusion Europe?',
            'category' => 'Reegelen & Praxis',
            'date' => '2025-01-08',
            'markdown_file' => '/content/lb/artikelen/Den Easy-to-Read Logo.md',
            'author' => 'Liicht Sprooch Team',
            'keywords' => 'Easy-to-Read Logo, Inclusion Europe, Validatioun',
            'reading_time_minutes' => 5,
            'image' => '/assets/ls-logo.png'
        ]
    ],

    'accessibel-walen' => [
        'lb' => [
            'slug' => 'accessibel-walen',
            'title' => 'Accessibel Walen fir jiddereen - Wéi Liicht Sprooch d\'Demokratie stäerkt',
            'description' => 'Wéi mécht Lëtzebuerg Walen accessibel fir jiddereen?',
            'category' => 'Ressourcen',
            'date' => '2023-10-18',
            'markdown_file' => '/content/lb/artikelen/Accessibel_Walen.md',
            'author' => 'Liicht Sprooch Team',
            'keywords' => 'Accessibel Walen, Walrecht, Demokratie, Liicht Sprooch',
            'reading_time_minutes' => 8,
            'image' => '/assets/ls-logo.png'
        ]
    ]
];

/**
 * Category mappings per language
 */
$categoryMappings = [
    'lb' => [
        'Organisatiounen' => 'cat_organizations',
        'Reegelen & Praxis' => 'cat_rules_practice',
        'Ressourcen' => 'cat_resources',
        'Technologie' => 'cat_technology'
    ],
    'de' => [
        'Organisationen' => 'cat_organizations',
        'Regeln & Praxis' => 'cat_rules_practice',
        'Ressourcen' => 'cat_resources',
        'Technologie' => 'cat_technology'
    ],
    'fr' => [
        'Organisations' => 'cat_organizations',
        'Règles & Pratique' => 'cat_rules_practice',
        'Ressources' => 'cat_resources',
        'Technologie' => 'cat_technology'
    ],
    'en' => [
        'Organizations' => 'cat_organizations',
        'Rules & Practice' => 'cat_rules_practice',
        'Resources' => 'cat_resources',
        'Technology' => 'cat_technology'
    ]
];

/**
 * Get localized category name
 */
function getLocalizedCategoryName($categoryKey, $lang = null) {
    global $currentLanguage;
    $lang = $lang ?? $currentLanguage;

    $names = [
        'cat_organizations' => [
            'lb' => 'Organisatiounen',
            'de' => 'Organisationen',
            'fr' => 'Organisations',
            'en' => 'Organizations'
        ],
        'cat_rules_practice' => [
            'lb' => 'Reegelen & Praxis',
            'de' => 'Regeln & Praxis',
            'fr' => 'Règles & Pratique',
            'en' => 'Rules & Practice'
        ],
        'cat_resources' => [
            'lb' => 'Ressourcen',
            'de' => 'Ressourcen',
            'fr' => 'Ressources',
            'en' => 'Resources'
        ],
        'cat_technology' => [
            'lb' => 'Technologie',
            'de' => 'Technologie',
            'fr' => 'Technologie',
            'en' => 'Technology'
        ]
    ];

    return $names[$categoryKey][$lang] ?? $categoryKey;
}

/**
 * Get article by slug for a specific language
 * @param string $slug Article slug
 * @param string|null $lang Language code
 * @return array|null Article data or null if not found
 */
function getArticle($slug, $lang = null) {
    global $articles, $currentLanguage;
    $lang = $lang ?? $currentLanguage;

    // Validate slug format
    if (!is_string($slug) || !preg_match('/^[a-z0-9-]+$/', $slug)) {
        return null;
    }

    foreach ($articles as $articleId => $translations) {
        if (isset($translations[$lang]) && $translations[$lang]['slug'] === $slug) {
            $article = $translations[$lang];
            $article['id'] = $articleId;

            // Get available translations for this article
            $article['translations'] = array_keys($translations);

            return $article;
        }
    }
    return null;
}

/**
 * Get all articles for a specific language
 * @param string|null $lang Language code
 * @return array Articles sorted by date (newest first)
 */
function getAllArticles($lang = null) {
    global $articles, $currentLanguage;
    $lang = $lang ?? $currentLanguage;

    $result = [];
    foreach ($articles as $articleId => $translations) {
        if (isset($translations[$lang])) {
            $article = $translations[$lang];
            $article['id'] = $articleId;
            $article['translations'] = array_keys($translations);
            $result[] = $article;
        }
    }

    // Sort by date (newest first)
    usort($result, function($a, $b) {
        return strtotime($b['date']) - strtotime($a['date']);
    });

    return $result;
}

/**
 * Get articles by category for a specific language
 * @param string $category Category name (in the current language)
 * @param string|null $lang Language code
 * @return array Articles in the category
 */
function getArticlesByCategory($category, $lang = null) {
    global $currentLanguage;
    $lang = $lang ?? $currentLanguage;

    $all = getAllArticles($lang);
    return array_filter($all, function($article) use ($category) {
        return $article['category'] === $category;
    });
}

/**
 * Get recent articles
 * @param int $limit Number of articles to return
 * @param string|null $lang Language code
 * @return array Recent articles
 */
function getRecentArticles($limit = 10, $lang = null) {
    $all = getAllArticles($lang);
    return array_slice($all, 0, $limit);
}

/**
 * Get article translation URL
 * @param string $articleId Article ID
 * @param string $targetLang Target language
 * @return string|null URL or null if translation doesn't exist
 */
function getArticleTranslationUrl($articleId, $targetLang) {
    global $articles, $languages;

    if (!isset($articles[$articleId][$targetLang])) {
        return null;
    }

    $slug = $articles[$articleId][$targetLang]['slug'];
    $articlePath = $languages[$targetLang]['article_path'];
    $domain = $languages[$targetLang]['domain'];

    return 'https://' . $domain . '/' . $articlePath . '/' . $slug . '/';
}

/**
 * Get all categories for a language
 * @param string|null $lang Language code
 * @return array Categories with their descriptions
 */
function getCategories($lang = null) {
    global $currentLanguage;
    $lang = $lang ?? $currentLanguage;

    return [
        getLocalizedCategoryName('cat_organizations', $lang) => t('cat_organizations_desc', $lang),
        getLocalizedCategoryName('cat_rules_practice', $lang) => t('cat_rules_practice_desc', $lang),
        getLocalizedCategoryName('cat_resources', $lang) => t('cat_resources_desc', $lang),
        getLocalizedCategoryName('cat_technology', $lang) => t('cat_technology_desc', $lang)
    ];
}

/**
 * Check if an article has a translation in a specific language
 * @param string $articleId Article ID
 * @param string $lang Language code
 * @return bool
 */
function hasTranslation($articleId, $lang) {
    global $articles;
    return isset($articles[$articleId][$lang]);
}

/**
 * Format date to ISO 8601 with Luxembourg timezone
 * @param string $date Date in YYYY-MM-DD format
 * @return string ISO 8601 datetime string
 */
function formatDateISO8601($date) {
    $dateTime = new DateTime($date, new DateTimeZone('Europe/Luxembourg'));
    $dateTime->setTime(12, 0, 0);
    return $dateTime->format('c');
}

/**
 * Backwards compatibility wrapper for formatDateLB
 * @param string $date Date in YYYY-MM-DD format
 * @return string Formatted date in Luxembourgish
 */
function formatDateLB($date) {
    return formatDate($date, 'lb');
}
