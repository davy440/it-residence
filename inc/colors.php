<?php
/**
 *	Custom Colors
 */
if ( ! function_exists( 'itre_custom_colors' ) ) {
    function itre_custom_colors() {
        $defaults = [
            'background_color'         => '#ffffff',
            'itre_body_text_color'     => '#000000',
            'itre_accent_color'        => '#2e6d87',
            'itre_link_color'          => '#999999',
            'itre_link_hvr_color'      => '#555555',
            'itre_nav_link_clr'        => '#000000',
            'itre_submenu_link_clr'    => '#ffffff',
            'itre_header_overlay_color'=> 'rgba(20, 88, 112, 0.4)',
        ];

        $mods = [];
        foreach ( $defaults as $key => $default ) {
            $mods[ $key ] = get_theme_mod( $key, $default );
        }

        $css = "#itre-featured-property .itre-feat-prop-info {background-color: " . esc_html( $mods['background_color'] ) . ";}";

        $root_vars = [
            '--accent'      => [ $mods['itre_accent_color'], $defaults['itre_accent_color'] ],
            '--body-text'   => [ $mods['itre_body_text_color'], $defaults['itre_body_text_color'] ],
            '--link'        => [ $mods['itre_link_color'], $defaults['itre_link_color'] ],
            '--link-hvr'    => [ $mods['itre_link_hvr_color'], $defaults['itre_link_hvr_color'] ],
            '--subnav-link' => [ $mods['itre_submenu_link_clr'], $defaults['itre_submenu_link_clr'] ],
        ];

        $root_css = '';
        foreach ( $root_vars as $var => $colors ) {
            if ( $colors[0] !== $colors[1] ) {
                $root_css .= "{$var}: {$colors[0]};";
            }
        }
        if ( $root_css ) {
            $css .= ":root { {$root_css} }";
        }

        $css .= "#header-image:before { background-color: " . esc_html( $mods['itre_header_overlay_color'] ) . "; }";

        wp_add_inline_style( 'itre-main', $css );
    }
}
add_action( 'wp_enqueue_scripts', 'itre_custom_colors' );
