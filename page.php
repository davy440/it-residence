<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package IT_Residence
 */

 $has_sidebar = get_post_meta( get_the_ID(), 'enable-sidebar', 'yes' );
 $sidebar_align = get_post_meta( get_the_ID(), 'align-sidebar', 'right' );
get_header();

	if ( $sidebar_align == 'left' ) {
		itre_get_sidebar('page');
	}
	?>

		<main id="primary" class="site-main wp-block-group has-global-padding is-layout-constrained wp-block-group-is-layout-constrained">

			<?php
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->

	<?php
	if ( $sidebar_align == 'right' ) {
		itre_get_sidebar('page');
	}

get_footer();
