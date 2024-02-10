<?php 
/**
 * @package agromedika
 */

 namespace HERBANEXT_THEME\Inc;

use HERBANEXT_THEME\Inc\Traits\Singleton;

class Customlogin {
    use Singleton;

    protected function __construct() {
        // Add action hooks to register custom post types
        $this->setup_login_page_hooks();
    }
    protected function setup_login_page_hooks() {
        // Modify the login page logo
        add_action('login_head', [$this, 'modify_login_logo']);
        // Customize the login page URL
        add_filter('login_headerurl', [$this, 'custom_login_url']);
        // Enqueue custom login page styles
        add_action('login_enqueue_scripts', [$this, 'enqueue_custom_login_stylesheet']);
    }

    /**
     * Modify the login page logo
     */
    public function modify_login_logo() {
        $logo_style = '<style type="text/css">';
        $logo_style .= 'h1 a {background-image: url(' . esc_url(get_template_directory_uri()) . '/assets/imgs/herbanext.png) !important;}';
        $logo_style .= '</style>';
        echo $logo_style;
    }
    /**
     * Customize the login page URL
     */
    public function custom_login_url() {
        return esc_url(site_url('/'));
    }
    /**
     * Enqueue custom login page stylesheet
     */
    public function enqueue_custom_login_stylesheet() {
        wp_enqueue_style('custom-login', esc_url(get_stylesheet_directory_uri()) . '/assets/css/custom_login.css');
    }
   
}


