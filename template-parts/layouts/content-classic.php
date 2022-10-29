<?php
/**
 * Template part for the classic layout
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package IT_Residence
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('classic'); ?>>
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
		itre_get_blog_excerpt( null, get_theme_mod('itre-blog-excerpt-length', 15) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php itre_cats_list(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
