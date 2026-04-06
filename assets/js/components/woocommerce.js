(function($) {
    'use strict';

    /**
     * WooCommerce Specific UI Enhancements
     */
    var initWooCommerceUI = function() {
        // Convert variation selects to buttons
        function initVariationButtons() {
            $('.variations_form').each(function() {
                var $form = $(this);
                $form.find('.variations select').each(function() {
                    var $select = $(this);
                    
                    // Skip if already initialized
                    if ($select.next('.variation-buttons-container').length) return;
                    
                    var $container = $('<div class="variation-buttons-container flex flex-wrap gap-4 mt-2 mb-6"></div>');
                    
                    $select.find('option').each(function() {
                        var $option = $(this);
                        if (!$option.val()) return;
                        
                        var $btn = $('<button type="button" class="variation-btn min-w-[100px] px-6 py-4 rounded-[20px] border border-border bg-white text-black font-bold text-lg transition-all hover:border-primary"></button>');
                        $btn.text($option.text());
                        $btn.attr('data-value', $option.val());
                        
                        if ($select.val() === $option.val()) {
                            $btn.addClass('active-swatch');
                        }
                        
                        $btn.on('click', function(e) {
                            e.preventDefault();
                            $select.val($(this).data('value')).trigger('change');
                            $container.find('.variation-btn').removeClass('active-swatch');
                            $(this).addClass('active-swatch');
                        });
                        
                        $container.append($btn);
                    });
                    
                    $select.hide();
                    var $label = $select.closest('tr').find('.label label');
                    if ($label.length) {
                        $label.addClass('block text-xl font-bold text-black mb-4').css('font-family', "'Outfit', sans-serif");
                    }
                    
                    $select.after($container);
                });
            });
        }

        // Enhanced Quantity Input (+/- buttons)
        function enhanceQuantityInputs() {
            $('div.quantity:not(.enhanced)').each(function() {
                var $qty = $(this);
                $qty.addClass('enhanced flex items-center border border-border rounded-lg overflow-hidden bg-white w-fit');
                
                var $input = $qty.find('input');
                $input.addClass('w-12 h-10 text-center border-none bg-transparent focus:ring-0 text-black font-bold');
                
                var $minusBtn = $('<button type="button" class="w-10 h-10 flex items-center justify-center text-black hover:text-primary transition-colors border-r border-border bg-secondary/30"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/></svg></button>');
                var $plusBtn = $('<button type="button" class="w-10 h-10 flex items-center justify-center text-black hover:text-primary transition-colors border-l border-border bg-secondary/30"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg></button>');
                
                $qty.prepend($minusBtn);
                $qty.append($plusBtn);
                
                $minusBtn.on('click', function() {
                    var val = parseInt($input.val());
                    if (val > 1) {
                        $input.val(val - 1).trigger('change');
                    }
                });
                
                $plusBtn.on('click', function() {
                    var val = parseInt($input.val());
                    $input.val(val + 1).trigger('change');
                });
            });
        }

        // Clear active state if WooCommerce resets the form
        $(document).on('reset_data', '.variations_form', function() {
            $('.variation-btn').removeClass('active-swatch');
        });

        // Back in Stock Notification
        $(document).on('submit', '#back-in-stock-form', function(e) {
            e.preventDefault();
            var $form = $(this);
            var $feedback = $('#back-in-stock-feedback');
            
            $feedback.text('Registering your interest...').removeClass('text-green-500 font-medium').addClass('text-muted-foreground');
            
            setTimeout(function() {
                $feedback.text('Success! We will notify you when this product is back in stock.').addClass('text-green-500 font-medium').removeClass('text-muted-foreground');
                $form[0].reset();
            }, 1000);
        });

        // Toast Notifications Handler
        function initToasts() {
            var $container = $('#toast-container');
            if (!$container.length) return;

            // Function to show a toast
            window.showToast = function(message, type) {
                type = type || 'success';
                var id = 'toast-' + Date.now();
                
                // Extract View Cart link if present and create a custom button for it
                var $temp = $('<div>' + message + '</div>');
                var $viewCartBtn = $temp.find('a.wc-forward');
                var viewCartHtml = '';
                
                if ($viewCartBtn.length) {
                    viewCartHtml = '<a href="' + $viewCartBtn.attr('href') + '" class="toast-view-cart">View Cart</a>';
                    $viewCartBtn.remove();
                    message = $temp.html();
                }

                var toastHtml = `
                    <div id="${id}" class="toast-notification toast-${type}">
                        <div class="toast-content">${message}</div>
                        <div class="toast-actions">
                            ${viewCartHtml}
                            <button class="toast-close">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                            </button>
                        </div>
                    </div>
                `;

                var $toast = $(toastHtml);
                $container.append($toast);

                // Auto-dismiss after 5 seconds
                var dismissTimeout = setTimeout(function() {
                    dismissToast($toast);
                }, 5000);

                // Close button handler
                $toast.find('.toast-close').on('click', function() {
                    clearTimeout(dismissTimeout);
                    dismissToast($toast);
                });
            };

            function dismissToast($toast) {
                $toast.addClass('toast-exit');
                setTimeout(function() {
                    $toast.remove();
                }, 400);
            }

            // 1. Capture notices on page load
            $('.woocommerce-message, .woocommerce-info, .woocommerce-error').each(function() {
                var $notice = $(this);
                var type = 'info';
                if ($notice.hasClass('woocommerce-message')) type = 'success';
                if ($notice.hasClass('woocommerce-error')) type = 'error';
                
                showToast($notice.html(), type);
                $notice.remove(); // Hide original notice
            });

            // 2. Capture AJAX Added to Cart
            $(document.body).on('added_to_cart', function(event, fragments, cart_hash, $button) {
                // WooCommerce usually updates fragments, but we want to show a toast
                // If the button has a data-product_title, we can build a nice message
                var productTitle = $button.data('product_title') || 'Product';
                var message = '“' + productTitle + '” has been added to your cart.';
                var viewCartUrl = wc_add_to_cart_params ? wc_add_to_cart_params.cart_url : '/cart';
                
                showToast(message + ' <a href="' + viewCartUrl + '" class="button wc-forward">View Cart</a>', 'success');
            });
        }

        // Initialize
        initVariationButtons();
        enhanceQuantityInputs();
        initToasts();

        // Re-run when WooCommerce updates
        $(document).on('updated_variation_data updated_wc_div', function() {
            initVariationButtons();
            enhanceQuantityInputs();
            // Don't re-init toasts here to avoid duplicates
        });
    };

    $(document).ready(function() {
        initWooCommerceUI();
    });

})(jQuery);
