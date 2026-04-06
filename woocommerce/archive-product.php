<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header();

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_product_data - -10
 */
do_action( 'woocommerce_before_main_content' );

?>
<header class="woocommerce-products-header mb-8 text-left container mx-auto px-4 pt-12">
    <?php woocommerce_breadcrumb(); ?>
    <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
        <p class="text-primary text-[10px] tracking-[0.4em] uppercase font-bold mb-3 opacity-80">Research Grade</p>
        <h1 class="woocommerce-products-header__title page-title text-4xl md:text-5xl font-display font-bold text-foreground tracking-tight leading-tight"><?php woocommerce_page_title(); ?></h1>
        <div class="h-1 w-20 bg-primary/20 mt-6 rounded-full"></div>
    <?php endif; ?>
</header>

<div class="container mx-auto px-4 pb-24">
    <div class="flex flex-col lg:flex-row gap-12 lg:gap-16">
        <!-- Sidebar -->
        <aside class="w-full lg:w-80 shrink-0">
            <div class="sticky top-32 space-y-10">
                <!-- Search -->
                <div class="bg-card border border-border rounded-2xl p-6 shadow-sm">
                    <h3 class="text-foreground font-display font-bold uppercase tracking-[0.2em] text-[11px] mb-6 flex items-center gap-3">
                        <span class="w-1.5 h-1.5  bg-primary rounded-full"></span>
                        Search Catalog
                    </h3>
                    <?php get_product_search_form(); ?>
                </div>

                <!-- Categories -->
                <div class="bg-card border border-border rounded-2xl p-6 shadow-sm colton-categories-sidebar">
                    <h3 class="text-foreground font-display font-bold uppercase tracking-[0.2em] text-[11px] mb-6 flex items-center gap-3">
                        <span class="w-1.5 h-1.5 bg-primary rounded-full"></span>
                        Filter by Category
                    </h3>
                    <?php
                    $args = array(
                        'taxonomy'   => 'product_cat',
                        'hide_empty' => true,
                        'title_li'   => '',
                    );
                    echo '<ul class="space-y-4">';
                    wp_list_categories( $args );
                    echo '</ul>';
                    ?>
                </div>

                <!-- Reset -->
                <?php if ( is_filtered() || is_product_category() || is_product_tag() ) : ?>
                    <div class="pt-4 px-2">
                        <a href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ); ?>" class="text-[11px] text-muted-foreground hover:text-primary transition-all duration-300 flex items-center gap-3 font-bold uppercase tracking-widest group">
                            <span class="w-8 h-8 rounded-full border border-border flex items-center justify-center group-hover:border-primary group-hover:bg-primary/5 transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-muted-foreground group-hover:text-primary"><path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/></svg>
                            </span>
                            Reset All Filters
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </aside>

        <!-- Product Grid -->
        <main class="flex-grow">
            <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-10 bg-secondary/30 rounded-2xl p-4 md:p-6 border border-border/50 gap-4">
                <?php
                /**
                 * Hook: woocommerce_before_shop_loop.
                 *
                 * @hooked woocommerce_output_all_notices - 10
                 * @hooked woocommerce_result_count - 20
                 * @hooked woocommerce_catalog_ordering - 30
                 */
                do_action( 'woocommerce_before_shop_loop' );
                ?>
            </div>

            <?php if ( woocommerce_product_loop() ) : ?>
                <ul class="products grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8 mb-16">
                    <?php
                    while ( have_posts() ) {
                        the_post();
                        do_action( 'woocommerce_shop_loop' );
                        wc_get_template_part( 'content', 'product' );
                    }
                    ?>
                </ul>
                <div class="mt-12 flex justify-center">
                    <?php
                    /**
                     * Hook: woocommerce_after_shop_loop.
                     *
                     * @hooked woocommerce_pagination - 10
                     */
                    do_action( 'woocommerce_after_shop_loop' );
                    ?>
                </div>
            <?php else :
                /**
                 * Hook: woocommerce_no_products_found.
                 *
                 * @hooked wc_no_products_found - 10
                 */
                do_action( 'woocommerce_no_products_found' );
            endif;
            ?>
        </main>
    </div>
</div>

<?php
/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );

/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
// do_action( 'woocommerce_sidebar' ); // We're using a custom sidebar above

get_footer();
