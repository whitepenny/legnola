<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'sr-hero' );?>

<div class="wrapper default-page">
    <div class="container">
        <div class="single-post__content">
                
                
                
                <?php if($thumb): ?>
                <div class="single-post__image">
                    <img src="<?php echo $thumb['0'] ?>" alt="" />

                    <p><?php echo get_the_post_thumbnail_caption( $post->ID ); ?></p>
                </div>
                <?php endif; ?>

                <h1 class="single-post__heading"><?php the_title(); ?></h1>
                
                <div class="project-content cms">
                
                    <div class="project-intro">
                    <?php the_content(); ?>
                    </div>

                    <?php if(have_rows('photos')): ?>
                    <div class="project-photos">
                        <?php while(have_rows('photos')) : the_row(); ?>
                            <?php $photo = get_sub_field('photo'); ?>
                            <div class="project-photo">
                                <img src="<?php echo $photo['sizes']['sr-hero']; ?>" alt="">
                            </div>

                        <?php endwhile; ?>                            
                        <?php endif; ?>
                    </div>
                    <?php if(have_rows('testimonial')): ?>
                    <div class="project-testimonial">
                        
                        <?php while(have_rows('testimonial')) : the_row(); ?>
                            
                            <div class="project-testimonial__quote">
                                <i class="icon flourish"></i>
                            <?php the_sub_field('quote'); ?>
                            </div>

                            <div class="project-testimonial__cite"><?php the_sub_field('cite'); ?></div>
                        <?php endwhile; ?>

                    </div>
                    <?php endif; ?>

                    <div class="project-features">
                        
                    
                    <?php if(have_rows('features')) : while(have_rows('features')) : the_row(); ?>

                        <?php $featureThumb = get_sub_field('image'); ?>

                        <div class="project-feature">
                            <div class="project-feature__image">
                                <img src="<?php echo $featureThumb['url']; ?>" alt="">
                            </div>

                            <div class="project-feature__content">
                                <?php the_sub_field('content'); ?>
                            </div>
                        </div>
                        

                    <?php endwhile; ?>
                    <?php endif; ?>

                    </div>

                </div>

        </div>

    </div>
</div>