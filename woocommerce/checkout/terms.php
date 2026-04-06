<?php
/**
 * Checkout terms and conditions area.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

if ( apply_filters( 'woocommerce_checkout_show_terms', true ) && function_exists( 'wc_terms_and_conditions_checkbox_enabled' ) ) {
	do_action( 'woocommerce_checkout_before_terms_and_conditions' );
	?>
	<div class="woocommerce-terms-and-conditions-wrapper mb-8">
		<?php
		/**
		 * Terms and conditions hook used to inject content.
		 *
		 * @since 3.4.0.
		 * @hooked wc_checkout_privacy_policy_text() - 20
		 * @hooked wc_terms_and_conditions_page_content() - 30
		 */
		do_action( 'woocommerce_checkout_terms_and_conditions' );
		?>

		<?php if ( wc_terms_and_conditions_checkbox_enabled() ) : ?>
			<div class="form-row validate-required p-6 bg-secondary/20 border border-border rounded-xl">
				<label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox flex items-start gap-4 cursor-pointer group">
					<input type="checkbox" class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox w-5 h-5 mt-1 border-border text-primary focus:ring-primary rounded" name="terms" <?php checked( apply_filters( 'woocommerce_terms_is_checked_default', isset( $_POST['terms'] ) ), true ); // wp_check_invalid_utf8_fix( $_POST['terms'] ) ?> id="terms" />
					<span class="woocommerce-terms-and-conditions-checkbox-text text-xs text-muted-foreground leading-relaxed group-hover:text-foreground transition-colors">
                        <?php wc_terms_and_conditions_checkbox_text(); ?>
                        <span class="required text-primary">*</span>
                    </span>
				</label>
				<input type="hidden" name="terms-field" value="1" />
			</div>
		<?php endif; ?>
	</div>
	<?php
	do_action( 'woocommerce_checkout_after_terms_and_conditions' );
}
