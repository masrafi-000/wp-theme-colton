jQuery(function ($) {

    // ── Helpers ──────────────────────────────────────────────────────────────

    function openOverlay() {
        $('#site-overlay').removeClass('hidden').css('opacity', 0);
        requestAnimationFrame(function () {
            $('#site-overlay').css({ opacity: 1, transition: 'opacity 0.3s ease' });
        });
        $('body').addClass('overflow-hidden');
    }

    function closeOverlay() {
        $('#site-overlay').css({ opacity: 0, transition: 'opacity 0.3s ease' });
        setTimeout(function () {
            $('#site-overlay').addClass('hidden');
        }, 300);
        $('body').removeClass('overflow-hidden');
    }

    // ── Mobile Menu Sidebar ──────────────────────────────────────────────────

    function openMenu() {
        closeSidebar();
        closeSearch();
        $('#mobile-menu').removeClass('-translate-x-full').addClass('translate-x-0');
        $('#hamburger-icon').addClass('hidden');
        $('#close-icon').removeClass('hidden');
        $('#mobile-menu-toggle').attr('aria-expanded', 'true');
        openOverlay();
    }

    function closeMenu() {
        $('#mobile-menu').removeClass('translate-x-0').addClass('-translate-x-full');
        $('#hamburger-icon').removeClass('hidden');
        $('#close-icon').addClass('hidden');
        $('#mobile-menu-toggle').attr('aria-expanded', 'false');
        closeOverlay();
    }

    $('#mobile-menu-toggle').on('click', function (e) {
        e.stopPropagation();
        var isOpen = $('#mobile-menu').hasClass('translate-x-0');
        isOpen ? closeMenu() : openMenu();
    });

    $('#mobile-menu-sidebar-close').on('click', closeMenu);

    // ── Cart Sidebar ─────────────────────────────────────────────────────────

    function openSidebar() {
        closeMenu();
        closeSearch();
        $('#cart-sidebar').removeClass('translate-x-full').addClass('translate-x-0');
        openOverlay();
    }

    function closeSidebar() {
        $('#cart-sidebar').removeClass('translate-x-0').addClass('translate-x-full');
        closeOverlay();
    }

    $('#cart-toggle').on('click', function (e) {
        e.stopPropagation();
        var isOpen = $('#cart-sidebar').hasClass('translate-x-0');
        isOpen ? closeSidebar() : openSidebar();
    });

    $('#cart-sidebar-close').on('click', closeSidebar);

    // ── Search Dropdown ───────────────────────────────────────────────────────

    function openSearch() {
        closeSidebar();
        closeMenu();
        $('#search-dropdown')
            .removeClass('opacity-0 invisible translate-y-2')
            .addClass('opacity-100 visible translate-y-0');
        $('#search-input').trigger('focus');
    }

    function closeSearch() {
        $('#search-dropdown')
            .addClass('opacity-0 invisible translate-y-4 md:translate-y-2')
            .removeClass('opacity-100 visible translate-y-0');
    }

    $('#search-toggle').on('click', function (e) {
        e.stopPropagation();
        var isOpen = !$('#search-dropdown').hasClass('invisible');
        isOpen ? closeSearch() : openSearch();
    });

    $('#search-close-button').on('click', closeSearch);

    // Live search (WooCommerce AJAX)
    var searchTimer;
    $('#search-input').on('input', function () {
        clearTimeout(searchTimer);
        var query = $(this).val().trim();

        if (query.length < 2) {
            $('#search-results').html('<div class="p-6 text-center text-muted-foreground text-xs">Start typing to search…</div>');
            return;
        }

        $('#search-results').html('<div class="p-6 text-center text-muted-foreground text-xs animate-pulse">Searching…</div>');

        searchTimer = setTimeout(function () {
            $.ajax({
                url: theme_ajax ? theme_ajax.ajax_url : (typeof ajaxurl !== 'undefined' ? ajaxurl : '/wp-admin/admin-ajax.php'),
                type: 'GET',
                data: { 
                    action: 'woocommerce_search_products', 
                    term: query, 
                    nonce: (typeof theme_ajax !== 'undefined' ? theme_ajax.nonce : '') 
                },
                success: function (res) {
                    if (!res.success || !res.data || !res.data.length) {
                        $('#search-results').html('<div class="p-6 text-center text-muted-foreground text-xs">No results found.</div>');
                        return;
                    }
                    var html = '';
                    $.each(res.data, function (i, item) {
                        html += '<a href="' + item.url + '" class="flex items-center gap-3 px-4 py-3 hover:bg-secondary transition-colors border-b border-border last:border-0">';
                        if (item.image) {
                            html += '<img src="' + item.image + '" class="w-10 h-10 object-cover rounded-lg shrink-0" alt="">';
                        }
                        html += '<div class="min-w-0"><p class="text-sm font-medium truncate">' + item.name + '</p>';
                        html += '<p class="text-xs text-muted-foreground">' + item.price + '</p></div></a>';
                    });
                    $('#search-results').html(html);
                },
                error: function () {
                    $('#search-results').html('<div class="p-6 text-center text-muted-foreground text-xs">Search unavailable.</div>');
                }
            });
        }, 350);
    });

    // ── Close on outside click / overlay click ────────────────────────────────

    $('#site-overlay').on('click', function () {
        closeSidebar();
        closeMenu();
        closeSearch();
        closeOverlay();
    });

    $(document).on('keydown', function (e) {
        if (e.key === 'Escape') {
            closeSidebar();
            closeMenu();
            closeSearch();
            closeOverlay();
        }
    });

    $(document).on('click', function (e) {
        if (!$(e.target).closest('#header-search').length) closeSearch();
    });

    // ── WooCommerce cart fragment updates ────────────────────────────────────

    $(document.body).on('wc_fragments_refreshed added_to_cart', function () {
        if (typeof wc_cart_fragments_params !== 'undefined') {
            var fragments = $.parseJSON(sessionStorage.getItem(wc_cart_fragments_params.fragment_name));
            if (fragments && fragments['#cart-sidebar-body']) {
                $('#cart-sidebar-body').html(fragments['#cart-sidebar-body']);
            }
        }
        // Refresh count badge
        $.ajax({
            url: (typeof ajaxurl !== 'undefined' ? ajaxurl : '/wp-admin/admin-ajax.php'),
            type: 'POST',
            data: { action: 'get_cart_count' },
            success: function (res) {
                if (res.count !== undefined) {
                    if (res.count > 0) {
                        $('#cart-count-badge').text(res.count).removeClass('hidden');
                    } else {
                        $('#cart-count-badge').addClass('hidden');
                    }
                }
            }
        });

        openSidebar();
    });

});
