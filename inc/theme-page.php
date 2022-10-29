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
        <h1>
            <?php echo __('Theme Info', 'it-residence'); ?>
        </h1>
        <h2>
            <?php echo __('Check Out IT Residence Theme Demo', 'it-residence'); ?>
        </h2>
        <div class="itre-theme-demos">

            <figure class="demo-1">
                <a href="http://demo.indithemes.com/it-residence" target="_blank" rel="external">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/demos/1.jpeg'); ?>" alt="<?php echo __('IT Residence Demo', 'it-residence') ?>">
                </a>
            </figure>

        </div>

        <div class="theme-pro">
            <h2><?php _e('Want to do your website a favour? Get IT  Residence Pro', 'it-residence'); ?></h2>
            <p><?php _e('The Pro version offers a multitude of features which could take your Real Estate Business to the next level!', 'it-residence') ?></p>
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
                    <?php _e('Get Now', 'it-residence'); ?>
                </a>
            </div>
        </div>

        <br>
        <br>
        <p>
            <?php printf('<h3>For Support, Suggestions and Queries, please use the %s. <b>We are here for you!</b></h3>', '<a href="https://indithemes.com/contact-us/" target="_blank" rel="help">form here</a>');
            ?>
        </p>
        <p>
            <?php printf('Using IT Residence and loving it? Consider leaving it a %s review at %s. It really means a lot!', '<span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span>', '<a href="https://wordpress.org/themes/it-residence" rel="external" target="_blank">WordPress</a>');
            ?>
        </p>
    </div>
    <?php
}
