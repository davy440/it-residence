<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package IT_Residence
 */

 printf('</div>');
do_action('itre_footer');
?>

<footer id="colophon" class="site-footer">
<!-- .footer -->
	<div class="container">
		<div class="site-info">
			<?php printf(esc_html__('Theme Designed by %s', 'it-residence'), '<a href="https://indithemes.com">IndiThemes</a>'); ?>
			<span class="sep"> | </span>
			<?php echo ( get_theme_mod('itre_footer_text') === '' ) ? ('Copyright &copy; '.date_i18n( esc_html__( 'Y', 'it-residence' ) ).' ' . esc_html( get_bloginfo('name') ) . esc_html__('. All Rights Reserved.','it-residence')) : wp_kses(get_theme_mod('itre_footer_text'), ["a" => ["href" => true, "target" => true]]); ?>
		</div><!-- .site-info -->
	</div>
</footer><!-- #colophon -->
</div><!-- #page -->

<nav id="menu" class="panel" aria-hidden="true" aria-label="<?php _e('Mobile Menu', 'it-residence'); ?>">
	<div id="panel-top-bar">
		<button class="go-to-bottom"></button>
		<button id="close-menu" class="menu-link"><i class="fa fa-times"></i></button>
	</div>

	<?php if ( !empty( get_theme_mod('itre_cta_enable', '') ) ) : ?>
		<div class="itre-cta-wrapper">
			<?php
				printf("<a class='itre-cta cta-nav' href='%s'>%s</a>", esc_url( get_theme_mod( 'itre_cta_id', '#' ) ), esc_html( get_theme_mod( 'itre_cta_text', 'Add Listing' ) ) );
			?>
		</div>
	<?php endif; ?>
	<?php wp_nav_menu( apply_filters( 'itre_mobile_nav_args', array(
			'menu_id'	=> 'mobile-menu',
			'container'		=> 'ul',
			'theme_location' => 'menu-2',
			'walker'         => has_nav_menu('menu-2') ? new itre_Mobile_Menu() : '',
	 ) ) ); ?>

	<button class="go-to-top"></button>
</nav>

<?php
if ( !empty( get_theme_mod('itre_back_to_top', 1))) {
	echo '<div id="itre-back-to-top"><i class="fa fa-chevron-up" aria-hidden="true"></i></div>';
} 
wp_footer();
?>
</body>
</html>
