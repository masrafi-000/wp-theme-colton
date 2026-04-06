<?php
/**
 * Review order table
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.2.0
 */

defined( 'ABSPATH' ) || exit;
?>

<div class="shop_table woocommerce-checkout-review-order-table space-y-8">
    <!-- Item List -->
    <div class="space-y-6 pb-8 border-b border-border">
        <?php
        do_action( 'woocommerce_review_order_before_cart_contents' );

        foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
            $_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

            if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                ?>
                <div class="flex items-center gap-5">
                    <div class="w-16 h-16 bg-white border border-border rounded-xl p-2 flex-shrink-0 shadow-sm">
                        <?php echo apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key ); ?>
                    </div>
                    <div class="flex-grow flex justify-between gap-4">
                        <div class="space-y-1">
                            <p class="text-sm font-bold text-foreground">
                                <?php echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) ); ?>
                                <span class="text-muted-foreground font-medium ml-1">× <?php echo $cart_item['quantity']; ?></span>
                            </p>
                        </div>
                        <span class="text-sm font-bold text-foreground shrink-0">
                            <?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); ?>
                        </span>
                    </div>
                </div>
                <?php
            }
        }

        do_action( 'woocommerce_review_order_after_cart_contents' );
        ?>
    </div>

    <!-- Totals -->
    <div class="space-y-5">
        <!-- Subtotal -->
        <div class="flex justify-between items-center text-sm font-medium text-foreground">
            <span class="text-muted-foreground">Subtotal</span>
            <span class="font-bold"><?php wc_cart_totals_subtotal_html(); ?></span>
        </div>

        <!-- Coupons/Discounts -->
        <?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
            <div class="flex justify-between items-center text-sm font-medium cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
                <span class="text-muted-foreground"><?php wc_cart_totals_coupon_label( $coupon ); ?></span>
                <span class="flex items-center gap-2 text-foreground font-bold">
                    -<?php wc_cart_totals_coupon_html( $coupon ); ?>
                    <a href="<?php echo esc_url( add_query_arg( 'remove_coupon', urlencode( $code ), wc_get_checkout_url() ) ); ?>" class="text-[10px] uppercase tracking-wider text-muted-foreground hover:text-red-500 transition-colors ml-1">[Remove]</a>
                </span>
            </div>
        <?php endforeach; ?>

        <!-- Shipping -->
        <?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>
            <div class="flex justify-between items-start text-sm font-medium">
                <span class="text-muted-foreground pt-1">Shipment</span>
                <div class="text-right space-y-2">
                    <?php wc_cart_totals_shipping_html(); ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- Fees -->
        <?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
            <div class="flex justify-between items-center text-sm font-medium">
                <span class="text-muted-foreground"><?php echo esc_html( $fee->name ); ?></span>
                <span class="text-foreground font-bold"><?php wc_cart_totals_fee_html( $fee ); ?></span>
            </div>
        <?php endforeach; ?>

        <!-- Tax -->
        <?php if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) : ?>
            <?php if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) : ?>
                <?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : ?>
                    <div class="flex justify-between items-center text-sm font-medium">
                        <span class="text-muted-foreground"><?php echo esc_html( $tax->label ); ?></span>
                        <span class="text-foreground font-bold"><?php echo wp_kses_post( $tax->formatted_amount ); ?></span>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <div class="flex justify-between items-center text-sm font-medium">
                    <span class="text-muted-foreground"><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></span>
                    <span class="text-foreground font-bold"><?php wc_cart_totals_taxes_total_html(); ?></span>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <!-- Total -->
        <div class="flex justify-between items-center pt-8 border-t border-border mt-8">
            <span class="text-lg font-bold text-foreground">Total</span>
            <span class="text-2xl font-display font-bold text-foreground"><?php wc_cart_totals_order_total_html(); ?></span>
        </div>
    </div>
</div>
