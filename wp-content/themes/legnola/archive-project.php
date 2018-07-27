<?php get_header(); ?>

  

  
<div class="wrapper default-page">
    <div class="container">

        <?php get_template_part( 'layouts/page_header', 'cpt' ); ?>

        
        <div class="grid-previews">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                
                
                <?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'sr-bucket' );?>
                
                    
                    <div class="grid-preview">
                            
                        <a class="grid-preview__container" href="<?php the_permalink(); ?>">
                        <div class="grid-preview__image">
                            
                            <img src="<?php echo $thumb['0']; ?>" alt="">
                            
                            <div class="grid-preview__content">
                            
                                <h2><?php the_title(); ?></h2>

                            </div>
                        </div>
                        </a>
                        
                    </div>

                    

            <?php endwhile; ?>
                


            <?php else : ?>

                    No Posts

            <?php endif; ?>

            <div class="grid-preview empty"></div>
            <div class="grid-preview empty"></div>
            <div class="grid-preview empty"></div>
            <?php 
            echo '<div class="pagination">';
            echo paginate_links(array(
                'type' => 'list',
                'prev_text' => '',
                'next_text' => '',
            ));
            echo '</div>';
            ?>        
        </div>
        
    </div>
</div>

    




<?php get_footer(); ?>
