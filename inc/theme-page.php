<?php
/**
 *  Theme Page
 */

function itre_admin_theme_page() {
    add_theme_page('IT Residence', 'IT Residence', 'edit_theme_options', 'itre_options', 'itre_theme_info');
}
add_action('admin_menu', 'itre_admin_theme_page');

function itre_theme_info() {
    ?>
    <div id="itre-admin-theme-info">
        <h1 class="itre-theme-page-title"><?php _e('IT Residence Options', 'it-residence'); ?></h1>
        <div class="itre-support-plugins">
            <p><strong>To set up the theme, you'll need to install the following plugins -</strong></p>
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
                    printf( '<div class="itre-support-plugins__links"><a href="%s" class="itre-support-plugins__links--demos">Import Demo</a><button class="itre-support-plugins__links--nothanks">No Thanks!</button></div>', esc_url( $url ) );
                    printf('</div>');
                    
                }
            ?>
        </div>

        <div class="sep"></div>

        <div class="theme-pro">
            <h2><?php _e('Unlock the full potential of your Real Estate Business. Get IT  Residence Pro', 'it-residence'); ?></h2>
            <p><?php _e('The Pro version offers features and upgrades that would make your platform stand out!', 'it-residence') ?></p>

            <table class="compare">
            <tbody>
            <tr>
            <th></th>
            <th>IT Residence</th>
            <th>IT Residence Pro</th>
            </tr>
            <tr>
            <th>Blog Layouts</th>
            <td>3</td>
            <td>5</td>
            </tr>
            <tr>
            <th>Header Layouts</th>
            <td>3</td>
            <td>10+</td>
            </tr>
            <tr>
            <th>Front Page Sections</th>
            <td>3</td>
            <td>7</td>
            </tr>
            <tr>
            <th>Property Maps</th>
            <td>Few Options</td>
            <td>More Options</td>
            </tr>
            <tr>
            <th>Property Archive Layouts</th>
            <td>1</td>
            <td>5</td>
            </tr>
            <tr>
            <th>Typography</th>
            <td>No</td>
            <td>Yes</td>
            </tr>
            <tr>
            <th>Agents Section</th>
            <td>No</td>
            <td>Yes</td>
            </tr>
            <tr>
            <th>SEO</th>
            <td>Yes</td>
            <td>Yes</td>
            </tr>
            <tr>
            <th>Colors</th>
            <td>Basic</td>
            <td>Advanced</td>
            </tr>
            <tr>
            <th>Speed Optimization</th>
            <td>Basic</td>
            <td>Advanced</td>
            </tr>
            <tr>
            <th>Dedicated Support</th>
            <td>Basic</td>
            <td>Priority</td>
            </tr>
            </tbody>
            </table>
            
            <div class="theme-pro__content">
                <figure class="pro-thumb">
                    <a href="http://demo.indithemes.com/it-residence-pro" target="_blank" rel="external">
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/pro.png'); ?>" alt="<?php echo __('IT Residence Demo', 'it-residence') ?>">
                    </a>
                </figure>
                <div class="upsell-links">
                    <a class="itre-demo-btn button button-secondary" href="https://demo.indithemes.com/it-residence-pro" target="_blank">
                        <?php _e('Visit Demo', 'it-residence'); ?>
                    </a>
                    <a class="itre-pro-btn button button-primary" href="https://indithemes.com/product/it-residence-pro/" target="_blank">
                        <?php _e('Get IT Residence Pro', 'it-residence'); ?>
                    </a>
                </div>
            </div>
        </div>

        <br>
        <br>
        <p>
            <?php printf('<h3>For Support, Suggestions and Queries, please use %s or mail us at support@indithemes.com. <b>We are here for you!</b></h3>', '<a href="https://indithemes.com/contact-us/" target="_blank" rel="help">this form</a>');
            ?>
        </p>
        <p>
            <?php printf('Using IT Residence and loving it? Consider leaving it a %s review at %s. It really means a lot!', '<span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span>', '<a href="https://wordpress.org/themes/it-residence" rel="external" target="_blank">WordPress</a>');
            ?>
        </p>
    </div>
    <?php
}
