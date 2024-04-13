<?php
$args = [
    'post_type'      => 'career',
    'post_status'    => 'publish',
    'posts_per_page' => 5
];
                                    
$getPost = new WP_Query($args);

if ($getPost->have_posts()) :
    while ($getPost->have_posts()) : 
        $getPost->the_post();
    ;?>
    <div class="col-12 mb-3">
        <a href="<?php echo esc_url(get_permalink()); ?>" class="text-decoration-none">
            <div class="card border-0 bg-transparent">
                <div class="card-header border-0 bg-transparent px-0">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php $recent_thumb = get_post_thumbnail_id();
                            echo html_entity_decode(esc_html(wp_get_attachment_image($recent_thumb, 'recent_thumbnails', false, array('class' => 'img-fluid object-fit-cover rounded-4'))));
                        ?>
                    <?php endif; ?>
                
                </div>
                <div class="card-body px-0">
                    <h6 class="fw-bold text-primary"><?php echo get_the_title();?></h6>
                </div>
            </div>
        </a>
    </div>
<?php endwhile; ?>
<?php wp_reset_postdata(); ?>
<?php endif; ?>
