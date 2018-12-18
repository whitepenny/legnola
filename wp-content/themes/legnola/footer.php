

<div class="footer__container">

    <div class="footer container">
        
      


        <div class="footer-group">

            
            <div class="footer-info">
                <ul>
                    <li>419 Euclid Ave, Haddonfield, NJ 08033</li>
                    <li>609.922.2769&nbsp;&nbsp;<a href="mailto:info@legnolabuilders.com">info@legnolabuilders.com</a></li>
                </ul>
            </div>
        
            <div class="footer-logo">
                
                <?php $footer_logo = get_field('footer_logo', 'options'); ?>
                <img src="<?php echo $footer_logo['url']; ?>" alt="">
                           
            </div>        

            <div class="footer-nav">
                <?php wp_nav_menu( array( 'theme_location' => 'footer-links', 'menu_id' => 'primary-menu' ) ); ?>
            </div>


        </div>
        

        <div class="footer-copyright">
            Copyright &copy; <?php echo the_time('Y'); ?>  <?php echo get_option( 'blogname' ); ?>. All Rights Reserved.
        </div>

        
    </div>

        

</div>



<?php wp_footer(); ?>
</div>
<div class="mobile-navigation" data-navigation-handle=".mobile_nav_handle" data-navigation-content=".nav_content">
    <?php wp_nav_menu( array( 'theme_location' => 'mobile-nav', 'menu_class' => 'mobile-nav', 'menu_id' => 'primary-menu' ) ); ?>

    <?php get_template_part( 'social-menu' ); ?>

</div>
</body>
</html>