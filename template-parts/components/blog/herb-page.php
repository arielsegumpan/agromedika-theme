<?php

$args = [
    'post_type'      => 'herb',
    'post_status'    => 'publish',
    'posts_per_page' => 12,
    'paged'          => get_query_var('paged') ? get_query_var('paged') : 1
];
 
$getProd = new WP_Query($args);
?>
<div class="row">
    <div class="col-12">
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4 g-lg-5">

        <?php
        if ($getProd->have_posts()) : while ($getProd->have_posts()) : $getProd->the_post();
            $herb_single_contents = get_acf_field('herb_single_contents');?>
            <div class="col text-center">
                <a href="<?php echo esc_url(get_permalink()) ?>" class="text-decoration-none">
                    <div class="card border-0 rounded-0 bg-transparent">
                        <?php if(has_post_thumbnail() || !empty($herb_single_contents['herbs_gallery'][0]['herb_image']['url']) ) : ?>
                        <div class="img-wrap position-relative mx-auto"> 
                        <?php if (has_post_thumbnail()) : ?>
                            <?php
                                $thumbnail_id = get_post_thumbnail_id();
                                $thumbnail_alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
                                echo get_the_post_thumbnail($thumbnail_id, 'product_img', array('class' => 'rounded-5', 'alt' => $thumbnail_alt));
                            ?>
                        <?php else:?>
                            <?php
                                $single_content_id =  $herb_single_contents['herbs_gallery'][0]['herb_image']['id'];
                                echo wp_get_attachment_image($single_content_id, 'product_img', false, array('class' => 'rounded-5'));?>
                        <?php endif; ?>
                        
                        </div> 
                        <?php endif;?>
                        <div class="cont-prod mt-4 position-relative">
                            <h5 class="text-primary fw-bold"><?php echo esc_html(the_title()) ?></h5>
                            <?php if(!empty($herb_single_contents['herb_scientific_name'])) :?>
                            <h6 class="text-secondary"><small class="fst-italic" style="font-size: .98em;"><?php echo esc_html( $herb_single_contents['herb_scientific_name'] ) ?></small></h6>
                            <?php endif;?>
                        </div>
                    </div>
                </a> 
            </div>
        <?php endwhile;?>
        </div>
    </div>
</div>

<?php if ($getProd->max_num_pages > 1) : ?>
    
    <div class="col-12 mx-auto text-center mt-5 pt-lg-5">
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center pagination-lg">
                <?php
                echo '<li class="page-item ' . ($getProd->current_page == 1 ? 'disabled' : '') . '">';
                echo html_entity_decode(esc_html(get_previous_posts_link('<span class="page-link text-primary"><i class="bi bi-arrow-left me-2"></i> Previous</span>')));
                echo '</li>';

                $total_pages = $getProd->max_num_pages;

                for ($i = 1; $i <= $total_pages; $i++) {
                    echo '<li class="page-item text ' . ($getProd->current_page == $i ? 'active' : '') . '" ' . ($getProd->current_page == $i ? 'aria-current="page"' : '') . '>';
                    echo '<a class="page-link text-primary" href="' . esc_url(get_pagenum_link($i)) . '">' . esc_html($i) . '</a>';
                    echo '</li>';
                }

                echo '<li class="page-item' . ($getProd->current_page == $total_pages ? ' disabled' : '') . '">';
                echo html_entity_decode(esc_html(get_next_posts_link('<span class="page-link text-primary">Next <i class="bi bi-arrow-right ms-2"></i></span>', $getProd->max_num_pages)));
                echo '</li>';
                ?>
            </ul>
        </nav>
    </div>

    <?php endif;
endif;
wp_reset_postdata();
?>