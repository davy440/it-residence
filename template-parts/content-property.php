<?php
/**
 *
 *	Template for displaying property listing
 *
 */

$itre_stored_meta = get_post_meta( get_the_ID() );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('grid'); ?>>
	 <div class="listing-wrapper">
		 <div class="itre-prop-thumb">

			<?php
			if (!empty($itre_stored_meta["for"][0])) {
				itre_get_for( $itre_stored_meta["for"][0] );
			}
			
			printf('<a href="%s">', esc_url(get_the_permalink()));
			
			if ( has_post_thumbnail() ) {
				printf('<figure>%s</figure>', get_the_post_thumbnail( get_the_ID(), 'itre_prop_thumb' ));
			}
			else {
				printf('<img src="%s" alt="%s">', esc_url(ITRE_URL . 'images/ph_thumb.png'), esc_attr( get_the_title() ));
			}

			if (!empty($itre_stored_meta['price'][0])) {
				itre_get_property_price( $itre_stored_meta['price'][0] );
			} ?>
		 	</a>
		 </div>

	 	<header class="entry-header">
	 		<?php
	 			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			?>
	 	</header><!-- .entry-header -->

		<?php
			$address = $itre_stored_meta[ 'address' ][0] ?? '';
			$street = $itre_stored_meta[ 'streetName' ][0] ?? '';
			$city = $itre_stored_meta[ 'city' ][0] ?? '';
			$province = $itre_stored_meta[ 'province' ][0] ?? '';
			$country = $itre_stored_meta[ 'country' ][0] ?? '';
			$zip = $itre_stored_meta[ 'zip' ][0] ?? '';
			
			if (!empty($province)) {
				$province = ', ' . $province;
			}
			
			$address = sprintf('<div class="itre_address">%s<br>%s%s<br>%s %s</div>', $street, $city, $province, Locale::getDisplayRegion('-' . $country, 'en'), $zip);
			if (!empty( wp_strip_all_tags( $address ))) {
				echo $address;
			} else if (!empty($address)){
				printf('<div class="itre_address">%s</div>', $address);
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
				printf( '<span class="itre_area"><i class="fa fa-area-chart" aria-hidden="true"></i><span class="itre_area">%u sq. ft.</span></span>', $itre_stored_meta[ 'area' ][0] );
			}

            if ( !empty( $itre_stored_meta[ 'stories' ][0] ) ) {
				printf( '<span class="itre_stories"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"><title>Untitled-6</title><polygon points="2.48 16 0 16 0 9.01 4.51 9.01 4.51 4.51 9.01 4.51 9.01 0 16 0 16 2.48 11.49 2.48 11.49 6.99 6.99 6.99 6.99 11.49 2.48 11.49 2.48 16"/></svg><span class="itre_stories">%u</span></span>', $itre_stored_meta[ 'stories' ][0] );
			}

            if ( !empty( $itre_stored_meta[ 'garage' ][0] ) ) {
				printf( '<span class="garage"><svg xmlns="http://www.w3.org/2000/svg" width="16.07" height="16.07" viewBox="0 0 16.07 16.07"><title>garage</title><path d="M2.8,16.09H.54a.57.57,0,0,1-.61-.62V4.67a.65.65,0,0,1,.38-.61L5.75,1.13l1.86-1a.68.68,0,0,1,.7,0q3.66,2,7.33,4a.64.64,0,0,1,.36.61V15.44a.58.58,0,0,1-.64.65H13.13V7c0-.49-.21-.7-.7-.7H3.48c-.47,0-.68.21-.68.69v9.07Z" transform="translate(0.07 -0.03)"/><path d="M12,9.2H4V7.49h8Z" transform="translate(0.07 -0.03)"/><path d="M12,10.36v1.7H4v-1.7Z" transform="translate(0.07 -0.03)"/><path d="M4,14.93v-1.7h8v1.7Z" transform="translate(0.07 -0.03)"/></svg><span class="itre_garage">%u</span></span>', $itre_stored_meta[ 'garage' ][0] );
			}
			?>
		</div>
	</div>
 </article><!-- #post-<?php the_ID(); ?> -->
