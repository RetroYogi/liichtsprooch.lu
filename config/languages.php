<?php
/**
 * Multilingual Configuration System
 *
 * This file manages language definitions, domain mappings, and translation functions.
 * Each domain serves a specific language version of the site.
 */

// Available languages
$languages = [
    'lb' => [
        'code' => 'lb',
        'locale' => 'lb-LU',
        'name' => 'Lëtzebuergesch',
        'native_name' => 'Lëtzebuergesch',
        'domain' => 'liichtsprooch.lu',
        'direction' => 'ltr',
        'date_format' => 'j. F Y',
        'article_path' => 'artikel',
        'about_path' => 'iwwer'
    ],
    'de' => [
        'code' => 'de',
        'locale' => 'de-LU',
        'name' => 'Deutsch',
        'native_name' => 'Deutsch',
        'domain' => 'leichtesprache.lu',
        'direction' => 'ltr',
        'date_format' => 'j. F Y',
        'article_path' => 'artikel',
        'about_path' => 'ueber'
    ],
    'fr' => [
        'code' => 'fr',
        'locale' => 'fr-LU',
        'name' => 'Français',
        'native_name' => 'Français',
        'domain' => 'facile-a-lire.lu',
        'direction' => 'ltr',
        'date_format' => 'j F Y',
        'article_path' => 'article',
        'about_path' => 'a-propos'
    ],
    'en' => [
        'code' => 'en',
        'locale' => 'en-GB',
        'name' => 'English',
        'native_name' => 'English',
        'domain' => 'easyread.lu',
        'direction' => 'ltr',
        'date_format' => 'F j, Y',
        'article_path' => 'article',
        'about_path' => 'about'
    ]
];

// Default language
$defaultLanguage = 'lb';

// Current language (set during build or request)
$currentLanguage = $defaultLanguage;

// Translations storage
$translations = [];

/**
 * Load translations for a language
 * @param string $lang Language code
 */
function loadTranslations($lang) {
    global $translations;

    $file = __DIR__ . '/translations/' . $lang . '.php';
    if (file_exists($file)) {
        $translations[$lang] = include $file;
    } else {
        $translations[$lang] = [];
    }
}

/**
 * Get translation for a key
 * @param string $key Translation key
 * @param string|null $lang Language code (uses current if null)
 * @param array $params Parameters for sprintf replacement
 * @return string Translated string or key if not found
 */
function t($key, $lang = null, $params = []) {
    global $translations, $currentLanguage, $defaultLanguage;

    $lang = $lang ?? $currentLanguage;

    // Load translations if not already loaded
    if (!isset($translations[$lang])) {
        loadTranslations($lang);
    }

    // Get translation, fallback to default language, then to key
    $text = $translations[$lang][$key]
        ?? $translations[$defaultLanguage][$key]
        ?? $key;

    // Apply parameters if provided
    if (!empty($params)) {
        $text = vsprintf($text, $params);
    }

    return $text;
}

/**
 * Set the current language
 * @param string $lang Language code
 */
function setLanguage($lang) {
    global $currentLanguage, $languages;

    if (isset($languages[$lang])) {
        $currentLanguage = $lang;
        loadTranslations($lang);
    }
}

/**
 * Get current language code
 * @return string
 */
function getCurrentLanguage() {
    global $currentLanguage;
    return $currentLanguage;
}

/**
 * Get language configuration
 * @param string|null $lang Language code (uses current if null)
 * @return array Language configuration
 */
function getLanguageConfig($lang = null) {
    global $languages, $currentLanguage;
    $lang = $lang ?? $currentLanguage;
    return $languages[$lang] ?? $languages['lb'];
}

/**
 * Get all available languages
 * @return array
 */
function getAvailableLanguages() {
    global $languages;
    return $languages;
}

/**
 * Detect language from domain
 * @param string $domain The domain name
 * @return string Language code
 */
function detectLanguageFromDomain($domain) {
    global $languages, $defaultLanguage;

    // Remove www. prefix if present
    $domain = preg_replace('/^www\./', '', $domain);

    foreach ($languages as $code => $config) {
        if ($config['domain'] === $domain) {
            return $code;
        }
    }

    return $defaultLanguage;
}

/**
 * Get URL for another language version
 * @param string $targetLang Target language code
 * @param string $path Current path (without language prefix)
 * @return string Full URL for target language
 */
function getLanguageUrl($targetLang, $path = '/') {
    global $languages;

    if (!isset($languages[$targetLang])) {
        return $path;
    }

    $domain = $languages[$targetLang]['domain'];
    return 'https://' . $domain . $path;
}

/**
 * Format date according to language
 * @param string $date Date string (YYYY-MM-DD)
 * @param string|null $lang Language code
 * @return string Formatted date
 */
function formatDate($date, $lang = null) {
    global $currentLanguage;
    $lang = $lang ?? $currentLanguage;

    $timestamp = strtotime($date);

    // Month names per language
    $months = [
        'lb' => [
            1 => 'Januar', 2 => 'Februar', 3 => 'Mäerz', 4 => 'Abrëll',
            5 => 'Mee', 6 => 'Juni', 7 => 'Juli', 8 => 'August',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Dezember'
        ],
        'de' => [
            1 => 'Januar', 2 => 'Februar', 3 => 'März', 4 => 'April',
            5 => 'Mai', 6 => 'Juni', 7 => 'Juli', 8 => 'August',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Dezember'
        ],
        'fr' => [
            1 => 'janvier', 2 => 'février', 3 => 'mars', 4 => 'avril',
            5 => 'mai', 6 => 'juin', 7 => 'juillet', 8 => 'août',
            9 => 'septembre', 10 => 'octobre', 11 => 'novembre', 12 => 'décembre'
        ],
        'en' => [
            1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April',
            5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August',
            9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'
        ]
    ];

    $day = date('j', $timestamp);
    $monthNum = (int)date('n', $timestamp);
    $year = date('Y', $timestamp);
    $month = $months[$lang][$monthNum] ?? $months['en'][$monthNum];

    // Format based on language
    switch ($lang) {
        case 'lb':
        case 'de':
            return "$day. $month $year";
        case 'fr':
            return "$day $month $year";
        case 'en':
            return "$month $day, $year";
        default:
            return "$day $month $year";
    }
}

/**
 * Get site configuration for a language
 * @param string|null $lang Language code
 * @return array Site configuration
 */
function getSiteConfig($lang = null) {
    global $currentLanguage;
    $lang = $lang ?? $currentLanguage;

    $configs = [
        'lb' => [
            'title' => 'Liicht Sprooch Info-Site',
            'description' => 'Informatiounen iwwer Liicht Sprooch zu Lëtzebuerg - Facile à lire et à comprendre (FALC) - Leichte Sprache - Easy-to-Read.',
            'keywords' => 'Liicht Sprooch, Leichte Sprache, FALC, Easy-to-Read, Luxemburg, Lëtzebuerg, Inklusion, Accessibilitéit',
            'url' => 'https://liichtsprooch.lu'
        ],
        'de' => [
            'title' => 'Leichte Sprache Info-Seite',
            'description' => 'Informationen über Leichte Sprache in Luxemburg - Facile à lire et à comprendre (FALC) - Easy-to-Read.',
            'keywords' => 'Leichte Sprache, FALC, Easy-to-Read, Luxemburg, Inklusion, Barrierefreiheit, Verständlichkeit',
            'url' => 'https://leichtesprache.lu'
        ],
        'fr' => [
            'title' => 'Site Info FALC',
            'description' => 'Informations sur le Facile à lire et à comprendre (FALC) au Luxembourg - Leichte Sprache - Easy-to-Read.',
            'keywords' => 'FALC, Facile à lire, Easy-to-Read, Luxembourg, Inclusion, Accessibilité',
            'url' => 'https://facile-a-lire.lu'
        ],
        'en' => [
            'title' => 'Easy-to-Read Info Site',
            'description' => 'Information about Easy-to-Read in Luxembourg - Facile à lire et à comprendre (FALC) - Leichte Sprache.',
            'keywords' => 'Easy-to-Read, FALC, Leichte Sprache, Luxembourg, Inclusion, Accessibility',
            'url' => 'https://easyread.lu'
        ]
    ];

    return $configs[$lang] ?? $configs['lb'];
}

/**
 * Generate hreflang tags for SEO
 * @param string $currentPath Current page path
 * @param array $availableLangs Languages this content is available in
 * @return string HTML hreflang link tags
 */
function generateHreflangTags($currentPath, $availableLangs = null) {
    global $languages;

    $availableLangs = $availableLangs ?? array_keys($languages);
    $tags = [];

    foreach ($availableLangs as $lang) {
        if (isset($languages[$lang])) {
            $url = getLanguageUrl($lang, $currentPath);
            $locale = $languages[$lang]['locale'];
            $tags[] = '<link rel="alternate" hreflang="' . $locale . '" href="' . $url . '">';
        }
    }

    // Add x-default pointing to Luxembourgish version
    $defaultUrl = getLanguageUrl('lb', $currentPath);
    $tags[] = '<link rel="alternate" hreflang="x-default" href="' . $defaultUrl . '">';

    return implode("\n    ", $tags);
}
