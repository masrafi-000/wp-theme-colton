<?php
/**
 * My Account page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-account.php.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

defined( 'ABSPATH' ) || exit;
?>

<div class="max-w-7xl mx-auto px-4 py-16">
    <div class="flex flex-col lg:flex-row gap-12">
        <?php
        /**
         * My Account navigation.
         *
         * @since 2.6.0
         */
        do_action( 'woocommerce_account_navigation' ); ?>

        <div class="woocommerce-MyAccount-content flex-grow">
            <div class="bg-white border border-border rounded-2xl p-8 md:p-12 shadow-sm min-h-[600px]">
                <?php
                /**
                 * My Account content.
                 *
                 * @since 2.6.0
                 */
                do_action( 'woocommerce_account_content' );
                ?>
            </div>
        </div>
    </div>
</div>
