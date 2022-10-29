<?php
/**
 * IT Residence Theme Customizer
 *
 * @package IT_Residence
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function itre_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->get_section( 'colors' )->priority			= 80;

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'itre_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'itre_customize_partial_blogdescription',
			)
		);
	}
}
add_action( 'customize_register', 'itre_customize_register' );

require get_template_directory() . '/framework/customizer/custom_controls.php';
require get_template_directory() . '/framework/customizer/header.php';
require get_template_directory() . '/framework/customizer/general.php';
require get_template_directory() . '/framework/customizer/colors.php';
require get_template_directory() . '/framework/customizer/typography.php';
require get_template_directory() . '/framework/customizer/layouts.php';
require get_template_directory() . '/framework/customizer/footer.php';
require get_template_directory() . '/framework/customizer/sanitization.php';
require get_template_directory() . '/framework/customizer/misc.php';
require get_template_directory() . '/framework/customizer/button-section.php';

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function itre_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function itre_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function itre_customize_preview_js() {
	wp_enqueue_script( 'it-residence-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), ITRE_VERSION, true );
}
add_action( 'customize_preview_init', 'itre_customize_preview_js' );
