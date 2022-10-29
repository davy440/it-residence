<?php
/**
 * The template for displaying property pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package IT_Residence
 */

 $sidebar_align = get_theme_mod( 'itre_property_sidebar_layout', 'right' );

get_header();

if ( $sidebar_align == 'left' ) {
	itre_get_sidebar('property');
}
?>

	<main id="primary" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="property-description">', '</div>' );
				?>
			</header><!-- .page-header -->

            <div class="row">

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part('template-parts/content', 'property', get_theme_mod('itre_property_layout', 'col3') );

			endwhile;
            ?>
            </div>
            <?php

            the_posts_pagination( apply_filters( 'itre_posts_pagination_args', array(
				'class'	=>	'itre-pagination',
				'prev_text'	=> '<i class="fa fa-angle-left"></i>',
				'next_text'	=> '<i class="fa fa-angle-right"></i>'
			) ) );

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php
if ( $sidebar_align == 'right' ) {
	itre_get_sidebar('property');
}
get_footer();
