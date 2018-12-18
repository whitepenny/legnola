<?php
/*
Template Name: Home
*/

get_header();

if ( have_posts() ) :
  while ( have_posts() ) :
    the_post();
?>

<?php if(have_rows('slides')): ?>
<div class="slides-container">
    <div class="slides">
        
        <?php while(have_rows('slides')) : the_row(); ?>

            <?php $thumb = get_sub_field('image'); ?>    
        
            
            <div class="slide">
                <div class="slide-container" style="background-image: url('<?php echo $thumb['sizes']['sr-hero'] ?>')">
                    <div class="slide__content">
                        <h2><?php the_sub_field('heading'); ?></h2>
                        <?php the_sub_field('content'); ?>

                        <?php 
                            $link = get_sub_field('link');
                            $link = get_permalink($link->ID);
                         ?>

                        <a href="<?php echo $link; ?>" class="btn btn-secondary arrow-button"><b>View Project</b> <i class="icon arrow"></i></a>
                    </div>
                </div>
            </div>

        <?php endwhile; ?>
    

    </div>
</div>
<?php endif; ?>


<?php if(have_rows('home_intro')): ?>



<div class="content-section">
    
    <div class="content-section__container">
        <?php while(have_rows('home_intro')) : the_row(); ?>
            <?php $introImage = get_sub_field('home_intro_image'); ?>
        
        <div class="content-section__intro">
            <i class="icon flourish"></i>
            <?php the_sub_field('home_intro') ?>        
        </div>


        <div class="media">
            <div class="content-section__content">
                <?php the_sub_field('home_intro_content') ?>
            </div>

            <div class="content-section__image">
                <img src="<?php echo $introImage['url']; ?>" alt="">
            </div>
        </div>

        <?php endwhile; ?>
    </div>

</div>

<?php endif; ?>

<?php if(have_rows('home_image')): ?>
    <?php while(have_rows('home_image')) : the_row(); ?>
        <?php $image = get_sub_field('image'); ?>
    
    <div class="content-section content-section-image" style="background-image: url('<?php echo $image['url']; ?>');">
        
        <div class="content-section__container">

            <div class="media">
                <div class="content-section__content">
                    <?php the_sub_field('content'); ?>
                </div>

                
            </div>
           
        </div>

    </div>
    <?php endwhile; ?>
<?php endif; ?>

<?php if(have_rows('home_cta')): ?>
    <div class="content-section">
        
        <div class="content-section__container">
            <?php while(have_rows('home_cta')) : the_row(); ?>
                <?php $image = get_sub_field('image'); ?>


            <div class="media">
                <div class="content-section__content">
                    <?php the_sub_field('content') ?>
                </div>

                <div class="content-section__image">
                    <img src="<?php echo $image['url']; ?>" alt="">
                </div>
            </div>

            <div class="content-section__cta">
                <a href="<?php the_sub_field('url') ?>" class="btn btn-primary">Learn More</a>
            </div>

            <?php endwhile; ?>
        </div>

    </div>
<?php endif; ?>


<?php
$project_query = new WP_Query( array(
  'post_type' => 'project',
  'posts_per_page' => 6,
) ); ?>



<?php if($project_query->have_posts()): ?>
<div class="home-grid">

    <div class="wide">
        

        <h2 class="home-grid__heading">
            Recent Projects
        </h2>

        <div class="grid-previews">
            

                
                <?php while($project_query->have_posts()) : $project_query->the_post(); ?>
                <?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'sr-single-post' );?>
                
                    
                    <div class="grid-preview">
                            
                        <a class="grid-preview__container" href="<?php the_permalink(); ?>">
                        <div class="grid-preview__image">
                            
                            <img src="<?php echo $thumb['0']; ?>" alt="">
                            
                            <div class="grid-preview__content">
                            
                                <h2><?php the_title(); ?></h2>

                                <?php if (get_field('project_type')): ?>
                                <h3><?php the_field('project_type'); ?></h3>
                                <?php endif; ?>

                            </div>
                        </div>
                        </a>
                        
                    </div>
                <?php endwhile; ?>

                    

            

            

            <div class="grid-preview empty"></div>
            <div class="grid-preview empty"></div>
            <div class="grid-preview empty"></div>
            
        </div>
        
    </div>

</div>

<?php endif; ?>




<?php
  endwhile;
endif;

get_footer();
