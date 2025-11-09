<?php
require_once 'config.php';
require_once 'security-headers.php';

// Configure secure session and set security headers
configureSecureSession();
setSecurityHeaders(false);

// Page meta variables for header template
$currentPage = 'about';
$pageTitle = 'Iwwer dës Säit - ' . SITE_TITLE;
$metaDescription = 'Méi iwwer Liicht Sprooch zu Lëtzebuerg';
$canonicalUrl = SITE_URL . '/about.php';
$ogType = 'website';

// Include header
include 'header.php';
?>

    <!-- Main Container -->
    <main id="main-content">
        <section class="content-section" aria-labelledby="about-title">
            <h1 id="about-title">Iwwer dës Säit</h1>
            <p>De Site liichtsprooch.lu ass en oppe kollaborative Projet.</p>

<p>Jidderee kann um GitHub-Repository um Projet matmaachen, Artikele verbesseren an nei Artikelen dobäi setzen:
👉 https://github.com/RetroYogi/liichtsprooch.lu</p>

<p>Den ursprénglechen Inhalt vum Site gouf zum groussen Deel mat kënschtlecher Intelligenz (KI) generéiert an net iwwerpréift.

Doduerch kënne grammatesch oder sproochlech Feeler am Text virkommen. </p>
        </section>
    </main>

<?php
// Include footer
include 'footer.php';
?>
