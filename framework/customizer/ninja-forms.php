<?php
/**
 * Settings for Ninja Forms
 */
function itre_ninja_forms_customizer_reegister( $wp_customize ) {

    $wp_customize->add_section(
        'itre-ninja-forms', array(
            'title'         =>  __('Ninja Forms', 'it-residence'),
            'description'   =>  __('Controls for Ninja Forms', 'it-residence'),
            'priority'      =>  85
        )
    );

    $wp_customize->add_setting(
        'itre-hide-marked-required-text', array(
            'default'       =>  '',
            'sanitize_callback' =>  'itre_sanitize_checkbox'
        )
    );
    
    $wp_customize->add_control(
        'itre-hide-marked-required-text', array(
            'label'     =>  __('Disable "Fields marked with an *are required" text'),
            'section'   =>  'itre-ninja-forms',
            'type'      =>  'checkbox',
            'priority'  =>  1
        )
    );
}
add_action('customize_register', 'itre_ninja_forms_customizer_reegister');