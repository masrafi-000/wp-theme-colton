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

/**
 * Define Theme Constants
 */
define( 'COLTON_THEME_VERSION', '1.0.0' );
define( 'COLTON_THEME_DIR', get_template_directory() );
define( 'COLTON_THEME_URI', get_template_directory_uri() );

/**
 * Load Modular Functions
 */
require_once COLTON_THEME_DIR . '/inc/setup.php';           // Theme setup, menus, post types
require_once COLTON_THEME_DIR . '/inc/enqueue.php';         // Scripts and styles
require_once COLTON_THEME_DIR . '/inc/woocommerce-logic.php'; // WooCommerce enhancements
require_once COLTON_THEME_DIR . '/inc/ajax-handlers.php';    // AJAX Search, Cart, Forms
require_once COLTON_THEME_DIR . '/inc/theme-functions.php';  // Customizer, Chat, Verification
require_once COLTON_THEME_DIR . '/inc/admin.php';           // Admin column customizations
