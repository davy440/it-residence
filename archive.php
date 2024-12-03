<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package IT_Residence
 */
$layout = get_theme_mod('itre_archive_layout', 'classic');
get_header();
?>

	<main id="primary" class="site-main container">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

            <div class="itre-archive-wrapper <?php echo esc_attr($layout); ?>">

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				itre_get_layout( get_theme_mod('itre_archive_layout', 'col3') );

			endwhile;
            ?>
            </div>
            <?php

			the_posts_pagination(  array(
				'class'					=>	'itre-pagination',
				'before_page_number'	=>	'<span>',
				'after_page_number'		=>	'</span>',
				'prev_text'				=> '<span class="arrow-prev"><i class="fa fa-angle-left" aria-hidden="true"></i></span>',
				'next_text'				=> '<span class="arrow-next"><i class="fa fa-angle-right" aria-hidden="true"></i></span></i>'
			) );

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php
get_footer();
