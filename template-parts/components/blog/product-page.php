<?php

$args = [
    'post_type'      => 'product',
    'post_status'    => 'publish',
    'posts_per_page' => get_option('posts_per_page'),
];

$getProd = new WP_Query($args);

if ($getProd->have_posts()) : while ($getProd->have_posts()) : $getProd->the_post();
    $featured_image_url = get_the_post_thumbnail_url(get_the_ID());
    $featured_image_alt = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true);
?>
    <div class="col text-center">
        <a href="<?php echo esc_url(get_permalink()) ?>" class="text-decoration-none">
            <div class="position-relative">
                <img src="<?php echo esc_url($featured_image_url) ?>" alt="<?php echo esc_attr($featured_image_alt) ?>" class="rounded-4">
            </div>
            <div class="mt-4">
                <h4 class="text-primary fw-bold"><?php echo esc_html(the_title()) ?></h4>
            </div>
        </a>
    </div>
<?php endwhile;
endif;
wp_reset_postdata();
?>