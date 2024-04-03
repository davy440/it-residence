<?php
/**
 *	Custom Colors Control for Theme
 */

function itre_colors_customize_register( $wp_customize ) {

	$wp_customize->add_setting(
		'itre_body_text_color', array(
			'default'	=>	'#000000',
			'sanitize_callback'	=>	'sanitize_hex_color'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 'itre_body_text_color', array(
				'label'		=>	esc_html__('Main Text Color', 'it-residence'),
				'section'	=>	'colors',
				'settings'	=>	'itre_body_text_color'
			)
		)
	);



	$wp_customize->add_setting(
		'itre_accent_color', array(
			'default'	=>	'#2e6d87',
			'sanitize_callback'	=>	'sanitize_hex_color'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 'itre_accent_color', array(
				'label'		=>	esc_html__('Accent Color', 'it-residence'),
				'section'	=>	'colors',
				'settings'	=>	'itre_accent_color'
			)
		)
	);
}
add_action( 'customize_register', 'itre_colors_customize_register' );
