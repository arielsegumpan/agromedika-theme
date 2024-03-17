<?php

$args = [
    'post_type'      => 'herb',
    'post_status'    => 'publish',
    'posts_per_page' => get_option('posts_per_page'),
];

$getProd = new WP_Query($args);

if ($getProd->have_posts()) : while ($getProd->have_posts()) : $getProd->the_post();
    $featured_image_url = get_the_post_thumbnail_url(get_the_ID());
    $featured_image_alt = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true);

    $herb_single_contents = get_acf_field('herb_single_contents');
?>
    <div class="col text-center">
        <a href="<?php echo esc_url(get_permalink()) ?>" class="text-decoration-none">
            <div class="card border-0 rounded-0 bg-transparent">
                <?php if(!empty($featured_image_url)) : ?>
                <div class="img-wrap position-relative mx-auto">
                    <img src="<?php echo esc_url($featured_image_url) ?>" alt="<?php echo esc_attr($featured_image_alt) ?>" class="rounded-5">
                </div>
                <?php endif;?>
                <div class="cont-prod mt-4 position-relative">
                    <h4 class="text-primary fw-bold"><?php echo esc_html(the_title()) ?></h4>
                    <?php if(!empty($herb_single_contents['herb_scientific_name'])) :?>
                    <h6 class="text-secondary"><small class="fst-italic" style="font-size: .98em;"><?php echo esc_html( $herb_single_contents['herb_scientific_name'] ) ?></small></h6>
                    <?php endif;?>
                </div>
            </div>
        </a> 
    </div>
<?php endwhile;
endif;
wp_reset_postdata();
?>