<?php
/**
 * Template Name: Pharmaceuticals
 * @package agromedika
 */

 get_header();

 $pharmaceutical_content = get_acf_field('pharmaceutical_content');
?>

<?php if(have_posts()) : while(have_posts()) : the_post();?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <?php the_content(); ?>
        </div>
    </div>
</div>

<?php endwhile; endif; ?>





<?php get_footer(); ?>