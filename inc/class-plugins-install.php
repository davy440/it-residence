<?php 
/**
 * Class to add plugins in Theme Options page
 */
class ITRE_Plugin_Upgrader {

    public function __construct() {
        add_action('admin_enqueue_scripts', [$this, 'itre_enqueue_upgrader_script']);
        add_action('wp_ajax_install_plugin', [$this, 'itre_plugin_action']);
    }

    public function itre_plugin_action() {
        
        if (!wp_verify_nonce( $_POST['nonce'], 'installer_nonce' ) ) {
            return;
        }
        
        $install_type = $_POST['process'];
        
        if ( $install_type == 'install' ) {
            $this->itre_plugin_install();
        } else if ($install_type == 'activate') {
            $this->itre_plugin_activate();
        }

        wp_die();
    }

    public function itre_enqueue_upgrader_script( $hook ) {
        
        wp_enqueue_script('itre-plugins-install-js', esc_url( ITRE_URL . 'assets/js/min/plugins-install.min.js' ), array(), ITRE_VERSION, true );
        $data = array(
            'action'            =>  'install_plugin',
            'installer_nonce'    =>  wp_create_nonce('installer_nonce')
        );
        wp_localize_script('itre-plugins-install-js', 'data', $data);
    }

    public static function itre_button_label( $slug ) {
        $paths = array(
            'it-listings'       =>  'it-listings/it-listings.php',
            'contact-form-7'    =>  'contact-form-7/wp-contact-form-7.php'
        );

        $spinner = '<svg class="loader" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="48.25" height="48.25" viewBox="0 0 48.25 48.25"><defs><clipPath id="a" transform="translate(0.13 0.13)"><rect width="48" height="48" fill="none" stroke="#843a3a" stroke-miterlimit="10" stroke-width="0.25" opacity="0"/></clipPath></defs><title>loader</title><g clip-path="url(#a)"><path d="M14,15.11a13.3,13.3,0,0,1,9.32-4.45L23,5A19.27,19.27,0,0,0,9.74,11.3,18.86,18.86,0,0,0,4.83,24.37l-3.39.24,6.63,5.85,5.85-6.62-3.39.24A13.46,13.46,0,0,1,14,15.11Z" transform="translate(0.13 0.13)" fill="#fff"/><path d="M37.54,34.83,28.89,33l1.8,2.79a13.77,13.77,0,0,1-18-4.36L7.85,34.59A19.13,19.13,0,0,0,22.38,43.2a19.74,19.74,0,0,0,11.45-2.6l1.9,2.87,1.81-8.64Z" transform="translate(0.13 0.13)" fill="#fff"/><path d="M42.39,18.05A19.68,19.68,0,0,0,33.52,7.24L35.1,4.12,26.67,6.81l2.69,8.44,1.5-3a13.63,13.63,0,0,1,6,7.4,13.45,13.45,0,0,1-.79,10.28l5.1,2.65A18.56,18.56,0,0,0,42.39,18.05Z" transform="translate(0.13 0.13)" fill="#fff"/></g><rect x="0.13" y="0.13" width="48" height="48" fill="none" stroke="#843a3a" stroke-miterlimit="10" stroke-width="0.25" opacity="0"/></svg>';

        $label = '<span class="activated">Activated</span>';

        if ( !file_exists( WP_PLUGIN_DIR . '/' . $paths[ $slug ] ) ) {
            $label = sprintf('<button type="submit" class="button-primary" data-slug="%s" data-process="install">Install</button>', $slug);
        } else if ( file_exists( WP_PLUGIN_DIR . '/' . $paths[ $slug ] ) && !is_plugin_active( $paths[ $slug ] ) ) {
            $label = sprintf('<button type="submit" class="button-primary" data-slug="%s" data-process="activate">Activate</button>', $slug);
        }

        return $label;
    }

    private function itre_plugin_install() {
        
        $slug = $_POST['plugin'];

        // Pass necessary information via URL if WP_Filesystem is needed.
        $url = wp_nonce_url(
            add_query_arg(
                ['page'  =>  'itre_options']
            ),
            'installer_nonce'
        );

        $method = ''; // Leave blank so WP_Filesystem can populate it as necessary.

        /** Let's try to setup WP_Filesystem */
		if ( false === ( $creds = request_filesystem_credentials( $url, $method, false, false, $fields ) ) )
        /** A form has just been output asking the user to verify file ownership */
        return true;

        if ( ! WP_Filesystem( $creds ) ) {
            request_filesystem_credentials( esc_url_raw( $url ), $method, true, false, array() ); // Setup WP_Filesystem.
            return true;
        }
        
        if (!class_exists('Plugin_Upgrader')) {
            require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
        }

        $upgrade = new Plugin_Upgrader();
        $source = $this->get_plugin_api( $slug );
        
        if (!empty($source)) {
            $link = $source->download_link;
        }
        
        if ( $upgrade -> install( $link ) ) {
            
            // Deactivate plugin if activated on install
            deactivate_plugins( self::get_basename_from_slug( $slug ) );

        } else {
            return false;
        }
    }

    private function itre_plugin_activate() {
        $slug = $_POST['plugin'];
        $name = self::get_basename_from_slug( $slug );

        // Add plugin.php to use activate_plugin() function
        if ( ! function_exists( 'activate_plugin' ) ) {
            include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
        }

        // Need to add wp_redirect function in case activation causes a redirect
        if ( ! function_exists( 'wp_redirect' ) ) {
            include_once( ABSPATH . 'wp-includes/pluggable.php' );
        }

        // Not for a network
        $network = false;

        //prevents execution of activate_plugin hook for this plugin.
	    $silent = false;

        return $activate = activate_plugin( $name, '', $network, $silent );
        
        if ( is_wp_error( $activate ) ) {
            return false;
        }
    }

    private function get_plugin_api( $slug ) {

        if ( ! function_exists( 'plugins_api' ) ) {
            require_once ABSPATH . 'wp-admin/includes/plugin-install.php';
        }
        
        $source = '';
        $api = plugins_api(
            'plugin_information',
            [
                'slug' => $slug,
                'fields' =>  [
                    'active_installs' => false,           // rounded int
                    'added' => false,                     // date
                    'author' => false,                    // a href html
                    'author_block_count' => false,        // int
                    'author_block_rating' => false,       // int
                    'author_profile' => false,            // url
                    'banners' => false,                   // array( [low], [high] )
                    'compatibility' => false,            // empty array?
                    'contributors' => false,              // array( array( [profile], [avatar], [display_name] )
                    'description' => false,              // string
                    'donate_link' => false,               // url
                    'download_link' => true,             // url
                    'downloaded' => false,               // int
                    // 'group' => false,                 // n/a 
                    'homepage' => false,                  // url
                    'icons' => false,                    // array( [1x] url, [2x] url )
                    'last_updated' => false,              // datetime
                    'name' => false,                      // string
                    'num_ratings' => false,               // int
                    'rating' => false,                    // int
                    'ratings' => false,                   // array( [5..0] )
                    'requires' => false,                  // version string
                    'requires_php' => false,              // version string
                    // 'reviews' => false,               // n/a, part of 'sections'
                    'screenshots' => false,               // array( array( [src],  ) )
                    'sections' => false,                  // array( [description], [installation], [changelog], [reviews], ...)
                    'short_description' => false,        // string
                    'slug' => true,                      // string
                    'support_threads' => false,           // int
                    'support_threads_resolved' => false,  // int
                    'tags' => false,                      // array( )
                    'tested' => false,                    // version string
                    'version' => false,                   // version string
                    'versions' => false,                  // array( [version] url )
                ]
            ]
        );

        if ( ! $api || is_wp_error( $api ) ) {
            return false;
        }
    
        return $api;
    }

    public static function get_basename_from_slug( $slug ) {
        $keys = array_keys( get_plugins() );
        
        foreach( $keys as $key ) {
            if ( preg_match('/' . $slug . '\//', $key) ) {
                return $key;
            }
        }
    }
}

$upgrader = new ITRE_Plugin_Upgrader();