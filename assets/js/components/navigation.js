(function($) {
    'use strict';

    /**
     * Mobile Menu and Sticky Header Logic
     */
    var initNavigation = function() {
        // Mobile Menu Toggle
        $(document).on('click', '#mobile-menu-toggle', function(e) {
            e.preventDefault();
            e.stopPropagation();
            var $menu = $('#mobile-menu');
            $menu.toggleClass('hidden');
            
            if (!$menu.hasClass('hidden')) {
                $menu.css({
                    'display': 'block',
                    'visibility': 'visible',
                    'opacity': '1',
                    'position': 'fixed',
                    'top': $('.sticky').outerHeight() + 'px',
                    'left': '0',
                    'width': '100%',
                    'height': 'calc(100vh - ' + $('.sticky').outerHeight() + 'px)',
                    'z-index': '9999'
                });
            }
        });

        // Search Toggle
        $(document).on('click', '#search-toggle', function(e) {
            e.preventDefault();
            e.stopPropagation();
            $('#search-dropdown').toggleClass('opacity-0 invisible translate-y-2');
            if (!$('#search-dropdown').hasClass('invisible')) {
                $('#search-input').focus();
            }
        });

        // Search AJAX Logic
        var searchTimeout;
        $(document).on('input', '#search-input', function() {
            var $input = $(this);
            var $results = $('#search-results');
            var query = $input.val().trim();

            clearTimeout(searchTimeout);

            if (query.length < 2) {
                $results.html('<div class="p-6 text-center text-muted-foreground text-xs">Start typing to search...</div>');
                return;
            }

            $results.html('<div class="p-6 text-center"><div class="inline-block h-6 w-6 animate-spin rounded-full border-2 border-primary border-t-transparent"></div></div>');

            searchTimeout = setTimeout(function() {
                $.ajax({
                    url: colton_ajax.ajax_url,
                    type: 'POST',
                    data: {
                        action: 'colton_search',
                        query: query
                    },
                    success: function(data) {
                        $results.html(data);
                    }
                });
            }, 500);
        });

        // Close everything when clicking outside
        $(document).on('click', function(e) {
            if (!$(e.target).closest('#mobile-menu, #mobile-menu-toggle').length) {
                $('#mobile-menu').addClass('hidden');
            }
            if (!$(e.target).closest('#search-dropdown, #search-toggle').length) {
                $('#search-dropdown').addClass('opacity-0 invisible translate-y-2');
            }
        });
    };

    $(document).ready(function() {
        initNavigation();
    });

})(jQuery);
