<?php
/**
 * WooCommerce Specific Logic and Enhancements
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * WooCommerce support setup
 */
function colton_research_woocommerce_setup() {
    add_theme_support( 'woocommerce' );
    
    // Disable WooCommerce default styles for full control
    add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

    // Disable WooCommerce Blocks for Cart and Checkout to use theme templates
    add_filter( 'woocommerce_is_checkout_block_default', '__return_false' );
    add_filter( 'woocommerce_is_cart_block_default', '__return_false' );

    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );

    // Remove default WooCommerce wrappers
    remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
    remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
}
add_action( 'after_setup_theme', 'colton_research_woocommerce_setup' );

/**
 * Custom WooCommerce Badges
 */
function colton_research_custom_badges() {
    global $product;
    $is_featured = $product->is_featured();
    $is_new = false;
    $created_date = $product->get_date_created();
    if ( $created_date && ( time() - $created_date->getTimestamp() ) < ( 30 * 24 * 60 * 60 ) ) {
        $is_new = true;
    }

    if ( $is_featured ) {
        echo '<span class="absolute top-4 left-4 bg-primary text-primary-foreground text-[11px] font-bold px-3 py-1 rounded-sm uppercase tracking-widest z-10 shadow-lg">Bestseller</span>';
    } elseif ( $is_new ) {
        echo '<span class="absolute top-4 left-4 bg-accent text-accent-foreground text-[11px] font-bold px-3 py-1 rounded-sm uppercase tracking-widest z-10 shadow-lg">New</span>';
    }
}
add_action( 'woocommerce_before_shop_loop_item_title', 'colton_research_custom_badges', 15 );
add_action( 'woocommerce_before_single_product_summary', 'colton_research_custom_badges', 15 );

// Remove default WooCommerce "Sale!" flash
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );

/**
 * Custom Add to Cart Button Text
 */
function colton_research_add_to_cart_text( $text, $product ) {
    if ( is_single() ) return esc_html__( 'ADD TO CART', 'woocommerce' );
    return $text;
}
add_filter( 'woocommerce_product_single_add_to_cart_text', 'colton_research_add_to_cart_text', 10, 2 );

/**
 * Custom Stock Availability HTML
 */
function colton_research_stock_html( $html, $product ) {
    $availability = $product->get_availability();
    if ( isset( $availability['class'] ) && $availability['class'] === 'in-stock' ) {
        return '<p class="stock ' . esc_attr( $availability['class'] ) . ' flex items-center gap-2 text-green-500 font-medium"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check"><path d="M20 6 9 17l-5-5"/></svg> ' . esc_html( $availability['availability'] ) . '</p>';
    }
    return $html;
}
add_filter( 'woocommerce_get_stock_html', 'colton_research_stock_html', 10, 2 );

/**
 * Back in Stock Notification Form
 */
function colton_research_back_in_stock_form() {
    global $product;
    if ( ! $product->is_in_stock() ) {
        ?>
        <div class="mt-8 p-6 bg-secondary/50 border border-border rounded-xl space-y-4">
            <div class="flex items-center gap-3 text-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5"><path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/><path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"/></svg>
                <h4 class="font-display font-bold uppercase tracking-wider text-sm">Notify Me When Back in Stock</h4>
            </div>
            <p class="text-xs text-muted-foreground leading-relaxed">This research compound is currently being synthesized. Enter your email to be notified the moment it becomes available.</p>
            <form class="flex gap-2" id="back-in-stock-form">
                <input type="email" placeholder="Your email address" class="flex-1 bg-white border border-border rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-primary/50" required>
                <button type="submit" class="bg-primary text-white px-6 py-2 rounded-lg font-bold text-xs uppercase tracking-widest hover:bg-accent transition-colors">Notify Me</button>
            </form>
            <div id="back-in-stock-feedback" class="text-[10px] h-4"></div>
        </div>
                <?php
    }
}
add_action( 'woocommerce_single_product_summary', 'colton_research_back_in_stock_form', 31 );

/**
 * Custom Size Selection Logic
 */
function colton_research_add_size_selection() {
    global $product;
    $sizes = array(
        '10mg' => array('label' => '10mg', 'price_mod' => 1),
        '20mg' => array('label' => '20mg', 'price_mod' => 1.8),
        '30mg' => array('label' => '30mg', 'price_mod' => 2.5),
    );
    $base_price = $product->get_price();
    ?>
    <div class="product-size-selection space-y-4 mb-8">
        <label class="block text-xl font-bold text-black mb-4 font-body">Size</label>
        <div class="flex flex-wrap gap-4" id="size-swatches">
            <?php foreach ( $sizes as $key => $size ) : 
                $display_price = $base_price * $size['price_mod'];
            ?>
                <button type="button" 
                        class="size-swatch-btn min-w-[100px] px-6 py-4 rounded-[20px] border border-border bg-white text-black font-bold text-lg transition-all hover:border-[#02669e] <?php echo $key === '10mg' ? 'active-swatch' : ''; ?>" 
                        data-size="<?php echo esc_attr( $key ); ?>"
                        data-price="<?php echo esc_attr( $display_price ); ?>"
                        data-formatted-price="<?php echo esc_attr( wc_price( $display_price ) ); ?>">
                    <?php echo esc_html( $size['label'] ); ?>
                </button>
            <?php endforeach; ?>
        </div>
        <input type="hidden" name="selected_product_size" id="selected-product-size" value="10mg">
    </div>
        <?php
}
add_action( 'woocommerce_single_product_summary', 'colton_research_add_size_selection', 25 );

function colton_research_add_cart_item_data( $cart_item_data, $product_id, $variation_id ) {
    if ( isset( $_POST['selected_product_size'] ) ) {
        $cart_item_data['selected_size'] = sanitize_text_field( $_POST['selected_product_size'] );
    }
    return $cart_item_data;
}
add_filter( 'woocommerce_add_cart_item_data', 'colton_research_add_cart_item_data', 10, 3 );

function colton_research_get_item_data( $item_data, $cart_item ) {
    if ( isset( $cart_item['selected_size'] ) ) {
        $item_data[] = array(
            'key'   => __( 'Size', 'woocommerce' ),
            'value' => wc_clean( $cart_item['selected_size'] ),
        );
    }
    return $item_data;
}
add_filter( 'woocommerce_get_item_data', 'colton_research_get_item_data', 10, 2 );

function colton_research_before_calculate_totals( $cart ) {
    if ( is_admin() && ! defined( 'DOING_AJAX' ) ) return;
    foreach ( $cart->get_cart() as $cart_item ) {
        if ( isset( $cart_item['selected_size'] ) ) {
            $base_price = $cart_item['data']->get_price();
            $size = $cart_item['selected_size'];
            $price_mods = array('10mg' => 1, '20mg' => 1.8, '30mg' => 2.5);
            if ( isset( $price_mods[$size] ) ) {
                $cart_item['data']->set_price( $base_price * $price_mods[$size] );
            }
        }
    }
}
add_action( 'woocommerce_before_calculate_totals', 'colton_research_before_calculate_totals', 10, 1 );

/**
 * Product Archive Excerpt
 */
function colton_research_show_excerpt_in_archive() {
    global $product;
    if ( $product->get_short_description() ) {
        echo '<div class="product-short-description text-xs text-muted-foreground mt-2 line-clamp-2 leading-relaxed">';
        echo apply_filters( 'woocommerce_short_description', $product->get_short_description() );
        echo '</div>';
    }
}
add_action( 'woocommerce_after_shop_loop_item_title', 'colton_research_show_excerpt_in_archive', 12 );

/**
 * Scientific Details
 */
function colton_research_product_scientific_details() {
    ?>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-8 border-t border-border pt-8">
        <div class="space-y-4">
            <h4 class="text-xs font-bold uppercase tracking-[0.2em] text-primary">Technical Specs</h4>
            <div class="space-y-2">
                <div class="flex justify-between text-xs py-2 border-b border-border/50">
                    <span class="text-muted-foreground">Purity Level</span>
                    <span class="text-foreground font-medium">≥98% HPLC Verified</span>
                </div>
                <div class="flex justify-between text-xs py-2 border-b border-border/50">
                    <span class="text-muted-foreground">Formulation</span>
                    <span class="text-foreground font-medium">Lyophilized Powder</span>
                </div>
                <div class="flex justify-between text-xs py-2 border-b border-border/50">
                    <span class="text-muted-foreground">Storage</span>
                    <span class="text-foreground font-medium">-20°C Recommended</span>
                </div>
            </div>
        </div>
        <div class="space-y-4">
            <h4 class="text-xs font-bold uppercase tracking-[0.2em] text-primary">Certifications</h4>
            <div class="flex flex-wrap gap-2">
                <span class="px-3 py-1 bg-secondary/50 rounded-full text-[10px] font-bold text-foreground border border-border uppercase">HPLC Tested</span>
                <span class="px-3 py-1 bg-secondary/50 rounded-full text-[10px] font-bold text-foreground border border-border uppercase">MS Verified</span>
                <span class="px-3 py-1 bg-secondary/50 rounded-full text-[10px] font-bold text-foreground border border-border uppercase">cGMP Mfg</span>
            </div>
            <p class="text-[10px] text-muted-foreground leading-relaxed italic">Batch-specific COA included with every shipment.</p>
        </div>
    </div>
    <?php
}
add_action( 'woocommerce_after_single_product_summary', 'colton_research_product_scientific_details', 5 );

/**
 * Pricing visibility logic
 */
function colton_research_hide_regular_price( $price, $product ) {
    if ( $product->is_on_sale() ) $price = wc_price( $product->get_sale_price() );
    return $price;
}
add_filter( 'woocommerce_get_price_html', 'colton_research_hide_regular_price', 100, 2 );

/**
 * Terms and Conditions
 */
function colton_research_terms_and_conditions_field() {
    $terms_page_id = get_option( 'woocommerce_terms_and_conditions_page_id' );
    if ( $terms_page_id ) {
        woocommerce_form_field( 'terms', array(
            'type'          => 'checkbox',
            'class'         => array('form-row', 'terms', 'wc-terms-and-conditions'),
            'label'         => sprintf( __( 'I have read and agree to the website <a href="%s" target="_blank">terms and conditions</a>', 'woocommerce' ), esc_url( get_permalink( $terms_page_id ) ) ),
            'required'      => true,
        ), 组件()->checkout->get_value( 'terms' ) ); // Note: WC()->checkout error fix in original code? using WC() directly
    }
}
// Fix typo from original code copy: 组件 -> WC()
add_action( 'woocommerce_checkout_terms_and_conditions', 'colton_research_terms_and_conditions_field', 10 );

function colton_research_terms_and_conditions_validation() {
    if ( ! isset( $_POST['terms'] ) ) {
        wc_add_notice( __( 'Please read and accept the terms and conditions to proceed with your order.', 'woocommerce' ), 'error' );
    }
}
add_action( 'woocommerce_checkout_process', 'colton_research_terms_and_conditions_validation' );
