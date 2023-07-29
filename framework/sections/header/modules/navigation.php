<?php
/**
 *  Header Navigation
 */
 ?>

 <nav id="site-navigation" class="main-navigation" aria-label="<?php esc_attr_e(wp_get_nav_menu_name('menu-1')); ?>">
     <button class="menu-toggle"><?php esc_html_e( 'Primary Menu', 'it-residence' ); ?></button>
     <?php
     wp_nav_menu(
         array(
             'theme_location' => 'menu-1',
             'menu_id'        => 'primary-menu',
             'container'      => 'ul'
         )
     );
     ?>
 </nav><!-- #site-navigation -->
