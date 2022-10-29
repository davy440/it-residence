<?php
/**
 *
 *  Functions for Property Custom Post Type
 *
 */

 function itre_property_filter_form() {
 	?>
 	<div class="itre-property-filter container">
		<form id="itre-property-filter-form" method="post">
			<div class="row align-items-center">
			<div class="filter-fields col-md-9">

				<div class="row">
					<div class="itre-type form-control-wrapper col-md-4">
						<?php
						$types_list = [];
						$types = get_terms('property-type');
						foreach($types as $type) {
							$types_list[$type->slug] = $type->name;
						}
						?>
						<select id="property-type" name="type">
							<option value="0"><?php _e('Type', 'it-residence'); ?>
							<?php foreach($types_list as $key => $value) { ?>
								<option value="<?php echo $key ?>"><?php echo $value ?></option>
							<?php
							}
							?>
						</select>
					</div>

					<div class="itre-min-area form-control-wrapper col-md-4">
						<input class="form-control-min-area" type="number" name="min-area" id="min-area" placeholder="<?php esc_attr_e("Min Area", 'it-residence'); ?>" autocomplete="off" value="" />
					</div>

					<div class="itre-max-area form-control-wrapper col-md-4">
						<input class="form-control-max-area" type="number" name="max-area" id="max-area" placeholder="<?php esc_attr_e('Max Area', 'it-residence'); ?>" autocomplete="off" value="" />
					</div>

					<div class="itre-bedrooms form-control-wrapper col-md-4">
							<select class="form-control-bedrooms" name="bedrooms" id="bedrooms" placeholder="<?php esc_attr_e("Bedrooms", 'it-residence'); ?>">
							<option value="0"><?php _e("Bedrooms", 'it-residence'); ?></option>
							<option value="1"><?php _e("1", 'it-residence'); ?></option>
							<option value="2"><?php _e("2", 'it-residence'); ?></option>
							<option value="3"><?php _e("3", 'it-residence'); ?></option>
							<option value="4"><?php _e("4", 'it-residence'); ?></option>
							<option value="5"><?php _e("5", 'it-residence'); ?></option>
							<option value="5+"><?php _e("5+", 'it-residence'); ?></option>
						</select>
					</div>

					<div class="itre-min-price form-control-wrapper col-md-4">
						<input class="form-control-min-price" type="number" name="min-price" id="min-price" placeholder="<?php esc_attr_e('Min Price', 'it-residence'); ?>" autocomplete="off" value="" />
					</div>

					<div class="itre-max-price form-control-wrapper col-md-4">
						<input class="form-control-max-area" type="number" name="max-price" id="max-price" placeholder="<?php esc_attr_e('Max Price', 'it-residence'); ?>" autocomplete="off" value="" />
					</div>
				</div>
			</div>

			<div class="filter-btn col-md-3">
				<button type="button"><?php esc_html_e('Submit', 'it-residence'); ?></button>
			</div>
			</div>
		</form>
 	</div>
 	<?php
 }
 add_action('itre_property_filter', 'itre_property_filter_form');

 function itre_property_listing() {
 	?>

 	<div class="itre-property-listing section container">
 		<div class="row">
 		<?php
 		$args = array(
 			'post_type'	=>	'property',
 			'posts_per_page'	=>	9
 		);

 		$prop_query = new WP_Query( $args );

 			// The Loop
 			if ( $prop_query->have_posts() ) :
 			while ( $prop_query->have_posts() ) : $prop_query->the_post();

 			  global $post;

              get_template_part('template-parts/content', 'property');

 			endwhile;
 			endif;

 			// Reset Post Data
 			wp_reset_postdata();
 		?>
 		</div>
 	</div>
 <?php
}
 add_action('itre_property_filter', 'itre_property_listing', 20);

 // AJAX Query for filtered properties
 function itre_get_ajax_property() {

     check_ajax_referer( 'itre_ajax_property', 'security' );

 	$type 		= $_POST['type'];
    $nonce      = $_POST['nonce'];
 	$beds 		= intval($_POST['beds']);
 	$minPrice	= intval($_POST['minPrice']);
 	$maxPrice	= intval($_POST['maxPrice']);
 	$minArea	= intval($_POST['minArea']);
 	$maxArea	= intval($_POST['maxArea']);

 	$price		= array($minPrice, $maxPrice);
 	$area		= [intval($_POST['minArea']), intval($_POST['maxArea'])];

 	$args = array(
 		'post_type'		=>	'property',
 		'posts_per_page'=>	-1
 	);

 	if ( !empty($type) ) {
 		$args['tax_query'] = array(
 			array(
 				'taxonomy'	=>	'property-type',
 				'field'		=>	'slug',
 				'terms'		=>	$type
 			)
 		);
 	}

 	if ( !empty($beds) ) {
 		$args['meta_query'][]	=	array(
 			'key'	=>	'bedrooms',
 			'value'	=>	$beds,
 			'type'	=>	'NUMERIC'
 		);
 	}

 	if ( !empty($minPrice) && !empty($maxPrice) ) {
 		$args['meta_query'][]	=	array(
 			'key'		=>	'price',
 			'value'		=>	$price,
 			'type'		=>	'numeric',
 			'compare'	=>	'BETWEEN'
 		);
 	}

 	if ( !empty($minPrice) && empty($maxPrice) ) {
 		$args['meta_query'][]	=	array(
 			'key'		=>	'price',
 			'value'		=>	$minPrice,
 			'type'		=>	'numeric',
 			'compare'	=>	'>='
 		);
 	}

 	if ( empty($minPrice) && !empty($maxPrice) ) {
 		$args['meta_query'][]	=	array(
 			'key'		=>	'price',
 			'value'		=>	$maxPrice,
 			'type'		=>	'numeric',
 			'compare'	=>	'<='
 		);
 	}

 	if ( !empty($minArea) && !empty($maxArea) ) {
 		$args['meta_query'][]	=	array(
 			'key'		=>	'area',
 			'value'		=>	$area,
 			'type'		=>	'numeric',
 			'compare'	=>	'BETWEEN'
 		);
 	}

 	if ( !empty($minArea) && empty($maxArea) ) {
 		$args['meta_query'][]	=	array(
 			'key'		=>	'area',
 			'value'		=>	$minArea,
 			'type'		=>	'numeric',
 			'compare'	=>	'>='
 		);
 	}

 	if ( empty($minArea) && !empty($maxArea) ) {
 		$args['meta_query'][]	=	array(
 			'key'		=>	'area',
 			'value'		=>	$maxArea,
 			'type'		=>	'numeric',
 			'compare'	=>	'<='
 		);
 	}

 	$prop_query = new WP_Query( $args );

 	// The Loop
 	if ( $prop_query->have_posts() ) :

 	echo '<div class="row">';
 	while ( $prop_query->have_posts() ) : $prop_query->the_post();

 	global $post;

 	get_template_part('template-parts/content', 'property');

 	endwhile;
 	echo '</div>';
 	endif;

 	// Reset Post Data
 	wp_reset_postdata();

 	wp_die();
 }
 add_action('wp_ajax_itre_ajax_property', 'itre_get_ajax_property');
 add_action('wp_ajax_nopriv_itre_ajax_property', 'itre_get_ajax_property');

 //Pass Variables to JS for use in AJAX
 function itre_localize_ajax_data() {

     $data['nonce']     = wp_create_nonce('itre_ajax_property');
     $data['ajaxurl']    = admin_url('admin-ajax.php');
     wp_localize_script( 'itre-property-js', 'itre', $data );

 }
 add_action('wp_enqueue_scripts', 'itre_localize_ajax_data', 20);


 //Featured Property Types Section
 function itre_featured_types() {

     if ( !is_front_page() || empty(get_theme_mod('itlst_featured_types_enable', '') ) ) {
         return;
     }
     ?>

     <div id="itre-featured-types" class="section container">

         <div class="section-top">
             <?php
             if ( !empty( get_theme_mod( 'itlst_feat_types_title' ) ) ) {
                 printf('<h2 class="section-title">%s</h2>', esc_html( get_theme_mod( 'itlst_feat_types_title', '' ) ) );
             }

             if ( !empty( get_theme_mod( 'itlst_feat_types_subtitle' ) ) ) {
                 printf('<p class="section-sub">%s</p>', esc_html( get_theme_mod( 'itlst_feat_types_subtitle', '' ) ) );
             }
             ?>
        </div>


         <div class="row">

             <?php
             for ($i = 1; $i <= 4; $i++ ) {

                 $term   = get_term_by( 'id', get_theme_mod( 'itlst_feat_prop_' . $i, ''), 'property-type' );

                 if ( empty( $term ) ) {
                     continue;
                 }

                 $img    = wp_get_attachment_image( attachment_url_to_postid( get_theme_mod( 'itlst_feat_type_img_' . $i , '' ) ), 'itre_feat_thumb' );

                 $img = !empty( $img ) ? $img : sprintf( '<img src="%s" />', esc_url( get_template_directory_uri() . '/assets/images/ph_types.png' ) );

                 $term_url = get_term_link( $term );

                 ?>
                 <div class="itre-prop-type-wrapper col-md-6 col-lg-3">
                 <div class="itre-prop-type-item">
                     <?php

                         printf( '<a href="%s">%s</a>', $term_url, $img );

                         printf( '<h3 class="itre-prop-type-name">%s</h3>', esc_html( $term->name ) );
                     ?>
                 </div>
                 </div>
             <?php
             }
             ?>
         </div>
     </div>
 <?php
 }
 add_action('itre_property_filter', 'itre_featured_types', 30);


 //Featured Locations Section
 function itre_featured_locations() {

     if ( !is_front_page() || empty(get_theme_mod('itlst_featured_locations_enable', '') ) ) {
         return;
     }
     ?>

     <div id="itre-featured-locations" class="section container">

         <div class="section-top">
         <?php
             if ( !empty( get_theme_mod( 'itlst_feat_locations_title' ) ) ) {
                 printf('<h2 class="section-title">%s</h2>', esc_html( get_theme_mod( 'itlst_feat_locations_title', '' ) ) );
             }

             if ( !empty( get_theme_mod( 'itlst_feat_locations_subtitle' ) ) ) {
                 printf('<p class="section-sub">%s</p>', esc_html( get_theme_mod( 'itlst_feat_locations_subtitle', 'Find out the best properties in your area' ) ) );
             }
             ?>
        </div>

         <div class="feat-locations-wrapper">
             <div class="row g-0">

                 <?php
                 for ($i = 1; $i <= 4; $i++ ) {

                     $term  = get_term_by( 'id', get_theme_mod( 'itlst_feat_location_' . $i, ''), 'location' );

                     $img   = wp_get_attachment_image( attachment_url_to_postid( get_theme_mod( 'itlst_feat_location_img_' . $i , '' ) ), 'itre_sq_thumb' );

                     $img = !empty( $img ) ? $img : sprintf( '<img src="%s" />', esc_url( get_template_directory_uri() . '/assets/images/ph_square.png' ) );

                     if ( empty( $term ) ) {
                         continue;
                     }

                     //We are here, that means a Location has been set
                     $term_url = get_term_link( $term );

                     ?>
                     <div class="itre-location-wrapper col-md-6">
                     <div class="itre-location-item">
                         <div class="row align-items-center g-0">
                         <?php
                             printf( '<div class="col-6"><h3 class="itre-prop-location-name"><a href="%s">%s</a></h3></div>', $term_url, esc_html( $term->name ) );

                             printf( '<div class="col-6"><a href="%s">%s</a></div>', $term_url, $img );
                         ?>
                         </div>
                     </div>
                     </div>
                 <?php
                 }
                 ?>
             </div>
         </div>
     </div>
 <?php
 }
 add_action( 'itre_property_filter', 'itre_featured_locations', 40 );


 /**
  *
  *  Testimonials Section
  *
  */
 function itre_testimonials() {

     if ( !is_front_page() || empty(get_theme_mod('itlst_agents_enable', '') ) ) {
         return;
     }
     ?>

     <div id="itre-testimonials" class="container section">

         <div class="section-top">
             <?php
             if ( !empty( get_theme_mod( 'itlst_tests_title' ) ) ) {
                 printf('<h2 class="section-title">%s</h2>', esc_html( get_theme_mod( 'itlst_tests_title', '' ) ) );
             }
             ?>
        </div>

         <div class="testimonials-wrapper owl-carousel">
                 <?php

                 $test_args = array(
                         'post_type'			=>	'testimonial',
                         'posts_per_page'	=>	-1
                     );

                     $test_query	= new WP_Query($test_args);

                     if ($test_query->have_posts()) :
                         while ($test_query->have_posts() ) : $test_query->the_post();

                             global $post;
                             ?>

                             <div class="itre-testimonial">
     							<div class="test-author-thumb">
     							<?php
     								if (has_post_thumbnail()) :
     									the_post_thumbnail('thumbnail');
     								endif;

                                     printf( '<h3 class="test-name">%s</h3>',$post->post_title );
                                     printf( '<p class="test-info">%s</p>', get_post_meta($post->ID, 'title', true) );
     							?>
     							</div><!-- .test-author-thumb -->

     							<div class="test-text">
     								<?php wp_strip_all_tags(the_content()); ?>
     							</div><!-- .test-text -->

     						</div><!-- .testimonial -->

                         <?php
                         endwhile;
                     endif;
                     wp_reset_postdata();
                 ?>
         </div>
     </div>
 <?php
 }
 add_action('itre_property_filter', 'itre_testimonials', 60);


function itre_from_the_blog() {

    if ( !is_front_page() || empty(get_theme_mod('itlst_front_blog_enable') ) ) {
        return;
    }
    ?>

    <div id="itre-front-blog" class="section container">

        <div class="section-top">
            <?php
            if ( !empty( get_theme_mod( 'itlst_front_blog_title' ) ) ) {
                printf('<h2 class="section-title">%s</h2>', esc_html( get_theme_mod( 'itlst_front_blog_title', 'From the Blog' ) ) );
            }
            ?>
        </div>

		<div class="itre-front-posts row">
		<?php
			$args = array(
				'post_type'				=>	'post',
				'ignore_sticky_posts'	=>	true,
				'posts_per_page'		=>	3,
                'orderby'               =>  'rand'
			);

			$blog_query	=	new WP_Query( $args );

			// The Loop
			if ( $blog_query->have_posts() ) :
			while ( $blog_query->have_posts() ) : $blog_query->the_post();

				global $post;

                get_template_part("template-parts/layouts/content", "col", "col3");

			endwhile;
			endif;

			// Reset Post Data
			wp_reset_postdata();
			?>
		</div>

		<div class="itre-front-blog-cta"><a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>"><?php _e('Show All', 'it-residence'); ?></a></div>
	</div>
<?php
}
add_action('itre_property_filter', 'itre_from_the_blog', 65);
