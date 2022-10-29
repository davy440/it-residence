<?php
/**
 *  Header Navigation
 */
 ?>

 <nav id="site-navigation" class="main-navigation">
     <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'it-residence' ); ?></button>
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
