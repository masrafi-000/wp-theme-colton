<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	return;
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( 'grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-24 items-start', $product ); ?>>

    <!-- Left Column: Gallery -->
	<div class="woocommerce-product-gallery bg-gradient-card border border-border rounded-xl p-12 flex items-center justify-center min-h-[400px] md:min-h-[600px] w-full">
		<?php
		/**
		 * Hook: woocommerce_before_single_product_summary.
		 *
		 * @hooked woocommerce_show_product_sale_flash - 10
		 * @hooked woocommerce_show_product_images - 20
		 */
		do_action( 'woocommerce_before_single_product_summary' );
		?>
	</div>

    <!-- Right Column: Summary -->
	<div class="summary entry-summary space-y-8">
        <div class="space-y-4">
            <p class="text-primary text-xs font-bold uppercase tracking-[0.3em]">≥99% Purity</p>
            <h1 class="product_title text-4xl md:text-6xl font-display font-bold text-foreground"><?php the_title(); ?></h1>
            <div class="text-muted-foreground text-sm tracking-wider">
                SKU: <span class="sku"><?php echo ( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'woocommerce' ); ?></span>
            </div>
        </div>

        <div class="woocommerce-product-details__short-description text-muted-foreground leading-relaxed max-w-xl">
            <?php the_content(); ?>
        </div>

		<?php
		/**
		 * Hook: woocommerce_single_product_summary.
		 *
		 * @hooked woocommerce_template_single_title - 5 (removed above)
		 * @hooked woocommerce_template_single_rating - 10
		 * @hooked woocommerce_template_single_price - 10 (moved below)
		 * @hooked woocommerce_template_single_excerpt - 20 (moved above)
		 * @hooked woocommerce_template_single_add_to_cart - 30
		 * @hooked woocommerce_template_single_meta - 40
		 * @hooked woocommerce_template_single_sharing - 50
		 * @hooked WC_Structured_Data::generate_product_data - 60
		 */
        
        // Remove default title and excerpt to avoid duplicates
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
        
		do_action( 'woocommerce_single_product_summary' );
		?>

        <!-- Custom Disclaimer as per Image 2 -->
        <div class="bg-card border border-border/50 rounded-xl p-6 text-[11px] md:text-xs text-muted-foreground leading-relaxed flex items-start gap-4">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary shrink-0"><circle cx="12" cy="12" r="10"/><line x1="12" x2="12" y1="8" y2="12"/><line x1="12" x2="12.01" y1="16" y2="16"/></svg>
            <p><span class="text-primary font-bold uppercase">Research Use Only</span> — This product is intended solely for laboratory and research purposes. Not for human consumption. By purchasing, you confirm this product will be used for in vitro research only.</p>
        </div>

        <!-- Collapsible Details Dropdown -->
        <div class="space-y-4 pt-8 border-t border-border">
            <div class="product-accordion border border-border rounded-xl overflow-hidden bg-white shadow-sm">
                <!-- Intended Use -->
                <div class="accordion-item border-b border-border last:border-0">
                    <button class="accordion-header w-full flex items-center justify-between p-5 text-left hover:bg-secondary/20 transition-all duration-300">
                        <span class="text-sm font-bold uppercase tracking-widest text-foreground flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary"><path d="M22 10v6M2 10v6M12 4v16M4 10h16"/></svg>
                            Intended Use
                        </span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="accordion-icon transition-transform duration-300"><path d="m6 9 6 6 6-6"/></svg>
                    </button>
                    <div class="accordion-content max-h-0 overflow-hidden transition-all duration-500 ease-in-out">
                        <div class="p-6 text-sm text-muted-foreground leading-relaxed">
                            This product is designed for Research Purposes only. All peptides require reconstitution with Bacteriostatic water (BAC water), sold separately.
                        </div>
                    </div>
                </div>

                <!-- Storage -->
                <div class="accordion-item border-b border-border last:border-0">
                    <button class="accordion-header w-full flex items-center justify-between p-5 text-left hover:bg-secondary/20 transition-all duration-300">
                        <span class="text-sm font-bold uppercase tracking-widest text-foreground flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary"><path d="M10 21v-8a2 2 0 0 0-4 0v8M14 21v-8a2 2 0 0 1 4 0v8M6 21h12"/></svg>
                            Storage
                        </span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="accordion-icon transition-transform duration-300"><path d="m6 9 6 6 6-6"/></svg>
                    </button>
                    <div class="accordion-content max-h-0 overflow-hidden transition-all duration-500 ease-in-out">
                        <div class="p-6 text-sm text-muted-foreground leading-relaxed">
                            Store the vial in a cool, dry place away from direct sunlight. Once reconstituted, keep refrigerated at 2-8°C.
                        </div>
                    </div>
                </div>

                <!-- Solubility -->
                <div class="accordion-item border-b border-border last:border-0">
                    <button class="accordion-header w-full flex items-center justify-between p-5 text-left hover:bg-secondary/20 transition-all duration-300">
                        <span class="text-sm font-bold uppercase tracking-widest text-foreground flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary"><circle cx="12" cy="12" r="10"/><path d="M12 8v8M8 12h8"/></svg>
                            Solubility
                        </span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="accordion-icon transition-transform duration-300"><path d="m6 9 6 6 6-6"/></svg>
                    </button>
                    <div class="accordion-content max-h-0 overflow-hidden transition-all duration-500 ease-in-out">
                        <div class="p-6 text-sm text-muted-foreground leading-relaxed">
                            Reconstitute with bacteriostatic water for best results. Vial Size: 3ml (can hold up to 3ml BAC water).
                        </div>
                    </div>
                </div>

                <!-- Shelf Life -->
                <div class="accordion-item border-b border-border last:border-0">
                    <button class="accordion-header w-full flex items-center justify-between p-5 text-left hover:bg-secondary/20 transition-all duration-300">
                        <span class="text-sm font-bold uppercase tracking-widest text-foreground flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                            Shelf Life
                        </span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="accordion-icon transition-transform duration-300"><path d="m6 9 6 6 6-6"/></svg>
                    </button>
                    <div class="accordion-content max-h-0 overflow-hidden transition-all duration-500 ease-in-out">
                        <div class="p-6 text-sm text-muted-foreground leading-relaxed">
                            The lyophilized form has a shelf life of 24 months when properly stored. Once reconstituted, refrigerate and use within 4-6 weeks.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const headers = document.querySelectorAll('.accordion-header');
                headers.forEach(header => {
                    header.addEventListener('click', () => {
                        const content = header.nextElementSibling;
                        const icon = header.querySelector('.accordion-icon');
                        
                        // Close other items
                        headers.forEach(otherHeader => {
                            if (otherHeader !== header) {
                                otherHeader.nextElementSibling.style.maxHeight = null;
                                otherHeader.querySelector('.accordion-icon').classList.remove('rotate-180');
                            }
                        });

                        // Toggle current item
                        if (content.style.maxHeight) {
                            content.style.maxHeight = null;
                            icon.classList.remove('rotate-180');
                        } else {
                            content.style.maxHeight = content.scrollHeight + "px";
                            icon.classList.add('rotate-180');
                        }
                    });
                });
            });
        </script>
	</div>

</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
