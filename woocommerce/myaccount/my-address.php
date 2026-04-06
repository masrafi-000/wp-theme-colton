<?php
/**
 * My Addresses
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-address.php.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.6.0
 */

defined( 'ABSPATH' ) || exit;

$customer_id = get_current_user_id();

if ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) {
	$get_addresses = apply_filters(
		'woocommerce_my_account_get_addresses',
		array(
			'billing'  => __( 'Billing address', 'woocommerce' ),
			'shipping' => __( 'Shipping address', 'woocommerce' ),
		),
		$customer_id
	);
} else {
	$get_addresses = apply_filters(
		'woocommerce_my_account_get_addresses',
		array(
			'billing' => __( 'Billing address', 'woocommerce' ),
		),
		$customer_id
	);
}

$old_column_class = 'col-1';
$column_class     = 'col-2';
?>

<div class="space-y-10">
    <div class="space-y-2">
        <h2 class="text-3xl font-display font-bold text-foreground"><?php echo apply_filters( 'woocommerce_my_account_my_address_title', __( 'Addresses', 'woocommerce' ) ); ?></h2>
        <p class="text-sm text-muted-foreground leading-relaxed">
            <?php echo apply_filters( 'woocommerce_my_account_my_address_description', esc_html__( 'The following addresses will be used on the checkout page by default.', 'woocommerce' ) ); ?>
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
        <?php foreach ( $get_addresses as $name => $address_title ) : ?>
            <div class="space-y-6 bg-secondary/20 p-8 rounded-2xl border border-border/50 flex flex-col h-full">
                <div class="flex items-center justify-between">
                    <h3 class="text-sm font-bold text-foreground uppercase tracking-widest"><?php echo esc_html( $address_title ); ?></h3>
                    <a href="<?php echo esc_url( wc_get_endpoint_url( 'edit-address', $name ) ); ?>" class="text-brand-blue font-bold text-[11px] uppercase tracking-widest hover:underline flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg>
                        Edit
                    </a>
                </div>
                
                <address class="text-sm text-muted-foreground not-italic leading-relaxed flex-grow">
                    <?php
                        $address = wc_get_account_formatted_address( $name );
                        echo $address ? wp_kses_post( $address ) : esc_html_e( 'You have not set up this type of address yet.', 'woocommerce' );
                    ?>
                </address>
            </div>
        <?php endforeach; ?>
    </div>
</div>
