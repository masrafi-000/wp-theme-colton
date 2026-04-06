<?php
/**
 * Orders
 *
 * Shows orders on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/orders.php.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.8.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_account_orders', $has_orders ); ?>

<div class="space-y-8">
    <div class="flex items-center justify-between">
        <h2 class="text-2xl font-display font-bold text-foreground"><?php esc_html_e( 'Recent Orders', 'woocommerce' ); ?></h2>
    </div>

    <?php if ( $has_orders ) : ?>

        <div class="overflow-x-auto">
            <table class="woocommerce-orders-table woocommerce-MyAccount-orders shop_table shop_table_responsive my_account_orders account-orders-table w-full">
                <thead>
                    <tr class="border-b border-border">
                        <?php foreach ( wc_get_account_orders_columns() as $column_id => $column_name ) : ?>
                            <th class="woocommerce-orders-table__header woocommerce-orders-table__header-<?php echo esc_attr( $column_id ); ?> text-left py-4 px-2 text-[11px] font-bold uppercase tracking-widest text-muted-foreground"><span class="nobr"><?php echo esc_html( $column_name ); ?></span></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>

                <tbody class="divide-y divide-border">
                    <?php
                    foreach ( $customer_orders->orders as $customer_order ) :
                        $order      = wc_get_order( $customer_order ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
                        $item_count = $order->get_item_count() - $order->get_item_count_refunded();
                        ?>
                        <tr class="woocommerce-orders-table__row woocommerce-orders-table__row--status-<?php echo esc_attr( $order->get_status() ); ?> order group hover:bg-secondary/20 transition-colors">
                            <?php foreach ( wc_get_account_orders_columns() as $column_id => $column_name ) : ?>
                                <td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-<?php echo esc_attr( $column_id ); ?> py-6 px-2 text-sm font-medium" data-title="<?php echo esc_attr( $column_name ); ?>">
                                    <?php if ( has_action( 'woocommerce_my_account_my_orders_column_' . $column_id ) ) : ?>
                                        <?php do_action( 'woocommerce_my_account_my_orders_column_' . $column_id, $order ); ?>

                                    <?php elseif ( 'order-number' === $column_id ) : ?>
                                        <a href="<?php echo esc_url( $order->get_view_order_url() ); ?>" class="text-brand-blue font-bold hover:underline">
                                            #<?php echo esc_html( $order->get_order_number() ); ?>
                                        </a>

                                    <?php elseif ( 'order-date' === $column_id ) : ?>
                                        <time datetime="<?php echo esc_attr( $order->get_date_created()->date( 'c' ) ); ?>" class="text-muted-foreground"><?php echo esc_html( wc_format_datetime( $order->get_date_created() ) ); ?></time>

                                    <?php elseif ( 'order-status' === $column_id ) : ?>
                                        <?php
                                        $status_name = wc_get_order_status_name( $order->get_status() );
                                        $status_class = '';
                                        switch($order->get_status()) {
                                            case 'completed': $status_class = 'bg-green-100 text-green-700'; break;
                                            case 'processing': $status_class = 'bg-blue-100 text-blue-700'; break;
                                            case 'on-hold': $status_class = 'bg-yellow-100 text-yellow-700'; break;
                                            case 'cancelled':
                                            case 'failed': $status_class = 'bg-red-100 text-red-700'; break;
                                            default: $status_class = 'bg-gray-100 text-gray-700';
                                        }
                                        ?>
                                        <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider <?php echo $status_class; ?>">
                                            <?php echo esc_html( $status_name ); ?>
                                        </span>

                                    <?php elseif ( 'order-total' === $column_id ) : ?>
                                        <div class="space-y-0.5">
                                            <p class="font-bold text-foreground"><?php echo $order->get_formatted_order_total(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
                                            <p class="text-[10px] text-muted-foreground uppercase tracking-wider"><?php echo sprintf( _n( '%s item', '%s items', $item_count, 'woocommerce' ), $item_count ); ?></p>
                                        </div>

                                    <?php elseif ( 'order-actions' === $column_id ) : ?>
                                        <?php
                                        $actions = wc_get_account_orders_actions( $order );

                                        if ( ! empty( $actions ) ) {
                                            foreach ( $actions as $key => $action ) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
                                                $btn_class = ($key === 'view') ? 'bg-brand-blue text-white shadow-lg shadow-brand-blue/20' : 'bg-secondary text-foreground';
                                                echo '<a href="' . esc_url( $action['url'] ) . '" class="woocommerce-button button ' . sanitize_html_class( $key ) . ' px-4 py-2 rounded-lg text-xs font-bold uppercase tracking-widest transition-all hover:opacity-90 ml-2 inline-block ' . $btn_class . '">' . esc_html( $action['name'] ) . '</a>';
                                            }
                                        }
                                        ?>
                                    <?php endif; ?>
                                </td>
                            <?php endforeach; ?>
                        </tr>
                        <?php
                    endforeach;
                    ?>
                </tbody>
            </table>
        </div>

        <?php do_action( 'woocommerce_before_account_orders_pagination' ); ?>

        <?php if ( 1 < $customer_orders->max_num_pages ) : ?>
            <div class="woocommerce-pagination woocommerce-pagination--without-numbers woocommerce-Pagination flex items-center justify-center gap-4 pt-8">
                <?php if ( 1 !== $current_page ) : ?>
                    <a class="woocommerce-button woocommerce-button--previous woocommerce-Button woocommerce-Button--previous button bg-secondary px-6 py-3 rounded-xl text-sm font-bold uppercase tracking-widest hover:bg-brand-blue hover:text-white transition-all" href="<?php echo esc_url( wc_get_endpoint_url( 'orders', $current_page - 1 ) ); ?>"><?php esc_html_e( 'Previous', 'woocommerce' ); ?></a>
                <?php endif; ?>

                <?php if ( intval( $customer_orders->max_num_pages ) !== $current_page ) : ?>
                    <a class="woocommerce-button woocommerce-button--next woocommerce-Button woocommerce-Button--next button bg-brand-blue text-white px-6 py-3 rounded-xl text-sm font-bold uppercase tracking-widest shadow-lg shadow-brand-blue/20 hover:opacity-90 transition-all" href="<?php echo esc_url( wc_get_endpoint_url( 'orders', $current_page + 1 ) ); ?>"><?php esc_html_e( 'Next', 'woocommerce' ); ?></a>
                <?php endif; ?>
            </div>
        <?php endif; ?>

    <?php else : ?>
        <div class="text-center py-20 space-y-6">
            <div class="w-20 h-20 bg-secondary/30 rounded-full flex items-center justify-center mx-auto text-muted-foreground">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
            </div>
            <div class="space-y-2">
                <h3 class="text-lg font-bold text-foreground"><?php esc_html_e( 'No orders found', 'woocommerce' ); ?></h3>
                <p class="text-sm text-muted-foreground"><?php esc_html_e( 'You haven\'t placed any orders yet.', 'woocommerce' ); ?></p>
            </div>
            <a href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>" class="inline-block bg-brand-blue text-white px-8 py-4 rounded-xl font-bold uppercase tracking-widest text-xs hover:opacity-90 transition-all shadow-lg shadow-brand-blue/20">
                <?php esc_html_e( 'Browse Products', 'woocommerce' ); ?>
            </a>
        </div>
    <?php endif; ?>
</div>

<?php do_action( 'woocommerce_after_account_orders', $has_orders ); ?>
