<?php
/**
 * Mini-cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.9.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_mini_cart' );

$progress_data = colton_research_get_cart_progress_data();
?>

<?php if ( ! WC()->cart->is_empty() ) : ?>

    <div class="flex-1 flex flex-col h-full">
        <!-- Scrollable content -->
        <div class="flex-1 overflow-y-auto custom-scrollbar p-6 space-y-8 pb-32">
            <!-- Free Shipping Progress -->
            <div class="space-y-3">
                <div class="flex items-center gap-2 text-[11px] font-bold text-muted-foreground justify-center">
                    <?php if ( $progress_data['free_shipping']['remaining'] > 0 ) : ?>
                        <span class="w-4 h-4 rounded-full border border-brand-blue flex items-center justify-center text-brand-blue text-[10px]">!</span>
                        <span>Add <span class="text-foreground font-bold"><?php echo wc_price( $progress_data['free_shipping']['remaining'] ); ?></span> more for free shipping!</span>
                    <?php else : ?>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#02669e" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="text-brand-blue"><polyline points="20 6 9 17 4 12"/></svg>
                        <span class="text-muted-foreground">Your order qualifies for free shipping!</span>
                    <?php endif; ?>
                </div>
                <div class="h-2 w-full bg-secondary rounded-full overflow-hidden">
                    <div class="h-full bg-brand-blue transition-all duration-500" style="width: <?php echo $progress_data['free_shipping']['percent']; ?>%;"></div>
                </div>
            </div>

            <!-- Bulk Savings Section -->
            <div class="bg-white border border-border rounded-2xl p-6 space-y-8 shadow-sm">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-foreground"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                        <h4 class="text-[11px] font-bold uppercase tracking-[0.2em] text-foreground">Bulk Savings</h4>
                    </div>
                    <?php if ( $progress_data['bulk_savings']['current_discount'] > 0 ) : ?>
                        <span class="bg-[#eefcf4] text-[#22c55e] text-[10px] font-bold px-3 py-1.5 rounded uppercase border border-[#22c55e]/20"><?php echo $progress_data['bulk_savings']['current_discount']; ?>% Off</span>
                    <?php endif; ?>
                </div>

                <!-- Progress Dots and Line -->
                <div class="relative px-2">
                    <!-- Base line -->
                    <div class="absolute top-[11px] left-0 w-full h-[3px] bg-secondary rounded-full"></div>
                    
                    <!-- Active line -->
                    <?php
                    $item_count = $progress_data['item_count'];
                    $active_percent = 0;
                    if ($item_count >= 1) $active_percent = 0;
                    if ($item_count >= 5) $active_percent = 33.33;
                    if ($item_count >= 7) $active_percent = 66.66;
                    if ($item_count >= 9) $active_percent = 100;
                    ?>
                    <div class="absolute top-[11px] left-0 h-[3px] bg-foreground rounded-full transition-all duration-700" style="width: <?php echo $active_percent; ?>%;"></div>

                    <div class="relative flex justify-between">
                        <?php foreach ( $progress_data['bulk_savings']['milestones'] as $index => $milestone ) : 
                            $is_done = $item_count >= $milestone['qty'];
                            $is_current = false;
                            if ($is_done) {
                                $is_current = true;
                                if (isset($progress_data['bulk_savings']['milestones'][$index+1]) && $item_count >= $progress_data['bulk_savings']['milestones'][$index+1]['qty']) {
                                    $is_current = false;
                                }
                            }
                        ?>
                            <div class="flex flex-col items-center gap-3">
                                <div class="w-6 h-6 rounded-full flex items-center justify-center z-10 transition-all duration-500 <?php echo $is_done ? 'bg-brand-green text-white shadow-[0_0_10px_rgba(34,197,94,0.3)]' : ($is_current ? 'bg-white border-2 border-foreground' : 'bg-white border-2 border-secondary'); ?>">
                                    <?php if ( $is_done ) : ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                                    <?php elseif ( $is_current ) : ?>
                                        <div class="w-2 h-2 rounded-full bg-foreground"></div>
                                    <?php endif; ?>
                                </div>
                                <div class="text-center">
                                    <p class="text-[10px] font-bold text-foreground"><?php echo $milestone['discount']; ?>%</p>
                                    <p class="text-[9px] font-medium text-muted-foreground"><?php echo $milestone['qty']; ?>+</p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <?php if ( $progress_data['bulk_savings']['next_milestone'] ) : ?>
                    <div class="text-center">
                        <p class="text-[11px] font-medium text-brand-green">
                            <?php if ( $progress_data['bulk_savings']['current_discount'] > 0 ) : ?>
                                <span class="font-bold"><?php echo $progress_data['bulk_savings']['current_discount']; ?>% off applied!</span> 
                            <?php endif; ?>
                            Add <span class="font-bold text-foreground"><?php echo $progress_data['bulk_savings']['next_milestone']['qty'] - $item_count; ?> more</span> for <span class="font-bold text-foreground"><?php echo $progress_data['bulk_savings']['next_milestone']['discount']; ?>% off</span>
                        </p>
                    </div>
                <?php else : ?>
                    <div class="text-center">
                        <p class="text-[11px] font-bold text-brand-green">✓ Maximum 12% discount unlocked!</p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Item List -->
            <div class="space-y-8">
                <?php
                foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                    $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                    $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

                    if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                        $product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
                        $thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
                        $product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
                        $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                        ?>
                        <div class="flex gap-5 relative group">
                            <!-- Remove Icon Top Right -->
                            <a href="<?php echo esc_url( wc_get_cart_remove_url( $cart_item_key ) ); ?>" class="absolute -top-2 -right-2 w-6 h-6 bg-white border border-border rounded-full flex items-center justify-center text-muted-foreground hover:text-red-500 hover:border-red-200 transition-all z-20 shadow-sm" data-product_id="<?php echo esc_attr( $product_id ); ?>" data-cart_item_key="<?php echo esc_attr( $cart_item_key ); ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                            </a>

                            <div class="flex-grow flex items-center justify-between gap-4">
                                <div class="space-y-1.5">
                                    <h5 class="text-sm font-bold text-foreground">
                                        <a href="<?php echo esc_url( $product_permalink ); ?>"><?php echo $product_name; ?></a>
                                    </h5>
                                    <p class="text-sm font-bold text-foreground"><?php echo $product_price; ?></p>
                                    
                                    <!-- Quantity Selector -->
                                    <div class="flex items-center gap-4 mt-3 bg-white border border-border rounded-lg w-fit px-3 py-1.5 shadow-sm">
                                        <button class="minus-qty text-muted-foreground hover:text-foreground transition-colors font-bold text-lg leading-none">-</button>
                                        <span class="text-xs font-bold w-4 text-center"><?php echo $cart_item['quantity']; ?></span>
                                        <button class="plus-qty text-muted-foreground hover:text-foreground transition-colors font-bold text-lg leading-none">+</button>
                                    </div>
                                </div>
                                <div class="w-20 h-20 flex-shrink-0">
                                    <?php echo $thumbnail; ?>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>

        <!-- Sticky Footer -->
        <div class="p-6 border-t border-border bg-white shadow-[0_-10px_20px_rgba(0,0,0,0.02)] space-y-3">
            <div class="flex items-center justify-between mb-4">
                <span class="text-xs font-bold text-muted-foreground uppercase tracking-widest">Subtotal</span>
                <span class="text-lg font-bold text-foreground"><?php echo WC()->cart->get_cart_subtotal(); ?></span>
            </div>
            <div class="grid grid-cols-2 gap-3">
                <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="w-full border border-border hover:bg-secondary text-foreground font-bold py-4 rounded-xl flex items-center justify-center uppercase tracking-widest text-[11px] transition-all duration-300">
                    VIEW CART
                </a>
                <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="w-full bg-brand-blue hover:bg-brand-blue-dark text-primary-foreground font-bold py-4 rounded-xl flex items-center justify-center uppercase tracking-widest text-[11px] transition-all duration-300 shadow-lg shadow-brand-blue/20">
                    CHECKOUT
                </a>
            </div>
        </div>
    </div>

<?php else : ?>
    <div class="p-12 h-full flex flex-col items-center justify-center text-center space-y-6">
        <div class="w-20 h-20 bg-secondary rounded-full flex items-center justify-center text-muted-foreground mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
        </div>
        <div class="space-y-2">
            <h3 class="text-xl font-display font-bold text-foreground">Your cart is empty</h3>
            <p class="text-sm text-muted-foreground leading-relaxed">Looks like you haven't added anything to your cart yet. Start exploring our research products.</p>
        </div>
        <a href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>" class="inline-block bg-primary text-white px-10 py-4 rounded-xl font-bold uppercase tracking-widest text-xs hover:bg-accent transition-all shadow-lg shadow-primary/20">Start Shopping</a>
    </div>
<?php endif; ?>

<?php do_action( 'woocommerce_after_mini_cart' ); ?>
