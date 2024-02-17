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
            'post_type'      => 'product',
            'post_status'    => 'publish',
            'stock'          => 1,
            'posts_per_page' => 4,
        );
    
        $loop = new \WP_Query($args);
        ob_start();
    
        if ($loop->have_posts()) :
            while ($loop->have_posts()) : $loop->the_post();
                ?>
                <div class="col">
                 <a href="<?php echo esc_url(get_the_permalink()) ?>" class="text-decoration-none">
                    <?php
                        if (has_post_thumbnail()) {
                            the_post_thumbnail('shop_catalog', array('class' => 'rounded-5'));
                        } else {
                            echo '<img src="' . esc_url(woocommerce_placeholder_img_src()) . '" alt="' . esc_attr(get_the_title()) . '" class="rounded-5"/>';
                        }
                    ?>
                 </a>
                </div>
    
                <?php endwhile;
        else :
            ?>
            <p class="text-center"><?php esc_html_e('No Recent Product display', 'agromedika'); ?></p>
        <?php
        endif;
        wp_reset_postdata();
        return ob_get_clean();
    }
    
}
