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

        // Size Selection Swatches (from woocommerce-logic.php)
        $(document).on('click', '.size-swatch-btn', function() {
            const btn = $(this);
            $('.size-swatch-btn').removeClass('active-swatch');
            btn.addClass('active-swatch');
            $('#selected-product-size').val(btn.data('size'));
            
            const priceElement = $('.summary .price');
            if (priceElement.length) {
                priceElement.html(btn.data('formatted-price'));
            }
        });
    };

    $(document).ready(function() {
        initCartLogic();
    });

    // Re-run when WooCommerce fragments update
    $(document).on('updated_wc_div updated_cart_totals updated_checkout updated_shipping_method', function() {
        initCartLogic();
    });

})(jQuery);
