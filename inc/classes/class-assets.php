<?php
/**
 * Assets theme assets
 * @package agromedika
 */

 namespace AGROMEDIKA_THEME\Inc;

 use AGROMEDIKA_THEME\Inc\Traits\Singleton;
 
 class Assets {
     use Singleton;
 
     protected function __construct() {
         $this->setup_hooks();
     }
 
     protected function setup_hooks() {
         add_action('wp_enqueue_scripts', [$this, 'register_styles']);
         add_action('wp_enqueue_scripts', [$this, 'register_scripts']);
         add_action('wp_enqueue_scripts', [$this, 'swiper_cdn']);
         add_action( 'after_setup_theme', [$this,'image_sizes'] );
     } 
     public function swiper_cdn(){
        if ( is_singular( 'herb' ) ) {
            wp_register_style('swiper_style', AGROMEDIKA_DIR_URI . '//cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', [], false, 'all');
            wp_enqueue_style('swiper_style');

            wp_register_script('swiper_js', '//cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js', [], '11.0.7', true);
            wp_enqueue_script('swiper_js');

         }
     }
     public function register_styles() {
         $theme_version = wp_get_theme()->get('Version');

         wp_register_style('style', get_stylesheet_uri(), [], $theme_version, 'all');
         wp_register_style('icons', '//cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css', [], false, 'all');
         wp_register_style('fancybox_css', '//cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css', [], false, 'all');
        //  wp_register_style('googe_open_font', '//fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,600;1,600&display=swap', [], false, 'all');

         wp_register_style('woo_style', AGROMEDIKA_DIR_URI . '/assets/css/woo-style.css', [], false, 'all');

         wp_enqueue_style('style');
         wp_enqueue_style('icons');
         wp_enqueue_style('fancybox_css');
        //  wp_enqueue_style('googe_open_font');
         wp_enqueue_style('woo_style');
         
     }
     public function register_scripts() {
         $theme_version = wp_get_theme()->get('Version');
         wp_deregister_script('jquery');
         wp_register_script('jquery', '//cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js', [], '3.7.1', true);
         wp_register_script('bootstrap_js', '//cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js', ['jquery'], $theme_version, true);
         wp_register_script('owl_carousel_js', '//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js', [], '2.3.4', true);
         wp_register_script('fancybox_js', '//cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js', [], '2.3.4', true);

         wp_enqueue_script('jquery');
         wp_enqueue_script('bootstrap_js');
         wp_enqueue_script('owl_carousel_js');
         wp_enqueue_script('fancybox_js');
     }

     public function image_sizes(){ 
        add_image_size( 'jumbotron', 1905, 560, true );
        add_image_size( 'sg_img', 650, 430, true );
        add_image_size( 'product_img', 240, 250, true );
        add_image_size( 'prod_carousel_img', 1080, 510, true );
        add_image_size( 'grow_img', 1910, 510, true );
        add_image_size( 'info_img', 100, 100, true);
        add_image_size( 'news_update_img', 400, 300, true );
        add_image_size( 'footer_logo', 120, 120, true );
        add_image_size( 'foot_main_logo', 200, 143, true );
        add_image_size( 'gallery_img', 200, 200, true );
        add_image_size( 'blog_img_size', 340, 220, true );
        add_image_size( 'recent_thumbnails', 145, 150, true );
        add_image_size( 'logo_thumbnails', 126, 90, true );
        add_image_size( 'blog_thumbnail', 1903, 756, true );
        add_image_size( 'doh_thumbnail', 70, 70, true );
        add_image_size( 'qual_info_thumbnail', 60, 60, true );
        add_image_size( 'herb_thumbnail', 486 , 450 ,true );
        add_image_size( 'herb_sm_thumbnail', 114 , 110 ,true );
        add_image_size( 'company_thumbnail', 636 , 681 ,true );
        add_image_size( 'company_team_thumbnail', 1296 , 406 ,true );
        add_image_size( 'rnd_thumbnail', 306 , 250 ,true );
        add_image_size( 'rnd_gall_thumbnail', 306 , 230 ,true );
        add_image_size( 'team_thumbnail', 306 , 350 ,true );
        add_image_size( 'quality_assurance_thumbnail', 416 , 500 ,true );
        add_image_size( 'single_herb_thumbnail', 300 , 280 ,true );
        add_image_size( 'company_jumbotron', 1400 , 933 ,true );
        add_image_size( 'cust_img_thumb', 30 , 30 ,true );
    } 
 }
