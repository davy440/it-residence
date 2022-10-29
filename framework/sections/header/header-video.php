<?php
/**
 *  Video Header
 */
 ?>

 <header id="masthead" class="site-header video">

    <?php itre_get_top_bar(); ?>

    <div id="header-video">

        <?php itre_hero_area(); ?>

        <?php
        $video_url = get_theme_mod('itre_header_video_url', '');
        ?>
        <div data-vbg="<?php echo esc_url( $video_url ); ?>"></div>
    </div>

 </header><!-- #masthead -->
