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
    }

    public function agromedika_recent_products() {
        $args = array( 
            'post_type'      => 'herb',
            'post_status'    => 'publish',
            'posts_per_page' => 12,
            'meta_query' => array(
                array(
                    'key'   => 'herb_single_contents_is_approved_is_post_featured',
                    'value' => '1',
                )
            )
        );
     
        $loop = new \WP_Query($args);
        
        if ($loop->have_posts()) :
            while ($loop->have_posts()) : $loop->the_post();
            $herb_single_contents = get_acf_field('herb_single_contents');

            ?>
                <div class="col text-center">
                        <a href="<?php the_permalink(); ?>" class="text-decoration-none">
                            <div class="card border-0 bg-transparent">
                                <div class="rounded-5 mx-auto">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php $featured_image_id = get_post_thumbnail_id();
                                        echo html_entity_decode(esc_html(wp_get_attachment_image($featured_image_id, 'product_img', false, array('class' => 'rounded-5'))));
                                    ?>
                                <?php else:?>
                                    <?php
                                        $prod_hm_id =  $herb_single_contents['herbs_gallery'][0]['herb_image']['id'];
                                        echo html_entity_decode(esc_html(
                                        wp_get_attachment_image($prod_hm_id, 'product_img', false, array('class' => 'd-block w-100'))
                                    ));?>
                                <?php endif; ?>
                                </div>
                                <div class="prod-title text-center mt-4">
                                    <h6 class="text-primary"><?php the_title();?></h6>
                                <?php if (!empty($herb_single_contents['herb_scientific_name'])) : ?>
                                    <small class="text-secondary fst-italic">
                                        <?php echo esc_html('(' . $herb_single_contents['herb_scientific_name'] . ')'); ?>
                                    </small>
                                <?php endif; ?>
                                </div>
                            </div>
                        </a>
                    </div>
            <?php endwhile;
            wp_reset_postdata();
        else : ?>
            <p class="text-center"><?php esc_html_e('No Recent Herb display', 'agromedika'); ?></p>
        <?php endif;
    }
}