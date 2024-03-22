<?php
$args = [
    'post_type'      => 'post',
    'post_status'    => 'publish',
    'posts_per_page' => 6
];
                                    
$getPost = new WP_Query($args);

if ($getPost->have_posts()) :
    while ($getPost->have_posts()) : 
        $getPost->the_post();
    ;?>
    <div class="col">
        <a href="<?php echo esc_url(get_permalink()); ?>" class="text-decoration-none">
            <?php if (has_post_thumbnail()) : ?>
                <?php $recent_thumb = get_post_thumbnail_id();
                    echo html_entity_decode(esc_html(wp_get_attachment_image($recent_thumb, 'recent_thumbnails', false, array('class' => 'img-fluid object-fit-cover rounded-4'))));
                ?>
            <?php endif; ?>
        </a>
    </div>
<?php endwhile; ?>
<?php wp_reset_postdata(); ?>
<?php endif; ?>
