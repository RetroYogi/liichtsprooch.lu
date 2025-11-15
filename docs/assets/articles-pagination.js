/**
 * Articles Pagination with AJAX and Swipe Support
 * Implements accessible pagination for the "Aktuell Artikelen" section
 * with responsive behavior and WCAG compliance
 */

(function() {
    'use strict';

    // Configuration
    const config = {
        articlesJsonUrl: '/articles.json',
        desktopPerPage: 3,
        mobilePerPage: 1,
        mobileBreakpoint: 768,
        swipeThreshold: 50, // Minimum swipe distance in pixels
        animationDuration: 300
    };

    // State
    let state = {
        currentOffset: 0,
        perPage: 3,
        totalArticles: 0,
        allArticles: [], // Cache all articles
        isLoading: false,
        isInitialized: false,
        isMobile: false,
        swipeStartX: 0,
        swipeEndX: 0
    };

    // DOM elements
    const elements = {
        container: null,
        grid: null,
        gridWrapper: null,
        loading: null,
        prevButtons: [],
        nextButtons: [],
        paginationInfo: null,
        paginationCurrent: null,
        paginationTotal: null
    };

    /**
     * Initialize the pagination system
     */
    function init() {
        // Get DOM elements
        elements.container = document.querySelector('.articles-container');
        if (!elements.container) return;

        elements.grid = document.getElementById('articles-grid');
        elements.gridWrapper = document.querySelector('.articles-grid-wrapper');
        elements.loading = document.querySelector('.articles-loading');
        elements.prevButtons = Array.from(document.querySelectorAll('.pagination-prev'));
        elements.nextButtons = Array.from(document.querySelectorAll('.pagination-next'));
        elements.paginationInfo = document.querySelector('.pagination-info');
        elements.paginationCurrent = document.querySelector('.pagination-current');
        elements.paginationTotal = document.querySelector('.pagination-total');

        // Initialize state from data attributes
        state.currentOffset = parseInt(elements.container.dataset.currentOffset) || 0;
        state.totalArticles = parseInt(elements.container.dataset.totalArticles) || 0;

        // Set per page based on screen size
        updatePerPage();

        // Set up event listeners
        setupEventListeners();

        // Update button states
        updatePaginationUI();

        // Fetch all articles
        fetchAllArticles();

        console.log('Articles pagination initialized');
    }

    /**
     * Fetch all articles once from JSON file
     */
    function fetchAllArticles() {
        if (state.isLoading || state.isInitialized) return;

        state.isLoading = true;

        fetch(config.articlesJsonUrl)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to load articles');
                }
                return response.json();
            })
            .then(articles => {
                state.allArticles = articles;
                state.totalArticles = articles.length;
                state.isInitialized = true;

                // Update total in UI
                if (elements.paginationTotal) {
                    elements.paginationTotal.textContent = state.totalArticles;
                }

                console.log(`Loaded ${state.totalArticles} articles`);
            })
            .catch(error => {
                console.error('Error loading articles:', error);
                state.isInitialized = false;
            })
            .finally(() => {
                state.isLoading = false;
            });
    }

    /**
     * Update items per page based on screen size
     */
    function updatePerPage() {
        const wasMobile = state.isMobile;
        state.isMobile = window.innerWidth < config.mobileBreakpoint;
        state.perPage = state.isMobile ? config.mobilePerPage : config.desktopPerPage;

        // Update data attribute
        elements.container.dataset.perPage = state.perPage;

        // If switching between mobile/desktop, reload current page
        if (wasMobile !== state.isMobile && wasMobile !== undefined && state.isInitialized) {
            loadArticles(state.currentOffset);
        }
    }

    /**
     * Set up all event listeners
     */
    function setupEventListeners() {
        // Previous buttons
        elements.prevButtons.forEach(btn => {
            btn.addEventListener('click', handlePrevious);
        });

        // Next buttons
        elements.nextButtons.forEach(btn => {
            btn.addEventListener('click', handleNext);
        });

        // Keyboard navigation
        document.addEventListener('keydown', handleKeyboard);

        // Window resize
        let resizeTimeout;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(updatePerPage, 150);
        });

        // Touch events for swipe on mobile
        if (elements.gridWrapper) {
            elements.gridWrapper.addEventListener('touchstart', handleTouchStart, { passive: true });
            elements.gridWrapper.addEventListener('touchend', handleTouchEnd, { passive: true });
        }

        // Mouse drag for desktop (optional enhancement)
        let isDragging = false;
        let startX = 0;

        if (elements.gridWrapper) {
            elements.gridWrapper.addEventListener('mousedown', (e) => {
                if (!state.isMobile) return; // Only on mobile layout
                isDragging = true;
                startX = e.pageX;
                elements.gridWrapper.style.cursor = 'grabbing';
            });

            document.addEventListener('mouseup', (e) => {
                if (!isDragging) return;
                isDragging = false;
                elements.gridWrapper.style.cursor = '';

                const endX = e.pageX;
                const diff = startX - endX;

                if (Math.abs(diff) > config.swipeThreshold) {
                    if (diff > 0) {
                        handleNext();
                    } else {
                        handlePrevious();
                    }
                }
            });
        }
    }

    /**
     * Handle touch start for swipe detection
     */
    function handleTouchStart(e) {
        state.swipeStartX = e.touches[0].clientX;
    }

    /**
     * Handle touch end for swipe detection
     */
    function handleTouchEnd(e) {
        state.swipeEndX = e.changedTouches[0].clientX;
        handleSwipe();
    }

    /**
     * Process swipe gesture
     */
    function handleSwipe() {
        const diff = state.swipeStartX - state.swipeEndX;

        if (Math.abs(diff) > config.swipeThreshold) {
            if (diff > 0) {
                // Swiped left - go to next
                handleNext();
            } else {
                // Swiped right - go to previous
                handlePrevious();
            }
        }
    }

    /**
     * Handle keyboard navigation
     */
    function handleKeyboard(e) {
        // Only handle if focus is within the articles section
        if (!elements.container.contains(document.activeElement)) return;

        if (e.key === 'ArrowLeft') {
            e.preventDefault();
            handlePrevious();
        } else if (e.key === 'ArrowRight') {
            e.preventDefault();
            handleNext();
        }
    }

    /**
     * Handle previous button click
     */
    function handlePrevious() {
        if (state.isLoading) return;

        const newOffset = Math.max(0, state.currentOffset - state.perPage);
        if (newOffset !== state.currentOffset) {
            loadArticles(newOffset);
        }
    }

    /**
     * Handle next button click
     */
    function handleNext() {
        if (state.isLoading) return;

        const newOffset = state.currentOffset + state.perPage;
        if (newOffset < state.totalArticles) {
            loadArticles(newOffset);
        }
    }

    /**
     * Load articles from cached data
     */
    function loadArticles(offset) {
        if (state.isLoading || !state.isInitialized) return;

        state.isLoading = true;
        showLoading();

        // Simulate async behavior for smooth UX
        setTimeout(() => {
            try {
                // Slice articles array
                const articles = state.allArticles.slice(offset, offset + state.perPage);

                if (articles.length > 0) {
                    renderArticles(articles);
                    state.currentOffset = offset;
                    elements.container.dataset.currentOffset = offset;
                    updatePaginationUI();

                    // Announce to screen readers
                    announcePageChange();

                    // Scroll to top of articles section smoothly
                    elements.container.scrollIntoView({ behavior: 'smooth', block: 'nearest' });

                    // Focus on first article for keyboard users
                    const firstArticle = elements.grid.querySelector('.article-card h3 a');
                    if (firstArticle) {
                        setTimeout(() => firstArticle.focus(), 100);
                    }
                } else {
                    showError();
                }
            } catch (error) {
                console.error('Error loading articles:', error);
                showError();
            } finally {
                state.isLoading = false;
                hideLoading();
            }
        }, 100); // Small delay for smooth transition
    }

    /**
     * Render articles in the grid
     */
    function renderArticles(articles) {
        if (!articles || articles.length === 0) {
            elements.grid.innerHTML = '<p>Keng Artikelen fonnt.</p>';
            return;
        }

        const articlesHTML = articles.map(article => `
            <article class="article-card">
                <div class="article-card-header">
                    <span class="article-card-category">${escapeHtml(article.category)}</span>
                    <time datetime="${escapeHtml(article.date)}">${escapeHtml(article.dateFormatted)}</time>
                </div>
                <h3><a href="${escapeHtml(article.url)}">${escapeHtml(article.title)}</a></h3>
                <p>${escapeHtml(article.description)}</p>
                <a href="${escapeHtml(article.url)}" class="article-card-link">Méi liesen →</a>
            </article>
        `).join('');

        // Fade out
        elements.grid.style.opacity = '0';

        setTimeout(() => {
            elements.grid.innerHTML = articlesHTML;
            // Fade in
            elements.grid.style.opacity = '1';
        }, 150);
    }

    /**
     * Update pagination UI (buttons and info)
     */
    function updatePaginationUI() {
        const hasPrev = state.currentOffset > 0;
        const hasNext = (state.currentOffset + state.perPage) < state.totalArticles;

        // Update button states
        elements.prevButtons.forEach(btn => {
            btn.disabled = !hasPrev;
            btn.setAttribute('aria-disabled', !hasPrev);
        });

        elements.nextButtons.forEach(btn => {
            btn.disabled = !hasNext;
            btn.setAttribute('aria-disabled', !hasNext);
        });

        // Update pagination info
        if (elements.paginationCurrent) {
            const start = state.currentOffset + 1;
            const end = Math.min(state.currentOffset + state.perPage, state.totalArticles);
            elements.paginationCurrent.textContent = `${start}-${end}`;
        }

        if (elements.paginationTotal) {
            elements.paginationTotal.textContent = state.totalArticles;
        }
    }

    /**
     * Show loading indicator
     */
    function showLoading() {
        if (elements.loading) {
            elements.loading.setAttribute('aria-hidden', 'false');
            elements.loading.style.display = 'block';
        }
        if (elements.grid) {
            elements.grid.setAttribute('aria-busy', 'true');
        }
    }

    /**
     * Hide loading indicator
     */
    function hideLoading() {
        if (elements.loading) {
            elements.loading.setAttribute('aria-hidden', 'true');
            elements.loading.style.display = 'none';
        }
        if (elements.grid) {
            elements.grid.setAttribute('aria-busy', 'false');
        }
    }

    /**
     * Show error message
     */
    function showError() {
        elements.grid.innerHTML = `
            <div class="articles-error" role="alert">
                <p>Entschëllegt, et gouf e Feeler beim Luede vun den Artikelen. Probéiert w.e.g. nach eng Kéier.</p>
            </div>
        `;
    }

    /**
     * Announce page change to screen readers
     */
    function announcePageChange() {
        const start = state.currentOffset + 1;
        const end = Math.min(state.currentOffset + state.perPage, state.totalArticles);
        const message = `Artikelen ${start} bis ${end} vun ${state.totalArticles} gewise`;

        // Update the live region
        if (elements.paginationInfo) {
            const srOnly = elements.paginationInfo.querySelector('.visually-hidden');
            if (srOnly) {
                srOnly.textContent = message;
            }
        }
    }

    /**
     * Escape HTML to prevent XSS
     */
    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

})();
