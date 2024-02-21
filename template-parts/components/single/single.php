<?php
/**
 * @package agromedika
 */
?>
<div class="attributes mb-5">
    <div class="d-flex flex-column flex-lg-row gap-3 align-items-start">
        <div>
            <small class="text-secondary"><i class="bi bi-stopwatch text-primary border rounded-2 px-2 border-primary p-1 me-2"></i><?php echo get_the_date('j/ n/ Y') ?></small>
        </div>
        <div>
            <?php get_template_part('template-parts/components/blog/comment','count')?>
        </div>             
    </div>
</div>
<!-- content -->
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="content text-secondary mb-5 lh-lg">
<?php the_content() ?>
</div> 
<?php endwhile; endif; ?>

