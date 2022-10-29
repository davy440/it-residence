<?php
/**
 *   Starter Content
**/
function itre_add_starter_content() {

    $content = array(
        'options'   =>  array(
            'show_on_front'    =>   'posts',
            'blogdescription'  =>  esc_html_x('Your Favourite Real Estate WordPress Theme', 'Theme Starter Content', 'it-residence'),
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
        ),
        'posts'         =>  array(
            'post-cash'	=>	array(
                'post_type'		=>	'post',
                'post_title'	=>	_x('Bought a Disputed Property? Here’s What You Can Do to Secure Your Investment', 'Theme starter content', 'it-residence'),
                'thumbnail'		=>	'{{image-cash}}'
            ),
            'post-dealer'	=>	array(
                'post_type'		=>	'post',
                'post_title'	=>	_x('Who are Property Lawyers and How can They Help You in Purchasing a New Property', 'Theme starter content', 'it-residence'),
                'thumbnail'		=>	'{{image-dealer}}'
            ),
            'post-kansas'	=>	array(
                'post_type'		=>	'post',
                'post_title'	=>	_x('Best Property Dealers in Kansas in 2022', 'Theme starter content', 'it-residence'),
                'thumbnail'		=>	'{{image-handshake}}'
            ),
        ),
        'theme_mods'    =>  array(
            'itre_hero_title'           =>  esc_html_x('Your Dreams, Our Commitment', 'Theme Starter Content', 'it-residence'),
            'itre_hero_desc'            =>  esc_html_x('Free Real Estate WordPress Theme', 'Theme Starter Content', 'it-residence'),
            'itre_blog_sidebar_enable'  =>  '',
            'itre_blog_layout'          =>  'col3'
        )
    );
    add_theme_support( 'starter-content', $content );
}
add_action('after_setup_theme', 'itre_add_starter_content');
