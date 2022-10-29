<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package IT_Residence
 */

 $sidebar_align = get_theme_mod( 'itre_single_sidebar_layout', 'right' );

get_header(null, array('header' => 'default'));

if ( $sidebar_align == 'left' ) {
	itre_get_sidebar('single');
}
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );

			if ( get_theme_mod('itre_single_author_enable', '1')) {
				itre_about_author( $post );
			}

			if ( get_theme_mod( 'itre_single_navigation_enable', '1' ) ) {
				the_post_navigation(
					array(
						'prev_text' => '<div class="nav-subtitle">' . esc_html__( 'Previous', 'it-residence' ) . '</div> <span class="nav-title"><strong>%title</strong></span>',
						'next_text' => '<div class="nav-subtitle">' . esc_html__( 'Next', 'it-residence' ) . '</div> <span class="nav-title"><strong>%title</strong></span>',
					)
				);
			}

			if ( get_theme_mod('itre_single_related_enable', 1)) {
				itre_get_related_posts();
			}

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->


<?php
if ( $sidebar_align == 'right' ) {
	itre_get_sidebar('single');
}
get_footer();
