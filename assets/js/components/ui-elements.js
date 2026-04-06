(function($) {
    'use strict';

    /**
     * UI Components (Slider, FAQ, Tabs, Modals)
     */
    var initUIElements = function() {
        // Hero Review Slider
        var currentReview = 0;
        var $reviewItems = $('.review-item');
        var $reviewDots = $('.review-dot');

        var showReview = function(index) {
            $reviewItems.removeClass('active opacity-100 visible translate-y-0')
                      .addClass('opacity-0 invisible translate-y-[15px]');
            $reviewDots.removeClass('active scale-[1.3] bg-white')
                      .addClass('bg-white/30');
            
            $reviewItems.eq(index).addClass('active opacity-100 visible translate-y-0')
                               .removeClass('opacity-0 invisible translate-y-[15px]');
            $reviewDots.eq(index).addClass('active scale-[1.3] bg-white')
                             .removeClass('bg-white/30');
            currentReview = index;
        };

        $reviewDots.on('click', function() {
            showReview($(this).data('index'));
        });

        if ($reviewItems.length > 0) {
            setInterval(function() {
                var next = (currentReview + 1) % $reviewItems.length;
                showReview(next);
            }, 5000);
        }

        // FAQ Accordion
        $(document).on('click', '.faq-toggle', function() {
            var $item = $(this).closest('.faq-item');
            var $content = $item.find('.faq-content');
            var $icon = $item.find('.faq-icon');
            var $iconWrapper = $item.find('.faq-icon-wrapper');
            var isOpen = !$content.hasClass('hidden');

            // Close others
            $('.faq-content').not($content).addClass('hidden');
            $('.faq-icon').not($icon).removeClass('rotate-180 text-white').addClass('text-primary');
            $('.faq-icon-wrapper').not($iconWrapper).removeClass('bg-primary');

            if (!isOpen) {
                $content.removeClass('hidden');
                $icon.addClass('rotate-180 text-white').removeClass('text-primary');
                $iconWrapper.addClass('bg-primary');
            } else {
                $content.addClass('hidden');
                $icon.removeClass('rotate-180 text-white').addClass('text-primary');
                $iconWrapper.removeClass('bg-primary');
            }
        });

        // Floating Live Chat
        $(document).on('click', '#live-chat-toggle', function(e) {
            e.stopPropagation();
            $('#live-chat-panel').toggleClass('opacity-0 invisible translate-y-4');
        });

        $(document).on('click', function(e) {
            if (!$(e.target).closest('#live-chat-panel, #live-chat-toggle').length) {
                $('#live-chat-panel').addClass('opacity-0 invisible translate-y-4');
            }
        });

        // Intersection Observer for Animations (Converted to pure JS as it's cleaner, but wrapped in jQuery load)
        if ('IntersectionObserver' in window) {
            var observer = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        $(entry.target).addClass('is-visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.1 });

            $('.reveal-on-scroll').each(function() {
                observer.observe(this);
            });
        }
    };

    $(document).ready(function() {
        initUIElements();
    });

})(jQuery);
