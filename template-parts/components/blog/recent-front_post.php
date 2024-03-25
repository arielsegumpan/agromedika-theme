<?php
// Query for recent posts
$args = array(
    'post_type'      => 'post',
    'post_status'    => 'publish',
    'posts_per_page' => 3,
);
$recent_posts_query = new WP_Query($args);
if ($recent_posts_query->have_posts()) :
        while ($recent_posts_query->have_posts()) :
            $recent_posts_query->the_post();
            ?>
            <div class="col">
                <a href="<?php the_permalink(); ?>" class="text-decoration-none">
                <div class="card border-0 p-0 mb-4 mb-lg-0">
                    <div class="card-header border-0 p-0 rounded-4">
                        <?php $featured_image_id = get_post_thumbnail_id();
                        echo html_entity_decode(esc_html(wp_get_attachment_image($featured_image_id, 'news_update_img', false, array('class' => 'img-fluid rounded-4'))));
                        ?>
                    </div>
                    <div class="card-body">
                    <div class="title mt-2 mt-lg-2">
                        <h5 class="fw-bold text-primary"><?php the_title(); ?></h5>
                        <div class="mt-4">
                        <small class="text-secondary"><i class="bi bi-calendar4-week text-primary border rounded-2 px-2 border-primary p-1 me-2"></i><?php echo get_the_date('F j, Y'); ?></small>
                        </div>
                    </div>
                    </div>
                </div>
                </a>
            </div>
            <?php
        endwhile;
endif;
wp_reset_postdata();
?>
