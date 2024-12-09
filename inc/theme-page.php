<?php
/**
 *  Theme Page
 */
if (!defined('ABSPATH')) {
	exit;
}

function itre_admin_theme_page() {
    add_theme_page('IT Residence', 'IT Residence', 'edit_theme_options', 'itre_options', 'itre_theme_info');
}
add_action('admin_menu', 'itre_admin_theme_page');

function itre_theme_info() {
    ?>
    <div id="itre-admin-theme-info">
        <h1 class="itre-theme-page-title"><?php _e('IT Residence Options', 'it-residence'); ?></h1>
        <div class="itre-support">
            <?php
                $img = ITRE_URL . 'assets/images/technical-support.png';
                printf('<figure class="itre-support__image"><img src="%s" alt="Customer Support"/></figure>', esc_url($img));
                printf('<p class="itre-support__content">For Support, Suggestions and Queries, please use %s or mail us at support@indithemes.com.<br><b>We are looking forward to hearing from you!</b></p>', '<a href="https://indithemes.com/contact-us/" target="_blank" rel="help">this form</a>');
            ?>
        </div>

        <div class="sep"></div>

        <div class="itre-demo-imports">
            <h2><?php _e('Install Demos', 'it-residence'); ?></h2>
            <p><?php _e('To get started, you can import content from our pre-made templates.', 'it-residence') ?></p>
            <?php if ( class_exists('IT_Listings') ) {
                $importer_url = admin_url('themes.php');
                $importer_url = add_query_arg( 'page', 'demo-importer', $importer_url );
                printf( '<a href="%s" class="button-primary" title="Import Demo">Import Demo</a>', esc_url( $importer_url ) );
            } else {
                ?>
                <p><?php _e('In order to get access to our Demo Templates, install the <a href="https://www.wordpress.org/plugins/it-listings">IT Listings</a> plugin. With the plugin, you get access to many features to use the to its full potential including -', 'it-residence'); ?></p>
                <ul>
                <li><?php _e('Dedciated Front Page Template', 'it-residence'); ?></li>
                <li><?php _e('Custom Blocks', 'it-residence'); ?></li>
                <li><?php _e('Testimonials Support', 'it-residence'); ?></li>
                <li><?php _e('Starter Demo Import', 'it-residence'); ?></li>
                </ul>
                <?php
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
            <th>Walk Score</th>
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
                        <img src="<?php echo esc_url( ITRE_URL . 'assets/images/pro.png'); ?>" alt="<?php echo __('IT Residence Demo', 'it-residence') ?>">
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
            <?php printf('Using IT Residence and loving it? Consider leaving it a %s review at %s. It really means a lot!', '<span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span>', '<a href="https://wordpress.org/themes/it-residence" rel="external" target="_blank">WordPress</a>');
            ?>
        </p>
    </div>
    <?php
}
