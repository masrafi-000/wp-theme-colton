<?php
/**
 * Cart Page
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.9.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' ); ?>

<style>
/* Quantity input override — WooCommerce generates its own markup */
.woocommerce-cart-form .quantity input.qty {
    background: transparent;
    border: none;
    text-align: center;
    width: 3rem;
    font-size: 0.875rem;
    font-weight: 600;
    color: inherit;
    outline: none;
    -moz-appearance: textfield;
}
.woocommerce-cart-form .quantity input.qty::-webkit-outer-spin-button,
.woocommerce-cart-form .quantity input.qty::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
/* Make sure cart item thumbnails fill their wrapper */
.cart-item-thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 0.5rem;
}
/* Coupon notices */
.woocommerce-error,
.woocommerce-message,
.woocommerce-info {
    margin-bottom: 1rem;
}
</style>

<?php if ( WC()->cart->is_empty() ) : ?>
    <div class="py-20 px-4 max-w-4xl mx-auto animate-fade-in">
        <div class="relative bg-card/60 backdrop-blur-xl border border-border rounded-[40px] p-10 md:p-16 text-center shadow-2xl overflow-hidden group">
            <!-- Decorative Background Glow -->
            <div class="absolute -top-24 -right-24 w-64 h-64 bg-primary/5 rounded-full blur-3xl pointer-events-none transition-all duration-700 group-hover:bg-primary/10"></div>
            <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-primary/5 rounded-full blur-3xl pointer-events-none transition-all duration-700 group-hover:bg-primary/10"></div>

            <div class="relative z-10 space-y-10 animate-slide-up">
                <div class="w-28 h-28 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-8 ring-8 ring-primary/5 group-hover:scale-110 transition-transform duration-500">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-primary"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/></svg>
                </div>

                <div class="space-y-4">
                    <h1 class="text-4xl md:text-5xl font-display font-extrabold text-foreground tracking-tight">Your cart is empty</h1>
                    <p class="text-lg text-muted-foreground max-w-md mx-auto text-balance">
                        Looks like you haven't added anything to your cart yet. Explore our research products and find exactly what you need.
                    </p>
                </div>

                <div class="flex flex-wrap justify-center gap-4">
                    <a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>" class="inline-flex items-center justify-center gap-3 bg-primary text-primary-foreground px-10 py-5 rounded-2xl font-bold uppercase tracking-widest text-sm hover:bg-primary/90 hover:scale-[1.02] active:scale-[0.98] transition-all shadow-xl shadow-primary/20">
                        Explore Products
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                    </a>
                </div>

                <!-- Quick Shop Categories -->
                <div class="pt-12 border-t border-border">
                    <p class="text-[10px] uppercase tracking-[0.3em] font-bold text-muted-foreground mb-8">Quick Shop Categories</p>
                    <div class="flex flex-wrap justify-center gap-3">
                        <?php
                        $categories = get_terms( array('taxonomy' => 'product_cat', 'hide_empty' => false, 'number' => 5) );
                        if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) :
                            foreach ( $categories as $category ) : ?>
                                <a href="<?php echo esc_url( get_term_link( $category ) ); ?>" class="px-6 py-3 bg-secondary/50 hover:bg-primary hover:text-white border border-border rounded-full text-xs font-bold transition-all duration-300">
                                    <?php echo esc_html( $category->name ); ?>
                                </a>
                            <?php endforeach;
                        else :
                            $fallbacks = ['Muscle Growth', 'Fat Loss', 'Recovery', 'Anti-Aging', 'Cognitive'];
                            foreach ($fallbacks as $name) : ?>
                                <a href="<?php echo esc_url( home_url('/shop') ); ?>" class="px-6 py-3 bg-secondary/50 hover:bg-primary hover:text-white border border-border rounded-full text-xs font-bold transition-all duration-300">
                                    <?php echo esc_html( $name ); ?>
                                </a>
                            <?php endforeach;
                        endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php else : ?>
<div class="flex flex-col lg:flex-row gap-10 mt-10 px-0">

    <!-- ── Cart Items ─────────────────────────────────────── -->
    <div class="flex-grow min-w-0">
        <h1 class="text-3xl font-display font-bold text-foreground mb-1">Shopping Cart</h1>
        <p class="text-muted-foreground mb-8">
            <?php echo sprintf(
                _n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'woocommerce' ),
                WC()->cart->get_cart_contents_count()
            ); ?>
        </p>

        <form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
            <?php do_action( 'woocommerce_before_cart_table' ); ?>

            <div class="space-y-4">
                <?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) :
                    $_product      = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                    $product_id    = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
                    $product_name  = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );

                    if ( ! $_product || ! $_product->exists() || $cart_item['quantity'] <= 0 ) continue;
                    if ( ! apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) continue;

                    $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                    $is_hidden         = apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key );
                ?>
                <div class="bg-card border border-border rounded-2xl p-5 flex flex-col sm:flex-row items-start sm:items-center gap-5 transition-all hover:border-primary/40 hover:shadow-sm <?php echo esc_attr( $is_hidden ); ?>">

                    <!-- Thumbnail -->
                    <div class="cart-item-thumb w-20 h-20 bg-secondary/40 rounded-xl overflow-hidden flex-shrink-0">
                        <?php
                        $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image( 'thumbnail' ), $cart_item, $cart_item_key );
                        echo $product_permalink
                            ? sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail )
                            : $thumbnail;
                        ?>
                    </div>

                    <!-- Name + meta -->
                    <div class="flex-grow min-w-0">
                        <h3 class="font-semibold text-foreground text-base leading-snug">
                            <?php
                            echo $product_permalink
                                ? sprintf( '<a href="%s" class="hover:text-primary transition-colors">%s</a>', esc_url( $product_permalink ), esc_html( $_product->get_name() ) )
                                : esc_html( $product_name );
                            ?>
                        </h3>
                        <?php $item_data = wc_get_formatted_cart_item_data( $cart_item );
                        if ( $item_data ) : ?>
                            <div class="text-muted-foreground text-xs mt-1"><?php echo $item_data; ?></div>
                        <?php endif; ?>
                        <div class="text-primary font-bold text-sm mt-1">
                            <?php echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); ?>
                        </div>
                    </div>

                    <!-- Quantity -->
                    <div class="flex items-center border border-border rounded-xl overflow-hidden bg-secondary/30 flex-shrink-0">
                        <button type="button" class="qty-minus w-9 h-9 flex items-center justify-center text-muted-foreground hover:text-foreground hover:bg-secondary transition-colors text-lg font-bold" aria-label="Decrease quantity">−</button>
                        <?php
                        if ( $_product->is_sold_individually() ) {
                            echo '<span class="w-9 text-center text-sm font-semibold text-foreground">1</span>';
                            echo '<input type="hidden" name="cart[' . esc_attr( $cart_item_key ) . '][qty]" value="1">';
                        } else {
                            if ( function_exists( 'woocommerce_quantity_input' ) ) {
                                woocommerce_quantity_input(
                                    array(
                                        'input_name'   => "cart[{$cart_item_key}][qty]",
                                        'input_value'  => $cart_item['quantity'],
                                        'max_value'    => $_product->get_max_purchase_quantity(),
                                        'min_value'    => '0',
                                        'product_name' => $product_name,
                                        'classes'      => array( 'qty' ),
                                    ),
                                    $_product,
                                    true
                                );
                            } else {
                                // Fallback to standard input if function is missing for some reason
                                echo '<input type="number" name="cart[' . esc_attr( $cart_item_key ) . '][qty]" value="' . esc_attr( $cart_item['quantity'] ) . '" class="qty w-9 text-center bg-transparent border-none outline-none">';
                            }
                        }
                        ?>
                        <button type="button" class="qty-plus w-9 h-9 flex items-center justify-center text-muted-foreground hover:text-foreground hover:bg-secondary transition-colors text-lg font-bold" aria-label="Increase quantity">+</button>
                    </div>

                    <!-- Subtotal -->
                    <div class="text-right min-w-[90px] flex-shrink-0">
                        <span class="font-bold text-foreground text-sm">
                            <?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); ?>
                        </span>
                        <div class="mt-2">
                            <?php echo apply_filters(
                                'woocommerce_cart_item_remove_link',
                                sprintf(
                                    '<a href="%s" class="inline-flex items-center gap-1 text-xs text-muted-foreground hover:text-destructive transition-colors" aria-label="%s" data-product_id="%s" data-product_sku="%s">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
                                        Remove
                                    </a>',
                                    esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                                    esc_html__( 'Remove this item', 'woocommerce' ),
                                    esc_attr( $product_id ),
                                    esc_attr( $_product->get_sku() )
                                ),
                                $cart_item_key
                            ); ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <?php do_action( 'woocommerce_cart_contents' ); ?>

            <!-- Update Cart -->
            <div class="mt-6 flex justify-end">
                <button
                    type="submit"
                    name="update_cart"
                    value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"
                    id="update-cart-btn"
                    class="inline-flex items-center gap-2 bg-secondary hover:bg-secondary/70 text-foreground border border-border px-5 py-2.5 rounded-xl text-sm font-semibold transition-all opacity-50 cursor-not-allowed"
                    disabled
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 12a9 9 0 0 1 9-9 9.75 9.75 0 0 1 6.74 2.74L21 8"/><path d="M21 3v5h-5"/><path d="M21 12a9 9 0 0 1-9 9 9.75 9.75 0 0 1-6.74-2.74L3 16"/><path d="M8 16H3v5"/></svg>
                    <?php esc_html_e( 'Update Cart', 'woocommerce' ); ?>
                </button>
            </div>

            <?php do_action( 'woocommerce_after_cart_contents' ); ?>
            <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
        </form>
    </div>

    <!-- ── Order Summary ──────────────────────────────────── -->
    <div class="w-full lg:w-[380px] flex-shrink-0 cart-collaterals">
        <div class="bg-card border border-border rounded-2xl p-7 sticky top-28 cart_totals">

            <h2 class="text-lg font-bold text-foreground mb-6 tracking-wide uppercase">Order Summary</h2>

            <!-- Bulk Savings Progress -->
            <?php
            if ( function_exists( 'colton_research_get_cart_progress_data' ) ) :
                $progress_data = colton_research_get_cart_progress_data();
                if ( $progress_data ) :
                    $item_count   = $progress_data['item_count'];
                    $active_width = 0;
                    if ( $item_count >= 1 ) $active_width = 25;
                    if ( $item_count >= 5 ) $active_width = 50;
                    if ( $item_count >= 7 ) $active_width = 75;
                    if ( $item_count >= 9 ) $active_width = 100;
            ?>
            <div class="mb-7 p-4 bg-secondary/40 rounded-xl border border-border space-y-3">
                <div class="flex items-center justify-between">
                    <span class="text-[10px] font-bold uppercase tracking-widest text-muted-foreground">Bulk Savings</span>
                    <?php if ( $progress_data['bulk_savings']['current_discount'] > 0 ) : ?>
                        <span class="text-[10px] font-bold text-emerald-500"><?php echo esc_html( $progress_data['bulk_savings']['current_discount'] ); ?>% Applied</span>
                    <?php endif; ?>
                </div>
                <div class="h-2 w-full bg-border rounded-full overflow-hidden">
                    <div class="h-full bg-primary rounded-full transition-all duration-500" style="width: <?php echo esc_attr( $active_width ); ?>%;"></div>
                </div>
                <?php if ( $progress_data['bulk_savings']['next_milestone'] ) : ?>
                    <p class="text-[11px] text-center text-muted-foreground leading-relaxed">
                        Add <strong class="text-foreground"><?php echo esc_html( $progress_data['bulk_savings']['next_milestone']['qty'] - $item_count ); ?> more</strong>
                        for <strong class="text-foreground"><?php echo esc_html( $progress_data['bulk_savings']['next_milestone']['discount'] ); ?>% off</strong>
                    </p>
                <?php endif; ?>
            </div>
            <?php endif; endif; ?>

            <!-- Coupon -->
            <?php if ( wc_coupons_enabled() ) : ?>
            <div class="mb-7">
                <p class="text-xs font-semibold text-muted-foreground uppercase tracking-widest mb-2">Promo Code</p>
                <form class="checkout_coupon flex gap-2" method="post">
                    <input
                        type="text"
                        name="coupon_code"
                        id="coupon_code"
                        value=""
                        placeholder="<?php esc_attr_e( 'Enter code', 'woocommerce' ); ?>"
                        class="flex-1 min-w-0 bg-background border border-border rounded-xl px-4 py-2.5 text-sm text-foreground placeholder:text-muted-foreground focus:outline-none focus:border-primary/60 focus:ring-1 focus:ring-primary/20 transition-all"
                    />
                    <button
                        type="submit"
                        name="apply_coupon"
                        value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>"
                        class="bg-primary text-primary-foreground hover:bg-primary/90 active:scale-95 px-4 py-2.5 rounded-xl text-sm font-semibold transition-all flex-shrink-0"
                    >Apply</button>
                </form>
            </div>
            <?php endif; ?>

            <!-- Line items -->
            <div class="space-y-3 text-sm">

                <div class="flex justify-between items-center text-foreground">
                    <span class="text-muted-foreground">Subtotal</span>
                    <span class="font-medium"><?php wc_cart_totals_subtotal_html(); ?></span>
                </div>

                <?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
                <div class="flex justify-between items-center text-emerald-500">
                    <span class="flex items-center gap-1">
                        <?php wc_cart_totals_coupon_label( $coupon ); ?>
                    </span>
                    <span class="font-semibold">-<?php wc_cart_totals_coupon_html( $coupon ); ?></span>
                </div>
                <?php endforeach; ?>

                <?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>
                <div class="flex justify-between items-center text-foreground">
                    <span class="text-muted-foreground">Shipping</span>
                    <span class="font-medium">
                        <?php
                        $packages = WC()->shipping()->get_packages();
                        if ( ! empty( $packages ) ) {
                            $shipping_total = WC()->cart->get_shipping_total();
                            echo $shipping_total > 0 ? wc_price( $shipping_total ) : '<span class="text-emerald-500 font-semibold">Free</span>';
                        } else {
                            echo '<span class="text-muted-foreground text-xs">Calculated at checkout</span>';
                        }
                        ?>
                    </span>
                </div>
                <?php endif; ?>

                <?php if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) : ?>
                <div class="flex justify-between items-center text-foreground">
                    <span class="text-muted-foreground">Tax</span>
                    <span class="font-medium"><?php echo wc_price( WC()->cart->get_taxes_total() ); ?></span>
                </div>
                <?php endif; ?>

                <!-- Total -->
                <div class="pt-4 mt-1 border-t border-border flex justify-between items-baseline">
                    <span class="text-base font-bold text-foreground">Total</span>
                    <span class="text-2xl font-bold text-foreground"><?php wc_cart_totals_order_total_html(); ?></span>
                </div>
            </div>

            <!-- Free Shipping Progress -->
            <?php
            $free_threshold = apply_filters( 'mytheme_free_shipping_threshold', 200 );
            $cart_subtotal  = (float) WC()->cart->get_subtotal();
            ?>
            <div class="mt-5 mb-6 text-center">
                <?php if ( $cart_subtotal < $free_threshold ) : ?>
                    <p class="text-xs text-muted-foreground">
                        Add <strong class="text-foreground"><?php echo wc_price( $free_threshold - $cart_subtotal ); ?></strong> more for
                        <strong class="text-foreground">free shipping</strong>
                    </p>
                    <div class="mt-2 h-1.5 w-full bg-secondary rounded-full overflow-hidden">
                        <div class="h-full bg-emerald-500 rounded-full transition-all duration-500" style="width: <?php echo esc_attr( min( 100, round( ( $cart_subtotal / $free_threshold ) * 100 ) ) ); ?>%;"></div>
                    </div>
                <?php else : ?>
                    <p class="text-xs font-semibold text-emerald-500 flex items-center justify-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
                        You've unlocked free shipping!
                    </p>
                <?php endif; ?>
            </div>

            <!-- CTA buttons -->
            <div class="space-y-3">
                <a
                    href="<?php echo esc_url( wc_get_checkout_url() ); ?>"
                    class="flex items-center justify-center gap-2 w-full py-3.5 px-6 bg-primary text-primary-foreground hover:bg-primary/90 active:scale-[0.98] rounded-xl font-bold uppercase tracking-widest text-sm transition-all"
                >
                    Proceed to Checkout
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </a>

                <a
                    href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>"
                    class="flex items-center justify-center gap-2 w-full py-3 px-6 bg-secondary hover:bg-secondary/70 text-foreground border border-border rounded-xl font-semibold text-sm transition-all active:scale-[0.98]"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                    Continue Shopping
                </a>
            </div>

        </div><!-- /sticky card -->
    </div>

</div><!-- /flex wrapper -->

<?php do_action( 'woocommerce_after_cart' ); ?>

<script>
jQuery(function($){

    // ── Qty +/− buttons ──────────────────────────────────────────────────────
    $(document).on('click', '.qty-plus, .qty-minus', function(){
        var $btn   = $(this);
        var $input = $btn.closest('.flex').find('input.qty');
        if ( ! $input.length ) return;

        var current = parseInt( $input.val(), 10 ) || 0;
        var max     = parseInt( $input.attr('max'), 10 );
        var min     = parseInt( $input.attr('min'), 10 ) || 0;

        if ( $btn.hasClass('qty-plus') ) {
            if ( isNaN(max) || current < max ) $input.val( current + 1 ).trigger('change');
        } else {
            if ( current > min ) $input.val( current - 1 ).trigger('change');
        }
    });

    // ── Enable Update Cart when qty changes ──────────────────────────────────
    $(document).on('change', 'input.qty', function(){
        var $btn = $('#update-cart-btn');
        $btn.prop('disabled', false)
            .removeClass('opacity-50 cursor-not-allowed')
            .addClass('opacity-100 cursor-pointer hover:shadow-sm');
    });

    // ── Auto-submit on qty change ───────────────────────────────────────────
    $(document).on('change', 'input.qty', function(){
        $('[name="update_cart"]').prop('disabled', false).trigger('click');
    });

});
</script><?php endif; ?>
