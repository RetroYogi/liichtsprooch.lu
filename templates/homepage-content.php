    <!-- Main Container -->
    <main id="main-content">

        <!-- Section 1: Hero/Introduction -->
        <section class="hero-section" aria-labelledby="hero-title">
            <div class="hero-background">
                <img src="/assets/twnufSejSmTxeHDRw0rf2.png" alt="" class="hero-image" role="presentation">
            </div>
            <div class="hero-content">
                <h1 id="hero-title">Liicht Sprooch zu Lëtzebuerg</h1>
                <div class="intro-text-background">
                    <p class="intro-text">Liicht Sprooch ass e wichtegt Instrument fir Inclusioun zu Lëtzebuerg. Si hëlleft Mënschen, déi Schwieregkeete mam Liesen oder Verstoen hunn, un der Gesellschaft deelzehuelen. Dëst Informatiounsblat gëtt en Iwwerbléck iwwer d'Bedeitung, d'Ressourcen an d'Zukunft vun der Liichter Sprooch am Grand-Duché.</p>
                </div>
            </div>
        </section>

        <!-- Section: Recent Articles -->
        <section class="content-section recent-articles-section" aria-labelledby="recent-articles-title">
            <h2 id="recent-articles-title">Aktuell Artikelen</h2>
            <p>Entdeckt nei Artikelen iwwer Liicht Sprooch zu Lëtzebuerg:</p>

            <!-- Articles Container with ARIA live region for accessibility -->
            <div class="articles-container"
                 data-current-offset="0"
                 data-per-page="3"
                 data-total-articles="<?php echo count(getAllArticles()); ?>">

                <!-- Pagination Controls - Top (Desktop) -->
                <nav class="articles-pagination articles-pagination-top"
                     aria-label="Artikelen Navigatioun">
                    <button class="pagination-btn pagination-prev"
                            aria-label="Zréck zu virege Artikelen"
                            disabled>
                        <span class="pagination-icon" aria-hidden="true">←</span>
                        <span class="pagination-text">Zréck</span>
                    </button>
                    <div class="pagination-info" role="status" aria-live="polite">
                        <span class="visually-hidden">Aktuell Säit: </span>
                        <span class="pagination-current">1-3</span> vun
                        <span class="pagination-total"><?php echo count(getAllArticles()); ?></span>
                    </div>
                    <button class="pagination-btn pagination-next"
                            aria-label="Weider zu méi Artikelen">
                        <span class="pagination-text">Weider</span>
                        <span class="pagination-icon" aria-hidden="true">→</span>
                    </button>
                </nav>

                <!-- Articles Grid with swipe support -->
                <div class="articles-grid-wrapper" role="region" aria-live="polite" aria-atomic="true">
                    <div class="articles-grid" id="articles-grid">
                        <?php
                        // Show only first 3 articles initially
                        $initialArticles = array_slice($recentArticles, 0, 3);
                        foreach ($initialArticles as $article):
                        ?>
                        <article class="article-card">
                            <div class="article-card-header">
                                <span class="article-card-category"><?php echo htmlspecialchars($article['category']); ?></span>
                                <time datetime="<?php echo $article['date']; ?>"><?php echo formatDateLB($article['date']); ?></time>
                            </div>
                            <h3><a href="/artikel/<?php echo urlencode($article['slug']); ?>/"><?php echo htmlspecialchars($article['title']); ?></a></h3>
                            <p><?php echo htmlspecialchars($article['description']); ?></p>
                            <a href="/artikel/<?php echo urlencode($article['slug']); ?>/" class="article-card-link">Méi liesen →</a>
                        </article>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Loading indicator -->
                <div class="articles-loading" role="status" aria-live="polite" aria-hidden="true">
                    <span class="loading-spinner" aria-hidden="true"></span>
                    <span class="loading-text">Artikelen lueden...</span>
                </div>

                <!-- Pagination Controls - Bottom (Mobile) -->
                <nav class="articles-pagination articles-pagination-bottom"
                     aria-label="Artikelen Navigatioun">
                    <button class="pagination-btn pagination-prev"
                            aria-label="Zréck zu virege Artikelen"
                            disabled>
                        <span class="pagination-icon" aria-hidden="true">←</span>
                        <span class="pagination-text">Zréck</span>
                    </button>
                    <button class="pagination-btn pagination-next"
                            aria-label="Weider zu méi Artikelen">
                        <span class="pagination-text">Weider</span>
                        <span class="pagination-icon" aria-hidden="true">→</span>
                    </button>
                </nav>
            </div>
        </section>

        <!-- Section 2: What is Easy Language -->
        <section class="content-section" aria-labelledby="definition-title">
            <div class="section-with-illustration">
                <div class="section-text">
                    <h2 id="definition-title">Wat ass Liicht Sprooch?</h2>
                    <p>Liicht Sprooch ass eng vereinfacht Form vun der Sprooch, déi entwéckelt gouf fir Leit ze hëllefen, déi Schwieregkeeten hu mat Liesen a Verstoen. Liicht Sprooch gëtt och als "Leichte Sprache" op Däitsch oder "Facile à lire et à comprendre" (FALC) op Franséisch bezeechent.</p>
                </div>
                <div class="section-illustration">
                    <img src="/assets/Blue-green.png" alt="Liicht Sprooch Illustration" class="illustration-image">
                </div>
            </div>

            <div class="terminology-grid">
                <div class="terminology-item">
                    <h3>Lëtzebuergesch</h3>
                    <p>Liicht Sprooch</p>
                </div>
                <div class="terminology-item">
                    <h3>Däitsch</h3>
                    <p>Leichte Sprache</p>
                </div>
                <div class="terminology-item">
                    <h3>Franséisch</h3>
                    <p>Facile à lire et à comprendre (FALC)</p>
                </div>
            </div>
        </section>

        <!-- Section 3: Importance -->
        <section class="content-section" aria-labelledby="importance-title">
            <h2 id="importance-title">Wichtegkeet vun der Liichter Sprooch</h2>
            <p>D'Liicht Sprooch spillt eng wichteg Roll fir d'Inclusioun an d'Participatioun vun alle Bierger an der Gesellschaft. Si hëlleft:</p>

            <div class="importance-grid">
                <article class="importance-item">
                    <img src="/assets/user.svg" alt="" class="item-icon" role="presentation">
                    <h3>Leit mat Liesschwieregkeeten</h3>
                    <p>Liicht Sprooch erméiglecht et Leit mat Liesschwieregkeeten, wichteg Informatiounen ze verstoen.</p>
                </article>

                <article class="importance-item">
                    <img src="/assets/user.svg" alt="" class="item-icon" role="presentation">
                    <h3>Leit mat intellektueller Beanträchtegung</h3>
                    <p>Fir Persoune mat intellektuelle Schwierechkeeten ass Liicht Sprooch e wichtegt Instrument fir Zougang zu Informatiounen ze kréien.</p>
                </article>

                <article class="importance-item">
                    <img src="/assets/user.svg" alt="" class="item-icon" role="presentation">
                    <h3>Leit, déi d'Sprooch net als hir Mammesprooch hunn</h3>
                    <p>Liicht Sprooch hëlleft och Leit, déi d'Sprooch net als hir Mammesprooch hunn, besser ze verstoen.</p>
                </article>

                <article class="importance-item">
                    <img src="/assets/user.svg" alt="" class="item-icon" role="presentation">
                    <h3>Eeler Leit a Kanner</h3>
                    <p>Eeler Leit a Kanner a Jugendlecher profitéieren och vun der Liichter Sprooch fir besser Verständnis.</p>
                </article>
            </div>

            <p class="closing-paragraph">Duerch d'Benotzung vu Liichter Sprooch gëtt garantéiert, datt all Bierger Zougang zu wichtegen Informatiounen hunn a besser um gesellschaftleche Liewen deelhuele kënnen.</p>
        </section>

        <!-- Section 4: Resources -->
        <section class="content-section" aria-labelledby="resources-title">
            <h2 id="resources-title">Informatiounen op Liichter Sprooch</h2>
            <p>Et ginn eng Rei vu Ressourcen op Liichter Sprooch zu Lëtzebuerg:</p>

            <div class="resources-list">
                <details class="resource-toggle">
                    <summary>
                        <h3>Mediation Scolaire</h3>
                    </summary>
                    <div class="resource-content">
                        <p>D'Mediation Scolaire bitt Informatiounen a Ressourcen un, déi hëllefen, Schoulsituatiounen besser ze verstoen.</p>
                        <a href="https://www.mediationscolaire.lu/lu/leichte-sprache/" target="_blank" rel="noopener noreferrer" class="resource-link">Méi Informatiounen op mediationscolaire.lu</a>
                    </div>
                </details>

                <details class="resource-toggle">
                    <summary>
                        <h3>Guichet.lu</h3>
                    </summary>
                    <div class="resource-content">
                        <p>Op Guichet.lu fannt Dir offiziell Informatiounen a Formularen an der Liichter Sprooch, fir administrativ Procéduren einfacher ze maachen.</p>
                        <a href="https://guichet.public.lu/de/leichte-sprache.html" target="_blank" rel="noopener noreferrer" class="resource-link">Guichet.lu a Liichter Sprooch besichen</a>
                    </div>
                </details>

                <details class="resource-toggle">
                    <summary>
                        <h3>Klaro - Offiziellen Zentrum fir Liicht Sprooch zu Lëtzebuerg (APEMH)</h3>
                    </summary>
                    <div class="resource-content">
                        <p>Klaro ass den offizielle Kompetenzzentrum fir Liicht Sprooch zu Lëtzebuerg a gëtt vun der APEMH bedriwwen. Et bitt Iwwersetzungen, Formatiounen a vill méi Servicer un.</p>
                        <a href="https://www.klaro.lu/" target="_blank" rel="noopener noreferrer" class="resource-link">Klaro.lu besichen</a>
                    </div>
                </details>

                <details class="resource-toggle">
                    <summary>
                        <h3>Infocrise.lu</h3>
                    </summary>
                    <div class="resource-content">
                        <p>Infocrise.lu bitt wichteg Informatiounen iwwer Krisen a Noutfäll an der Liichter Sprooch, sou dass all Bierger informéiert bléift.</p>
                        <a href="https://infocrise.public.lu/de/support/leichte-sprache.html" target="_blank" rel="noopener noreferrer" class="resource-link">Infocrise.lu a Liichter Sprooch</a>
                    </div>
                </details>
            </div>
        </section>

        <!-- Section 5: Tools -->
        <section class="content-section" aria-labelledby="tools-title">
            <h2 id="tools-title">Flott Hëllefsmëttel fir Liicht Sprooch</h2>

            <div class="tools-header">
                <img src="/assets/Ort_Klaro-Piktos-214x300.png" alt="Klaro Piktogrammer" class="tools-illustration">
            </div>

            <div class="tools-grid">
                <article class="tool-item">
                    <h3>POINT Project</h3>
                    <p>De POINT Project bitt Ressourcen an Tools fir d'Ënnerstëtzung vun der Liichter Sprooch a verschiddenen europäeschen Länner.</p>
                    <a href="https://point-project.net/" target="_blank" rel="noopener noreferrer" class="tool-link">POINT Project entdecken</a>
                </article>

                <article class="tool-item">
                    <h3>Klaro - Piktogrammer</h3>
                    <p>Klaro bitt eng Sammlung vu Piktogrammer un, déi hëllefen, Texter méi visuell a méi einfach ze maachen.</p>
                    <a href="https://klaro.lu/leichte-sprache/toolbox/" target="_blank" rel="noopener noreferrer" class="tool-link">Piktogrammer entdecken</a>
                </article>

                <article class="tool-item">
                    <h3>Einfach Sprooch - Iwwersetzungstool</h3>
                    <p>Dëst Online-Tool erlaabt et Iech, Texter direkt an eng méi einfach Sprooch ze iwwersetzen.</p>
                    <a href="https://einfachesprache.xyz/" target="_blank" rel="noopener noreferrer" class="tool-link">Tool benotzen</a>
                </article>

                <article class="tool-item">
                    <h3>Klaro - Formatiounen</h3>
                    <p>Klaro bitt och Formatiounen an Liicht Sprooch un, déi vu UFEP, INAP an IFEN ugebuede ginn. Méi Infos op den Internet Säite vun dësen Organisatiounen.</p>
                    <a href="https://www.klaro.lu/" target="_blank" rel="noopener noreferrer" class="tool-link">Méi iwwer Formatiounen</a>
                </article>
            </div>

            <p class="closing-paragraph">Mat dësen Tools kënnen me d'Accessibilitéit vu Informatioune fir eis Gesellschaft verbesseren an eng inklusiv Kommunikatioun förderen.</p>
        </section>

        <!-- Section 6: Organizations -->
        <section class="content-section" aria-labelledby="organizations-title">
            <h2 id="organizations-title">Organisatiounen, déi an dësem Beräich schaffen</h2>
            <p>Verschidden Organisatioune schaffen am Beräich vun der Liichter Sprooch zu Lëtzebuerg an am Ausland:</p>

            <div class="organizations-grid">
                <article class="organization-item">
                    <img src="/assets/cropped-klaro_logo_no-font-192x192.png" alt="APEMH Klaro Logo" class="org-logo">
                    <h3>APEMH</h3>
                    <p>D'APEMH - Menschen mit einer intellektueller Beeinträchtigung und deren Familien - ass eng vun de Haaptorganisatiounen zu Lëtzebuerg, déi sech fir d'Rechter vu Mënschen mat intellektueller Beanträchtegung asetzen. Si bedreiwen och dat national Kompetenzzentrum fir Liicht Sprooch "Klaro".</p>
                    <a href="https://www.apemh.lu/" target="_blank" rel="noopener noreferrer" class="org-link">APEMH besichen</a>
                </article>

                <article class="organization-item">
                    <img src="/assets/star.svg" alt="" class="org-logo" role="presentation">
                    <h3>Inclusion Europe</h3>
                    <p>Inclusion Europe ass eng europäesch Organisatioun, déi sech fir d'Rechter vu Mënschen mat intellektueller Beanträchtegung asetzen. Si entwéckelen och internationalen Richtlinnen a Ressourcen fir Liicht Sprooch.</p>
                    <a href="https://www.inclusion-europe.eu/easy-to-read/" target="_blank" rel="noopener noreferrer" class="org-link">Inclusion Europe besichen</a>
                </article>
            </div>
        </section>

        <!-- Section 7: Rules -->
        <section class="content-section" aria-labelledby="rules-title">
            <h2 id="rules-title">Reegele fir Liicht Sprooch zu Lëtzebuerg</h2>
            <p>D'Reegele fir Liicht Sprooch zu Lëtzebuerg baséieren op internationale Richtlinnen:</p>

            <div class="rules-list">
                <article class="rule-item">
                    <img src="/assets/arrow-up-short-wide.svg" alt="" class="rule-icon" role="presentation">
                    <h3>Kuerz Sätz</h3>
                    <p>Kuerz Sätz benotzen</p>
                </article>

                <article class="rule-item">
                    <img src="/assets/chart-simple.svg" alt="" class="rule-icon" role="presentation">
                    <h3>Einfach Wierder</h3>
                    <p>Einfach Wierder benotzen</p>
                </article>

                <article class="rule-item">
                    <img src="/assets/star.svg" alt="" class="rule-icon" role="presentation">
                    <h3>Kloer Erklärungen</h3>
                    <p>Kloer Erklärunge ginn</p>
                </article>

                <article class="rule-item">
                    <img src="/assets/chart-simple.svg" alt="" class="rule-icon" role="presentation">
                    <h3>Beispiller</h3>
                    <p>Beispiller benotzen</p>
                </article>
            </div>

            <ul class="additional-rules">
                <li>Biller an Ikonen als Ënnerstëtzung benotzen</li>
                <li>Nëmmen eng Form vun engem Wuert benotzen (z.B. "Wieler" amplaz vu "Wielerinnen a Wieler")</li>
                <li>Komplex Sätz a Fachjargon vermeiden</li>
            </ul>

            <p class="closing-paragraph">Dës Reegele ginn a verschiddenen offiziellen Dokumenter an op Websäite wéi Guichet.lu an Infocrise.lu ugewannt, fir Kloerheet an Zougänglechkeet ze garantéieren.</p>
        </section>

        <!-- Section 8: Use and Future -->
        <section class="content-section" aria-labelledby="future-title">
            <h2 id="future-title">Benotzung a Zukunft vun der Liichter Sprooch zu Lëtzebuerg</h2>
            <p>D'Benotzung vu Liichter Sprooch zu Lëtzebuerg gëtt ëmmer méi wichteg. Et gëtt a verschiddene Beräicher agesat:</p>

            <div class="applications-grid">
                <article class="application-item">
                    <h3>Administrativ Dokumenter</h3>
                    <p>Vill offiziell Formularen a Broschüre ginn a Liichter Sprooch iwwersat. Dëst hëlleft Bierger besser mat der Administratioun ze interagéieren.</p>
                </article>

                <article class="application-item">
                    <h3>Ëffentlech Informatiounen</h3>
                    <p>Wichteg Informatiounen, wéi Gesondheetstipps oder Sécherheetsmoossnamen, ginn a Liichter Sprooch verëffentlecht. Dëst garantéiert, datt all Bierger Zougang zu liewenswichtegen Informatiounen hunn.</p>
                </article>

                <article class="application-item">
                    <h3>Bildung</h3>
                    <p>Schoulen a Bildungsariichtunge benotzen ëmmer méi Materialien a Liicht Sprooch. Dëst ënnerstëtzt Schüler mat Liesschwieregkeeten oder aner Besoinen.</p>
                </article>

                <article class="application-item">
                    <h3>Kulturell Institutiounen</h3>
                    <p>Muséeën a Bibliothéike bidden dacks Beschreiwungen an Zesummefaassungen a Liichter Sprooch un. Dëst mécht Kultur méi zougänglech fir jiddereen.</p>
                </article>

                <article class="application-item">
                    <h3>Walen a Politik</h3>
                    <p>Wahlprogrammer a politesch Informatioune ginn ëmmer méi a Liichter Sprooch iwwersat. Dëst fërdert d'politesch Participatioun vun alle Bierger.</p>
                </article>
            </div>

            <div class="future-outlook">
                <h3>Et gëtt erwaart, datt an Zukunft:</h3>
                <ul>
                    <li>Méi digital Ressourcen a Liichter Sprooch entwéckelt ginn</li>
                    <li>D'Ausbildung vu Professionellen an der Benotzung vu Liichter Sprooch verstäerkt gëtt</li>
                    <li>Méi Gesetzer a Reegele fir d'Benotzung vu Liichter Sprooch a wichtege Beräicher agefouert ginn</li>
                </ul>
            </div>
        </section>

    </main>
