<?php
/**
 * Template part for displaying Single Properties
 *
 * @package IT_Residence
 */
$itre_stored_meta = get_post_meta( get_the_ID() );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
			the_title( '<h1 class="entry-title">', '</h1>' );
        ?>
	</header><!-- .entry-header -->

    <div class="entry-meta">

		<?php
		if (!empty($itre_stored_meta["for"][0])) {
			$for = $itre_stored_meta["for"][0] == "sale" ? "Sale" : "Rent";
			printf('<span class="itre-for-tag %s">%s</span>', esc_attr($itre_stored_meta["for"][0]),  esc_html($for));
		}
		?>

        <?php
        //Price of Property
        itre_get_property_price($itre_stored_meta['price'][0]);

		if (has_term( '', 'location' ) ) {
            printf( '<span class="itre_location"><i class="fa fa-map-marker" aria-hidden="true"></i><span>%s</span></span>', get_the_terms($post, 'location')[0]->name );
		}

        //Bedrooms
        if ( !empty( $itre_stored_meta[ 'bedrooms' ][0] ) ) {
            printf( '<span class="itre_bed"><i class="fa fa-bed" aria-hidden="true"></i><span class="itre_bed_count">%u</span></span>', $itre_stored_meta[ 'bedrooms' ][0] );
        }

        //Bathrooms
        if ( !empty( $itre_stored_meta[ 'bathrooms' ][0] ) ) {
            printf( '<span class="itre_shower"><i class="fa fa-shower" aria-hidden="true"></i><span class="itre_bed_count">%u</span></span>', $itre_stored_meta[ 'bathrooms' ][0] );
        }

        //Date of Property
        itre_posted_on();
        ?>
    </div><!-- .entry-meta -->

	<div class="entry-content">
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'it-residence' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);

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
