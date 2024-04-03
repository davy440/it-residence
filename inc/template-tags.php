<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package IT_Residence
 */

 if ( ! function_exists( 'itre_posted_on' ) ) :
 	/**
 	 * Prints HTML with meta information for the current post-date/time.
 	 */
 	function itre_posted_on() {
 		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
 		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
 			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
 		}

 		$time_string = sprintf(
 			$time_string,
 			esc_attr( get_the_date( DATE_W3C ) ),
 			esc_html( get_the_date() ),
 			esc_attr( get_the_modified_date( DATE_W3C ) ),
 			esc_html( get_the_modified_date() )
 		);

 		$posted_on = sprintf(
 			/* translators: %s: post date. */
 			esc_html_x( '%s', 'post date', 'it-residence' ),// phpcs:ignore WordPress.WP.I18n.NoEmptyStrings
 			'<i class="fa fa-calendar-o" aria-hidden="true"></i><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
 		);

 		$d_schema = is_single() ? 'itemprop="dateCreated"' : '';

 		echo '<div class="posted-on" ' . $d_schema . '>' . $posted_on . '</div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

 	}
 endif;

 if ( ! function_exists( 'itre_posted_by' ) ) :
 	/**
 	 * Prints HTML with meta information for the current author.
 	 */
 	function itre_posted_by() {

 		$byline = sprintf(
 			/* translators: %s: post author. */
 			esc_html_x( '%s', 'post author', 'it-residence' ),// phpcs:ignore WordPress.WP.I18n.NoEmptyStrings
 			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
 		);

 		$a_schema = is_single() ? 'itemprop="author"' : '';

 		echo '<div class="byline" ' . $a_schema .  '><i class="fa fa-user-circle-o" aria-hidden="true"></i>
 ' . $byline . '</div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

 	}
 endif;

 if ( ! function_exists( 'itre_cats_list' ) ) {

     function itre_cats_list() {
         $categories_list = get_the_category_list( ' ' );
         if ( $categories_list ) {
             /* translators: 1: list of categories. */
             printf( '<span class="cat-links"><i class="fa fa-folder-open" aria-hidden="true"></i>' . esc_html__( '%1$s', 'it-residence' ) . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
         }

     }
 }

if ( ! function_exists( 'itre_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function itre_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( ' ' );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<div class="cat-links"><i class="fa fa-folder-open" aria-hidden="true"></i>
' . esc_html__( '%1$s', 'it-residence' ) . '</div>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ' ', 'list item separator', 'it-residence' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<div class="tags-links"><i class="fa fa-tags" aria-hidden="true"></i>
' . esc_html__( '%1$s', 'it-residence' ) . '</div>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<div class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'it-residence' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				)
			);
			echo '</div>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'it-residence' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'itre_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function itre_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php
					the_post_thumbnail(
						'post-thumbnail',
						array(
							'alt' => the_title_attribute(
								array(
									'echo' => false,
								)
							),
						)
					);
				?>
			</a>

			<?php
		endif; // End is_singular().
	}
endif;

if ( ! function_exists( 'wp_body_open' ) ) :
	/**
	 * Shim for sites older than 5.2.
	 *
	 * @link https://core.trac.wordpress.org/ticket/12563
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
endif;


if ( ! function_exists( 'itre_get_property_price' ) ) {
	function itre_get_property_price( $data ) {
		$currency['locale'] =	'en_US';
		$currency['code']	=	'USD';
		$price = new NumberFormatter( $locale = $currency['locale'], NumberFormatter::CURRENCY );
		$price->setTextAttribute( NumberFormatter::CURRENCY_CODE, $currency['code']);
		$price->setAttribute(NumberFormatter::MAX_FRACTION_DIGITS, 0);

		$price_string = sprintf('<span class="prop-price"><span>%s</span></span>', $price->format( $data ) );

		echo $price_string;
	}
}
