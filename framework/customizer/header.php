<?php
/**
 *
 */

function itre_header_customize_register( $wp_customize ) {

    $wp_customize->get_section( "title_tagline" )->panel  = 'itre_header_panel';
    $wp_customize->get_section( "header_image" )->panel   = 'itre_header_panel';

    $wp_customize->add_panel(
        'itre_header_panel', array(
            'title'     =>  __('Header', 'it-residence'),
            'priority'  =>  50
        )
    );

    $wp_customize->add_section(
        'itre_header_options', array(
            'title'     =>  __('Header Options', 'it-residence'),
            'priority'  =>  80,
            'panel'     =>  'itre_header_panel'
        )
    );

    $wp_customize->add_setting(
        'itre_header_height', array(
            'default'           =>  500,
            'sanitize_callback' =>  'absint'
        )
    );

    $wp_customize->add_setting(
        'itre_sidebar_width', array(
            'default'    =>  25,
            'sanitize_callback'  =>  'absint'
        )
    );

    $wp_customize->add_control(
        new itre_Range_Value_Control(
            $wp_customize, 'itre_header_height', array(
	            'label'         =>	esc_html__( 'Header Height', 'it-residence' ),
            	'type'          => 'itre-range-value',
            	'section'       => 'itre_header_options',
            	'settings'      => 'itre_header_height',
            	'input_attrs'   => array(
            		'min'            => 300,
            		'max'            => 700,
            		'step'           => 1,
            		'suffix'         => 'px', //optional suffix
				),
            )
        )
    );

    $wp_customize->add_setting(
        'itre_cta_enable', array(
            'default'   =>  '',
            'sanitize_callback' =>  'itre_sanitize_checkbox'
        )
    );

    $wp_customize->add_control(
        'itre_cta_enable', array(
            'label'     =>  __('Enable CTA Button', 'it-residence'),
            'type'      =>  'checkbox',
            'section'   =>  'itre_header_options',
        )
    );

    $wp_customize->add_setting(
        'itre_cta_text', array(
            'default'   =>  __('Add a Listing', 'it-residence'),
            'sanitize_callback' =>  'sanitize_text_field'
        )
    );

    $wp_customize->add_control(
        'itre_cta_text', array(
            'label'     =>  __('Text for CTA Button', 'it-residence'),
            'section'   =>  'itre_header_options'
        )
    );

    $wp_customize->add_setting(
        'itre_cta_id', array(
            'default'   =>  0,
            'sanitize_callback' =>  'itre_sanitize_dropdown_pages'
        )
    );

    $wp_customize->add_control(
        'itre_cta_id', array(
            'label'     =>  __('Page CTA Button links to', 'it-residence'),
            'type'      =>  'dropdown-pages',
            'section'   =>  'itre_header_options',
        )
    );

    $wp_customize->add_setting(
        'itre_hero_title', array(
            'default'           =>   '',
            'sanitize_callback' =>  'sanitize_text_field'
        )
    );

    $wp_customize->add_control(
        'itre_hero_title', array(
            'label'     =>  __('Hero Title', 'it-residence'),
            'section'   =>  'itre_header_options'
        )
    );

    $wp_customize->add_setting(
        'itre_hero_desc', array(
            'default'           =>   '',
            'sanitize_callback' =>  'sanitize_text_field'
        )
    );

    $wp_customize->add_control(
        'itre_hero_desc', array(
            'label'     =>  __('Hero Description', 'it-residence'),
            'section'   =>  'itre_header_options'
        )
    );

    $wp_customize->add_setting(
		'itre_header_overlay_color' , array(
			'default'           => 'rgba(20, 88, 112, 0.4)',
			'transport'         => 'refresh',
			'sanitize_callback' => 'itre_sanitize_coloralpha'
		)
	);

	$wp_customize->add_control(
		new itre_ColorAlpha(
			$wp_customize, 'itre_header_overlay_color', array(
				'label'      => __( 'Header Overlay Color', 'it-residence' ),
				'section'    => 'itre_header_options',
				'settings'   => 'itre_header_overlay_color'
			)
		)
	);

    //Position Control for Header image
    $wp_customize->add_setting(
        'itre_header_bg_pos', array(
            'default'  => 'center',
            'sanitize_callback'    => 'itre_sanitize_radio'
        )
    );

    $wp_customize->add_control(
	    new itre_Image_Radio_Control(
		    $wp_customize, 'itre_header_bg_pos', array(
			    'label'    =>  esc_html__('Select the Header Position', 'it-residence'),
	            'section'  =>  'header_image',
	            'priority' => 40,
	            'type'	   => 'image-radio',
	            'choices'	=>	array(
		            'topleft'	=>	array(
			            'name'	=>	esc_html__('Top Right', 'it-residence'),
			            'image'	=>  esc_url(get_template_directory_uri() . '/assets/images/arrows/top-left.png'),
		            ),
		            'centertop'	=>	array(
			            'name'	=>	esc_html__('Center Top', 'it-residence'),
			            'image'	=>  esc_url(get_template_directory_uri() . '/assets/images/arrows/center-top.png'),
		            ),
		            'topright'	=>	array(
			            'name'	=>	esc_html__('Top Right', 'it-residence'),
			            'image'	=>  esc_url(get_template_directory_uri() . '/assets/images/arrows/top-right.png'),
		            ),
                    'centerleft'	=>	array(
			            'name'	=>	esc_html__('Center Left', 'it-residence'),
			            'image'	=> esc_url(get_template_directory_uri() . '/assets/images/arrows/center-left.png'),
		            ),
                    'center'	=>	array(
			            'name'	=>	esc_html__('Center', 'it-residence'),
			            'image'	=> esc_url(get_template_directory_uri() . '/assets/images/arrows/center.png'),
		            ),
		            'centerright'	=>	array(
			            'name'	=>	esc_html__('Center Right', 'it-residence'),
			            'image'	=> esc_url(get_template_directory_uri() . '/assets/images/arrows/center-right.png'),
		            ),
                    'bottomleft'	=>	array(
			            'name'	=>	esc_html__('Bottom Left', 'it-residence'),
			            'image'	=>  esc_url(get_template_directory_uri() . '/assets/images/arrows/bottom-left.png'),
		            ),
		            'centerbottom'	=>	array(
			            'name'	=>	esc_html__('Center Bottom', 'it-residence'),
			            'image'	=>  esc_url(get_template_directory_uri() . '/assets/images/arrows/center-bottom.png'),
		            ),
                    'bottomright'	=>	array(
			            'name'	=>	esc_html__('Bottom Right', 'it-residence'),
			            'image'	=>  esc_url(get_template_directory_uri() . '/assets/images/arrows/bottom-right.png'),
		            )
	            )
	        )
	    )
    );

    $s = [];

    for ($i = 1; $i <= 8; $i++) {
        $s[$i - 1] = $wp_customize->get_control( 'itre_header_slider_img_' . $i );
    }
    array_push( $s, $wp_customize->get_control( 'itre_header_video_url' ) );

    $header_controls = array_filter( $s );
    foreach ( $header_controls as $control ) {
        $control->active_callback = function( $control ) {
            $setting = $control->manager->get_setting( 'itre_front_header_layout' );

            if (  $setting->value() === 'slider' ) {
                if ( $control->id !== "itre_header_video_url" ) {
                    return true;
                } else {
                    return false;
                }
            }

            if ( $setting->value() === 'video') {
                if ( $control->id == "itre_header_video_url" ) {
                    return true;
                } else {
                    return false;
                }
            }

        };
    }
}
add_action('customize_register', 'itre_header_customize_register');
