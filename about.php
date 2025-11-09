<?php
require_once 'config.php';
require_once 'security-headers.php';

// Configure secure session and set security headers
configureSecureSession();
setSecurityHeaders(false);

// Page meta variables for header template
$currentPage = 'about';
$pageTitle = 'Iwwer eis - ' . SITE_TITLE;
$metaDescription = 'Méi iwwer Liicht Sprooch zu Lëtzebuerg';
$canonicalUrl = SITE_URL . '/about.php';
$ogType = 'website';

// Include header
include 'header.php';

// Include content template
include 'templates/about-content.php';

// Include footer
include 'footer.php';
?>
