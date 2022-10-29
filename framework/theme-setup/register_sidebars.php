<?php
/**
 * Register widget areas.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
 function itre_widgets_init() {
 	register_sidebar(
 		array(
 			'name'          => esc_html__( 'Sidebar', 'it-residence' ),
 			'id'            => 'sidebar-blog',
 			'description'   => esc_html__( 'Add widgets here.', 'it-residence' ),
 			'before_widget' => '<section id="%1$s" class="widget %2$s">',
 			'after_widget'  => '</section>',
 			'before_title'  => '<h4 class="widget-title"><span>',
 			'after_title'   => '</span></h4>',
 		)
 	);

 	register_sidebar(
 		array(
 			'name'          => esc_html__( 'Before Content', 'it-residence' ),
 			'id'            => 'before-content',
 			'description'   => esc_html__( 'This is the sidebar before Content in the Front Page. Add widgets here.', 'it-residence' ),
 			'before_widget' => '<section id="%1$s" class="widget %2$s">',
 			'after_widget'  => '</section>',
 			'before_title'  => '<h4 class="widget-title"><span>',
 			'after_title'   => '</span></h4>',
 		)
 	);

 	register_sidebar(
 		array(
 			'name'          => esc_html__( 'After Content', 'it-residence' ),
 			'id'            => 'after-content',
 			'description'   => esc_html__( 'This is the sidebar after Content in the Front Page. Add widgets here.', 'it-residence' ),
 			'before_widget' => '<section id="%1$s" class="widget %2$s">',
 			'after_widget'  => '</section>',
 			'before_title'  => '<h4 class="widget-title"><span>',
 			'after_title'   => '</span></h4>',
 		)
 	);

 	register_sidebar(
 		array(
 			'name'          => esc_html__( 'Footer Sidebar 1', 'it-residence' ),
 			'id'            => 'footer-1',
 			'description'   => esc_html__( 'Footer Sidebar Column 1', 'it-residence' ),
 			'before_widget' => '<section id="%1$s" class="widget %2$s">',
 			'after_widget'  => '</section>',
 			'before_title'  => '<h4 class="widget-title"><span>',
 			'after_title'   => '</span></h4>',
 		)
 	);

 	register_sidebar(
 		array(
 			'name'          => esc_html__( 'Footer Sidebar 2', 'it-residence' ),
 			'id'            => 'footer-2',
 			'description'   => esc_html__( 'Footer Sidebar Column 2', 'it-residence' ),
 			'before_widget' => '<section id="%1$s" class="widget %2$s">',
 			'after_widget'  => '</section>',
 			'before_title'  => '<h4 class="widget-title"><span>',
 			'after_title'   => '</span></h4>',
 		)
 	);

 	register_sidebar(
 		array(
 			'name'          => esc_html__( 'Footer Sidebar 3', 'it-residence' ),
 			'id'            => 'footer-3',
 			'description'   => esc_html__( 'Footer Sidebar Column 3', 'it-residence' ),
 			'before_widget' => '<section id="%1$s" class="widget %2$s">',
 			'after_widget'  => '</section>',
 			'before_title'  => '<h4 class="widget-title"><span>',
 			'after_title'   => '</span></h4>',
 		)
 	);

 	register_sidebar(
 		array(
 			'name'          => esc_html__( 'Footer Sidebar 4', 'it-residence' ),
 			'id'            => 'footer-4',
 			'description'   => esc_html__( 'Footer Sidebar Column 4', 'it-residence' ),
 			'before_widget' => '<section id="%1$s" class="widget %2$s">',
 			'after_widget'  => '</section>',
 			'before_title'  => '<h4 class="widget-title"><span>',
 			'after_title'   => '</span></h4>',
 		)
 	);

 }
 add_action( 'widgets_init', 'itre_widgets_init' );
