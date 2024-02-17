<?php
$args = array(
    'post_type'      => 'post',
    'post_status'    => 'publish',
    'posts_per_page' => 4,
);
$recent_posts = get_posts($args);

if ($recent_posts) : foreach ($recent_posts as $post) : setup_postdata($post); ?>
    <div class="col">
        <a href="<?php echo esc_url(get_the_permalink()); ?>" class="text-decoration-none">
            <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID())); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" class="rounded-5">
        </a>
    </div>
<?php endforeach;
endif;
wp_reset_postdata(); ?>
