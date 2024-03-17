<?php
/**
 * @package agromedika
 */

namespace AGROMEDIKA_THEME\Inc;

use AGROMEDIKA_THEME\Inc\Traits\Singleton;

class RecentProductPost {
    use Singleton;

    protected function __construct() {
        $this->setup_recent_post_hooks();
    }

    protected function setup_recent_post_hooks() {
        add_shortcode('agromedika_recent_product', [$this, 'agromedika_recent_products']);
        add_shortcode('agromedika_get_approve_doh_product', [$this, 'agromedika_get_approve_doh_products']);
    }

    // Create shortcode to get recent products displayed on the front page
    public function agromedika_recent_products() {
        $args = array(
            'post_type'      => 'herb',
            'post_status'    => 'publish',
            'posts_per_page' => 12,
        );
     
        $loop = new \WP_Query($args);

        if ($loop->have_posts()) :
            while ($loop->have_posts()) : $loop->the_post(); 
                $scientific_name = get_acf_field('herb_single_contents');
                if ($scientific_name['is_approved']['is_post_featured']) :
                    ?>
                    <div class="col text-center">
                        <a href="<?php the_permalink(); ?>" class="text-decoration-none">
                            <div class="card border-0 bg-transparent">
                                <div class="rounded-5 mx-auto">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <img src="<?php echo esc_url(get_the_post_thumbnail_url()) ?>" alt="<?php echo esc_attr(get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true)) ?>" class="rounded-5">
                                    <?php else:?>
                                        <img src="<?php echo esc_url($scientific_name['herbs_gallery'][0]['herb_image']['url']) ?>" alt="<?php echo esc_attr($scientific_name['herbs_gallery'][0]['herb_image']['alt']) ?>" class="rounded-5">
                                    <?php endif; ?>
                                </div>
                                <div class="prod-title text-center mt-4">
                                    <h5 class="text-primary fw-bold"><?php the_title(); ?></h5>
                                    <?php if (!empty($scientific_name['herb_scientific_name'])) : ?>
                                        <small class="text-secondary fst-italic">
                                            <?php echo esc_html('(' . $scientific_name['herb_scientific_name'] . ')'); ?>
                                        </small>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endif; ?>
            <?php endwhile;
            wp_reset_postdata();
        else : ?>
            <p class="text-center"><?php esc_html_e('No Recent Herb display', 'agromedika'); ?></p>
        <?php endif;
    }

    //Get herb doh approved
    public function agromedika_get_approve_doh_products() {
        $args = array(
            'post_type'      => 'herb',
            'post_status'    => 'publish',
            'posts_per_page' => 12,
        );
     
        $loop = new \WP_Query($args);

        if ($loop->have_posts()) :
            while ($loop->have_posts()) : $loop->the_post(); 
                $scientific_name = get_acf_field('herb_single_contents');
                if ($scientific_name['is_approved']['is_approved_by_the_doh']) :
                    ?>
                    <div class="col">
                        <a href="<?php the_permalink(); ?>" class="text-decoration-none">
                            <div class="card mb-3 border-0 bg-transparent">
                                <div class="row g-0 align-items-center">
                                    <div class="col-12 col-xl-4 text-center">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <img src="<?php echo esc_url(get_the_post_thumbnail_url()) ?>" alt="<?php echo esc_attr(get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true)) ?>" class="img-fluid rounded-4">
                                    <?php else:?>
                                        <img src="<?php echo esc_url($scientific_name['herbs_gallery'][0]['herb_image']['url']) ?>" alt="<?php echo esc_attr($scientific_name['herbs_gallery'][0]['herb_image']['alt']) ?>" class="img-fluid rounded-4">
                                    <?php endif; ?>
                                    </div>
                                    <div class="col-12 col-xl-8 text-center text-xl-start mt-3 mt-xl-0">
                                        <div class="card-body ps-2 pt-xl-4">
                                            <h6 class="fw-bold text-primary"><?php the_title(); ?></h6>
                                        <?php if (!empty($scientific_name['herb_scientific_name'])) : ?>
                                            <small class="text-secondary fst-italic">
                                                <?php echo esc_html('(' . $scientific_name['herb_scientific_name'] . ')'); ?>
                                            </small>
                                        <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endif; ?>
            <?php endwhile;
            wp_reset_postdata();
        else : ?>
            <p class="text-center"><?php esc_html_e('No herb-approved display.', 'agromedika'); ?></p>
        <?php endif;
    }
}