<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

// Remove standard WooCommerce link wrappers to prevent nested <a> tags
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
?>
<li <?php wc_product_class( 'group bg-card border border-border rounded-2xl overflow-hidden transition-all duration-500 hover:border-primary/40 hover:shadow-2xl hover:shadow-primary/10 flex flex-col h-full reveal-on-scroll', $product ); ?>>
    <a href="<?php the_permalink(); ?>" class="flex flex-col h-full group no-underline">
        <!-- Image Section -->
        <div class="relative bg-gradient-to-br from-primary/5 to-transparent p-8 flex items-center justify-center h-72 overflow-hidden border-b border-border/50">
            <div class="product-image-container flex items-center justify-center w-full h-full transform transition-transform duration-700 group-hover:scale-110">
                <?php
                /**
                 * Hook: woocommerce_before_shop_loop_item_title.
                 *
                 * @hooked woocommerce_show_product_loop_sale_flash - 10
                 * @hooked woocommerce_template_loop_product_thumbnail - 10
                 */
                do_action( 'woocommerce_before_shop_loop_item_title' );
                ?>
            </div>
            
            <!-- Quick Badges -->
            <!-- <div class="absolute top-4 left-4 flex flex-col gap-2 z-10">
                <span class="bg-white/90 backdrop-blur-sm text-primary text-[9px] font-bold px-3 py-1 rounded-full uppercase tracking-widest border border-primary/20 shadow-sm">HPLC Verified</span>
                <?php if ( $product->is_on_sale() ) : ?>
                    <span class="bg-accent text-white text-[9px] font-bold px-3 py-1 rounded-full uppercase tracking-widest shadow-lg">Save <?php echo $product->get_sale_price() ? round(100 - ($product->get_sale_price() / $product->get_regular_price() * 100)) : '0'; ?>%</span>
                <?php endif; ?>
            </div> -->
        </div>

        <!-- Content Section -->
        <div class="p-6 md:p-8 flex flex-col flex-grow bg-white">
            <div class="flex items-center gap-2 mb-3">
                <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse shadow-[0_0_10px_rgba(34,197,94,0.5)]"></span>
                <p class="text-muted-foreground text-[10px] font-bold uppercase tracking-[0.2em]">In Stock & Ready</p>
            </div>
            
            <h3 class="text-foreground font-display font-bold text-[20px] mb-3 group-hover:text-primary transition-colors leading-tight no-underline">
                <?php the_title(); ?>
            </h3>

            <?php if ( $product->get_short_description() ) : ?>
                <div class="text-muted-foreground text-[13px] leading-relaxed line-clamp-2 mb-6 font-medium opacity-80 italic">
                    "<?php echo wp_strip_all_tags( $product->get_short_description() ); ?>"
                </div>
            <?php endif; ?>

            <div class="mt-auto pt-6 border-t border-border/50 flex items-center justify-between">
                <div class="flex flex-col">
                    <span class="text-primary font-display font-bold text-[24px] tracking-tight">
                        <?php echo $product->get_price_html(); ?>
                    </span>
                    <span class="text-[9px] text-muted-foreground uppercase tracking-[0.2em] font-bold">Research Quantity</span>
                </div>
                
                <div class="h-12 w-12 rounded-2xl bg-secondary/50 border border-border flex items-center justify-center group-hover:bg-primary group-hover:border-primary group-hover:text-primary-foreground group-hover:shadow-lg group-hover:shadow-primary/20 transition-all duration-500 transform group-hover:scale-110">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="transition-transform group-hover:rotate-90"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                </div>
            </div>
        </div>
    </a>
</li>
