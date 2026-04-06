<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
	return;
}

?>

<!-- Checkout Header -->
<div class="max-w-7xl mx-auto px-4 py-10 flex items-center justify-between">
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-header-logo flex items-center gap-2 group">
        <?php if ( has_custom_logo() ) : ?>
            <?php the_custom_logo(); ?>
        <?php else : ?>
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/main logo  - Edited.png" alt="<?php bloginfo( 'name' ); ?>" class="h-12 md:h-16 w-auto transition-transform group-hover:scale-105">
        <?php endif; ?>
    </a>
    <h1 class="text-xl font-display font-medium text-foreground">Checkout</h1>
</div>

<!-- Checkout Progress Stepper -->
<div class="max-w-4xl mx-auto mb-20 px-4">
    <div class="relative flex justify-between items-center">
        <!-- Progress Bar Background & Active -->
        <div class="absolute top-[18px] left-0 w-full h-[2px] progress-stepper-line -z-10 rounded-full"></div>

        <!-- Step 1 -->
        <div class="flex flex-col items-center gap-4">
            <div class="w-9 h-9 rounded-full bg-foreground text-white flex items-center justify-center font-bold text-sm shadow-lg z-10">1</div>
            <span class="text-[11px] font-bold uppercase tracking-widest text-foreground">Shopping Cart</span>
        </div>

        <!-- Step 2 -->
        <div class="flex flex-col items-center gap-4">
            <div class="w-9 h-9 rounded-full bg-foreground text-white flex items-center justify-center font-bold text-sm shadow-lg z-10 border-4 border-white ring-2 ring-brand-blue">2</div>
            <span class="text-[11px] font-bold uppercase tracking-widest text-foreground">Shipping and Checkout</span>
        </div>

        <!-- Step 3 -->
        <div class="flex flex-col items-center gap-4">
            <div class="w-9 h-9 rounded-full bg-white border-2 border-secondary text-muted-foreground flex items-center justify-center font-bold text-sm z-10">3</div>
            <span class="text-[11px] font-bold uppercase tracking-widest text-muted-foreground">Confirmation</span>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 mb-10">
    <?php do_action( 'woocommerce_before_checkout_form', $checkout ); ?>
</div>

<form name="checkout" method="post" class="checkout woocommerce-checkout max-w-7xl mx-auto px-4 flex flex-col xl:flex-row gap-8 xl:gap-16 pb-32" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

	<?php if ( $checkout->get_checkout_fields() ) : ?>

		<div class="flex-grow space-y-16" id="customer_details">
			<div class="space-y-10">
				<?php do_action( 'woocommerce_checkout_billing' ); ?>
                <?php do_action( 'woocommerce_checkout_shipping' ); ?>
			</div>
            
            <div class="space-y-5 pt-5 border-t border-border">
                <label class="flex items-center gap-4 cursor-pointer group">
                    <input type="checkbox" class="rounded-md border-border text-primary focus:ring-primary w-5 h-5 transition-all" name="email_opt_in" checked>
                    <span class="text-sm font-medium text-muted-foreground group-hover:text-foreground transition-colors">Email me with news and offers (optional)</span>
                </label>
                
                <label class="flex items-center gap-4 cursor-pointer group">
                    <input type="checkbox" class="rounded-md border-border text-primary focus:ring-primary w-5 h-5 transition-all" name="create_account">
                    <span class="text-sm font-medium text-muted-foreground group-hover:text-foreground transition-colors">Create an account?</span>
                </label>
                
                <label class="flex items-center gap-4 cursor-pointer group">
                    <input type="checkbox" class="rounded-md border-border text-primary focus:ring-primary w-5 h-5 transition-all" name="ship_to_different_address">
                    <span class="text-sm font-medium text-muted-foreground group-hover:text-foreground transition-colors">Ship to a different address?</span>
                </label>
            </div>
		</div>

	<?php endif; ?>
	
	<div class="w-full xl:w-[410px] 2xl:w-[480px] flex-shrink-0">
        <div class="bg-white border border-border rounded-2xl overflow-hidden shadow-sm sticky top-10">
            <div class="p-8 border-b border-border bg-gray-50/30">
                <h3 id="order_review_heading" class="text-xl font-display font-bold text-foreground">Your Order</h3>
            </div>

            <?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

            <div id="order_review" class="woocommerce-checkout-review-order p-8">
                <?php do_action( 'woocommerce_checkout_order_review' ); ?>
            </div>

            <?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
        </div>
	</div>

</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
