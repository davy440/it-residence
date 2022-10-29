<?php
/**
 *  Add Settings for the Customizer Controls
 */

function itre_settings_customize_register( $wp_customize ) {

    $settings = [];

    $wp_customize->add_setting(
        'itreHeaderLayout', array(
            'default'   =>  'headerDefault',
            'sanitize_callback' =>  'itre_sanitize_radio'
        )
    );
}
add_action('customize_register', 'itre_settings_customize_register');
