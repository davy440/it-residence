<?php
/**
 * Get the google fonts from the API or in the cache
 *
 * @param  integer $amount
 *
 * @return String
 */
function itre_get_fonts( $amount = 50 ) {

    $fontFile = get_template_directory() . '/assets/cache/google-web-fonts.txt';

    //Total time the file will be cached in seconds, set to a week
    $cachetime = 86400 * 7;

    if(file_exists($fontFile) && $cachetime < filemtime($fontFile ) )
    {
        $google_fonts_json = json_decode( file_get_contents( $fontFile ) );
    } else {

        $googleApi = 'https://www.googleapis.com/webfonts/v1/webfonts?sort=popularity&key=AIzaSyA9-9K8wV9KWKWY84Sp5TLSS7p9GguLRh4';

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

    wp_localize_script( 'itre-typography-js', 'itre', array_slice($google_fonts, 0, 100) );

    if($amount == 'all')
    {
        return $google_fonts;
    } else {
        return array_slice($google_fonts, 0, $amount);
    }

}
add_action( 'customize_controls_enqueue_scripts', 'itre_get_fonts' );
