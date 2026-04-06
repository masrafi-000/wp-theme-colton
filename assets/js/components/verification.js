(function($) {
    'use strict';

    /**
     * Verification Flow (Age Gate, Discount Popup, Newsletter)
     */
    var initVerification = function() {
        var $ageModal = $('#age-verification-modal');
        var $discountPopup = $('#first-visit-popup');
        var $newsletterForm = $('#newsletter-form');
        var $popupNewsletterForm = $('#popup-newsletter-form');

        // Age Verification Logic
        window.verifyAge = function(isOver21) {
            if (isOver21) {
                localStorage.setItem('colton_age_verified', 'true');
                if ($ageModal.length) {
                    $ageModal.addClass('hidden').removeClass('flex');
                    $('body').removeClass('overflow-hidden');
                }
                // Show discount popup after verification
                setTimeout(showDiscountPopup, 500);
            } else {
                window.location.href = "https://www.google.com";
            }
        };

        const showDiscountPopup = () => {
            if ($discountPopup.length) {
                $discountPopup.removeClass('hidden').addClass('flex');
                $('body').addClass('overflow-hidden');
            }
        };

        const closeDiscountPopup = () => {
            if ($discountPopup.length) {
                $discountPopup.addClass('hidden').removeClass('flex');
                $('body').removeClass('overflow-hidden');
            }
        };

        // Close discount popup on button click or overlay click
        $(document).on('click', '#close-popup', closeDiscountPopup);
        $(document).on('click', '#first-visit-popup', function(e) {
            if (e.target === this) closeDiscountPopup();
        });

        // Initialize verification flow
        if (!localStorage.getItem('colton_age_verified')) {
            setTimeout(function() {
                if ($ageModal.length) {
                    $ageModal.removeClass('hidden').addClass('flex');
                    $('body').addClass('overflow-hidden');
                }
            }, 1500);
        } else {
            setTimeout(showDiscountPopup, 3000);
        }

        // Newsletter Form AJAX (Main)
        $(document).on('submit', '#newsletter-form', function(e) {
            e.preventDefault();
            var $form = $(this);
            var $feedback = $('#newsletter-feedback');
            var $submitBtn = $form.find('button[type="submit"]');

            $feedback.text('Processing...').removeClass('text-green-500 text-red-500').addClass('text-muted-foreground');

            var formData = new FormData(this);
            formData.append('action', 'colton_newsletter_signup');

            fetch(colton_ajax.ajax_url, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    $feedback.text(data.data).addClass('text-green-500').removeClass('text-muted-foreground');
                    $form[0].reset();
                } else {
                    $feedback.text(data.data).addClass('text-red-500').removeClass('text-muted-foreground');
                }
            })
            .catch(error => {
                $feedback.text('An unexpected error occurred.').addClass('text-red-500').removeClass('text-muted-foreground');
            });
        });

        // Popup Newsletter Form
        $(document).on('submit', '#popup-newsletter-form', function(e) {
            e.preventDefault();
            var $submitBtn = $(this).find('button');
            $submitBtn.text('THANK YOU!').addClass('bg-green-500 text-white').removeClass('bg-white text-primary');
            setTimeout(closeDiscountPopup, 1500);
        });
    };

    $(document).ready(function() {
        initVerification();
    });

})(jQuery);
