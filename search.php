<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package IT_Residence
 */
get_header();
?>

	<main id="primary" class="site-main container">
		<?php echo 'Hello'; ?>
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
            the_posts_pagination( array(
				'class'					=>	'itre-pagination',
				'before_page_number'	=>	'<span>',
				'after_page_number'		=>	'</span>',
				'prev_text'				=> '<span class="arrow-prev"><i class="fa fa-angle-left" aria-hidden="true"></i></span>',
				'next_text'				=> '<span class="arrow-next"><i class="fa fa-angle-right" aria-hidden="true"></i></span></i>'
			) );

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php
get_footer();
