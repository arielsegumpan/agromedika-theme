<?php
/**
 * @package agromedika
 */

namespace AGROMEDIKA_THEME\Inc;

use AGROMEDIKA_THEME\Inc\Traits\Singleton;

class Recentproductpost {
    use Singleton;

    protected function __construct() {
        $this->setup_recent_post_hooks();
    }

    protected function setup_recent_post_hooks() {
        add_shortcode('agromedika_recent_product', [$this, 'agromedika_recent_products']);
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
                ?>

                <div class="col">
                 <a href="<?php echo esc_url(get_the_permalink()) ?>" class="text-decoration-none">
                  <div class="card border-0 bg-transparent">
                    <div class="rounded-5">
                      <img src="<?php echo esc_url(get_the_post_thumbnail_url()) ?>" alt="<?php echo esc_attr(get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true)) ?>" class="rounded-5">
                    </div>
                    <div class="prod-title text-center mt-4">
                      <h6 class="text-primary"><?php the_title()?></h6>
                        <?php if ($scientific_name['herb_scientific_name']) : ?>
                            <small class="text-secondary">
                                <?php echo esc_html('(' . $scientific_name['herb_scientific_name'] . ')'); ?>
                            </small>
                        <?php endif; ?>

                    </div>
                  </div>
                 </a>
                </div>
    
                <?php endwhile;
        else :
            ?>
            <p class="text-center"><?php esc_html_e('No Recent Herb display', 'agromedika'); ?></p>
        <?php
        endif;
        wp_reset_postdata();
        
    }
    
}
