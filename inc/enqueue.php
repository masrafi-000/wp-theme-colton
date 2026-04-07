<?php
/**
 * Enqueue scripts and styles.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

function colton_research_scripts() {
    // Enqueue Google Fonts
    wp_enqueue_style( 'colton-fonts', 'https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@400;500;600;700&display=swap', array(), null );

    // Enqueue main stylesheet
    wp_enqueue_style( 'colton-research-style', get_stylesheet_uri(), array(), '1.0.0' );

    // Enqueue Tailwind output CSS
    wp_enqueue_style( 'colton-tailwind', get_template_directory_uri() . '/src/output.css', array(), '1.0.1' );

    // Enqueue jQuery
    wp_enqueue_script( 'jquery' );
    
    // Enqueue Component-based JS
    $js_uri = get_template_directory_uri() . '/assets/js';
    $components = array(
        'cart-logic'     => $js_uri . '/components/cart-logic.js',
        'ui-elements'    => $js_uri . '/components/ui-elements.js',
        'research-tools' => $js_uri . '/components/research-tools.js',
        'verification'   => $js_uri . '/components/verification.js',
        'woocommerce-ui' => $js_uri . '/components/woocommerce.js',
    );

    foreach ( $components as $handle => $src ) {
        wp_enqueue_script( 'colton-' . $handle, $src, array( 'jquery' ), '1.0.0', true );
    }

    // Enqueue new header JS as requested
    wp_enqueue_script(
        'mytheme-header',
        get_template_directory_uri() . '/assets/js/header.js',
        [ 'jquery' ],
        null,
        true
    );

    // Pass ajaxurl to JS
    wp_localize_script( 'mytheme-header', 'theme_ajax', [
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'nonce'    => wp_create_nonce( 'theme_nonce' ),
    ]);

    // Enqueue main theme entry point
    wp_enqueue_script( 'colton-theme', $js_uri . '/theme.js', array( 'jquery' ), '1.0.0', true );

    // Localize AJAX URL
    wp_localize_script( 'colton-theme', 'colton_ajax', array(
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'nonce'    => wp_create_nonce( 'colton_nonce' )
    ));
}
add_action( 'wp_enqueue_scripts', 'colton_research_scripts' );
