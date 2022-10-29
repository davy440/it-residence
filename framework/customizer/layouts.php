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
		    'section'	=>	'itre_layout_general_options',
		    'priority'	=>	5
	    )
    );

	$wp_customize->add_section(
		"itre_blog", array(
			"title"			=>	esc_html__("Blog Page", 'it-residence'),
			"description"	=>	esc_html__("Control the Layout Settings for the Blog Page", 'it-residence'),
			"priority"		=>	10,
			"panel"			=>	"itre_layouts_panel"
		)
	);

	$wp_customize->add_setting(
		'itre_blog_title', array(
		'default'				=>	'',
		'sanitize_callback'	=>	'sanitize_text_field'
		)
	);

	$wp_customize->add_control(
		'itre_blog_title', array(
			'label'		=>	__('Blog Title', 'it-residence'),
			'section'	=>	'itre_blog',
			'priority'	=>	2
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
						"image"	=>	esc_url(get_template_directory_uri() . "/assets/images/left-sidebar.png")
					),
					"right"		=>	array(
						"name"	=>	esc_html__("Right Sidebar", 'it-residence'),
						"image"	=>	esc_url(get_template_directory_uri() . "/assets/images/right-sidebar.png")
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

	$wp_customize->add_setting(
		"itre_single_sidebar_enable", array(
			"default"			=>	1,
			"sanitize_callback"	=>	"itre_sanitize_checkbox"
		)
	);

	$wp_customize->add_control(
		"itre_single_sidebar_enable", array(
			"label"		=>	esc_html__("Enable Sidebar for Posts", 'it-residence'),
			"type"		=>	"checkbox",
			"section"	=>	"itre_single",
			"priority"	=>	5
		)
	);

	$wp_customize->add_setting(
     "itre_single_sidebar_layout", array(
       "default"  => "right",
       "sanitize_callback"  => "itre_sanitize_radio",
     )
   );

   $wp_customize->add_control(
	   new itre_Image_Radio_Control(
		   $wp_customize, "itre_single_sidebar_layout", array(
			   "label"		=>	esc_html__("Single Post Layout", 'it-residence'),
			   "type"		=>	"itre-image-radio",
			   "section"	=> "itre_single",
			   "Settings"	=> "itre_single_sidebar_layout",
			   "priority"	=> 10,
			   "choices"	=>	array(
					"left"		=>	array(
						"name"	=>	esc_html__("Left Sidebar", 'it-residence'),
						"image"	=>	esc_url(get_template_directory_uri() . "/assets/images/left-sidebar.png")
					),
					"right"		=>	array(
						"name"	=>	esc_html__("Right Sidebar", 'it-residence'),
						"image"	=>	esc_url(get_template_directory_uri() . "/assets/images/right-sidebar.png")
					)
			   )
		   )
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

	$wp_customize->add_setting(
		"itre_search_sidebar_enable", array(
			"default"			=>	1,
			"sanitize_callback"	=>	"itre_sanitize_checkbox"
		)
	);

	$wp_customize->add_control(
		"itre_search_sidebar_enable", array(
			"label"		=>	esc_html__("Enable Sidebar for Search Page", 'it-residence'),
			"type"		=>	"checkbox",
			"section"	=>	"itre_search",
			"priority"	=>	5
		)
	);

	$wp_customize->add_setting(
     "itre_search_sidebar_layout", array(
       "default"  => "right",
       "sanitize_callback"  => "itre_sanitize_radio",
     )
   );

   $wp_customize->add_control(
	   new itre_Image_Radio_Control(
		   $wp_customize, "itre_search_sidebar_layout", array(
			   "label"		=>	esc_html__("Arc Page Layout", 'it-residence'),
			   "type"		=>	"itre-image-radio",
			   "section"	=> "itre_search",
			   "Settings"	=> "itre_search_sidebar_layout",
			   "priority"	=> 10,
			   "choices"	=>	array(
					"left"		=>	array(
						"name"	=>	esc_html__("Left Sidebar", 'it-residence'),
						"image"	=>	esc_url(get_template_directory_uri() . "/assets/images/left-sidebar.png")
					),
					"right"		=>	array(
						"name"	=>	esc_html__("Right Sidebar", 'it-residence'),
						"image"	=>	esc_url(get_template_directory_uri() . "/assets/images/right-sidebar.png")
					)
			   )
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

   $wp_customize->add_section(
		"itre_archive", array(
			"title"			=>	esc_html__("Archives", 'it-residence'),
			"description"	=>	esc_html__("Layout Settings for the Archives", 'it-residence'),
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

	$wp_customize->add_setting(
		"itre_archive_sidebar_enable", array(
			"default"			=>	1,
			"sanitize_callback"	=>	"itre_sanitize_checkbox"
		)
	);

	$wp_customize->add_control(
		"itre_archive_sidebar_enable", array(
			"label"		=>	esc_html__("Enable Sidebar for Archives", 'it-residence'),
			"type"		=>	"checkbox",
			"section"	=>	"itre_archive",
			"priority"	=>	5
		)
	);

	$wp_customize->add_setting(
     "itre_archive_sidebar_layout", array(
       "default"  => "right",
       "sanitize_callback"  => "itre_sanitize_radio",
     )
   );

   $wp_customize->add_control(
	   new itre_Image_Radio_Control(
		   $wp_customize, "itre_archive_sidebar_layout", array(
			   "label"		=>	esc_html__("Archives Layout", 'it-residence'),
			   "type"		=>	"itre-image-radio",
			   "section"	=> "itre_archive",
			   "Settings"	=> "itre_archive_sidebar_layout",
			   "priority"	=> 10,
			   "choices"	=>	array(
					"left"		=>	array(
						"name"	=>	esc_html__("Left Sidebar", 'it-residence'),
						"image"	=>	esc_url(get_template_directory_uri() . "/assets/images/left-sidebar.png")
					),
					"right"		=>	array(
						"name"	=>	esc_html__("Right Sidebar", 'it-residence'),
						"image"	=>	esc_url(get_template_directory_uri() . "/assets/images/right-sidebar.png")
					)
			   )
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

	$wp_customize->add_section(
 		"itre_property", array(
 			"title"			=>	esc_html__("Property Archives", 'it-residence'),
 			"description"	=>	esc_html__("Layout Settings for the Proprties", 'it-residence'),
 			"priority"		=>	50,
 			"panel"			=>	"itre_layouts_panel"
 		)
 	);

 	$wp_customize->add_setting(
 		'itre_property_layout', array(
 			'default'	=>	'col3',
 			'sanitize_callback'	=>	'itre_sanitize_select'
 		)
 	);

 	$wp_customize->add_control(
 		'itre_property_layout', array(
 			'label'		=>	__('Property Archives Layout', 'it-residence'),
 			'type'		=>	'select',
 			'section'	=>	'itre_property',
 			'priority'	=>	3,
 			'choices'	=>	array(
 				'col2'		=>	__('2 Column', 'it-residence'),
 				'col3'		=>	__('3 Column', 'it-residence'),
 				'col4'		=>	__('4 Column', 'it-residence'),
 			)
 		)
 	);

 	$wp_customize->add_setting(
 		"itre_property_sidebar_enable", array(
 			"default"			=>	1,
 			"sanitize_callback"	=>	"itre_sanitize_checkbox"
 		)
 	);

 	$wp_customize->add_control(
 		"itre_property_sidebar_enable", array(
 			"label"		=>	esc_html__("Enable Sidebar for Property Archives", 'it-residence'),
 			"type"		=>	"checkbox",
 			"section"	=>	"itre_property",
 			"priority"	=>	5
 		)
 	);

 	$wp_customize->add_setting(
      "itre_property_sidebar_layout", array(
        "default"  => "right",
        "sanitize_callback"  => "itre_sanitize_radio",
      )
    );

    $wp_customize->add_control(
 	   new itre_Image_Radio_Control(
 		   $wp_customize, "itre_property_sidebar_layout", array(
 			   "label"		=>	esc_html__("Properties Layout", 'it-residence'),
 			   "type"		=>	"itre-image-radio",
 			   "section"	=> "itre_property",
 			   "Settings"	=> "itre_property_sidebar_layout",
 			   "priority"	=> 10,
 			   "choices"	=>	array(
 					"left"		=>	array(
 						"name"	=>	esc_html__("Left Sidebar", 'it-residence'),
 						"image"	=>	esc_url(get_template_directory_uri() . "/assets/images/left-sidebar.png")
 					),
 					"right"		=>	array(
 						"name"	=>	esc_html__("Right Sidebar", 'it-residence'),
 						"image"	=>	esc_url(get_template_directory_uri() . "/assets/images/right-sidebar.png")
 					)
 			   )
 		   )
 	   )
    );
}
add_action("customize_register", "itre_sidebr_customize_register");
