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

/**
 * Add Mailchimp Settings to Settings > General
 */
add_action('admin_init', function () {
    register_setting('general', 'mailchimp_api_key');
    add_settings_field('mailchimp_api_key', 'Mailchimp API Key', function () {
        $value = get_option('mailchimp_api_key', '');
        echo '<input type="text" name="mailchimp_api_key" value="' . esc_attr($value) . '" class="regular-text">';
    }, 'general');

    register_setting('general', 'mailchimp_list_id');
    add_settings_field('mailchimp_list_id', 'Mailchimp List ID', function () {
        $value = get_option('mailchimp_list_id', '');
        echo '<input type="text" name="mailchimp_list_id" value="' . esc_attr($value) . '" class="regular-text">';
    }, 'general');
});
