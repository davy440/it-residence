<?php
/**
 * The class dealing with Google Fonts functionality for the theme
 * Maintaining the cache, typography controls and updating font files
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

 class ITRE_Google_Fonts {

    private static $instance;

    private function __construct() {
        add_action('customize_controls_enqueue_scripts', array( $this, 'itre_localize_google_fonts' ) );
        add_action('init', array( $this, 'itre_get_selected_fonts' ) );
    }

    static function getInstance() {
        if (empty(self::$instance)) {
            self::$instance = new ITRE_Google_Fonts();
        }

        return self::$instance;
    }

    public static function itre_get_fonts( $amount = 50 ) {

        $fontFile = ITRE_PATH . 'assets/cache/google-web-fonts.txt';
    
        //Total time the file will be cached in seconds, set to a week
        $cachetime = 86400 * 7;
    
        $timeElapsed = time() - filemtime($fontFile);
    
        if ( file_exists($fontFile) && $cachetime > $timeElapsed )
        {
            $google_fonts_json = json_decode( file_get_contents( $fontFile ) );
        } else {
    
            $googleApi = 'https://www.googleapis.com/webfonts/v1/webfonts?sort=popularity&capability=WOFF2&key=AIzaSyA9-9K8wV9KWKWY84Sp5TLSS7p9GguLRh4';
    
            $fontContent = wp_remote_get( $googleApi, array( 'sslverify'   => false ) );
    
            $fp = fopen($fontFile, 'w');
            fwrite($fp, $fontContent['body']);
            fclose($fp);
    
            $google_fonts_json = json_decode($fontContent['body']);
        }
        
        // Extract the font-family and their respective weights in a key => value associative array
        foreach ( $google_fonts_json->items as $font ) {
    
            $google_fonts[ $font->family ]	= ['variants'   =>  $font->variants,'category'  =>  $font->category];
    
        }
        
        if($amount == 'all')
        {
            return $google_fonts;
        } else {
            return array_slice($google_fonts, 0, (int)$amount );
        }
    }

    public function itre_localize_google_fonts() {

        $fonts = self::itre_get_fonts();
        wp_localize_script( 'itre-typography-js', 'itre', $fonts );
    }

    /**
     * Create an array of arrays of settings in which each item
     * will have the position (heading, body in this case) as key and 
     * value will be an array of font family and font weight
     *
     * @return  array  Array containing information about the settings
     */
    public static function itre_get_font_settings() {

        // Array containing slugs of all the typography settings
        $defs = array(
            'heading' => array(
                'family'    =>  'League Spartan',
                'weight'    =>  700,
                'cat'       =>  'sans-serif'
            ),
            'body'  => array(
                'family'    =>  'League Spartan',
                'weight'    =>  400,
                'cat'       =>  'sans-serif' 
            )
        );
    
        $f_prefix   = 'itre_gfonts_';
        $w_prefix   = 'itre_gweights_';
        $c_prefix   = 'itre_gcat_';
        $settings = [];
    
        foreach ($defs as $key => $value) {
            $setting['family']  = get_theme_mod("{$f_prefix}{$key}", $value['family']);
            $setting['weight']  = intval(get_theme_mod("{$w_prefix}{$key}", $value['weight']));
            $setting['cat']     = get_theme_mod("{$c_prefix}{$key}", $value['cat']);
            
            $settings[$key] = $setting;
        }
        return $settings;
    }
    
    /**
     * Function handling Google Fonts file management functionality
     * Download the requested WOFF2 file and delete older file
     *
     * @return  void
     */
    public function itre_get_selected_fonts() {
    
        $fonts = self::itre_get_font_settings();

        $fileDir = ITRE_PATH . 'assets/cache/fontFiles/';
        $cache_files = glob($fileDir . '*.woff2');
     
        $cache_array = [];
        foreach ($cache_files as $file) {
            if (strpos($file, 'heading')) {
                $cache_array['heading'] = basename($file);
            }
        
            if (strpos($file, 'body')) {
                $cache_array['body'] = basename($file);
            }
        }
    
        foreach($fonts as $key => $value) {
            $font_slug = str_replace(' ', '-', strtolower($value['family']));
            $weight = $value['weight'];
            $file = $fileDir . "font-{$key}-{$font_slug}-{$weight}.woff2";
    
            // If the setting has changed, get the new file
            if ( !file_exists( $file ) ) {
    
                $fontFile = ITRE_PATH . 'assets/cache/google-web-fonts.txt';
                $fonts_json = json_decode( file_get_contents( $fontFile ) );
                $items = $fonts_json->items;
                foreach ($items as $item ) {
                    if ( $item->family == $value['family']) {
                        $woff2_files = $item->files;
                        $woff2_file = $value['weight'] === 400 ? $woff2_files->regular : $woff2_files->{$value['weight']};
                        break;
                    }
                }
    
                // Fetch the WOFF2 font file
                $body = wp_remote_retrieve_body( wp_remote_get( esc_url_raw( $woff2_file ), array( 'sslverify' => false ) ) );
                $fc = fopen($file, 'w+');
                fwrite($fc, $body);
                fclose($fc);
    
                // Delete the old file
                unlink($fileDir . $cache_array[$key]);
            }
        }
    }
}

$instance = ITRE_Google_Fonts::getInstance();