<?php
/**
 *  Custom CSS generated through PHP
 */

if ( !function_exists('itre_custom_css') ) {
    function itre_custom_css() {
        $title_font = [
            'font'   => get_theme_mod('itre_gfonts_heading', 'League Spartan'),
            'weight' => get_theme_mod('itre_gweights_heading', '700'),
            'cat'    => get_theme_mod('itre_gcat_heading', 'sans-serif')
        ];
        $body_font = [
            'font'   => get_theme_mod('itre_gfonts_body', 'League Spartan'),
            'weight' => get_theme_mod('itre_gfweights_body', '400'),
            'cat'    => get_theme_mod('itre_cat_body', 'sans-serif')
        ];

        $header_pos      = get_theme_mod('itre_header_bg_pos', 'center');
        $sidebar_width   = get_theme_mod('itre_sidebar_width', '25');
        $primary_width   = (100 - intval($sidebar_width)) . '%';
        $secondary_width = intval($sidebar_width) . '%';
        $header_height   = get_theme_mod('itre_header_height', '500');

        $pos_val = [
            'topleft'      => 'left top',
            'centertop'    => 'center top',
            'topright'     => 'right top',
            'centerright'  => 'right center',
            'center'       => 'center center',
            'centerleft'   => 'left center',
            'bottomleft'   => 'left bottom',
            'centerbottom' => 'center bottom',
            'bottomright'  => 'right bottom'
        ];

        $css = ":root {
            --title-font: {$title_font['font']}, {$title_font['cat']};
            --title-weight: {$title_font['weight']};
            --body-font: {$body_font['font']}, {$body_font['cat']};
            --body-weight: {$body_font['weight']};
        }";

        if ( isset($pos_val[$header_pos]) && $header_pos !== 'center' ) {
            $css .= "#header-image { background-position: {$pos_val[$header_pos]} !important; }";
        }

        $css .= "body.home #header-image, #header-slider, #header-video { height: {$header_height}px; }";

        $css .= "@media screen and (min-width: 62rem) {";

        if (
            is_home() &&
            is_active_sidebar('sidebar-blog') &&
            get_theme_mod('itre_blog_sidebar_enable', 1)
        ) {
            $css .= "body.blog #primary { width: {$primary_width}; }";
            $css .= "body.blog #secondary { width: {$secondary_width}; }";
        }

        if (
            (is_post_type_archive('property') || is_tax('location') || is_tax('property-type')) &&
            is_active_sidebar('sidebar-property')
        ) {
            $css .= "body.post-type-archive-property #primary, body.tax-location #primary, body.tax-property-type #primary { width: {$primary_width}; }";
            $css .= "body.post-type-archive-property #secondary, body.tax-location #secondary, body.tax-property-type #secondary { width: {$secondary_width}; }";
        }

        if (
            !is_front_page() &&
            is_page() &&
            is_active_sidebar('sidebar-blog') &&
            get_post_meta(get_the_ID(), 'enable-sidebar', true)
        ) {
            $css .= "body.page-template-default #primary { width: {$primary_width}; }";
            $css .= "body.page-template-default #secondary { width: {$secondary_width}; }";
        }

        $css .= "}";

        wp_add_inline_style('itre-main', $css);
    }
}
add_action('wp_enqueue_scripts', 'itre_custom_css');
