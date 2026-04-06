<?php
/**
 * The template for displaying product search form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/product-searchform.php.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<form role="search" method="get" class="woocommerce-product-search group relative" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="relative flex items-center bg-secondary/20 border border-border rounded-xl overflow-hidden transition-all duration-300 focus-within:border-primary/50 focus-within:shadow-[0_0_15px_rgba(2,102,158,0.1)]">
        <label class="screen-reader-text" for="woocommerce-product-search-field-<?php echo isset( $index ) ? absint( $index ) : 0; ?>"><?php esc_html_e( 'Search for:', 'woocommerce' ); ?></label>
        
        <div class="pl-4 text-muted-foreground/60 group-focus-within:text-primary transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
        </div>

        <input 
            type="search" 
            id="woocommerce-product-search-field-<?php echo isset( $index ) ? absint( $index ) : 0; ?>" 
            class="search-field w-full bg-transparent border-none py-3 px-3 text-sm text-foreground placeholder:text-muted-foreground/50 focus:outline-none focus:ring-0" 
            placeholder="<?php echo esc_attr__( 'Search catalog...', 'woocommerce' ); ?>" 
            value="<?php echo get_search_query(); ?>" 
            name="s" 
        />
        
        <button type="submit" class="bg-primary hover:bg-brand-blue-dark text-white px-5 py-3 text-xs font-bold uppercase tracking-widest transition-all duration-300 active:scale-95 rounded-2xl">
            <?php echo esc_html_x( 'Find', 'submit button', 'woocommerce' ); ?>
        </button>
    </div>
	<input type="hidden" name="post_type" value="product" />
</form>
