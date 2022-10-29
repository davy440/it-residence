<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package IT News Grid
 */
if ( ! is_active_sidebar( 'sidebar-' . $args['page'] ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area">
	<?php dynamic_sidebar( 'sidebar-' . $args['page'] ); ?>
</aside><!-- #secondary -->
