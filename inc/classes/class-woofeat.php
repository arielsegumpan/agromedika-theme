<?php
/**
 * woofeature
 * @package agromedika
 */
namespace AGROMEDIKA_THEME\Inc;
use AGROMEDIKA_THEME\Inc\Traits\Singleton;

class Woofeat {
    use Singleton;
    
    protected function __construct() {
        $this->setup_hooks();
    }
    protected function setup_hooks() {
        // Add shortcode registration
        add_shortcode('custom_featured_products', [$this,'custom_get_featured_products_shortcode']);
        // add_action('woocommerce_after_shop_loop_item', [$this,'custom_add_buttons_to_product_loop'], 5);
        add_filter('loop_shop_columns',[$this,'custom_woocommerce_loop_columns']);
        add_filter('loop_shop_per_page', [$this,'custom_woocommerce_products_per_page']);
        add_shortcode('agromedika_product_categories', [$this,'agromedika_categories_shortcode']);
        add_filter('woocommerce_output_related_products_args', [$this,'custom_related_products_args']);
        add_action('woocommerce_after_shop_loop', [$this,'custom_woocommerce_pagination']);
        // remove product meta single product page
        remove_action( 'woocommerce_single_product_summary', [$this, 'woocommerce_template_single_meta'], 40 );
    }

    function custom_get_featured_products_shortcode() {
        // Query WooCommerce for 4 featured products
        $featured_products = wc_get_products(array(
            'limit' => 4,
            'status' => 'publish',
            'visibility' => 'catalog',
            'featured' => true,
        ));
        // Initialize output
        $output = '';
        if (!empty($featured_products)):
            foreach ($featured_products as $product) :
                $product_link = esc_url(get_permalink($product->get_id()));
                $product_image = esc_url(wp_get_attachment_image_url($product->get_image_id(), 'large'));
                $product_name = esc_attr($product->get_name());
    
                $output .= '<div class="col">
                                <div class="position-relative">
                                    <a href="' . $product_link . '" class="text-decoration-none position-relative">
                                        <span class="position-absolute badge mt-3 ms-3 rounded-3 bg-primary px-2 text-white small">
                                            ' . esc_html__('Featured', 'agromedika') . '
                                        </span>
                                        <img src="' . $product_image . '" alt="' . $product_name . '" class="img-fluid object-fit-cover rounded-5">
                                    </a>
                                </div>
                            </div>';
            endforeach;
        else:
            $output .= '<p class="fw-bold display-5">' . esc_html__('No featured products found.', 'agromedika') . '</p>';
        endif;
        return $output;
    }
    // custom Product button woocomemrce
    function custom_add_buttons_to_product_loop() {
        $product_permalink = esc_url(get_permalink());
        $contact_url = esc_url(site_url('/contact'));
        $view_button_text = esc_html__('View', 'agromedika');
        $inquiry_button_text = esc_html__('Inquiry', 'agromedika');
    
        echo '<div id="product_btn" class="vstack gap-3 col-md-5 mx-auto w-100 mt-4 px-4">
            <a href="' . $product_permalink . '" class="btn btn-outline-primary py-3 fs-6"><i class="bi bi-eye me-2"></i>' . $view_button_text . '</a>
            <a href="' . $contact_url . '" class="btn btn-primary py-3 fs-6"><i class="bi bi-info-circle me-2"></i>' . $inquiry_button_text . '</a>
        </div>';
    }
    // Customize the number of products per row
    function custom_woocommerce_loop_columns() {
        return 4; // Change this number to adjust the number of products per row
    }
  
    // Customize the number of products per page
    function custom_woocommerce_products_per_page() {
        return 8; // Change this number to adjust the number of products per page
    }

    // get all product categories
    function agromedika_categories_shortcode() {
      // Get WooCommerce categories
    $woocommerce_categories = get_terms(array(
            'taxonomy' => 'product_cat',
            'hide_empty' => true,
        ));
        // Generate output
        $output = '<div class="d-flex flex-wrap flex-row text-center g-5 text-md-start mt-4 align-items-start">';
        foreach ($woocommerce_categories as $category) {
            $output .= '<a class="text-decoration-none  mb-2" href="' . esc_url(get_term_link($category)) . '"><span class="badge text-bg-green rounded-2 text-small px-3 me-2">
            ' . esc_html($category->name) . '</span></a>';
        }
        $output .= ' </div>';

        return $output;
    }
    // display 3 related product
    function custom_related_products_args($args) {
        $args['posts_per_page'] = 3; // Number of related products to display
        $args['columns'] = 3; // Number of columns for related products (optional)
        return $args;
    }
    function custom_woocommerce_pagination() {
        global $wp_query;
    
        $prev_link = get_previous_posts_link('<i class="bi bi-arrow-left me-2"></i>' . esc_html__('Previous', 'agromedika'));
        $next_link = get_next_posts_link(esc_html__('Next', 'agromedika') . '<i class="bi bi-arrow-right ms-2"></i>', $wp_query->max_num_pages);
    
        if ($prev_link || $next_link) {
            echo '<div class="woocommerce-pagination">
            <div class="d-grid gap-2 d-md-flex justify-content-center text-center">
            ';
            if ($prev_link) {
                echo '<div class="pagination-button">' . wp_kses_post(str_replace('href', 'class="btn btn-primary px-5 text-lteal rounded-4 py-3 me-md-3" href', $prev_link)) . '</div>';
            }
            if ($next_link) {
                echo '<div class="pagination-button">' . wp_kses_post(str_replace('href', 'class="btn btn-primary px-5 text-lteal rounded-4 py-3" href', $next_link)) . '</div>';
            }
            echo '</div></div>';
        }
    }
    
}
