<?php
/**
 * PHP File for showing notice in Dashboard
 * 
 * @package IT_Residence
 */
function itre_admin_notice() { 

    $theme_name = wp_get_theme()->get('Name');

    global $pagenow;
    if ( $pagenow == 'themes.php' && isset($_GET['page']) && $_GET['page'] == 'demo-importer') {
        return;
    }

    if ( ! PAnD::is_admin_notice_active( 'disable-done-notice-forever' ) ) {
		return;
	}
    ?>
	
	<div data-dismissible="disable-done-notice-forever" class="itre-notice notice notice-info is-dismissible">
        <h2><?php _e('Cheers to you! 👏👏👏', 'it-residence'); ?></h2>
        <h3><?php _e('You just installed ' . $theme_name . ' WordPress Theme. Thankyou for that!', 'it-residence'); ?></h3>
		<p><?php _e('We highly recommend you install the following plugins to make full use of IT Residence.', 'it-residence'); ?></p>
        <p><?php _e('Features you\'ll get access to include -', 'it-residence') ?></p>
        <ul>
            <li><?php _e('Dedciated Front Page Template', 'it-residence'); ?></li>
            <li><?php _e('Custom Blocks', 'it-residence'); ?></li>
            <li><?php _e('Testimonials Support', 'it-residence'); ?></li>
            <li><?php _e('Starter Demo Import', 'it-residence'); ?></li>
        </ul>
        <form class="itre-support-plugins-form" method="post">
            <table class="itre-support-plugins-table">
                <tr>
                    <th>Contact Form 7</th>
                    <td><?php echo ITRE_Plugin_Upgrader::itre_button_label('contact-form-7'); ?></td>
                </tr>
                <tr>
                    <th>IT Listings</th>
                    <td><?php echo ITRE_Plugin_Upgrader::itre_button_label('it-listings'); ?></td>
                </tr>
                <input class="process" type="hidden" name="process" value="" />
                <input class="plugin" type="hidden" name="plugin" value="" />
            </table>
        </form>

        <?php
            if (is_plugin_active('it-listings/it-listings.php') && is_plugin_active('contact-form-7/wp-contact-form-7.php')) {
                $url = admin_url('themes.php');
                $url = add_query_arg('page', 'demo-importer', $url);
                
                printf('<div class="itre-demo-import">');
                echo '<p>Plugins Installed! You are ready to start with your website! Create something awesome!</p>';
                echo '<p>You can also import content from our pre-made demos.</p>';
                printf( '<div class="itre-support-plugins__links"><a href="%s" class="itre-support-plugins__links--demos button button-primary">Demo Templates</a><button class="itre-support-plugins__links--nothanks button button-secondary">No Thanks!</button></div>', esc_url( $url ) );
                printf('</div>');
                
            }
        ?>
	</div>
<?php }
add_action( 'admin_init', array( 'PAnD', 'init' ) );
add_action( 'admin_notices', 'itre_admin_notice' );