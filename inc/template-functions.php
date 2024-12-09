<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package IT_Residence
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
if (!defined('ABSPATH')) {
	exit;
}

if ( ! function_exists( 'itre_body_classes' ) ) {
	function itre_body_classes( $classes ) {
		// Adds a class of hfeed to non-singular pages.
		if ( ! is_singular() ) {
			$classes[] = 'hfeed';
		}

		// Adds a class of no-sidebar when there is no sidebar present.
		if ( ( is_home() && is_active_sidebar( 'sidebar-blog' ) && !empty(get_theme_mod('itre_blog_sidebar_enable', '') ) ) ||
			!is_front_page() && is_page() && is_active_sidebar( 'sidebar-blog' ) && get_post_meta( get_the_ID(), 'enable-sidebar', true ) ) {
			$classes[] = 'has-sidebar';
		}

		return $classes;
	}
}
add_filter( 'body_class', 'itre_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
if ( ! function_exists('itre_pingback_header') ) {
	function itre_pingback_header() {
		if ( is_singular() && pings_open() ) {
			printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
		}
	}
}
add_action( 'wp_head', 'itre_pingback_header' );


if ( !function_exists('itre_get_header') ) {
	function itre_get_header() {
		require_once ITRE_PATH . 'framework/sections/header/header-default.php';
	}
}


if ( !function_exists('itre_get_top_bar') ) {
	function itre_get_top_bar() {
		?>
		<div class="container-fluid">
			<div class="d-flex align-items-center gap-3">

				<div class="branding-wrapper col-7 col-sm-5 col-lg-3">
					<?php get_template_part('framework/sections/header/modules/site', 'branding'); ?>
				</div>

				<?php
					$nav_width = empty( get_theme_mod('itre_cta_enable', '') ) ? 'col-md-9' : 'col-lg-6';
				?>
				<div class="nav-wrapper <?php echo esc_attr($nav_width) ?>">
					<?php get_template_part('framework/sections/header/modules/navigation'); ?>
				</div>

				<?php if ( !empty( get_theme_mod('itre_cta_enable') ) ) : ?>
					<div class="itre-cta-wrapper col-auto ms-auto">
						<?php
							printf("<a class='itre-cta' href='%s'>%s</a>", esc_url( get_theme_mod( 'itre_cta_id', '#' ) ), esc_html( get_theme_mod( 'itre_cta_text', 'Add Listing' ) ) );
						?>
					</div>
				<?php endif; ?>

				<div class="mobile-btn-wrapper col-auto <?php if ( !get_theme_mod("itre_cta_enable", "")) echo "ms-auto" ?>">
					<button href="#menu" class="menu-link mobile-nav-btn col-auto" aria-controls="menu" aria-expanded="false" aria-haspopup="true"><svg xmlns="http://www.w3.org/2000/svg" width="48" height="34.43" viewBox="0 0 48 34.43"><title>nav</title><rect width="48" height="3"/><rect y="15.72" width="48" height="3"/><rect y="31.43" width="48" height="3"/></svg></button>
				</div>

			</div>
		</div>
		<?php
	}
}


//Content Wrapper functions for the theme
if ( !function_exists('itre_get_content_wrapper_start') ) {
	function itre_get_content_wrapper_start( $layout = 'box' ) {

		if ( is_page_template('template-property-front.php') ) {
			echo '<div id="content" class="container-fluid"><div class="row">';
		}
		else if ( is_page_template('template-agent.php') ) {
			echo '<div id="content">';
		}
		else {
			switch ( $layout ) {
				case 'box' :
					echo '<div id="content" class="container box"><div class="row">';
				break;
				case 'full' :
					echo '<div id="content" class="full"><div class="container"><div class="row">';
				break;
				case 'full_s' :
					echo '<div id="content" class="container-fluid full_s"><div class="row">';
				break;
				default:
				echo '<div id="content" class="container box default"><div class="row">';
			}
		}
	}
}
add_action('itre_content_wrapper_start', 'itre_get_content_wrapper_start', 10, 1);

if ( !function_exists('itre_get_content_wrapper_end') ) {
	function itre_get_content_wrapper_end( $layout ) {
		if ( is_page_template('template-property-front.php') ) {
			echo '</div></div>';
		}
		else if ( is_page_template('template-agent.php') ) {
			echo '</div>';
		}
		else {
			switch ( $layout ) {
				case 'box' :
					echo '</div></div>';
				break;
				case 'full' :
					echo '</div></div></div>';
				break;
				case 'full_s' :
					echo '</div></div>';
				break;
				default:
					echo '</div></div>';
			}

		}
	}
}
add_action('itre_content_wrapper_end', 'itre_get_content_wrapper_end', 10, 1);

/**
 *	Function to Enable Sidebar
 */
if ( !function_exists('itre_get_sidebar') ) {
	function itre_get_sidebar( $template ) {

	   global $post;

	   switch( $template ) {

		    case "blog";
		    if ( is_home() &&
		    	get_theme_mod('itre_blog_sidebar_enable', 1) !== "" ) {
			    get_sidebar(null, ['page' => 'blog']);
			}
			break;
		    case "single":
		   		if( is_single() &&
		   		get_theme_mod('itre_single_sidebar_enable', 1) !== "" ) {
					get_sidebar(null, ['page' => 'blog']);
				}
			break;
			case "search":
		   		if( is_search() &&
		   		get_theme_mod('itre_search_sidebar_enable', 1) !== "" ) {
					get_sidebar(null, ['page' => 'blog']);
				}
			break;
			case "archive":
		   		if( is_archive() &&
		   		get_theme_mod('itre_archive_sidebar_enable', 1) !== "" ) {
					get_sidebar(null, ['page' => 'blog']);
				}
			break;
			case "property":
		   		if( (is_post_type_archive('property') || is_tax('location') || is_tax('property-type')) &&
		   		get_theme_mod('itre_property_sidebar_enable', 1) !== "" ) {
					get_sidebar(null, ['page' => 'property']);
				}
			break;
			case "page":
				if	( is_page() &&
				!is_front_page() &&
				'' !== get_post_meta($post->ID, 'enable-sidebar', true) ) {
					get_sidebar('null', ['page'	=>	'']);
				}
			break;
		    default:
		    	get_sidebar();
		}
	}
}

/**
 *	Function for Sidebar alignment
 */
if ( !function_exists('itre_has_sidebar') ) {
   function itre_has_sidebar( $template = 'blog' ) {

	   $has_sidebar = 'page' == $template ? get_post_meta( get_the_ID(), 'sidebar-enable', true ) : get_theme_mod('itre_' . $template . '_sidebar_enable', 1);

	   $class = '';
	   if ( !empty( $has_sidebar ) && is_active_sidebar('sidebar-' . $template) ) {
		   $class = 'col-lg-8';
	   }

	   echo esc_html( $class );

   }
}


/**
 *	Function for post content on Blog Page
 */
if ( !function_exists('itre_get_blog_excerpt') ) {
	function itre_get_blog_excerpt( $post = null, $length = 30 ) {

		if ( !empty( $post ) ) {
			$post = get_post( $post );
		}
		else {
			global $post;
		}

	$output	=	'';

	if ( isset( $post->ID ) && has_excerpt( $post->ID ) ) {
		$output = $post->post_excerpt;
	}

	elseif ( isset( $post->post_content ) ) {

		if ( strpos($post->post_content, '<!--more-->') ) {
			$output	=	get_the_content('', $post );
		}
		else {
			$output	= wp_trim_words( strip_shortcodes( $post->post_content ), $length );
		}
	}

		$output	=	apply_filters('itre_excerpt', $output);
		echo esc_html($output);
	}
}
 add_action('itre_blog_excerpt', 'itre_get_blog_excerpt', 10, 1);

/**
 *	Map just over footer for Properties
 */
if ( !function_exists('itre_single_property_map') ) {
	function itre_single_property_map() {

		$data = get_post_meta( get_the_ID() );
		$is_map = !empty($data['lat'][0]) && !empty($data['long'][0]) && !empty($data['maps'][0]);
		if ( post_type_exists( "property" ) && is_singular('property') && !empty($is_map) ) {
				echo '<div id="property-map"></div>';
		}
	}
}
add_action('itre_footer', 'itre_single_property_map', 10);

if ( !function_exists('itre_localize_map_data') ) {
	function itre_localize_map_data( $post ) {
		if ( is_object($post)) {
			$id = $post->ID;
		} else {
			$id = $post;
		}

		$data = get_post_meta($id);
		$map_keys = ['for', 'price', 'area', 'bedrooms', 'bathrooms', 'address', 'lat', 'long', 'maps', 'zoom', 'controls', 'labels'];
		$data = array_filter($data, function ($key ) use ( $map_keys ) { return in_array( $key, $map_keys ); }, ARRAY_FILTER_USE_KEY );

		if (!empty($data['maps'][0])) {
			wp_localize_script( 'itre-property-map-js', 'itre', $data );
		}
	}
}

/**
 *	Function for footer Sidebars
 */
if ( !function_exists('itre_get_footer') ) {
	function itre_get_footer() {

		$path 	=	'/framework/footer/footer';
		get_template_part( $path, get_theme_mod( 'itre_footer_cols', 4 ) );
	}
}
add_action('itre_footer', 'itre_get_footer', 20);


// Function for Blog Layouts
if ( !function_exists('itre_get_layout') ) {
	function itre_get_layout( $layout = 'classic' ) {
		$path	=	'template-parts/layouts/content';

		if  ( strpos( $layout, 'col' ) !== false ) {
			get_template_part( $path, 'col', $layout );
			return;
		}

		get_template_part( $path, $layout );
	}
}

//Comments walker Function
if ( !function_exists('itre_comment') ) {
	function itre_comment($comment, $args, $depth) {
		if ( 'div' === $args['style'] ) {
			$tag       = 'div';
			$add_below = 'comment';
		} else {
			$tag       = 'li';
			$add_below = 'div-comment';
		}?>
		<<?php echo $tag; ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?> id="comment-<?php comment_ID() ?>"><?php
		if ( 'div' != $args['style'] ) { ?>
			<div id="div-comment-<?php comment_ID() ?>" class="comment-body"><?php
		} ?>
			<div class="comment-info">
				<div class="comment-author vcard"><?php
					if ( $args['avatar_size'] != 0 ) {
						echo get_avatar( $comment, $args['avatar_size'] );
					}
					printf( __( '<span class="fn">%s</span> <span class="says">says:</span>', 'it-residence' ), get_comment_author_link() ); ?>
				</div><?php
				if ( $comment->comment_approved == '0' ) { ?>
					<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'it-residence' ); ?></em><br/><?php
				} ?>
				<div class="comment-meta commentmetadata">
					<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>"><?php
						/* translators: 1: date, 2: time */
						printf(
							__('%1$s at %2$s', 'it-residence'),
							get_comment_date(),
							get_comment_time()
						); ?>
					</a><?php
					edit_comment_link( __( '(Edit)', 'it-residence' ), '  ', '' ); ?>
				</div>
			</div>

			<?php comment_text(); ?>

			<div class="reply"><?php
					comment_reply_link(
						array_merge(
							$args,
							array(
								'add_below' => $add_below,
								'depth'     => $depth,
								'max_depth' => $args['max_depth']
							)
						)
					); ?>
			</div><?php
		if ( 'div' != $args['style'] ) : ?>
			</div><?php
		endif;
	}
}

//Function for Related Posts
if ( !function_exists('itre_get_related_posts') ) {
	function itre_get_related_posts() {

		global $post;

		$related_args = [
			"posts_per_page"		=>	3,
			"ignore_sticky_posts"	=>	true,
			"post__not_in"			=>	[get_the_ID()],
			"category_name"			=>	get_the_category($post)[0]->slug,
			"orderby"				=> "rand"
		];

		$related_query	=	new WP_Query( $related_args );

		if ( $related_query->have_posts() ) : ?>
			<div class="itre_related_posts_wrapper">
				<?php
					$related_title = get_theme_mod('itre_single_related_title', 'Related Posts');

					if ( !empty( $related_title ) ) {
						printf('<h2 class="itre_related_posts_title">%s</h2>', esc_html($related_title) );
					}
				?>

				<div class="itre-related-posts">
					<?php
						while ( $related_query->have_posts() ) : $related_query->the_post();
							get_template_part( 'template-parts/layouts/content', 'related' );
						endwhile;
					?>
				</div>
			</div>
		<?php
		endif;
		wp_reset_postdata();
	}
}

//Function for Related Posts
if ( !function_exists('itre_get_related_properties') ) {
	function itre_get_related_properties() {

		global $post;

		$related_args = [
			"posts_per_page"		=>	3,
			"ignore_sticky_posts"	=>	true,
			"post_type"				=> "poperty",
			"post__not_in"			=>	[get_the_ID()],
			"orderby"				=> "rand"
		];

		$related_query	=	new WP_Query( $related_args );

		if ( $related_query->have_posts() ) : ?>
			<div id="itre_related_posts_wrapper">
				<?php
					$related_title = get_theme_mod('itre_single_related_title', 'Related Posts');

					if ( !empty( $related_title ) ) {
						printf('<h2 id="itre_related_posts_title">%s</h2>', esc_html($related_title) );
					}
				?>

				<div class="itre-related-posts row">
					<?php
						while ( $related_query->have_posts() ) : $related_query->the_post();

							get_template_part( 'template-parts/layouts/content', 'related' );

						endwhile;
					?>
				</div>
			</div>
		<?php
		endif;
		wp_reset_postdata();
	}
}

//Function for Author Box in Single Post
if ( !function_exists('itre_about_author') ) {
	function itre_about_author( $post ) { ?>
		<div id="author_box">
			<div class="author_avatar">
				<?php echo get_avatar( intval($post->post_author), 128 ); ?>
			</div>
			<div class="author_info">
				<h4 class="author_name title-font">
					<?php echo esc_html( get_the_author_meta( 'display_name', intval($post->post_author) ) ); ?>
				</h4>
				<div class="author_bio">
					<?php echo esc_html( get_the_author_meta( 'description', intval($post->post_author) ) ); ?>
				</div>
			</div>
		</div>
	<?php
	}
}

if ( !function_exists('itre_hero_area') ) {
	function itre_hero_area() {
		
		if ( empty( get_theme_mod('itre_hero_title') ) && empty( get_theme_mod('itre_hero_desc') ) ) {
			return;
		}

		if ( !is_front_page() ) {
			return;
		}

		$hero_title = get_theme_mod('itre_hero_title', '');
		$hero_desc = get_theme_mod('itre_hero_desc', '');

		echo '<div class="itre-hero-area">';
		printf('<h1 class="itre-hero-title">%s</h1>', $hero_title);
		printf('<p class="itre-hero-desc">%s</p>', $hero_desc);
		echo '</div>';
	}
}

/**
 * Preload Header images
 *
 * @return void
 */
function itre_preload_header_images() {
	$header_image = is_singular(['post', 'page', 'property']) && !is_front_page() && has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'full') : get_header_image();
	if (empty($header_image)) {
		return;
	}
	echo "<link rel='preload' as='image' href={$header_image}>";
}
add_action('wp_head', 'itre_preload_header_images');