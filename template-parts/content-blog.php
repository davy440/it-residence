<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package IT_Residence
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		// if ( is_singular() ) :
		// 	the_title( '<h1 class="entry-title">', '</h1>' );
		// else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		// endif;

		//if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<?php
				itre_posted_on();
				itre_posted_by();
				?>
			</div><!-- .entry-meta -->
		<?php //endif; ?>
	</header><!-- .entry-header -->

	<?php itre_post_thumbnail(); ?>

	<div class="entry-content">
		<?php
		itre_get_blog_excerpt( null, 60 );

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'it-residence' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php itre_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
