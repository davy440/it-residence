<?php
/**
 *  Sanitization Functions
 */

 function itre_sanitize_checkbox( $input ) {
    if ( $input == 1 ) {
        return 1;
    } else {
        return '';
    }
}

 function itre_sanitize_radio( $input, $setting ) {

 	// Ensure input is a slug
 	$input = sanitize_key( $input );

 	// Get list of choices from the control
 	// associated with the setting
 	$choices = $setting->manager->get_control( $setting->id )->choices;

 	// If the input is a valid key, return it;
 	// otherwise, return the default
 	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );

 }

 function itre_sanitize_select( $input, $setting ) {

    //input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
    $input = sanitize_key($input);

    //get the list of possible select options
    $choices = $setting->manager->get_control( $setting->id )->choices;

    //return input if valid or return default option
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );

}

 function itre_sanitize_dropdown_pages( $page_id, $setting ) {
  // Ensure $input is an absolute integer.
  $page_id = absint( $page_id );

  // If $page_id is an ID of a published page, return it; otherwise, return the default.
  return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
}

function itre_sanitize_coloralpha( $value ) {
 	// This pattern will check and match 3/6/8-character hex, rgb, rgba, hsl, & hsla colors.
 	$pattern = '/^(#[\da-f]{3}|\#[\da-f]{6}|\#[\da-f]{8}|rgba\(((\d{1,2}|1\d\d|2([0-4]\d|5[0-5]))\s*,\s*){2}((\d{1,2}|1\d\d|2([0-4]\d|5[0-5]))\s*)(,\s*(0\.\d+|1))\)|hsla\(\s*((\d{1,2}|[1-2]\d{2}|3([0-5]\d|60)))\s*,\s*((\d{1,2}|100)\s*%)\s*,\s*((\d{1,2}|100)\s*%)(,\s*(0\.\d+|1))\)|rgb\(((\d{1,2}|1\d\d|2([0-4]\d|5[0-5]))\s*,\s*){2}((\d{1,2}|1\d\d|2([0-4]\d|5[0-5]))\s*)|hsl\(\s*((\d{1,2}|[1-2]\d{2}|3([0-5]\d|60)))\s*,\s*((\d{1,2}|100)\s*%)\s*,\s*((\d{1,2}|100)\s*%)\))$/';
    \preg_match( $pattern, $value, $matches );
 	// Return the 1st match found.
 	if ( isset( $matches[0] ) ) {
 		if ( is_string( $matches[0] ) ) {
 			return $matches[0];
 		}
 		if ( is_array( $matches[0] ) && isset( $matches[0][0] ) ) {
 			return $matches[0][0];
 		}
 	}
 	// If no match was found, return an empty string.
 	return '';
 }
