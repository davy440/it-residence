<?php
/**
 * Enqueue scripts and styles.
 */

 function itre_enqueue_fonts() {

	$heading_font 	= 'League Spartan';
	$heading_weight = 700;
	$heading_cat	= 'sans-serif';
	$body_font 		= 'League Spartan';
	$body_weight 	= 400;
	$body_cat		= 'sans-serif';

	if ( !empty( get_theme_mod('itre_gfonts_heading') ) ) {
		$heading_font = get_theme_mod( 'itre_gfonts_heading', 'Lato' );
		$heading_font = str_replace( ' ', '+', $heading_font );
	}

	if ( !empty( get_theme_mod('itre_gweights_heading') ) ) {
		$heading_weight = get_theme_mod( 'itre_gweights_heading', 700 );
	}

	if (!empty( get_theme_mod('itre_gfonts_body' ) ) ) {
		$body_font = get_theme_mod('itre_gfonts_body', 'Lato');
		$body_font = str_replace( ' ', '+', $body_font );
	}

	if (!empty( get_theme_mod('itre_gweights_body' ) ) ) {
		$body_weight = get_theme_mod('itre_gweights_body', 400);
	}

	$fontCall = '';
	$fontCall .= 'https://fonts.googleapis.com/css?family=';
	$fontCall .= $body_font;
	$fontCall .= ':' . $body_weight;

	if ( $heading_font !== $body_font ) {
		$fontCall .= '|' . $heading_font;
		$fontCall .= ':' . $heading_weight;
	}

	// At this point, both heading and body fonts are same
	if ( $heading_weight !== $body_weight ) {
		$fontCall .= ',' . $heading_weight;
	}

	$fontCall .= '&display=swap';

	wp_enqueue_style( 'itre-fonts', esc_url( $fontCall ), array(), NULL );

}
add_action( 'wp_enqueue_scripts', 'itre_enqueue_fonts' );


function itre_scripts() {

	wp_enqueue_style( 'itre-style', get_stylesheet_uri(), array(), ITRE_VERSION );
	wp_style_add_data( 'itre-style', 'rtl', 'replace' );

    wp_enqueue_style( 'bootstrap', esc_url(get_template_directory_uri() . '/assets/bootstrap.css'), array(), ITRE_VERSION );

	wp_enqueue_style( 'font-awesome', esc_url(get_template_directory_uri() . '/assets/fonts/font-awesome.css'), array(), ITRE_VERSION );

	wp_enqueue_style( 'owl-css', esc_url(get_template_directory_uri() . '/assets/owl.carousel.css'), array(), ITRE_VERSION );

    wp_enqueue_style( 'itre-main', esc_url(get_template_directory_uri() . '/assets/theme-styles/css/main.min.css'), array(), ITRE_VERSION );

	wp_enqueue_script( 'itre-navigation', esc_url(get_template_directory_uri() . '/assets/js/min/navigation.min.js'), array(), ITRE_VERSION );

	if (class_exists('IT_Listings') && is_singular('property') ) {
		wp_enqueue_script( 'itre-property-map-js', esc_url(get_template_directory_uri() . '/assets/js/min/property-map.min.js'), array(), ITRE_VERSION, true );
	}

	wp_enqueue_script( 'owl-js', esc_url(get_template_directory_uri() . '/assets/js/min/owl.min.js'), array('jquery'), ITRE_VERSION, true );

	wp_enqueue_script( 'itre-custom-js', esc_url( get_template_directory_uri() . '/assets/js/min/custom.min.js'), array('jquery', 'owl-js'), ITRE_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	$data = get_theme_mod( 'itre_back_to_top', 1 );

	wp_localize_script( 'itre-custom-js', 'itre', $data );

}
add_action( 'wp_enqueue_scripts', 'itre_scripts' );


/**
 * Disable the emoji's
 */
function disable_emojis() {

    if ( get_theme_mod('itre_remove_emoji', '') == "") {
        return;
    }

	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );

	// Remove from TinyMCE
	add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
}
add_action( 'init', 'disable_emojis' );

/**
 * Filter out the tinymce emoji plugin.
 */
function disable_emojis_tinymce( $plugins ) {

    if ( get_theme_mod('itre_remove_emoji', '') == "") {
        return;
    }

	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}
