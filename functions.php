<?php
/**
 * Colton Research Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Colton_Research
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function colton_research_setup() {


    

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'colton-research' ),
			'footer-menu' => esc_html__( 'Footer Menu', 'colton-research' ),
		)
	);

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'colton_research_setup' );

/**
 * Enqueue scripts and styles.
 */
function colton_research_scripts() {
	// Enqueue Google Fonts
	wp_enqueue_style( 'colton-fonts', 'https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@400;500;600;700&display=swap', array(), null );

	// Enqueue main stylesheet
	wp_enqueue_style( 'colton-research-style', get_stylesheet_uri(), array(), '1.0.0' );

    // Enqueue Tailwind output CSS
    wp_enqueue_style( 'colton-tailwind', get_template_directory_uri() . '/src/output.css', array(), '1.0.0' );

	// Enqueue jQuery
	wp_enqueue_script( 'jquery' );
    
    // Custom script for variation buttons and other UI enhancements
    wp_add_inline_script( 'colton-research-style', "
        (function($) {
            $(document).ready(function() {
                // Convert variation selects to buttons
                function initVariationButtons() {
                    const variationForms = document.querySelectorAll('.variations_form');
                    variationForms.forEach(form => {
                        const selects = form.querySelectorAll('.variations select');
                        selects.forEach(select => {
                            if (select.nextElementSibling && select.nextElementSibling.classList.contains('variation-buttons-container')) return;
                            
                            const container = document.createElement('div');
                            container.className = 'variation-buttons-container flex flex-wrap gap-4 mt-2 mb-6';
                            
                            const options = select.querySelectorAll('option');
                            options.forEach(option => {
                                if (!option.value) return;
                                
                                const btn = document.createElement('button');
                                btn.type = 'button';
                                btn.className = 'variation-btn min-w-[100px] px-6 py-4 rounded-[20px] border border-border bg-white text-black font-bold text-lg transition-all hover:border-[#02669e]';
                                btn.textContent = option.textContent;
                                btn.dataset.value = option.value;
                                
                                btn.addEventListener('click', (e) => {
                                    e.preventDefault();
                                    select.value = btn.dataset.value;
                                    $(select).trigger('change');
                                    
                                    container.querySelectorAll('.variation-btn').forEach(b => {
                                        b.classList.remove('active-swatch');
                                    });
                                    btn.classList.add('active-swatch');
                                });
                                
                                if (select.value === option.value) {
                                    btn.classList.add('active-swatch');
                                }
                                
                                container.appendChild(btn);
                            });
                            
                            select.style.display = 'none';
                            const label = select.closest('tr') ? select.closest('tr').querySelector('.label label') : null;
                            if (label) {
                                label.classList.add('block', 'text-xl', 'font-bold', 'text-black', 'mb-4');
                                label.style.fontFamily = \"'Outfit', sans-serif\";
                            }
                            
                            select.parentNode.appendChild(container);
                        });

                        // Clear active state if WooCommerce resets the form
                        $('.variations_form').on('reset_data', function() {
                            $('.variation-btn').removeClass('active-swatch');
                        });
                    });
                }

                initVariationButtons();
                // Re-run when WooCommerce updates variations
                $(document).on('updated_variation_data', function() {
                    initVariationButtons();
                    enhanceQuantityInputs();
                });

                // Enhanced Quantity Input (+/- buttons)
                function enhanceQuantityInputs() {
                    const qtyInputs = document.querySelectorAll('div.quantity:not(.enhanced)');
                    qtyInputs.forEach(qty => {
                        qty.classList.add('enhanced', 'flex', 'items-center', 'border', 'border-border', 'rounded-lg', 'overflow-hidden', 'bg-white', 'w-fit');
                        const input = qty.querySelector('input');
                        input.className = 'w-12 h-10 text-center border-none bg-transparent focus:ring-0 text-black font-bold';
                        
                        const minusBtn = document.createElement('button');
                        minusBtn.type = 'button';
                        minusBtn.className = 'w-10 h-10 flex items-center justify-center text-black hover:text-primary transition-colors border-r border-border bg-secondary/30';
                        minusBtn.innerHTML = '<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><line x1=\"5\" y1=\"12\" x2=\"19\" y2=\"12\"/></svg>';
                        
                        const plusBtn = document.createElement('button');
                        plusBtn.type = 'button';
                        plusBtn.className = 'w-10 h-10 flex items-center justify-center text-black hover:text-primary transition-colors border-l border-border bg-secondary/30';
                        plusBtn.innerHTML = '<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><line x1=\"12\" y1=\"5\" x2=\"12\" y2=\"19\"/><line x1=\"5\" y1=\"12\" x2=\"19\" y2=\"12\"/></svg>';
                        
                        qty.insertBefore(minusBtn, input);
                        qty.appendChild(plusBtn);
                        
                        minusBtn.addEventListener('click', () => {
                            const val = parseInt(input.value);
                            if (val > 1) {
                                input.value = val - 1;
                                input.dispatchEvent(new Event('change', { bubbles: true }));
                            }
                        });
                        
                        plusBtn.addEventListener('click', () => {
                            const val = parseInt(input.value);
                            input.value = val + 1;
                            input.dispatchEvent(new Event('change', { bubbles: true }));
                        });
                    });
                }
                
                enhanceQuantityInputs();
            });
        })(jQuery);
    " );
}
add_action( 'wp_enqueue_scripts', 'colton_research_scripts' );

/**
 * WooCommerce support
 */
function colton_research_woocommerce_setup() {
	add_theme_support( 'woocommerce' );
    
    // Disable WooCommerce default styles for full control with Tailwind
    add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

    // Disable WooCommerce Blocks for Cart and Checkout to use theme templates
    add_filter( 'woocommerce_is_checkout_block_default', '__return_false' );
    add_filter( 'woocommerce_is_cart_block_default', '__return_false' );

    // add_theme_support( 'wc-product-gallery-zoom' );
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
    
    // Consider a product "new" if it was created in the last 30 days
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

// Remove default WooCommerce "Sale!" flash from shop loop and single product
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );

/**
 * Custom WooCommerce Add to Cart Button Text and Icon
 */
function colton_research_add_to_cart_text( $text, $product ) {
    if ( is_single() ) {
        return esc_html__( 'ADD TO CART', 'woocommerce' );
    }
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
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const form = document.getElementById('back-in-stock-form');
                const feedback = document.getElementById('back-in-stock-feedback');
                if (form) {
                    form.addEventListener('submit', function(e) {
                        e.preventDefault();
                        feedback.textContent = 'Registering your interest...';
                        feedback.className = 'text-[10px] h-4 text-muted-foreground';
                        
                        // Simulate AJAX call
                        setTimeout(() => {
                            feedback.textContent = 'Success! We will notify you when this product is back in stock.';
                            feedback.className = 'text-[10px] h-4 text-green-500 font-medium';
                            form.reset();
                        }, 1000);
                    });
                }
            });
        </script>
        <?php
    }
}
add_action( 'woocommerce_single_product_summary', 'colton_research_back_in_stock_form', 31 );

/**
 * Custom Size Selection for Products
 */
function colton_research_add_size_selection() {
    global $product;
    
    // Define sizes and their price multipliers or fixed prices
    // For this example, we'll use multipliers based on the base price
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

    <script>
        (function($) {
            $(document).ready(function() {
                $('.size-swatch-btn').on('click', function() {
                    const btn = $(this);
                    const size = btn.data('size');
                    const price = btn.data('price');
                    const formattedPrice = btn.data('formatted-price');
                    
                    // Update active state
                    $('.size-swatch-btn').removeClass('active-swatch');
                    btn.addClass('active-swatch');
                    
                    // Update hidden input
                    $('#selected-product-size').val(size);
                    
                    // Update price display
                    // WooCommerce price usually has a specific class or structure
                    const priceElement = $('.summary .price');
                    if (priceElement.length) {
                        priceElement.html(formattedPrice);
                    }
                });
            });
        })(jQuery);
    </script>
    <style>
        .active-swatch {
            border-color: #02669e !important;
            background-color: #f0f9ff !important;
            box-shadow: 0 0 0 1px #02669e;
        }
    </style>
    <?php
}
add_action( 'woocommerce_single_product_summary', 'colton_research_add_size_selection', 25 );

/**
 * Save selected size to cart item data
 */
function colton_research_add_cart_item_data( $cart_item_data, $product_id, $variation_id ) {
    if ( isset( $_POST['selected_product_size'] ) ) {
        $cart_item_data['selected_size'] = sanitize_text_field( $_POST['selected_product_size'] );
    }
    return $cart_item_data;
}
add_filter( 'woocommerce_add_cart_item_data', 'colton_research_add_cart_item_data', 10, 3 );

/**
 * Display selected size in cart and checkout
 */
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

/**
 * Update price based on selected size
 */
function colton_research_before_calculate_totals( $cart ) {
    if ( is_admin() && ! defined( 'DOING_AJAX' ) ) {
        return;
    }

    foreach ( $cart->get_cart() as $cart_item ) {
        if ( isset( $cart_item['selected_size'] ) ) {
            $product = $cart_item['data'];
            $base_price = $product->get_price();
            $size = $cart_item['selected_size'];
            
            $price_mods = array(
                '10mg' => 1,
                '20mg' => 1.8,
                '30mg' => 2.5,
            );
            
            if ( isset( $price_mods[$size] ) ) {
                $new_price = $base_price * $price_mods[$size];
                $cart_item['data']->set_price( $new_price );
            }
        }
    }
}
add_action( 'woocommerce_before_calculate_totals', 'colton_research_before_calculate_totals', 10, 1 );

/**
 * Register Sidebars
 */
function colton_research_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Shop Sidebar', 'colton-research' ),
			'id'            => 'shop-sidebar',
			'description'   => esc_html__( 'Add widgets here for product filtering.', 'colton-research' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s colton-categories-sidebar">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
}
add_action( 'widgets_init', 'colton_research_widgets_init' );

/**
 * Show short description on product archive
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
 * Scientific Details Section on Single Product Page
 */
function colton_research_product_scientific_details() {
	global $product;
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
			<p class="text-[10px] text-muted-foreground leading-relaxed italic">Batch-specific COA included with every shipment. Sterility and endotoxin testing performed on all production runs.</p>
		</div>
	</div>
	<?php
}
add_action( 'woocommerce_after_single_product_summary', 'colton_research_product_scientific_details', 5 );

/**
 * Custom Search Ajax for Header (Placeholder for later JS)
 */
function colton_research_ajax_search() {
    $search_query = sanitize_text_field( $_POST['query'] );
    $args = array(
        'post_type' => 'product',
        's' => $search_query,
        'posts_per_page' => 5,
    );
    $query = new WP_Query( $args );
    
    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post();
            global $product;
            ?>
            <a href="<?php the_permalink(); ?>" class="flex items-center gap-4 p-4 hover:bg-secondary/50 transition-colors border-b border-border/50 last:border-0">
                <div class="w-12 h-12 bg-card rounded-lg p-2 flex items-center justify-center shrink-0">
                    <?php the_post_thumbnail( 'thumbnail', array( 'class' => 'max-h-full w-auto' ) ); ?>
                </div>
                <div class="flex-1 min-w-0">
                    <h4 class="text-sm font-bold text-foreground truncate"><?php the_title(); ?></h4>
                    <p class="text-xs text-primary font-medium"><?php echo $product->get_price_html(); ?></p>
                </div>
            </a>
            <?php
        }
    } else {
        echo '<div class="p-6 text-center text-muted-foreground text-sm">No research data found matching your query.</div>';
    }
    wp_die();
}
add_action( 'wp_ajax_colton_search', 'colton_research_ajax_search' );
add_action( 'wp_ajax_nopriv_colton_search', 'colton_research_ajax_search' );

/**
 * Customizer Settings for Promotional Banners
 */
function colton_research_customize_register( $wp_customize ) {
    // Add Section
    $wp_customize->add_section( 'colton_promotions', array(
        'title'    => esc_html__( 'Promotional Banners', 'colton-research' ),
        'priority' => 30,
    ) );

    // Setting: Hero Title
    $wp_customize->add_setting( 'hero_title', array(
        'default'           => 'Research Peptides',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'hero_title', array(
        'label'    => esc_html__( 'Hero Title', 'colton-research' ),
        'section'  => 'colton_promotions',
        'type'     => 'text',
    ) );

    // Setting: Hero Subtitle
    $wp_customize->add_setting( 'hero_subtitle', array(
        'default'           => 'Premium Quality',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'hero_subtitle', array(
        'label'    => esc_html__( 'Hero Subtitle', 'colton-research' ),
        'section'  => 'colton_promotions',
        'type'     => 'text',
    ) );

    // Setting: Top Bar Promo
    $wp_customize->add_setting( 'top_bar_promo', array(
        'default'           => 'Free shipping on orders over $200 • Research use only',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'top_bar_promo', array(
        'label'    => esc_html__( 'Top Bar Promotion Text', 'colton-research' ),
        'section'  => 'colton_promotions',
        'type'     => 'text',
    ) );

    // Setting: WhatsApp Number
    $wp_customize->add_setting( 'whatsapp_number', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'whatsapp_number', array(
        'label'       => esc_html__( 'WhatsApp Number (for Live Chat)', 'colton-research' ),
        'description' => esc_html__( 'Enter your phone number with country code (e.g. 15551234567). If empty, the chat button will go to the contact page.', 'colton-research' ),
        'section'     => 'colton_promotions',
        'type'        => 'text',
    ) );
}
add_action( 'customize_register', 'colton_research_customize_register' );

/**
 * Floating Live Chat Button (Placeholder/Themed Contact Button)
 */
function colton_research_floating_chat() {
    ?>
    <div class="fixed bottom-8 right-8 z-[100]">
        <button id="live-chat-toggle" class="bg-primary text-primary-foreground p-4 rounded-full shadow-2xl hover:scale-110 transition-all duration-300 group flex items-center gap-3">
            <div class="relative">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6"><path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z"/><path d="M8 12h.01"/><path d="M12 12h.01"/><path d="M16 12h.01"/></svg>
                <span class="absolute -top-1 -right-1 h-3 w-3 bg-green-500 border-2 border-primary rounded-full"></span>
            </div>
            <span class="max-w-0 overflow-hidden group-hover:max-w-xs transition-all duration-500 whitespace-nowrap text-sm font-bold uppercase tracking-widest">Scientific Support</span>
        </button>
        
        <div id="live-chat-panel" class="absolute bottom-20 right-0 w-80 bg-card border border-border rounded-2xl shadow-2xl overflow-hidden opacity-0 invisible translate-y-4 transition-all duration-300">
            <div class="bg-primary p-6 text-primary-foreground">
                <h3 class="font-display font-bold text-lg leading-tight">Laboratory Support</h3>
                <p class="text-xs opacity-80 mt-1 uppercase tracking-widest font-medium">Expert research assistance</p>
            </div>
            <div class="p-6 space-y-4">
                <div class="flex items-start gap-3 p-3 bg-secondary/50 rounded-lg border border-border/50">
                    <div class="h-2 w-2 bg-green-500 rounded-full mt-1.5 shrink-0 animate-pulse"></div>
                    <p class="text-[13px] text-muted-foreground leading-relaxed">Our scientific team is currently online to answer your technical questions.</p>
                </div>
                <?php 
                $whatsapp = get_theme_mod( 'whatsapp_number', '' );
                $chat_url = !empty($whatsapp) ? 'https://wa.me/' . preg_replace('/[^0-9]/', '', $whatsapp) . '?text=Hi, I have a research question about your peptides.' : home_url( '/contact' );
                $btn_text = !empty($whatsapp) ? 'Chat on WhatsApp' : 'Start Conversation';
                ?>
                <a href="<?php echo esc_url( $chat_url ); ?>" <?php echo !empty($whatsapp) ? 'target="_blank"' : ''; ?> class="block w-full bg-primary text-primary-foreground text-center py-3 rounded-lg font-bold text-xs uppercase tracking-widest hover:bg-gold-light transition-colors"><?php echo esc_html($btn_text); ?></a>
                <p class="text-[10px] text-center text-muted-foreground">Typical response time: <span class="text-foreground font-medium">Under 15 mins</span></p>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const chatToggle = document.getElementById('live-chat-toggle');
            const chatPanel = document.getElementById('live-chat-panel');
            if (chatToggle && chatPanel) {
                chatToggle.addEventListener('click', (e) => {
                    e.stopPropagation();
                    chatPanel.classList.toggle('opacity-0');
                    chatPanel.classList.toggle('invisible');
                    chatPanel.classList.toggle('translate-y-4');
                });
                document.addEventListener('click', (e) => {
                    if (!chatPanel.contains(e.target) && e.target !== chatToggle) {
                        chatPanel.classList.add('opacity-0', 'invisible', 'translate-y-4');
                    }
                });
            }
        });
    </script>
    <?php
}
add_action( 'wp_footer', 'colton_research_floating_chat' );

/**
 * Account Creation Discount Logic
 */
function colton_research_account_discount_message() {
    if ( ! is_user_logged_in() ) {
        ?>
        <div class="bg-primary/10 border border-primary/20 rounded-xl p-6 mb-8 flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="space-y-1">
                <h3 class="text-lg font-bold text-primary">Join the Research Community</h3>
                <p class="text-sm text-muted-foreground">Create an account today and receive a 10% discount on your first order.</p>
            </div>
            <div class="flex gap-4">
                <a href="<?php echo esc_url( wp_registration_url() ); ?>" class="bg-primary text-primary-foreground px-6 py-3 rounded-lg font-bold text-xs uppercase tracking-widest hover:bg-accent transition-colors">Create Account</a>
                <button class="text-muted-foreground hover:text-foreground text-xs font-bold uppercase tracking-widest transition-colors">Continue as Guest</button>
            </div>
        </div>
        <?php
    }
}
// This can be added to the cart or checkout page
add_action( 'woocommerce_before_cart', 'colton_research_account_discount_message' );
add_action( 'woocommerce_before_checkout_form', 'colton_research_account_discount_message' );

/**
 * Apply Account Creation Discount (Example using a coupon code)
 * Note: You would need to create a coupon named 'WELCOME10' in WooCommerce admin
 */
function colton_research_apply_registration_discount( $user_id ) {
    // This is just a placeholder logic. Usually, you'd email them a code.
}
add_action( 'user_register', 'colton_research_apply_registration_discount' );

/**
 * Bulk Savings & Free Shipping Progress Logic
 */
function colton_research_get_cart_progress_data() {
    if ( ! class_exists( 'WooCommerce' ) || ! WC()->cart ) {
        return null;
    }

    $subtotal = WC()->cart->get_subtotal();
    $item_count = WC()->cart->get_cart_contents_count();
    
    // Free Shipping Progress
    $free_shipping_threshold = 200; // $200
    $free_shipping_percent = min( 100, ( $subtotal / $free_shipping_threshold ) * 100 );
    $amount_remaining = max( 0, $free_shipping_threshold - $subtotal );

    // Bulk Savings Milestones
    $milestones = [
        ['qty' => 1, 'discount' => 3],
        ['qty' => 5, 'discount' => 6],
        ['qty' => 7, 'discount' => 9],
        ['qty' => 9, 'discount' => 12],
    ];

    $current_discount = 0;
    $next_milestone = null;

    foreach ( $milestones as $milestone ) {
        if ( $item_count >= $milestone['qty'] ) {
            $current_discount = $milestone['discount'];
        } else {
            $next_milestone = $milestone;
            break;
        }
    }

    return [
        'subtotal' => $subtotal,
        'item_count' => $item_count,
        'free_shipping' => [
            'percent' => $free_shipping_percent,
            'remaining' => $amount_remaining,
            'threshold' => $free_shipping_threshold,
        ],
        'bulk_savings' => [
            'milestones' => $milestones,
            'current_discount' => $current_discount,
            'next_milestone' => $next_milestone,
        ]
    ];
}

/**
 * AJAX Update Cart Fragments
 */
add_filter( 'woocommerce_add_to_cart_fragments', 'colton_research_cart_fragments' );
function colton_research_cart_fragments( $fragments ) {
    ob_start();
    ?>
    <span class="cart-count-badge absolute top-0 right-0 bg-primary text-primary-foreground text-[10px] font-bold rounded-full h-4 w-4 flex items-center justify-center <?php echo ( WC()->cart->get_cart_contents_count() > 0 ) ? '' : 'hidden'; ?>">
        <?php echo WC()->cart->get_cart_contents_count(); ?>
    </span>
    <?php
    $fragments['.cart-count-badge'] = ob_get_clean();

    ob_start();
    ?>
    <div id="mini-cart-content" class="flex-1 overflow-y-auto custom-scrollbar">
        <?php woocommerce_mini_cart(); ?>
    </div>
    <?php
    $fragments['#mini-cart-content'] = ob_get_clean();

    return $fragments;
}

/**
 * AJAX Update Cart Quantity
 */
add_action( 'wp_ajax_colton_update_cart_qty', 'colton_update_cart_qty' );
add_action( 'wp_ajax_nopriv_colton_update_cart_qty', 'colton_update_cart_qty' );
function colton_update_cart_qty() {
    $cart_item_key = sanitize_text_field( $_POST['cart_item_key'] );
    $qty = intval( $_POST['qty'] );

    if ( $cart_item_key && $qty > 0 ) {
        WC()->cart->set_quantity( $cart_item_key, $qty );
        WC_AJAX::get_refreshed_fragments();
    }
    wp_die();
}

/**
 * User Email Verification Logic
 */

// 1. Add verification status to user meta on registration
add_action( 'woocommerce_created_customer', 'colton_research_add_verification_meta', 10, 3 );
function colton_research_add_verification_meta( $customer_id, $new_customer_data, $password_generated ) {
    update_user_meta( $customer_id, '_is_email_verified', 'no' );
    
    // Generate verification token
    $token = wp_generate_password( 32, false );
    update_user_meta( $customer_id, '_email_verification_token', $token );
    
    // Send verification email
    colton_research_send_verification_email( $customer_id, $token );
}

// 2. Function to send verification email
function colton_research_send_verification_email( $user_id, $token ) {
    $user = get_userdata( $user_id );
    $email = $user->user_email;
    $verification_url = add_query_arg( array(
        'action' => 'verify_email',
        'token'  => $token,
        'user'   => $user_id
    ), wc_get_page_permalink( 'myaccount' ) );

    $subject = 'Verify your email - Colton Research';
    $message = "Hello " . $user->display_name . ",\n\n";
    $message .= "Thank you for registering. Please click the link below to verify your email address:\n\n";
    $message .= $verification_url . "\n\n";
    $message .= "If you did not create an account, please ignore this email.";

    wp_mail( $email, $subject, $message );
}

// 3. Handle verification link click
add_action( 'template_redirect', 'colton_research_handle_email_verification' );
function colton_research_handle_email_verification() {
    if ( isset( $_GET['action'] ) && $_GET['action'] == 'verify_email' && isset( $_GET['token'] ) && isset( $_GET['user'] ) ) {
        $user_id = intval( $_GET['user'] );
        $token = sanitize_text_field( $_GET['token'] );
        $saved_token = get_user_meta( $user_id, '_email_verification_token', true );

        if ( $token === $saved_token ) {
            update_user_meta( $user_id, '_is_email_verified', 'yes' );
            delete_user_meta( $user_id, '_email_verification_token' );
            wc_add_notice( 'Your email has been verified! You can now access all features.', 'success' );
        } else {
            wc_add_notice( 'Invalid or expired verification link.', 'error' );
        }
        
        wp_redirect( wc_get_page_permalink( 'myaccount' ) );
        exit;
    }
}

// 4. Restrict checkout/actions for unverified users
add_action( 'woocommerce_checkout_process', 'colton_research_restrict_unverified_checkout' );
function colton_research_restrict_unverified_checkout() {
    if ( is_user_logged_in() ) {
        $user_id = get_current_user_id();
        $is_verified = get_user_meta( $user_id, '_is_email_verified', true );
        if ( $is_verified !== 'yes' ) {
            wc_add_notice( 'Please verify your email address before placing an order.', 'error' );
        }
    }
}

// 5. Force enable registration on my account page
add_filter( 'option_woocommerce_enable_myaccount_registration', function() { return 'yes'; } );

function colton_research_create_subscription_cpt() {
    $labels = array(
        'name'                  => _x( 'Subscriptions', 'Post type general name', 'colton-research' ),
        'singular_name'         => _x( 'Subscription', 'Post type singular name', 'colton-research' ),
        'menu_name'             => _x( 'Subscriptions', 'Admin Menu text', 'colton-research' ),
        'name_admin_bar'        => _x( 'Subscription', 'Add New on Toolbar', 'colton-research' ),
    );
    $args = array(
        'labels'             => $labels,
        'public'             => false,
        'publicly_queryable' => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => false,
        'rewrite'            => false,
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 25,
        'supports'           => array( 'title' ),
        'menu_icon'          => 'dashicons-email-alt',
    );
    register_post_type( 'colton_subscription', $args );
}
add_action( 'init', 'colton_research_create_subscription_cpt' );

/**
 * Custom Post Type for Contact Inquiries
 */
function colton_research_create_inquiry_cpt() {
    $labels = array(
        'name'                  => _x( 'Inquiries', 'Post type general name', 'colton-research' ),
        'singular_name'         => _x( 'Inquiry', 'Post type singular name', 'colton-research' ),
        'menu_name'             => _x( 'Inquiries', 'Admin Menu text', 'colton-research' ),
    );
    $args = array(
        'labels'             => $labels,
        'public'             => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'supports'           => array( 'title', 'editor' ),
        'menu_icon'          => 'dashicons-testimonial',
        'menu_position'      => 26,
    );
    register_post_type( 'colton_inquiry', $args );
}
add_action( 'init', 'colton_research_create_inquiry_cpt' );

/**
 * AJAX Handler for Contact Form Submission
 */
function colton_research_contact_submission() {
    // Security check
    if ( ! check_ajax_referer( 'colton_contact_nonce', 'contact_nonce', false ) ) {
        wp_send_json_error( 'Security check failed. Please refresh the page and try again.', 403 );
        return;
    }

    // Sanitize data
    $name    = sanitize_text_field( $_POST['name'] );
    $email   = sanitize_email( $_POST['email'] );
    $subject = sanitize_text_field( $_POST['subject'] );
    $message = sanitize_textarea_field( $_POST['message'] );

    if ( empty( $name ) || ! is_email( $email ) || empty( $message ) ) {
        wp_send_json_error( 'Please fill in all required fields correctly.', 400 );
        return;
    }

    // Create inquiry post
    $post_content = "From: $name <$email>\n\nMessage:\n$message";
    $post_id = wp_insert_post( array(
        'post_title'   => $subject ? $subject : "New Inquiry from $name",
        'post_type'    => 'colton_inquiry',
        'post_content' => $post_content,
        'post_status'  => 'publish',
    ) );

    if ( ! is_wp_error( $post_id ) ) {
        // Store extra data in meta
        update_post_meta( $post_id, '_inquiry_email', $email );
        update_post_meta( $post_id, '_inquiry_name', $name );
        wp_send_json_success( 'Your message has been sent successfully. We will get back to you soon.' );
    } else {
        wp_send_json_error( 'Something went wrong. Please try again later.', 500 );
    }

    wp_die();
}
add_action( 'wp_ajax_colton_contact_submission', 'colton_research_contact_submission' );
add_action( 'wp_ajax_nopriv_colton_contact_submission', 'colton_research_contact_submission' );

/**
 * Customize Admin Columns for Inquiries
 */
function colton_research_custom_inquiry_columns( $columns ) {
    $new_columns = array(
        'cb'      => $columns['cb'],
        'title'   => 'Subject',
        'name'    => 'From Name',
        'email'   => 'Email',
        'date'    => $columns['date'],
    );
    return $new_columns;
}
add_filter( 'manage_colton_inquiry_posts_columns', 'colton_research_custom_inquiry_columns' );

function colton_research_inquiry_column_content( $column, $post_id ) {
    switch ( $column ) {
        case 'name' :
            echo esc_html( get_post_meta( $post_id, '_inquiry_name', true ) );
            break;
        case 'email' :
            echo esc_html( get_post_meta( $post_id, '_inquiry_email', true ) );
            break;
    }
}
add_action( 'manage_colton_inquiry_posts_custom_column', 'colton_research_inquiry_column_content', 10, 2 );

/**
 * AJAX Handler for Newsletter Subscription
 */
function colton_research_newsletter_signup() {
    // Nonce verification for security
    if ( ! check_ajax_referer( 'colton_newsletter_nonce', 'newsletter_nonce', false ) ) {
        wp_send_json_error( 'Invalid security token.', 403 );
        return;
    }

    // Sanitize and validate email
    $email = sanitize_email( $_POST['email'] );
    if ( ! is_email( $email ) ) {
        wp_send_json_error( 'Please enter a valid email address.', 400 );
        return;
    }

    // Check if email already exists
    $existing = get_page_by_title( $email, OBJECT, 'colton_subscription' );
    if ( $existing ) {
        wp_send_json_error( 'This email is already subscribed.', 409 );
        return;
    }

    // Create new subscription post
    $post_id = wp_insert_post( array(
        'post_title'  => $email,
        'post_type'   => 'colton_subscription',
        'post_status' => 'publish',
    ) );

    if ( is_wp_error( $post_id ) ) {
        wp_send_json_error( 'Database error. Please try again.', 500 );
    } else {
        wp_send_json_success( 'Thank you for subscribing!' );
    }

    wp_die();
}
add_action( 'wp_ajax_colton_newsletter_signup', 'colton_research_newsletter_signup' );
add_action( 'wp_ajax_nopriv_colton_newsletter_signup', 'colton_research_newsletter_signup' );

/**
 * Customize Admin Columns for Subscriptions
 */
function colton_research_custom_subscription_columns( $columns ) {
    unset( $columns['date'] );
    $columns['title'] = esc_html__( 'Email Address', 'colton-research' );
    $columns['subscription_date'] = esc_html__( 'Subscription Date', 'colton-research' );
    return $columns;
}
add_filter( 'manage_colton_subscription_posts_columns', 'colton_research_custom_subscription_columns' );

function colton_research_subscription_column_content( $column, $post_id ) {
    if ( $column == 'subscription_date' ) {
        echo get_the_date( 'F j, Y', $post_id );
    }
}
add_action( 'manage_colton_subscription_posts_custom_column', 'manage_colton_subscription_posts_custom_column_content', 10, 2 );

/**
 * Hide regular price and show only sale price
 */
function colton_research_hide_regular_price( $price, $product ) {
    if ( $product->is_on_sale() ) {
        $price = wc_price( $product->get_sale_price() );
    }
    return $price;
}
add_filter( 'woocommerce_get_price_html', 'colton_research_hide_regular_price', 100, 2 );

/**
 * Register "Size" attribute and terms (10mg, 30mg, 60mg)
 */
function colton_research_ensure_size_attribute() {
    if ( ! taxonomy_exists( 'pa_size' ) ) {
        register_taxonomy( 'pa_size', 'product', array(
            'label' => 'Size',
            'hierarchical' => false,
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => 'pa_size' ),
        ));
    }
    
    $terms = array( '10mg', '30mg', '60mg' );
    foreach ( $terms as $term ) {
        if ( ! term_exists( $term, 'pa_size' ) ) {
            wp_insert_term( $term, 'pa_size' );
        }
    }
}
add_action( 'init', 'colton_research_ensure_size_attribute' );

/**
 * Add Terms and Conditions Checkbox to Checkout
 */
function colton_research_terms_and_conditions_field() {
    $terms_page_id = get_option( 'woocommerce_terms_and_conditions_page_id' );
    if ( $terms_page_id ) {
        woocommerce_form_field( 'terms', array(
            'type'          => 'checkbox',
            'class'         => array('form-row', 'terms', 'wc-terms-and-conditions'),
            'label'         => sprintf( __( 'I have read and agree to the website <a href="%s" target="_blank">terms and conditions</a>', 'woocommerce' ), esc_url( get_permalink( $terms_page_id ) ) ),
            'required'      => true,
        ), WC()->checkout->get_value( 'terms' ) );
    }
}
add_action( 'woocommerce_checkout_terms_and_conditions', 'colton_research_terms_and_conditions_field', 10 );

/**
 * Validate Terms and Conditions Checkbox
 */
function colton_research_terms_and_conditions_validation() {
    if ( ! isset( $_POST['terms'] ) ) {
        wc_add_notice( __( 'Please read and accept the terms and conditions to proceed with your order.', 'woocommerce' ), 'error' );
    }
}
add_action( 'woocommerce_checkout_process', 'colton_research_terms_and_conditions_validation' );

