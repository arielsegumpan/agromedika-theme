<?php
// Query for related posts
$args = array(
    'post_type'      => 'post',
    'post_status'    => 'publish',
    'posts_per_page' => 6,
    'offset'         => 3, // Offset the query by 3 to get the related posts after the first 3 posts
);
$related_posts_query = new WP_Query($args);

if ($related_posts_query->have_posts()) : ?>
    <div id="featured_prod_aside" class="mb-5">
        <h5 class="fw-bold text-primary mb-4"><?php echo esc_html__('Related Posts', 'your-theme-text-domain'); ?></h5>
        <div class="row row-cols-3 row-cols-md-1 row-cols-lg-2 g-3">
            <?php while ($related_posts_query->have_posts()) : $related_posts_query->the_post(); ?>
                <div class="col">
                    <a href="<?php the_permalink(); ?>" class="text-decoration-none">
                        <img src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" alt="<?php the_title_attribute(); ?>" class="img-fluid object-fit-cover rounded-4">
                    </a>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
    <?php
endif;
// Restore global post data
wp_reset_postdata();
?>