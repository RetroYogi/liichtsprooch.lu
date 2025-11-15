<?php
require_once 'config.php';
require_once 'security-headers.php';

// Configure secure session and set security headers
configureSecureSession();
setSecurityHeaders(false);  // Homepage, no embeds

// Get recent articles for display (all articles for pagination)
$recentArticles = getAllArticles();

// Page meta variables for header template
$currentPage = 'home';
$pageTitle = SITE_TITLE;
$metaDescription = SITE_DESCRIPTION;
$canonicalUrl = SITE_URL;
$ogType = 'website';

// Include header
include 'header.php';

// Include homepage content template
include 'templates/homepage-content.php';

// Include footer
include 'footer.php';
?>
