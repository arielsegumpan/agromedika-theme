<?php
/**
 * Content Template
 * @package agromedika
 */
$featured_image_url = get_the_post_thumbnail_url(get_the_ID());
$featured_image_alt = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true);

?>

    <a href="<?php echo esc_url(get_permalink()) ?>" class="text-decoration-none">
        <div class="card border-0 p-0 mb-4 mb-lg-5">
            <?php if($featured_image_url) :?>
            <div class="card-header border-0 p-0 rounded-5">
                
                <?php
                    $featured_image_html = get_the_post_thumbnail(null, 'blog-img-size', array('class' => 'rounded-5'));

                    if (!empty($featured_image_html)) { // Check if the featured image HTML exists
                        echo wp_kses_post($featured_image_html); // Sanitize and output the featured image HTML
                    }
                    ?>
            </div>
            <?php endif ?>
            <div class="card-body">
                <div class="title mt-4 mt-lg-0">
                    <h5 class="fw-bold text-primary"><?php echo esc_html(get_the_title()) ?></h5>
                    <div class="mt-4">
                        <small class="text-secondary"><i class="bi bi-calendar4-week text-primary border rounded-2 px-2 border-primary p-1 me-2"></i><?php echo get_the_date('j/ n/ Y') ?></small>
                    </div>
                </div>
            </div>
        </div>
    </a>