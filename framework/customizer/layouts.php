<?php
/**
 *	Customizer Controls for Sidebar
**/

function itre_sidebr_customize_register( $wp_customize ) {

	$wp_customize->add_panel(
		"itre_layouts_panel", array(
			"title"			=>	esc_html__("Layouts", 'it-residence'),
			"description"	=>	esc_html__("Layout Settings for the Theme", 'it-residence'),
			"priority"		=>	20
		)
	);

	$wp_customize->add_section(
		'itre_layout_general_options', array(
			'title'		=>	__('General Settings', 'it-residence'),
			'priority'	=>	9,
			'panel'		=>	'itre_layouts_panel'
		)
	);

	$wp_customize->add_setting(
	    'itre-blog-excerpt-length', array(
		    'default'			=>	15,
		    'sanitize_callback'	=>	'absint'
	    )
    );

    $wp_customize->add_control(
	    'itre-blog-excerpt-length', array(
		    'label'		=>	__('Excerpt Length for Blog Entries', 'it-residence'),
		    'type'		=>	'number',
		    'section'	=>	'itre_blog',
		    'priority'	=>	5
	    )
    );

	$excerpt_control = array_filter( array(
        $wp_customize->get_control( 'itre-blog-excerpt-length' ),
    ) );
    foreach ( $excerpt_control as $control ) {
        $control->active_callback = function( $control ) {
            $setting = $control->manager->get_setting( 'itre_blog_layout' );
            if (  $setting->value() == 'classic' ) {
                return true;
            } else {
                return false;
            }
        };
    }

	$wp_customize->add_section(
		"itre_blog", array(
			"title"			=>	esc_html__("Blog Page", 'it-residence'),
			"description"	=>	esc_html__("Control the Layout Settings for the Blog Page", 'it-residence'),
			"priority"		=>	10,
			"panel"			=>	"itre_layouts_panel"
		)
	);

	$wp_customize->add_setting(
		'itre_blog_layout', array(
			'default'	=>	'col3',
			'sanitize_callback'	=>	'itre_sanitize_select'
		)
	);

	$wp_customize->add_control(
		'itre_blog_layout', array(
			'label'		=>	__('Blog Layout', 'it-residence'),
			'type'		=>	'select',
			'section'	=>	'itre_blog',
			'priority'	=>	3,
			'choices'	=>	array(
				'classic'	=>	__('Classic', 'it-residence'),
				'col2'		=>	__('2 Column', 'it-residence'),
				'col3'		=>	__('3 Column', 'it-residence'),
			)
		)
	);

	$wp_customize->add_setting(
		"itre_blog_sidebar_enable", array(
			"default"			=>	1,
			"sanitize_callback"	=>	"itre_sanitize_checkbox"
		)
	);

	$wp_customize->add_control(
		"itre_blog_sidebar_enable", array(
			"label"		=>	esc_html__("Enable Sidebar for Blog Page.", 'it-residence'),
			"type"		=>	"checkbox",
			"section"	=>	"itre_blog",
			"priority"	=>	5
		)
	);



	$wp_customize->add_setting(
     "itre_blog_sidebar_layout", array(
       "default"  => "right",
       "sanitize_callback"  => "itre_sanitize_radio",
     )
   );

   $wp_customize->add_control(
	   new itre_Image_Radio_Control(
		   $wp_customize, "itre_blog_sidebar_layout", array(
			   "label"		=>	esc_html__("Blog Layout", 'it-residence'),
			   "type"		=>	"itre-image-radio",
			   "section"	=> "itre_blog",
			   "settings"	=> "itre_blog_sidebar_layout",
			   "priority"	=> 10,
			   "choices"	=>	array(
					"left"		=>	array(
						"name"	=>	esc_html__("Left Sidebar", 'it-residence'),
						"image"	=>	esc_url(ITRE_URL . "assets/images/left-sidebar.png")
					),
					"right"		=>	array(
						"name"	=>	esc_html__("Right Sidebar", 'it-residence'),
						"image"	=>	esc_url(ITRE_URL . "assets/images/right-sidebar.png")
					)
			   )
		   )
	   )
   );

    $sidebar_controls = array_filter( array(
        $wp_customize->get_control( 'itre_blog_sidebar_layout' ),
    ) );
    foreach ( $sidebar_controls as $control ) {
        $control->active_callback = function( $control ) {
            $setting = $control->manager->get_setting( 'itre_blog_sidebar_enable' );
            if (  $setting->value() ) {
                return true;
            } else {
                return false;
            }
        };
    }

	$wp_customize->add_section(
		"itre_single", array(
			"title"			=>	esc_html__("Single Post", 'it-residence'),
			"description"	=>	esc_html__("Control the Layout Settings for the Single Post Page", 'it-residence'),
			"priority"		=>	20,
			"panel"			=>	"itre_layouts_panel"
		)
	);

   	$sidebar_controls = array_filter( array(
        $wp_customize->get_control( 'itre_single_sidebar_layout' ),
    ) );
    foreach ( $sidebar_controls as $control ) {
        $control->active_callback = function( $control ) {
            $setting = $control->manager->get_setting( 'itre_single_sidebar_enable' );
            if (  $setting->value() ) {
                return true;
            } else {
                return false;
            }
        };
    }

   $wp_customize->add_setting(
		"itre_single_navigation_enable", array(
			"default"			=>	1,
			"sanitize_callback"	=>	"itre_sanitize_checkbox"
		)
	);

	$wp_customize->add_control(
		"itre_single_navigation_enable", array(
			"label"		=>	esc_html__("Enable Post Navigation", 'it-residence'),
			"type"		=>	"checkbox",
			"section"	=>	"itre_single",
			"priority"	=>	15
		)
	);

	$wp_customize->add_setting(
		"itre_single_related_enable", array(
			"default"			=>	1,
			"sanitize_callback"	=>	"itre_sanitize_checkbox"
		)
	);

	$wp_customize->add_control(
		"itre_single_related_enable", array(
			"label"		=>	esc_html__("Enable Related Posts Section", 'it-residence'),
			"type"		=>	"checkbox",
			"section"	=>	"itre_single",
			"priority"	=>	20
		)
	);

	$wp_customize->add_setting(
		"itre_single_related_title", array(
			"default"			=>	'Related Posts',
			"sanitize_callback"	=>	"sanitize_text_field"
		)
	);

	$wp_customize->add_control(
		"itre_single_related_title", array(
			"label"		=>	esc_html__("Related Posts Section Title", 'it-residence'),
			"section"	=>	"itre_single",
			"priority"	=>	21
		)
	);

	$wp_customize->add_setting(
		"itre_single_author_enable", array(
			"default"			=>	1,
			"sanitize_callback"	=>	"itre_sanitize_checkbox"
		)
	);

	$wp_customize->add_control(
		"itre_single_author_enable", array(
			"label"		=>	esc_html__("Enable Author Box", 'it-residence'),
			"type"		=>	"checkbox",
			"section"	=>	"itre_single",
			"priority"	=>	25
		)
	);

	$wp_customize->add_section(
		"itre_search", array(
			"title"			=>	esc_html__("Search Page", 'it-residence'),
			"description"	=>	esc_html__("Layout Settings for the Search Page", 'it-residence'),
			"priority"		=>	30,
			"panel"			=>	"itre_layouts_panel"
		)
	);

	$wp_customize->add_setting(
		'itre_search_layout', array(
			'default'			=>	'col3',
			'sanitize_callback'	=>	'itre_sanitize_select'
		)
	);

	$wp_customize->add_control(
		'itre_search_layout', array(
			'label'		=>	__('Search Page Layout', 'it-residence'),
			'type'		=>	'select',
			'section'	=>	'itre_search',
			'priority'	=>	3,
			'choices'	=>	array(
				'classic'	=>	__('Classic', 'it-residence'),
				'col2'		=>	__('2 Column', 'it-residence'),
				'col3'		=>	__('3 Column', 'it-residence'),
				'col4'		=>	__('4 Column', 'it-residence'),
			)
		)
	);

   $wp_customize->add_section(
		"itre_archive", array(
			"title"			=>	esc_html__("Archives", 'it-residence'),
			"description"	=>	esc_html__("Layout Settings for the post archive pages", 'it-residence'),
			"priority"		=>	40,
			"panel"			=>	"itre_layouts_panel"
		)
	);

	$wp_customize->add_setting(
		'itre_archive_layout', array(
			'default'	=>	'col3',
			'sanitize_callback'	=>	'itre_sanitize_select'
		)
	);

	$wp_customize->add_control(
		'itre_archive_layout', array(
			'label'		=>	__('Blog Layout', 'it-residence'),
			'type'		=>	'select',
			'section'	=>	'itre_archive',
			'priority'	=>	3,
			'choices'	=>	array(
				'classic'	=>	__('Classic', 'it-residence'),
				'col2'		=>	__('2 Column', 'it-residence'),
				'col3'		=>	__('3 Column', 'it-residence'),
				'col4'		=>	__('4 Column', 'it-residence'),
			)
		)
	);

   $sidebar_controls = array_filter( array(
        $wp_customize->get_control( 'itre_search_sidebar_layout' ),
    ) );
    foreach ( $sidebar_controls as $control ) {
        $control->active_callback = function( $control ) {
            $setting = $control->manager->get_setting( 'itre_search_sidebar_enable' );
            if (  $setting->value() ) {
                return true;
            } else {
                return false;
            }
        };
    }
}
add_action("customize_register", "itre_sidebr_customize_register");
