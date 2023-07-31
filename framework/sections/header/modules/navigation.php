<?php
/**
 *  Header Navigation
 */
 ?>

 <nav id="site-navigation" class="main-navigation" aria-label="<?php esc_attr_e(wp_get_nav_menu_name('menu-1')); ?>">
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
