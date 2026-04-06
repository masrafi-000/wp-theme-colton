<?php
/**
 * Checkout billing form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-billing.php.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 * @global WC_Checkout $checkout
 */

defined( 'ABSPATH' ) || exit;
?>

<div class="woocommerce-billing-fields space-y-12">
	<?php if ( wc_ship_to_billing_address_only() && WC()->cart->needs_shipping() ) : ?>
		<h3 class="text-2xl font-display font-bold text-foreground"><?php esc_html_e( 'Billing &amp; Shipping', 'woocommerce' ); ?></h3>
	<?php else : ?>
		<h3 class="text-2xl font-display font-bold text-foreground"><?php esc_html_e( 'Billing Details', 'woocommerce' ); ?></h3>
	<?php endif; ?>

	<?php do_action( 'woocommerce_before_checkout_billing_form', $checkout ); ?>

	<div class="woocommerce-billing-fields__field-wrapper grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
		<?php
		$fields = $checkout->get_checkout_fields( 'billing' );

		foreach ( $fields as $key => $field ) {
            // Add custom classes for layout
            $field['class'][] = 'form-row-wide';
            
            // Customize input classes
            $field['input_class'][] = 'w-full bg-white border border-border rounded-xl py-4 px-6 focus:outline-none focus:border-primary/50 focus:ring-2 focus:ring-primary/10 transition-all duration-300';
            $field['label_class'][] = 'text-xs font-bold uppercase tracking-widest text-muted-foreground mb-3 block';

			woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
		}
		?>
	</div>

	<?php do_action( 'woocommerce_after_checkout_billing_form', $checkout ); ?>
</div>

<?php if ( ! is_user_logged_in() && $checkout->is_registration_enabled() ) : ?>
	<div class="woocommerce-account-fields mt-12 pt-12 border-t border-border">
		<?php if ( ! $checkout->is_registration_required() ) : ?>

			<p class="form-row form-row-wide create-account">
				<label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox flex items-center gap-3 cursor-pointer group">
					<input class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox w-5 h-5 border-border text-primary focus:ring-primary rounded" id="createaccount" <?php checked( ( true === $checkout->get_value( 'createaccount' ) || ( true === apply_filters( 'woocommerce_create_account_default_checked', false ) ) ), true ); ?> type="checkbox" name="createaccount" value="1" /> 
                    <span class="text-sm font-bold text-muted-foreground group-hover:text-foreground transition-colors"><?php esc_html_e( 'Create an account?', 'woocommerce' ); ?></span>
				</label>
			</p>

		<?php endif; ?>

		<?php do_action( 'woocommerce_before_checkout_registration_form', $checkout ); ?>

		<?php if ( $checkout->get_checkout_fields( 'account' ) ) : ?>

			<div class="create-account grid grid-cols-1 md:grid-cols-2 gap-8 mt-8">
				<?php foreach ( $checkout->get_checkout_fields( 'account' ) as $key => $field ) : ?>
					<?php 
                    $field['input_class'][] = 'w-full bg-white border border-border rounded-xl py-4 px-6 focus:outline-none focus:border-primary/50 transition-all';
                    $field['label_class'][] = 'text-xs font-bold uppercase tracking-widest text-muted-foreground mb-3 block';
                    woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); 
                    ?>
				<?php endforeach; ?>
				<div class="clear"></div>
			</div>

		<?php endif; ?>

		<?php do_action( 'woocommerce_after_checkout_registration_form', $checkout ); ?>
	</div>
<?php endif; ?>
