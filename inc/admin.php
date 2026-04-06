<?php
/**
 * Admin Customizations
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Customize Admin Columns for Inquiries
 */
function colton_research_custom_inquiry_columns( $columns ) {
    return array(
        'cb'      => $columns['cb'],
        'title'   => 'Subject',
        'name'    => 'From Name',
        'email'   => 'Email',
        'date'    => $columns['date'],
    );
}
add_filter( 'manage_colton_inquiry_posts_columns', 'colton_research_custom_inquiry_columns' );

function colton_research_inquiry_column_content( $column, $post_id ) {
    switch ( $column ) {
        case 'name' :
            echo esc_html( get_post_meta( $post_id, '_inquiry_name', true ) );
            break;
        case 'email' :
            echo esc_html( get_post_meta( $post_id, '_inquiry_email', true ) );
            break;
    }
}
add_action( 'manage_colton_inquiry_posts_custom_column', 'colton_research_inquiry_column_content', 10, 2 );

/**
 * Customize Admin Columns for Subscriptions
 */
function colton_research_custom_subscription_columns( $columns ) {
    unset( $columns['date'] );
    $columns['title'] = esc_html__( 'Email Address', 'colton-research' );
    $columns['subscription_date'] = esc_html__( 'Subscription Date', 'colton-research' );
    return $columns;
}
add_filter( 'manage_colton_subscription_posts_columns', 'colton_research_custom_subscription_columns' );

function manage_colton_subscription_posts_custom_column_content( $column, $post_id ) {
    if ( $column == 'subscription_date' ) {
        echo get_the_date( 'F j, Y', $post_id );
    }
}
add_action( 'manage_colton_subscription_posts_custom_column', 'manage_colton_subscription_posts_custom_column_content', 10, 2 );
