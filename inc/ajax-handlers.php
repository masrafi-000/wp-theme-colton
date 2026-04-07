<?php
/**
 * AJAX Handlers for Various Theme Interactions
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * AJAX Search for Products in Header
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
                    <?php the_post_thumbnail( 'thumbnail' ); ?>
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
 * AJAX Mini Cart Fragments
 */
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
add_filter( 'woocommerce_add_to_cart_fragments', 'colton_research_cart_fragments' );

/**
 * AJAX Update Cart Qty
 */
function colton_update_cart_qty() {
    $cart_item_key = sanitize_text_field( $_POST['cart_item_key'] );
    $qty = intval( $_POST['qty'] );
    if ( $cart_item_key && $qty > 0 ) {
        WC()->cart->set_quantity( $cart_item_key, $qty );
        WC_AJAX::get_refreshed_fragments();
    }
    wp_die();
}
add_action( 'wp_ajax_colton_update_cart_qty', 'colton_update_cart_qty' );
add_action( 'wp_ajax_nopriv_colton_update_cart_qty', 'colton_update_cart_qty' );

/**
 * AJAX Contact Form Submission
 */
function colton_research_contact_submission() {
    if ( ! check_ajax_referer( 'colton_contact_nonce', 'contact_nonce', false ) ) {
        wp_send_json_error( 'Security check failed.', 403 );
        return;
    }
    $name = sanitize_text_field( $_POST['name'] );
    $email = sanitize_email( $_POST['email'] );
    $subject = sanitize_text_field( $_POST['subject'] );
    $message = sanitize_textarea_field( $_POST['message'] );

    $post_id = wp_insert_post( array(
        'post_title'   => $subject ? $subject : "New Inquiry from $name",
        'post_type'    => 'colton_inquiry',
        'post_content' => "From: $name <$email>\n\n$message",
        'post_status'  => 'publish',
    ));

    if ( ! is_wp_error( $post_id ) ) {
        update_post_meta( $post_id, '_inquiry_email', $email );
        update_post_meta( $post_id, '_inquiry_name', $name );
        wp_send_json_success( 'Your message has been sent successfully.' );
    } else {
        wp_send_json_error( 'Something went wrong.', 500 );
    }
    wp_die();
}
add_action( 'wp_ajax_colton_contact_submission', 'colton_research_contact_submission' );
add_action( 'wp_ajax_nopriv_colton_contact_submission', 'colton_research_contact_submission' );

/**
 * AJAX Newsletter Signup
 */
function colton_research_newsletter_signup() {
    if ( ! check_ajax_referer( 'colton_newsletter_nonce', 'newsletter_nonce', false ) ) {
        wp_send_json_error( 'Invalid security token.', 403 );
        return;
    }
    $email = sanitize_email( $_POST['email'] );
    if ( ! is_email( $email ) ) {
        wp_send_json_error( 'Invalid email address.', 400 );
        return;
    }
    if ( get_page_by_title( $email, OBJECT, 'colton_subscription' ) ) {
        wp_send_json_error( 'Already subscribed.', 409 );
        return;
    }
    $post_id = wp_insert_post( array(
        'post_title'  => $email,
        'post_type'   => 'colton_subscription',
        'post_status' => 'publish',
    ));
    if ( is_wp_error( $post_id ) ) wp_send_json_error( 'Database error.', 500 );
    else wp_send_json_success( 'Thank you for subscribing!' );
    wp_die();
}
add_action( 'wp_ajax_colton_newsletter_signup', 'colton_research_newsletter_signup' );
add_action('wp_ajax_nopriv_colton_newsletter_signup', 'colton_research_newsletter_signup' );


/**
 * Mailchimp Integration for Custom Popup Form
 */
function send_data_to_mailchimp_api($email)
{
    $api_key = get_option('mailchimp_api_key');
    $list_id = get_option('mailchimp_list_id');
    
    if (!$api_key || !$list_id) {
        return false;
    }

    $server_prefix = substr($api_key, strpos($api_key, '-') + 1);
    $url = 'https://' . $server_prefix . '.api.mailchimp.com/3.0/lists/' . $list_id . '/members/';

    $body = json_encode([
        'email_address' => $email,
        'status'        => 'subscribed',
    ]);

    $response = wp_remote_post($url, [
        'method'      => 'POST',
        'headers'     => [
            'Authorization' => 'Basic ' . base64_encode('user:' . $api_key),
            'Content-Type'  => 'application/json',
        ],
        'body'        => $body,
    ]);

    return $response;
}

add_action('wp_ajax_my_popup_form', 'my_popup_form_handler');
add_action('wp_ajax_nopriv_my_popup_form', 'my_popup_form_handler');

function my_popup_form_handler()
{
    if (isset($_POST['email'])) {
        $email = sanitize_email($_POST['email']);
        
        // Send to Mailchimp
        send_data_to_mailchimp_api($email);

        // Also save locally for the theme's Subscriptions menu
        if ( ! get_page_by_title( $email, OBJECT, 'colton_subscription' ) ) {
            wp_insert_post( array(
                'post_title'  => $email,
                'post_type'   => 'colton_subscription',
                'post_status' => 'publish',
            ));
        }

    }
    wp_die();
}

/**
 * AJAX: get cart item count
 */
function mytheme_get_cart_count() {
    $count = class_exists( 'WooCommerce' ) ? WC()->cart->get_cart_contents_count() : 0;
    wp_send_json( [ 'count' => $count ] );
}
add_action( 'wp_ajax_get_cart_count',        'mytheme_get_cart_count' );
add_action( 'wp_ajax_nopriv_get_cart_count', 'mytheme_get_cart_count' );

/**
 * AJAX: WooCommerce Search Products (JSON)
 * Required by the new header.js search logic
 */
function mytheme_woocommerce_search_products() {
    $term = sanitize_text_field( $_GET['term'] );
    
    if ( empty( $term ) ) {
        wp_send_json_success( [] );
    }

    $args = array(
        'post_type'      => 'product',
        'post_status'    => 'publish',
        's'              => $term,
        'posts_per_page' => 10,
    );

    $query = new WP_Query( $args );
    $results = [];

    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $product = wc_get_product( get_the_ID() );
            if ( ! $product ) continue;
            
            $results[] = [
                'url'   => get_permalink(),
                'name'  => get_the_title(),
                'price' => $product->get_price_html(),
                'image' => get_the_post_thumbnail_url( get_the_ID(), 'thumbnail' )
            ];
        }
    }

    wp_reset_postdata();
    wp_send_json_success( $results );
}
add_action( 'wp_ajax_woocommerce_search_products',        'mytheme_woocommerce_search_products' );
add_action( 'wp_ajax_nopriv_woocommerce_search_products', 'mytheme_woocommerce_search_products' );
