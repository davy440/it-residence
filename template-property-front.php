<?php
/**
 * The template for displaying all pages
 *
 *	Template Name: Property Listings
 *
 */

 $header = is_front_page() ? get_theme_mod('itre_front_header_layout', 'default') : 'default';

get_header(null, ['header' => $header]);
?>

	<main id="primary" class="site-main">

		<?php
		if ( is_plugin_active('it-listings/it-listings.php') ) {

			do_action('itre_property_filter');

		}
		?>

	</main><!-- #main -->

<?php
get_footer();
