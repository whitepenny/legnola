<?php get_header(); ?>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        
    <?php get_template_part( 'layouts/project' ); ?>

    <?php endwhile; ?>
    <?php endif; ?>

<?php get_footer(); ?>