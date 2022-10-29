<?php
/**
 *
 *  Functionality for Custom Colors
 *
 */

function itre_custom_colors() {

    $css = "";

    $body_bg       = get_theme_mod('background_color', '#ffffff');

    $accent         = get_theme_mod('itre_accent_color', '#2e6d87');

    $meta_link      = get_theme_mod('itre_link_color', '#999999');
    $meta_link_hvr  = get_theme_mod('itre_link_hvr_color', '#555555');

    $nav_link       = get_theme_mod('itre_nav_link_clr', '#2e6d87');
    $subnav_link    = get_theme_mod('itre_submenu_link_clr', '#ffffff');

    $header_overlay = get_theme_mod('itre_header_overlay_color', 'rgba(20, 88, 112, 0.4)');

    $css .= "#itre-featured-property .itre-feat-prop-info {background-color: #{$body_bg};}";





    if ($accent !== '#2e6d87') {
        $css .= ":root {--accent: {$accent};}";
    }

    if ($meta_link !== '#999999') {
        $css .= ":root {--link: {$meta_link};}";
    }

    if ($meta_link_hvr !== '#555555') {
        $css .= "root {--link-hvr: {$meta_link_hvr};}";
    }



    if ($nav_link !== '#2e6d87') {
        $css .= ":root {--nav-link: {$nav_link};}";
    }

    if ($subnav_link !== '#ffffff') {
        $css .= ":root {--subnav-link: {$subnav_link};}";
    }

    $css .= "#header-image:before {
		 background-color: " . esc_html( $header_overlay ) . ";
	 }";

    wp_add_inline_style('itre-main', esc_html($css));

}
add_action('wp_enqueue_scripts', 'itre_custom_colors');
