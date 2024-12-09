<?php
/**
 *  Functions for Property Custom Post Type
 *
 * @package IT Residence
 */
if (!defined('ABSPATH')) {
	exit;
}

if ( !function_exists('itre_get_for') ) {
    function itre_get_for( $value ) {

        $for = "";

        switch ($value):
            case "sold":
                $for = "sold";
            break;
            case "coming-soon":
                $for = "coming soon";
            break;
            case "active":
                $for = "active";
            break;
            case "sale":
                $for = "sale";
            break;
            case "rent":
                $for = "rent";
            break;
            default:
            	$for = "";
        endswitch;

        printf('<span class="itre-for-tag %s">%s</span>', esc_attr($value), esc_html($for));
    }
}

if ( !function_exists('itre_property_filter_form') ) {
	function itre_property_filter_form() {
		?>
		<div class="itre-property-filter-wrapper container">
			<div class="itre-property-filter">
				<form id="itre-property-filter-form" method="post">
					<div class="row align-items-center">
					<div class="filter-fields col-md-9">

						<div class="row">
							<div class="itre-type form-control-wrapper col-md-4">
								<?php
								$types_list = [];
								$types = get_terms(['taxonomy' => 'property-type', ]);
								foreach($types as $type) {
									$types_list[$type->slug] = $type->name;
								}
								?>
								<select id="property-type" name="type">
									<option value="0"><?php _e('Type', 'it-residence'); ?>
									<?php foreach($types_list as $key => $value) { ?>
										<option value="<?php echo esc_attr($key); ?>"><?php echo esc_html($value); ?></option>
									<?php
									}
									?>
								</select>
							</div>

							<div class="itre-min-area form-control-wrapper col-md-4">
								<input class="form-control-min-area" type="number" name="min-area" id="min-area" min="0" placeholder="<?php esc_attr_e("Min Area", 'it-residence'); ?>" autocomplete="off" value="" />
							</div>

							<div class="itre-max-area form-control-wrapper col-md-4">
								<input class="form-control-max-area" type="number" name="max-area" id="max-area" min="0" placeholder="<?php esc_attr_e('Max Area', 'it-residence'); ?>" autocomplete="off" value="" />
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
								<input class="form-control-min-price" type="number" name="min-price" min="0" id="min-price" placeholder="<?php esc_attr_e('Min Price', 'it-residence'); ?>" autocomplete="off" value="" />
							</div>

							<div class="itre-max-price form-control-wrapper col-md-4">
								<input class="form-control-max-price" type="number" name="max-price" min="0" id="max-price" placeholder="<?php esc_attr_e('Max Price', 'it-residence'); ?>" autocomplete="off" value="" />
							</div>
						</div>
					</div>

					<div class="filter-btn col-md-3">
						<input type="submit" value="<?php esc_attr_e('Submit', 'it-residence'); ?>"/>
					</div>
					</div>
				</form>
			</div>
		</div>
		<?php
	}
}
add_action('itre_property_filter', 'itre_property_filter_form');

if ( !function_exists('itre_property_listing') ) {
	function itre_property_listing() {
		?>

		<div class="itre-property-listing section container">
			<?php
			$args = array(
				'post_type'			=>	'property',
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
	<?php
	}
}
 add_action('itre_property_filter', 'itre_property_listing', 20);


if ( !function_exists('itre_get_filtered_properties') ) {
	
	/**
	 * AJAX Query for filtered properties
	 *
	 * @return  void
	 */
	function itre_get_filtered_properties() {
		if (!wp_create_nonce($_POST['nonce'], 'filter_properties')) {
			exit('Unauthorized Access');
		}

		$args = array(
			'post_type'				=>	'property',
			'ignore_sticky_posts'	=>	true,
			'posts_per_page'		=>	-1
		);

		if (!empty($_POST['bedrooms'])) {
			$args['meta_query'][] = array(
				'key'	=>	'bedrooms',
				'value'	=>	intval($_POST['bedrooms']),
				'type'	=>	'NUMERIC',
			);
		}

		if (!empty($_POST['type'])) {
			$args['tax_query'][] = array(
				'taxonomy'	=>	'property-type',
				'field'	=>	'slug',
				'terms'	=>	$_POST['type']
			);
		}

		if (!empty($_POST['min-price']) && !empty($_POST['max-price'])) {
			$args['meta_query'][] = array(
				'key'		=>	'price',
				'value'		=>	[intval($_POST['min-price']), intval($_POST['max-price'])],
				'compare'	=>	'BETWEEN'
			);
		}

		if (!empty($_POST['min-price']) && empty($_POST['max-price'])) {
			$args['meta_query'][] = array(
				'key'		=>	'price',
				'value'		=>	intval($_POST['min-price']),
				'compare'	=>	'>='
			);
		}
		
		if (empty($_POST['min-price']) && !empty($_POST['max-price'])) {
			$args['meta_query'][] = array(
				'key'		=>	'price',
				'value'		=>	intval($_POST['max-price']),
				'compare'	=>	'<='
			);
		}

		if (!empty($_POST['min-area']) && !empty($_POST['max-area'])) {
			$args['meta_query'][] = array(
				'key'		=>	'area',
				'value'		=>	[intval($_POST['min-area']), intval($_POST['max-area'])],
				'compare'	=>	'BETWEEN'
			);
		}

		if (!empty($_POST['min-area']) && empty($_POST['max-area'])) {
			$args['meta_query'][] = array(
				'key'		=>	'area',
				'value'		=>	intval($_POST['min-area']),
				'type'		=>	'NUMERIC',
				'compare'	=>	'>='
			);
		}
		
		if (empty($_POST['min-area']) && !empty($_POST['max-area'])) {
			$args['meta_query'][] = array(
				'key'		=>	'area',
				'value'		=>	intval($_POST['max-area']),
				'compare'	=>	'<='
			);
		}
		
		$filter_query = new WP_Query( $args );
		
		// The Loop
		if ( $filter_query->have_posts() ) :
			while ( $filter_query->have_posts() ) : $filter_query->the_post();
				global $post;
				get_template_part('template-parts/content', 'property');
			endwhile;
		endif;

		// Reset Post Data
		wp_reset_postdata();
			
		
		wp_die();
	}
}
add_action('wp_ajax_filter_properties', 'itre_get_filtered_properties');
add_action('wp_ajax_nopriv_filter_properties', 'itre_get_filtered_properties');

 //Pass Variables to JS for use in AJAX
 if ( !function_exists('itre_localize_ajax_data') ) {
	function itre_localize_ajax_data() {
		
		$data['action_filter']    	= 'filter_properties';
		$data['nonce_filter']		= wp_create_nonce('filter_properties');
		$data['ajaxurl']    		= admin_url('admin-ajax.php');
		
		wp_localize_script( 'itre-property-js', 'filter', $data );
	}
}
add_action('wp_enqueue_scripts', 'itre_localize_ajax_data');