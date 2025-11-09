    <!-- Footer -->
    <footer class="site-footer">
        <div class="footer-content">
            <p>&copy; <?php echo date('Y'); ?> Liicht Sprooch zu Lëtzebuerg Info-Site. All Rechter virbehalen.</p>
            <p>
                <a href="/index.php">Startsäit</a> |
                <a href="http://github.com/RetroYogi/liichtsprooch.lu/" target="_blank">GitHub</a> |
                <a href="/rss.php">RSS Feed</a> |
                <a href="mailto:liichtsprooch@mailo.lu" rel="noopener">Kontakt</a>
            </p>
        </div>
    </footer>

    <!-- JavaScript for mobile navigation -->
    <script>
        // Mobile menu toggle
        const navToggle = document.querySelector('.nav-toggle');
        const navMenu = document.querySelector('.nav-menu');

        navToggle.addEventListener('click', function() {
            const isExpanded = this.getAttribute('aria-expanded') === 'true';
            this.setAttribute('aria-expanded', !isExpanded);
            navMenu.classList.toggle('active');
        });

        // Dropdown toggle
        const dropdownToggles = document.querySelectorAll('.nav-dropdown-toggle');
        dropdownToggles.forEach(toggle => {
            toggle.addEventListener('click', function(e) {
                e.preventDefault();
                const isExpanded = this.getAttribute('aria-expanded') === 'true';
                this.setAttribute('aria-expanded', !isExpanded);
                const menu = this.nextElementSibling;
                menu.classList.toggle('active');
            });
        });
    </script>
</body>
</html>
