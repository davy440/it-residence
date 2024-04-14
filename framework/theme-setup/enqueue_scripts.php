<?php
/**
 * Enqueue fonts. The woff2 files are added using @font-face file via fonts.css file.
 *
 * @return  void
 */
if ( !function_exists( 'itre_enqueue_fonts' ) ) {
	function itre_enqueue_fonts() {
		$fonts = ITRE_Google_Fonts::itre_get_font_settings();
		$filePaths = glob(get_template_directory() . '/assets/cache/fontFiles/*.woff2');
		$fileURI = get_template_directory_uri() . '/assets/cache/fontFiles/';
		$fontFace = '';

		foreach($filePaths as $path) {
			if (strpos($path, 'heading')) {
				$uri['heading'] = $fileURI . basename( $path );
			}
		
			if (strpos($path, 'body')) {
				$uri['body'] = $fileURI . basename( $path );
			}
		}

		foreach($fonts as $key => $value) {
			$fontFamily = $value['family'];
			$fontWeight = $value['weight'];
			$fontURI = $uri[$key];
			$fontCat = $value['cat'];

			$fontFace .= '@font-face {';
			$fontFace .= "font-family: {$fontFamily};";
			$fontFace .= "font-weight: {$fontWeight};";
			$fontFace .= "src: url({$fontURI}) format('woff2');";
			$fontFace .= "font-display: swap;";
			$fontFace .= "font-stretch: normal;";
			$fontFace .= "}";
		}
		$filePath = get_template_directory() . '/assets/cache/fontFiles/fonts.css';

		$c = fopen( $filePath, 'w+' );
		fwrite( $c, $fontFace );
		fclose( $c );

		$fileURI = get_template_directory_uri() . '/assets/cache/fontFiles/fonts.css';

		wp_enqueue_style('itre-fonts', esc_url( $fileURI ), ITRE_VERSION );
	}
}
add_action( 'wp_enqueue_scripts', 'itre_enqueue_fonts' );


if ( !function_exists( 'itre_scripts' ) ) {
	function itre_scripts() {

		wp_enqueue_style( 'itre-style', get_stylesheet_uri(), array(), ITRE_VERSION );
		wp_style_add_data( 'itre-style', 'rtl', 'replace' );

		wp_enqueue_style( 'bootstrap', esc_url(get_template_directory_uri() . '/assets/bootstrap.css'), array(), ITRE_VERSION );

		wp_enqueue_style( 'font-awesome', esc_url(get_template_directory_uri() . '/assets/fonts/font-awesome.css'), array(), ITRE_VERSION );

		wp_enqueue_style( 'owl-css', esc_url(get_template_directory_uri() . '/assets/owl.carousel.css'), array(), ITRE_VERSION );

		wp_enqueue_style( 'glightbox-css', esc_url(get_template_directory_uri() . '/assets/theme-styles/css/glightbox.min.css'), array(), ITRE_VERSION );

		wp_enqueue_style( 'itre-main', esc_url(get_template_directory_uri() . '/assets/theme-styles/css/main.min.css'), array(), ITRE_VERSION );

		wp_enqueue_script( 'itre-navigation', esc_url(get_template_directory_uri() . '/assets/js/min/navigation.min.js'), array(), ITRE_VERSION );

		if (class_exists('IT_Listings') && is_singular('property') ) {
			wp_enqueue_script( 'itre-property-map-js', esc_url(get_template_directory_uri() . '/assets/js/min/property-map.min.js'), array(), ITRE_VERSION, true );
		}
		
		if ( class_exists('IT_Lisings') ) {
			wp_enqueue_script( 'itre-property-js', esc_url(get_template_directory_uri() . '/assets/js/min/property.min.js'), array(), ITRE_VERSION, true );
		}

		wp_enqueue_script( 'owl-js', esc_url(get_template_directory_uri() . '/assets/js/min/owl.min.js'), array('jquery'), ITRE_VERSION, true );

		wp_enqueue_script( 'glightbox-js', esc_url(get_template_directory_uri() . '/assets/js/min/glightbox.min.js'), array(), ITRE_VERSION, true );

		wp_enqueue_script( 'itre-custom-js', esc_url( get_template_directory_uri() . '/assets/js/min/custom.min.js'), array('jquery', 'owl-js', 'glightbox-js'), ITRE_VERSION, true );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'itre_scripts' );

/**
 * Disable the emoji's
 */
if ( !function_exists( 'disable_emojis' ) ) {
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
}
add_action( 'init', 'disable_emojis' );

/**
 * Filter out the tinymce emoji plugin.
 */
if ( !function_exists( 'disable_emojis_tinymce' ) ) {
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
}