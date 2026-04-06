(function($) {
    'use strict';

    /**
     * Cart and AJAX Quantity Updates
     */
    var initCartLogic = function() {
        // Cart Drawer Toggle
        $(document).on('click', '#cart-toggle', function(e) {
            e.preventDefault();
            e.stopPropagation();
            $('#cart-drawer').removeClass('translate-x-full');
            $('#cart-drawer-overlay').removeClass('opacity-0 invisible');
            $('body').addClass('overflow-hidden');
        });

        $(document).on('click', '#cart-close, #cart-drawer-overlay', function(e) {
            $('#cart-drawer').addClass('translate-x-full');
            $('#cart-drawer-overlay').addClass('opacity-0 invisible');
            $('body').removeClass('overflow-hidden');
        });

        // Mini Cart Quantity Buttons
        $(document).on('click', '.plus-qty, .minus-qty', function(e) {
            e.preventDefault();
            var $btn = $(this);
            var $item = $btn.closest('.flex.gap-5');
            var $qty = $item.find('span.text-xs.font-bold');
            var cart_item_key = $item.find('a[data-cart_item_key]').data('cart_item_key');
            var current_qty = parseInt($qty.text());
            var new_qty = $btn.hasClass('plus-qty') ? current_qty + 1 : current_qty - 1;

            if (new_qty < 1) return;

            $qty.text(new_qty);
            
            $.ajax({
                url: colton_ajax.ajax_url,
                type: 'POST',
                data: {
                    action: 'colton_update_cart_qty',
                    cart_item_key: cart_item_key,
                    qty: new_qty
                },
                success: function(response) {
                    // Trigger WooCommerce fragment refresh
                    $(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash]);
                }
            });
        });


        // Size Selection Swatches (for simple products)
        // The hidden input #selected-product-size is inside form.cart (via woocommerce_before_add_to_cart_button hook)
        $(document).on('click', '.size-swatch-btn', function(e) {
            e.preventDefault();
            var $btn = $(this);
            var size  = $btn.data('size');
            var price = $btn.data('formatted-price');

            // 1. Manage active state on all swatch buttons
            $('.size-swatch-btn').removeClass('active-swatch');
            $btn.addClass('active-swatch');

            // 2. Update the hidden input (it should be inside form.cart due to the hook)
            var $hiddenInput = $('#selected-product-size');

            // Self-healing: if somehow outside the form, move it in
            if ($hiddenInput.length && !$hiddenInput.closest('form.cart').length) {
                var $form = $('form.cart');
                if ($form.length) {
                    $hiddenInput.appendTo($form);
                }
            }
            $hiddenInput.val(size);

            // 3. Update the displayed price in the summary
            var $priceEl = $('.summary .price').first();
            if ($priceEl.length && price) {
                $priceEl.html(price);
            }

            // 4. Update the "Selected: Xmg" label
            var $selectedText = $('#size-selected-text');
            if ($selectedText.length) {
                $selectedText.text(size);
            }
        });

        // On page load: if no swatch is active, activate the first one
        if ($('.size-swatch-btn').length && !$('.size-swatch-btn.active-swatch').length) {
            $('.size-swatch-btn').first().trigger('click');
        }
    };

    $(document).ready(function() {
        initCartLogic();
    });

    // Re-run when WooCommerce fragments update
    $(document).on('updated_wc_div updated_cart_totals updated_checkout updated_shipping_method', function() {
        initCartLogic();
    });

})(jQuery);
