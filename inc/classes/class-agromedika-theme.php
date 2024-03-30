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
        $classes = [
            // Restriction::class,
            // Namespacecpt::class,
            Menus::class,
            Assets::class,
            // AGROMEDIKACPT::class,
            // Careercat::class,
            Shortcodes::class,
            Woofeat::class,
            RecentProductPost::class,
            DataSheetMetabox::class,
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
        add_action('init', [$this, 'remove_price_related_actions']);
        add_filter( 'woocommerce_variable_sale_price_html', [$this,'agromedika_remove_prices'], 10, 2 );
        add_action( 'init', [$this,'remove_add_to_cart_button']);
        add_filter( 'woocommerce_is_purchasable', '__return_false' );
        add_filter('woocommerce_sale_flash', [$this,'remove_woocommerce_sale_flash'], 10, 3);
        add_filter('admin_footer_text', [$this,'custom_footer_admin_text']);
        add_action( 'after_setup_theme', [$this,'image_sizes'] );
        add_action('pre_get_posts', [$this,'agromedika_modify_search_query']);
        add_action('acf/render_field_settings/type=image', [$this,'add_default_value_to_image_field'], 10, 3);
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
        add_theme_support( 'editor-styles' );
        add_theme_support( 'align-wide' );
        add_theme_support( 'appearance-tools' );
        add_theme_support( 'border' );
        add_theme_support( 'responsive-embeds' );
        add_theme_support( 'editor-color-palette', array(
            array(
                'name'  => esc_attr__( 'agro green', 'agromedika' ),
                'slug'  => 'agro-green',
                'color' => '#009245',
            ),
            array(
                'name'  => esc_attr__( 'agro light', 'agromedika' ),
                'slug'  => 'agro-light',
                'color' => '#F3FFF8',
            ),
            array(
                'name'  => esc_attr__( 'agro light teal', 'agromedika' ),
                'slug'  => 'agro-light-teak',
                'color' => '#EEFFF5',
            ),
            array(
                'name'  => esc_attr__( 'agro gray', 'agromedika' ),
                'slug'  => 'agro-gray',
                'color' => '#5B5B5B',
            ),
        ) );
    }

    public function image_sizes(){ 
        add_image_size( 'blog-img-size', null, 270, true );
    }

    // add acf default image
    function add_default_value_to_image_field($field) {
        acf_render_field_setting( $field, array(
            'label'			=> 'Default Image',
            'instructions'		=> 'Appears when creating a new post',
            'type'			=> 'image',
            'name'			=> 'default_value',
        ));
    }

    // remove button cart
    function remove_add_to_cart_button() {
        remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
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
        echo '<h5 class="woocommerce-loop-product_title  text-center fw-bold mt-4"><a class="text-decoration-none text-success" href="' . esc_url(get_the_permalink()) . '">' . esc_html(get_the_title()) . '</a></h5>';
    }

    // display jumbotron pages
    function custom_page_headers_shortcode() {
        if (is_page() && !is_front_page()) {
            ob_start();
            ?>
            <h1 class="display-2  fw-bold text-success mx-auto text-center">
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
        echo ' | <a target="_blank" href="'. esc_url('https://dev-asegumpan.pantheonsite.io' ) .'">Made by: <b>AS</b></a>';
    }

    function agromedika_modify_search_query($query) {
        if ($query->is_search() && $query->is_main_query()) {
            $query->set('posts_per_page', get_option('posts_per_page'));
        }
    }
    
 }