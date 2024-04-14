<?php
/**
 *	Block Styles for Block Editor
 */
if ( !function_exists('itre_block_style') ) {
    function itre_block_style() {

        wp_enqueue_style( 'itre-block-style', esc_url( get_template_directory_uri() . '/assets/theme-styles/css/block-styles.css'), array(), ITRE_VERSION );

        // Widget Title
        register_block_style(
            'core/heading',
            array(
                'name'			=>	'widget-title',
                'label'			=>	__('Widget Title', 'it-residence'),
                'style-handle'  =>  'itre-block-style'
            )
        );

        // Property Table
        register_block_style(
            'core/table',
            array(
                'name'			=>	'prop-table',
                'label'			=>	__('Property Table', 'it-residence'),
                'style-handle'  =>  'itre-block-style'
            )
        );

        // Features - 2 Columns
        register_block_style(
            'core/list',
            array(
                'name'			=>	'two-col-list',
                'label'			=>	__('Features - 2 Columns', 'it-residence'),
                'style-handle'  =>  'itre-block-style'
            )
        );

        // Features - 3 Columns
        register_block_style(
            'core/list',
            array(
                'name'			=>	'three-col-list',
                'label'			=>	__('Features - 3 Columns', 'it-residence'),
                'style-handle'  =>  'itre-block-style'
            )
        );

        // Property Images
        register_block_style(
            'core/gallery',
            array(
                'name'			=>	'lightbox',
                'label'			=>	__('Lightbox', 'it-residence'),
                'style-handle'  =>  'itre-block-style'
            )
        );
    }
}
add_action( 'init', 'itre_block_style' );
