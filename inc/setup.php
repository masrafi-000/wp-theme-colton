<?php
/**
 * Theme Setup and Core Configurations
 */

if ( ! defined( 'ABSPATH' ) ) exit;

function colton_research_setup() {
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );

    register_nav_menus( array(
        'menu-1' => esc_html__( 'Primary', 'colton-research' ),
        'footer-menu' => esc_html__( 'Footer Menu', 'colton-research' ),
    ));

    add_theme_support( 'html5', array(
        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script',
    ));

    add_theme_support( 'customize-selective-refresh-widgets' );
    add_theme_support( 'custom-logo', array(
        'height'      => 250,
        'width'       => 250,
        'flex-width'  => true,
        'flex-height' => true,
    ));
}
add_action( 'after_setup_theme', 'colton_research_setup' );

/**
 * Register Sidebars
 */
function colton_research_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Shop Sidebar', 'colton-research' ),
        'id'            => 'shop-sidebar',
        'description'   => esc_html__( 'Add widgets here for product filtering.', 'colton-research' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s colton-categories-sidebar">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action( 'widgets_init', 'colton_research_widgets_init' );

/**
 * Custom Post Type for Subscriptions
 */
function colton_research_create_subscription_cpt() {
    $labels = array(
        'name'                  => _x( 'Subscriptions', 'Post type general name', 'colton-research' ),
        'singular_name'         => _x( 'Subscription', 'Post type singular name', 'colton-research' ),
        'menu_name'             => _x( 'Subscriptions', 'Admin Menu text', 'colton-research' ),
        'name_admin_bar'        => _x( 'Subscription', 'Add New on Toolbar', 'colton-research' ),
    );
    $args = array(
        'labels'             => $labels,
        'public'             => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'supports'           => array( 'title' ),
        'menu_icon'          => 'dashicons-email-alt',
        'menu_position'      => 25,
    );
    register_post_type( 'colton_subscription', $args );
}
add_action( 'init', 'colton_research_create_subscription_cpt' );

/**
 * Custom Post Type for Contact Inquiries
 */
function colton_research_create_inquiry_cpt() {
    $labels = array(
        'name'                  => _x( 'Inquiries', 'Post type general name', 'colton-research' ),
        'singular_name'         => _x( 'Inquiry', 'Post type singular name', 'colton-research' ),
    );
    $args = array(
        'labels'             => $labels,
        'public'             => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'supports'           => array( 'title', 'editor' ),
        'menu_icon'          => 'dashicons-testimonial',
        'menu_position'      => 26,
    );
    register_post_type( 'colton_inquiry', $args );
}
add_action( 'init', 'colton_research_create_inquiry_cpt' );

/**
 * Ensure Product Attributes
 */
function colton_research_ensure_size_attribute() {
    if ( ! taxonomy_exists( 'pa_size' ) ) {
        register_taxonomy( 'pa_size', 'product', array(
            'label' => 'Size',
            'hierarchical' => false,
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => 'pa_size' ),
        ));
    }
    
    $terms = array( '10mg', '30mg', '60mg' );
    foreach ( $terms as $term ) {
        if ( ! term_exists( $term, 'pa_size' ) ) {
            wp_insert_term( $term, 'pa_size' );
        }
    }
}
add_action( 'init', 'colton_research_ensure_size_attribute' );
