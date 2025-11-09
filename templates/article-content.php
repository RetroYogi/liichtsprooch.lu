    <!-- Main Container -->
    <main id="main-content">
        <!-- Breadcrumb -->
        <nav class="breadcrumb" aria-label="Breadcrumb">
            <a href="/">Startsäit</a> /
            <span><?php echo htmlspecialchars($article['category']); ?></span> /
            <span aria-current="page"><?php echo htmlspecialchars($article['title']); ?></span>
        </nav>

        <!-- Article -->
        <article class="article-content">
            <header class="article-header">
                <div class="article-meta">
                    <span class="article-category"><?php echo htmlspecialchars($article['category']); ?></span>
                    <time class="article-date" datetime="<?php echo $article['date']; ?>">
                        <?php echo formatDateLB($article['date']); ?>
                    </time>
                </div>
                <h1><?php echo htmlspecialchars($article['title']); ?></h1>
            </header>

            <div class="article-body">
                <?php echo $htmlContent; ?>
            </div>

            <footer class="article-footer">
                <div class="article-share">
                    <strong>Deelt dësen Artikel:</strong>
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode($canonicalUrl); ?>" target="_blank" rel="noopener" aria-label="Op Facebook deelen">Facebook</a>
                    <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode($canonicalUrl); ?>&text=<?php echo urlencode($article['title']); ?>" target="_blank" rel="noopener" aria-label="Op Twitter deelen">Twitter</a>
                    <a href="mailto:?subject=<?php echo urlencode($article['title']); ?>&body=<?php echo urlencode($canonicalUrl); ?>" aria-label="Per E-Mail deelen">E-Mail</a>
                </div>
            </footer>
        </article>

        <!-- Related Articles -->
        <?php if (!empty($relatedArticles)): ?>
        <aside class="related-articles" aria-labelledby="related-heading">
            <h2 id="related-heading">Méi Artikelen aus "<?php echo htmlspecialchars($article['category']); ?>"</h2>
            <div class="related-grid">
                <?php foreach ($relatedArticles as $related): ?>
                <article class="related-card">
                    <h3><a href="/artikel/<?php echo urlencode($related['slug']); ?>/"><?php echo htmlspecialchars($related['title']); ?></a></h3>
                    <p><?php echo htmlspecialchars($related['description']); ?></p>
                    <time datetime="<?php echo $related['date']; ?>"><?php echo formatDateLB($related['date']); ?></time>
                </article>
                <?php endforeach; ?>
            </div>
        </aside>
        <?php endif; ?>

        <!-- Back to Home -->
        <div class="back-to-home">
            <a href="/" class="button-primary">← Zréck op d'Haaptsäit</a>
        </div>
    </main>
