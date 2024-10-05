<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package IT_Residence
 */

 $sidebar_align = get_theme_mod( 'itre_blog_sidebar_layout', 'right' );
 $layout = get_theme_mod('itre_blog_layout', 'classic');

get_header();

if ( $sidebar_align == 'left' ) {
	itre_get_sidebar( 'blog' );
}
?>

	<main id="primary" class="site-main container">

		<?php
		if ( have_posts() ) :
			?>
			<div class="itre-blog-wrapper <?php echo $layout; ?>">
			<?php

			/* Start the Loop */
			while ( have_posts() ) :
				the_post();
				 itre_get_layout($layout);
			endwhile;
			?>

			</div>

			<?php
            the_posts_pagination(  array(
				'class'					=>	'itre-pagination',
				'prev_text'				=> '<span class="arrow-prev"><i class="fa fa-angle-left" aria-hidden="true"></i></span>',
				'next_text'				=> '<span class="arrow-next"><i class="fa fa-angle-right" aria-hidden="true"></i></span></i>'
			) );

		else :

			get_template_part( 'templπEate-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php
if ( $sidebar_align == 'right' ) {
	itre_get_sidebar( 'blog' );
}
get_footer();
