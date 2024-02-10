<?php
/**
 * Bootstrap the theme
 * @package agromedika
 * 
 */

 namespace AGROMEDIKA_THEME\Inc;

use AGROMEDIKA_THEME\Inc\Traits\Singleton;

 class AGROMEDIKA_THEME{
    use Singleton;
    protected function __construct() {
        // Define an array of classes to initialize
        $classes = [
            Restriction::class,
            Namespacecpt::class,
            Menus::class,
            Assets::class,
            AGROMEDIKACPT::class,
            Careercat::class,
            Shortcodes::class,
            Woofeat::class,
            Recentpost::class,
            Getpost::class,
            Customlogin::class,
        ];
        // Initialize each class
        foreach ($classes as $class) {
            $class::get_instance();
        }
    
        $this->setup_hooks();
    }
    
    // set up hooks
    protected function setup_hooks(){
        add_action('wp_before_admin_bar_render', [$this,'wpb_custom_logo']);
        add_action('after_setup_theme', [$this,'setup_theme']);
        add_filter( 'woocommerce_product_get_rating_html', [$this, 'filter_woocommerce_product_get_rating_html'], 10, 3 ); 
        add_action('init', [$this, 'remove_price_related_actions']);
        add_filter( 'woocommerce_variable_sale_price_html', [$this,'agromedika_remove_prices'], 10, 2 );
        add_action( 'init', [$this,'remove_add_to_cart_button']);
        add_filter( 'woocommerce_is_purchasable', '__return_false' );
        add_action('woocommerce_product_meta_start',[$this,'agromedika_custom_btn_single']);
        add_filter('woocommerce_sale_flash', [$this,'remove_woocommerce_sale_flash'], 10, 3);
        add_action('woocommerce_shop_loop_item_title', [$this,'abChangeProductsTitle'], 10 );
        add_shortcode('custom_page_headers', [$this,'custom_page_headers_shortcode']);
        add_filter('admin_footer_text', [$this,'custom_footer_admin_text']);
        add_action( 'pre_get_posts', [$this,'customize_search_query'] );
    }

    public function remove_price_related_actions() {
        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
        remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
        remove_action('woocommerce_after_shop_loop', 'woocommerce_pagination',10);
    }
    
    public function setup_theme(){
        add_theme_support('title_tag');
        add_theme_support('post-thumbnails');
        add_theme_support('customize-selective-refresh-widgets');
        add_theme_support('widgets');
        add_theme_support('automatic-feed-links');
        add_theme_support( 'custom-logo', [
            'header-text' => ['site-title', 'site-description'],
            'height'        =>  50,
            'width'         =>  100,
            'flex-height'   =>  true,
            'flex-width'    =>  true,
            'unlink-homepage-logo' => true, 
        ]);
        add_theme_support('custom-background',[
            'default-color'         =>      '#fff',
            'default-image'         =>      '',
            'default-repeat'        =>      'no-repeat',
            'default-size'          =>      'contain',
        ]);
        add_theme_support('html5',[
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'script',
            'style'
        ]);

        add_theme_support( 'woocommerce');
        add_editor_style();

        add_theme_support( 'wp-block-styles' );
        add_theme_support( 'align-wide' );

        add_theme_support( 'wc-product-gallery-zoom' );
        add_theme_support( 'wc-product-gallery-lightbox' );
        add_theme_support( 'wc-product-gallery-slider' );
    }

    //ratings
    function filter_woocommerce_product_get_rating_html( $rating_html, $rating, $count ) { 
        $rating_html  = '<div class="star-rating fs-5 mb-4 mx-auto">';
        $rating_html .= wc_get_star_rating_html( $rating, $count );
        $rating_html .= '</div>';
        return $rating_html; 
    }

    // remove button cart
    function remove_add_to_cart_button() {
        remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
    }
    // custom button sa agromedika
    function agromedika_custom_btn_single() {
        $custom_btn_link = esc_url(site_url('/contact'));
        $custom_btn_link_2 = esc_url(home_url('/products'));
    
        echo '<div id="product_btn" class="vstack gap-3 col-md-5 mx-auto w-100 mt-5 mb-5">';
        echo '<a href="' . $custom_btn_link . '" class="btn btn-success py-3 fs-6"><i class="bi bi-info-circle me-2"></i>' . __("Inquire", "agromedika") . '</a>';
        echo '<a href="' . $custom_btn_link_2 . '" class="btn btn-outline-success btn-block btn-md py-3 px-4 mt-2 mb-3 ripple"><i class="bi bi-eye me-2"></i>' . __("View Other Products", "agromedika") . '</a>';
        echo '</div>';
    }
    
    // Remove sale tag
    function remove_woocommerce_sale_flash($html, $post, $product) {
        // Check if the product is on sale
        if ($product->is_on_sale()) {
            $html = '';
        }
        return $html;
    }
    
    // Custom shop title
    function abChangeProductsTitle() {
        echo '<h5 class="woocommerce-loop-product_title museo text-center fw-bold mt-4"><a class="text-decoration-none text-success" href="' . esc_url(get_the_permalink()) . '">' . esc_html(get_the_title()) . '</a></h5>';
    }

    // display jumbotron pages
    function custom_page_headers_shortcode() {
        if (is_page() && !is_front_page()) {
            ob_start();
            ?>
            <h1 class="display-2 museo fw-bold text-success mx-auto text-center">
                <?php echo esc_html(single_post_title()); ?>
            </h1>
            <h6 class="mt-4">
                <nav aria-label="breadcrumb" class="justify-content-center text-center">
                    <?php custom_breadcrumbs(); ?>
                </nav>
            </h6>
            <?php
            return ob_get_clean();
        }
        return ''; // Return an empty string if the condition is not met.
    }
  
    // add agromedika logo in dashboard
    function wpb_custom_logo() {
        echo '<style>';
        echo '#wpadminbar #wp-admin-bar-wp-logo > .ab-item .ab-icon:before {
            background-image: url(' . esc_url(get_stylesheet_directory_uri() . '/assets/imgs/agromedika_16x16.png') . ') !important;
            background-position: center!important;
            background-size: cover!important;
            object-fit: cover!important;
            color: rgba(0, 0, 0, 0);
        }';
        echo '#wpadminbar #wp-admin-bar-wp-logo.hover > .ab-item .ab-icon {
            background-position: 0 0;
        }';
        echo '</style>';
    }
    // Custom admin Footer text
    function custom_footer_admin_text() {
        echo esc_html__("The Official Website of Agromedika", "agromedika");
        echo ' | <a target="_blank" href="'. esc_url('https://dev-asegumpan.pantheonsite.io/agromedika-healthier-solutions-from-nature/' ) .'">Made by: <b>AS</b></a>';
    }

    // get Search Query
    function customize_search_query( $query ) {
        if ( !is_admin() && $query->is_main_query() && $query->is_search() ) {
            $query->set( 'post_type', ['post', 'careers', 'publications', 'trainingseminars', 'medicinal_herbs'] );
        }
    }
 }