<?php
/**
 *  Enqueue scripts and styles in admin area
 */

if ( !function_exists('itre_enqueue_admin_scripts') ) {
    function itre_enqueue_admin_scripts() {
        wp_enqueue_style( 'itre-theme-admin-css', esc_url( get_template_directory_uri() . '/assets/theme-styles/css/admin.css' ), array(), ITRE_VERSION );
    }
}
add_action('admin_enqueue_scripts', 'itre_enqueue_admin_scripts');

if ( !function_exists('itre_customize_controls_enqueue_scripts') ) {
    function itre_customize_controls_enqueue_scripts() {
        wp_enqueue_script('itre-customize-controls-js', esc_url( get_template_directory_uri() . '/assets/js/customize_controls.js' ), array('jquery'), ITRE_VERSION, true );
    }
}
add_action('customize_controls_enqueue_scripts', 'itre_customize_controls_enqueue_scripts');
