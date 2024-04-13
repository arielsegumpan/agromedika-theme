<?php 
$args = [
    'post_type'      => 'career',
    'post_status'    => 'publish',
    'posts_per_page' => 16,
    'paged'          => get_query_var('paged') ? get_query_var('paged') : 1
];

$getCareer = new WP_Query($args);
?>

<div class="row">
    <div class="col-12">
        <div class="row row-cols-1 row-cols-md-2  row-cols-lg-3 g-3 g-lg-5">

            <?php if ($getCareer->have_posts()) : while ($getCareer->have_posts()) : $getCareer->the_post();
                $opening_position = get_acf_field('opening_position');?>
                <div class="col">
                    <a href="<?php echo esc_url(get_permalink()) ?>" class="text-decoration-none">
                        <div class="card border-0 p-0 mb-4 mb-lg-5 bg-transparent">
                            <?php if (has_post_thumbnail() || !empty($career_featured_image['url'])) : ?>
                                <div class="card-header border-0 p-0 rounded-5 ">
                                    <?php if (has_post_thumbnail()) :
                                        the_post_thumbnail('product_img', ['class' => 'rounded-5']);?>
                                   <?php endif; ?>
                                </div>
                            <?php endif; ?>
                            <div class="card-body">
                                <div class="title mt-4 mt-lg-0">
                                <?php if(!empty($opening_position)):?>
                                    <div class="mt-1 text-secondary">
                                        <small><i class="bi bi-briefcase me-2"></i> <?php echo esc_html($opening_position);?></small>
                                    </div>
                                <?php endif;?>
                                    <h5 class="fw-bold text-primary"><?php echo esc_html(get_the_title()) ?></h5>
                                    <div class="mt-4">
                                        <small class="text-secondary"><i class="bi bi-calendar4-week text-primary border rounded-2 px-2 border-primary p-1 me-2"></i><?php echo get_the_date('j/ n/ Y') ?></small>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endwhile; else: ?> <!-- Added else statement -->
                <div class="col-12 col-lg-8 mx-auto text-center">
                    <i class="bi bi-briefcase mb-4 fs-1 text-primary"></i>
                    <h2 class="mb-5"><?php echo esc_html__( 'Opps! Keep an eye out for future career opportunities', 'agromedika' );?></h2>
                    <a href="<?php echo esc_url(site_url('/')) ;?>" class="btn btn-primary px-5 py-4 text-lteal rounded-4"><i class="bi bi-arrow-left me-2"></i><?php echo esc_html('Back to main page') ?></a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php if ($getCareer->max_num_pages > 1) : ?>
    <div class="col-12 mx-auto text-center mt-5 pt-lg-5">
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <?php
                echo '<li class="page-item ' . ($getCareer->current_page == 1 ? 'disabled' : '') . '">';
                echo html_entity_decode(esc_html(get_previous_posts_link('<span class="page-link text-primary"><i class="bi bi-arrow-left me-2"></i> Previous</span>')));
                echo '</li>';

                $total_pages = $getCareer->max_num_pages;

                for ($i = 1; $i <= $total_pages; $i++) {
                    echo '<li class="page-item text ' . ($getCareer->current_page == $i ? 'active' : '') . '" ' . ($getCareer->current_page == $i ? 'aria-current="page"' : '') . '>';
                    echo '<a class="page-link text-primary" href="' . esc_url(get_pagenum_link($i)) . '">' . esc_html($i) . '</a>';
                    echo '</li>';
                }

                echo '<li class="page-item' . ($getCareer->current_page == $total_pages ? ' disabled' : '') . '">';
                echo html_entity_decode(esc_html(get_next_posts_link('<span class="page-link text-primary">Next <i class="bi bi-arrow-right ms-2"></i></span>', $getCareer->max_num_pages)));
                echo '</li>';
                ?>
            </ul>
        </nav>
    </div>
<?php endif; ?>

<?php wp_reset_postdata(); ?>
