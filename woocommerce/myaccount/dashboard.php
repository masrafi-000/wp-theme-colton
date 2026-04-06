<?php
/**
 * My Account dashboard.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$allowed_html = array(
	'a' => array(
		'href' => array(),
	),
);
?>

<div class="space-y-10">
    <div class="space-y-4">
        <h2 class="text-3xl font-display font-bold text-foreground">
            <?php
            /* translators: 1: user display name 2: logout url */
            printf(
                esc_html__( 'Hello %1$s', 'woocommerce' ),
                '<span class="text-brand-blue">' . esc_html( $current_user->display_name ) . '</span>'
            );
            ?>
        </h2>
        <p class="text-sm text-muted-foreground leading-relaxed max-w-2xl">
            <?php
            /* translators: 1: Orders URL 2: Address URL 3: Account URL. */
            $dashboard_desc = __( 'From your account dashboard you can view your <a href="%1$s" class="text-brand-blue font-bold hover:underline">recent orders</a>, manage your <a href="%2$s" class="text-brand-blue font-bold hover:underline">shipping and billing addresses</a>, and <a href="%3$s" class="text-brand-blue font-bold hover:underline">edit your password and account details</a>.', 'woocommerce' );
            printf(
                wp_kses( $dashboard_desc, $allowed_html ),
                esc_url( wc_get_endpoint_url( 'orders' ) ),
                esc_url( wc_get_endpoint_url( 'edit-address' ) ),
                esc_url( wc_get_endpoint_url( 'edit-account' ) )
            );
            ?>
        </p>
    </div>

    <!-- Quick Stats/Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <a href="<?php echo esc_url( wc_get_endpoint_url( 'orders' ) ); ?>" class="group p-8 bg-secondary/20 border border-border/50 rounded-2xl transition-all hover:bg-brand-blue hover:border-brand-blue hover:shadow-xl hover:shadow-brand-blue/20">
            <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center text-brand-blue mb-6 group-hover:bg-white/20 group-hover:text-white transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
            </div>
            <h3 class="text-lg font-bold text-foreground group-hover:text-white transition-colors">Orders</h3>
            <p class="text-xs text-muted-foreground group-hover:text-white/70 transition-colors mt-1">Track and manage your purchases</p>
        </a>

        <a href="<?php echo esc_url( wc_get_endpoint_url( 'edit-address' ) ); ?>" class="group p-8 bg-secondary/20 border border-border/50 rounded-2xl transition-all hover:bg-brand-blue hover:border-brand-blue hover:shadow-xl hover:shadow-brand-blue/20">
            <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center text-brand-blue mb-6 group-hover:bg-white/20 group-hover:text-white transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
            </div>
            <h3 class="text-lg font-bold text-foreground group-hover:text-white transition-colors">Addresses</h3>
            <p class="text-xs text-muted-foreground group-hover:text-white/70 transition-colors mt-1">Update your delivery locations</p>
        </a>

        <a href="<?php echo esc_url( wc_get_endpoint_url( 'edit-account' ) ); ?>" class="group p-8 bg-secondary/20 border border-border/50 rounded-2xl transition-all hover:bg-brand-blue hover:border-brand-blue hover:shadow-xl hover:shadow-brand-blue/20">
            <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center text-brand-blue mb-6 group-hover:bg-white/20 group-hover:text-white transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
            </div>
            <h3 class="text-lg font-bold text-foreground group-hover:text-white transition-colors">Profile</h3>
            <p class="text-xs text-muted-foreground group-hover:text-white/70 transition-colors mt-1">Manage your account security</p>
        </a>
    </div>

    <?php
	/**
	 * My Account dashboard.
	 *
	 * @since 2.6.0
	 */
	do_action( 'woocommerce_account_dashboard' );

	/**
	 * Deprecated woocommerce_before_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_before_my_account' );

	/**
	 * Deprecated woocommerce_after_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_after_my_account' );
    ?>
</div>
