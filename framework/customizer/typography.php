<?php
/**
 *	Googe Fonts for the Theme
 */

function itre_custom_fonts_customize_register( $wp_customize ) {

	$wp_customize->add_section(
		'itre_typography', array(
			'title'		=>	__('Typography', 'it-residence'),
			'priority'	=>	80
		)
	);

	$wp_customize->add_setting(
	    'itre_gfonts_heading', array(
		    'default'			=>	'League Spartan',
			'sanitize_callback'	=>	'sanitize_text_field',
		    'transport'	=>	'postMessage'
	    )
    );

    $wp_customize->add_setting(
	    'itre_gweights_heading', array(
		    'default'			=>	'700',
			'sanitize_callback'	=>	'sanitize_text_field',
		    'transport'	=>	'postMessage'
	    )
    );

	$wp_customize->add_setting(
	    'itre_gcat_heading', array(
		    'default'	=>	'sans-serif',
			'sanitize_callback'	=>	'sanitize_text_field',
		    'transport'	=>	'postMessage'
	    )
    );

    $wp_customize->add_control(
	    new itre_Google_Font_Dropdown_Custom_Control (
		    $wp_customize,
		    'itre_heading',
		    array(
			    'label'		=>	esc_html__('Heading Font', 'it-residence'),
			    'description'	=>	__('Font for headings, metadata, pagination and other areas', 'it-residence'),
			    'section'	=>	'itre_typography',
			    'settings'	=>	[
			    		'font'		=>	'itre_gfonts_heading',
			    		'weight'	=>	'itre_gweights_heading',
						'category'	=>	'itre_gcat_heading'
			    	],
			    'priority'	=>	10,
			    'input_attrs'	=>	array(
				    'font_id'		=>	'customize-control-itre_gfonts_heading',
				   	 'weight_id'	=>	'customize-control-itre_gweights_heading',
					 'cat_id'		=>	'customize-control-itre_gcat_heading'
			    )
		    )
	    )
    );

    $wp_customize->add_setting(
	    'itre_gfonts_body', array(
		    'default'			=>	'League Spartan',
			'sanitize_callback'	=>	'sanitize_text_field',
		    'transport'	=>	'postMessage'
	    )
    );

    $wp_customize->add_setting(
	    'itre_gweights_body', array(
		    'default'			=>	'400',
			'sanitize_callback'	=>	'sanitize_text_field',
		    'transport'	=>	'postMessage'
	    )
    );

	$wp_customize->add_setting(
	    'itre_gcat_body', array(
		    'default'	=>	'sans-serif',
			'sanitize_callback'	=>	'sanitize_text_field',
		    'transport'	=>	'postMessage'
	    )
    );

    $wp_customize->add_control (
	    new itre_Google_Font_Dropdown_Custom_Control (
		    $wp_customize,
		    'itre_body_font',
		    array(
			    'label'		=>	esc_html__('Body Font', 'it-residence'),
			    'description'	=>	__('Text primarily for text content and widget content', 'it-residence'),
			    'section'	=>	'itre_typography',
			    'settings'	=>	[
			    		'font'		=>	'itre_gfonts_body',
			    		'weight'	=>	'itre_gweights_body',
						'category'	=>	'itre_gcat_body'
					],
			    'priority'	=>	15,
			    'input_attrs'	=> array(
			    	'font_id'		=>	'customize-control-itre_gfonts_body',
				   'weight_id'		=>	'customize-control-itre_gweights_body',
				   'cat_id'			=>	'customize-control-itre_gcat_body'
				)
		    )
	    )
    );

}
add_action( 'customize_register', 'itre_custom_fonts_customize_register' );
