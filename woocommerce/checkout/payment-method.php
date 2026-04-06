<?php
/**
 * Output a single payment method
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/payment-method.php.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<li class="wc_payment_method payment_method_<?php echo esc_attr( $gateway->id ); ?> border border-border rounded-xl p-5 hover:bg-secondary/20 transition-all cursor-pointer group">
	<div class="flex items-center justify-between gap-4">
        <div class="flex items-center gap-4">
            <input id="payment_method_<?php echo esc_attr( $gateway->id ); ?>" type="radio" class="input-radio w-5 h-5 border-border text-primary focus:ring-primary cursor-pointer" name="payment_method" value="<?php echo esc_attr( $gateway->id ); ?>" <?php checked( $gateway->chosen, true ); ?> data-order_button_text="<?php echo esc_attr( $gateway->order_button_text ); ?>" />
            <label for="payment_method_<?php echo esc_attr( $gateway->id ); ?>" class="text-sm font-bold text-foreground cursor-pointer group-hover:text-primary transition-colors">
                <?php echo $gateway->get_title(); /* phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped */ ?>
            </label>
        </div>
        <div class="payment-icon">
            <?php echo $gateway->get_icon(); /* phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped */ ?>
        </div>
    </div>
	<?php if ( $gateway->has_fields() || $gateway->get_description() ) : ?>
		<div class="payment_box payment_method_<?php echo esc_attr( $gateway->id ); ?> mt-4 pt-4 border-t border-border/50 <?php if ( ! $gateway->chosen ) : ?>hidden<?php endif; ?>">
			<?php $gateway->payment_fields(); ?>
		</div>
	<?php endif; ?>
</li>
