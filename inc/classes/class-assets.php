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
     } 
  
     public function register_styles() {
         $theme_version = wp_get_theme()->get('Version');

         wp_register_style('style', get_stylesheet_uri(), [], $theme_version, 'all');
         wp_register_style('icons', '//cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css', [], false, 'all');
         wp_register_style('fancybox_css', '//cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css', [], false, 'all');
         wp_register_style('woo_style', AGROMEDIKA_DIR_URI . '/assets/css/woo-style.css', [], false, 'all');

         wp_enqueue_style('style');
         wp_enqueue_style('icons');
         wp_enqueue_style('fancybox_css');
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
 }
