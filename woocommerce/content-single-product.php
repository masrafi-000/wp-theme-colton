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
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( 'grid grid-cols-1 lg:grid-cols-2 gap-8 sm:gap-12 lg:gap-20 xl:gap-32 max-w-[1600px] mx-auto items-start py-6 sm:py-12', $product ); ?>>

    <!-- Left Column: Gallery -->
	<div class="woocommerce-product-gallery bg-gradient-card border border-border rounded-2xl p-6 sm:p-12 lg:p-16 flex items-center justify-center min-h-[380px] sm:min-h-[480px] md:min-h-[580px] lg:min-h-[650px] xl:min-h-[750px] w-full shadow-sm hover:shadow-md transition-shadow duration-300">
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
	<div class="summary entry-summary space-y-6 sm:space-y-8 lg:space-y-10">
        <div class="space-y-3 sm:space-y-5">
            <?php 
            $purity = $product->get_attribute('pa_purity') ?: $product->get_attribute('Purity');
            if ( $purity ) : ?>
                <p class="text-primary text-[10px] sm:text-xs font-bold uppercase tracking-[0.25em] sm:tracking-[0.35em]"><?php echo esc_html( $purity ); ?> Purity</p>
            <?php else: ?>
                <p class="text-primary text-[10px] sm:text-xs font-bold uppercase tracking-[0.25em] sm:tracking-[0.35em]">Research Grade</p>
            <?php endif; ?>
            <h1 class="product_title text-3xl sm:text-4xl md:text-5xl xl:text-6xl font-display font-bold text-foreground leading-[1.15] sm:leading-[1.1]"><?php the_title(); ?></h1>
            <div class="text-muted-foreground text-[11px] sm:text-xs tracking-widest uppercase opacity-70">
                SKU: <span class="sku font-bold"><?php echo ( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'woocommerce' ); ?></span>
            </div>
        </div>

        <div class="woocommerce-product-details__short-description text-muted-foreground leading-relaxed max-w-xl text-sm sm:text-base md:text-lg">
            <?php the_content(); ?>
        </div>

		<?php
		/* ... rest of hooks remain identical ... */
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
		do_action( 'woocommerce_single_product_summary' );
		?>

        <!-- Custom Disclaimer -->
        <div class="bg-card border border-border/50 rounded-2xl p-5 sm:p-7 text-[11px] sm:text-xs text-muted-foreground leading-relaxed flex items-start gap-4 sm:gap-5 shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary shrink-0 w-5 h-5 sm:w-6 sm:h-6 mt-0.5"><circle cx="12" cy="12" r="10"/><line x1="12" x2="12" y1="8" y2="12"/><line x1="12" x2="12.01" y1="16" y2="16"/></svg>
            <p><span class="text-primary font-bold uppercase block sm:inline mb-1 sm:mb-0">Research Use Only</span> — This product is intended solely for laboratory and research purposes. Not for human consumption. By purchasing, you confirm this product will be used for in vitro research only.</p>
        </div>

        <!-- Collapsible Details Dropdown (Dynamic) -->
        <?php
        $attributes = $product->get_attributes();
        $accordion_attributes = array_filter( $attributes, function($attr) {
            return ! $attr->get_variation() && $attr->get_visible();
        } );

        if ( ! empty( $accordion_attributes ) ) : ?>
            <div class="space-y-4 pt-6 sm:pt-10 border-t border-border">
                <div class="product-accordion border border-border rounded-2xl overflow-hidden bg-white shadow-sm">
                    <?php 
                    foreach ( $accordion_attributes as $attribute ) : 
                        $name = wc_attribute_label( $attribute->get_name() );
                        $values = $product->get_attribute( $attribute->get_name() );
                        $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary"><path d="M22 10v6M2 10v6M12 4v16M4 10h16"/></svg>';
                        if ( stripos($name, 'storage') !== false ) $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary"><path d="M10 21v-8a2 2 0 0 0-4 0v8M14 21v-8a2 2 0 0 1 4 0v8M6 21h12"/></svg>';
                        if ( stripos($name, 'shelf') !== false ) $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>';
                        if ( stripos($name, 'solubility') !== false ) $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary"><circle cx="12" cy="12" r="10"/><path d="M12 8v8M8 12h8"/></svg>';
                    ?>
                        <div class="accordion-item border-b border-border last:border-0">
                            <button class="accordion-header w-full flex items-center justify-between p-4 sm:p-6 text-left hover:bg-secondary/20 transition-all duration-300">
                                <span class="text-sm sm:text-base font-bold uppercase tracking-widest text-foreground flex items-center gap-3 sm:gap-4">
                                    <?php echo $icon; ?>
                                    <?php echo esc_html( $name ); ?>
                                </span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="accordion-icon transition-transform duration-300 w-5 h-5 sm:w-6 sm:h-6"><path d="m6 9 6 6 6-6"/></svg>
                            </button>
                            <div class="accordion-content max-h-0 overflow-hidden transition-all duration-500 ease-in-out">
                                <div class="p-6 sm:p-8 text-sm sm:text-base text-muted-foreground leading-relaxed">
                                    <?php echo wp_kses_post( $values ); ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const headers = document.querySelectorAll('.accordion-header');
                headers.forEach(header => {
                    header.addEventListener('click', () => {
                        const content = header.nextElementSibling;
                        const icon = header.querySelector('.accordion-icon');
                        headers.forEach(otherHeader => {
                            if (otherHeader !== header) {
                                otherHeader.nextElementSibling.style.maxHeight = null;
                                otherHeader.querySelector('.accordion-icon').classList.remove('rotate-180');
                            }
                        });
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
