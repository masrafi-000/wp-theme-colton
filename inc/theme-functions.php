<?php
/**
 * Miscellaneous Theme Functions and logic
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Customizer Settings
 */
function colton_research_customize_register( $wp_customize ) {
    $wp_customize->add_section( 'colton_promotions', array(
        'title'    => esc_html__( 'Promotional Banners', 'colton-research' ),
        'priority' => 30,
    ));

    $wp_customize->add_setting( 'hero_title', array( 'default' => 'Research Peptides', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'hero_title', array( 'label' => 'Hero Title', 'section' => 'colton_promotions', 'type' => 'text' ) );

    $wp_customize->add_setting( 'hero_subtitle', array( 'default' => 'Premium Quality', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'hero_subtitle', array( 'label' => 'Hero Subtitle', 'section' => 'colton_promotions', 'type' => 'text' ) );

    $wp_customize->add_setting( 'top_bar_promo', array( 'default' => 'Free shipping on orders over $200', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'top_bar_promo', array( 'label' => 'Top Bar Promotion Text', 'section' => 'colton_promotions', 'type' => 'text' ) );

    $wp_customize->add_setting( 'whatsapp_number', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'whatsapp_number', array( 'label' => 'WhatsApp Number', 'section' => 'colton_promotions', 'type' => 'text' ) );
}
add_action( 'customize_register', 'colton_research_customize_register' );

/**
 * Floating Live Chat Button
 */
function colton_research_floating_chat() {
    $whatsapp = get_theme_mod( 'whatsapp_number', '' );
    $chat_url = !empty($whatsapp) ? 'https://wa.me/' . preg_replace('/[^0-9]/', '', $whatsapp) . '?text=Hi, I have a research question.' : home_url( '/contact' );
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
            <div class="bg-primary p-6 text-primary-foreground"><h3 class="font-display font-bold text-lg leading-tight">Laboratory Support</h3></div>
            <div class="p-6 space-y-4">
                <p class="text-[13px] text-muted-foreground leading-relaxed">Our scientific team is currently online.</p>
                <a href="<?php echo esc_url( $chat_url ); ?>" class="block w-full bg-primary text-primary-foreground text-center py-3 rounded-lg font-bold text-xs uppercase tracking-widest hover:bg-gold-light transition-colors">Start Conversation</a>
            </div>
        </div>
    </div>

    <?php
}
add_action( 'wp_footer', 'colton_research_floating_chat' );

/**
 * User Email Verification logic
 */
function colton_research_add_verification_meta( $customer_id, $new_customer_data, $password_generated ) {
    update_user_meta( $customer_id, '_is_email_verified', 'no' );
    $token = wp_generate_password( 32, false );
    update_user_meta( $customer_id, '_email_verification_token', $token );
    colton_research_send_verification_email( $customer_id, $token );
}
add_action( 'woocommerce_created_customer', 'colton_research_add_verification_meta', 10, 3 );

function colton_research_send_verification_email( $user_id, $token ) {
    $user = get_userdata( $user_id );
    $verification_url = add_query_arg( array('action' => 'verify_email', 'token' => $token, 'user' => $user_id), wc_get_page_permalink( 'myaccount' ) );
    wp_mail( $user->user_email, 'Verify your email - Colton Research', "Click to verify: " . $verification_url );
}

function colton_research_handle_email_verification() {
    if ( isset( $_GET['action'] ) && $_GET['action'] == 'verify_email' && isset( $_GET['token'] ) && isset( $_GET['user'] ) ) {
        $user_id = intval( $_GET['user'] );
        $token = sanitize_text_field( $_GET['token'] );
        if ( $token === get_user_meta( $user_id, '_email_verification_token', true ) ) {
            update_user_meta( $user_id, '_is_email_verified', 'yes' );
            delete_user_meta( $user_id, '_email_verification_token' );
            wc_add_notice( 'Your email has been verified!', 'success' );
        } else wc_add_notice( 'Invalid token.', 'error' );
        wp_redirect( wc_get_page_permalink( 'myaccount' ) );
        exit;
    }
}
add_action( 'template_redirect', 'colton_research_handle_email_verification' );

function colton_research_restrict_unverified_checkout() {
    if ( is_user_logged_in() && get_user_meta( get_current_user_id(), '_is_email_verified', true ) !== 'yes' ) {
        wc_add_notice( 'Please verify your email before ordering.', 'error' );
    }
}
add_action( 'woocommerce_checkout_process', 'colton_research_restrict_unverified_checkout' );

/**
 * Account Creation Discount
 */
function colton_research_account_discount_message() {
    if ( ! is_user_logged_in() ) {
        ?>
        <div class="bg-primary/10 border border-primary/20 rounded-xl p-6 mb-8 flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="space-y-1">
                <h3 class="text-lg font-bold text-primary">Join the Research Community</h3>
                <p class="text-sm text-muted-foreground">Get a 10% discount on your first order.</p>
            </div>
            <a href="<?php echo esc_url( wp_registration_url() ); ?>" class="bg-primary text-primary-foreground px-6 py-3 rounded-lg font-bold text-xs uppercase tracking-widest hover:bg-accent transition-colors">Create Account</a>
        </div>
        <?php
    }
}
add_action( 'woocommerce_before_cart', 'colton_research_account_discount_message' );
add_action( 'woocommerce_before_checkout_form', 'colton_research_account_discount_message' );

/**
 * Progress Bar and Bulk Savings Logic
 */
function colton_research_get_cart_progress_data() {
    if ( ! class_exists( 'WooCommerce' ) || ! WC()->cart ) return null;
    $subtotal = WC()->cart->get_subtotal();
    $item_count = WC()->cart->get_cart_contents_count();
    $free_shipping_threshold = 200;
    $milestones = array(
        array( 'qty' => 5, 'discount' => 5 ),
        array( 'qty' => 7, 'discount' => 8 ),
        array( 'qty' => 9, 'discount' => 12 ),
    );

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

    return array(
        'subtotal'       => $subtotal,
        'item_count'     => $item_count,
        'free_shipping'  => array(
            'percent'   => min( 100, ( $subtotal / $free_shipping_threshold ) * 100 ),
            'remaining' => max( 0, $free_shipping_threshold - $subtotal ),
        ),
        'bulk_savings'   => array(
            'current_discount' => $current_discount,
            'milestones'       => $milestones,
            'next_milestone'   => $next_milestone,
        )
    );
}
