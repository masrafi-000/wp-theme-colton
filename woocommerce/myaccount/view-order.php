<?php
/**
 * View Order
 *
 * Shows the details of a particular order on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/view-order.php.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.0.0
 */

defined( 'ABSPATH' ) || exit;

$notes = $order->get_customer_order_notes();
?>

<div class="space-y-12">
    <!-- Order Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 pb-8 border-b border-border">
        <div class="space-y-2">
            <h2 class="text-3xl font-display font-bold text-foreground">Order #<?php echo $order->get_order_number(); ?></h2>
            <p class="text-sm text-muted-foreground">
                Placed on <span class="font-bold text-foreground"><?php echo wc_format_datetime( $order->get_date_created() ); ?></span> 
                &bull; Status: 
                <?php
                $status_name = wc_get_order_status_name( $order->get_status() );
                $status_class = '';
                switch($order->get_status()) {
                    case 'completed': $status_class = 'text-green-600 bg-green-50'; break;
                    case 'processing': $status_class = 'text-blue-600 bg-blue-50'; break;
                    case 'on-hold': $status_class = 'text-yellow-600 bg-yellow-50'; break;
                    default: $status_class = 'text-gray-600 bg-gray-50';
                }
                ?>
                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider <?php echo $status_class; ?>">
                    <?php echo esc_html( $status_name ); ?>
                </span>
            </p>
        </div>
        
        <div class="flex items-center gap-3">
            <?php if ( $notes ) : ?>
                <button class="flex items-center gap-2 px-5 py-2.5 bg-secondary/50 rounded-xl text-xs font-bold uppercase tracking-widest hover:bg-secondary transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                    Notes (<?php echo count($notes); ?>)
                </button>
            <?php endif; ?>
            
            <!-- Placeholder for Invoice (Common Plugin Hook) -->
            <?php do_action( 'woocommerce_view_order_actions', $order ); ?>
        </div>
    </div>

    <!-- Order Items -->
    <div class="space-y-6">
        <h3 class="text-lg font-bold text-foreground uppercase tracking-widest">Order Items</h3>
        <div class="overflow-x-auto">
            <table class="woocommerce-table woocommerce-table--order-details shop_table order_details w-full">
                <thead>
                    <tr class="border-b border-border">
                        <th class="woocommerce-table__product-name product-name text-left py-4 px-2 text-[11px] font-bold uppercase tracking-widest text-muted-foreground"><?php esc_html_e( 'Product', 'woocommerce' ); ?></th>
                        <th class="woocommerce-table__product-total product-total text-right py-4 px-2 text-[11px] font-bold uppercase tracking-widest text-muted-foreground"><?php esc_html_e( 'Total', 'woocommerce' ); ?></th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-border/50">
                    <?php
                    do_action( 'woocommerce_order_details_before_order_table_items', $order );

                    foreach ( $order->get_items() as $item_id => $item ) {
                        $product = $item->get_product();

                        wc_get_template(
                            'order/order-details-item.php',
                            array(
                                'order'              => $order,
                                'item_id'            => $item_id,
                                'item'               => $item,
                                'show_purchase_note' => $show_purchase_note,
                                'purchase_note'      => $product ? $product->get_purchase_note() : '',
                                'product'            => $product,
                            )
                        );
                    }

                    do_action( 'woocommerce_order_details_after_order_table_items', $order );
                    ?>
                </tbody>

                <tfoot>
                    <?php
                    foreach ( $order->get_order_item_totals() as $key => $total ) {
                        $is_total = ($key === 'order_total');
                        ?>
                        <tr class="border-t border-border/50">
                            <th scope="row" class="text-left py-4 px-2 text-sm <?php echo $is_total ? 'font-bold text-foreground' : 'font-medium text-muted-foreground'; ?>"><?php echo esc_html( $total['label'] ); ?></th>
                            <td class="text-right py-4 px-2 text-sm <?php echo $is_total ? 'text-lg font-bold text-brand-blue' : 'font-bold text-foreground'; ?>"><?php echo ( 'payment_method' === $key ) ? esc_html( $total['value'] ) : wp_kses_post( $total['value'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tfoot>
            </table>
        </div>
    </div>

    <!-- Customer Details Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 pt-8 border-t border-border">
        <!-- Shipping Details -->
        <div class="space-y-6 bg-secondary/20 p-8 rounded-2xl border border-border/50">
            <div class="flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-brand-blue"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                <h3 class="text-sm font-bold text-foreground uppercase tracking-widest">Shipping Address</h3>
            </div>
            <address class="text-sm text-muted-foreground not-italic leading-relaxed">
                <?php echo wp_kses_post( $order->get_formatted_shipping_address( __( 'N/A', 'woocommerce' ) ) ); ?>
                <?php if ( $order->get_shipping_phone() ) : ?>
                    <p class="mt-4 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                        <?php echo esc_html( $order->get_shipping_phone() ); ?>
                    </p>
                <?php endif; ?>
            </address>
        </div>

        <!-- Billing & Payment Details -->
        <div class="space-y-6 bg-secondary/20 p-8 rounded-2xl border border-border/50">
            <div class="flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-brand-blue"><rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" x2="22" y1="10" y2="10"/></svg>
                <h3 class="text-sm font-bold text-foreground uppercase tracking-widest">Billing & Payment</h3>
            </div>
            <address class="text-sm text-muted-foreground not-italic leading-relaxed">
                <?php echo wp_kses_post( $order->get_formatted_billing_address( __( 'N/A', 'woocommerce' ) ) ); ?>
                <p class="mt-4 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                    <?php echo esc_html( $order->get_billing_email() ); ?>
                </p>
                <?php if ( $order->get_billing_phone() ) : ?>
                    <p class="mt-1 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                        <?php echo esc_html( $order->get_billing_phone() ); ?>
                    </p>
                <?php endif; ?>
            </address>
        </div>
    </div>

    <!-- Tracking Section Placeholder -->
    <?php if ( $order->get_status() === 'completed' || $order->get_status() === 'processing' ) : ?>
        <div class="bg-brand-blue/5 border border-brand-blue/10 p-8 rounded-2xl space-y-4">
            <div class="flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-brand-blue"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>
                <h3 class="text-sm font-bold text-foreground uppercase tracking-widest">Shipment Tracking</h3>
            </div>
            <p class="text-sm text-muted-foreground leading-relaxed">
                Your order is currently being processed. Once shipped, you will receive a tracking number via email.
                <?php 
                // Placeholder for actual tracking info if available via plugin
                do_action( 'woocommerce_view_order_tracking_details', $order ); 
                ?>
            </p>
        </div>
    <?php endif; ?>

    <?php do_action( 'woocommerce_view_order', $order_id ); ?>
</div>
