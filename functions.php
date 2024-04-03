<?php
/**
 * IT Residence functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package IT_Residence
 */

if ( ! defined( 'ITRE_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'ITRE_VERSION', '2.4.4' );
}

if ( !function_exists('itre_activation_redirect') ) {
	function itre_activation_redirect() {

		global $pagenow;
		if ( 'themes.php' == $pagenow && is_admin() && isset($_GET['activated']) && $_GET['activated'] == true) {
			wp_redirect( esc_url_raw( add_query_arg( 'page', 'itre_options', admin_url('themes.php') ) ) );
		}
	}
}
add_action('admin_init', 'itre_activation_redirect');

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
if ( !function_exists('itre_setup') ) {
	function itre_setup() {
		/*
			* Make theme available for translation.
			* Translations can be filed in the /languages/ directory.
			* If you're building a theme based on IT Residence, use a find and replace
			* to change 'it-residence' to the name of your theme in all the template files.
			*/
		load_theme_textdomain( 'it-residence', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
			* Let WordPress manage the document title.
			* By adding theme support, we declare that this theme does not use a
			* hard-coded <title> tag in the document head, and expect WordPress to
			* provide it for us.
			*/
		add_theme_support( 'title-tag' );

		/*
			* Enable support for Post Thumbnails on posts and pages.
			*
			* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
			*/
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'it-residence' ),
				'menu-2' => esc_html__(	'Mobile', 'it-residence' )
			)
		);

		/*
			* Switch default core markup for search form, comment form, and comments
			* to output valid HTML5.
			*/
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'itre_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 100,
				'width'       => 300,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		add_theme_support( 'block-templates' );
		add_theme_support( 'block-template-parts' );

		add_image_size('itre_prop_thumb', 600, 420, true);
		add_image_size( 'related_logo', 400, 150, true );
		add_image_size( 'itre_feat_thumb', 400, 500, true );
		add_image_size( 'itre_sq_thumb', 500, 500, true );
	}
}
add_action( 'after_setup_theme', 'itre_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
if ( !function_exists('itre_content_width') ) {
	function itre_content_width() {
		$GLOBALS['content_width'] = apply_filters( 'itre_content_width', 640 );
	}
}
add_action( 'after_setup_theme', 'itre_content_width', 0 );

/**
 *	Include the plugin.php file in wp-admin folder to use is_plugin_active() on front-end
 */
 include_once ABSPATH . 'wp-admin/includes/plugin.php';

/**
 *	Enqueue Scripts and Styles
 */
require get_template_directory() . '/framework/theme-setup/enqueue_scripts.php';
require get_template_directory() . '/framework/theme-setup/admin_scripts.php';

/**
 *	Register Sidebars
 */
 require get_template_directory() . '/framework/theme-setup/register_sidebars.php';

/**
 * Include Metabox for Pages
 */
require get_template_directory() . '/framework/metabox/display-options.php';

/**
 *	Including Properties
 */
if (class_exists('IT_Listings') || class_exists('IT_Listings_Pro')) {
	require get_template_directory() . '/inc/property-functions.php';
}

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 *	Menu Walker for Mobiles
 */
require get_template_directory() . '/inc/walker.php';

/**
 *	Custom Colors
 */
require get_template_directory() . '/inc/colors.php';

/**
 *	Custom CSS generated through PHP
 */
require get_template_directory() . '/inc/css-mods.php';

/**
 *	Theme Starter Content
 */
require get_template_directory() . '/inc/starter-content.php';

/**
 *	Theme Page
 */
require get_template_directory() . '/inc/theme-page.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 *	Google Fonts Functionality
 */
require get_template_directory() . '/inc/google-fonts.php';

/**
 *	Block Styles for the theme
 */
require get_template_directory() . '/inc/block-styles.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/framework/customizer/customizer.php';

include_once get_template_directory() . '/inc/class-plugins-install.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}
