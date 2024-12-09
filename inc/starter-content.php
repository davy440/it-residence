<?php
/**
 *   Starter Content
**/
if (!defined('ABSPATH')) {
	exit;
}

if ( !function_exists('itre_add_starter_content') ) {
    function itre_add_starter_content() {

        $content = array(
            'options'   =>  array(
                'show_on_front'    =>   'page',
                'page_on_front'    =>   '{{home}}',
                'blogname'            =>  'IT Residence',
                'blogdescription'  =>  esc_html_x('An Elegant Real Estate WordPress Theme', 'Theme Starter Content', 'it-residence'),
            ),
            'attachments'   =>  array(
                'image-handshake'   =>  array(
                    'post_title'    =>  esc_html_x('Handshake', 'Theme Starter Content', 'it-residence'),
                    'file'          =>  'assets/images/starter/image-handshake.jpeg'
                ),
                'image-dealer'      =>  array(
                    'post_title'    =>  esc_html_x('Property Dealer', 'Theme Starter Content', 'it-residence'),
                    'file'          =>  'assets/images/starter/image-property-dealer.jpeg'
                ),
                'image-cash'        =>  array(
                    'post_title'    =>  esc_html_x('Cash', 'Theme Starter Content', 'it-residence'),
                    'file'          =>  'assets/images/starter/image-cash.jpeg'
                ),
                'image-logo'        =>  array(
                    'post_title'    =>  esc_html_x('Site Logo', 'Theme Starter Content', 'it-residence'),
                    'file'          =>  'assets/images/logo.png'
                ),
                'image-logo-white'  =>  array(
                    'post_title'    =>  esc_html_x('Site Logo - White', 'Theme Starter Content', 'it-residence'),
                    'file'          =>  'assets/images/logo-white.png'
                ),
            ),
            'posts'         =>  array(
                'home'          =>  array(
                    'post_type'     =>  'page',
                    'post_title'    =>  _x('<h1 style="text-align: center;">Welcome to IT Residence Pro!</h1>', 'Theme starter content', 'it-residence'),
                    'post_content'  =>  _x(
                        '<p style="text-align: center;max-width: 48rem;margin-left: auto;margin-right: auto;">Grow your Real Estate business with our super light-weight and fully featured IT Residence. Showcase your listings, generate leads and deal with clients taking your business to new heights.</p>
                        <p style="text-align: center;max-width: 48rem;margin-left: auto;margin-right: auto;">Just activate the theme, add required plugins, import demo content and you\'re ready to go.</p>',
                        'Theme starter content', 'it-residence'),
                )
            ),
            'widgets'   =>  array(
                'footer-1'  =>  array(
                    'footer_logo'   =>  array(
                        'text',
                        array(
                            'text'  => '<!-- wp:image {"id":1208,"sizeSlug":"full","linkDestination":"none"} -->
                            <figure class="wp-block-image size-full"><img src="' . esc_url( ITRE_URL . 'assets/images/logo-white.png') . '" alt="Logo - White" class="wp-image-1208" style="max-width: 75%;"/></figure>
                            <!-- /wp:image -->'
                        )
                    ),
                    'footer_address' => array(
                        'text',
                        array(
                            'text'  =>  '123, McDonald Street<br>Kentucky KY, 42101
                            <br><br>
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#ffffff"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M6.54 5c.06.89.21 1.76.45 2.59l-1.2 1.2c-.41-1.2-.67-2.47-.76-3.79h1.51m9.86 12.02c.85.24 1.72.39 2.6.45v1.49c-1.32-.09-2.59-.35-3.8-.75l1.2-1.19M7.5 3H4c-.55 0-1 .45-1 1 0 9.39 7.61 17 17 17 .55 0 1-.45 1-1v-3.49c0-.55-.45-1-1-1-1.24 0-2.45-.2-3.57-.57-.1-.04-.21-.05-.31-.05-.26 0-.51.1-.71.29l-2.2 2.2c-2.83-1.45-5.15-3.76-6.59-6.59l2.2-2.2c.28-.28.36-.67.25-1.02C8.7 6.45 8.5 5.25 8.5 4c0-.55-.45-1-1-1z"/></svg><span style="margin-left: 0.5rem">+1 100 200 3333</span>
                            <br>
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#ffffff"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M22 6c0-1.1-.9-2-2-2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6zm-2 0l-8 5-8-5h16zm0 12H4V8l8 5 8-5v10z"/></svg><span style="margin-left: 0.5rem">abc@example.com</span>'
                        )
                    ),
                ),
                'footer-2' => array(
                    'footer_text'   =>  array(
                        'text',
                        array(
                            'title' =>  _x('Widget Area', 'Theme starter content', 'it-residence'),
                            'text'  =>  _x('Add Widgets Here.', 'Theme starter content', 'it-residence'),
                        )
                    )
                ),
                'footer-3' => array(
                    'footer_text'   =>  array(
                        'text',
                        array(
                            'title' =>  _x('Another Widget Area', 'Theme starter content', 'it-residence'),
                            'text'  =>  _x('Add Widgets Here.', 'Theme starter content', 'it-residence'),
                        )
                    )
                ),
                'footer-4' => array(
                    'footer_text'   =>  array(
                        'text',
                        array(
                            'title' =>  _x('Yet Another Widget Area', 'Theme starter content', 'it-residence'),
                            'text'  =>  _x('Add Widgets Here.', 'Theme starter content', 'it-residence'),
                        )
                    )
                ),
            ),
            'theme_mods'    =>  array(
                'custom_logo'               =>  '{{image-logo}}',
                'header_textcolor'          =>  'blank',
                'itre_hero_title'           =>  esc_html_x('Your Dreams, Our Commitment', 'Theme Starter Content', 'it-residence'),
                'itre_hero_desc'            =>  esc_html_x('The Most Elegant Real Estate WordPress Theme', 'Theme Starter Content', 'it-residence'),
                'itre_blog_sidebar_enable'  =>  '',
                'itre_blog_layout'          =>  'col3',
                'itre_cta_enable'           =>  1,
                'itre_cta_text'             =>  __('Add Listing', 'it-residence'),
                'itre_cta_id'              =>  '#'
            )
        );
        add_theme_support( 'starter-content', $content );
    }
}
add_action('after_setup_theme', 'itre_add_starter_content');