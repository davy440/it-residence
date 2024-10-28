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
	define( 'ITRE_VERSION', wp_get_theme()->get('Version') );
}

if ( ! defined( 'ITRE_URL' ) ) {
	define( 'ITRE_URL', trailingslashit( get_template_directory_uri() ) );
}

if ( ! defined( 'ITRE_PATH' ) ) {
	define( 'ITRE_PATH', trailingslashit( get_template_directory() ) );
}

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
		load_theme_textdomain( 'it-residence', ITRE_PATH . 'languages' );

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
require ITRE_PATH . 'framework/theme-setup/enqueue_scripts.php';
require ITRE_PATH . 'framework/theme-setup/admin_scripts.php';

/**
 *	Register Sidebars
 */
 require ITRE_PATH . 'framework/theme-setup/register_sidebars.php';

/**
 * Include Metabox for Pages
 */
require ITRE_PATH . 'framework/metabox/display-options.php';

/**
 * Include Metabox for properties
 */
if (class_exists('IT_Listings')) {
	require ITRE_PATH . 'framework/metabox/property-metabox.php';
}

/**
 *	Including Properties
 */
if ( class_exists('IT_Listings') ) {
	require ITRE_PATH . 'inc/property-functions.php';
}

/**
 * Implement the Custom Header feature.
 */
require ITRE_PATH . 'inc/custom-header.php';

/**
 *	Menu Walker for Mobiles
 */
require ITRE_PATH . 'inc/walker.php';

/**
 *	Custom Colors
 */
require ITRE_PATH . 'inc/colors.php';

/**
 *	Custom CSS generated through PHP
 */
require ITRE_PATH . 'inc/css-mods.php';

/**
 *	Theme Starter Content
 */
require ITRE_PATH . 'inc/starter-content.php';

/**
 * The notice in the dashboard
 */
require ITRE_PATH . 'inc/notice.php';

/**
 * Require Library to hide notice permanently
 * https://github.com/w3guy/persist-admin-notices-dismissal/tree/master
 */
require ITRE_PATH . 'inc/persist-admin-notices-dismissal.php';

/**
 *	Theme Page
 */
require ITRE_PATH . 'inc/theme-page.php';

/**
 * Custom template tags for this theme.
 */
require ITRE_PATH . 'inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require ITRE_PATH . 'inc/template-functions.php';

/**
 *	Google Fonts Functionality
 */
require ITRE_PATH . 'inc/google-fonts.php';

/**
 *	Block Styles for the theme
 */
require ITRE_PATH . 'inc/block-styles.php';

/**
 * Customizer additions.
 */
require ITRE_PATH . 'framework/customizer/customizer.php';

/**
 * Add the Plugin Install class
 */
require ITRE_PATH . 'inc/class-plugins-install.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require ITRE_PATH . 'inc/jetpack.php';
}