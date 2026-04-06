<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.9.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' ); ?>

<div class="flex flex-col lg:flex-row gap-12 mt-12">
    <!-- Cart Items -->
    <div class="flex-grow">
        <h1 class="text-3xl font-display font-bold text-foreground mb-2">Shopping Cart</h1>
        <p class="text-muted-foreground mb-8"><?php echo sprintf( _n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'woocommerce' ), WC()->cart->get_cart_contents_count() ); ?></p>

        <form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
            <?php do_action( 'woocommerce_before_cart_table' ); ?>

            <div class="space-y-4">
                <?php
                foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                    $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                    $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
                    $product_name = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );

                    if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                        $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                        ?>
                        <div class="bg-card border border-border rounded-xl p-6 flex items-center gap-6 relative group transition-all hover:border-primary/30">
                            <!-- Thumbnail -->
                            <div class="w-24 h-24 bg-secondary/30 rounded-lg p-2 flex-shrink-0">
                                <?php
                                $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
                                if ( ! $product_permalink ) {
                                    echo $thumbnail; // PHPCS: XSS ok.
                                } else {
                                    printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
                                }
                                ?>
                            </div>

                            <!-- Details -->
                            <div class="flex-grow grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <h3 class="font-bold text-foreground text-lg">
                                        <?php
                                        if ( ! $product_permalink ) {
                                            echo wp_kses_post( $product_name );
                                        } else {
                                            echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
                                        }
                                        ?>
                                    </h3>
                                    <div class="text-muted-foreground text-sm mt-1">
                                        <?php echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok. ?>
                                    </div>
                                    <div class="text-primary font-bold mt-2">
                                        <?php echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok. ?>
                                    </div>
                                </div>

                                <div class="flex items-center md:justify-end gap-6">
                                    <!-- Quantity -->
                                    <div class="flex items-center bg-secondary/50 rounded-lg border border-border p-1">
                                        <?php
                                        if ( $_product->is_sold_individually() ) {
                                            $product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
                                        } else {
                                            $product_quantity = woocommerce_quantity_input(
                                                array(
                                                    'input_name'   => "cart[{$cart_item_key}][qty]",
                                                    'input_value'  => $cart_item['quantity'],
                                                    'max_value'    => $_product->get_max_purchase_quantity(),
                                                    'min_value'    => '0',
                                                    'product_name' => $product_name,
                                                ),
                                                $_product,
                                                false
                                            );
                                        }
                                        echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
                                        ?>
                                    </div>
                                    
                                    <!-- Remove -->
                                    <?php
                                    echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                        'woocommerce_cart_item_remove_link',
                                        sprintf(
                                            '<a href="%s" class="text-black hover:text-destructive transition-colors" aria-label="%s" data-product_id="%s" data-product_sku="%s"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg></a>',
                                            esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                                            esc_html__( 'Remove this item', 'woocommerce' ),
                                            esc_attr( $product_id ),
                                            esc_attr( $_product->get_sku() )
                                        ),
                                        $cart_item_key
                                    );
                                    ?>
                                </div>
                            </div>

                            <!-- Subtotal (Right aligned in design) -->
                            <div class="hidden md:block text-right min-w-[100px]">
                                <span class="font-bold text-foreground">
                                    <?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok. ?>
                                </span>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>

            <div class="mt-8 flex justify-between items-center">
                <button type="submit" class="button bg-secondary text-foreground hover:bg-secondary/80 px-6 py-3 rounded-lg font-bold transition-all opacity-0 pointer-events-none" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>
                <?php do_action( 'woocommerce_cart_contents' ); ?>
                <?php do_action( 'woocommerce_after_cart_contents' ); ?>
            </div>

            <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
        </form>
    </div>

    <!-- Order Summary -->
    <div class="w-full lg:w-96">
        <div class="bg-card border border-border rounded-xl p-8 sticky top-24">
            <h2 class="text-xl font-display font-bold text-black mb-6">Order Summary</h2>

            <!-- Bulk Savings Progress -->
            <?php 
            $progress_data = colton_research_get_cart_progress_data();
            if ( $progress_data ) : ?>
                <div class="mb-8 space-y-4">
                    <div class="flex items-center justify-between text-[10px] font-bold uppercase tracking-widest text-muted-foreground">
                        <span>Bulk Savings</span>
                        <?php if ( $progress_data['bulk_savings']['current_discount'] > 0 ) : ?>
                            <span class="text-green-500"><?php echo $progress_data['bulk_savings']['current_discount']; ?>% Applied</span>
                        <?php endif; ?>
                    </div>
                    <div class="h-1.5 w-full bg-secondary rounded-full overflow-hidden">
                        <?php
                        $active_width = 0;
                        $item_count = $progress_data['item_count'];
                        if ($item_count >= 1) $active_width = 25;
                        if ($item_count >= 5) $active_width = 50;
                        if ($item_count >= 7) $active_width = 75;
                        if ($item_count >= 9) $active_width = 100;
                        ?>
                        <div class="h-full bg-primary transition-all duration-500" style="width: <?php echo $active_width; ?>%;"></div>
                    </div>
                    <?php if ( $progress_data['bulk_savings']['next_milestone'] ) : ?>
                        <p class="text-[10px] text-center text-muted-foreground">Add <span class="text-foreground font-bold"><?php echo $progress_data['bulk_savings']['next_milestone']['qty'] - $item_count; ?> more</span> for <span class="text-foreground font-bold"><?php echo $progress_data['bulk_savings']['next_milestone']['discount']; ?>% off</span></p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <!-- Coupon -->
            <?php if ( wc_coupons_enabled() ) { ?>
                <form class="checkout_coupon mb-8" method="post">
                    <div class="flex gap-2">
                        <input type="text" name="coupon_code" class="bg-secondary/50 border border-border rounded-lg px-4 py-3 text-sm w-full text-black focus:outline-none focus:border-primary/50 transition-colors placeholder:text-gray-600" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Promo code', 'woocommerce' ); ?>" />
                        <button type="submit" class="bg-primary text-white hover:opacity-90 px-6 py-3 rounded-lg text-sm font-bold transition-all border-0" name="apply_coupon" value="<?php esc_attr_e( 'Apply', 'woocommerce' ); ?>"><?php esc_attr_e( 'Apply', 'woocommerce' ); ?></button>
                    </div>
                </form>
            <?php } ?>

            <!-- Totals -->
            <div class="space-y-4 text-sm mb-8">
                <div class="flex justify-between text-black">
                    <span>Subtotal</span>
                    <span><?php wc_cart_totals_subtotal_html(); ?></span>
                </div>
                <div class="flex justify-between text-black">
                    <span>Shipping</span>
                    <span><?php foreach ( WC()->cart->get_shipping_packages() as $i => $package ) {
                        $chosen_method = isset( WC()->session->chosen_shipping_methods[ $i ] ) ? WC()->session->chosen_shipping_methods[ $i ] : '';
                        // Simplified for design
                        echo wc_price( WC()->cart->get_shipping_total() );
                    } ?></span>
                </div>
                <div class="flex justify-between text-black">
                    <span>Tax (est.)</span>
                    <span><?php echo wc_price( WC()->cart->get_taxes_total() ); ?></span>
                </div>
                <div class="pt-4 border-t border-border flex justify-between items-baseline">
                    <span class="text-lg font-bold text-black">Total</span>
                    <span class="text-2xl font-display font-bold text-black"><?php wc_cart_totals_order_total_html(); ?></span>
                </div>
            </div>

            <!-- Free Shipping Progress -->
            <?php
            $free_shipping_threshold = 200; // Example threshold
            $current_total = WC()->cart->get_subtotal();
            if ( $current_total < $free_shipping_threshold ) {
                $remaining = $free_shipping_threshold - $current_total;
                echo '<p class="text-sm text-black font-medium mb-6 text-center">Add ' . wc_price( $remaining ) . ' more for free shipping!</p>';
            } else {
                echo '<p class="text-sm text-black font-medium mb-6 text-center">Free shipping</p>';
            }
            ?>

            <div class="space-y-4">
                <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="bg-brand-blue hover:bg-brand-blue-dark text-white w-full py-4 rounded-xl font-bold uppercase tracking-widest text-sm flex items-center justify-center gap-2 transition-all shadow-lg shadow-brand-blue/20">
                    SECURE CHECKOUT
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </a>
                <a href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ); ?>" class="block text-center text-black hover:text-primary text-sm transition-colors">
                    Continue Shopping
                </a>
            </div>
        </div>
    </div>
</div>

<?php do_action( 'woocommerce_after_cart' ); ?>
