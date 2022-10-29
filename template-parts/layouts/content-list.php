<?php
/**
 * Template part for the list layout
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package IT_Residence
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('list'); ?>>
    <div class="row">
        <div class="itre-list-thumb-wrapper col-md-4">

            <?php
                if ( has_post_thumbnail()) {
                    printf('<a href="%s">%s</a>', get_the_permalink(), get_the_post_thumbnail(get_the_ID(), 'itre_sq_thumb'));
                } else {
                    printf('<a href="%s"><img src="%s" alt="%s" /></a>', get_the_permalink(), esc_url(get_template_directory_uri() . '/assets/images/ph_square.png'), esc_attr( the_title_attribute(['echo' => false]) ) );
                }
            ?>
        </div>

        <div class="itre-list-content-wrapper col-md-8">
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

        	<div class="entry-content">
        		<?php
        		itre_get_blog_excerpt( null, 30 );
        		?>
        	</div><!-- .entry-content -->

            <div class="itre-read-more">
                <?php
                printf('<a href="%s" rel="bookmark">%s</a>', get_the_permalink(), __('Read More', 'it-residence'));
                ?>
            </div>
        </div>
    </div>

</article><!-- #post-<?php the_ID(); ?> -->
