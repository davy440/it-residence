<?php
/**
 *
 *	Template for displaying property listing
 *
 */

$layout = "col-md-4";
if ( $args == 'col2') {
    $layout = 'col-md-6';
}

if ( $args == 'col3') {
    $layout = 'col-md-4';
}

if ( $args == 'col4') {
    $layout = 'col-md-3';
}
$itre_stored_meta = get_post_meta( get_the_ID() );
?>

 <article id="post-<?php the_ID(); ?>" <?php post_class($layout); ?>>

	 <div class="listing-wrapper">
		 <div class="itre-prop-thumb">

             <?php
             if (!empty($itre_stored_meta["for"][0])) {
                 $for = $itre_stored_meta["for"][0] == "sale" ? "Sale" : "Rent";
                 printf('<div class="itre-for-tag %s">%s</div>', esc_attr($itre_stored_meta["for"][0]),  esc_html($for));
             }
             ?>

			 <a href="<?php the_permalink(); ?>">
			 <?php
			 if ( has_post_thumbnail() ) {
				 the_post_thumbnail('itre_prop_thumb');
			 }
			 else {
				 printf('<img src="%s" alt="%s">', esc_url(get_template_directory_uri() . '/images/prop_ph.png'), esc_attr( get_the_title() ) );
			 }

			 $price = new NumberFormatter( $locale = 'en_US', NumberFormatter::CURRENCY );
			 $price->setTextAttribute( NumberFormatter::CURRENCY_CODE, 'USD');
			 $price->setAttribute( NumberFormatter::MAX_FRACTION_DIGITS, 0);

			 printf('<div class="prop-price"><span>%s</span></div>', $price->format($itre_stored_meta['price'][0]));
			 ?>
		 </a>

		 </div>

	 	<header class="entry-header">
	 		<?php
	 			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			?>
	 	</header><!-- .entry-header -->

		<?php
			if ( !empty( $itre_stored_meta[ 'address' ][0] ) ) {
				printf('<div class="itre_address">%s</div>', $itre_stored_meta[ 'address' ][0] );
			}
		?>

		<div class="itre_features">
			<?php
			if ( !empty( $itre_stored_meta[ 'bedrooms' ][0] ) ) {
				printf( '<span class="itre_bed"><i class="fa fa-bed" aria-hidden="true"></i><span class="itre_bed_count">%u</span></span>', $itre_stored_meta[ 'bedrooms' ][0] );
			}

			if ( !empty( $itre_stored_meta[ 'bathrooms' ][0] ) ) {
				printf( '<span class="itre_shower"><i class="fa fa-shower" aria-hidden="true"></i><span class="itre_bed_count">%u</span></span>', $itre_stored_meta[ 'bathrooms' ][0] );
			}

			if ( !empty( $itre_stored_meta[ 'area' ][0] ) ) {
				printf( '<span class="itre_area"><i class="fa fa-area-chart" aria-hidden="true"></i><span class="itre_area">%u</span></span>', $itre_stored_meta[ 'area' ][0] );
			}
			?>
		</div>
	</div>

 	<footer class="entry-footer">
 		<?php itre_entry_footer(); ?>
 	</footer><!-- .entry-footer -->
 </article><!-- #post-<?php the_ID(); ?> -->
