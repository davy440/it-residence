<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package IT_Residence
 */

 $sidebar_align = get_theme_mod( 'itre_search_sidebar_layout', 'right' );

get_header(null, array('header' => 'default'));

if ( $sidebar_align == 'left' ) {
	itre_get_sidebar('search');
}
?>

	<main id="primary" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title">
					<?php
					/* translators: %s: search query. */
					printf( esc_html__( 'Search Results for: %s', 'it-residence' ), '<span>' . get_search_query() . '</span>' );
					?>
				</h1>
			</header><!-- .page-header -->

            <div class="row">

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				itre_get_layout( get_theme_mod('itre_search_layout', 'col3') );

			endwhile;
            ?>
            </div>

            <?php
            the_posts_pagination( apply_filters( 'itre_posts_pagination_args', array(
				'class'	=>	'itre-pagination',
				'prev_text'	=> '<i class="fa fa-angle-left"></i>',
				'next_text'	=> '<i class="fa fa-angle-right"></i>'
			) ) );

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php
if ( $sidebar_align == 'right' ) {
	itre_get_sidebar('search');
}
get_footer();
