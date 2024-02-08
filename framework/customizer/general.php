<?php
/**
 *	Customizer Controls for General Settings for the theme
 */

function itre_general_customize_register( $wp_customize ) {

	$wp_customize->add_section(
		"itre_general_options", array(
			"title"			=>	esc_html__("General", 'it-residence'),
			"description"	=>	esc_html__("General Settings for the Theme", 'it-residence'),
			"priority"		=>	5
		)
	);

	$wp_customize->add_setting(
        'itre_sidebar_width', array(
            'default'    =>  25,
            'sanitize_callback'  =>  'absint'
        )
    );

    $wp_customize->add_control(
        new itre_Range_Value_Control(
            $wp_customize, 'itre_sidebar_width', array(
	            'label'         =>	esc_html__( 'Sidebar Width', 'it-residence' ),
            	'type'          => 'itre-range-value',
            	'section'       => 'itre_general_options',
            	'settings'      => 'itre_sidebar_width',
                'priority'		=>  5,
            	'input_attrs'   => array(
            		'min'            => 25,
            		'max'            => 40,
            		'step'           => 1,
            		'suffix'         => '%', //optional suffix
				),
            )
        )
    );

	$wp_customize->add_setting(
	    'itre_back_to_top', array(
		    'default'	=>	1,
		    'sanitize_callback'	=>	'itre_sanitize_checkbox'
	    )
    );

    $wp_customize->add_control(
	    'itre_back_to_top', array(
		    'label'		=>	__('Enable Back to Top Button', 'it-residence'),
		    'type'		=>	'checkbox',
		    'priority'	=>	15,
		    'section'	=>	'itre_general_options'
	    )
    );

	$wp_customize->add_setting(
	    'itre_remove_emoji', array(
		    'default'	=>	'',
		    'sanitize_callback'	=>	'itre_sanitize_checkbox'
	    )
    );

    $wp_customize->add_control(
	    'itre_remove_emoji', array(
		    'label'		=>	__('Disable Emojis', 'it-residence'),
		    'type'		=>	'checkbox',
		    'priority'	=>	15,
		    'section'	=>	'itre_general_options'
	    )
    );
}
add_action("customize_register", "itre_general_customize_register");
