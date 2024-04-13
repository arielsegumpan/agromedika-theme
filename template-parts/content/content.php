<?php
/**
 * Content Template
 * @package agromedika
 */
$featured_image_url = get_the_post_thumbnail_url(get_the_ID());
$featured_image_alt = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true);
$herb_single_contents = get_acf_field('herb_single_contents');
$opening_position = get_acf_field('opening_position');
?>

    <a href="<?php echo esc_url(get_permalink()) ?>" class="text-decoration-none">
        <div class="card border-0 p-0 mb-4 mb-lg-5 bg-transparent">
            <?php if($featured_image_url) :?>
            <div class="card-header border-0 p-0 rounded-5 ">
            <?php $featured_image_id = get_post_thumbnail_id();
                echo html_entity_decode(esc_html(wp_get_attachment_image($featured_image_id, 'blog_img_size', false, array('class' => 'rounded-5'))));
            ?>
            </div>

            <?php else:?>
                <div class="card-header border-0 p-0 rounded-5 ">
                <?php
                    $single_content_id =  $herb_single_contents['herbs_gallery'][0]['herb_image']['id'];
                    echo wp_get_attachment_image($single_content_id, 'product_img', false, array('class' => 'rounded-5'));?>
                 </div>
            <?php endif ?>
            <div class="card-body">
                <div class="title mt-4 mt-lg-0">
                    <?php if (!empty($opening_position)): ?>
                        <div class="mt-1 text-secondary">
                            <small><i class="bi bi-briefcase me-2"></i> <?php echo esc_html($opening_position); ?></small>
                        </div>
                    <?php endif; ?>
                    <h5 class="fw-bold text-primary"><?php echo esc_html(get_the_title()) ?></h5>
                    <?php if(!empty($herb_single_contents['herb_scientific_name'])) :?>
                        <h6 class="text-secondary"><small class="fst-italic" style="font-size: .98em;"><?php echo esc_html( $herb_single_contents['herb_scientific_name'] ) ?></small></h6>
                    <?php else:?>
                    <div class="mt-4">
                        <small class="text-secondary"><i class="bi bi-calendar4-week text-primary border rounded-2 px-2 border-primary p-1 me-2"></i><?php echo get_the_date('j/ n/ Y') ?></small>
                    </div>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </a>