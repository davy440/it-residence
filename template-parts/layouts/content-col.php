<?php
/**
 * Template part for the list layout
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package IT_Residence
 */
// var_dump($args);
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($args); ?>>
    <div class="itre-col-wrapper">
        <?php
            if ( has_post_thumbnail()) {
                printf('<a href="%s"><figure>%s</figure></a>', get_the_permalink(), get_the_post_thumbnail(get_the_ID(), 'itre_prop_thumb'));
            } else {
                printf('<a href="%s"><figure><img src="%s" alt="%s" /></figure></a>', get_the_permalink(), esc_url(ITRE_URL . 'assets/images/ph_thumb.png'), esc_attr( the_title_attribute(['echo' => false]) ) );
            }
        ?>
        
        <div class="itre-content-wrapper">
            <header class="entry-header">
                <?php
                the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
                ?>
                <div class="entry-meta">
                    <?php
                    itre_posted_on();
                    itre_posted_by();
                    ?>
                </div><!-- .entry-meta -->
            </header><!-- .entry-header -->

            <div class="entry-content">
                <?php
                itre_get_blog_excerpt( null, 30 );
                ?>
            </div><!-- .entry-content -->

            <div class="itre-read-more">
                <?php printf('<a href="%s" rel="bookmark">%s</a>', get_the_permalink(), __('Read More', 'it-residence')); ?>
            </div>
        </div>
    </div>
</article><!-- #post-<?php the_ID(); ?> -->
