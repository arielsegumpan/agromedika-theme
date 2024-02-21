<?php
// Query for recent posts
$args = array(
    'post_type'      => 'post',
    'post_status'    => 'publish',
    'posts_per_page' => 4,
);
$recent_posts_query = new WP_Query($args);
if ($recent_posts_query->have_posts()) :
        $count = 0;
        while ($recent_posts_query->have_posts()) :
            $recent_posts_query->the_post();
            ?>
            <div class="col<?php echo ($count === 1) ? ' my-auto' : ''; ?>">
                <a href="<?php the_permalink(); ?>" class="text-decoration-none">
                    <?php if ($count === 1) : ?>
                        <h3 class="fw-bold text-black pt-lg-5 mt-lg-3 p-4"><?php the_title(); ?></h3>
                    <?php else : ?>
                        <img src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" class="rounded-5">
                    <?php endif; ?>
                </a>
            </div>
            <?php
            $count++;
        endwhile;
endif;
// Restore global post data
wp_reset_postdata();
?>
