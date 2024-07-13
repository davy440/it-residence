<?php
/**
 * Sample implementation of the Custom Header feature
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php the_header_image_tag(); ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package IT_Residence
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses itre_header_style()
 */
if ( !function_exists( 'itre_custom_header_setup' ) ) {
	function itre_custom_header_setup() {
		add_theme_support(
			'custom-header',
			apply_filters(
				'itre_custom_header_args',
				array(
					'default-image'      => ITRE_URL . 'assets/images/header.jpg',
					'default-text-color' => '000000',
					'width'              => 1920,
					'height'             => 600,
					'flex-height'        => true,
					'wp-head-callback'   => 'itre_header_style',
				)
			)
		);
	}
}
add_action( 'after_setup_theme', 'itre_custom_header_setup' );


if ( ! function_exists( 'itre_header_style' ) ) :
	/**
	 * Styles the header image and text displayed on the blog.
	 *
	 * @see itre_custom_header_setup().
	 */
	function itre_header_style() {
		$header_text_color = get_header_textcolor();
		// If we get this far, we have custom styles. Let's do this.
		?>
		<style type="text/css">

			<?php
				$header_image = is_singular(['post', 'page', 'property']) && !is_front_page() && has_post_thumbnail() ? get_the_post_thumbnail_url() : get_header_image();
			?>

			#header-image {
				background-image: url(<?php echo esc_url( $header_image ) ?>);
				background-size: cover;
				background-repeat: repeat;
				background-position: center center;
			}

			<?php
		 /*
 		 * If no custom options for text are set, let's bail.
 		 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: add_theme_support( 'custom-header' ).
 		 */

		// Has the text been hidden?
		if ( ! display_header_text() ) :
			?>
			.site-title, .site-description {
				display: none;
				position: absolute;
				clip: rect(1px, 1px, 1px, 1px);
				}
			<?php
			// If the user has set a custom color for the text use that.
		else :
			?>
			.site-title a,
			.site-description {
				color: #<?php echo esc_attr( $header_text_color ); ?>;
			}
		<?php endif; ?>
		</style>
		<?php
	}
endif;
