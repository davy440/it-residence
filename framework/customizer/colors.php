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

	$wp_customize->add_setting(
		'itre_link_color', array(
			'default'	=>	'#999999',
			'sanitize_callback'	=>	'sanitize_hex_color'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 'itre_link_color', array(
				'label'		=>	esc_html__('Meta Link Color', 'it-residence'),
				'section'	=>	'colors',
				'settings'	=>	'itre_link_color'
			)
		)
	);

    $wp_customize->add_setting(
		'itre_link_hvr_color', array(
			'default'	=>	'#555555',
			'sanitize_callback'	=>	'sanitize_hex_color'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 'itre_link_hvr_color', array(
				'label'		=>	esc_html__('Meta Link Hover Color', 'it-residence'),
				'section'	=>	'colors',
				'settings'	=>	'itre_link_hvr_color'
			)
		)
	);

    $wp_customize->add_setting(
		'itre_nav_link_clr', array(
			'default'	=>	'#2e6d87',
			'sanitize_callback'	=>	'sanitize_hex_color'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 'itre_nav_link_clr', array(
				'label'		=>	esc_html__('Menu Link Color', 'it-residence'),
				'section'	=>	'colors',
				'settings'	=>	'itre_nav_link_clr'
			)
		)
	);

    $wp_customize->add_setting(
		'itre_submenu_link_clr', array(
			'default'	=>	'#ffffff',
			'sanitize_callback'	=>	'sanitize_hex_color'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 'itre_submenu_link_clr', array(
				'label'		=>	esc_html__('Sub-Menu Link Color', 'it-residence'),
				'section'	=>	'colors',
				'settings'	=>	'itre_submenu_link_clr'
			)
		)
	);

    $wp_customize->add_setting(
		'itre_footer_bg', array(
			'default'	=>	'#2e6d87',
			'sanitize_callback'	=>	'sanitize_hex_color'
		)
	);

}
add_action( 'customize_register', 'itre_colors_customize_register' );
