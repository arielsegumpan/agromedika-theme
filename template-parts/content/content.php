<?php
/**
 * Content Template
 * @package agromedika
 */
$featured_image_url = get_the_post_thumbnail_url(get_the_ID());
$featured_image_alt = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true);

?>
    <div class="card border-0 p-0 mb-4 mb-lg-5">
        <?php if($featured_image_url) :?>
        <div class="card-header border-0 p-0">
            <a href="<?php echo esc_url(get_permalink()) ?>" class="text-decoration-none">
                <img src="<?php echo esc_url($featured_image_url) ?>" alt="<?php echo esc_attr($featured_image_alt) ?>" class="img-fluid rounded-4">
            </a>
        </div>
        <?php endif ?>
        <div class="card-body px-3 px-lg-5">
            <div class="d-flex flex-column flex-lg-row align-items-lg-start align-items-lg-center mt-3">
                <div class="attributes">
                    <div class="d-flex flex-column gap-3 align-items-start">
                        <div>
                            <small class="text-secondary"><i class="bi bi-stopwatch text-primary border rounded-2 px-2 border-primary p-1 me-2"></i><?php echo get_the_date('j/ n/ Y') ?></small>
                        </div>
                        <div>
                        <?php get_template_part('template-parts/components/blog/comment','count')?>
                        </div>             
                    </div>
                </div>
                <div class="title ps-lg-4 mt-4 mt-lg-0">
                    <a href="<?php echo esc_url(get_permalink()) ?>" class="text-decoration-none">
                        <h3 class="fw-bold text-primary"> <?php echo esc_html(get_the_title()) ?></h3>
                    </a>
                    <?php if(shortcode_exists('post_categories')) :?>
                    <div class="d-flex flex-row justify-content-start gap-3">
                        <?php echo do_shortcode('[post_categories]') ?>
                    </div>
                    <?php endif ?>
                </div>
            </div>
            <div class="content mt-4 mt-lg-5">
                <p class="lh-lg text-secondary">
                    <?php echo wp_trim_words(get_the_excerpt(),20); ?>
                </p>
            </div>
        </div>
    </div>