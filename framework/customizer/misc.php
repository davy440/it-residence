<?php
/**
 *	Review, Support and Upsell Section
 */

function itre_misc_customize_register( $wp_customize ) {

	$wp_customize->add_section(
		'itre-misc', array(
			'title'		=>	__('THEME LINKS', 'it-residence'),
			'priority'	=>	2
		)
	);

	$wp_customize->add_control(
		new itre_Custom_Link_Control(
			$wp_customize, 'itre-support', array(
				'label'		=>	__('Mail Us', 'it-residence'),
				'description'	=> __('If you have any questions, queries, feedback or suggestions for the theme, we would love to hear from you.', 'it-residence'),
				'type'		=>	'itre-link',
				'section'	=>	'itre-misc',
				'settings'	=>	array(),
				'priority'	=>	5,
				'input_attrs'	=>	array(
						'url'		=>	'mailto:support@indithemes.com'
				)
			)
		)
	);

	$wp_customize->add_control(
		new itre_Custom_Link_Control(
			$wp_customize, 'itre-review', array(
				'label'		=>	__('<span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span>', 'it-residence'),
				'description'	=> __('If you liked the theme, do leave us a glittering review. We would really appreciate it. Thanks!', 'it-residence'),
				'type'		=>	'itre-link',
				'section'	=>	'itre-misc',
				'settings'	=>	array(),
				'priority'	=>	5,
				'input_attrs'	=>	array(
						'url'		=>	'https://www.wordpress.org/themes/it-residence'
				)
			)
		)
	);

	$wp_customize->add_control(
		new itre_Custom_Link_Control(
			$wp_customize, 'itre-more', array(
				'label'		=>	__('More Themes', 'it-residence'),
				'description'	=> __('Do visit our store at <strong>IndiThemes.com</strong> and check out our other stuff!', 'it-residence'),
				'type'		=>	'itre-link',
				'section'	=>	'itre-misc',
				'settings'	=>	array(),
				'priority'	=>	5,
				'input_attrs'	=>	array(
						'url'		=>	'https://indithemes.com'
				)
			)
		)
	);
}
add_action('customize_register', 'itre_misc_customize_register');
