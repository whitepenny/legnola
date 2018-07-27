<!doctype html>

<html <?php language_attributes(); ?> class="no-js">

    <head>
        <meta charset="utf-8">

        <?php // force Internet Explorer to use the latest rendering engine available ?>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title><?php wp_title(''); ?></title>

        <meta name="MobileOptimized" content="320">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
        
        <link rel="stylesheet" href="https://use.typekit.net/yly1lis.css">

        <?php // wordpress head functions ?>
        <?php wp_head(); ?>
        <?php // end of wordpress head ?>

    </head>

    <body <?php echo body_class(); ?>>

    <div class="searchbar">
        <div class="search-container">
        <?php get_search_form(); ?>
        </div>
    </div>

    <div class="page-wrapper nav_content">
    
    <div class="header__container">
        <div class="header">
            
            <div class="header-logo">
                <?php 
                $custom_logo_id = get_theme_mod( 'custom_logo' );
                $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' ); ?>
                
                <a href="/">
                <img src="<?php echo $logo['0']; ?>" alt="">
                </a>
            </div>


            <div class="toolbar__container">
                <div class="toolbar">
                    <div class="tagline">
                        Established 1971
                    </div>

                    <nav id="site-navigation" class="main-navigation">
                                    <?php wp_nav_menu( array( 'theme_location' => 'main-nav', 'menu_id' => 'primary-menu' ) ); ?>
                    </nav>


                    <div class="header-social">
                        Connect <?php get_template_part( 'social-menu' ); ?>
                    </div>

                </div>
            </div>

            

            <div class="mobile-nav-trigger mobile_nav_handle">
                <i class="fa fa-lg fa-bars"></i>
            </div>


        </div>
    </div>


        