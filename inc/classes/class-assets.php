<?php
/**
 * Assets theme assets
 * @package herbanext
 */

 namespace HERBANEXT_THEME\Inc;

 use HERBANEXT_THEME\Inc\Traits\Singleton;
 
 class Assets {
     use Singleton;
 
     protected function __construct() {
         $this->setup_hooks();
     }
 
     protected function setup_hooks() {
         add_action('wp_enqueue_scripts', [$this, 'register_styles']);
         add_action('wp_enqueue_scripts', [$this, 'register_scripts']);
     } 
  
     public function register_styles() {
         $theme_version = wp_get_theme()->get('Version');

         wp_register_style('style', get_stylesheet_uri(), [], $theme_version, 'all');
         wp_register_style('owl_carousel_css', '//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css', [], false, 'all');
         wp_register_style('icons', '//cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css', [], false, 'all');
         wp_register_style('aos_css', '//cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css', [], false, 'all');
         wp_register_style('woo_style', HERBANEXT_DIR_URI . '/assets/css/woo-style.css', [], false, 'all');

         wp_enqueue_style('style');
         wp_enqueue_style('owl_carousel_css');
         wp_enqueue_style('icons');
         wp_enqueue_style('aos_css');
         wp_enqueue_style('woo_style');
     }
 
     public function register_scripts() {
         $theme_version = wp_get_theme()->get('Version');
         wp_deregister_script('jquery');
         wp_register_script('jquery', '//cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js', [], '3.7.1', true);
         wp_register_script('bootstrap_js', '//cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js', ['jquery'], $theme_version, true);
         wp_register_script('owl_carousel_js', '//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js', [], '2.3.4', true);
         wp_register_script('aos_js', '//cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js', [], '2.3.4', true);
         wp_register_script('lightbox_js', '//cdn.jsdelivr.net/npm/bs5-lightbox@1.8.3/dist/index.bundle.min.js', [], '1.8.3', true);

         wp_enqueue_script('jquery');
         wp_enqueue_script('bootstrap_js');
         wp_enqueue_script('owl_carousel_js');
         wp_enqueue_script('aos_js');
         wp_enqueue_script('lightbox_js');
     }
 }
