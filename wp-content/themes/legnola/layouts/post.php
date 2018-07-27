<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'sr-hero' );?>

<div class="wrapper default-page">
    <div class="container">
        <div class="single-post__content">
                
                <h1 class="single-post__heading"><?php the_title(); ?></h1>
                
                <?php if($thumb): ?>
                <div class="single-post__image">
                    <img src="<?php echo $thumb['0'] ?>" alt="" />

                    <p><?php echo get_the_post_thumbnail_caption( $post->ID ); ?></p>
                </div>
                <?php endif; ?>

                <?php if(get_field('page_intro')): ?>
                <div class="single-post__intro cms">
                    <?php the_field('page_intro'); ?>    
                </div>
                <?php endif; ?>
                
                <div class="single-post__body cms">
                <?php the_content(); ?>
                </div>

        </div>

    </div>
</div>