<?php
/**
 *	Block Styles for Block Editor
 */
 function itre_block_style() {

	 wp_enqueue_style( 'itre-block-style', esc_url( get_template_directory_uri() . '/assets/theme-styles/css/block-styles.css'), array(), ITRE_VERSION );

	 register_block_style(
		'core/heading',
		array(
			'name'			=>	'widget-title',
			'label'			=>	__('Widget Title', 'it-residence'),
            'style-handle'  =>  'itre-block-style'
		)
	);

    register_block_style(
       'core/table',
       array(
           'name'			=>	'prop-table',
           'label'			=>	__('Property Table', 'it-residence'),
           'style-handle'  =>  'itre-block-style'
       )
   );

 }
 add_action( 'init', 'itre_block_style' );
