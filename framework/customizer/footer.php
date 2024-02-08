<?php
/**
 *  Customizer Section for Footer
 */

 function itre_customize_register_footer( $wp_customize ) {

    $wp_customize->add_section(
        'itre_footer_section', array(
            'title'    => esc_html__('Footer', 'it-residence'),
            'priority' => 80,
        )
    );

    $wp_customize->add_setting(
        'itre_footer_cols', array(
            'default'  => 4,
            'sanitize_callback'    => 'absint'
        )
    );

    $wp_customize->add_control(
	    new itre_Image_Radio_Control(
		    $wp_customize, 'itre_footer_cols', array(
			    'label'    =>  esc_html__('Select the Footer Layout', 'it-residence'),
	            'section'  =>  'itre_footer_section',
	            'priority' => 5,
	            'type'	   => 'image-radio',
	            'choices'	=>	array(
		            '1'	=>	array(
			            'name'	=>	esc_html__('1 Column', 'it-residence'),
			            'image'	=>  esc_url(get_template_directory_uri() . '/assets/images/1-column.png'),
		            ),
		            '2'	=>	array(
			            'name'	=>	esc_html__('2 Columns', 'it-residence'),
			            'image'	=>  esc_url(get_template_directory_uri() . '/assets/images/2-columns.png'),
		            ),
		            '3'	=>	array(
			            'name'	=>	esc_html__('3 Columns', 'it-residence'),
			            'image'	=>  esc_url(get_template_directory_uri() . '/assets/images/3-columns.png'),
		            ),
		            '4'	=>	array(
			            'name'	=>	esc_html__('4 Columns', 'it-residence'),
			            'image'	=> esc_url(get_template_directory_uri() . '/assets/images/4-columns.png'),
		            ),
	            )
	        )
	    )
    );
 }
 add_action('customize_register', 'itre_customize_register_footer');
