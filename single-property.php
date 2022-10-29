<?php
/**
 * The template for displaying single properties.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @since 1.0.0
 */
get_header( null, array( 'header' => 'default' ) );
?>

<main id="primary" class="property-content container" role="main">

	<?php
	if ( have_posts() ) {

		while ( have_posts() ) {

			the_post();

            get_template_part('template-parts/content-single', 'property');

		}
		wp_reset_postdata();
	}
	?>

</main><!-- #site-content -->

<?php get_footer(); ?>
